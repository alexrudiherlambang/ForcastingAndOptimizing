<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Keuntungan extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model("admin/KeuntunganModel");
	}

	function index(){
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
			redirect("login");
		}
		$data['keuntungan'] = $this->KeuntunganModel->ambil_data();
		$data['nk'] = $this->KeuntunganModel->ambil_nk();
		$data['id_peramalan_isi'] 	= $this->KeuntunganModel->ambil_peramalan();
		$data['peramalan']		= $this->KeuntunganModel->ambil_peramalan();
		
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/keuntungan", $data);
		$this->load->view("partials/main/footer");
	}

	function data_peramalan()
	{
		$id_peramalan 	= $this->input->post("id_peramalan");
		$send 			= $this->KeuntunganModel->data_peramalan($id_peramalan);
		echo json_encode($send);
	}

	function tambah()
	{
		$tahun = $this->input->post("tahun_isi");
		$kuartal = $this->input->post("kuartal_isi");
		$peramalan_produksi = $this->input->post("hasil_peramalan_isi");
		$nk = $this->input->post("nilai_nk_isi");
		$keuntungan = $peramalan_produksi * $nk;
		
		$data = array(
			'tahun'				=> $tahun,
			'kuartal'			=> $kuartal,
			'peramalan_produksi'=> $peramalan_produksi,
			'keuntungan'		=> $keuntungan
		);

		$this->KeuntunganModel->tambah_keuntungan($data);
		redirect("admin/Keuntungan");
	}

	function keuntungan(){
		echo "<pre>";
		$x1= $this->input->post("x1");
		$x2 = $this->input->post("x2");
		$x3 = $this->input->post("x3");
		// $x1 = -24;
		// $x2 = -6;
		// $x3 = -11;
		$min_x = $this->min_x($x1, $x2, $x3);
		// print_r($min_x)."\n";
		$table = array();
		$i = 0;
		$table[$i]['z']['x1'] = $x1;
		$table[$i]['z']['x2'] = $x2;
		$table[$i]['z']['x3'] = $x3;
		$table[$i]['z']['s1'] = 0;
		$table[$i]['z']['s2'] = 0;
		$table[$i]['z']['s3'] = 0;
		$table[$i]['z']['batas'] = 0;
		$table[$i]['z']['rasio'] = '';
		$table[$i]['s1']['x1'] = 11;
		$table[$i]['s1']['x2'] = 13;
		$table[$i]['s1']['x3'] = 13;
		$table[$i]['s1']['s1'] = 1;
		$table[$i]['s1']['s2'] = 0;
		$table[$i]['s1']['s3'] = 0;
		$table[$i]['s1']['batas'] = 3330;
		$table[$i]['s1']['rasio'] = $table[$i]['s1']['batas'] / $table[$i]['s1'][$min_x];
		$table[$i]['s2']['x1'] = 15;
		$table[$i]['s2']['x2'] = 20;
		$table[$i]['s2']['x3'] = 25;
		$table[$i]['s2']['s1'] = 0;
		$table[$i]['s2']['s2'] = 1;
		$table[$i]['s2']['s3'] = 0;
		$table[$i]['s2']['batas'] = 5400;
		$table[$i]['s2']['rasio'] = $table[$i]['s2']['batas'] / $table[$i]['s2'][$min_x];
		$table[$i]['s3']['x1'] = 5;
		$table[$i]['s3']['x2'] = 10;
		$table[$i]['s3']['x3'] = 25;
		$table[$i]['s3']['s1'] = 0;
		$table[$i]['s3']['s2'] = 0;
		$table[$i]['s3']['s3'] = 1;
		$table[$i]['s3']['batas'] = 3600;
		$table[$i]['s3']['rasio'] = $table[$i]['s3']['batas'] / $table[$i]['s3'][$min_x];
		// print_r($table[$i]['s1']['rasio']."\n");
		// print_r($table[$i]['s2']['rasio']."\n");
		// print_r($table[$i]['s3']['rasio']."\n");

		$rasio_s1 = $table[$i]['s1']['rasio'];
		$rasio_s2 = $table[$i]['s2']['rasio'];
		$rasio_s3 = $table[$i]['s3']['rasio'];
		$cari_rasio = $this->min_rasio($x1, $x2, $x3);
		$min_rasio = $cari_rasio['min_rasio'];
		$baris_s = $cari_rasio['baris_s'];
		// echo $min_rasio."\n";
		// print_r ($baris_s)."\n";

		$titik_potong_x_rasio = $table[$i][$min_rasio][$min_x]; 
		// echo $titik_potong_x_rasio."\n";

		//ITERASI 2 SUDAH DITEMUKAN NILAI MINIMUM X DAN MINIMUM RASIO
        // $i = 0;
		for ($i = 1; $i<=3; $i++){
            // echo $i."\n"; 
			$table[$i][$min_rasio]['x1'] = $table[$i-1][$min_rasio]['x1'] / $titik_potong_x_rasio;
			$table[$i][$min_rasio]['x2'] = $table[$i-1][$min_rasio]['x2'] / $titik_potong_x_rasio;
			$table[$i][$min_rasio]['x3'] = $table[$i-1][$min_rasio]['x3'] / $titik_potong_x_rasio;
			$table[$i][$min_rasio]['s1'] = $table[$i-1][$min_rasio]['s1'] / $titik_potong_x_rasio;
			$table[$i][$min_rasio]['s2'] = $table[$i-1][$min_rasio]['s2'] / $titik_potong_x_rasio;
			$table[$i][$min_rasio]['s3'] = $table[$i-1][$min_rasio]['s3'] / $titik_potong_x_rasio;
			$table[$i][$min_rasio]['batas'] = $table[$i-1][$min_rasio]['batas'] / $titik_potong_x_rasio;
			// print_r ($table[$i][$min_rasio]['x1']."\n");
			// print_r ($table[$i][$min_rasio]['x2']."\n");
			// print_r ($table[$i][$min_rasio]['x3']."\n");
			// print_r ($table[$i][$min_rasio]['s1']."\n");
			// print_r ($table[$i][$min_rasio]['s2']."\n");
			// print_r ($table[$i][$min_rasio]['s3']."\n");
			// print_r ($table[$i][$min_rasio]['batas']."\n");

			foreach ($baris_s as $s) {
				$table[$i][$s]['x1'] = $table[$i-1][$s]['x1'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['x1']);
				$table[$i][$s]['x2'] = $table[$i-1][$s]['x2'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['x2']);
				$table[$i][$s]['x3'] = $table[$i-1][$s]['x3'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['x3']);
				$table[$i][$s]['s1'] = $table[$i-1][$s]['s1'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['s1']);
				$table[$i][$s]['s2'] = $table[$i-1][$s]['s2'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['s2']);
				$table[$i][$s]['s3'] = $table[$i-1][$s]['s3'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['s3']);
				$table[$i][$s]['batas'] = $table[$i-1][$s]['batas'] - ($table[$i-1][$s][$min_x] * $table[$i][$min_rasio]['batas']);
			}

			$data = array(
				'nilai_nk' 		=> $table[$i][$s]['batas']
			);

			$this->KeuntunganModel->tambah_nk($data);
			// print_r($table[$i][$s]['batas']."\n\n");
				// print_r($table[$i][$min_rasio]['batas']."\n\n");


            // CARI X di Z yang terkecil
			$x1 = $table[$i]['z']['x1'];
			$x2 = $table[$i]['z']['x2'];
			$x3 = $table[$i]['z']['x3'];
			$min_x = $this->minimal_x($x1, $x2, $x3);
			// echo $x1."\n";			
			// echo $x2."\n";
			// echo $x3."\n";
			// echo $min_x."\n";

			if ($min_x<>false){
                // Hitung rasio
				$table[$i][$min_rasio]['rasio'] = $table[$i][$min_rasio]['batas'] / $table[$i][$min_rasio][$min_x];
				// print_r($table[$i][$min_rasio]['rasio']);
				foreach ($baris_s as $s) {
					if ($s<>'z' && $table[$i][$s][$min_x]<>0){
						$table[$i][$s]['rasio'] = $table[$i][$s]['batas'] / $table[$i][$s][$min_x];
					}else{
						$table[$i][$s]['rasio'] = 'gagal';
					}
					// print_r($table[$i][$s]['rasio']."\n");
				}
				$cari_rasio = $this->minimal_rasio($x1, $x2, $x3);
				$min_rasio = $cari_rasio['min_rasio'];
				$baris_s = $cari_rasio['baris_s'];
				// echo $min_rasio."\n";
				// print_r ($baris_s)."\n";

				$titik_potong_x_rasio = $table[$i][$min_rasio][$min_x]; 
				// echo $titik_potong_x_rasio."\n";
			}
		}
		redirect("admin/Keuntungan");
		echo "</pre>";
	}

	public function min_x($x1, $x2, $x3){
		if ($x1<=$x2 && $x1<=$x3){
			$min_x = 'x1';
		}elseif ($x2<=$x1 && $x2<=$x3){
			$min_x = 'x2';
		}elseif ($x3<=$x2 && $x3<=$x1){
			$min_x = 'x3';
		}else{
			$min_x = false;
		}
		return $min_x;
	}

	public function minimal_x($x1, $x2, $x3){
		// echo $x1."\n";
		// echo $x2."\n";
		// echo $x3."\n";
		if($x1==0 && $x2!=0 && $x3!=0){
			if ($x2<=$x3){
				$min_x = 'x2';
			}elseif ($x3<=$x2){
				$min_x = 'x3';
			}else{
				$min_x = 'x1';
			}
		}elseif($x2==0 && $x1!=0 && $x3!=0){
			if ($x1<=$x3){
				$min_x = 'x1';
			}elseif ($x3<=$x1){
				$min_x = 'x3';
			}else{
				$min_x = 'x2';
			}
		}elseif($x3==0 && $x1!=0 && $x2!=0){
			if ($x1<=$x2){
				$min_x = 'x1';
			}elseif ($x2<=$x1){
				$min_x = 'x2';
			}else{
				$min_x = 'x3';
			}
		}elseif($x1==0 && $x2==0 && $x3!=0){
			$min_x = 'x3';
		}elseif($x1==0 && $x3==0 && $x2!=0){
			$min_x = 'x2';
		}elseif($x2==0 && $x3==0 && $x1!=0){
			$min_x = 'x1';
		}else{
			$min_x = false;
		}
		return $min_x;	
	}

	public function min_rasio($rasio_s1, $rasio_s2, $rasio_s3){
		// echo $rasio_s1."\n";
		// echo $rasio_s2."\n";
		// echo $rasio_s3."\n";
		if ($rasio_s1<=$rasio_s2 && $rasio_s1<=$rasio_s3){
			$min_rasio = 's1';
			$baris_s = ['s2', 's3','z'];
		}elseif ($rasio_s2<=$rasio_s1 && $rasio_s2<=$rasio_s3){
			$min_rasio = 's2';
			$baris_s = ['s1', 's3','z'];
		}elseif ($rasio_s3<=$rasio_s1 && $rasio_s3<=$rasio_s3){
			$min_rasio = 's3';
			$baris_s = ['s1', 's2','z'];
		}
		$result = array('min_rasio'=>$min_rasio, 'baris_s'=>$baris_s);
		return $result;
	}

	public function minimal_rasio($rasio_s1, $rasio_s2, $rasio_s3){
		// echo $rasio_s1."\n";
		// echo $rasio_s2."\n";
		// echo $rasio_s3."\n";
		if ($rasio_s1==0 && $rasio_s2!=0 && $rasio_s3!=0){
			if ($rasio_s2<=$rasio_s3){
				$min_rasio = 's2';
				$baris_s = ['s1', 's3','z'];
			}elseif ($rasio_s3<=$rasio_s2){
				$min_rasio = 's3';
				$baris_s = ['s1', 's2','z'];
			}
		}elseif($rasio_s2==0 && $rasio_s1!=0 && $rasio_s3!=0){
			if ($rasio_s1<=$rasio_s3){
				$min_rasio = 's1';
				$baris_s = ['s2', 's3','z'];
			}elseif ($rasio_s3<=$rasio_s1){
				$min_rasio = 's3';
				$baris_s = ['s1', 's2','z'];
			}
		}elseif($rasio_s3==0 && $rasio_s2!=0 && $rasio_s1!=0){
			if ($rasio_s1<=$rasio_s2){
				$min_rasio = 's1';
				$baris_s = ['s2', 's3','z'];
			}elseif ($rasio_s2<=$rasio_s1){
				$min_rasio = 's2';
				$baris_s = ['s1', 's3','z'];
			}
		}elseif($rasio_s1==0 && $rasio_s2==0 && $rasio_s3!=0){
			$min_rasio = 's3';
			$baris_s = ['s1', 's2','z'];
		}elseif($rasio_s1==0 && $rasio_s3==0 && $rasio_s2!=0){
			$min_rasio = 's2';
			$baris_s = ['s1', 's3','z'];
		}elseif($rasio_s2==0 && $rasio_s3==0 && $rasio_s1!=0){
			$min_rasio = 's1';
			$baris_s = ['s1', 's3','z'];
		}else{
			$min_rasio = false;
		}
		$result = array('min_rasio'=>$min_rasio, 'baris_s'=>$baris_s);
		return $result;
	}

	function hapus_data($hapus)
	{
		$id_keuntungan = $hapus;
		$this->KeuntunganModel->hapus_data($id_keuntungan);
		redirect("admin/Keuntungan");
	}

	function hapus_semua()
	{
		$this->KeuntunganModel->hapus_data_semua();
		redirect("admin/Keuntungan");
	}
}
?>
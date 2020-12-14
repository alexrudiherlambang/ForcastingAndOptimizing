<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Peramalan extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model("admin/PeramalanModel");
	}

	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
			redirect("login");
		}
		$data['p'] = $this->PeramalanModel->ambil_data();
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/peramalan", $data);
		$this->load->view("partials/main/footer");
	}

	function perhitungan_peramalan()
	{
		$cek = $this->PeramalanModel->cek_produksi();
		foreach ($cek as $c) {
			# code...
			$cekk = $c->cek;
			if($cekk == 3 OR $cekk == 6 OR $cekk == 9 OR $cekk == 12){
				//Inisialisasi X,Y,Z
				$Y2018 = 0;
				$Y2019 = 0;
				$Y2020 = 0;
				$Y = 0;
				$X2018 = -1;
				$X2019 = 0;
				$X2020 = 1;
				$X = 0;
				$tahun = $this->PeramalanModel->tahun();
				$kuartal = $this->PeramalanModel->kuartal();
				echo "<pre>";
				foreach ($tahun as $key) {
				#code...
					foreach ($kuartal as $kt ) {
					# code...
						$tahun = $key->tahun;
						$ktl =  $kt->kuartal;
						$query = $this->PeramalanModel->kuartalan($tahun, $ktl);
						if ($query[0]['tahun'] == "2018") {
					# code...
					// echo $query[0]['tahun']."\n";
							$Y2018 = $Y2018 + $query[0]['jumlah_produksi'];
					// echo "Y2018 =". $Y2018." + ".$query[0]['jumlah_produksi']."=> ".$Y2018."\n\n";
						}elseif($query[0]['tahun'] == "2019"){
					#code...
					// echo $query[0]['tahun']."\n";
							$Y2019 = $Y2019 + $query[0]['jumlah_produksi'];
					// echo "Y2019 =". $Y2019." + ".$query[0]['jumlah_produksi']."=> ".$Y2019."\n\n";
						}elseif ($query[0]['tahun'] == "2020") {
					# code...
					// echo $query[0]['tahun']."\n";
							$Y2020 = $Y2020 + $query[0]['jumlah_produksi'];
					// echo "Y2020 =". $Y2020." + ".$query[0]['jumlah_produksi']."=> ".$Y2020."\n\n";
						}
					}
				}
		//PERHITUNGAN TREND
				$XY2018 = $X2018 * $Y2018;
				$XY2019 = $X2019 * $Y2019;
				$XY2020 = $X2020 * $Y2020;

				$XK2018 = pow($X2018, 2);
				$XK2019 = pow($X2019, 2);
				$XK2020 = pow($X2020, 2);

				$XKY2018 = pow($X2018, 2) * $Y2018;
				$XKY2019 = pow($X2019, 2) * $Y2019;
				$XKY2020 = pow($X2020, 2) * $Y2020;

				$XK32018 = pow($X2018, 3);
				$XK32019 = pow($X2019, 3);
				$XK32020 = pow($X2020, 3);		

				$XK42018 = pow($X2018, 4);
				$XK42019 = pow($X2019, 4);
				$XK42020 = pow($X2020, 4);

				$SUMY = $Y2018 + $Y2019 + $Y2020;
				$SUMX = $X2018 + $X2019 + $X2020;
				$SUMXY = $XY2018 + $XY2019 + $XY2020;
				$SUMXK = $XK2018 + $XK2019 + $XK2020;
				$SUMXKY = $XKY2018 + $XKY2019 + $XKY2020;
				$SUMXK3 = $XK32018 + $XK32019 + $XK32020;
				$SUMXK4 = $XK42018 + $XK42019 + $XK42020;

				$nData = $this->PeramalanModel->nData();
				$n = $nData[0]['tahun'];

		//Mencari Nilai a b c
				$a = (($SUMY * $SUMXK4) - ($SUMXKY * $SUMXK)) / (($n * $SUMXK4) - ($SUMXK * $SUMXK));
				$b = $SUMXY / $SUMXK;
				$c = (($n * $SUMXKY) - ($SUMXK * $SUMY)) / (($n * $SUMXK4) - ($SUMXK * $SUMXK));

		//Mencari Nilai A, B, dan C pada  Trend Kuartalan
				$ATrendKuartal = $a / 4;
				$BTrendKuartal = $b / 16;
				$CTrendKuartal = $c / 256;

		//inisiasi tabel skala X untuk Trend Kuartalan
				$thn = $this->PeramalanModel->skalaX();
				$krtl = $this->PeramalanModel->skalaX_kuartal();
				foreach ($thn as $t) {
			# code...
					foreach ($krtl as $k) {
				# code...
						$tahunn = $t->thn;
						$kuartall = $k->krtl;

						$kodet = $this->PeramalanModel->id_peramalan_trend();
						$query = $this->PeramalanModel->nilai_skala($tahunn, $kuartall);
			// print_r($query);

						if ($tahunn == "2018" && $kuartall == "1") {
					# code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK118 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK118
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK118."\n";
						}elseif($tahunn == "2018" && $kuartall == "2"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK218 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK218
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK218."\n";
						}elseif($tahunn == "2018" && $kuartall == "3"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK318 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK318
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK318."\n";
						}elseif($tahunn == "2018" && $kuartall == "4"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK418 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK418
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK418."\n";
						}
						elseif($tahunn == "2019" && $kuartall == "1"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK119 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK119
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK119."\n";
						}elseif($tahunn == "2019" && $kuartall == "2"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK219 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK219
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK219."\n";
						}elseif($tahunn == "2019" && $kuartall == "3"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK319 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK319
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK319."\n";
						}elseif($tahunn == "2019" && $kuartall == "4"){
					#code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK419 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK419
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK419."\n";
						}elseif ($tahunn == "2020" && $kuartall == "1") {
					# code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK120 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK120
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK120."\n";
						}elseif ($tahunn == "2020" && $kuartall == "2") {
					# code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK220 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK220
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK220."\n";
						}elseif ($tahunn == "2020" && $kuartall == "3") {
					# code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK320 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK320
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK320."\n";
						}elseif ($tahunn == "2020" && $kuartall == "4") {
					# code...
					// echo $query[0]['thn']."\n";
					// echo $query[0]['krtl']."\n";
					// echo $query[0]['nilai']."\n";
							$TrendK420 = $ATrendKuartal + ($BTrendKuartal * $query[0]['nilai']) + ($CTrendKuartal * pow($query[0]['nilai'], 2));
							$data = array(
								'id_peramalan' => $kodet,
								'tahun' => $tahunn,
								'kuartal' => $kuartall,
								'hasil_trend' => $TrendK420
							);
							$this->PeramalanModel->tambah_trend($data);
					// echo $TrendK420."\n";
						}
					}
				}
		//Rata - Rata Trend Kuartalan
				$AVGK1 = ($TrendK118 + $TrendK119 + $TrendK120) / 3;
				$AVGK2 = ($TrendK218 + $TrendK219 + $TrendK220) / 3;
				$AVGK3 = ($TrendK318 + $TrendK319 + $TrendK320) / 3;
				$AVGK4 = ($TrendK418 + $TrendK419 + $TrendK420) / 3;
		// echo $AVGK1."\n";
		// echo $AVGK2."\n";
		// echo $AVGK3."\n";
		// echo $AVGK4."\n";

		//B Kumulatif
				$BKum1 = $b * 0;
				$BKum2 = $b * 1;
				$BKum3 = $b * 2;
				$BKum4 = $b * 3;
		// echo $BKum1."\n";
		// echo $BKum2."\n";
		// echo $BKum3."\n";
		// echo $BKum4."\n";

		//Rata-Rata B kumulatif
				$AVGBKum1 = $AVGK1 - $BKum1;
				$AVGBKum2 = $AVGK2 - $BKum2;
				$AVGBKum3 = $AVGK3 - $BKum3;
				$AVGBKum4 = $AVGK4 - $BKum4;

				$SUMAVGBKum =($AVGBKum1 + $AVGBKum2 + $AVGBKum3 + $AVGBKum4) / 4;
		// echo $AVGBKum1."\n";
		// echo $AVGBKum2."\n";
		// echo $AVGBKum3."\n";
		// echo $AVGBKum4."\n";
		// echo $SUMAVGBKum."\n";

		//Index Musiman dan FORCASTING
				foreach ($thn as $t) {
			# code...
					foreach ($krtl as $k) {
				# code...
						$tahunn = $t->thn;
						$kuartall = $k->krtl;
						$kode = $this->PeramalanModel->id_peramalan();
						$kodeim = $this->PeramalanModel->id_peramalan_indeks_musiman();

						if ($tahunn == "2018" && $kuartall == "1") {
					# code...
							$IMK1 = $AVGBKum1 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK1
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK12018 = $TrendK118 * $IMK1 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan'=> $ForcastK12018
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK1."\n";
						}elseif($tahunn == "2018" && $kuartall == "2"){
					#code...
							$IMK2 = $AVGBKum2 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK2,
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK22018 = $TrendK218 * $IMK2 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK22018
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK2."\n";
						}elseif($tahunn == "2018" && $kuartall == "3"){
					#code...
							$IMK3 = $AVGBKum3 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK3
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK32018 = $TrendK318 * $IMK3 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK32018
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK3."\n";
						}elseif($tahunn == "2018" && $kuartall == "4"){
					#code...
							$IMK4 = $AVGBKum4 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK4
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK42018 = $TrendK418 * $IMK4 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK42018
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK4."\n";
						}elseif($tahunn == "2019" && $kuartall == "1"){
					#code...
							$IMK1 = $AVGBKum1 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK1
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK12019 = $TrendK119 * $IMK1 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK12019
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK1."\n";	
						}elseif($tahunn == "2019" && $kuartall == "2"){
					#code...
							$IMK2 = $AVGBKum2 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK2,
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK22019 = $TrendK219 * $IMK2 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK22019	
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK2."\n";
						}elseif($tahunn == "2019" && $kuartall == "3"){
					#code...
							$IMK3 = $AVGBKum3 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK3
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK32019 = $TrendK319 * $IMK3 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK32019
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK3."\n";
						}elseif($tahunn == "2019" && $kuartall == "4"){
					#code...
							$IMK4 = $AVGBKum4 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK4
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK42019 = $TrendK419 * $IMK4 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK42019
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK4."\n";
						}elseif ($tahunn == "2020" && $kuartall == "1") {
					# code...
							$IMK1 = $AVGBKum1 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK1
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK12020 = $TrendK120 * $IMK1 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK12020
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK1."\n";
						}elseif ($tahunn == "2020" && $kuartall == "2") {
					# code...
							$IMK2 = $AVGBKum2 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK2,
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK22020 = $TrendK220 * $IMK2 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK22020
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK2."\n";
						}elseif ($tahunn == "2020" && $kuartall == "3") {
					# code...
							$IMK3 = $AVGBKum3 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK3
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK32020 = $TrendK320 * $IMK3 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK32020
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK3."\n";
						}elseif ($tahunn == "2020" && $kuartall == "4") {
					# code...
							$IMK4 = $AVGBKum4 / $SUMAVGBKum * 100;
							$data = array(
								'id_peramalan'	 => $kodeim,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_indeks_musiman' => $IMK4
							);
							$this->PeramalanModel->tambah_indeks_musiman($data);
							$ForcastK42020 = $TrendK420 * $IMK4 / 100;
							$data = array(
								'id_peramalan'	 => $kode,
								'tahun'			 => $tahunn,
								'kuartal'		 => $kuartall,
								'hasil_peramalan' => $ForcastK42020
							);
							$this->PeramalanModel->tambah_peramalan($data);
					// echo $IMK4."\n";
						}
					}
				}


		//HITUNG MSE dan MAPE
		//Mencari nilai Xt
				$JumlahDataK1 = 0;
				$JumlahDataK2 = 0;
				$JumlahDataK3 = 0;
				$JumlahDataK4 = 0;
				$tahun = $this->PeramalanModel->tahun();
				$kuartal = $this->PeramalanModel->kuartal();

				foreach ($tahun as $key) {
			#code...
					foreach ($kuartal as $kt ) {
			# code...
						$tahun = $key->tahun;
						$ktl =  $kt->kuartal;
			// echo $key->tahun;
						$query = $this->PeramalanModel->kuartalan($tahun, $ktl);
			// print_r($query);

						if ($ktl == "01 AND 03") {
						# code...
					// echo $query[0]['tahun']."\n";
							$JumlahDataK1 = $JumlahDataK1 + $query[0]['jumlah_produksi'];
					// echo "kuartal 1 =". $JumlahDataK1." + ".$query[0]['jumlah_produksi']."=> ".$JumlahDataK1."\n\n";
						}elseif($ktl == "04 AND 06"){
					#code...
					// echo $query[0]['tahun']."\n";
							$JumlahDataK2 = $JumlahDataK2 + $query[0]['jumlah_produksi'];
					// echo "kuartal 2 =". $JumlahDataK2." + ".$query[0]['jumlah_produksi']."=> ".$JumlahDataK2."\n\n";
						}elseif ($ktl == "07 AND 09") {
					# code...
					// echo $query[0]['tahun']."\n";
							$JumlahDataK3 = $JumlahDataK3 + $query[0]['jumlah_produksi'];
					// echo "kuartal 3 =". $JumlahDataK3." + ".$query[0]['jumlah_produksi']."=> ".$JumlahDataK3."\n\n";
						}elseif ($ktl == "10 AND 12") {
					# code...
					// echo $query[0]['tahun']."\n";
							$JumlahDataK4 = $JumlahDataK4 + $query[0]['jumlah_produksi'];
					// echo "kuartal 4 =". $JumlahDataK4." + ".$query[0]['jumlah_produksi']."=> ".$JumlahDataK4."\n\n";
						}
					}
				}

		//Mencari Nilai N
				$jumlah_produksi = $this->PeramalanModel->nilaiN();
				foreach ($jumlah_produksi as $jumlah) {
			# code...
					$N = $jumlah->jumlah_produksi;

				}
		//mencari nilai MSE dan MAPE
				foreach ($thn as $t) {
			# code...
					foreach ($krtl as $k) {
				# code...
						$tahunn = $t->thn;
						$kuartall = $k->krtl;
						$kodes = $this->PeramalanModel->id_peramalan_kesalahan();

						if ($tahunn == "2018" && $kuartall == "1") {
					# code...
							$MSEK1 = (pow($JumlahDataK1, 2) + pow($ForcastK12020, 2)) / $N;
							$MAPEK1 =((($JumlahDataK1 + $ForcastK12020) / $JumlahDataK1) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK1,
								'nilai_MAPE' 		=> $MAPEK1
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2018" && $kuartall == "2"){
					#code...
							$MSEK2 = (pow($JumlahDataK2, 2) + pow($ForcastK22020, 2)) / $N;
							$MAPEK2 =((($JumlahDataK2 + $ForcastK22020) / $JumlahDataK2) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK2,
								'nilai_MAPE' 		=> $MAPEK2
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2018" && $kuartall == "3"){
					#code...
							$MSEK3 = (pow($JumlahDataK3, 2) + pow($ForcastK32020, 2)) / $N;
							$MAPEK3 =((($JumlahDataK3 + $ForcastK32020) / $JumlahDataK3) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK3,
								'nilai_MAPE' 		=> $MAPEK3
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2018" && $kuartall == "4"){
					#code...
							$MSEK4 = (pow($JumlahDataK4, 2) + pow($ForcastK42020, 2)) / $N;
							$MAPEK4 =((($JumlahDataK4 + $ForcastK42020) / $JumlahDataK4) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK4,
								'nilai_MAPE' 		=> $MAPEK4
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2019" && $kuartall == "1"){
					#code...
							$MSEK1 = (pow($JumlahDataK1, 2) + pow($ForcastK12020, 2)) / $N;
							$MAPEK1 =((($JumlahDataK1 + $ForcastK12020) / $JumlahDataK1) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK1,
								'nilai_MAPE' 		=> $MAPEK1
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2019" && $kuartall == "2"){
					#code...
							$MSEK2 = (pow($JumlahDataK2, 2) + pow($ForcastK22020, 2)) / $N;
							$MAPEK2 =((($JumlahDataK2 + $ForcastK22020) / $JumlahDataK2) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE' 		=> $MSEK2,
								'nilai_MAPE' 		=> $MAPEK2
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2019" && $kuartall == "3"){
					#code...
							$MSEK3 = (pow($JumlahDataK3, 2) + pow($ForcastK32020, 2)) / $N;
							$MAPEK3 =((($JumlahDataK3 + $ForcastK32020) / $JumlahDataK3) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK3,
								'nilai_MAPE'		=> $MAPEK3
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif($tahunn == "2019" && $kuartall == "4"){
					#code...
							$MSEK4 = (pow($JumlahDataK4, 2) + pow($ForcastK42020, 2)) / $N;
							$MAPEK4 =((($JumlahDataK4 + $ForcastK42020) / $JumlahDataK4) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK4,
								'nilai_MAPE'		=> $MAPEK4
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif ($tahunn == "2020" && $kuartall == "1") {
					# code...
							$MSEK1 = (pow($JumlahDataK1, 2) + pow($ForcastK12020, 2)) / $N;
							$MAPEK1 =((($JumlahDataK1 + $ForcastK12020) / $JumlahDataK1) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK1,
								'nilai_MAPE' 		=> $MAPEK1
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif ($tahunn == "2020" && $kuartall == "2") {
					# code...
							$MSEK2 = (pow($JumlahDataK2, 2) + pow($ForcastK22020, 2)) / $N;
							$MAPEK2 =((($JumlahDataK2 + $ForcastK22020) / $JumlahDataK2) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK2,
								'nilai_MAPE' 		=> $MAPEK2
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif ($tahunn == "2020" && $kuartall == "3") {
					# code...
							$MSEK3 = (pow($JumlahDataK3, 2) + pow($ForcastK32020, 2)) / $N;
							$MAPEK3 =((($JumlahDataK3 + $ForcastK32020) / $JumlahDataK3) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE'  		=> $MSEK3,
								'nilai_MAPE' 		=> $MAPEK3
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}elseif ($tahunn == "2020" && $kuartall == "4") {
					# code...
							$MSEK4 = (pow($JumlahDataK4, 2) + pow($ForcastK42020, 2)) / $N;
							$MAPEK4 =((($JumlahDataK4 + $ForcastK42020) / $JumlahDataK4) * 100) / $N;
							$data = array(
								'id_peramalan' 		=> $kodes,
								'tahun'				=> $tahunn,
								'kuartal'			=> $kuartall,
								'nilai_MSE' 		=> $MSEK4,
								'nilai_MAPE' 		=> $MAPEK4
							);
							$this->PeramalanModel->tambah_kesalahan($data);
						}
					}
				}
				echo "<script>alert('Perhitungan Peramalan Berhasil :)');history.go(-1);</script>";
				/*redirect("admin/Peramalan");*/
			}else{	
				echo "<script>alert('GAGAL !!! Mohon Lengkapi Data Produksi Hingga Genap Satu Kuartal...!!!');history.go(-1);</script>";
			}
		}
		echo "</pre>";
	}
	function hapus($hapus)
	{
		$id_peramalan = $hapus;
		$this->PeramalanModel->hapus_data_trend($id_peramalan);
		$this->PeramalanModel->hapus_data_indeks_musiman($id_peramalan);
		$this->PeramalanModel->hapus_data_kesalahan($id_peramalan);
		$this->PeramalanModel->hapus_data($id_peramalan);
		redirect("admin/Peramalan");
	}
	function hapus_semua()
	{
		$this->PeramalanModel->hapus_data_trend_semua();
		$this->PeramalanModel->hapus_data_indeks_musiman_semua();
		$this->PeramalanModel->hapus_data_kesalahan_semua();
		$this->PeramalanModel->hapus_data_semua();
		redirect("admin/Peramalan");
	}
}
?>
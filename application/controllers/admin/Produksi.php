<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Produksi extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('admin/ProduksiModel');
	}

	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
			redirect("login");
		}
		$data['produksi'] = $this->ProduksiModel->ambil_data();
		$data['kode'] = $this->ProduksiModel->id_produksi();
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/produksi", $data);
		$this->load->view("partials/main/footer");
	}

	function tambah()
	{
		$id_produksi = $this->input->post("id_produksi_isi");
		$tanggal = $this->input->post("tanggal_isi");
		$suhu_baglog = $this->input->post("suhu_baglog_isi");
		$suhu_kumbung = $this->input->post("suhu_kumbung_isi");
		$kelembapan = $this->input->post("kelembapan_isi");
		$jumlah_produksi = $this->input->post("jumlah_produksi_isi");	


		$data = array(
			'id_produksi' 		=> $id_produksi,
			'tanggal'			=> $tanggal,
			'suhu_baglog'		=> $suhu_baglog,
			'suhu_kumbung'		=> $suhu_kumbung,
			'kelembapan'		=> $kelembapan,
			'jumlah_produksi'	=> $jumlah_produksi,
		);

		$this->ProduksiModel->tambahdata($data);
		redirect("admin/Produksi");
	}

	function edit()
	{
		$id_produksi = $this->input->post("id_produksi");
		$tanggal = $this->input->post("tanggal");
		$suhu_baglog = $this->input->post("suhu_baglog");
		$suhu_kumbung = $this->input->post("suhu_kumbung");
		$kelembapan = $this->input->post("kelembapan");
		$jumlah_produksi = $this->input->post("jumlah_produksi");	


		$data = array(
			'id_produksi' 		=> $id_produksi,
			'tanggal'			=> $tanggal,
			'suhu_baglog'		=> $suhu_baglog,
			'suhu_kumbung'		=> $suhu_kumbung,
			'kelembapan'		=> $kelembapan,
			'jumlah_produksi'	=> $jumlah_produksi,
		);

		$this->ProduksiModel->editdata($data, $id_produksi);
		redirect("admin/Produksi");
	}

	function hapus($hapus)
	{
		$id_produksi = $hapus;
		

		$this->ProduksiModel->hapusdata($id_produksi);
		redirect("admin/produksi");
	}

	function check()
	{
		$username 	= $this->input->post("username");
		$data 		= array('username' => $username);

		$proses		= $this->ProduksiModel->check_username($data)->num_rows();

		if ($proses == 0) {
			# code...
			$message = "False";
		} else {
			$message = "True";
		}

		$msg = array('message' => $message);
		echo json_encode($msg);
	}
}

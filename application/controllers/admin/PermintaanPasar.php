<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class PermintaanPasar extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('admin/PermintaanPasarModel');
	}

	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
		redirect("login");
		}
		$data['PermintaanPasar'] = $this->PermintaanPasarModel->ambil_data();
		$data['kode'] = $this->PermintaanPasarModel->id_permintaan_pasar();
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/permintaan_pasar", $data);
		$this->load->view("partials/main/footer");
	}

	function tambah()
	{
		$id_permintaan_pasar = $this->input->post("id_permintaan_pasar_isi");
		$nama_daerah = $this->input->post("nama_daerah_isi");
		$jumlah = $this->input->post("jumlah_isi");
		$harga = $this->input->post("harga_isi");

		$data = array(
			'id_permintaan_pasar' 	=> $id_permintaan_pasar,
			'nama_daerah'			=> $nama_daerah,
			'jumlah'				=> $jumlah,
			'harga'					=> $harga,
			
		);

		$this->PermintaanPasarModel->tambahdata($data);
		// if ($jabatan == "Kasir") {
		// 	$data_tmp = array('id_tmp' => $id_tmp, "id_permintaan_pasar" => $id_permintaan_pasar);
		// 	$this->LoginModel->tambah_tmp($data_tmp);
		// }
		redirect("admin/PermintaanPasar");
	}

	function edit()
	{
		$id_permintaan_pasar = $this->input->post("id_permintaan_pasar");
		$nama_daerah = $this->input->post("nama_daerah");
		$jumlah = $this->input->post("jumlah");
		$harga = $this->input->post("harga");
		
		$data = array(
			'id_permintaan_pasar' 	=> $id_permintaan_pasar,
			'nama_daerah'			=> $nama_daerah,
			'jumlah'				=> $jumlah,
			'harga'					=> $harga,
		);

		$this->PermintaanPasarModel->editdata($data, $id_permintaan_pasar);
		redirect("admin/PermintaanPasar");
	}

	function hapus($hapus)
	{
		$id_permintaan_pasar = $hapus;
		$this->PermintaanPasarModel->hapusdata($id_permintaan_pasar);
		redirect("admin/PermintaanPasar");
	}
}
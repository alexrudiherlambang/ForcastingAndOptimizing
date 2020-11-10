<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Dashboard extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model("Dashboard_model");
	}

	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
		redirect("login");
		}
		$data['jumlah_user'] = $this->Dashboard_model->jumlah_user();
		$data['produksi_harian'] = $this->Dashboard_model->jumlah_produksi_harian();
		$data['produksi_bulanan'] = $this->Dashboard_model->jumlah_produksi_bulanan();
		$data['produksi_tahunan'] = $this->Dashboard_model->jumlah_produksi_tahunan();
		$data['hasil_peramalan'] = $this->Dashboard_model->hasil_peramalan();
		
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/dashboard", $data);
		$this->load->view("partials/main/footer");
	}
}
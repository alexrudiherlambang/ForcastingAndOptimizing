<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Grafik extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('pegawai/GrafikModel');
		$this->load->model('admin/PeramalanModel');
	}
	
	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Pegawai") {
			redirect("login");
		}
	
		$tahun = $this->input->post('tahun_isi');
		if ($tahun == null) {
			# code...
			foreach ($this->GrafikModel->data_produksi_perbulan() as $row) {
				$data['grafik'][] = (float) $row['Januari'];
				$data['grafik'][] = (float) $row['Februari'];
				$data['grafik'][] = (float) $row['Maret'];
				$data['grafik'][] = (float) $row['April'];
				$data['grafik'][] = (float) $row['Mei'];
				$data['grafik'][] = (float) $row['Juni'];
				$data['grafik'][] = (float) $row['Juli'];
				$data['grafik'][] = (float) $row['Agustus'];
				$data['grafik'][] = (float) $row['September'];
				$data['grafik'][] = (float) $row['Oktober'];
				$data['grafik'][] = (float) $row['November'];
				$data['grafik'][] = (float) $row['Desember'];
			}
		} else {
			foreach ($this->GrafikModel->get_data_produksi_perbulan($tahun) as $row) {
				$data['grafik'][] = (float) $row['Januari'];
				$data['grafik'][] = (float) $row['Februari'];
				$data['grafik'][] = (float) $row['Maret'];
				$data['grafik'][] = (float) $row['April'];
				$data['grafik'][] = (float) $row['Mei'];
				$data['grafik'][] = (float) $row['Juni'];
				$data['grafik'][] = (float) $row['Juli'];
				$data['grafik'][] = (float) $row['Agustus'];
				$data['grafik'][] = (float) $row['September'];
				$data['grafik'][] = (float) $row['Oktober'];
				$data['grafik'][] = (float) $row['November'];
				$data['grafik'][] = (float) $row['Desember'];
			}
		}
		$data['thn'] = $this->GrafikModel->get_tahun();

		$data['data'] = $this->GrafikModel->get_data_produksi();
		
		$this->load->view("partials/main/header/header_pegawai");
		$this->load->view("content/pegawai/grafik", $data);
		$this->load->view("partials/main/footer");
	}
}
?>
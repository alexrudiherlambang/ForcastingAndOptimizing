<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class GrafikPeramalan extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('admin/GrafikPeramalanModel');
		$this->load->model('admin/PeramalanModel');
	}
	
	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
			redirect("login");
		}
		
		$tahun = $this->input->post('tahun_isi');
		if ($tahun == null) {
			# code...
			foreach ($this->GrafikPeramalanModel->data_peramalan_perkuartal() as $row) {
				$data['grafik'][] = (float) $row['Kuartal1'];
				$data['grafik'][] = (float) $row['Kuartal2'];
				$data['grafik'][] = (float) $row['Kuartal3'];
				$data['grafik'][] = (float) $row['Kuartal4'];
			}
		} else {
			foreach ($this->GrafikPeramalanModel->get_data_peramalan_perkuartal($tahun) as $row) {
				$data['grafik'][] = (float) $row['Kuartal1'];
				$data['grafik'][] = (float) $row['Kuartal2'];
				$data['grafik'][] = (float) $row['Kuartal3'];
				$data['grafik'][] = (float) $row['Kuartal4'];
			}
		}
		$data['thn'] = $this->GrafikPeramalanModel->get_tahun();

		$data['data'] = $this->GrafikPeramalanModel->get_data_peramalan();
		
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/grafik_peramalan", $data);
		$this->load->view("partials/main/footer");
	}
}
?>
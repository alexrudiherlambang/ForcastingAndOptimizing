<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Profil extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
	}

	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Pegawai") {
		redirect("login");
		}
		$this->load->view("partials/main/header/header_pegawai");
		$this->load->view("content/pegawai/profil");
		$this->load->view("partials/main/footer");
	}
}
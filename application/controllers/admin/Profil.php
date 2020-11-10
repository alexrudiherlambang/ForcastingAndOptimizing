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
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
		redirect("login");
		}
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/profil");
		$this->load->view("partials/main/footer");
	}
}
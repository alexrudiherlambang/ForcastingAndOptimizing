<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class DataUser extends CI_Controller
{

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('admin/UserModel');
	}

	function index()
	{
		if ($this->session->userdata('status') != "Login" || $this->session->userdata("jabatan") != "Admin") {
			redirect("login");
		}
		$data['user'] = $this->UserModel->ambil_data();
		$data['kode'] = $this->UserModel->id_user();
		$this->load->view("partials/main/header/header_owner");
		$this->load->view("content/admin/data_user", $data);
		$this->load->view("partials/main/footer");
	}

	function tambah()
	{
		$id_user = $this->input->post("id_user_isi");
		$nama = $this->input->post("nama_isi");
		$jk = $this->input->post("jenis_kelamin_isi");
		$alamat = $this->input->post("alamat_isi");
		$jabatan = $this->input->post("jabatan_isi");
		$username = $this->input->post("username_isi");
		$pass = $this->input->post("password_isi");
		$password = password_hash($pass, PASSWORD_DEFAULT);
		


		$data = array(
			'id_user' 		=> $id_user,
			'nama_user'		=> $nama,
			'jenis_kelamin'	=> $jk,
			'alamat'		=> $alamat,
			'jabatan'		=> $jabatan,
			'username'		=> $username,
			'password'		=> $password
		);

		$this->UserModel->tambahdata($data);
		redirect("admin/DataUser");
	}

	function edit()
	{
		$id_user = $this->input->post("id_user");
		$nama = $this->input->post("nama");
		$jk = $this->input->post("jenis_kelamin");
		$alamat = $this->input->post("alamat");
		$jabatan = $this->input->post("jabatan");
		$username = $this->input->post("username");
		$pass = $this->input->post("password");
		$password = password_hash($pass, PASSWORD_DEFAULT);

		$data = array(
			'id_user' 		=> $id_user,
			'nama_user'		=> $nama,
			'jenis_kelamin'	=> $jk,
			'alamat'		=> $alamat,
			'jabatan'		=> $jabatan,
			'username'		=> $username,
			'password'		=> $password
		);

		$this->UserModel->editdata($data, $id_user);
		redirect("admin/DataUser");
	}

	function hapus($hapus)
	{
		$id_user = $hapus;
		

		$this->UserModel->hapusdata($id_user);
		redirect("admin/datauser");
	}

	function check()
	{
		$username 	= $this->input->post("username");
		$data 		= array('username' => $username);

		$proses		= $this->UserModel->check_username($data)->num_rows();

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

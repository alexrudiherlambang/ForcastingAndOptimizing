<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class LoginModel extends CI_Model
{

	function __construct()
	{
		# code...
		parent::__construct();
	}

	function cek_username($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('user');
	}

	function cek_password($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('user')->result();
	}

	function cek_tmp($username)
	{
		$this->db->select('id_tmp');
		$this->db->from('tmp');
		$this->db->join('user', 'user.id_user = tmp.id_user', 'left');
		$this->db->where('username', $username);
		return $this->db->get()->result();
	}

	function tmp()
	{
		$this->db->select('MAX(RIGHT(tmp.id_tmp,2)) AS id_tmp', FALSE);
		$this->db->order_by('id_tmp', 'Desc');
		$this->db->limit(1);
		$query = $this->db->get('tmp');

		if ($query->num_rows() > 0) {
			# code...
			$data = $query->row();
			$id = intVal($data->id_tmp) + 1;
		} else {
			$id = 1;
		}
		$batas = str_pad($id, 2, "0", STR_PAD_LEFT);
		$tmp = "TMP" . $batas;
		return $tmp;
	}
	function tambah_tmp($data_tmp)
	{
		$this->db->insert('tmp', $data_tmp);
	}

	// function hapus_tmp($id_tmp)
	// {
	// 	$this->db->delete('tmp', array('id_tmp' => $id_tmp));
	// }
	function hapus_tmp($id_user)
	{
		$this->db->delete('tmp', array('id_user' => $id_user));
	}
}

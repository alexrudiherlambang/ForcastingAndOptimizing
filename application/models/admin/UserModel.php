<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class UserModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}

		function id_user()
		{
			$this->db->select('MAX(RIGHT(user.id_user,3)) AS id_user', FALSE);
			$this->db->order_by('id_user','Desc');
			$this->db->limit(1);
			$query = $this->db->get('user');

			if ($query->num_rows() <> 0) {
				# code...
				$data = $query->row();
				$id = intVal($data->id_user) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			$id_barang_tampil = "JAS".$batas;
			return $id_barang_tampil;
		}

		public function ambil_data()
		{
			return $this->db->get('user')->result();
		}

		function tambahdata($data)
		{
			return $this->db->insert("user", $data);
		}

		function editdata($data, $id_user)
		{
			$this->db->where('id_user', $id_user);
			return $this->db->update('user',$data);
		}

		function hapusdata($id_user)
		{
			$this->db->where('id_user', $id_user);
			return $this->db->delete("user");
		}

		function check_username($data)
		{
			return $this->db->get_where('user', $data);
			;
		}

	}
?>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class PermintaanPasarModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}

		function id_permintaan_pasar()
		{
			$this->db->select('MAX(RIGHT(permintaan_pasar.id_permintaan_pasar,3)) AS id_permintaan_pasar', FALSE);
			$this->db->order_by('id_permintaan_pasar','Desc');
			$this->db->limit(1);
			$query = $this->db->get('permintaan_pasar');

			if ($query->num_rows() <> 0) {
				# code...
				$data = $query->row();
				$id = intVal($data->id_permintaan_pasar) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			$id_barang_tampil = "A".$batas;
			return $id_barang_tampil;
		}

		public function ambil_data()
		{
			return $this->db->get('permintaan_pasar')->result();
		}

		function tambahdata($data)
		{
			return $this->db->insert("permintaan_pasar", $data);
		}

		function editdata($data, $id_permintaan_pasar)
		{
			$this->db->where('id_permintaan_pasar', $id_permintaan_pasar);
			return $this->db->update('permintaan_pasar',$data);
		}

		function hapusdata($id_permintaan_pasar)
		{
			$this->db->where('id_permintaan_pasar', $id_permintaan_pasar);
			return $this->db->delete("permintaan_pasar");
		}
	}
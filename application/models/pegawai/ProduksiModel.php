<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class ProduksiModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}

		function id_produksi()
		{
			$this->db->select('MAX(RIGHT(produksi.id_produksi,3)) AS id_produksi', FALSE);
			$this->db->order_by('id_produksi','Desc');
			$this->db->limit(1);
			$query = $this->db->get('produksi');

			if ($query->num_rows() <> 0) {
				# code...
				$data = $query->row();
				$id = intVal($data->id_produksi) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 5,"0", STR_PAD_LEFT);
			$id_barang_tampil = "P".$batas;
			return $id_barang_tampil;
		}

		public function ambil_data()
		{
			return $this->db->get('produksi')->result();
		}

		function tambahdata($data)
		{
			return $this->db->insert("produksi", $data);
		}

		function editdata($data, $id_produksi)
		{
			$this->db->where('id_produksi', $id_produksi);
			return $this->db->update('produksi',$data);
		}

		function hapusdata($id_produksi)
		{
			$this->db->where('id_produksi', $id_produksi);
			return $this->db->delete("produksi");
		}

		function check_tanggal($tanggal)
		{
			$this->db->where('tanggal', $tanggal);
			return $this->db->get('produksi');
		}
	}
?>
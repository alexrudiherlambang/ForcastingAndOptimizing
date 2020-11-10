<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class KeuntunganModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}
		public function ambil_data()
		{
			return $this->db->get('keuntungan')->result();
		}
		function tambah_nk($data)
		{
			return $this->db->insert("nk", $data);
		}
		public function ambil_nk()
		{
			return $this->db->query("SELECT * FROM nk ORDER BY id_nk DESC LIMIT 1")->result();
		}
		function ambil_peramalan(){
			return $this->db->get('peramalan')->result();
		}
		function data_peramalan($id_peramalan)
		{
			$this->db->where("id_peramalan", $id_peramalan);
			$query 	= $this->db->get("peramalan");
			foreach ($query->result() as $key) {
			# code...
				$data =  array(
					'tahun'				=> $key->tahun,
					'kuartal'			=> $key->kuartal,
					'hasil_peramalan'	=> $key->hasil_peramalan
				);
			}
			return $data;
		}
		function tambah_keuntungan($data)
		{
			return $this->db->insert("keuntungan", $data);
		}
		function hapus_data($id_keuntungan)
		{
			$this->db->where('id_keuntungan', $id_keuntungan);
			return $this->db->delete("keuntungan");
		}
		function hapus_data_kesalahan_semua()
		{
			return $this->db->empty_table("keuntungan");
		}
	}
?>
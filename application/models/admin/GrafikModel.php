<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class GrafikModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}

		function get_data_produksi()
		{
			$query = $this->db->query("SELECT YEAR (tanggal) As tanggal,SUM(jumlah_produksi) AS jumlah_produksi FROM produksi GROUP BY YEAR (tanggal)");
	
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}

		function get_data_produksi_perbulan($tahun)
		{
        //$query = $this->db->query("SELECT YEAR (tanggal),MONTH (tanggal) As tanggal,SUM(id_penjualan) AS total_penjualan FROM penjualan GROUP BY  MONTH (tanggal)");
			$query = $this->db->query("SELECT
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=1)AND (YEAR(tanggal)=$tahun))),0) AS `Januari`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=2)AND (YEAR(tanggal)=$tahun))),0) AS `Februari`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=3)AND (YEAR(tanggal)=$tahun))),0) AS `Maret`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=4)AND (YEAR(tanggal)=$tahun))),0) AS `April`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=5)AND (YEAR(tanggal)=$tahun))),0) AS `Mei`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=6)AND (YEAR(tanggal)=$tahun))),0) AS `Juni`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=7)AND (YEAR(tanggal)=$tahun))),0) AS `Juli`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=8)AND (YEAR(tanggal)=$tahun))),0) AS `Agustus`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=9)AND (YEAR(tanggal)=$tahun))),0) AS `September`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=10)AND (YEAR(tanggal)=$tahun))),0) AS `Oktober`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=11)AND (YEAR(tanggal)=$tahun))),0) AS `November`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=12)AND (YEAR(tanggal)=$tahun))),0) AS `Desember`
				from produksi GROUP BY YEAR(tanggal) ");



			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function data_produksi_perbulan()
		{
        //$query = $this->db->query("SELECT YEAR (tanggal),MONTH (tanggal) As tanggal,SUM(id_penjualan) AS total_penjualan FROM penjualan GROUP BY  MONTH (tanggal)");
			$query = $this->db->query("SELECT
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=1)AND (YEAR(tanggal)=2019))),0) AS `Januari`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=2)AND (YEAR(tanggal)=2019))),0) AS `Februari`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=3)AND (YEAR(tanggal)=2019))),0) AS `Maret`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=4)AND (YEAR(tanggal)=2019))),0) AS `April`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=5)AND (YEAR(tanggal)=2019))),0) AS `Mei`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=6)AND (YEAR(tanggal)=2019))),0) AS `Juni`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=7)AND (YEAR(tanggal)=2019))),0) AS `Juli`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=8)AND (YEAR(tanggal)=2019))),0) AS `Agustus`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=9)AND (YEAR(tanggal)=2019))),0) AS `September`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=10)AND (YEAR(tanggal)=2019))),0) AS `Oktober`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=11)AND (YEAR(tanggal)=2019))),0) AS `November`,
				ifnull((SELECT SUM(jumlah_produksi) AS jumlah FROM produksi WHERE((Month(tanggal)=12)AND (YEAR(tanggal)=2019))),0) AS `Desember`
				from produksi GROUP BY YEAR(tanggal) ");
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function get_tahun()
		{
			//select distinct(year(tanggal)) as tahun from produksi
			$this->db->select("DISTINCT(year(tanggal)) as tahun");
			return $this->db->get('produksi')->result();
		}
	}
?>
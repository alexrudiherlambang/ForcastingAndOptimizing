<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class GrafikPeramalanModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}

		function get_data_peramalan()
		{
			$query = $this->db->query("SELECT tahun As tahun, hasil_peramalan AS jumlah FROM peramalan GROUP BY tahun");
	
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}

		function get_data_peramalan_perkuartal($tahun)
		{
        //$query = $this->db->query("SELECT YEAR (tanggal),MONTH (tanggal) As tanggal,SUM(id_penjualan) AS total_penjualan FROM penjualan GROUP BY  MONTH (tanggal)");
			$query = $this->db->query("SELECT
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=1)AND (tahun=$tahun)),0) AS `Kuartal1`,
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=2)AND (tahun=$tahun)),0) AS `Kuartal2`,
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=3)AND (tahun=$tahun)),0) AS `Kuartal3`,
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=4)AND (tahun=$tahun)),0) AS `Kuartal4`
				from peramalan GROUP BY tahun ");



			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function data_peramalan_perkuartal()
		{
        //$query = $this->db->query("SELECT YEAR (tanggal),MONTH (tanggal) As tanggal,SUM(id_penjualan) AS total_penjualan FROM penjualan GROUP BY  MONTH (tanggal)");
			$query = $this->db->query("SELECT
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=1)AND (tahun=2019)),0) AS `Kuartal1`,
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=2)AND (tahun=2019)),0) AS `Kuartal2`,
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=3)AND (tahun=2019)),0) AS `Kuartal3`,
				ifnull((SELECT hasil_peramalan AS jumlah FROM peramalan WHERE(kuartal=4)AND (tahun=2019)),0) AS `Kuartal4`
				from peramalan GROUP BY tahun ");
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
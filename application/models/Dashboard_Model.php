<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class Dashboard_Model extends CI_Model{

		function __construct()
		{
			parent::__construct();
		}

		function jumlah_user()
		{
			return $this->db->query("SELECT COUNT(id_user) AS jumlah FROM user")->result();
		}
		function jumlah_produksi_harian()
		{
			return $this->db->query("SELECT SUM(jumlah_produksi) as jumlah_produksi FROM produksi WHERE date(tanggal) = date(now())")->result();
		}
		function jumlah_produksi_bulanan()
		{
			return $this->db->query("SELECT SUM(jumlah_produksi) as jumlah_produksi FROM produksi WHERE month(tanggal) = month(now()) AND year(tanggal) = year(now())")->result();
		}
		function jumlah_produksi_tahunan()
		{
			return $this->db->query("SELECT SUM(jumlah_produksi) as jumlah_produksi FROM produksi WHERE year(tanggal) = year(now())")->result();
		}
		function hasil_peramalan()
		{
			return $this->db->query("SELECT kuartal FROM peramalan where tahun = year(curdate())")->result();
		}
	}
	?>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class PeramalanModel extends CI_Model
	{

		function __construct()
		{
			# code...
			parent::__construct();
		}
		function id_peramalan()
		{
			$this->db->select('MAX(RIGHT(peramalan.id_peramalan,3)) AS id_peramalan', FALSE);
			$this->db->order_by('id_peramalan','Desc');
			$this->db->limit(1);
			$query = $this->db->get('peramalan');

			if ($query->num_rows() <> 0) {
				# code...
				$kode = $query->row();
				$id = intVal($kode->id_peramalan) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			$id_barang_tampil = "Fc".$batas;
			return $id_barang_tampil;
		}
		function id_peramalan_trend()
		{
			$this->db->select('MAX(RIGHT(trend.id_peramalan,3)) AS id_peramalan', FALSE);
			$this->db->order_by('id_peramalan','Desc');
			$this->db->limit(1);
			$query = $this->db->get('trend');

			if ($query->num_rows() <> 0) {
				# code...
				$kode = $query->row();
				$id = intVal($kode->id_peramalan) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			$id_barang_tampil = "Fc".$batas;
			return $id_barang_tampil;
		}
		function id_peramalan_indeks_musiman()
		{
			$this->db->select('MAX(RIGHT(indeks_musiman.id_peramalan,3)) AS id_peramalan', FALSE);
			$this->db->order_by('id_peramalan','Desc');
			$this->db->limit(1);
			$query = $this->db->get('indeks_musiman');

			if ($query->num_rows() <> 0) {
				# code...
				$kode = $query->row();
				$id = intVal($kode->id_peramalan) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			$id_barang_tampil = "Fc".$batas;
			return $id_barang_tampil;
		}
		function id_peramalan_kesalahan()
		{
			$this->db->select('MAX(RIGHT(kesalahan.id_peramalan,3)) AS id_peramalan', FALSE);
			$this->db->order_by('id_peramalan','Desc');
			$this->db->limit(1);
			$query = $this->db->get('kesalahan');

			if ($query->num_rows() <> 0) {
				# code...
				$kode = $query->row();
				$id = intVal($kode->id_peramalan) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			$id_barang_tampil = "Fc".$batas;
			return $id_barang_tampil;
		}
		public function ambil_data()
		{
			//SELECT peramalan.tahun, peramalan.kuartal, peramalan.hasil_peramalan, trend.hasil_trend, indeks_musiman.hasil_indeks_musiman, kesalahan.nilai_MSE, kesalahan.nilai_MAPE FROM peramalan, trend, indeks_musiman, kesalahan WHERE peramalan.id_peramalan=trend.id_peramalan AND peramalan.id_peramalan=indeks_musiman.id_indeks_musiman AND peramalan.id_peramalan=kesalahan.id_peramalan
			$this->db->select('p.id_peramalan, p.tahun, p.kuartal, p.hasil_peramalan, t.hasil_trend, im.hasil_indeks_musiman, k.nilai_MSE, k.nilai_MAPE');
			$this->db->from("peramalan as p");
			$this->db->join('trend as t','p.id_peramalan = t.id_peramalan');
			$this->db->join('indeks_musiman as im','p.id_peramalan = im.id_peramalan');
			$this->db->join('kesalahan as k','p.id_peramalan = k.id_peramalan');
			return $this->db->get()->result();
		}
		function kuartalan($tahun, $ktl)
		{
			// select sum(jumlah_produksi)as jumlah_produksi, year(tanggal) as tahun, month(tanggal) as bulan FROM produksi where month(tanggal) BETWEEN 04 AND 06 AND year(tanggal) = 2018			
			$this->db->select('SUM(jumlah_produksi) as jumlah_produksi, year(tanggal) as tahun, month(tanggal) as kuartal');
			$condition = 'month(tanggal) BETWEEN '. $ktl;
			$this->db->where($condition);
			$this->db->where('year(tanggal)', $tahun);
			return $this->db->get('produksi')->result_array();
		}
		function tahun()
		{
			//select distinct(year(tanggal)) as tahun from produksi
			$this->db->select("DISTINCT(year(tanggal)) as tahun");
			return $this->db->get('produksi')->result();
		}
		function kuartal()
		{
			//select * from kuartal
			return $this->db->get('kuartal')->result();
		}
		function nData()
		{
			//select count(distinct(year(tanggal))) as tahun from produksi
			$this->db->select("COUNT(DISTINCT(year(tanggal))) as tahun");
			return $this->db->get('produksi')->result_array();	
		}
		function skalaX()
		{
			//Select DISTINCT(thn) as thn from skala_x
			$this->db->select("DISTINCT(thn) as thn");
			return $this->db->get('skala_x')->result();
		}
		function skalaX_kuartal()
		{
			//Select DISTINCT(krtl) as krtl from skala_x
			$this->db->select("DISTINCT(krtl) as krtl");
			return $this->db->get('skala_x')->result();
		}
		function nilai_skala($thn, $krtl)
		{		
			//select * from skala_x where thn = $thn AND krtl = $krtl
			$this->db->where('thn', $thn);
			$this->db->where('krtl', $krtl);
			// $this->db->where('nilai', $nilai);
			return $this->db->get('skala_x')->result_array();
		}
		function nilaiN()
		{
			//select count(jumlah_produksi) as jumlah_produksi from peramalan
			$this->db->select("count(jumlah_produksi)as jumlah_produksi");
			return $this->db->get('peramalan')->result();
		}
		function tambah_peramalan($data)
		{
			return $this->db->insert("peramalan", $data);
		}
		function tambah_trend($data)
		{
			return $this->db->insert("trend", $data);
		}
		function tambah_indeks_musiman($data)
		{
			return $this->db->insert("indeks_musiman", $data);
		}
		function tambah_kesalahan($data)
		{
			return $this->db->insert("kesalahan", $data);
		}
		function hapus_data($id_peramalan)
		{
			$this->db->where('id_peramalan', $id_peramalan);
			return $this->db->delete("peramalan");
		}
		function hapus_data_trend($id_peramalan)
		{
			$this->db->where('id_peramalan', $id_peramalan);
			return $this->db->delete("trend");
		}
		function hapus_data_indeks_musiman($id_peramalan)
		{
			$this->db->where('id_peramalan', $id_peramalan);
			return $this->db->delete("indeks_musiman");
		}
		function hapus_data_kesalahan($id_peramalan)
		{
			$this->db->where('id_peramalan', $id_peramalan);
			return $this->db->delete("kesalahan");
		}
		function hapus_data_semua()
		{
			return $this->db->empty_table("peramalan");
		}
		function hapus_data_trend_semua()
		{
			return $this->db->empty_table("trend");
		}
		function hapus_data_indeks_musiman_semua()
		{
			return $this->db->empty_table("indeks_musiman");
		}
		function hapus_data_kesalahan_semua()
		{
			return $this->db->empty_table("kesalahan");
		}
	}
?>
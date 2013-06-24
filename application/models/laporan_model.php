<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_model extends CI_Model
{
	function get_bm($start='',$end='')
	{
		if(empty($start) AND empty($end)) {
			$query = $this->db->query("SELECT * FROM view_barang_masuk");
		}else {
			$query = $this->db->query("SELECT * FROM view_barang_masuk WHERE bm_tgl >= '$start' AND bm_tgl <= '$end'");
		}
		return $query->result_array();
	}
	function get_bk($start='',$end='')
	{
		if(empty($start) AND empty($end)) {
			$query = $this->db->query("SELECT * FROM view_barang_keluar");
		}else {
			$query = $this->db->query("SELECT * FROM view_barang_keluar WHERE bk_tgl >= '$start' AND bk_tgl <= '$end'");
		}
		return $query->result_array();
	}
	function get_barang()
	{
		$query = $this->db->query("SELECT * FROM view_barang");
		return $query->result_array();
	}
	function get_suplier()
	{
		$query = $this->db->query("SELECT * FROM tbl_suplier");
		return $query->result_array();
	}
	function get_jenis()
	{
		$query = $this->db->query("SELECT * FROM tbl_jenis_barang");
		return $query->result_array();
	}
}

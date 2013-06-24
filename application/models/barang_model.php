<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang_model extends CI_Model
{
	//data daftar suplier dan jenis barang
	function get_suplier()
	{
		$query = $this->db->query("SELECT sp_id,sp_nama FROM tbl_suplier");
		return $query->result_array();
	}
	function get_jenis()
	{
		$query = $this->db->query("SELECT jb_id,jb_nama FROM tbl_jenis_barang");
		return $query->result_array();
	}
	//insert query
	function create($nama,$kode,$desk,$min,$harga,$vendor,$jb,$sp,$uid)
	{
		$result = mysql_query("INSERT INTO tbl_barang SET brg_nama='$nama',brg_kode='$kode',brg_deskripsi='$desk',brg_min_stok='$min',brg_harga_satuan='$harga',brg_vendor='$vendor',jb_id='$jb',sp_id='$sp',user_id='$uid'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	//read query
	function get_detail($id)
	{
		$query = mysql_query("SELECT * FROM tbl_barang WHERE brg_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	//view query
	function get_view($id)
	{
		$query = mysql_query("SELECT * FROM view_barang WHERE brg_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}	
	//update query
	function update($nama,$kode,$desk,$min,$harga,$vendor,$jb,$sp,$id)
	{
		$result = mysql_query("UPDATE tbl_barang SET brg_nama='$nama',brg_kode='$kode',brg_deskripsi='$desk',brg_min_stok='$min',brg_harga_satuan='$harga',brg_vendor='$vendor',jb_id='$jb',sp_id='$sp' WHERE brg_id='$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//delete query
	function delete($id)
	{
		$result = mysql_query("DELETE FROM tbl_barang WHERE brg_id = '$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

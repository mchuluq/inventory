<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenis_barang_model extends CI_Model
{
	function create($nama,$desk)
	{
		$result = mysql_query("INSERT INTO tbl_jenis_barang SET jb_nama='$nama',jb_deskripsi='$desk'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function get_detail($id)
	{
		$query = mysql_query("SELECT * FROM tbl_jenis_barang WHERE jb_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	function update($id,$nama,$desk)
	{
		$result = mysql_query("UPDATE tbl_jenis_barang SET jb_nama='$nama',jb_deskripsi='$desk' WHERE jb_id='$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function delete($id)
	{
		$result = mysql_query("DELETE FROM tbl_jenis_barang WHERE jb_id = '$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
}

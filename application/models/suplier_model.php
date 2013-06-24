<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suplier_model extends CI_Model
{
	function create($nama,$alamat,$kota,$telp,$fax,$email,$url,$ket)
	{
		$result = mysql_query("INSERT INTO tbl_suplier SET sp_nama='$nama',sp_alamat='$alamat',sp_kota='$kota',sp_telp='$telp',sp_fax='$fax',sp_email='$email',sp_url='$url',sp_keterangan='$ket'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function get_detail($id)
	{
		$query = mysql_query("SELECT * FROM tbl_suplier WHERE sp_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	function update($id,$nama,$alamat,$kota,$telp,$fax,$email,$url,$ket)
	{
		$result = mysql_query("UPDATE tbl_suplier SET sp_nama='$nama',sp_alamat='$alamat',sp_kota='$kota',sp_telp='$telp',sp_fax='$fax',sp_email='$email',sp_url='$url',sp_keterangan='$ket' WHERE sp_id='$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function delete($id)
	{
		$result = mysql_query("DELETE FROM tbl_suplier WHERE sp_id = '$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang_masuk_model extends CI_Model
{
	//read query
	function get_barang($id)
	{
		$query = mysql_query("SELECT * FROM tbl_barang WHERE brg_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	//insert query
	function create($id_f,$kode,$tgl,$jumlah,$ket,$time,$uid)
	{
		$result = mysql_query("INSERT INTO tbl_barang_masuk SET bm_kode='$kode',bm_jumlah='$jumlah',bm_keterangan='$ket',bm_tgl='$tgl',bm_time='$time',brg_id='$id_f',user_id='$uid'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//delete query
	function delete($id)
	{
		$result = mysql_query("DELETE FROM tbl_barang_masuk WHERE bm_id = '$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

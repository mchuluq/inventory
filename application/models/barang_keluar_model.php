<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang_keluar_model extends CI_Model
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
		$result = mysql_query("INSERT INTO tbl_barang_keluar SET bk_kode='$kode',bk_jumlah='$jumlah',bk_keterangan='$ket',bk_tgl='$tgl',bk_time='$time',brg_id='$id_f',user_id='$uid'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//delete query
	function delete($id)
	{
		$result = mysql_query("DELETE FROM tbl_barang_keluar WHERE bk_id = '$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

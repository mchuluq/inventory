<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_model extends CI_Model
{
	//jenis barang data
	function jb_list($limit,$offset,$search)
	{
		if(empty($search))
		{
			$query = $this->db->query("SELECT * FROM tbl_jenis_barang ORDER BY jb_id DESC LIMIT $offset, $limit");
		}else 
		{
			$query = $this->db->query("SELECT * FROM tbl_jenis_barang WHERE jb_nama LIKE '%$search%' OR jb_deskripsi LIKE '%$search%' ORDER BY jb_id DESC LIMIT $offset, $limit");
		}
		return $query->result_array();
	}
	//menghitung jumlah jenis barang
	function jb_count($search)
	{
		if(empty($search))
		{
			return $this->db->count_all_results('tbl_jenis_barang');
		}else
		{
			$query = $this->db->query("SELECT * FROM tbl_jenis_barang WHERE jb_nama LIKE '%$search%' OR jb_deskripsi LIKE '%$search%'");
			return $query->num_rows();
		}
	}
	
	
	//suplier
	function sp_list($limit,$offset,$search)
	{
		if(empty($search))
		{
			$query = $this->db->query("SELECT * FROM tbl_suplier ORDER BY sp_id DESC LIMIT $offset, $limit");
		}else
		{
			$query = $this->db->query("SELECT * FROM tbl_suplier WHERE sp_nama LIKE '%$search%' OR sp_alamat LIKE '%$search%' OR sp_kota LIKE '%$search%' OR sp_telp LIKE '%$search%' OR sp_fax LIKE '%$search%' OR sp_email LIKE '%$search%' OR sp_url LIKE '%$search%' OR sp_keterangan LIKE '%$search%' ORDER BY sp_id DESC LIMIT $offset, $limit");
		}
		return $query->result_array();
	}
	//menghitung jumlah suplier
	function sp_count($search)
	{
		if(empty($search))
		{
			return $this->db->count_all_results('tbl_suplier');
		}else
		{
			$query = $this->db->query("SELECT * FROM tbl_suplier WHERE sp_nama LIKE '%$search%' OR sp_alamat LIKE '%$search%' OR sp_kota LIKE '%$search%' OR sp_telp LIKE '%$search%' OR sp_fax LIKE '%$search%' OR sp_email LIKE '%$search%' OR sp_url LIKE '%$search%' OR sp_keterangan LIKE '%$search%'");
			return $query->num_rows();
		}
	}
	
	
	//barang
	function brg_list($limit,$offset,$search)
	{
		if(empty($search))
		{
			$query = $this->db->query("SELECT * FROM view_barang ORDER BY brg_id DESC LIMIT $offset, $limit");
		}else
		{
			$query = $this->db->query("SELECT * FROM view_barang WHERE brg_nama LIKE '%$search%' OR brg_deskripsi LIKE '%$search%' OR brg_kode LIKE '%$search%' OR brg_harga_satuan LIKE '%$search%' OR brg_vendor LIKE '%$search%' OR jb_nama LIKE '%$search%' OR sp_nama LIKE '%$search%' ORDER BY brg_id DESC LIMIT $offset, $limit");
		}
		return $query->result_array();
	}
	//menghitung jumlah barang
	function brg_count($search)
	{
		if(empty($search))
		{
			return $this->db->count_all_results('view_barang');
		}else
		{
			$query = $this->db->query("SELECT * FROM view_barang WHERE brg_nama LIKE '%$search%' OR brg_deskripsi LIKE '%$search%' OR brg_kode LIKE '%$search%' OR brg_harga_satuan LIKE '%$search%' OR brg_vendor LIKE '%$search%' OR jb_nama LIKE '%$search%' OR sp_nama LIKE '%$search%'");
			return $query->num_rows();
		}
	}
	
	
	//barang masuk
	function bm_list($limit,$offset,$search)
	{
		if(empty($search))
		{
			$query = $this->db->query("SELECT * FROM view_barang_masuk ORDER BY bm_id DESC LIMIT $offset, $limit");
		}else
		{
			$query = $this->db->query("SELECT * FROM view_barang_masuk WHERE bm_kode LIKE '%$search%' OR bm_jumlah LIKE '%$search%' OR bm_keterangan LIKE '%$search%' OR brg_nama LIKE '%$search%' OR user_name LIKE '%$search%' ORDER BY bm_id DESC LIMIT $offset, $limit");
		}
		return $query->result_array();
	}
	//menghitung jumlah barang masuk
	function bm_count($search)
	{
		if(empty($search))
		{
			return $this->db->count_all_results('view_barang_masuk');
		}else
		{
			$query = $this->db->query("SELECT * FROM view_barang_masuk WHERE bm_kode LIKE '%$search%' OR bm_jumlah LIKE '%$search%' OR bm_keterangan LIKE '%$search%' OR brg_nama LIKE '%$search%' OR user_name LIKE '%$search%'");
			return $query->num_rows();
		}
	}
	
	
	//barang keluar
	function bk_list($limit,$offset,$search)
	{
		if(empty($search))
		{
			$query = $this->db->query("SELECT * FROM view_barang_keluar ORDER BY bk_id DESC LIMIT $offset, $limit");
		}else
		{
			$query = $this->db->query("SELECT * FROM view_barang_keluar WHERE bk_kode LIKE '%$search%' OR bk_jumlah LIKE '%$search%' OR bk_keterangan LIKE '%$search%' OR brg_nama LIKE '%$search%' OR user_name LIKE '%$search%' ORDER BY bk_id DESC LIMIT $offset, $limit");
		}
		return $query->result_array();
	}
	//menghitung jumlah barang keluar
	function bk_count($search)
	{
		if(empty($search))
		{
			return $this->db->count_all_results('view_barang_keluar');
		}else
		{
			$query = $this->db->query("SELECT * FROM view_barang_keluar WHERE bk_kode LIKE '%$search%' OR bk_jumlah LIKE '%$search%' OR bk_keterangan LIKE '%$search%' OR brg_nama LIKE '%$search%' OR user_name LIKE '%$search%'");
			return $query->num_rows();
		}
	}
	
	
	//aktifitas barang
	function act_list($limit,$offset,$search)
	{
		if(empty($search))
		{
			$query = $this->db->query("SELECT * FROM view_log ORDER BY log_time DESC LIMIT $offset, $limit");
		}else
		{
			$query = $this->db->query("SELECT * FROM view_log WHERE brg_nama LIKE '%$search%' OR log_content LIKE '%$search%' OR user_name LIKE '%$search%' ORDER BY log_time DESC LIMIT $offset, $limit");
		}
		return $query->result_array();
	}
	//menghitung aktifitas barang
	function act_count($search)
	{
		if(empty($search))
		{
			return $this->db->count_all_results('view_log');
		}else
		{
			$query = $this->db->query("SELECT * FROM view_log WHERE brg_nama LIKE '%$search%' OR log_content LIKE '%$search%' OR user_name LIKE '%$search%'");
			return $query->num_rows();
		}
	} 
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller
{
	//constructor
	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_model');
		$this->load->helper('date');
		$this->dpp = $this->data_per_page('1');
		if(!$this->is_ajax_page())
		{
			show_404();
		};
	}
	//mendapatkan value config untuk tampilan data perhalaman 
	private function data_per_page($id)
	{
		$query = mysql_query("SELECT data_per_page FROM app_config WHERE config_id='$id'");
		$hasil = mysql_fetch_array($query);
		return $hasil[0];
	}
	//mengecek apakah dipanggil dengan metode ajax
	private function is_ajax_page()
	{
		return ($this->input->server('HTTP_X_REQUESTED_WITH')&&($this->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
	}
	// data jenis barang
	function jenis_barang($offset = 0,$search='')
	{
		$data['data']= $this->Data_model->jb_list($this->dpp, $offset, $search);
		$data['offset'] = $offset;
		$this->load->library('ajax_pagination');
			$config['base_url'] = site_url('data/jenis_barang');
			$config['per_page'] = $this->dpp;
			$config['uri_segment'] = 3;
			$config['total_rows'] = $this->Data_model->jb_count($search);
		$data['keyword'] = $search;
		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['jumlah'] = $config['total_rows'];
		$data['stat'] = $this->ajax_pagination->stat_data();
		$this->load->view('data/jb_data',$data);
	}	
	//data suplier
	function suplier($offset = 0,$search='')
	{
		$data['data']= $this->Data_model->sp_list($this->dpp, $offset, $search);
		$data['offset'] = $offset;
		$this->load->library('ajax_pagination');
		$config['base_url'] = site_url('data/suplier');
		$config['per_page'] = $this->dpp;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->Data_model->sp_count($search);
		$data['keyword'] = $search;
		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['jumlah'] = $config['total_rows'];
		$data['stat'] = $this->ajax_pagination->stat_data();
		$this->load->view('data/sp_data',$data);
	}
	//data barang
	function barang($offset = 0,$search='')
	{
		$data['data']= $this->Data_model->brg_list($this->dpp, $offset, $search);
		$data['offset'] = $offset;
		$this->load->library('ajax_pagination');
		$config['base_url'] = site_url('data/barang');
		$config['per_page'] = $this->dpp;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->Data_model->brg_count($search);
		$data['keyword'] = $search;
		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['jumlah'] = $config['total_rows'];
		$data['stat'] = $this->ajax_pagination->stat_data();
		$this->load->view('data/brg_data',$data);
	}
	//data barang masuk
	function barang_masuk($offset = 0,$search='')
	{
		$data['data']= $this->Data_model->bm_list($this->dpp, $offset, $search);
		$data['offset'] = $offset;
		$this->load->library('ajax_pagination');
		$config['base_url'] = site_url('data/barang_masuk');
		$config['per_page'] = $this->dpp;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->Data_model->bm_count($search);
		$data['keyword'] = $search;
		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['jumlah'] = $config['total_rows'];
		$data['stat'] = $this->ajax_pagination->stat_data();
		$this->load->view('data/bm_data',$data);
	}
	//data barang keluar
	function barang_keluar($offset = 0,$search='')
	{
		$data['data']= $this->Data_model->bk_list($this->dpp, $offset, $search);
		$data['offset'] = $offset;
		$this->load->library('ajax_pagination');
		$config['base_url'] = site_url('data/barang_keluar');
		$config['per_page'] = $this->dpp;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->Data_model->bk_count($search);
		$data['keyword'] = $search;
		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['jumlah'] = $config['total_rows'];
		$data['stat'] = $this->ajax_pagination->stat_data();
		$this->load->view('data/bk_data',$data);
	}
	function aktifitas($offset = 0,$search='')
	{
		$data['data']= $this->Data_model->act_list($this->dpp, $offset, $search);
		$data['offset'] = $offset;
		$this->load->library('ajax_pagination');
		$config['base_url'] = site_url('data/aktifitas');
		$config['per_page'] = $this->dpp;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->Data_model->act_count($search);
		$data['keyword'] = $search;
		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['jumlah'] = $config['total_rows'];
		$data['stat'] = $this->ajax_pagination->stat_data();
		$this->load->view('data/act_data',$data);
	}
}

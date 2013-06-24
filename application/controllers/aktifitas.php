<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class aktifitas extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		//$this->load->model('Aktifitas_model');
		$this->load->helper(array('MY_tinymce','date'));
	}
	
	function index()
	{
		$data['title'] = "aktifitas barang";
		$this->template_ui->display('page/index/act_data',$data);
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tentang extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
	}
	
	function index()
	{
		$data['title'] = "Tentang Aplikasi Ini";
		$this->template_ui->display('page/spec/tentang',$data);
	}
	function credits()
	{
		$data['title'] = "Credits";
		$this->template_ui->display('page/spec/credits',$data);
	}
	
	
}

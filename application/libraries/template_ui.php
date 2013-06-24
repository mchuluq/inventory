<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template_ui
{	
	function __construct()
	{
		$this->_ci =& get_instance();
	}
	
	function is_ajax()
	{
		return ($this->_ci->input->server('HTTP_X_REQUESTED_WITH')&&($this->_ci->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
	}
	
	function display($page,$data=null)
	{
		$data['_color']=$this->_ci->session->userdata('user_theme');
		$data['_embed']=$this->_ci->load->view('template/embed',$data, true);
		$data['_sider']=$this->_ci->load->view('template/sider',$data, true);
		$data['_header']=$this->_ci->load->view('template/header',$data, true);
		$data['_footer']=$this->_ci->load->view('template/footer',$data, true);
		$data['_alert']=$this->_ci->load->view('template/alert',$data, true);	
		$data['_bc']=$this->breadcrumbs();
		$this->_ci->load->view($page,$data);
	}
	function breadcrumbs()
	{
		$class = str_replace("_"," ",$this->_ci->uri->rsegment(1));
		$method = str_replace("_","",$this->_ci->uri->rsegment(2));
		return "<a>Inventory</a> &raquo; <a>".$class."</a> &raquo; <a>".$method."</a>";
	}
	function get_company()
	{
		$query = mysql_query("SELECT company_name FROM app_config WHERE config_id = 1");
		$result = mysql_fetch_array($query);
		return $result[0]; 
	}
	
	
}


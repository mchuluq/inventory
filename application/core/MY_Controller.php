<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_Controller extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('Access_control');
		if(!$this->access_control->is_login())
		{
			redirect('front/login');
		}elseif(!$this->check_access()){
			show_error('Directory Access Is Forbidden');
		}
	}	
	function check_access()
	{
		return $this->access_control->check_access();
	}
	function is_login()
	{
		return $this->access_control->is_login();
	}
}

class MY_Controlller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
}

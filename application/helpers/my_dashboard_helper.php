<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function get_widget($data)
{
	$CI =& get_instance();
	$wtitle = str_replace(" ", "", $data);
	$CI->load->view('widget/'.$wtitle);
}

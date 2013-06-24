<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Access_control {
	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	function do_login($username,$password)
	{
		$crypt_pass = $this->crypting_pass($password);
		$query = mysql_query("SELECT * FROM user_member WHERE user_name = '$username' AND user_status = 'enable'");
		$data = mysql_fetch_array($query);
		if($data['user_pass'] == $crypt_pass)
		{
			$logData = array(
					'log_status' => TRUE,
					'user_id' => $data['user_id'],
					'user_name' => $data['user_name'],
					'group_name' => $data['group_name'],
					'user_theme' => $data['user_theme'],
					'user_photo' => $data['user_photo']);
			$this->update_last_login($data['user_id']);
			$this->CI->session->set_userdata($logData);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function crypting_pass($pass)
	{
		$key = $this->CI->config->item('encryption_key');
		$key2 = md5($pass);
		$encrypted = sha1($key.$key2);
		return $encrypted;
	}
	function update_last_login($id)
	{
		$date = date("Y-m-d");
		mysql_query("UPDATE user_member SET user_last_login='$date' WHERE user_id='$id'");
	}
	
	function logout()
	{
		$this->CI->session->sess_destroy();
	}
	function check_access()
	{
		$class = $this->CI->uri->rsegment(1);
		$method = $this->CI->uri->rsegment(2);
		$current_class_method = $class.'.'.$method;
		$free_class = array('dashboard','data','profile','tentang');
		$group = $this->CI->session->userdata('group_name');
		$query = mysql_query("SELECT * FROM user_role WHERE rule_class_method = '$current_class_method' AND group_name = '$group'");
		$query_2 = mysql_query("SELECT * FROM user_role WHERE rule_class_method = 'root.' AND group_name = '$group'");
		$num = mysql_num_rows($query);
		$num_2 = mysql_num_rows($query_2);
		
		if(in_array($class,$free_class))
		{
			return TRUE;
		}
		elseif($num > 0)
		{
			return TRUE;
		}
		elseif($num_2 > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function is_login()
	{
		return (($this->CI->session->userdata('log_status'))? TRUE : FALSE);
	}
}













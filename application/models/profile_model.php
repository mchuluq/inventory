<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model
{
	function get_profile($id)
	{
		$query = mysql_query("SELECT * FROM user_member WHERE user_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	function update_profile($fullname,$name,$theme,$profile_id)
	{
		$result = mysql_query("UPDATE user_member SET user_fullname='$fullname',user_name='$name',user_theme='$theme' WHERE user_id='$profile_id'");
		$logData = array('user_name' => $name,'user_theme' => $theme);
		$update_session = $this->session->set_userdata($logData);
		if(($result) OR ($update_session)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function check_pass($pass,$id)
	{
		$query = mysql_query("SELECT user_pass FROM user_member WHERE user_id ='$id'");
		$data = mysql_fetch_array($query);
		if($data['user_pass'] == $pass)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function update_password($new_pass_1,$profile_id)
	{
		$result = mysql_query("UPDATE user_member SET user_pass='$new_pass_1' WHERE user_id='$profile_id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function update_photo($filename,$id)
	{
		$result = mysql_query("UPDATE user_member SET user_photo='$filename' WHERE user_id='$id'");
		$logData = array('user_photo' => $filename);
		$update_session = $this->session->set_userdata($logData);
		if(($result) OR ($update_session)){
			return TRUE;
		}else{
			return FALSE;
		}
	}		
}

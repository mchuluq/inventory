<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front_model extends CI_Model
{
	function sign_up($fullname,$name,$pass)
	{
		$result = mysql_query("CALL create_user_member('$fullname','$name','$pass')");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}
		
}

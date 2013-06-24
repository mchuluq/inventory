<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config_model extends CI_Model
{
	function get_current_config($id)
	{
		$query = mysql_query("SELECT * FROM app_config WHERE config_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	
	function get_group_list()
	{
		$query = $this->db->query("SELECT group_name FROM user_group");
		return $query->result_array();
	}
	
	
	
	function update_config($dpp,$def_g,$com_name,$id)
	{
		$result = mysql_query("UPDATE app_config SET data_per_page ='$dpp',default_group='$def_g',company_name='$com_name' WHERE config_id='$id'");
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	
}

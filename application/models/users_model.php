<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model
{
	function get_detail_user($id)
	{
		$query = mysql_query("SELECT * FROM user_member WHERE user_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	
	function get_group_list()
	{
		$query = $this->db->query("SELECT group_name FROM user_group");
		return $query->result_array();
	}
	
	function get_rule_cm()
	{
		$query = $this->db->query("SELECT * FROM user_rule ORDER BY rule_class ASC");
		return $query->result_array();
	}
	
	function create_role($rule,$group)
	{
		$result = mysql_query("INSERT INTO user_role SET rule_class_method='$rule',group_name='$group'")or die(mysql_error());
		if($result){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function delete_role($id)
	{
		$result = mysql_query("DELETE FROM user_role WHERE role_id ='$id'");
		if($result)
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}
	
	function update_user($id,$status,$group)
	{
		$query = mysql_query("UPDATE user_member SET user_status='$status',group_name='$group' WHERE user_id='$id'");
		if($query)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function create_group($name,$desc)
	{
		$result = mysql_query("INSERT INTO user_group SET group_name='$name',group_description='$desc'");
		if($result)
		{
			return TRUE;
		}else 
		{
			return FALSE;
		}
	}

	function get_detail_group($id)
	{
		$query = mysql_query("SELECT * FROM user_group WHERE group_id = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	
	function update_group($name,$desc,$id)
	{
		$result = mysql_query("UPDATE user_group SET group_name='$name',group_description='$desc' WHERE group_id='$id'");
		if($result)
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}

	function delete_group($id)
	{
		$result = mysql_query("DELETE FROM user_group WHERE group_id ='$id'");
		if($result)
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}

	function change_user_status($id)
	{
		$check = mysql_query("SELECT user_status FROM user_member WHERE user_id='$id'");
		$status = mysql_fetch_array($check);
		switch ($status['user_status']){
			case "enable" :
				$query = mysql_query("UPDATE user_member SET user_status = 'disable' WHERE user_id='$id'");
				break;
			case "disable" :
				$query = mysql_query("UPDATE user_member SET user_status = 'enable' WHERE user_id='$id'");
				break;
		}
		if($query)
		{
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function delete_user($id)
	{
		$result = mysql_query("DELETE FROM user_member WHERE user_id ='$id'");
		if($result)
		{
			return TRUE;
		}else
		{
			return FALSE;
		}
	}
}

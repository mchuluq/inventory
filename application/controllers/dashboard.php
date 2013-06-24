<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation','user_agent'));
		$this->load->helper(array('my_dashboard','date'));
	}
	
	function index()
	{
		$data['title'] = "Dashboard";
		$this->template_ui->display('page/spec/dashboard',$data);
	}
	
	function update_widget()
	{
		if(!$_POST["data"]){
			echo "Invalid data";
			exit;
		}
		$data=json_decode($_POST["data"]);
		foreach($data->items as $item)
		{
			$col_id=preg_replace('/[^\d\s]/', '', $item->column);
			$widget_id=preg_replace('/[^\d\s]/', '', $item->id);
			$sql="UPDATE i_widget SET column_id='$col_id', sort_no='".$item->order."', collapsed='".$item->collapsed."' WHERE id='".$widget_id."'";
			mysql_query($sql) or die('Error updating widget DB');
		}
		echo "success";
	}
	
	
}

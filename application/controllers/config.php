<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Config_model');
	}
	
	function index()
	{
		$data['title'] = "Konfigurasi Sistem";
		$data['conf'] = $this->Config_model->get_current_config('1');
		$data['group'] = $this->Config_model->get_group_list();
		
		
		$this->form_validation->set_rules('data_per_page','data per halaman','required');
		$this->form_validation->set_rules('default_group','default group','required|max_length[20]');
		$this->form_validation->set_rules('company_name','nama perusahaan','required|max_length[50]');
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/spec/config',$data);
		} else
		{
			$dpp= $this->input->post('data_per_page');
			$def_g= $this->input->post('default_group');
			$com_name= $this->input->post('company_name');
			$id=$this->input->post('config_id');
			$update = $this->Config_model->update_config($dpp,$def_g,$com_name,$id);
		
			if($update){
				$this->session->set_flashdata('success','konfigurasi telah disimpan');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('config');
		}
	}
	
	
}

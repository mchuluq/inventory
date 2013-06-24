<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Users_model');
		$this->load->helper('my_tinymce');
	}
	
	function index()
	{
		$data['title'] = "User Control";
		$this->template_ui->display('page/index/users_data',$data);
	}

	function update_user($id)
	{
		$data['user'] = $this->Users_model->get_detail_user($id);
		if((!isset($id)) OR (!$data['user'])) {show_error('Parameter Error'); };

		$data['group'] = $this->Users_model->get_group_list();
		$this->form_validation->set_rules('user_status','status','required');
		$this->form_validation->set_rules('user_id','id','required');
		$this->form_validation->set_rules('group_name','group','required');
		if ($this->form_validation->run()== FALSE) {
			$this->load->view('page/form/user_update',$data);
		} else
		{
			$id_f= $this->input->post('user_id');
			$status= $this->input->post('user_status');
			$group= $this->input->post('group_name');
			$update_user = $this->Users_model->update_user($id_f,$status,$group);
		
			if($update_user){
				$this->session->set_flashdata('success','users telah diubah');
			}else {
				$this->session->set_flashdata('error','tidak dapat mengubah');
			}
			redirect('users');
		}
	}

	function add_role()
	{
		$data['group'] = $this->Users_model->get_group_list();
		$data['rule'] = $this->Users_model->get_rule_cm();
		
		$this->form_validation->set_rules('rule_class_method','role','required');
		$this->form_validation->set_rules('group_name','group','required');
		if ($this->form_validation->run()== FALSE) {
			$this->load->view('page/form/user_role_form',$data);
		} else
		{
			$group= $this->input->post('group_name');
			$rule= $this->input->post('rule_class_method');
			$add_role = $this->Users_model->create_role($rule,$group);
		
			if($add_role){
				$this->session->set_flashdata('success','role telah ditambah');
			}else {
				$this->session->set_flashdata('error','tidak dapat menambah');
			}
			redirect('users');
		}
	}
	
	function delete_role($id)
	{
		if(!isset($id)) {show_error('Parameter Error'); };
		$delete_role = $this->Users_model->delete_role($id);
		if($delete_role){
			$this->session->set_flashdata('success','role telah dihapus');
		}else {
			$this->session->set_flashdata('error','role tidak dapat dihapus');
		}
		redirect('users');
	}

	function create_group()
	{
		$data['detil_g'] = array('group_name' => "",'group_id' => "",'group_description' => "");
		$data['action'] = base_url('users/create_group');
		$data['title']="buat group";
		$this->form_validation->set_rules('group_name','nama group','required|max_length[20]');
		if ($this->form_validation->run()== FALSE) {
			$this->load->view('page/form/user_group_form',$data);
		} else
		{
			$nama= $this->input->post('group_name');
			$desk= $this->input->post('group_description');
			$create = $this->Users_model->create_group($nama,$desk);
				
			if($create){
				$this->session->set_flashdata('success','group baru telah dibuat');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('users');
		}
	}

	function update_group($id)
	{
		$data['detil_g'] = $this->Users_model->get_detail_group($id);
		$data['action'] = base_url('users/update_group/'.$id);
		$data['title']="ubah group &rsaquo; ".$data['detil_g']['group_name'];
		$this->form_validation->set_rules('group_name','nama group','required|max_length[20]');
		if ($this->form_validation->run()== FALSE) {
			$this->load->view('page/form/user_group_form',$data);
		} else
		{
			$nama= $this->input->post('group_name');
			$desk= $this->input->post('group_description');
			$id_f= $this->input->post('group_id');
			$update = $this->Users_model->update_group($nama,$desk,$id_f);
			if ($this->session->userdata('group_name') == $data['detil_g']['group_name'])
			{
				$this->session->set_userdata('group_name',$nama);
			}
	
			if($update){
				$this->session->set_flashdata('success','detil group telah diperbarui');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('users');
		}
	}
	
	function delete_group($id)
	{
		if(!isset($id)) {show_error('Parameter Error'); };
		$delete_group = $this->Users_model->delete_group($id);
		if($delete_group){
			$this->session->set_flashdata('success','group telah dihapus');
		}else {
			$this->session->set_flashdata('error','group tidak dapat dihapus');
		}
		redirect('users');
	}
	
	function delete_user($id)
	{
		if(!isset($id)) {show_error('Parameter Error'); };
		$delete_user = $this->Users_model->delete_user($id);
		if($delete_user){
			$this->session->set_flashdata('success','user telah dihapus');
		}else {
			$this->session->set_flashdata('error','user tidak dapat dihapus');
		}
		redirect('users');
	}

	function status_user($id)
	{
		if(!isset($id)) {show_error('Parameter Error'); };
		$change = $this->Users_model->change_user_status($id);
		if($change){
			$this->session->set_flashdata('success','status user telah diubah');
		}else {
			$this->session->set_flashdata('error','tidak dapat mengubah status user');
		}
		redirect('users');
	}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Profile_model');
	}
	
	function index()
	{
		$data['det_prof'] = $this->Profile_model->get_profile($this->session->userdata('user_id'));
		$data['title']="Profile &raquo; ".$this->session->userdata('user_name');
		$data['theme'] = array('black','blueopal','bootstrap','default','highcontrast','metro','metroblack','moonlight','silver','uniform');
		$this->template_ui->display('page/form/profile_form',$data);
	}
	
	function update_profile()
	{
		$this->form_validation->set_rules('user_fullname','nama lengkap','required|max_length[100]');
		$this->form_validation->set_rules('user_name','username','required|max_length[15]');
		if ($this->form_validation->run()== FALSE) {
			redirect('profile');
		} else
		{
			$profile_id = $this->session->userdata('user_id');
			$fullname= $this->input->post('user_fullname');
			$name= $this->input->post('user_name');
			$theme= $this->input->post('user_theme');
			$update = $this->Profile_model->update_profile($fullname,$name,$theme,$profile_id);		
			if($update){
				$this->session->set_flashdata('success','profile anda telah diperbarui');
			}else {
				$this->session->set_flashdata('error','tidak dapat memperbarui profile');
			}
			redirect('profile');
		}
	}
	function update_password()
	{
		$this->form_validation->set_rules('old_pass','password lama','required|max_length[20]');
		$this->form_validation->set_rules('new_pass_1','password baru','required|max_length[20]');
		$this->form_validation->set_rules('new_pass_2','ulangi password baru','required|max_length[20]|matches[new_pass_1]');
		if ($this->form_validation->run()== FALSE) {
			redirect('profile');
		} else
		{
			$profile_id = $this->session->userdata('user_id');
			$old_pass = $this->access_control->crypting_pass($this->input->post('old_pass'));
			$new_pass_1= $this->access_control->crypting_pass($this->input->post('new_pass_1'));
			
			$check = $this->Profile_model->check_pass($old_pass,$profile_id);
			if($check)
			{
				$update = $this->Profile_model->update_password($new_pass_1,$profile_id);
				if($update){
					$this->session->set_flashdata('success','password anda telah diperbarui');
				}else {
					$this->session->set_flashdata('error','tidak dapat memperbarui password');
				}
				redirect('profile');
			}else{
				$this->session->set_flashdata('error','password lama tidak dikenal');
				redirect('profile');
			}
		}
	}
	function update_photo()
    {	
    	$config['upload_path'] = './storage/temp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '512';
		$config['overwrite']= TRUE;
		$config['remove_spaces']= TRUE;
	
		$this->load->library('upload', $config);
		$data['message']='';
		if(!$this->upload->do_upload())
		{
			if(isset($_POST['SubmitFile']))
			$data['message'] = $this->upload->display_errors();
		}
		else 
		{
			$data['upload_data'] = $this->upload->data();
			$data['message'] = 'file has been upload succesfully';
			$config_resize['image_libarary'] = 'gd2';
			$config_resize['source_image'] = $data['upload_data']['full_path'];
			$config_resize['new_image'] = './storage/profile/';
			$config_resize['maintain_ratio'] = FALSE; 
			$config_resize['width'] = 50;
			$config_resize['height'] = 50;		
			$this->load->library('image_lib', $config_resize);
			$this->image_lib->resize();
			
			if(!$this->image_lib->resize())
			{
				$data['message'] = $this->image_lib->display_errors();
			}else{
				$profile_id = $this->session->userdata('user_id');
				$filename = $data['upload_data']['file_name'];
				$update = $this->Profile_model->update_photo($filename,$profile_id);
				unlink($data['upload_data']['full_path']);
			}
		}
		$this->session->set_flashdata('info',$data['message']);
		redirect('profile');
    }
}

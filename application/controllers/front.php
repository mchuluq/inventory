<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation','access_control'));
		$this->load->model('Front_model');
		$this->load->helper('form');
	}
	
	function index()
	{
		$data['title'] = "welcome !!!";
		$this->template_ui->display('page/spec/front_gate',$data);
	}
	
	function login()
	{
		$data['title'] = "login";
		$this->template_ui->display('page/spec/front_login',$data);
	}

	function sign_in()
	{
		$this->form_validation->set_rules('username','Username','required|max_length[20]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<div class="log_stat">','</div>');
		if($this->form_validation->run() == FALSE)
		{
			redirect("front/login");
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$log = $this->access_control->do_login($username, $password);
			if($log)
			{
				$this->session->set_flashdata('info','selamat datang '.$username);
				redirect("dashboard");
			}
			else
			{
				$this->session->set_flashdata('log_stat','username atau password tidak dikenal');
				redirect("front/login");
			}
		}
	}
	
	function sign_up()
	{
		$this->form_validation->set_rules('fullname','nama lengkap','required|max_length[100]');
		$this->form_validation->set_rules('username','user name','required|max_length[15]');
		$this->form_validation->set_rules('pass','password','required|max_length[20]');
		$this->form_validation->set_rules('re-pass','ulangi password','required|max_length[20]|matches[pass]');
		if ($this->form_validation->run()== FALSE) {
			redirect("front/login");
		} else
		{
			$fullname= $this->input->post('fullname');
			$username= $this->input->post('username');
			$pass= $this->access_control->crypting_pass($this->input->post('pass'));
			$signUp = $this->Front_model->sign_up($fullname,$username,$pass);
				
			if($signUp){
				$this->session->set_flashdata('sign_stat','anda berhasil sign up');
			}else {
				$this->session->set_flashdata('sign_stat','sign up gagal');
			}
			redirect('front/login');
		}
	}
	
	function sign_out()
	{
		$this->access_control->logout();
		$this->session->set_flashdata('sign_stat','anda telah log out');
		redirect("front/login");
	}
}

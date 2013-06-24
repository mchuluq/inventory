<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suplier extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Suplier_model');
		$this->load->helper('my_tinymce');
	}

	function index()
	{
		$data['title'] = "data suplier";
		$this->template_ui->display('page/index/sp_data',$data);
	}

	function create($back='')
	{
		$data['detil_sp'] = array(
								'sp_nama' => "",
								'sp_id' => "",
								'sp_keterangan' => "",
								'sp_alamat' => "",
								'sp_kota' => "",
								'sp_telp' => "",
								'sp_fax' => "",
								'sp_email' => "",
								'sp_url' => "http://");
		$data['title']="suplier baru";
		$this->_set_rules();
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/sp_form',$data);
		} else
		{
			$nama= $this->input->post('sp_nama');
			$alamat= $this->input->post('sp_alamat');
			$kota= $this->input->post('sp_kota');
			$telp= $this->input->post('sp_telp');
			$fax= $this->input->post('sp_fax');
			$email= $this->input->post('sp_email');
			$url= $this->input->post('sp_url');
			$ket= $this->input->post('sp_keterangan');
			$create = $this->Suplier_model->create($nama,$alamat,$kota,$telp,$fax,$email,$url,$ket);
				
			if($create){
				$this->session->set_flashdata('success','suplier baru telah disimpan');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			if($back==''){
				redirect('suplier');
			}else{
				redirect('barang/create');
			}			
		}
	}
	function update($id)
	{
		$data['detil_sp'] = $this->Suplier_model->get_detail($id);
		if((!isset($id)) OR (!$data['detil_sp'])) {show_error('Parameter Error'); };		
		$data['title']="ubah suplier &rsaquo; ".$data['detil_sp']['sp_nama'];
		$this->_set_rules();
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/sp_form',$data);
		} else
		{
			$id_f= $this->input->post('sp_id');
			$nama= $this->input->post('sp_nama');
			$alamat= $this->input->post('sp_alamat');
			$kota= $this->input->post('sp_kota');
			$telp= $this->input->post('sp_telp');
			$fax= $this->input->post('sp_fax');
			$email= $this->input->post('sp_email');
			$url= $this->input->post('sp_url');
			$ket= $this->input->post('sp_keterangan');
			$update = $this->Suplier_model->update($id_f,$nama,$alamat,$kota,$telp,$fax,$email,$url,$ket);
		
			if($update){
				$this->session->set_flashdata('success','suplier telah diubah');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('suplier');
		}
	}
	function view($id)
	{
		if(!$this->template_ui->is_ajax())
		{
			show_404();
		};
		$data['detil_sp'] = $this->Suplier_model->get_detail($id);
		if((!isset($id)) OR (!$data['detil_sp'])) {show_error('Parameter Error'); };	
		$this->load->view('page/spec/sp_view',$data);
	}
	function delete($id)
	{
		if(!isset($id)) {show_error('Parameter Error'); };
		$delete = $this->Suplier_model->delete($id);
		if($delete){
			$this->session->set_flashdata('success','suplier telah dihapus');
		}else {
			$this->session->set_flashdata('error','suplier tidak dapat dihapus');
		}
		redirect('suplier');
	}
	
	private function _set_rules()
	{
		$this->form_validation->set_rules('sp_nama','nama suplier','required|max_length[100]');
		$this->form_validation->set_rules('sp_alamat','alamat','required|max_length[100]');
		$this->form_validation->set_rules('sp_kota','kota','required|max_length[50]');
	}
}


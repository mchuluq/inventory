<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenis_barang extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Jenis_barang_model');
		$this->load->helper('MY_tinymce');
	}
	
	function index()
	{
		$data['title'] = "data jenis barang";
		$this->template_ui->display('page/index/jb_data',$data);
	}
	
	function create($back='')
	{
		$data['detil_jb'] = array('jb_nama' => "",'jb_id' => "",'jb_deskripsi' => "");
		$data['title']="tambah jenis";
		$this->form_validation->set_rules('jb_nama','nama jenis barang','required|max_length[50]');
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/jb_form',$data);
		} else
		{
			$nama= $this->input->post('jb_nama');
			$desk= $this->input->post('jb_deskripsi');
			$create = $this->Jenis_barang_model->create($nama,$desk);
			
			if($create){
				$this->session->set_flashdata('success','jenis barang baru telah disimpan');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			if($back=''){
				redirect('jenis_barang');
			}else{
				redirect('barang/create');
			}	
		}
	}
	function update($id)
	{
		$data['detil_jb'] = $this->Jenis_barang_model->get_detail($id);
		if((!isset($id)) OR (!$data['detil_jb'])) {show_error('Parameter Error'); };
		
		$data['title']="ubah jenis &rsaquo; ".$data['detil_jb']['jb_nama'];
		$this->form_validation->set_rules('jb_nama','nama jenis barang','required|max_length[50]');
		$this->form_validation->set_rules('jb_id','id jenis barang','required|numeric');
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/jb_form',$data);
		} else
		{
			$nama= $this->input->post('jb_nama');
			$id_f= $this->input->post('jb_id');
			$desk= $this->input->post('jb_deskripsi');
			$update = $this->Jenis_barang_model->update($id_f,$nama,$desk);
				
			if($update){
				$this->session->set_flashdata('success','jenis barang telah diubah');
			}else {
				$this->session->set_flashdata('error','tidak dapat mengubah');
			}
			redirect('jenis_barang');
		}
	}
	function delete($id)
	{
		if(!isset($id)) {show_error('Kesalahan Parameter'); };
		$delete = $this->Jenis_barang_model->delete($id);		
		if($delete){
			$this->session->set_flashdata('success','jenis barang telah dihapus');
		}else {
			$this->session->set_flashdata('error','jenis barang tidak dapat dihapus');
		}
		redirect('jenis_barang');
	}
}

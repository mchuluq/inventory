<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class barang extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Barang_model');
		$this->load->helper(array('MY_tinymce','date'));
	}
	
	function index()
	{
		$data['title'] = "data barang";
		$this->template_ui->display('page/index/brg_data',$data);
	}
	
	private function _set_rules()
	{
		$this->form_validation->set_rules('brg_nama','nama barang','required|max_length[100]');
		$this->form_validation->set_rules('brg_kode','kode barang','required|max_length[20]');
		$this->form_validation->set_rules('brg_min_stok','stok minimal','required');
		$this->form_validation->set_rules('brg_harga_satuan','harga satuan','required');
		$this->form_validation->set_rules('brg_vendor','vendor','required|max_length[100]');
		$this->form_validation->set_rules('brg_id','id','required');
	}
	
	function create()
	{
		$data['detil_brg'] = array(
				'brg_nama' => "",
				'brg_id' => "0",
				'brg_kode' => "",
				'brg_deskripsi' => "",
				'brg_harga_satuan' => "",
				'brg_min_stok' => "",
				'brg_vendor' => "",
				'jb_id' => "",
				'sp_id' => ""
				);
		$data['jenis'] = $this->Barang_model->get_jenis();
		$data['suplier'] = $this->Barang_model->get_suplier();
		$data['title']="Barang baru";
		$this->_set_rules();
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/brg_form',$data);
		} else
		{
			$nama= $this->input->post('brg_nama');
			$kode= $this->input->post('brg_kode');
			$desk= $this->input->post('brg_deskripsi');
			$harga= $this->input->post('brg_harga_satuan');
			$min= $this->input->post('brg_min_stok');
			$vendor= $this->input->post('brg_vendor');
			$jb= $this->input->post('jb_id');
			$sp= $this->input->post('sp_id');
			$uid= $this->session->userdata('user_id');
			$create = $this->Barang_model->create($nama,$kode,$desk,$min,$harga,$vendor,$jb,$sp,$uid);
			
			if($create){
				$this->session->set_flashdata('success','barang baru telah disimpan');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('barang');
		}
	}
	

	
	function update($id)
	{		
		$data['detil_brg'] = $this->Barang_model->get_detail($id);
		if((!isset($id)) OR (!$data['detil_brg'])) {show_error('Parameter Error'); };		
		
		$data['jenis'] = $this->Barang_model->get_jenis();
		$data['suplier'] = $this->Barang_model->get_suplier();
		$data['title']="ubah &rsaquo; ".$data['detil_brg']['brg_nama'];
		$this->_set_rules();
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/brg_form',$data);
		} else
		{
			$nama= $this->input->post('brg_nama');
			$id= $this->input->post('brg_id');
			$kode= $this->input->post('brg_kode');
			$desk= $this->input->post('brg_deskripsi');
			$harga= $this->input->post('brg_harga_satuan');
			$min= $this->input->post('brg_min_stok');
			$vendor= $this->input->post('brg_vendor');
			$jb= $this->input->post('jb_id');
			$sp= $this->input->post('sp_id');
			
			$update = $this->Barang_model->update($nama,$kode,$desk,$min,$harga,$vendor,$jb,$sp,$id);
			
			if($update){
				$this->session->set_flashdata('success','barang telah diperbarui');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('barang');
		}
	}
	
	function view($id)
	{
		if(!$this->template_ui->is_ajax())
		{
			show_404();
		};
		$data['detil_brg'] = $this->Barang_model->get_view($id);
		if((!isset($id)) OR (!$data['detil_brg'])) {show_error('Parameter Error'); };
		
		$this->load->view('page/spec/brg_view',$data);
	}
	
	function delete($id)
	{
		if(!isset($id)) {show_error('Kesalahan Parameter'); };
		$delete = $this->Barang_model->delete($id);		
		if($delete){
			$this->session->set_flashdata('success','barang telah dihapus');
		}else {
			$this->session->set_flashdata('error','barang tidak dapat dihapus');
		}
		redirect('barang');
	}
}

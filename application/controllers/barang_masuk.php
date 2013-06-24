<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class barang_masuk extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Barang_masuk_model');
		$this->load->helper(array('MY_tinymce','date'));
	}
	
	function index()
	{
		$data['title'] = "data barang masuk";
		$this->template_ui->display('page/index/bm_data',$data);
	}
	
	function create($id)
	{
		$data['detil_brg'] = $this->Barang_masuk_model->get_barang($id);
		if((!isset($id)) OR (!$data['detil_brg'])) {show_error('Parameter Error'); };
		
		$data['title']="tambah stok &rsaquo; ".$data['detil_brg']['brg_nama'];
		$this->form_validation->set_rules('bm_kode','kode','required|max_length[20]');
		$this->form_validation->set_rules('brg_id','kode barang','required');
		$this->form_validation->set_rules('bm_jumlah','jumlah','required');
		$this->form_validation->set_rules('bm_tgl','tanggal','required');
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/bm_form',$data);
		} else
		{
			$id_f= $this->input->post('brg_id');
			$kode= $this->input->post('bm_kode');
			$tgl= $this->input->post('bm_tgl');
			$jumlah= $this->input->post('bm_jumlah');
			$ket= $this->input->post('bm_keterangan');
			$time= now();
			$uid= $this->session->userdata('user_id');
			
			$create = $this->Barang_masuk_model->create($id_f,$kode,$tgl,$jumlah,$ket,$time,$uid);
			
			if($create){
				$this->session->set_flashdata('success','barang masuk telah disimpan');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('barang_masuk');
		}
	}
	

	function delete($id)
	{
		if(!isset($id)) {show_error('Parameter Error'); };
		$delete = $this->Barang_masuk_model->delete($id);		
		if($delete){
			$this->session->set_flashdata('success','catatan barang masuk telah dihapus');
		}else {
			$this->session->set_flashdata('error','tidak dapat menghapus');
		}
		redirect('barang_masuk');
	}
}

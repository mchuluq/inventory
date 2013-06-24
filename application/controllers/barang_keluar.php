<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class barang_keluar extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation'));
		$this->load->model('Barang_keluar_model');
		$this->load->helper(array('MY_tinymce','date'));
	}
	
	function index()
	{
		$data['title'] = "data barang keluar";
		$this->template_ui->display('page/index/bk_data',$data);
	}
	
	function create($id)
	{
		$data['detil_brg'] = $this->Barang_keluar_model->get_barang($id);
		if((!isset($id)) OR (!$data['detil_brg'])) {show_error('Parameter Error'); };
		
		if($data['detil_brg']['brg_stok'] == 0) {
			$data['is_allowed'] = FALSE;
		}else {
			$data['is_allowed'] = TRUE;
		}
		$data['title']="ambil barang &rsaquo; ".$data['detil_brg']['brg_nama'];
		$this->form_validation->set_rules('bk_kode','kode','required|max_length[20]');
		$this->form_validation->set_rules('brg_id','kode barang','required');
		$this->form_validation->set_rules('bk_jumlah','jumlah','required');
		$this->form_validation->set_rules('bk_tgl','tanggal','required');
		if ($this->form_validation->run()== FALSE) {
			$this->template_ui->display('page/form/bk_form',$data);
		} else
		{
			$id_f= $this->input->post('brg_id');
			$kode= $this->input->post('bk_kode');
			$tgl= $this->input->post('bk_tgl');
			$jumlah= $this->input->post('bk_jumlah');
			$ket= $this->input->post('bk_keterangan');
			$time= now();
			$uid= $this->session->userdata('user_id');
			
			$create = $this->Barang_keluar_model->create($id_f,$kode,$tgl,$jumlah,$ket,$time,$uid);
			
			if($create){
				$this->session->set_flashdata('success','barang keluar telah disimpan');
			}else {
				$this->session->set_flashdata('error','tidak dapat menyimpan');
			}
			redirect('barang_keluar');
		}
	}
	

	function delete($id)
	{
		if(!isset($id)) {show_error('Kesalahan Parameter'); };
		$delete = $this->Barang_keluar_model->delete($id);		
		if($delete){
			$this->session->set_flashdata('success','data barang keluar telah dihapus');
		}else {
			$this->session->set_flashdata('error','tidak dapat menghapus');
		}
		redirect('barang_masuk');
	}
}

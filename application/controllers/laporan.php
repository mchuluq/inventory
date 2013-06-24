<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class laporan extends Member_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template_ui','form_validation','excel'));
		$this->load->model('Laporan_model');
		$this->load->helper(array('file','date'));
	}
	
	function index()
	{
		$data['title'] = "Laporan";
		$dir = APPPATH."../storage/report";
		$data['file'] = get_filenames($dir);
		$this->template_ui->display('page/index/laporan',$data);
	}
	function create()
	{
		$data['title'] = "Excel Report";		
		
		$type = $this->input->post('report_type');		
		switch ($type){
			case "act" :
				$create = $this->rep_aktifitas($this->input->post('date_start'),$this->input->post('date_end'));
				if($create)				{
					$this->session->set_flashdata('success','laporan aktifitas barang telah dibuat');
				}else{
					$this->session->set_flashdata('error','tidak dapat membuat');
				}
				redirect('laporan');
				break;
			case "jb" :
				$create = $this->rep_jenis_barang();
				if($create)				{
					$this->session->set_flashdata('success','laporan data jenis barang telah dibuat');
				}else{
					$this->session->set_flashdata('error','tidak dapat membuat');
				}
				redirect('laporan');
				break;
			case "sp" :
				$create = $this->rep_suplier();
				if($create)				{
					$this->session->set_flashdata('success','laporan data suplier telah dibuat');
				}else{
					$this->session->set_flashdata('error','tidak dapat membuat');
				}
				redirect('laporan');
				break;
			case "brg" :
				$create = $this->rep_barang();
				if($create)				{
					$this->session->set_flashdata('success','laporan data barang telah dibuat');
				}else{
					$this->session->set_flashdata('error','tidak dapat membuat');
				}
				redirect('laporan');
				break;
			default :
				$this->template_ui->display('laporan/aktifitas_form',$data);
				break;
		}
	}

	private function rep_aktifitas($start='',$end='')
	{
		if(empty($start) OR empty($end))
		{
			$rep_for = "All";
		}
		else
		{
			$rep_for = $start."_sampai_".$end;
		}
		$date_created = date('j-M-Y');
		$creator = $this->session->userdata('user_name');
		//initialize excel file
		$this->excel->getProperties()->setCreator($creator)
			->setLastModifiedBy($creator)
			->setTitle("Aktifitas Barang")
			->setSubject("Inventory")
			->setDescription("Laporan Aktifitas Barang")
			->setKeywords($this->template_ui->get_company())
			->setCategory("barang");
		//set template
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Aktifitas Barang : '.$rep_for.' :: '.$this->template_ui->get_company())
			->setCellValue('A2', 'Dibuat Pada : '.date('l, F j, Y H:i'))
			->setCellValue('A3', 'Oleh : '.$creator)
			->setCellValue('A5', 'Barang Masuk')
			->setCellValue('A6', 'Kode')
			->setCellValue('B6', 'Jumlah')
			->setCellValue('C6', 'Tanggal')
			->setCellValue('D6', 'Nama Barang')
			->setCellValue('E6', 'User')
			
			->setCellValue('G5', 'Barang Keluar')
			->setCellValue('H6', 'Kode')
			->setCellValue('H6', 'Jumlah')
			->setCellValue('I6', 'Tanggal')
			->setCellValue('J6', 'Nama Barang')
			->setCellValue('K6', 'User');
		//get data
		$barang_masuk = $this->Laporan_model->get_bm($start,$end);
		$barang_keluar = $this->Laporan_model->get_bk($start,$end);
		//fill "stok pakan" data
		$i_bm = 7;
		foreach($barang_masuk as $bm):
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A'.$i_bm, $bm['bm_kode'])
			->setCellValue('B'.$i_bm, $bm['bm_jumlah'])
			->setCellValue('C'.$i_bm, $bm['bm_tgl'])
			->setCellValue('D'.$i_bm, $bm['brg_nama'])
			->setCellValue('E'.$i_bm, $bm['user_name']);
			$i_bm++;
		endforeach;
		//fill "pemakaian pakan" data
		$i_bk = 7;
		foreach($barang_keluar as $bk):
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('G'.$i_bk, $bk['bk_kode'])
			->setCellValue('H'.$i_bk, $bk['bk_jumlah'])
			->setCellValue('I'.$i_bk, $bk['bk_tgl'])
			->setCellValue('J'.$i_bk, $bk['brg_nama'])
			->setCellValue('K'.$i_bk, $bk['user_name']);
			$i_bk++;
		endforeach;
		//cell merging
		$this->excel->getActiveSheet()->mergeCells('A1:K1');//header
		$this->excel->getActiveSheet()->mergeCells('A2:K2');//time
		$this->excel->getActiveSheet()->mergeCells('A3:K3');//creator
		
		$this->excel->getActiveSheet()->mergeCells('A5:E5');//barang masuk
		$this->excel->getActiveSheet()->mergeCells('G5:K5');//barang masuk
		//cell styling
		$this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray(
				array(
						'font'    => array('bold'=> true),
						'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				)
		);
		$this->excel->getActiveSheet()->getStyle('A2:A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A5:K6')->getFont()->setBold(true);
		//set border
		$styleThinOutline = array(
				'borders' => array(
						'outline' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => '000000'),
						),
				),
		);
		//"barang masuk" styling...
		$this->excel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('A6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('B6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('C6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('D6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('E6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('A7:A'.$i_bm)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('B7:B'.$i_bm)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('C7:C'.$i_bm)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('D7:D'.$i_bm)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('E7:E'.$i_bm)->applyFromArray($styleThinOutline);
		//"barang keluar" styling...
		$this->excel->getActiveSheet()->getStyle('G5:K5')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('G6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('H6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('I6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('J6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('K6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('G7:G'.$i_bk)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('H7:H'.$i_bk)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('I7:I'.$i_bk)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('J7:J'.$i_bk)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('K7:K'.$i_bk)->applyFromArray($styleThinOutline);
		//set width 
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(45);
		//set title
		$this->excel->getActiveSheet()->setTitle('Aktifitas Barang');
		$this->excel->setActiveSheetIndex(0);
		//write file
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$saved = $objWriter->save(APPPATH."../storage/report/aktifitas_barang_".$rep_for."@".$date_created.".xls");
		if($saved OR $objWriter){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	private function rep_barang()
	{
		$rep_title = "Barang";
		$date_created = date('j-M-Y');
		$creator = $this->session->userdata('user_name');
		//initialize excel file
		$this->excel->getProperties()->setCreator($creator)
			->setLastModifiedBy($creator)
			->setTitle("Data Barang")
			->setSubject("Inventory")
			->setDescription("Laporan data barang")
			->setKeywords($this->template_ui->get_company())
			->setCategory("barang");
		//set template
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Data Barang :: '.$this->template_ui->get_company())
			->setCellValue('A2', 'Dibuat Pada : '.date('l, F j, Y H:i'))
			->setCellValue('A3', 'Oleh : '.$creator)
			->setCellValue('A5', 'Data Barang')
			->setCellValue('A6', 'Nama')
			->setCellValue('B6', 'Kode')
			->setCellValue('C6', 'Stok')
			->setCellValue('D6', 'Stok Minimal')
			->setCellValue('E6', 'Harga Satuan')			
			->setCellValue('F6', 'Dibuat Pada')
			->setCellValue('G6', 'Vendor')
			->setCellValue('H6', 'Jenis')
			->setCellValue('I6', 'Suplier')
			->setCellValue('J6', 'User');
		//get data
		$barang = $this->Laporan_model->get_barang();
		//fill "barang" data
		$i_brg = 7;
		foreach($barang as $brg):
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A'.$i_brg, $brg['brg_nama'])
			->setCellValue('B'.$i_brg, $brg['brg_kode'])
			->setCellValue('C'.$i_brg, $brg['brg_stok'])
			->setCellValue('D'.$i_brg, $brg['brg_min_stok'])
			->setCellValue('E'.$i_brg, $brg['brg_harga_satuan'])
			->setCellValue('F'.$i_brg, $brg['brg_timestamp'])
			->setCellValue('G'.$i_brg, $brg['brg_vendor'])
			->setCellValue('H'.$i_brg, $brg['jb_nama'])
			->setCellValue('I'.$i_brg, $brg['sp_nama'])
			->setCellValue('J'.$i_brg, $brg['user_name']);
		$i_brg++;
		endforeach;
		//cell merging
		$this->excel->getActiveSheet()->mergeCells('A1:J1');//header
		$this->excel->getActiveSheet()->mergeCells('A2:J2');//time
		$this->excel->getActiveSheet()->mergeCells('A3:J3');//creator
		
		$this->excel->getActiveSheet()->mergeCells('A5:J5');//barang masuk
		//cell styling
		$this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(
				array(
						'font'    => array('bold'=> true),
						'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				)
		);
		$this->excel->getActiveSheet()->getStyle('A2:A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A5:J6')->getFont()->setBold(true);
		//set border
		$styleThinOutline = array(
				'borders' => array(
						'outline' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => '000000'),
						),
				),
		);
		//"barang" styling...
		$this->excel->getActiveSheet()->getStyle('A5:J5')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('A6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('B6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('C6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('D6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('E6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('F6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('G6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('H6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('I6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('J6')->applyFromArray($styleThinOutline);
		
		$this->excel->getActiveSheet()->getStyle('A7:A'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('B7:B'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('C7:C'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('D7:D'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('E7:E'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('F7:F'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('G7:G'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('H7:H'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('I7:I'.$i_brg)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('J7:J'.$i_brg)->applyFromArray($styleThinOutline);
		//set width
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(45);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(17);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
		//set title
		$this->excel->getActiveSheet()->setTitle('Data Barang');
		$this->excel->setActiveSheetIndex(0);
		//write file
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$saved = $objWriter->save(APPPATH."../storage/report/data_barang@".$date_created.".xls");
		if($saved OR $objWriter){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	private function rep_jenis_barang()
	{
		$rep_title = "Jenis Barang";
		$date_created = date('j-M-Y');
		$creator = $this->session->userdata('user_name');
		//initialize excel file
		$this->excel->getProperties()->setCreator($creator)
		->setLastModifiedBy($creator)
		->setTitle("Jenis Barang")
		->setSubject("Inventory")
		->setDescription("Laporan jenis barang")
		->setKeywords($this->template_ui->get_company())
		->setCategory("barang");
		//set template
		$this->excel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Data Jenis Barang :: '.$this->template_ui->get_company())
		->setCellValue('A2', 'Dibuat Pada : '.date('l, F j, Y H:i'))
		->setCellValue('A3', 'Oleh : '.$creator)
		->setCellValue('A5', 'Data Jenis Barang')
		->setCellValue('A6', 'Nama Jenis Barang');
		//get data
		$jenis = $this->Laporan_model->get_jenis();
		//fill "jenis barang" data
		$i_jb = 7;
		foreach($jenis as $jb):
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A'.$i_jb, $jb['jb_nama']);
		$i_jb++;
		endforeach;
		//cell merging
		$this->excel->getActiveSheet()->mergeCells('A1:C1');//header
		$this->excel->getActiveSheet()->mergeCells('A2:C2');//time
		$this->excel->getActiveSheet()->mergeCells('A3:C3');//creator
		//cell styling
		$this->excel->getActiveSheet()->getStyle('A1:C1')->applyFromArray(
				array(
						'font'    => array('bold'=> true),
						'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				)
		);
		$this->excel->getActiveSheet()->getStyle('A2:A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A5:C6')->getFont()->setBold(true);
		//set border
		$styleThinOutline = array(
				'borders' => array(
						'outline' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => '000000'),
						),
				),
		);
		//"jenis barang" styling...
		$this->excel->getActiveSheet()->getStyle('A5')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('A6')->applyFromArray($styleThinOutline);		
		$this->excel->getActiveSheet()->getStyle('A7:A'.$i_jb)->applyFromArray($styleThinOutline);
		//set width
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(45);
		//set title
		$this->excel->getActiveSheet()->setTitle('Data Jenis Barang');
		$this->excel->setActiveSheetIndex(0);
		//write file
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$saved = $objWriter->save(APPPATH."../storage/report/data_jenis_barang@".$date_created.".xls");
		if($saved OR $objWriter){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	private function rep_suplier()
	{
		$rep_title = "Suplier";
		$date_created = date('j-M-Y');
		$creator = $this->session->userdata('user_name');
		//initialize excel file
		$this->excel->getProperties()->setCreator($creator)
			->setLastModifiedBy($creator)
			->setTitle("Suplier")
			->setSubject("Inventory")
			->setDescription("Laporan jenis barang")
			->setKeywords($this->template_ui->get_company())
			->setCategory("suplier");
		//set template
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Data Suplier :: '.$this->template_ui->get_company())
			->setCellValue('A2', 'Dibuat Pada : '.date('l, F j, Y H:i'))
			->setCellValue('A3', 'Oleh : '.$creator)
			->setCellValue('A5', 'Data Suplier')
			->setCellValue('A6', 'Nama Suplier')
			->setCellValue('B6', 'Alamat')
			->setCellValue('C6', 'Kota')
			->setCellValue('D6', 'Telepon')
			->setCellValue('E6', 'Fax')
			->setCellValue('F6', 'Email')
			->setCellValue('G6', 'Web URL');
		//get data
		$suplier = $this->Laporan_model->get_suplier();
		//fill "suplier" data
		$i_sp = 7;
		foreach($suplier as $sp):
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A'.$i_sp, $sp['sp_nama'])
			->setCellValue('B'.$i_sp, $sp['sp_alamat'])
			->setCellValue('C'.$i_sp, $sp['sp_kota'])
			->setCellValue('D'.$i_sp, $sp['sp_telp'])
			->setCellValue('E'.$i_sp, $sp['sp_fax'])
			->setCellValue('F'.$i_sp, $sp['sp_email'])
			->setCellValue('G'.$i_sp, $sp['sp_url']);
		$i_sp++;
		endforeach;
		//cell merging
		$this->excel->getActiveSheet()->mergeCells('A1:G1');//header
		$this->excel->getActiveSheet()->mergeCells('A2:G2');//time
		$this->excel->getActiveSheet()->mergeCells('A3:G3');//creator
		//cell styling
		$this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(
				array(
						'font'    => array('bold'=> true),
						'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				)
		);
		$this->excel->getActiveSheet()->getStyle('A2:A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A5:G6')->getFont()->setBold(true);
		//set border
		$styleThinOutline = array(
				'borders' => array(
						'outline' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => '000000'),
						),
				),
		);
		//"jenis barang" styling...
		$this->excel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('A6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('B6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('C6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('D6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('E6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('F6')->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('G6')->applyFromArray($styleThinOutline);
		
		$this->excel->getActiveSheet()->getStyle('A7:A'.$i_sp)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('B7:B'.$i_sp)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('C7:C'.$i_sp)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('D7:D'.$i_sp)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('E7:E'.$i_sp)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('F7:F'.$i_sp)->applyFromArray($styleThinOutline);
		$this->excel->getActiveSheet()->getStyle('G7:G'.$i_sp)->applyFromArray($styleThinOutline);
		//set width
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		
		//set title
		$this->excel->getActiveSheet()->setTitle('Data Suplier');
		$this->excel->setActiveSheetIndex(0);
		//write file
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$saved = $objWriter->save(APPPATH."../storage/report/data_suplier@".$date_created.".xls");
		if($saved OR $objWriter){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

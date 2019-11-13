<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

class Cetakpdf extends CI_Controller{
 
    function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}
    }
    
    //=================================================================================================================================================
	function cetakpermintaan(){	
		$this->load->model('m_permintaan'); 		/* di load dulu model nya agar bisa digunakan */

		$this->load->library('pdf');                /* Load Liblary pdf */

        $id = $this->input->post('id');

		$row['ambil_data_permintaan'] = $this->m_permintaan->ambil_data_permintaan($id);				/* panggil function di dalem model */
       
		$this->load->view('printout/cetakpermintaan.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("permintaan.pdf", array("Attachment"=>0));
	}
	
	//=================================================================================================================================================
	function cetakpermintaan2(){	
		$this->load->model('m_permintaan'); 		/* di load dulu model nya agar bisa digunakan */

		$this->load->library('pdf');                /* Load Liblary pdf */

        $id = $this->input->post('id');

		$row['ambil_data_permintaan'] = $this->m_permintaan->ambil_data_permintaan($id);				/* panggil function di dalem model */
       
		$this->load->view('printout/cetakpermintaankeluar.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("permintaan.pdf", array("Attachment"=>0));
	}
	
	//=================================================================================================================================================
	function cetakbuktiservice(){	
		$this->load->model('m_bukti'); 				/* di load dulu model nya agar bisa digunakan */

		$this->load->library('pdf');                /* Load Liblary pdf */

        $id = $this->input->post('id');

		$row['data_bukti_service'] = $this->m_bukti->ambil_data_bukti_service($id);				/* panggil function di dalem model */
       
		$this->load->view('printout/cetakbuktiservice.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("buktiservice.pdf", array("Attachment"=>0));
	}
	
	//=================================================================================================================================================
	function cetakbuktipenyerahan(){	
		$this->load->model('m_bukti'); 				/* di load dulu model nya agar bisa digunakan */

		$this->load->library('pdf');                /* Load Liblary pdf */

        $id = $this->input->post('id');

		$row['data_bukti_penyerahan'] = $this->m_bukti->ambil_data_bukti_penyerahan($id);				/* panggil function di dalem model */
       
		$this->load->view('printout/cetakbuktipenyerahan.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("buktipenyerahan.pdf", array("Attachment"=>0));
    }
	
	//=================================================================================================================================================
	function cetakbuktiupdateaplikasi(){	
		$this->load->model('m_bukti'); 				/* di load dulu model nya agar bisa digunakan */

		$this->load->library('pdf');                /* Load Liblary pdf */

        $id = $this->input->post('id');

		$row['data_bukti_updateaplikasi'] = $this->m_bukti->ambil_data_bukti_updateaplikasi($id);				/* panggil function di dalem model */
       
		$this->load->view('printout/cetakbuktiupdateaplikasi.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("buktipenyerahan.pdf", array("Attachment"=>0));
    }
	
	//=================================================================================================================================================
	//=================================================================================================================================================
	//=================================================================================================================================================
	function cetaklaporanpermintaanservice(){	
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		               			/* Load Liblary pdf */

		$dari = $this->input->post('ServiceAwalPDF');
		$sampai = $this->input->post('ServiceAkhirPDF');
		$row['view_data_permintaan_service'] = $this->m_laporan->view_data_permintaan_service($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanservice.php', $row);
		
		$this->load->library('Pdf'); 
		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Service.pdf", array("Attachment"=>0));
	}
	
	function cetaklaporanpermintaanservice2(){	
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		               			/* Load Liblary pdf */
		$dari = $this->input->post('val_sp1');
		$sampai = $this->input->post('val_sp2');
		$lok = $this->input->post('lok');

		$row['view_data_permintaan_service'] = $this->m_laporan->view_data_permintaan_service2($dari, $sampai,$lok);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanservice.php', $row);
		
		$this->load->library('Pdf'); 
		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Service.pdf", array("Attachment"=>0));
    }
	
	//=================================================================================================================================================
	function cetaklaporanpermintaanbarang(){	
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */
		
		$this->load->library('pdf');                			/* Load Liblary pdf */

		$dari = $this->input->post('BarangAwalPDF');
		$sampai = $this->input->post('BarangAkhirPDF');
		$row['view_data_permintaan_barang'] = $this->m_laporan->view_data_permintaan_barang($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanbarang.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Barang.pdf", array("Attachment"=>0));
	}

	function cetaklaporanpermintaanbarang2(){	
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */
		
		$this->load->library('pdf');                			/* Load Liblary pdf */

		$dari = $this->input->post('val_ip1');
		$sampai = $this->input->post('val_ip2');
		$lok = $this->input->post('lok');

		$row['view_data_permintaan_barang'] = $this->m_laporan->view_data_permintaan_barang2($dari, $sampai, $lok);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanbarang.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Barang.pdf", array("Attachment"=>0));
	}
	
	//=================================================================================================================================================
	function cetaklaporanpermintaanaplikasi(){	
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */
		
		$this->load->library('pdf');                			/* Load Liblary pdf */

		$dari = $this->input->post('AplikasiAwalPDF');
		$sampai = $this->input->post('AplikasiAkhirPDF');
		$row['view_data_permintaan_aplikasi'] = $this->m_laporan->view_data_permintaan_aplikasi($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanaplikasi.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Aplikasi / Update Aplikasi.pdf", array("Attachment"=>0));
	}
	
	function cetaklaporanpermintaanaplikasi2(){	
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */
		
		$this->load->library('pdf');                			/* Load Liblary pdf */

		$dari = $this->input->post('val_ap1');
		$sampai = $this->input->post('val_ap2');
		$row['view_data_permintaan_aplikasi'] = $this->m_laporan->view_data_permintaan_aplikasi2($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanaplikasi.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Aplikasi / Update Aplikasi.pdf", array("Attachment"=>0));
	}
	
	function service_pc(){

		$status = $this->input->post("stat");
		
		$row['status'] = $status;

		$this->load->library('pdf');

		$from = $this->input->post("val_spc1");
		$to = $this->input->post("val_spc2");

		$row['dari'] = $from;
		$row['sampai'] = $to;

		$this->load->view('printout/lap_serv_pc.php', $row);

		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Permintaan Aplikasi / Update Aplikasi.pdf", array("Attachment"=>0));


	}

	function graph_harian(){
		$dari = $this->input->post("val_graph1");
		$sampai = $this->input->post("val_graph2");

		$data = array('dari' => $dari, 'sampai' => $sampai);
		$this->load->view("grafik/harian", $data);
	}
	
	function graph_bulanan(){
		$bln_dari = $this->input->post("bulan1");
		$thn_dari = $this->input->post("tahun1");

		$bln_sampai = $this->input->post("bulan2");
		$thn_sampai = $this->input->post("tahun2");

		$data = array("bln_dari" => $bln_dari, "bln_sampai" => $bln_sampai, "thn_dari" => $thn_dari, "thn_sampai" => $thn_sampai);
		$this->load->view("grafik/bulanan", $data);


	}

	function log_ganti(){

		$this->load->library('pdf');
		
		$val_vcc1 = $this->input->post("val_vcc1");
		$val_vcc2 = $this->input->post("val_vcc2");

		$tgl1 = date("d M Y", strtotime($val_vcc1));
		$tgl2 = date("d M Y", strtotime($val_vcc2));

		$data = array("awal" => $val_vcc1, "akhir" => $val_vcc2);

		$this->load->view("printout/log_komponen", $data);

		
		$html = $this->output->get_output();    
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan_Penggantian_Komponen.pdf", array("Attachment"=>0));
		
	}

	function graph_cs(){
		
		$tgl1 = $this->input->post("vhg1");
		$tgl2 = $this->input->post("vhg2");

		$data = array('awal' => $tgl1, 'akhir' => $tgl2);

		$this->load->view("grafik/gcs", $data);

	}

	function astok(){
		
		$this->load->view("printout/stok");
		
		$this->load->library('pdf');
		$html = $this->output->get_output();  
		//$dompdf->set_option("isPhpEnabled", true);  
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Potrait'); //Landscape or Portrait
		$this->dompdf->render();
		$this->dompdf->stream("Laporan_Stok.pdf", array("Attachment"=>0));

	}

	function evaluasi(){
		
		$bulan = $this->input->post("bln");
		$tahun = $this->input->post("thn");

		$data = array("bulan" => $bulan, "tahun" => $tahun);

		$this->load->view("printout/evaluasi", $data);

	}


}
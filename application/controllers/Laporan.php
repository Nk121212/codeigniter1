<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{

    function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}
	}

	//=================================================================================================================================================
	function exportexcelpermintaanservice(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		$dari = $this->input->post('ServiceAwalExcel');
		$sampai = $this->input->post('ServiceAkhirExcel');
		$row['view_data_permintaan_service'] = $this->m_laporan->view_data_permintaan_service($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('exportexcel/exportexcelpermintaanservice.php', $row);
	} 
	
	//=================================================================================================================================================
	function exportexcelpermintaanservice2(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		$dari = $this->input->post('val_sx1');
		$sampai = $this->input->post('val_sx2');
		$lok = $this->input->post('lok');

		$row['view_data_permintaan_service'] = $this->m_laporan->view_data_permintaan_service2($dari, $sampai, $lok);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('exportexcel/exportexcelpermintaanservice2.php', $row);
	} 

	function service_pdf(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */
		
		$dari = $this->input->post('val_sx1');
		$sampai = $this->input->post('val_sx2');
		$lok = $this->input->post('lok');

		$row['view_data_permintaan_service'] = $this->m_laporan->view_data_permintaan_service2($dari, $sampai, $lok);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('printout/cetaklaporanpermintaanservice.php', $row);
        $html = $this->output->get_output();    
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('Legal', 'Portrait');
        $this->dompdf->render();
        $this->dompdf->stream("Lap_Service.pdf", array("Attachment"=>0));
	}

	//=================================================================================================================================================
	function exportexcelpermintaanbarang(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		$dari = $this->input->post('BarangAwalExcel');
		$sampai = $this->input->post('BarangAkhirExcel');
		$row['view_data_permintaan_barang'] = $this->m_laporan->view_data_permintaan_barang($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('exportexcel/exportexcelpermintaanbarang.php', $row);
	}
	
	function exportexcelpermintaanbarang2(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		$dari = $this->input->post('val_ix1');
		$sampai = $this->input->post('val_ix2');
		$lok = $this->input->post('lok');

		$row['view_data_permintaan_barang'] = $this->m_laporan->view_data_permintaan_barang2($dari, $sampai, $lok);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));

		$this->load->view('exportexcel/exportexcelpermintaanbarang2.php', $row);
	}

	//=================================================================================================================================================
	function exportexcelpermintaanaplikasi(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		$dari = $this->input->post('AplikasiAwalExcel');
		$sampai = $this->input->post('AplikasiAkhirExcel');
		$row['view_data_permintaan_aplikasi'] = $this->m_laporan->view_data_permintaan_aplikasi($dari, $sampai);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));
		
		$this->load->view('exportexcel/exportexcelpermintaanaplikasi.php', $row);
	}  

	function exportexcelpermintaanaplikasi2(){
		$this->load->model('m_laporan');						/* di load dulu model nya agar bisa digunakan */

		$dari = $this->input->post('val_ax1');
		$sampai = $this->input->post('val_ax2');
		$lok = $this->input->post('lok');

		$row['view_data_permintaan_aplikasi'] = $this->m_laporan->view_data_permintaan_aplikasi2($dari, $sampai, $lok);
		$row['dari'] = date("d F Y", strtotime($dari));
		$row['sampai'] = date("d F Y", strtotime($sampai));
		
		$this->load->view('exportexcel/exportexcelpermintaanaplikasi2.php', $row);
	}  






}


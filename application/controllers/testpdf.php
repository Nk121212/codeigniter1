<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Testpdf extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
	}
 
    //------------------------------------------------------------------------------------------------
	public function laporan_pdf(){
        
        $data = array(
            "dataku" => array(
                "nama" => "Petani Kode",
                "url" => "http://petanikode.com"
            )
        );
    
        $this->load->library('pdf');
    
        //$this->pdf->setPaper('A4', 'potrait');
        //$this->pdf->filename = "laporan-petanikode.pdf";
        //$this->pdf->view('forms/laporan_pdf.php', $data);       

        
        //$tampil=$this->wel->yes();
        //$data = array('tampil' =>$tampil );
        $this->load->view('forms/laporan_pdf.php', $data);
        $html = $this->output->get_output();    
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('Legal', 'Portrait');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    }

    //------------------------------------------------------------------------------------------------
 
}
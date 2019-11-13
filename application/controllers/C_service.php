<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');

    class C_service extends CI_Controller{
    
        function __construct(){
            parent::__construct();
        
            if($this->session->userdata('status') != "login"){
                redirect(base_url("index.php"));
            }	

            $this->load->model('M_inspect');	
        }

        public function index(){
            $this->load->view('layouts/head.php');
            $this->load->view('layouts/topbar.php');
            $this->load->view('layouts/sidebar.php');
            $this->load->view('layouts/script.php');	
            $this->load->view('layouts/foot.php');

            $this->load->view("printout/memo_service");
        }

        function create_pdf(){
            $id_pc = $this->input->post("id_pc");

            if(is_array($id_pc)){
                $idp = implode($id_pc,", ");
            }else{
                $idp = $id_pc;
            }
            //$caoo = $this->input->post("sas");

            $data = array("id_pc" => $idp);

            $this->load->library('pdf');                /* Load Liblary pdf */

            $this->load->view("printout/cetak_serv", $data);
            //$this->load->view('printout/v_qr.php', $data);
			
			$html = $this->output->get_output();    
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
			$this->dompdf->render();
			$this->dompdf->stream("Service_Card.pdf", array("Attachment"=>0));
        }

        function inspect_form(){
            
            $this->load->view('layouts/head.php');
            $this->load->view('layouts/topbar.php');
            $this->load->view('layouts/sidebar.php');
            $this->load->view('layouts/script.php');	
            $this->load->view('layouts/foot.php');
            
            $this->load->view("forms/inspect");
        }

        function add_jadwal(){

            $insert = $this->M_inspect->insert();

            if($insert){

                //echo 'Ok';
                redirect('C_service/inspect_form');

            }else{

                echo 'Gagal';

            }

        }

        function print_jadwal($id){

            $this->load->library('pdf');

            $query = $this->M_inspect->detail_pc($id);
            $data['data_pc'] = $query;
            $this->load->view('printout/inspect', $data);

            $html = $this->output->get_output();    
            $this->dompdf->loadHtml($html);
            $this->dompdf->setPaper('A4', 'Landscape'); //Landscape or Portrait
            $this->dompdf->render();
            $this->dompdf->stream("Service_Card.pdf", array("Attachment"=>0));

        }

        function edit_page($id){
            
            $this->load->view('layouts/head.php');
            $this->load->view('layouts/topbar.php');
            $this->load->view('layouts/sidebar.php');
            $this->load->view('layouts/script.php');	
            $this->load->view('layouts/foot.php');

            $query = $this->M_inspect->page_edit($id);
            $data['detail'] = $query;

            $this->load->view("forms/edit_jadwal", $data);
        }

        function edit_jadwal(){

            $query = $this->M_inspect->edit_jadwal();

            if($query){
                //echo 'Ok';
                redirect('C_service/inspect_form');
            }else{
                echo 'Error Update';
            }
        }

        function del_jadwal($id){
            $query = $this->M_inspect->del_jadwal($id);
            if($query){
                redirect('C_service/inspect_form');
            }else{
                echo 'Error Delete';
            }
        }

    }
?>
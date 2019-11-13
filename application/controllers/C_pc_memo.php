<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pc_memo extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}

		//$this->load->view('layouts/head.php');
		//$this->load->view('layouts/topbar.php');
		//$this->load->view('layouts/sidebar.php');
		//$this->load->view('layouts/script.php');	
		//$this->load->view('layouts/foot.php');	
    }

    function index(){        
        $this->load->view("inventory/memo_pc");
    }

    function cari_pc(){
        $kd_bagian = $this->input->post("kd_bagian");
        $id_pc = $this->input->post("id_pc");

        if($kd_bagian == ""){

            $query = $this->db->query("
                select a.*,b.nama_bagian from master_pc a 
                left join tbl_bagian b on a.id_bagian = b.kd
                where a.uid = '$id_pc' and a.hapus is null
            ");

        }elseif($id_pc == ""){

            $query = $this->db->query("
                select a.*,b.nama_bagian from master_pc a 
                left join tbl_bagian b on a.id_bagian = b.kd
                where a.id_bagian = '$kd_bagian' and a.hapus is null
            ");

        }elseif($kd_bagian == "" && $id_pc == ""){



        }else{

            $query = $this->db->query("
                select a.*,b.nama_bagian from master_pc a 
                left join tbl_bagian b on a.id_bagian = b.kd
                where a.uid = '$id_pc' and a.id_bagian = '$kd_bagian' and a.hapus is null
            ");

        }

        if($query->num_rows() < 1){

            echo '
                <h3 style="background-color:#e6000d; color:white;" align="center">No Data !</h3>
            ';

        }else{

            foreach($query->result() as $data){
                echo '
                    <input type="checkbox" name="id_pc[]" value="'.$data->uid.'"> '.$data->uid.'<br>
                ';
            }
            echo '
                <br>
                <button type="submit" class="btn btn-success">Create PDF</button>
            ';

        }
    }

    function pdf_memo(){
        $id_pc = $this->input->post("id_pc");
        $uid = implode(",", $id_pc);
        //echo $uid;
        $this->load->library('pdf'); 

        $data['uid'] = $uid;

        $this->load->view('inventory/print_pdf/cetak_memo', $data);
        
        $html = $this->output->get_output();    
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
        $this->dompdf->render();
        $this->dompdf->stream("Memo_PC.pdf", array("Attachment"=>0));
    }

}
    
?>
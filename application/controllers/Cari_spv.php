<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

class Cari_spv extends CI_Controller{

    function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}	
	}

	function spv_list(){
        $this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
        $this->load->view('layouts/foot.php');
        
		$this->load->view("forms/spv_page");
	}

	function search_spv(){
		$id_user = $this->input->post("id_user");

		$q1 = $this->db->query("
			select departemen from tbl_user where id = '$id_user'
        ");

        if($q1->num_rows() < 1){

        }else{
            $dept = $q1->row()->departemen;

            $q2 = $this->db->query("
                select nama_atasan from tbl_department where kd = '$dept'
            ");
            if($q2->num_rows() < 1){

            }else{
                $id_atasan = $q2->row()->nama_atasan;

                $q3 = $this->db->query("
                    select a.*, b.*, c.*
                    from tbl_user a
                    left join tbl_department b on b.kd = a.departemen
                    left join tbl_bagian c on c.kd = a.bagian
                    where a.id = '$id_atasan';
                ");
        
                foreach($q3->result() as $dt1){
                    $nm = $dt1->nama;
                    $email = $dt1->email;
                    $dept = $dt1->nama_dept;
                    $bag = $dt1->nama_bagian;
                    $telp = $dt1->telp;
                    echo '
                        <div class="panel panel-default" style="margin-top:20px;">
                            <div class="panel-body" style="text-align:center;">
                                <p style="font-size:20px;background-color:#D2F2F1;">'.$nm.'</p>
                                <p style="font-size:15px;">'.$email.'</p>
                                <p style="font-size:15px;">'.$telp.'</p>
                                <p style="font-size:15px;">'.$dept.'</p>
                                <p style="font-size:15px;">'.$bag.'</p>
                            </div>
                        </div>
                    ';
                }
            }
            
        }

	}

}

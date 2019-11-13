<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_merk extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}

		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	
    }

    function merk_view(){
        $this->load->view("inventory/merk");
    }

    function add_merk(){
        $merk = $this->input->post("merk");
        $status = $this->input->post("status");
        $iduser =  $this->session->userdata("id");

        $cek_record = $this->db->query("
            select * from master_merk where nama_merk = '$merk' and hapus IS NULL
        ");

        if($cek_record->num_rows() < 1){
            $query = $this->db->query("
                INSERT INTO master_merk(nama_merk, status, add_by, add_at) VALUES('$merk','$status', '$iduser', now())
            ");
            redirect("C_merk/merk_view");
        }else{
            $data['error'] = '<h5>Data Sudah Ada !</h5>';
            $this->load->view("inventory/merk", $data);
        }

    }

    function del_merk($id){
        $id_merk = $id;
        $iduser =  $this->session->userdata("id");

        $query = $this->db->query("
            UPDATE master_merk SET hapus = '$iduser' WHERE id = '$id'
        ");
        if($query){
            redirect("C_merk/merk_view");
        }else{
            redirect("C_merk/merk_view");
        }

    }

    function ganti_status($id){
        $id_merk = $id;
        $iduser =  $this->session->userdata("id");
        
        $cek_data = $this->db->query("
            select * from master_merk where id = '$id_merk'
        ");

            if($cek_data->row()->status == 0){
                //jadikan satu
                $upd = $this->db->query("
                    update master_merk set status = 1, update_by = '$iduser', update_at = now() where id = '$id_merk'
                ");
            }else{
                //jadikan nol
                $upd = $this->db->query("
                    update master_merk set status = 0, update_by = '$iduser', update_at = now() where id = '$id_merk'
                ");
            }

        redirect("C_merk/merk_view");
    }

}
    
?>
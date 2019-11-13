<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_type extends CI_Controller{
 
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

    function type_view(){
        $this->load->view("inventory/type");
    }

    function add_type(){
        $type = $this->input->post("type");
        $status = $this->input->post("status");
        $iduser =  $this->session->userdata("id");
        $kat = $this->input->post("kat");

        $cek_record = $this->db->query("
            select * from master_type where nama_type = '$type' and kat = '$kat' and hapus IS NULL
        ");

        if($cek_record->num_rows() < 1){
            $query = $this->db->query("
                INSERT INTO master_type(nama_type, kat, status, add_by, add_at) VALUES('$type', '$kat', '$status', '$iduser', now())
            ");
            redirect("C_type/type_view");
        }else{
            $data['error'] = '<h5>Data Sudah Ada !</h5>';
            $this->load->view("inventory/type", $data);
        }

    }

    function del_type($id){
        $id_type = $id;
        $iduser =  $this->session->userdata("id");

        $query = $this->db->query("
            UPDATE master_type SET hapus = '$iduser' WHERE id = '$id_type'
        ");
        if($query){
            redirect("C_type/type_view");
        }else{
            redirect("C_type/type_view");
        }

    }

    function ganti_status($id){
        $id_type = $id;
        $iduser =  $this->session->userdata("id");
        
        $cek_data = $this->db->query("
            select * from master_type where id = '$id_type'
        ");

            if($cek_data->row()->status == 0){
                //jadikan satu
                $upd = $this->db->query("
                    update master_type set status = 1, update_by = '$iduser', update_at = now() where id = '$id_type'
                ");
            }else{
                //jadikan nol
                $upd = $this->db->query("
                update master_type set status = 0, update_by = '$iduser', update_at = now() where id = '$id_type'
            ");
        }

        redirect("C_type/type_view");
    }

}
    
?>
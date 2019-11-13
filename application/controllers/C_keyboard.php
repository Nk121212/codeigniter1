<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_keyboard extends CI_Controller{
 
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

    function view_keyboard(){
        $this->load->view("inventory/keyboard");
    }

    function add_keyboard(){
        $merk = $this->input->post("merk");
		$type = $this->input->post("type");

		$cek = $this->db->query("
			select * from tbl_keyboard where merk = '$merk' and type = '$type' and hapus IS NULL
		");

		if($cek->num_rows() > 0){
			$data['error'] = '
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Alert !</strong> Keyboard sudah ada !
		  	</div>';
			$this->load->view("inventory/keyboard", $data);
		}else{
			$qins = $this->db->query("
				INSERT INTO tbl_keyboard (merk,type) VALUES('$merk','$type')
			");

			if($qins){
				redirect("C_keyboard/view_keyboard");
			}else{
				echo 'Error !';
			}
		}
	}
	
	function del_keyboard($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE tbl_keyboard SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_keyboard/view_keyboard");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$cek = $this->db->query("
			select * from tbl_keyboard where id = '$id'
        ");
        
        $id_merk = $cek->row()->merk;
		$id_type = $cek->row()->type;

        $data = array('id' => $id, 'merk'=> $id_merk, 'type' => $id_type);
        
		$this->load->view("inventory/edit/edit_keyboard", $data);
	}

	function update_keyboard(){
        $id = $this->input->post("id");
        $merk = $this->input->post("merk");
		$type = $this->input->post("type");

		$query = $this->db->query("
			update tbl_keyboard set merk = '$merk', type = '$type' where id = '$id'
		");

		if($query){
			redirect("C_keyboard/view_keyboard");
		}else{
			echo 'Error !';
		}

	}

	function add_stok(){
		$id_key = $this->input->post("id_key");
		$stok = $this->input->post("stok");

		$cek_stok = $this->db->query("
			select stok from tbl_keyboard where id = '$id_key'
		");

		$stok_now = $cek_stok->row()->stok;
		
		if($stok_now == NULL){
			$sn = 0+$stok;
		}else{
			$sn = $stok_now+$stok;
		}

		$updt_sm = $this->db->query("
			update tbl_keyboard set stok = '$sn' where id = '$id_key'
		");

		redirect("C_keyboard/view_keyboard");
	}

}

?>
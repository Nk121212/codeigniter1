<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_mouse extends CI_Controller{
 
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

    function view_mouse(){
        $this->load->view("inventory/mouse");
    }

    function add_mouse(){
        $merk = $this->input->post("merk");
		$type = $this->input->post("type");

		$cek = $this->db->query("
			select * from tbl_mouse where merk = '$merk' and type = '$type' and hapus IS NULL
		");

		if($cek->num_rows() > 0){
			$data['error'] = '
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Alert !</strong> Mouse sudah ada !
		  	</div>';
			$this->load->view("inventory/mouse", $data);
		}else{
			$qins = $this->db->query("
				INSERT INTO tbl_mouse (merk,type) VALUES('$merk','$type')
			");

			if($qins){
				redirect("C_mouse/view_mouse");
			}else{
				echo 'Error !';
			}
		}
	}
	
	function del_mouse($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE tbl_mouse SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_mouse/view_mouse");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$cek = $this->db->query("
			select * from tbl_mouse where id = '$id'
        ");
        
        $id_merk = $cek->row()->merk;
		$id_type = $cek->row()->type;

        $data = array('id' => $id, 'merk'=> $id_merk, 'type' => $id_type);
        
		$this->load->view("inventory/edit/edit_mouse", $data);
	}

	function update_mouse(){
        $id = $this->input->post("id");
        $merk = $this->input->post("merk");
		$type = $this->input->post("type");

		$query = $this->db->query("
			update tbl_mouse set merk = '$merk', type = '$type' where id = '$id'
		");

		if($query){
			redirect("C_mouse/view_mouse");
		}else{
			echo 'Error !';
		}

	}

	function add_stok(){
		$id_mouse = $this->input->post("id_mouse");
		$stok = $this->input->post("stok");

		$cek_stok = $this->db->query("
			select stok from tbl_mouse where id = '$id_mouse'
		");

		$stok_now = $cek_stok->row()->stok;
		
		if($stok_now == NULL){
			$sn = 0+$stok;
		}else{
			$sn = $stok_now+$stok;
		}

		$updt_sm = $this->db->query("
			update tbl_mouse set stok = '$sn' where id = '$id_mouse'
		");

		redirect("C_mouse/view_mouse");

	}

}

?>
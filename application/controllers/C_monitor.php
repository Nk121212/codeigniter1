<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_monitor extends CI_Controller{
 
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

    function view_monitor(){
        $this->load->view("inventory/monitor");
    }

    function add_monitor(){
		$merk = $this->input->post("merk");
		$type = $this->input->post("type");
		$inches = $this->input->post("inches");

		$cek = $this->db->query("
			select * from tbl_monitor where merk = '$merk' and type='$type' and inches = '$inches' and hapus IS NULL
		");

		if($cek->num_rows() > 0){
			$data['error'] = '
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Alert !</strong> Monitor sudah ada !
		  	</div>';
			$this->load->view("inventory/monitor", $data);
		}else{
			$qins = $this->db->query("
				INSERT INTO tbl_monitor (merk,type,inches) VALUES('$merk','$type','$inches')
			");

			if($qins){
				redirect("C_monitor/view_monitor");
			}else{
				echo 'Error !';
			}
		}
	}
	
	function del_monitor($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE tbl_monitor SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_monitor/view_monitor");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$cek = $this->db->query("
			select * from tbl_monitor where id = '$id'
		");

		$id_merk = $cek->row()->merk;
		$id_type = $cek->row()->type;
		$inches = $cek->row()->inches;

		$data = array('id' => $id, 'merk' => $id_merk, 'type' => $id_type, 'inches' => $inches);
		$this->load->view("inventory/edit/edit_monitor", $data);
	}

	function update_monitor(){
		$id = $this->input->post("id");
		$merk = $this->input->post("merk");
		$type = $this->input->post("type");
		$inches = $this->input->post("inches");

		$query = $this->db->query("
			update tbl_monitor set merk = '$merk', type = '$type', inches = '$inches' where id = '$id'
		");

		if($query){
			redirect("C_monitor/view_monitor");
		}else{
			echo 'Error !';
		}

	}

	function add_stok(){
		$id_monitor = $this->input->post("id_monitor");
		$stok = $this->input->post("stok");

		$cek_stok = $this->db->query("
			select stok from tbl_monitor where id = '$id_monitor'
		");

		$stok_now = $cek_stok->row()->stok;
		
		if($stok_now == NULL){
			$sn = 0+$stok;
		}else{
			$sn = $stok_now+$stok;
		}

		$updt_sm = $this->db->query("
			update tbl_monitor set stok = '$sn' where id = '$id_monitor'
		");

		redirect("C_monitor/view_monitor");

	}

}

?>
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_processor extends CI_Controller{
 
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

    function view_proc(){
        $this->load->view("inventory/processor");
    }

    function add_proc(){
		$merk = $this->input->post("merk");
		$type = $this->input->post("type");
		$clock = $this->input->post("clock");
		$hertz = $this->input->post("hertz");

		$cek_proc = $this->db->query("
			select * from tbl_processor where merk = '$merk' and type = '$type' and clock = '$clock' and hertz = '$hertz' and hapus IS NULL
		");

		if($cek_proc->num_rows() > 0){

			$data['error'] = '
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Alert !</strong> processor sudah ada !
		  	</div>';
			$this->load->view("inventory/processor", $data);

		}else{

			$qins = $this->db->query("
				INSERT INTO tbl_processor (merk,type,clock,hertz) VALUES('$merk','$type','$clock','$hertz')
			");

			if($qins){
				redirect("C_processor/view_proc");
			}else{
				echo 'Error !';
			}

		}

	}
	
	function del_proc($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE tbl_processor SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_processor/view_proc");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$cek = $this->db->query("
			select * from tbl_processor where id = '$id'
		");

		$id_merk = $cek->row()->merk;
		$id_type = $cek->row()->type;
		$clock = $cek->row()->clock;
		$hertz = $cek->row()->hertz;

		$data = array('id_proc' => $id, 'merk' => $id_merk, 'type' => $id_type, 'clock' => $clock, 'hertz' => $hertz);
		$this->load->view("inventory/edit/edit_proc", $data);
	}

	function update_proc(){
		$id = $this->input->post("id_proc");
		$merk = $this->input->post("merk");
		$type = $this->input->post("type");
		$clock = $this->input->post("clock");
		$hertz = $this->input->post("hertz");

		$query = $this->db->query("
			update tbl_processor set merk = '$merk', type = '$type', clock = '$clock', hertz = '$hertz' where id = '$id'
		");

		if($query){
			redirect("C_processor/view_proc");
		}else{
			echo 'Error !';
		}

	}

	function add_stok(){
		$id_proc = $this->input->post("id_proc");
		$stok = $this->input->post("stok");
		
		$cek_stok = $this->db->query("
			select stok from tbl_processor where id = '$id_proc'
		");

		$stok_now = $cek_stok->row()->stok;
		
		if($stok_now == NULL){
			$sn = 0+$stok;
		}else{
			$sn = $stok_now+$stok;
		}

		$updt_sp = $this->db->query("
			update tbl_processor set stok = '$sn' where id = '$id_proc'
		");

		redirect("C_processor/view_proc");

	}

}

?>
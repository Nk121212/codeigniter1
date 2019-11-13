<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_memory extends CI_Controller{
 
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

    function view_memory(){
        $this->load->view("inventory/memory");
    }

    function add_memory(){
		$merk = $this->input->post("merk");
		$byte = $this->input->post("byte");
		$type = $this->input->post("type");
		$kapasitas = $this->input->post("kapasitas");
		$byte = $this->input->post("byte");

		$cek = $this->db->query("
			select * from tbl_memory where merk = '$merk' and type='$type' and kapasitas = '$kapasitas' and byte = '$byte' and hapus IS NULL
		");

		if($cek->num_rows() > 0){
			$data['error'] = '
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Alert !</strong> Memory sudah ada !
		  	</div>';
			$this->load->view("inventory/memory", $data);
		}else{
			$qins = $this->db->query("
				INSERT INTO tbl_memory (merk,type,kapasitas,byte) VALUES('$merk','$type','$kapasitas','$byte')
			");

			if($qins){
				redirect("C_memory/view_memory");
			}else{
				echo 'Error !';
			}
		}
	}
	
	function del_memory($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE tbl_memory SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_memory/view_memory");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$cek = $this->db->query("
			select * from tbl_memory where id = '$id'
        ");
        
		$id_type = $cek->row()->type;
		$merk = $cek->row()->merk;
		$kapasitas = $cek->row()->kapasitas;
		$byte = $cek->row()->byte;

        $data = array('id' => $id, 'merk' => $merk, 'type' => $id_type, 'kapasitas' => $kapasitas, 'byte' => $byte);
        
		$this->load->view("inventory/edit/edit_memory", $data);
	}

	function update_memory(){
		$id = $this->input->post("id");
		$type = $this->input->post("type");
		$kapasitas = $this->input->post("kapasitas");
		$merk = $this->input->post("merk");
		$byte = $this->input->post("byte");

		$query = $this->db->query("
			update tbl_memory set merk = '$merk', byte = '$byte', type = '$type', kapasitas = '$kapasitas' where id = '$id'
		");

		if($query){
			redirect("C_memory/view_memory");
		}else{
			echo 'Error !';
		}

	}

	function add_stok(){
		$id_mem = $this->input->post("id_mem");
		$mem_stok = $this->input->post("mem_stok");

		$cek_stok = $this->db->query("
			select stok from tbl_memory where id = '$id_mem'
		");

		$stok_now = $cek_stok->row()->stok;
		
		if($stok_now == NULL){
			$sn = 0+$mem_stok;
		}else{
			$sn = $stok_now+$mem_stok;
		}

		$updt_sm = $this->db->query("
			update tbl_memory set stok = '$sn' where id = '$id_mem'
		");

		redirect("C_memory/view_memory");

	}

}

?>
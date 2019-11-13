<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_hardisk extends CI_Controller{
 
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

    function view_hardisk(){
        $this->load->view("inventory/hardisk");
    }

    function add_hardisk(){
        $merk = $this->input->post("merk");
		$type = $this->input->post("type");
		$kapasitas = $this->input->post("kapasitas");
		$byte = $this->input->post("byte");

		$cek = $this->db->query("
			select * from tbl_hardisk where merk = '$merk' and type='$type' and kapasitas = '$kapasitas' and byte = '$byte' and hapus IS NULL
		");

		if($cek->num_rows() > 0){
			$data['error'] = '
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Alert !</strong> Hardisk sudah ada !
		  	</div>';
			$this->load->view("inventory/hardisk", $data);
		}else{
			$qins = $this->db->query("
				INSERT INTO tbl_hardisk (merk,type,kapasitas,byte) VALUES('$merk','$type','$kapasitas','$byte')
			");

			if($qins){
				redirect("C_hardisk/view_hardisk");
			}else{
				echo 'Error !';
			}
		}
	}
	
	function del_hardisk($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE tbl_hardisk SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_hardisk/view_hardisk");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$cek = $this->db->query("
			select * from tbl_hardisk where id = '$id'
        ");
        
        $id_merk = $cek->row()->merk;
		$id_type = $cek->row()->type;
		$kapasitas = $cek->row()->kapasitas;
		$byte = $cek->row()->byte;

        $data = array('id' => $id, 'merk'=> $id_merk, 'type' => $id_type, 'kapasitas' => $kapasitas, 'byte' => $byte);
        
		$this->load->view("inventory/edit/edit_hardisk", $data);
	}

	function update_hardisk(){
        $id = $this->input->post("id");
        $merk = $this->input->post("merk");
		$type = $this->input->post("type");
		$kapasitas = $this->input->post("kapasitas");
		$byte = $this->input->post("byte");

		$query = $this->db->query("
			update tbl_hardisk set merk = '$merk', type = '$type', kapasitas = '$kapasitas', byte = '$byte' where id = '$id'
		");

		if($query){
			redirect("C_hardisk/view_hardisk");
		}else{
			echo 'Error !';
		}

	}

	function add_stok(){
		$id_hdd = $this->input->post("id_hdd");
		$stok = $this->input->post("stok");

		$cek_stok = $this->db->query("
			select stok from tbl_hardisk where id = '$id_hdd'
		");

		$stok_now = $cek_stok->row()->stok;
		
		if($stok_now == NULL){
			$sn = 0+$stok;
		}else{
			$sn = $stok_now+$stok;
		}

		$updt_sm = $this->db->query("
			update tbl_hardisk set stok = '$sn' where id = '$id_hdd'
		");

		redirect("C_hardisk/view_hardisk");

	}

}

?>
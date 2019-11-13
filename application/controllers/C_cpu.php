<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cpu extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}	
    }

    function view_cpu(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');
		
        $this->load->view("inventory/cpu");
    }

    function add_cpu(){
        $proc = $this->input->post("proc");
        $memory = $this->input->post("memory");
		$hardisk = $this->input->post("hardisk");

		if(is_array($proc)){
			$pok = implode(",", $proc);
		}else{
			$pok = $proc;
		}
		
		$cs_proc = $this->db->query("
			select stok from tbl_processor where id = '$pok'
		");

		$stok_proc = $cs_proc->row()->stok; //value stok processor

		if($stok_proc < 1){
			//processor habis
			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Processor Habis !
			</div>
			';
			$this->load->view("inventory/cpu", $data);
			//reload dengan pemberitahuan
		}else{
			//processor masih ada
			//cek stok memory
			$cs_mem = $this->db->query("
				select stok from tbl_memory where id = '$memory'
			");

			$stok_mem = $cs_mem->row()->stok;

			if($stok_mem < 1){
				$data['error'] = '
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Alert !</strong> Stok Memory Habis !
				</div>
				';
				//reload dengan pemberitahuan
				$this->load->view("inventory/cpu", $data);
			}else{
				//memory masih ada
				//cek stok hardisk
				$cs_hdd = $this->db->query("
					select stok from tbl_hardisk where id = '$hardisk'
				");

				$stok_hdd = $cs_hdd->row()->stok;

				if($stok_hdd < 1){
					//stok hdd habis
					$data['error'] = '
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Alert !</strong> Stok Hardisk Habis !
					</div>
					';
					$this->load->view("inventory/cpu", $data);
					//reload dengan pemberitahuan
				}else{
					//hardisk masih ada
					//oke bisa insert
					//echo $stok_proc;
					//echo $stok_mem;
					//echo $stok_hdd;
					$qins = $this->db->query("
						INSERT INTO master_cpu (id_processor,id_memory,id_hardisk) 
						VALUES('$pok','$memory','$hardisk')
					");

					$sb_proc = ($stok_proc) - 1;
					$sb_mem = ($stok_mem) - 1;
					$sb_hdd = ($stok_hdd) - 1;
					
					if($qins){

						$this->db->query("
							update tbl_processor set stok = '$sb_proc' where id = '$proc'
						");

						$this->db->query("
							update tbl_memory set stok = '$sb_mem' where id = '$memory'
						");

						$this->db->query("
							update tbl_hardisk set stok = '$sb_hdd' where id = '$hardisk'
						");

						redirect("C_cpu/view_cpu");

					}else{
						echo 'Error !';
					}

				}
			}

		}

		/**/
        
	}
	
	function del_cpu($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE master_cpu SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_cpu/view_cpu");
		}else{
			echo 'Error !';
		}
	}

	function edit_page($id){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');
		
		$cek = $this->db->query("
			select * from master_cpu where id = '$id'
        ");
        
        $id_processor = $cek->row()->id_processor;
		$id_memory = $cek->row()->id_memory;
		$id_hardisk = $cek->row()->id_hardisk;

		$data = array('id' => $id, 'id_processor'=> $id_processor, 'id_memory' => $id_memory, 'id_hardisk' => $id_hardisk);
        
		$this->load->view("inventory/edit/edit_cpu", $data);
	}

	function update_cpu(){
		
		$id = $this->input->post("id");
		$proc = $this->input->post("proc");
        $memory = $this->input->post("memory");
		$hardisk = $this->input->post("hardisk");
		
		if(is_array($proc)){
			$imp_proc = implode(",", $proc);
		}else{
			$imp_proc = $proc;
		}

		if(is_array($memory)){
			$imp_mem = implode(",", $memory);
		}else{
			$imp_mem = $memory;
		}

		if(is_array($hardisk)){
			$imp_hdd = implode(",", $hardisk);
		}else{
			$imp_hdd = $hardisk;
		}

		$query = $this->db->query("
			update master_cpu set id_processor = '$imp_proc', id_memory = '$imp_mem', id_hardisk = '$imp_hdd' where id = '$id'
		");

		if($query){
			redirect("C_cpu/view_cpu");
		}else{
			echo 'Error !';
		}

	}

	function view_cpu2($id){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		if($id == 1){

			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Processor Habis !
			</div>
			';
			$this->load->view("inventory/cpu", $data);

		}elseif($id == 2){

			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Memory Habis !
			</div>
			';
			$this->load->view("inventory/cpu", $data);

		}elseif($id == 3){

			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Hardisk Habis !
			</div>
			';
			$this->load->view("inventory/cpu", $data);

		}
	}

	function add_cpu2(){
		$proc = $this->input->post("proc");
        $memory = $this->input->post("memory");
		$hardisk = $this->input->post("hardisk");

		foreach ($proc as $dtp) {
			$query1 = $this->db->query("select * from tbl_processor where id = '$dtp'");
			 //echo $score;
			$res = $query1->row()->stok;
			//echo $res.'<br>';
			if($res < 1){
				$data = 1;
				redirect("C_cpu/view_cpu2/".$data);
			}else{
				//echo 'bisa insert';
			}
		}

		foreach ($memory as $dtm) {
			$query1 = $this->db->query("select * from tbl_memory where id = '$dtm'");
			 //echo $score;
			$res = $query1->row()->stok;
			//echo $res.'<br>';
			if($res < 1){
				$data['error'] = '
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Alert !</strong> Stok Memory Kosong !
				</div>
				';
				$data = 2;
				redirect("C_cpu/view_cpu2/".$data);
				//langsung redirect
			}else{
				///echo 'bisa insert';
			}
		}

		foreach ($hardisk as $dth) {
			$query1 = $this->db->query("select * from tbl_hardisk where id = '$dth'");
			 //echo $score;
			$res = $query1->row()->stok;
			//echo $res.'<br>';
			if($res < 1){
				$data['error'] = '
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Alert !</strong> Stok Hardisk Kosong !
				</div>
				';
				$data = 3;
				redirect("C_cpu/view_cpu2/".$data);
				//langsung redirect
			}else{
				//echo 'bisa insert';
			}
		}

		if(is_array($proc)){
			$imp_proc = implode(",", $proc);
		}else{
			$imp_proc = $proc;
		}

		if(is_array($memory)){
			$imp_mem = implode(",", $memory);
		}else{
			$imp_mem = $memory;
		}

		if(is_array($hardisk)){
			$imp_hdd = implode(",", $hardisk);
		}else{
			$imp_hdd = $hardisk;
		}

		$qins = $this->db->query("
			INSERT INTO master_cpu (id_processor,id_memory,id_hardisk) 
			VALUES('$imp_proc','$imp_mem','$imp_hdd')
		");

		if($qins){

			foreach ($proc as $dtp) {
				$query1 = $this->db->query("select * from tbl_processor where id = '$dtp'");
				//echo $score;
				$res = $query1->row()->stok;
				$sb_proc = ($res) - 1;
				
				$this->db->query("
					update tbl_processor set stok = '$sb_proc' where id = '$dtp'
				");		
			}
	
			foreach ($memory as $dtm) {
				$query1 = $this->db->query("select * from tbl_memory where id = '$dtm'");
				 //echo $score;
				$res = $query1->row()->stok;
	
				$sb_mem = ($res) - 1;
	
				$this->db->query("
					update tbl_memory set stok = '$sb_mem' where id = '$dtm'
				");
	
			}
	
			foreach ($hardisk as $dth) {
				$query1 = $this->db->query("select * from tbl_hardisk where id = '$dth'");
				 //echo $score;
				$res = $query1->row()->stok;
				
				$sb_hdd = ($res) - 1;
	
				$this->db->query("
					update tbl_hardisk set stok = '$sb_hdd' where id = '$dth'
				");
	
	
			}

			redirect("C_cpu/view_cpu");

		}else{

		}
		

	}



}

?>
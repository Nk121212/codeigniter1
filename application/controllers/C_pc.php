<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pc extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}
    }

    function view_pc(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	

        $this->load->view("inventory/pc");
	}
	
	function view_pc2($id){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	

		//1 = mouse, 2 = keyboard, 3=monitor, 4 = printer;
		if($id == 1){
			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Mouse Habis !
			</div>
			';
		}elseif($id == 2){
			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Keyboard Habis !
			</div>
			';
		}elseif($id == 3){
			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Monitor Habis !
			</div>
			';
		}elseif($id == 4){
			$data['error'] = '
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Alert !</strong> Stok Printer Habis !
			</div>
			';
		}
		$this->load->view("inventory/pc", $data);
	}

    function add_pc(){
		$nmp = $this->input->post("nm_pc");
		$cpu = $this->input->post("cpu");
		$mouse = $this->input->post("mouse");
        $keyboard = $this->input->post("keyboard");  
        $monitor = $this->input->post("monitor");
        $printer = $this->input->post("printer");
		$lok = $this->input->post("lok");
		$id_user = $this->input->post("id_user");
		$id_user_pc = $this->input->post("user_pc");

		if(is_array($mouse)){
			$id_mouse = implode(",", $mouse);
		}else{
			$id_mouse = $mouse;
		}

		if(is_array($keyboard)){
			$id_keyboard = implode(",", $keyboard);
		}else{
			$id_keyboard = $keyboard;
		}

		if(is_array($monitor)){
			$id_monitor = implode(",", $monitor);
		}else{
			$id_monitor = $monitor;
		}

		if(is_array($printer)){
			$id_printer = implode(",", $printer);
		}else{
			$id_printer = $printer;
		}

		foreach($mouse as $dtmouse){
			$cek_mouse = $this->db->query("
				select stok from tbl_mouse where id = '$dtmouse'
			");

			$sn_mouse = $cek_mouse->row()->stok; //value stok

			if($sn_mouse < 1){
				$dt_el = 1;
				redirect("C_pc/view_pc2/".$dt_el);
			}else{

			}
		}

		foreach($keyboard as $dtkeyboard){
			$cek_keyboard = $this->db->query("
				select stok from tbl_keyboard where id = '$dtkeyboard'
			");

			$sn_keyboard = $cek_keyboard->row()->stok;

			if($sn_keyboard < 1){
				$dt_el = 2;
				redirect("C_pc/view_pc2/".$dt_el);
			}else{

			}
		}

		foreach($monitor as $dtmonitor){
			$cek_monitor = $this->db->query("
				select stok from tbl_monitor where id = '$dtmonitor'
			");

			$sn_monitor = $cek_monitor->row()->stok;

			if($sn_monitor < 1){
				$dt_el = 3;
				redirect("C_pc/view_pc2/".$dt_el);
			}else{

			}
		}

		foreach($printer as $dtprinter){
			$cek_printer = $this->db->query("
				select stok from tbl_printer where id = '$dtprinter'
			");

			$sn_printer = $cek_printer->row()->stok;

			if($sn_printer < 1){
				$dt_el = 4;
				redirect("C_pc/view_pc2/".$dt_el);
			}else{

			}
		}
		
		$jml_id = $this->db->query("select count(id) as jumlah from master_pc");
		$jumlah = $jml_id->row()->jumlah;

		if($jumlah == 0){
			$generate = $this->db->query("
				select concat_ws('', DATE_FORMAT((NOW()) ,'%m%Y'), '0001') as uid1;
			");
		}else{
			$generate = $this->db->query("
				select if((substr(uid, 1, 6) = DATE_FORMAT((NOW()) ,'%m%Y')), 
				concat_ws('', DATE_FORMAT((NOW()) ,'%m%Y'), lpad((substr(uid,7,4)+1),4,'0')), 
				concat_ws('', DATE_FORMAT((NOW()) ,'%m%Y'), '0001')) as uid1
				from master_pc 
				where uid = (select max(uid) from master_pc);
			");
		}

		$uid1 = $generate->row()->uid1;

		$qins = $this->db->query("
			INSERT INTO master_pc (nama_pc, uid,id_cpu,id_mouse,id_keyboard, id_monitor, id_printer, id_bagian, id_user, id_user_pc) 
			VALUES('$nmp','$uid1','$cpu','$id_mouse','$id_keyboard','$id_monitor','$id_printer','$lok','$id_user', '$id_user_pc')
		");

		foreach($mouse as $dtmouse){
			$cek_mouse = $this->db->query("
				select stok from tbl_mouse where id = '$dtmouse'
			");

			$sn_mouse = $cek_mouse->row()->stok; //value stok

			$cs_mouse = ($sn_mouse) - 1;

			$this->db->query("
				update tbl_mouse set stok = '$cs_mouse' where id = '$dtmouse'
			");

		}

		foreach($keyboard as $dtkeyboard){
			$cek_keyboard = $this->db->query("
				select stok from tbl_keyboard where id = '$dtkeyboard'
			");

			$sn_keyboard = $cek_keyboard->row()->stok;

			$cs_keyboard = ($sn_keyboard) - 1;

			$this->db->query("
				update tbl_keyboard set stok = '$cs_keyboard' where id = '$dtkeyboard'
			");
		}

		foreach($monitor as $dtmonitor){
			$cek_monitor = $this->db->query("
				select stok from tbl_monitor where id = '$dtmonitor'
			");

			$sn_monitor = $cek_monitor->row()->stok;

			$cs_monitor = ($sn_monitor) - 1;

			$this->db->query("
				update tbl_monitor set stok = '$cs_monitor' where id = '$dtmonitor'
			");
		}

		foreach($printer as $dtprinter){
			$cek_printer = $this->db->query("
				select stok from tbl_printer where id = '$dtprinter'
			");

			$sn_printer = $cek_printer->row()->stok;

			$cs_printer = ($sn_printer) - 1;

			$this->db->query("
				update tbl_printer set stok = '$cs_printer' where id = '$dtprinter'
			");
		}

		$this->db->query("
			update master_cpu set used = 1 where id = '$cpu'
		");

		redirect("C_pc/view_pc");
		
	}
	
	function del_pc($id){
		$iduser =  $this->session->userdata("id");

		$query = $this->db->query("
			UPDATE master_pc SET hapus = '$iduser' WHERE id = '$id' 
		");

		if($query){
			redirect("C_pc/view_pc");
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
			select * from master_pc where id = '$id'
		");

		$nama_pc = $cek->row()->nama_pc;
		$id_cpu = $cek->row()->id_cpu;
		$id_mouse = $cek->row()->id_mouse;
        $id_keyboard = $cek->row()->id_keyboard;
        $id_monitor = $cek->row()->id_monitor;
        $id_printer = $cek->row()->id_printer;
		$id_bagian = $cek->row()->id_bagian;
		//$bagian = $cek->row()->bagian;
		$id_user = $cek->row()->id_user;
		$user_pc = $cek->row()->id_user_pc;

        $data = array('id' => $id, 'nama_pc' => $nama_pc, 'cpu' => $id_cpu, 'mouse' => $id_mouse, 'keyboard' => $id_keyboard, 
        'monitor' => $id_monitor, 'printer' => $id_printer, 'lok' => $id_bagian, 'id_user' => $id_user, 'user_pc'=> $user_pc);

		$this->load->view("inventory/edit/edit_pc", $data);
	}

	function update_pc(){
		$id = $this->input->post("id");
		$nm_pc = $this->input->post("nm_pc");
		$cpu_before = $this->input->post("bef_cpu");
		$cpu = $this->input->post("cpu");
		$mouse = $this->input->post("mouse");
        $keyboard = $this->input->post("keyboard");  
        $monitor = $this->input->post("monitor");
        $printer = $this->input->post("printer");
		$lok = $this->input->post("lok");
		$id_user = $this->input->post("id_user");
		$id_user_pc = $this->input->post("user_pc");

		if(is_array($mouse)){
			$id_mouse = implode(",", $mouse);
		}else{
			$id_mouse = $mouse;
		}

		if(is_array($keyboard)){
			$id_keyboard = implode(",", $keyboard);
		}else{
			$id_keyboard = $keyboard;
		}

		if(is_array($monitor)){
			$id_monitor = implode(",", $monitor);
		}else{
			$id_monitor = $monitor;
		}

		if(is_array($printer)){
			$id_printer = implode(",", $printer);
		}else{
			$id_printer = $printer;
		}

		$this->db->query("
			update master_cpu set used = 0 where id = '$cpu_before'
		");

		$query = $this->db->query("
			update master_pc set nama_pc = '$nm_pc', id_cpu = '$cpu', id_mouse = '$id_mouse', id_keyboard = '$id_keyboard', 
			id_monitor = '$id_monitor', id_printer = '$id_printer', id_bagian = '$lok', id_user = '$id_user', id_user_pc = '$id_user_pc'
            where id = '$id'
		");

		$this->db->query("
			update master_cpu set used = 1 where id = '$cpu'
		");

		if($query){
			redirect("C_pc/view_pc");
		}else{
			echo 'Error !';
		}

	}

	function data_user(){

		$id_bagian = $this->input->post("id_bagian");

		$quser = $this->db->query("
			select * from tbl_user where hapus is null and bagian = '$id_bagian' order by nama asc
		");

		echo '

		User Admin : 
			<select name="id_user" id="id_user" class="form-control" required>

		
			<option value="" disabled selected>Pilih User</option>
		';

		foreach($quser->result() as $dproc){
			echo '
				<option value="'.$dproc->id.'">'.$dproc->nama.'</option>
			';
		}

		echo '
			</select>

			<script>
				$("#id_user").change(function(){
					var valid = $("#id_user").val();
					//alert(valid);
				})
			</script>
		';
	}

	function data_user_edit(){
		
		$id_bagian = $this->input->post("lokasi");

		$quser = $this->db->query("
			select * from tbl_user where hapus is null and bagian = '$id_bagian' order by nama asc
		");

		echo '
			<option value="" disabled selected>Pilih User</option>
		';

		foreach($quser->result() as $dproc){
			echo '
				<option value="'.$dproc->id.'">'.$dproc->nama.'</option>
			';
		}
	}

	function view_user_pc(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	

		$this->load->view("inventory/user_pc");
	}

	function add_user_pc(){

		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	

		$nm_user = $this->input->post("nm_user");
		$add_by = $this->session->userdata("id");

		$cek = $this->db->query("
			SELECT * FROM user_pc WHERE user_pc = '$nm_user';
		");

		if($cek->num_rows() < 1){

			$query = $this->db->query("
				INSERT INTO user_pc (`user_pc`, `add_by`, `add_at`) value('$nm_user', '$add_by', now());
			");

			redirect("C_pc/view_user_pc");
			
		}else{

			$data['error_insert'] = '<p style="color:red;">Nama Sudah Ada !</p>';
			$this->load->view("inventory/user_pc", $data);

		}
	}

	function edit_user_pc($id){

		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	

		$id_user_pc = $id;
		
		$query = $this->db->query("
			select * from user_pc where id = '$id_user_pc'
		");

		//$id_user = $query->row()->id;
		$nama_user = $query->row()->user_pc;

		$data = array('id' => $id_user_pc, 'nm_user' => $nama_user);

		$this->load->view("inventory/edit/edit_user_pc", $data);

	}

	function update_user_pc(){

		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');	

		$id_up = $this->input->post("id_up");
		$nm_baru = $this->input->post("nm_user");

		$query1 = $this->db->query("SELECT * FROM user_pc WHERE user_pc = BINARY '$nm_baru'");

		if($query1->num_rows() < 1){

			$query2 = $this->db->query("
				update user_pc set user_pc = '$nm_baru' where id = '$id_up'
			");

			redirect("C_pc/view_user_pc");

		}else{
			$data['error_update'] = 'Nama Sudah Ada !';
			$this->load->view("inventory/user_pc", $data);
		}

	}


}

?>
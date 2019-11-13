<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /*function __construct(){
		parent::__construct();		
		//$this->load->model('m_login'); 
	}*/
	
	//==================================================================================================================
	function index(){
		$this->load->view('v_login');
	}
 
	//==================================================================================================================
	function submitlogin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'nama' => $username,
			'password' => $password
			);
		//$cek = $this->m_login->cek_login("tbl_usera", $where)->num_rows();
		
		$cek = $this->db->query("
			select a.id, a.nama, a.username, a.email, a.level, a.departemen, a.bagian, a.telp, a.lokasi, b.nama_dept, c.nama_bagian 
			from tbl_user as a 
			left join tbl_department as b on b.kd = a.departemen 
			left join tbl_bagian as c on c.kd = a.bagian 
			where a.email = '$username' 
			and a.password = password('$password') and a.hapus is null;
		");

		if($cek->num_rows() > 0){ 

			$row = $cek->row();
			
			if (isset($row)) {			
				$data_session = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'username' => $row->username,
					'email' => $row->email,					
					'level' => $row->level,
					'departemen' => $row->departemen,
					'bagian' => $row->bagian,
					'telp' => $row->telp,
					'nama_dept' => $row->nama_dept,
					'nama_bagian' => $row->nama_bagian,
					'lokasi' => $row->lokasi,
					'status' => "login"
					);
	
				$this->session->set_userdata($data_session);				

				redirect(base_url("index.php/dashboard")); // BARU SAMPE SINI
			} 
		} 
		else {
			redirect(base_url("index.php"));
		}
	}
 
	//==================================================================================================================
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php'));
	}























	
	//==================================================================================================================
	function testsimpan(){
		$mul = $this->input->post('mul_ggux');
		$sel = $this->input->post('sel_ggux');
				
		/* CONTOH QUERY DENGAN BINDING ARRAY */ 
		//$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
		//$this->db->query($sql, array(3, 'live', 'Rick'));

		//$cek = $this->db->query("insert into testaja (mul, sel) values ('".$mul."', '".$sel."');a");
		
		$query = "insert into testaja (mul, sel) values (?, ?);";  	/* DEKLARASI QUERY */
		$data = array($mul, $sel);									/* DEKLARASI BINDING ARRAY */

		$this->db->query($query, $data); 							/* SQL EKSEKUSI */		

		redirect(base_url('index.php/dashboard'));
	}

	
}

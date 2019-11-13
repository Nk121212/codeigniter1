<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

class Lainlain extends CI_Controller{

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
 
	//=================================================================================================================================================
	function index(){		
		$this->load->view('forms/test1.php');
    }
	
	//=================================================================================================================================================
	function daftarkondisi(){
		$this->load->model('m_lainlain');		                /* di load dulu model nya agar bisa digunakan */

		$row['daftar_kondisi'] = $this->m_lainlain->data_kondisi();		/* panggil function di dalem model */

		$this->load->view('forms/daftarkondisi.php', $row);
	}

	//=================================================================================================================================================
	function tambahkondisi(){
		$this->load->model('m_lainlain');		                /* di load dulu model nya agar bisa digunakan */

		$this->m_lainlain->tambah_kondisi();					/* panggil function di dalem model */

		redirect('/lainlain/daftarkondisi');
	}

	//=================================================================================================================================================
	
	function job_desc(){
		$this->load->view('forms/job_desc');
	}

	function tambah_desc(){
		$desc = $this->input->post("txt_kondisi");
		$jenis = $this->input->post("js");

		$this->db->query("
		INSERT INTO tbl_job_desc (deskripsi,jenis_service) VALUES ('$desc','$jenis')
		");

		redirect('/lainlain/job_desc');
	}
	
	//=================================================================================================================================================
	//=================================================================================================================================================
	function daftarbagian(){
		$this->load->model('m_lainlain');		                		/* di load dulu model nya agar bisa digunakan */

		$row['daftar_bagian'] = $this->m_lainlain->data_bagian();		/* panggil function di dalem model */

		$this->load->view('forms/daftarbagian.php', $row);
	}

	//=================================================================================================================================================
	function tambahbagian(){
		$this->load->model('m_lainlain');		                /* di load dulu model nya agar bisa digunakan */

		$this->m_lainlain->tambah_bagian();						/* panggil function di dalem model */

		redirect('/lainlain/daftarbagian');
	}

	//=================================================================================================================================================
	function nonaktifkanbagian() {
		$this->load->model('m_lainlain');		/* di load dulu model nya agar bisa digunakan */

		$id = $this->input->post('kd');			/* Deklarasi variable */
		$this->m_lainlain->nonaktifbagian($id);	/* panggil function di dalem model */
		
		redirect('/lainlain/daftarbagian');
	}

	//=================================================================================================================================================
	function aktifkanbagian() {
		$this->load->model('m_lainlain');		/* di load dulu model nya agar bisa digunakan */

		$id = $this->input->post('kd');			/* Deklarasi variable */
		$this->m_lainlain->aktifbagian($id);		/* panggil function di dalem model */
		
		redirect('/lainlain/daftarbagian');
	}

	//=================================================================================================================================================
	function simpanbagian() {
		$this->load->model('m_lainlain');		/* di load dulu model nya agar bisa digunakan */

		$this->m_lainlain->simpan_bagian();		/* panggil function di dalem model */
		
		redirect('/lainlain/daftarbagian');
	}

	//=================================================================================================================================================
	//=================================================================================================================================================
	//=================================================================================================================================================
	function daftardepartemen(){	
		$this->load->model('m_lainlain');		                /* di load dulu model nya agar bisa digunakan */

		$row['daftar_departemen'] = $this->m_lainlain->data_departemen();		/* panggil function di dalem model */
		
		$this->load->view('forms/daftardepartemen.php', $row);
	}
	
	//=================================================================================================================================================
	function nonaktifkandepartemen() {
		$this->load->model('m_lainlain');		                /* di load dulu model nya agar bisa digunakan */

		$id = $this->input->post('kd');             			/* Deklarasi variable */
		$this->m_lainlain->nonaktifdepartemen($id);			/* panggil function di dalem model */
		
		redirect('/lainlain/daftardepartemen');
	}

	//=================================================================================================================================================
	function aktifkandepartemen() {
		$this->load->model('m_lainlain');		                /* di load dulu model nya agar bisa digunakan */

		$id = $this->input->post('kd');             			/* Deklarasi variable */
		$this->m_lainlain->aktifdepartemen($id);				/* panggil function di dalem model */
		
		redirect('/lainlain/daftardepartemen');
	}

	//=================================================================================================================================================
	function simpandepartemen() {
		$this->load->model('m_lainlain');			/* di load dulu model nya agar bisa digunakan */

		$this->m_lainlain->simpan_departemen();	/* panggil function di dalem model */
		
		redirect('/lainlain/daftardepartemen');
	}

}

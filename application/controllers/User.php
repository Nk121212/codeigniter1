<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

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
	function daftaruser(){	
		$this->load->model('m_user'); 		                /* di load dulu model nya agar bisa digunakan */

		$row['daftar_user'] = $this->m_user->data_user();	/* panggil function di dalem model */
		
		$this->load->view('forms/daftaruser.php', $row);
	}

    //=================================================================================================================================================
	function nonaktifkanuser(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */

        $id = $this->input->post('id');             /* Deklarasi variable */
		$this->m_user->nonaktifuser($id);           /* panggil function di dalem model */
		
		redirect('/user/daftaruser');
    }
    
    //=================================================================================================================================================
	function aktifkanuser(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */

        $id = $this->input->post('id');             /* Deklarasi variable */
		$this->m_user->aktifuser($id);              /* panggil function di dalem model */
		
		redirect('/user/daftaruser');
	}
  
    //=================================================================================================================================================
	function tambahuser(){	
		$this->load->model('m_user'); 		                /* di load dulu model nya agar bisa digunakan */

        $row['daftar_departemen'] = $this->m_user->ambil_daftar_departemen();       /* panggil function di dalem model */
        $row['daftar_bagian'] = $this->m_user->ambil_daftar_bagian();               /* panggil function di dalem model */
        
		$this->load->view('forms/tambahuser.php', $row);
    }
    
    //=================================================================================================================================================
	function simpanuser(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */

		$this->m_user->simpan_user();              /* panggil function di dalem model */
		
		redirect('/user/daftaruser');
	}
	
	//=================================================================================================================================================
	function userprofile(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */

		$id = $this->session->userdata('id');
		$row['user_profile'] = $this->m_user->ambil_user_profile($id);               /* panggil function di dalem model */
		
		$this->load->view('forms/userprofile.php', $row);
	}

	//=================================================================================================================================================
	function ubahpassword(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */
		
		$id = $this->session->userdata('id');
		$row['user_profile'] = $this->m_user->ambil_user_profile($id);               /* panggil function di dalem model */
		
		$this->load->view('forms/ubahpassword.php', $row);
	}

	//=================================================================================================================================================
	function updatepassword(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */
		
		$this->m_user->simpan_password_baru();               /* panggil function di dalem model */
		
		redirect('user/userprofile');
	}

	//=================================================================================================================================================
	function edituser(){	
		$this->load->model('m_user');               /* di load dulu model nya agar bisa digunakan */		
		
		$id = $this->input->post('id');
		$row['user_profile'] = $this->m_user->ambil_user_profile($id);              /* panggil function di dalem model */
		$row['daftar_departemen'] = $this->m_user->ambil_daftar_departemen();       /* panggil function di dalem model */
		$row['daftar_bagian'] = $this->m_user->ambil_daftar_bagian();               /* panggil function di dalem model */
		$row['daftar_lokasi'] = $this->m_user->ambil_daftar_lokasi();               /* panggil function di dalem model */
		
		$this->load->view('forms/edituser.php', $row); 
	}
	
	function password_baru(){
		$this->load->model('m_user');
		$this->m_user->password_baru();
		redirect("user/daftaruser");
	}

	//=================================================================================================================================================
	function simpanuseredited(){	
		$this->load->model("m_user");               
		$this->m_user->simpan_user_edited(); 
		
		redirect("/user/daftaruser");
	}


    
}
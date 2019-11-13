<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

class Bukti extends CI_Controller{
 
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
	function buktiservice(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	

		$id = $this->input->post('id');										/* Deklarasi variable */
		$row['data_teknisi'] = $this->m_bukti->data_teknisi();				/* panggil function di dalem model */
		$row['data_permintaan'] = $this->m_bukti->data_permintaan($id);		/* panggil function di dalem model */

		$this->load->view('forms/buktiservice.php', $row);
	}
	
	//=================================================================================================================================================
	function buktipenyerahan(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	

		$id = $this->input->post('id');										/* Deklarasi variable */
		$row['data_teknisi'] = $this->m_bukti->data_teknisi();				/* panggil function di dalem model */	
		$row['data_permintaan'] = $this->m_bukti->data_permintaan($id);		/* panggil function di dalem model */

		$this->load->view('forms/buktipenyerahan.php', $row);
    }
	
	//=================================================================================================================================================
	function buktiupdateaplikasi(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	

		$id = $this->input->post('id');										/* Deklarasi variable */
		$row['data_teknisi'] = $this->m_bukti->data_teknisi();				/* panggil function di dalem model */	
		$row['data_permintaan'] = $this->m_bukti->data_permintaan($id);		/* panggil function di dalem model */

		$this->load->view('forms/buktiupdateaplikasi.php', $row);
	}
	
    //=================================================================================================================================================
	function simpanbuktiservice(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	

		$this->m_bukti->simpan_bukti_service();								/* panggil function di dalem model */
       
		redirect('/permintaan/daftarpermintaan');
	}

	//=================================================================================================================================================
	function simpanbuktipenyerahan(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	

		$this->m_bukti->simpan_bukti_penyerahan();							/* panggil function di dalem model */
       
		redirect('/permintaan/daftarpermintaan');
	}

	//=================================================================================================================================================
	function simpanbuktiupdateaplikasi(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	

		$this->m_bukti->simpan_bukti_updateaplikasi();							/* panggil function di dalem model */
       
		redirect('/permintaan/daftarpermintaan');
	}

	//=================================================================================================================================================
	//=================================================================================================================================================
	function editbuktiservice(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	
		
		$id = $this->input->post('id');													/* Deklarasi variable */
		$row['data_teknisi'] = $this->m_bukti->data_teknisi();							/* panggil function di dalem model */	
		$row['data_bukti_service'] = $this->m_bukti->ambil_data_bukti_service($id);		/* panggil function di dalem model */

		$this->load->view('forms/editbuktiservice.php', $row);
	}

	//=================================================================================================================================================
	function simpaneditbuktiservice(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	
		
		$this->m_bukti->simpan_bukti_service_edited();									/* panggil function di dalem model */

		redirect('/permintaan/daftarpermintaan');
	}
	
	//=================================================================================================================================================
	//=================================================================================================================================================
	function editbuktipenyerahan(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	
		
		$id = $this->input->post('id');															/* Deklarasi variable */
		$row['data_teknisi'] = $this->m_bukti->data_teknisi();									/* panggil function di dalem model */	
		$row['data_bukti_penyerahan'] = $this->m_bukti->ambil_data_bukti_penyerahan($id);		/* panggil function di dalem model */

		$this->load->view('forms/editbuktipenyerahan.php', $row);
	}

	//=================================================================================================================================================
	function simpaneditbuktipenyerahan(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	
		
		$this->m_bukti->simpan_bukti_penyerahan_edited();								/* panggil function di dalem model */

		redirect('/permintaan/daftarpermintaan');
	}

	//=================================================================================================================================================
	//=================================================================================================================================================
	function editbuktiupdateaplikasi(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	
		
		$id = $this->input->post('id');															/* Deklarasi variable */
		$row['data_teknisi'] = $this->m_bukti->data_teknisi();									/* panggil function di dalem model */	
		$row['data_bukti_updateaplikasi'] = $this->m_bukti->ambil_data_bukti_updateaplikasi($id);		/* panggil function di dalem model */

		$this->load->view('forms/editbuktiupdateaplikasi.php', $row);
	}

	//=================================================================================================================================================
	function simpaneditbuktiupdateaplikasi(){	
		$this->load->model('m_bukti'); 			/* di load dulu model nya agar bisa digunakan */	
		
		$this->m_bukti->simpan_bukti_penyerahan_edited();								/* panggil function di dalem model */

		redirect('/permintaan/daftarpermintaan');
	}
















}
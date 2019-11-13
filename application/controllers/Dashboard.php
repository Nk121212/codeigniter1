<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Controller{
 
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
 
	function index(){		
		$this->load->view('forms/blank.php');
		//$this->load->view('layouts/header_fullpage.php');
	}

}
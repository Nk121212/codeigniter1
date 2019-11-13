<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListController extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
	}
	
	function new_req(){
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');

		if($level == 'ADMIN' || $level == 'DEFAULT'){
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 0 AND statuz = 0 AND hapus IS NULL");
		}else{
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 0 AND iduser = '$id' AND statuz = 0 AND hapus IS NULL");
		}
		$row = $query->row();
		echo $row->jumlah;
	}
	
	function serv_req(){
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		if($level == 'ADMIN' || $level == 'DEFAULT'){
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 1 AND statuz = 0 AND hapus IS NULL");
		}else{
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 1 AND iduser = '$id' AND statuz = 0 AND hapus IS NULL");
		}
		
		$row = $query->row();
		echo $row->jumlah;
	}
	
	function item_req(){
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		if($level == 'ADMIN' || $level == 'DEFAULT'){
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 2 AND statuz = 0 AND hapus IS NULL");
		}else{
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 2 AND iduser = '$id' AND statuz = 0 AND hapus IS NULL");
		}
		
		$row = $query->row();
		echo $row->jumlah;
	}
	
	function app_req(){
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		if($level == 'ADMIN' || $level == 'DEFAULT'){
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 3 AND statuz = 0 AND hapus IS NULL");
		}else{
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where jenis_permintaan = 3 and iduser = '$id' AND statuz = 0 AND hapus IS NULL");
		}
		
		$row = $query->row();
		echo $row->jumlah;
	}
	
	function complete_req(){
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		if($level == 'ADMIN' || $level == 'DEFAULT'){
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where statuz = 1 AND hapus IS NULL");
		}else{
			$query = $this->db->query("select count(*) as jumlah from tbl_permintaan where statuz = 1 and iduser = '$id' AND hapus IS NULL");
		}
		$row = $query->row();
		echo $row->jumlah;
	}

}

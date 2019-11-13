<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

class M_lainlain extends CI_Model{
    
    //======================================================================================================================
    /* Ambil data daftar kondisi */
    function data_kondisi(){
		$query1 = $this->db->query("
            select a.id, a.kondisi
			from tbl_kondisi as a
            order by a.kondisi;
        ");        
        return $query1;                 
    }

    //======================================================================================================================
    /* Ambil data daftar bagian */
    function tambah_kondisi(){
        $kond = $this->input->post('txt_kondisi');
        $query1 = "insert into tbl_kondisi (kondisi) values (?);";

        $this->db->query($query1, array($kond));
            
        return True;                 
    }

    //======================================================================================================================
    //======================================================================================================================
    //======================================================================================================================
    /* Ambil data daftar bagian */
    function data_bagian(){
		$query1 = $this->db->query("
            select a.kd, a.nama_bagian, if(a.hapus is null, 'Aktif', 'Tidak Aktif') as 'statuz' 
			from tbl_bagian as a
            order by a.nama_bagian;
        ");        
        return $query1;                 
    }

    //======================================================================================================================
    /* Ambil data daftar bagian */
    function tambah_bagian(){
        $bagian = $this->input->post('txt_bagian');
        $query1 = "insert into tbl_bagian (kd, nama_bagian, tgl_buat) values (concat(uuid_short()), ?, now());";

        $this->db->query($query1, array($bagian));
            
        return True;                 
    }

    //======================================================================================================================
    /* Update data bagian (nonaktifkan bagian) */
    function nonaktifbagian($id){
		$query1 = $this->db->query("
            Update tbl_bagian set hapus = '*', tgl_hapus = now() where kd = '$id';
        ");        
        return True;                 
    }

    //======================================================================================================================
    /* Update data bagian (aktifkan bagian) */
    function aktifbagian($id){
		$query1 = $this->db->query("
            Update tbl_bagian set hapus = null, tgl_hapus = null where kd = '$id';
        ");        
        return True;                 
    }

    //======================================================================================================================
    /* menyimpan bagian */
    function simpan_bagian(){
        $namabagian =  $this->input->post('txt_bagian');

        $query1 = "insert into tbl_bagian (kd, nama_bagian, tgl_buat) 
            values 
            (concat(uuid_short()), ?, now());";

        $this->db->trans_begin();
        try {
            $this->db->query($query1, array($namabagian));
            $this->db->trans_commit();
        } catch (exception $e) {
            $this->db->trans_rollback();
        }
        return Null;
    }

    //======================================================================================================================
    //======================================================================================================================
    //======================================================================================================================
    /* Ambil data daftar departemen */
    function data_departemen(){
		$query1 = $this->db->query("
            select a.kd, a.nama_dept, if(a.hapus is null, 'Aktif', 'Tidak Aktif') as 'statuz' 
			from tbl_department as a
            order by a.nama_dept;
        ");        
        return $query1;                 
    }

    //======================================================================================================================
    /* Update data departemen (nonaktifkan departemen) */
    function nonaktifdepartemen($id){
		$query1 = $this->db->query("
            Update tbl_department set hapus = '*', tgl_hapus = now() where kd = '$id';
        ");        
        return True;                 
    }

    //======================================================================================================================
    /* Update data departemen (aktifkan departemen) */
    function aktifdepartemen($id){
		$query1 = $this->db->query("
            Update tbl_department set hapus = null, tgl_hapus = null where kd = '$id';
        ");        
        return True;                 
    }

    //======================================================================================================================
    /* menyimpan departemen */
    function simpan_departemen(){
        $namadepartemen =  $this->input->post('txt_departemen');
        
        $query1 = "insert into tbl_department (kd, nama_dept, tgl_buat) 
            values 
            (concat(uuid_short()), ?, now());";

        $this->db->trans_begin();
        try {
            $this->db->query($query1, array($namadepartemen));
            $this->db->trans_commit();
        } catch (exception $e) {
            $this->db->trans_rollback();
        }

        return Null;
    }

}
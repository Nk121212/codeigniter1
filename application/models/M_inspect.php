<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_inspect extends CI_Model{
        
        function insert(){

            $lok = $this->input->post('bag');
            $jns = $this->input->post('jns_ins');
            $estm = $this->input->post('est_mulai');
            $esth = $this->input->post('est_hari');

            $query = $this->db->query("
                INSERT INTO jadwal (g_id,lokasi,jenis,est_mulai,est_hari) VALUES(CONCAT(UUID_SHORT()),'$lok','$jns','$estm','$esth')
            ");

            return $query;
        }

        function detail_pc($id){

            $query = $this->db->query("
                SELECT * FROM jadwal WHERE id = $id
            ");

            $lokasi = $query->row()->lokasi;

            $query2 = $this->db->query("

                SELECT a.*, b.nama_bagian, c.user_pc as pengguna
                FROM master_pc a
                left join tbl_bagian b on a.id_bagian = b.kd 
                left join user_pc c on a.id_user_pc = c.id
                WHERE id_bagian = '$lokasi';
                
            ");
            
            return $query2;

        }

        function page_edit($id){
            
            $query = $this->db->query("
                SELECT * FROM jadwal WHERE id = $id
            ");

            return $query;
        }

        function edit_jadwal(){

            $id = $this->input->post("id");
            $lokasi = $this->input->post("bag");
            $jenis = $this->input->post("jns_ins");
            $est_mulai = $this->input->post("est_mulai");
            $est_hari = $this->input->post("est_hari");

            $query = $this->db->query("
                UPDATE jadwal SET lokasi = '$lokasi', jenis = '$jenis', est_mulai = '$est_mulai', est_hari = '$est_hari' WHERE id = $id
            ");

            return true;
        }

        function del_jadwal($id){

            $query = $this->db->query("
                DELETE FROM jadwal WHERE id = $id
            ");

            return true;

        }
    }
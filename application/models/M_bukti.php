<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

class M_bukti extends CI_Model{
    
    //======================================================================================================================
    /* Ambil data teknisi */
    function data_teknisi(){
		$query1 = $this->db->query("
            select a.id, a.nama, a.email
            from tbl_user as a 
            where a.departemen = '97816189442457875' order by a.nama;
        ");        
        return $query1;                 
    }

    //======================================================================================================================    
    /* mengambil data permintaan */
    function data_permintaan($id){
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, d.pada
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_permintaan_log as d on d.id_permintaan = a.id_permintaan
            where a.hapus is null and d.statuz = 'Baru Dibuat' and a.id = '$id';
        ");       
        return $query1;
    }

    //======================================================================================================================
    /* untuk men-generate kode id bukti service / penyerahan */
    function kode_id_bukti(){
        $cek = $this->db->query("select count(id) as jumlah from tbl_bukti where hapus is null");
        $hasilcek = $cek->row();

        if ($hasilcek->jumlah == 0) {
            $generate = $this->db->query("select concat_ws('','POS', DATE_FORMAT((NOW()) ,'%Y%m%d'), '001') as kbs;");  /* kbs = kode bukti service, POS = Proof of Service */
            $kodebukti = $generate->row();
        }
        else {
            $generate = $this->db->query("
                select if((substr(id_bukti, 4, 8) = DATE_FORMAT((NOW()) ,'%Y%m%d')), 
                concat_ws('','POS', DATE_FORMAT((NOW()) ,'%Y%m%d'), lpad((substr(id_bukti,12,3)+1),3,'0')), 
                concat_ws('','POS', DATE_FORMAT((NOW()) ,'%Y%m%d'), '001')) as kbs 
                from tbl_bukti 
                where id_bukti = (select max(id_bukti) from tbl_bukti);");
            $kodebukti = $generate->row();
        }
        return $kodebukti->kbs;
    }

    //======================================================================================================================    
    /* Simpan Bukti Service */
    function simpan_bukti_service(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id');				    /* Deklarasi variable */
        $id_per = $this->input->post('id_per');		    /* Deklarasi variable */
        $teknisi = $this->input->post('id_teknisi');	/* Deklarasi variable */
        $ket = $this->input->post('txt_ket');           /* Deklarasi variable */
        $id_bukti = $this->kode_id_bukti();
        $ip = $this->input->ip_address();
        
        $query1 = "
            insert into tbl_bukti
            (id, id_bukti, id_teknisi, keterangan, oleh, pada) 
            values 
            (concat(uuid_short()), ?, ?, ?, ?, now());
        ";          
       
        $query2 = "update tbl_permintaan as a set a.id_bukti = ? where a.id = ?";    

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($id_bukti, $teknisi, $ket, $iduser));
            $this->db->query($query2, array($id_bukti, $id)); 
            
            $this->db->trans_commit();               
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;  
    }

    //======================================================================================================================        
    /* mengambil data bukti service */
    function ambil_data_bukti_service($id){
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, h.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, 
            e.id_bukti, e.id_teknisi, e.keterangan, e.oleh, e.pada, f.nama as 'nama_teknisi', g.nama as 'dibuat_oleh'
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_bukti as e on e.id_bukti = a.id_bukti 
            left join tbl_user as f on f.id = e.id_teknisi
            left join tbl_user as g on g.id = e.oleh

            left join tbl_user as h on a.iduser = h.id

            where a.hapus is null and e.id_bukti = '$id';
        ");       
        return $query1;
    }

    //======================================================================================================================    
    /* Simpan Bukti Service */
    function simpan_bukti_penyerahan(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id');				    /* Deklarasi variable */
        $id_per = $this->input->post('id_per');		    /* Deklarasi variable */
        $teknisi = $this->input->post('id_teknisi');	/* Deklarasi variable */
        $ket = $this->input->post('txt_ket');           /* Deklarasi variable */
        $id_bukti = $this->kode_id_bukti();
        $ip = $this->input->ip_address();
        
        $query1 = "
            insert into tbl_bukti
            (id, id_bukti, id_teknisi, keterangan, oleh, pada) 
            values 
            (concat(uuid_short()), ?, ?, ?, ?, now());
        ";          
       
        $query2 = "update tbl_permintaan as a set a.id_bukti = ? where a.id = ?";    

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($id_bukti, $teknisi, $ket, $iduser));
            $this->db->query($query2, array($id_bukti, $id)); 
            
            $this->db->trans_commit();               
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;  
    }

    //======================================================================================================================        
    /* mengambil data bukti penyerahan */
    function ambil_data_bukti_penyerahan($id){
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, 
            e.id_bukti, e.id_teknisi, e.keterangan, e.oleh, e.pada, f.nama as 'nama_teknisi', g.nama as 'dibuat_oleh'
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_bukti as e on e.id_bukti = a.id_bukti 
            left join tbl_user as f on f.id = e.id_teknisi
            left join tbl_user as g on g.id = e.oleh
            where a.hapus is null and e.id_bukti = '$id';
        ");       
        return $query1;
    }

    //======================================================================================================================    
    /* Simpan Bukti Service */
    function simpan_bukti_updateaplikasi(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id');				    /* Deklarasi variable */
        $id_per = $this->input->post('id_per');		    /* Deklarasi variable */
        $teknisi = $this->input->post('id_teknisi');	/* Deklarasi variable */
        $ket = $this->input->post('txt_ket');           /* Deklarasi variable */
        $id_bukti = $this->kode_id_bukti();
        $ip = $this->input->ip_address();
        
        $query1 = "
            insert into tbl_bukti
            (id, id_bukti, id_teknisi, keterangan, oleh, pada) 
            values 
            (concat(uuid_short()), ?, ?, ?, ?, now());
        ";          
       
        $query2 = "update tbl_permintaan as a set a.id_bukti = ? where a.id = ?";    

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($id_bukti, $teknisi, $ket, $iduser));
            $this->db->query($query2, array($id_bukti, $id)); 
            
            $this->db->trans_commit();               
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;  
    }

    //======================================================================================================================        
    /* mengambil data bukti penyerahan */
    function ambil_data_bukti_updateaplikasi($id){
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, 
            e.id_bukti, e.id_teknisi, e.keterangan, e.oleh, e.pada, f.nama as 'nama_teknisi', g.nama as 'dibuat_oleh'
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_bukti as e on e.id_bukti = a.id_bukti 
            left join tbl_user as f on f.id = e.id_teknisi
            left join tbl_user as g on g.id = e.oleh
            where a.hapus is null and e.id_bukti = '$id';
        ");       
        return $query1;
    }

    //======================================================================================================================
    //======================================================================================================================    
    /* Simpan Bukti Service Hasil Edit */
    function simpan_bukti_service_edited(){
        $iduser =  $this->session->userdata("id");
        $idbukti = $this->input->post('idbukti');       /* Deklarasi variable */
        $teknisi = $this->input->post('id_teknisi');	/* Deklarasi variable */
        $ket = $this->input->post('txt_ket');           /* Deklarasi variable */
        
        $query1 = "update tbl_bukti as a set a.id_teknisi=?, a.keterangan=?, a.oleh=?, a.pada=now() 
            where a.id_bukti=?;";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($teknisi, $ket, $iduser, $idbukti));
            
            $this->db->trans_commit();               
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;  
    }

    //======================================================================================================================
    //======================================================================================================================    
    /* Simpan Bukti Penyerahan Hasil Edit */
    function simpan_bukti_penyerahan_edited(){
        $iduser =  $this->session->userdata("id");
        $idbukti = $this->input->post('idbukti');       /* Deklarasi variable */
        $teknisi = $this->input->post('id_teknisi');	/* Deklarasi variable */
        $ket = $this->input->post('txt_ket');           /* Deklarasi variable */
        
        $query1 = "update tbl_bukti as a set a.id_teknisi=?, a.keterangan=?, a.oleh=?, a.pada=now() 
            where a.id_bukti=?;";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($teknisi, $ket, $iduser, $idbukti));

            $this->db->trans_commit();               
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;  
    }

    //======================================================================================================================
    //======================================================================================================================    
    /* Simpan Bukti Penyerahan Aplikasi Hasil Edit */
    function simpan_bukti_updateaplikasi_edited(){
        $iduser =  $this->session->userdata("id");
        $idbukti = $this->input->post('idbukti');       /* Deklarasi variable */
        $teknisi = $this->input->post('id_teknisi');	/* Deklarasi variable */
        $ket = $this->input->post('txt_ket');           /* Deklarasi variable */
        
        $query1 = "update tbl_bukti as a set a.id_teknisi=?, a.keterangan=?, a.oleh=?, a.pada=now() 
            where a.id_bukti=?;";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($teknisi, $ket, $iduser, $idbukti));

            $this->db->trans_commit();               
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;  
    }






























}
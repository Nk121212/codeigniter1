<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model{
    
    //======================================================================================================================
    /* Ambil data permintaan service */
    function view_data_permintaan_service($dari, $sampai){
		/*$query1 = $this->db->query("
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
            where a.hapus is null and d.statuz = 'Baru Dibuat' and a.jenis_permintaan = '1' and 
            d.pada between '$dari' and '$sampai';
        ");        
        */
        $query1 = $this->db->query("select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
        b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
        case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
        case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
        when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
        case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
        a.kondisi, case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
        a.id_bukti, 
        e.dibuat1, e.diterima, e.respon_time, a.job_desc as keterangan,
        d.dibuat, d.ditutup, d.proses_time 

        from tbl_permintaan as a
        left join tbl_department as b on a.dept = b.kd
        left join tbl_bagian as c on a.bagian = c.kd
        LEFT JOIN tbl_permintaan_log AS f ON a.id_permintaan = f.id_permintaan
        left join 
        
        (SELECT a.id_permintaan, a.pada as dibuat, b.pada as ditutup,
        timediff(b.pada, a.pada) as proses_time 
        FROM tbl_permintaan_log AS a 
        LEFT JOIN tbl_permintaan_log AS b ON b.id_permintaan = a.id_permintaan  
        WHERE a.statuz = 'Baru Dibuat' AND b.statuz = 'Permintaan Ditutup') AS d ON d.id_permintaan = a.id_permintaan 
        
        left join 
        (SELECT a.id_permintaan, a.pada as dibuat1, b.pada as diterima,
        timediff(b.pada, a.pada) as respon_time 
        FROM tbl_permintaan_log AS a 
        LEFT JOIN tbl_permintaan_log AS b ON b.id_permintaan = a.id_permintaan  

        WHERE a.statuz = 'Baru Dibuat' AND b.statuz = 'Permintaan Diterima') AS e ON e.id_permintaan = a.id_permintaan
        
        where a.hapus is null and a.jenis_permintaan = '1' and
        d.dibuat between '$dari' and '$sampai';");

        return $query1;                 
    }


    function view_data_permintaan_service2($dari, $sampai, $lok){
        
        if($lok == ""){
            $z = "";
        }else{
            $z = "and d.lokasi = $lok";
        }

        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi, case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            case when a.id_bukti IS NULL then '-' ELSE a.id_bukti end as id_bukti,
            a.dibuat, a.diterima, a.respon_time, a.ditutup, a.proses_time, a.job_desc, d.lokasi
            
            from tbl_permintaan as a 
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_user as d on a.iduser = d.id
            
            where a.hapus is null and a.jenis_permintaan = '1' $z and 
            a.dibuat between '$dari' and '$sampai'
                    
            order by a.id_permintaan desc;
        ;");

        return $query1;                 
    }


    //======================================================================================================================
    /* Ambil data permintaan barang*/
    function view_data_permintaan_barang($dari, $sampai){
		/*$query1 = $this->db->query("
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
            where a.hapus is null and d.statuz = 'Baru Dibuat' and a.jenis_permintaan = '2' and 
            d.pada between '$dari' and '$sampai';
        ");  
        */
        $query1 = $this->db->query("select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
        b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
        case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
        case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
        when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
        case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
        a.kondisi, case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
        a.id_bukti, 
        e.dibuat1, e.diterima, e.respon_time, a.job_desc as keterangan,
        d.dibuat, d.ditutup, d.proses_time 

        from tbl_permintaan as a
        left join tbl_department as b on a.dept = b.kd
        left join tbl_bagian as c on a.bagian = c.kd
        LEFT JOIN tbl_permintaan_log AS f ON a.id_permintaan = f.id_permintaan
        left join 
        
        (SELECT a.id_permintaan, a.pada as dibuat, b.pada as ditutup,
        timediff(b.pada, a.pada) as proses_time 
        FROM tbl_permintaan_log AS a 
        LEFT JOIN tbl_permintaan_log AS b ON b.id_permintaan = a.id_permintaan  
        WHERE a.statuz = 'Baru Dibuat' AND b.statuz = 'Permintaan Ditutup') AS d ON d.id_permintaan = a.id_permintaan 
        
        left join 
        (SELECT a.id_permintaan, a.pada as dibuat1, b.pada as diterima,
        timediff(b.pada, a.pada) as respon_time 
        FROM tbl_permintaan_log AS a 
        LEFT JOIN tbl_permintaan_log AS b ON b.id_permintaan = a.id_permintaan  
        WHERE a.statuz = 'Baru Dibuat' AND b.statuz = 'Permintaan Diterima') AS e ON e.id_permintaan = a.id_permintaan
        
        where a.hapus is null and a.jenis_permintaan = '2' and
        d.dibuat between '$dari' and '$sampai';");       
        return $query1;                 
    }

    function view_data_permintaan_barang2($dari, $sampai, $lok){
        
        if($lok == ""){
            $z = "";
        }else{
            $z = "and d.lokasi = $lok";
        }

        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi, case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti,
            a.dibuat, a.diterima, a.respon_time, a.ditutup, a.proses_time, a.job_desc, d.lokasi
            
            from tbl_permintaan as a 
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_user as d on a.iduser = d.id
            
            where a.hapus is null and a.jenis_permintaan = '2' and
            a.dibuat between '$dari' and '$sampai' $z
                    
            order by a.id_permintaan desc
        ;");     
        return $query1;                 
    }

    //======================================================================================================================
    /* Ambil data permintaan aplikasi */
    function view_data_permintaan_aplikasi($dari, $sampai){
		/*$query1 = $this->db->query("
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
            where a.hapus is null and d.statuz = 'Baru Dibuat' and a.jenis_permintaan = '3' and 
            d.pada between '$dari' and '$sampai';
        "); 
        */
        $query1 = $this->db->query("select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
        b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
        case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
        case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
        when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
        case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
        a.kondisi, case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
        a.id_bukti, 
        e.dibuat1, e.diterima, e.respon_time, a.job_desc as keterangan,
        d.dibuat, d.ditutup, d.proses_time 

        from tbl_permintaan as a
        left join tbl_department as b on a.dept = b.kd
        left join tbl_bagian as c on a.bagian = c.kd
        LEFT JOIN tbl_permintaan_log AS f ON a.id_permintaan = f.id_permintaan
        left join 
        
        (SELECT a.id_permintaan, a.pada as dibuat, b.pada as ditutup,
        timediff(b.pada, a.pada) as proses_time 
        FROM tbl_permintaan_log AS a 
        LEFT JOIN tbl_permintaan_log AS b ON b.id_permintaan = a.id_permintaan  
        WHERE a.statuz = 'Baru Dibuat' AND b.statuz = 'Permintaan Ditutup') AS d ON d.id_permintaan = a.id_permintaan 
        
        left join 
        (SELECT a.id_permintaan, a.pada as dibuat1, b.pada as diterima,
        timediff(b.pada, a.pada) as respon_time 
        FROM tbl_permintaan_log AS a 
        LEFT JOIN tbl_permintaan_log AS b ON b.id_permintaan = a.id_permintaan  
        WHERE a.statuz = 'Baru Dibuat' AND b.statuz = 'Permintaan Diterima') AS e ON e.id_permintaan = a.id_permintaan
        
        where a.hapus is null and a.jenis_permintaan = '3' and
        d.dibuat between '$dari' and '$sampai';");       
        return $query1;                 
    }

    function view_data_permintaan_aplikasi2($dari, $sampai, $lok){

        if($lok == ""){
            $z = "";
        }else{
            $z = "and d.lokasi = $lok";
        }

        $query1 = $this->db->query("
        select 
        a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
        b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
        case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
        case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
        when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
        case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
        a.kondisi, case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
        a.id_bukti,
        a.dibuat, a.diterima, a.respon_time, a.ditutup, a.proses_time, a.job_desc, d.lokasi
        
        from tbl_permintaan as a 
        left join tbl_department as b on a.dept = b.kd
        left join tbl_bagian as c on a.bagian = c.kd
        left join tbl_user as d on a.iduser = d.id
        
        where a.hapus is null and a.jenis_permintaan = '3' and
        a.dibuat between '$dari' and '$sampai' $z
                
        order by a.id_permintaan desc
        ;");       
        return $query1;                 
    }
}
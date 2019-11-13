<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

class M_permintaan extends CI_Model{
    
    //======================================================================================================================
    /* untuk men-generate kode permintaan baru */
    function qty_permintaan(){
        $query1 = $this->db->query("
            select k.newrequest, l.service, m.barang, n.aplikasi, o.close from
            
            (select count(a.id_permintaan) as 'newrequest'
            from tbl_permintaan as a 
            where a.respon = 0) as k,
            
            (select count(b.id_permintaan) as 'service' 
            from tbl_permintaan as b
            where b.respon = 1 and b.jenis_permintaan = 1) as l,
            
            (select count(c.id_permintaan) as 'barang' 
            from tbl_permintaan as c
            where c.respon = 1 and c.jenis_permintaan = 2) as m,
            
            (select count(d.id_permintaan) as 'aplikasi' 
            from tbl_permintaan as d
            where d.respon = 1 and d.jenis_permintaan = 3) as n,
            
            (select count(e.id_permintaan) as 'close' 
            from tbl_permintaan as e) as o;
        ");        
        
        return $query1; 
    }

    //======================================================================================================================
    /* untuk men-generate kode permintaan baru */
    function kode_permintaan_baru(){
        $cek = $this->db->query("select count(id) as jumlah from tbl_permintaan where hapus is null");
        $hasilcek = $cek->row();

        if ($hasilcek->jumlah == 0) {
            $generate = $this->db->query("select concat_ws('','MOR', DATE_FORMAT((NOW()) ,'%Y%m%d'), '001') as kpb;");  /* kpb = kode permintaan baru, MOR = Memo Of Request*/
            $kodememo = $generate->row();
        }
        else {
            $generate = $this->db->query("
                select if((substr(id_permintaan, 4, 8) = DATE_FORMAT((NOW()) ,'%Y%m%d')), 
                concat_ws('','MOR', DATE_FORMAT((NOW()) ,'%Y%m%d'), lpad((substr(id_permintaan,12,3)+1),3,'0')), 
                concat_ws('','MOR', DATE_FORMAT((NOW()) ,'%Y%m%d'), '001')) as kpb 
                from tbl_permintaan 
                where id_permintaan = (select max(id_permintaan) from tbl_permintaan);");
            $kodememo = $generate->row();
        }
        return $kodememo->kpb;
    }

    //======================================================================================================================
    /* mengambil kode departemen */ /* GA DI PAKE */
    function ambil_kode_dept($nama_dept){
        $query1 = $this->db->query("select kd from tbl_department where nama_dept = '$nama_dept';");
        
        if (isset($query1)) {
            $this->db->query('insert into tbl_department (kd, nama_dept, tgl_buat) values (concat(uuid_short()), ?, now());', array($nama_dept));
            $query1 = $this->db->query("select kd from tbl_department where history is null and nama_dept = '$nama_dept';");
        }
        $hasil = $query1->row();
        
        return $hasil->kd;
    }

    //======================================================================================================================
    /* mengambil kode bagian */ /* GA DI PAKE */
    function ambil_kode_bagian($nama_bagian){
        $query1 = $this->db->query("select kd from tbl_bagian where nama_bagian = '$nama_bagian';");

        if (isset($query1)) {
            $this->db->query('insert into tbl_bagian (kd, nama_bagian, tgl_buat) values (concat(uuid_short()), ?, now())', array($nama_bagian));
            $query1 = $this->db->query("select kd from tbl_bagian where history is null and nama_bagian = '$nama_bagian'");
        }
        $hasil = $query1->row();

        return $hasil->kd;
    }

    //======================================================================================================================
    /* Simpan data permintaan baru */
    function simpan_permintaan(){
        $idpermintaan = $this->kode_permintaan_baru();
        $id = $this->input->post('iduser');

        $query1 = $this->db->query("
            select a.id, a.nama, a.username, a.email, a.level, a.departemen, a.bagian, a.telp, b.nama_dept, c.nama_bagian 
            from tbl_user as a 
            left join tbl_department as b on b.kd = a.departemen 
            left join tbl_bagian as c on c.kd = a.bagian 
            where id = '$id';
        ");
        $hasil = $query1->row();

        $nama = $hasil->nama;
        $email = $hasil->email;
        $dept = $hasil->departemen;
        $bagian = $hasil->bagian;
        $telp = $hasil->telp;
        $perihal = $this->input->post('txt_perihal'); 
        $detail = $this->input->post('txt_detail');        
        $ip = $this->input->ip_address();

        $config['upload_path']="./img/upload/";
		$lokasi = "img/upload";
        //$config['allowed_types']='gif|jpg|png|docx|doc|pptx|xlsx|js|pdf|mp4|mkv|wmv|zip|rar|sql|xls';
		$config['allowed_types'] = '*';
		$config['detect_mime'] = false;
        $config['max_size'] = '0';
		$config['file_name'] = $idpermintaan;
		$config['overwrite'] = TRUE;
        $this->load->library('upload',$config);
        
        if($this->upload->do_upload("file")){ //file = attribut name dari inputan file type
	    	//batasan max size post upload php.ini upload_max_size : 500M;
	        $data = array('upload_data' => $this->upload->data());
	        $image = $data['upload_data']['file_name'];
            $attach = $lokasi."/".$image;

            $config['image_library'] = 'gd2';
            $config['source_image'] = $attach;
            $config['new_image'] = $attach;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;
            $config['height'] = 500;

            // Load the Library
            $this->load->library('image_lib', $config);
            // resize image
            $this->image_lib->resize();
            // handle if there is any problem
            if (!$this->image_lib->resize()){ 
                echo $this->image_lib->display_errors();
            }
            
            $query1 = "insert into tbl_permintaan 
                (id, id_permintaan, iduser, nama, emailaddress, dept, bagian, telp, perihal, detail, 
                respon, jenis_permintaan, approve, kondisi, statuz, dibuat, upload) 
                values 
                (concat(uuid_short()), ?, ?, ?, ?, ?, ?, ?, ?, ?,  
                0, 0, 0, 'Baru Dibuat', 0, now(), ? );";

            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Baru Dibuat', now(), ?, ?);";

            $this->db->trans_begin(); 
            
                    try {
                        $this->db->query($query1, array($idpermintaan, $id, $nama, $email, $dept, $bagian, $telp, $perihal, $detail, $attach));
                        $this->db->query($query2, array($idpermintaan, $id, $ip)); 
                        
                        if($this->db->trans_commit()){
                            $this->kirim_permintaan_by_email($idpermintaan); 				// kirim email default dan admin
                            //$this->kirim_permintaan_ke_atasan($idpermintaan); 
                            $this->kirim_email_ke_pembuat($idpermintaan); 					//kirim email ke user
                        };	
                        
                    } catch (exception $e) {
                        $this->db->trans_rollback();
                    }       
            
                    return Null;

        }else{

            $query1 = "insert into tbl_permintaan 
                (id, id_permintaan, iduser, nama, emailaddress, dept, bagian, telp, perihal, detail, 
                respon, jenis_permintaan, approve, kondisi, statuz, dibuat) 
                values 
                (concat(uuid_short()), ?, ?, ?, ?, ?, ?, ?, ?, ?,  
                0, 0, 0, 'Baru Dibuat', 0, now());";

            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Baru Dibuat', now(), ?, ?);";

            $this->db->trans_begin(); 
            
                    try {
                        $this->db->query($query1, array($idpermintaan, $id, $nama, $email, $dept, $bagian, $telp, $perihal, $detail));
                        $this->db->query($query2, array($idpermintaan, $id, $ip)); 
                        
                        if($this->db->trans_commit()){
                            $this->kirim_permintaan_by_email($idpermintaan); 				// kirim email default dan admin
                            //$this->kirim_permintaan_ke_atasan($idpermintaan); 
                            $this->kirim_email_ke_pembuat($idpermintaan); 					//kirim email ke user
                        };	
                        
                    } catch (exception $e) {
                        $this->db->trans_rollback();
                    }       
            
                    return Null;
			
			//$error = array('error' => $this->upload->display_errors());
		}
        
    }

    //======================================================================================================================
    /* Simpan data permintaan admin baru */
    function simpan_permintaan_admin(){
        $idpermintaan = $this->kode_permintaan_baru();
        $id = $this->input->post('id_user');
        $id2 = $this->input->post('iduser');
        
        $query1 = $this->db->query("
            select a.id, a.nama, a.username, a.email, a.level, a.departemen, a.bagian, a.telp, b.nama_dept, c.nama_bagian 
            from tbl_user as a 
            left join tbl_department as b on b.kd = a.departemen 
            left join tbl_bagian as c on c.kd = a.bagian 
            where id = '$id';
        ");
        $hasil = $query1->row();
    
		$nama = $hasil->nama;
		$email = $hasil->email;
        $dept = $hasil->departemen;
		$bagian = $hasil->bagian;
		$telp = $hasil->telp;
		$perihal = $this->input->post('txt_perihal'); 
        $detail = $this->input->post('txt_detail');        
        $ip = $this->input->ip_address();

        $query1 = "insert into tbl_permintaan 
            (id, id_permintaan, iduser, nama, emailaddress, dept, bagian, telp, perihal, detail, 
            respon, jenis_permintaan, approve, kondisi, statuz, dibuat) 
            values 
            (concat(uuid_short()), ?, ?, ?, ?, ?, ?, ?, ?, ?,  
            0, 0, 0, 'Baru Dibuat', 0, now());";

        $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Baru Dibuat', now(), ?, ?);";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($idpermintaan, $id, $nama, $email, $dept, $bagian, $telp, $perihal, $detail));
            $this->db->query($query2, array($idpermintaan, $id2, $ip)); 
            
            if($this->db->trans_commit()){
                $this->kirim_permintaan_by_email($idpermintaan);
            };
            
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return Null;        
    }

    //======================================================================================================================
    /* Simpan data permintaan keluar baru */
    function simpan_permintaan_keluar(){
        $idpermintaan = $this->kode_permintaan_baru();  
        $id2 = $this->session->userdata('id');          
        $nama = $this->input->post('txt_kepada');
        $email = $this->input->post('txt_email');
        $dept = $this->input->post('txt_dept');
        $bagian = $this->input->post('txt_bagian');
        $telp = $this->input->post('txt_telp');
		$perihal = $this->input->post('txt_perihal'); 
        $detail = $this->input->post('txt_detail');      
        $menyetujui = $this->input->post('txt_setuju'); 
        $mengetahui = $this->input->post('txt_tahu');     
        $ip = $this->input->ip_address();

        $query1 = "insert into tbl_permintaan 
            (id, id_permintaan, iduser, nama, emailaddress, dept, bagian, telp, perihal, detail, menyetujui, mengetahui,
            respon, jenis_permintaan, approve, kondisi, statuz, dibuat) 
            values 
            (concat(uuid_short()), ?, '-', ?, ?, ?, ?, ?, ?, ?, ?, ?,
            0, 4, 0, 'Baru Dibuat', 0, now());";

        $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Baru Dibuat', now(), ?, ?);";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($idpermintaan, $nama, $email, $dept, $bagian, $telp, $perihal, $detail, $menyetujui, $mengetahui));
            $this->db->query($query2, array($idpermintaan, $id2, $ip));             
            $this->db->trans_commit();      
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return Null;        
    }

    //======================================================================================================================    
    /* Ambil data permintaan baru */
    function data_lihat_permintaan(){
        $iduser = $this->session->userdata("id");
	     $query1 = $this->db->query("
	     select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
			left join tbl_department as b on a.dept = b.kd
			left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.statuz = 0 and a.iduser= '$iduser'
            order by a.id desc;
        ");        
        return $query1;        
    }

    //======================================================================================================================    
    /* Ambil data permintaan baru */
    function data_lihat_permintaan_close(){
        $iduser = $this->session->userdata("id");
		$query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti
            from tbl_permintaan as a
			left join tbl_department as b on a.dept = b.kd
			left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.statuz = 1 and a.iduser= '$iduser'
            order by a.id desc limit 100;
        ");        
        return $query1;        
    }

    //======================================================================================================================    
    /* Ambil data permintaan baru */
    function data_daftar_permintaan($lok){
        if($lok == 'master'){
            $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, d.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
                case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.upload,
            a.id_bukti, b.nama_dept, c.nama_bagian, d.lokasi
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_user as d on a.iduser = d.id
            where a.hapus is null and a.statuz = 0 and a.jenis_permintaan != '4'
            order by a.id_permintaan desc;
            ");    
        }else{
            $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, d.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
                case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.upload,
            a.id_bukti, b.nama_dept, c.nama_bagian, d.lokasi
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_user as d on a.iduser = d.id
            where a.hapus is null and a.statuz = 0 and a.jenis_permintaan != '4' and d.lokasi = '$lok'
            order by a.id_permintaan desc;
            ");    
        }
		    
    return $query1;    
        
    }

	//======================================================================================================================    
    	/* Ambil data permintaan baru */
    	function total_permintaan(){
		$query1 = $this->db->query("
		select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            	case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            	case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, b.nama_dept, c.nama_bagian
            from tbl_permintaan as a
			left join tbl_department as b on a.dept = b.kd
			left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.statuz = 0 and a.jenis_permintaan != '4' 
            order by a.id_permintaan;
        ");   

        $total = $query1->num_rows();
        
        return $total;   
            
    	}

    //======================================================================================================================    
    /* Ambil data permintaan baru */
    function data_daftar_permintaan_close($lok){

        if($lok == 'master'){
            $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, d.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti,c.nama_bagian as nm_bag, b.nama_dept as nm_dept, d.lokasi
            from tbl_permintaan as a
                left join tbl_department as b on a.dept = b.kd
                left join tbl_bagian as c on a.bagian = c.kd
                left join tbl_user as d on a.iduser = d.id
            where a.hapus is null and a.statuz = 1 and a.jenis_permintaan != '4'
            order by a.id_permintaan desc;
        ");  
        }else{
            $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, d.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti,c.nama_bagian as nm_bag, b.nama_dept as nm_dept, d.lokasi
            from tbl_permintaan as a
                left join tbl_department as b on a.dept = b.kd
                left join tbl_bagian as c on a.bagian = c.kd
                left join tbl_user as d on a.iduser = d.id
            where a.hapus is null and a.statuz = 1 and a.jenis_permintaan != '4' and d.lokasi = '$lok'
            order by a.id_permintaan desc;
        ");  
        }
		      
        return $query1;        
    }

    //======================================================================================================================    
    /* Ambil data permintaan baru */
    function total_permintaan_close(){
		$query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti,c.nama_bagian as nm_bag, b.nama_dept as nm_dept 
            from tbl_permintaan as a
			left join tbl_department as b on a.dept = b.kd
			left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.statuz = 1 and a.jenis_permintaan != '4'
            order by a.id_permintaan;
        ");        
        $total = $query1->num_rows();
	return $total;      
    }

    //======================================================================================================================    
    /* Ambil data daftar permintaan keluar */
    function data_daftar_permintaan_keluar(){
		$query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,           
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, b.nama_dept, c.nama_bagian
            from tbl_permintaan as a
			left join tbl_department as b on a.dept = b.kd
			left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.statuz = 0 and a.jenis_permintaan = '4' 
            order by a.id_permintaan desc;
        ");     
           
        return $query1;        
    }

    //======================================================================================================================    
    /* Ambil data daftar permintaan keluar close */
    function data_daftar_permintaan_keluar_close(){
		$query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis,
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,          
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, b.nama_dept, c.nama_bagian
            from tbl_permintaan as a
			left join tbl_department as b on a.dept = b.kd
			left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.statuz = 1 and a.jenis_permintaan = '4' 
            order by a.id_permintaan desc;
        ");        
        return $query1;        
    }

    //======================================================================================================================    
    /* mengambil data permintaan */
    function ambil_data_permintaan($id){
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, e.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, a.menyetujui, a.mengetahui,
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',        
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Permintaan Keluar' when 5 then 'Lain - Lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti, d.pada
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            left join tbl_permintaan_log as d on d.id_permintaan = a.id_permintaan
            left join tbl_user e on a.iduser = e.id
            where a.hapus is null and d.statuz = 'Baru Dibuat' and a.id = '$id';
        ");       
        return $query1;
    }

    //======================================================================================================================    
    /* mengambil data log permintaan */
    function ambil_log_permintaan($id_per){
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$id_per' order by a.pada;
        ");       
        return $query1;
    }

    //======================================================================================================================    
    /* mengambil data daftar user */
    function ambil_daftar_user(){
        $query1 = $this->db->query("
            select a.id, a.nama, a.username, a.email, a.departemen, a.bagian, a.telp, b.nama_dept, c.nama_bagian
            from tbl_user as a
            left join tbl_department as b on b.kd = a.departemen 
            left join tbl_bagian as c on c.kd = a.bagian 
            where a.hapus is null and level = 'USER' order by a.nama;
        ");       
        return $query1;
    }

    //======================================================================================================================    
    /* mengambil data daftar departemen */
    function ambil_daftar_departemen(){
        $query1 = $this->db->query("
            select a.kd, a.nama_dept, if(a.hapus is null, 'Aktif', 'Tidak Aktif') as 'statuz' 
            from tbl_department as a
            order by a.nama_dept;
        ");           
        return $query1;
    }

    //======================================================================================================================
    /* Ambil data daftar bagian */
    function ambil_daftar_bagian(){
		$query1 = $this->db->query("
            select a.kd, a.nama_bagian, if(a.hapus is null, 'Aktif', 'Tidak Aktif') as 'statuz' 
			from tbl_bagian as a
            order by a.nama_bagian;
        ");        
        return $query1;                 
    }

    //======================================================================================================================
    /* Ambil data daftar kondisi */
    function ambil_daftar_kondisi(){
		$query1 = $this->db->query("
            select a.id, a.kondisi
			from tbl_kondisi as a
            order by a.kondisi;
        ");        
        return $query1;                 
    }

    //======================================================================================================================
    /* Update respon terima */
    function respon_terima(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ket = $this->input->post('txt_ketditerima');		/* Deklarasi variable */
        $ip = $this->input->ip_address();
        $jam = $this->input->post('jam');
        $menit = $this->input->post('menit');
        $detik = $this->input->post('detik');
        $acc = $this->input->post('acc');

        if($acc == '1'){

            $query1 = "update tbl_permintaan set respon = '1', acc = 1, kondisi = 'Menunggu Approval Atasan', est_time = '$jam:$menit:$detik', diterima = now() where id = ?;";  
            
            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Diterima', 'Permintaan Diterima', now(), ?, ?);";

            $query3 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Menunggu Approval Atasan', ?, now(), ?, ?);";
            
            $this->db->trans_begin();  
            try {
                $this->db->query($query1, array($id));
                $this->db->query($query2, array($id_per, $iduser, $ip)); 
                $this->db->query($query3, array($id_per, $ket, $iduser, $ip)); 
                
                if($this->db->trans_commit()){
                    $this->kirim_respon_permintaan_by_email($id_per, 'Diterima');
                };            
            } catch (exception $e) {
                $this->db->trans_rollback();
            }     
            
            $this->kirim_permintaan_ke_atasan2($id_per);

        }else{

            $query1 = "update tbl_permintaan set respon = '1', kondisi = 'Diterima', est_time = '$jam:$menit:$detik', diterima = now() where id = ?;";  
            
            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Permintaan Diterima', ?, now(), ?, ?);";
            
            $this->db->trans_begin();  
            try {
                $this->db->query($query1, array($id));
                $this->db->query($query2, array($id_per, $ket, $iduser, $ip)); 
                
                if($this->db->trans_commit()){
                    $this->kirim_respon_permintaan_by_email($id_per, 'Diterima');
                };            
            } catch (exception $e) {
                $this->db->trans_rollback();
            }   

        }

        return True; 
    }

    function update_resp_time(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ket = $this->input->post('txt_ketditerima');		/* Deklarasi variable */
        $ip = $this->input->ip_address();

        $a = $this->db->query("
            SELECT dibuat, diterima from tbl_permintaan where id = '$id'
        ");
        $dibuat = $a->row()->dibuat;
        $diterima = $a->row()->diterima;

        $b = $this->db->query("
            SELECT TIMEDIFF('$diterima','$dibuat') as response
        ");

        $resp_time = $b->row()->response;

        $str1 = $resp_time;
        $str2 = "15:00:00";
        $str3 = "63:00:00";

        $he = explode(':', $str1);
        $he2 = explode(':', $str2);
        $he3 = explode(':', $str3);

        if($str1 > $str3){

            $jam = $he[0]-$he3[0];
            $menit = $he[1]-$he3[1];
            $detik = $he[2]-$he3[2];
    
            $fixed = $jam.":".$menit.":".$detik;
            //echo 'lebih dari 63 jam';
            
        }elseif($str1 > $str2){

            $jam = $he[0]-$he2[0];
            $menit = $he[1]-$he2[1];
            $detik = $he[2]-$he2[2];
    
            $fixed = $jam.":".$menit.":".$detik;
            //echo 'lebih dari 15 jam';
        }else{
            $fixed = $resp_time;
        }

        $update = $this->db->query("
            UPDATE tbl_permintaan SET respon_time = '$fixed' WHERE id = '$id'
        ");
    }

    //======================================================================================================================
    /* Update respon tolak */
    function respon_tolak(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ket = $this->input->post('txt_ketditolak');		/* Deklarasi variable */
        $ip = $this->input->ip_address();
        
		$query1 = "update tbl_permintaan set respon = '2', statuz = '1', kondisi = 'Ditolak' where id = ?;";  
        
        $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Permintaan Ditolak', ?, now(), ?, ?);";

        $query3 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Permintaan Ditutup', ?, now(), ?, ?);";
        
        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($id));
            $this->db->query($query2, array($id_per, $ket, $iduser, $ip)); 
            $this->db->query($query3, array($id_per, $ket, $iduser, $ip));
            
            if($this->db->trans_commit()){
                $this->kirim_respon_permintaan_by_email($id_per, 'Ditolak');
            };            
        } catch (exception $e) {
            $this->db->trans_rollback();
        }       

        return True;                 
    }

    //======================================================================================================================
    /* Update jenis service */
    function jenis_service(){
        $acc = $this->input->post('acc');
        $comment = $this->input->post('ket_service');
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ip = $this->input->ip_address();
        $kelas = $this->input->post('kelas');
        $id_pc = $this->input->post("plh_cpu");

        $cek_data = $this->db->query("
            select acc, approve from tbl_permintaan where id = '$id'
        ");

        $row_acc = $cek_data->row()->acc;
        $row_approve = $cek_data->row()->approve;

         if($row_acc == 1 && $row_approve == 0){
            //tidak bisa update service harus di response dlu sama atasan
         }else{
             if($id_pc == ""){

                $query1 = "update tbl_permintaan set jenis_permintaan = '1', kelas = ?, job_desc = ?, acc = ?, kondisi = 'Permintaan Service' where id = ?;";

                $query2 = "insert into tbl_permintaan_log
                    (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                    values 
                    (concat(uuid_short()), ?, 'Permintaan Service', ?, now(), ?, ?);";
        
                $this->db->trans_begin();  
                try {
                    $this->db->query($query1, array($kelas, $comment, $acc, $id));
                    $this->db->query($query2, array($id_per, $comment, $iduser, $ip)); 
                    
                    $this->db->trans_commit();
                } catch (exception $e) {
                    $this->db->trans_rollback();
                }

             }else{

                $query1 = "update tbl_permintaan set jenis_permintaan = '1', kelas = ?, job_desc = ?, acc = ?, id_pc = ?, kondisi = 'Permintaan Service' where id = ?;";

                $query2 = "insert into tbl_permintaan_log
                    (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                    values 
                    (concat(uuid_short()), ?, 'Permintaan Service', ?, now(), ?, ?);";
        
                $this->db->trans_begin();  
                try {
                    $this->db->query($query1, array($kelas, $comment, $acc, $id_pc, $id));
                    $this->db->query($query2, array($id_per, $comment, $iduser, $ip)); 
                    
                    $this->db->trans_commit();
                } catch (exception $e) {
                    $this->db->trans_rollback();
                }

             }
            
            
         }       

        return True;
    }

    //======================================================================================================================
    /* Update jenis barang */
    function jenis_barang(){
        $acc = $this->input->post('acc');
        $comment = $this->input->post('ket_item');
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ip = $this->input->ip_address(); 

        $cek_data = $this->db->query("
            select acc, approve from tbl_permintaan where id = '$id'
        ");

        $row_acc = $cek_data->row()->acc;
        $row_approve = $cek_data->row()->approve;

        if($row_acc == 1 && $row_approve == 0){
            //tidak bisa update service harus di response dlu sama atasan
         }else{

            $query1 = "update tbl_permintaan set jenis_permintaan = '2', job_desc = ?, acc = ?, kondisi = 'Permintaan Barang' where id = ?;";
            
            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Permintaan Barang', ?, now(), ?, ?);";
    
            $this->db->trans_begin();  
            try {
                $this->db->query($query1, array($comment, $acc, $id));
                $this->db->query($query2, array($id_per, $comment, $iduser, $ip)); 
                
                $this->db->trans_commit();  
            } catch (exception $e) {
                $this->db->trans_rollback();
            }

            return True; 

         }
    }

    //======================================================================================================================
    /* Update jenis aplikasi */
    function jenis_aplikasi(){
        $acc = $this->input->post('acc');
        $comment = $this->input->post('ket_app');
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ip = $this->input->ip_address();
        $kelas = $this->input->post('kelas');

        $cek_data = $this->db->query("
            select acc, approve from tbl_permintaan where id = '$id'
        ");

        $row_acc = $cek_data->row()->acc;
        $row_approve = $cek_data->row()->approve;

        if($row_acc == 1 && $row_approve == 0){
            //tidak bisa update service harus di response dlu sama atasan
        }else{

            $query1 = "update tbl_permintaan set jenis_permintaan = '3', kelas = ?, job_desc = ?, acc = ?, kondisi = 'Permintaan Aplikasi/ Update Aplikasi' where id = ?;";
            
            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, 'Permintaan Aplikasi / Update Aplikasi', ?, now(), ?, ?);";
    
            $this->db->trans_begin();  
            try {
                $this->db->query($query1, array($kelas, $comment, $acc, $id));
                $this->db->query($query2, array($id_per, $comment, $iduser, $ip)); 
                
                $this->db->trans_commit();
            } catch (exception $e) {
                $this->db->trans_rollback();
            }

            return True;

        }
    }

    //======================================================================================================================
    /* Tutup Permintaan */
    function tutup_permintaan(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');				/* Deklarasi variable */
        $ket = $this->input->post('txt_kettutup');	    	/* Deklarasi variable */
        $ip = $this->input->ip_address();

        /*$pc = $this->input->post('pc'); //
        $elemen = $this->input->post('elemen'); //
        $merk = $this->input->post('merk'); //
        $type = $this->input->post('type'); //
        //cari id_cpu pada master_pc where id = $pc
        $c_id = $this->db->query("
            select * from master_pc where id = '$pc'
        ");

        $id_cpu = $c_id->row()->id_cpu; //id_cpu
        $id_key = $c_id->row()->id_keyboard;
        $id_mouse = $c_id->row()->id_mouse;
        $id_monitor = $c_id->row()->id_monitor;
        $id_printer = $c_id->row()->id_printer;

        if(!$pc){

        }else{
            $ins_serv = $this->db->query("
                INSERT INTO tbl_service(id_permintaan,id_pc,id_parts,id_merk,id_type,log)
                VALUES('$id_per','$pc','$elemen','$merk','$type',now())
            ");
            if($elemen == 1){
                $clock = $this->input->post("clk");
                $hertz = $this->input->post("hertz");
                $c_id2 = $this->db->query("
                    select id_processor from master_cpu where id = '$id_cpu'
                ");
                $id_proc2 = $c_id2->row()->id_processor; //id_processor
                //update tbl_processor where id = $id_proc2
                $update = $this->db->query("
                    UPDATE tbl_processor SET merk = '$merk', type='$type', clock = '$clock', hertz = '$hertz'
                    WHERE id = '$id_proc2'
                ");
            }elseif($elemen == 2){
                $kap = $this->input->post("kap");
                $byte = $this->db->query("byte");
                //cari id_memory pada master_cpu where id = $id_cpu
                $c_im = $this->db->query("
                    select id_memory from master_cpu where id = '$id_cpu'
                ");
                $id_mem = $c_im->row()->id_memory;
                //update tbl_memory
                $update = $this->db->query("
                    UPDATE tbl_memory SET merk = '$merk', type = '$type', kapasitas = '$kap', byte = '$byte'
                    WHERE id = '$id_mem'
                ");
            }elseif($elemen == 3){
                $kap = $this->input->post("kap");
                $byte = $this->db->query("byte");
                //cari id_hardisk pada master_cpu where id = $id_cpu
                $c_ih = $this->db->query("
                    SELECT id_hardisk FROM master_cpu WHERE id = '$id_cpu'
                ");
                $id_hd = $c_ih->row()->id_hardisk;
                $update = $this->db->query("
                    UPDATE tbl_hardisk SET merk = '$merk', type ='$type', kapasitas = '$kap', byte = '$byte'
                    WHERE id = '$id_hd'
                ");
                //update tbl_hardisk
            }elseif($elemen == 4){
                //update tbl_keyboard
                $update = $this->db->query("
                    UPDATE tbl_keyboard SET merk = '$merk', type = '$type'
                    WHERE id = '$id_key'
                ");
            }elseif($elemen == 5){
                //update tbl_mouse
                $update = $this->db->query("
                    UPDATE tbl_mouse SET merk = '$merk', type = '$type'
                    WHERE id = '$id_mouse'
                ");
            }elseif($elemen == 6){
                $inches = $this->input->post("inches");
                //update tbl_monitor
                $update = $this->db->query("
                    UPDATE tbl_mouse SET merk = '$merk', type = '$type', inches = '$inches'
                    WHERE id = '$id_monitor'
                ");
            }elseif($elemen == 7){
                //update tbl_printer
                $update = $this->db->query("
                    UPDATE tbl_printer SET merk = '$merk', type = '$type'
                    WHERE id = '$id_printer'
                ");
            }else{

            }

        }
        */

        $query1 = "update tbl_permintaan set statuz = 1, kondisi = 'Permintaan Ditutup', ditutup = now() where id = ?;";
        
        $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Permintaan Ditutup', ?, now(), ?, ?);";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($id));
            $this->db->query($query2, array($id_per, $ket, $iduser, $ip)); 
            
            if($this->db->trans_commit()){
                $this->kirim_updatetutuphapus_permintaan_by_email($id_per, 'TUTUP');
                $this->kirim_tutuphapus_permintaan_by_email_to_admin($id_per, 'TUTUP');
            };            
        } catch (exception $e) {
            $this->db->trans_rollback();
        }  
    
        return True;
    }

    function ganti_komponen(){
        $iduser =  $this->session->userdata("id");
        $id_pc = $this->input->post("pc"); //id pc yg diganti komponennya
        $id_permintaan = $this->input->post('id_per_modal');
        $idproc_awal = $this->input->post("val_awal");
        $idmem_awal = $this->input->post("val_awal2");
        $idhdd_awal = $this->input->post("val_awal3");
        $idkey_awal = $this->input->post("val_awal4");
        $idmouse_awal = $this->input->post("val_awal5");
        $idmon_awal = $this->input->post("val_awal6");
        $idprint_awal = $this->input->post("val_awal7");

        $qgc = $this->db->query("
            select * from master_pc where id = '$id_pc'
        ");

        $this->db->query("UPDATE tbl_permintaan SET id_pc = '$id_pc' WHERE id_permintaan = '$id_permintaan'");

        $id_cpu = $qgc->row()->id_cpu;

        //value pembeda apakah di cek/tidak pada checkbox ========>
        $vc_proc = $this->input->post("vc_proc");

        if($vc_proc == 1){

            $vgat = implode(",", $this->input->post("gat")); // value penentu ganti atau tidak 0/1
            $vsproc = implode(",", $this->input->post("panel_proc")); //value select processor ->id processor

            $p1 = substr_count($vsproc, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vsproc);
            $p5 = explode(",",$idproc_awal);

            for($pa = 0;$pa < $p2; $pa++){

                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){
                    
                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','1','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_processor WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_procx = $q2->row()->stok;
                        $stok_now = ($id_procx) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_processor SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }

                }else{
                    //echo $arr_p5." henteu diganti";
                    //echo 'jangan update -> </br>';
                }
            }

            $this->db->query("
                UPDATE master_cpu SET id_processor = '$vsproc' WHERE id = '$id_cpu'
            ");
            
        }else{
            //echo 'tidak di ceklis';
        }

        $vc_mem = $this->input->post("vc_mem");
        if($vc_mem == 1){
            $vgat = implode(",", $this->input->post("gat2")); // value penentu ganti atau tidak 0/1
            $vsmem = implode(",", $this->input->post("panel_mem")); //value select processor ->id processor

            $p1 = substr_count($vsmem, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vsmem);
            $p5 = explode(",",$idmem_awal);

            for($pa = 0;$pa < $p2; $pa++){  
                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){
                    
                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','2','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_memory WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_memx = $q2->row()->stok;
                        $stok_now = ($id_memx) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_memory SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }

                }else{
                    
                }
            }

            $this->db->query("
                UPDATE master_cpu SET id_memory = '$vsmem' WHERE id = '$id_cpu'
            ");

        }else{

        }

        $vc_hdd = $this->input->post("vc_hdd"); 
        if($vc_hdd == 1){
            $vgat = implode(",", $this->input->post("gat3")); // value penentu ganti atau tidak 0/1
            $vshdd = implode(",", $this->input->post("panel_hdd")); //value select processor ->id processor

            $p1 = substr_count($vshdd, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vshdd);
            $p5 = explode(",",$idhdd_awal);

            for($pa = 0;$pa < $p2; $pa++){
                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){
                    
                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','3','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_hardisk WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_hddx = $q2->row()->stok;
                        $stok_now = ($id_hddx) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_hardisk SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }

                }else{

                }
            }

            $this->db->query("
                UPDATE master_cpu SET id_hardisk = '$vshdd' WHERE id = '$id_cpu'
            ");

        }else{

        }

        $vc_key = $this->input->post("vc_key");
        if($vc_key == 1){
            $vgat = implode(",", $this->input->post("gat4")); // value penentu ganti atau tidak 0/1
            $vskey = implode(",", $this->input->post("panel_key")); //value select processor ->id processor

            $p1 = substr_count($vskey, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vskey);
            $p5 = explode(",",$idkey_awal);

            for($pa = 0;$pa < $p2; $pa++){
                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){
                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','4','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_keyboard WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_keyx = $q2->row()->stok;
                        $stok_now = ($id_keyx) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_keyboard SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }

                }else{

                }
            }

            $this->db->query("
                UPDATE master_pc SET id_keyboard = '$vskey' WHERE id = '$id_pc'
            ");

        }else{

        }

        $vc_mouse = $this->input->post("vc_mouse"); 
        if($vc_mouse == 1){
            $vgat = implode(",", $this->input->post("gat5")); // value penentu ganti atau tidak 0/1
            $vsmouse = implode(",", $this->input->post("panel_mouse")); //value select processor ->id processor

            $p1 = substr_count($vsmouse, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vsmouse);
            $p5 = explode(",",$idmouse_awal);

            for($pa = 0;$pa < $p2; $pa++){

                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){
                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','5','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_mouse WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_mousex = $q2->row()->stok;
                        $stok_now = ($id_mousex) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_mouse SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }
                }else{

                }
            }

            $this->db->query("
                UPDATE master_pc SET id_mouse = '$vsmouse' WHERE id = '$id_pc'
            ");

        }else{

        }

        $vc_monitor = $this->input->post("vc_monitor"); 
        if($vc_monitor == 1){
            $vgat = implode(",", $this->input->post("gat6")); // value penentu ganti atau tidak 0/1
            $vsmonitor = implode(",", $this->input->post("panel_monitor")); //value select processor ->id processor

            $p1 = substr_count($vsmonitor, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vsmonitor);
            $p5 = explode(",",$idmon_awal);

            for($pa = 0;$pa < $p2; $pa++){
                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){

                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','6','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_monitor WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_monx = $q2->row()->stok;
                        $stok_now = ($id_monx) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_monitor SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }

                }else{

                }
            }

            $this->db->query("
                UPDATE master_pc SET id_monitor = '$vsmonitor' WHERE id = '$id_pc'
            ");

        }else{

        }

        $vc_printer = $this->input->post("vc_printer"); 
        if($vc_printer == 1){
            $vgat = implode(",", $this->input->post("gat7")); // value penentu ganti atau tidak 0/1
            $vsprint = implode(",", $this->input->post("panel_printer")); //value select processor ->id processor

            $p1 = substr_count($vsprint, ",");
            $p2 = ($p1) + 1;
            $p3 = explode(",",$vgat);
            $p4 = explode(",",$vsprint);
            $p5 = explode(",",$idprint_awal);

            for($pa = 0;$pa < $p2; $pa++){
                $arr_p3 = $p3[$pa];
                $arr_p4 = $p4[$pa];
                $arr_p5 = $p5[$pa];

                if($arr_p3 == 1){

                    $q1 = $this->db->query("
                        INSERT INTO tbl_service (id_permintaan,id_pc,komponen,id_komponen,log, add_by, id_komponen_baru) 
                        VALUES('$id_permintaan','$id_pc','7','$arr_p5', now(), '$iduser', '$arr_p4')
                    ");

                    if($q1){

                        $q2 = $this->db->query("
                            SELECT * FROM tbl_printer WHERE id = '$arr_p4' and hapus is null
                        ");

                        $id_printx = $q2->row()->stok;
                        $stok_now = ($id_printx) - 1;

                        $q3 = $this->db->query("
                            UPDATE tbl_printer SET stok = '$stok_now' WHERE id = '$arr_p4'
                        ");
                        

                    }else{

                    }

                }else{

                }
            }

            $this->db->query("
                UPDATE master_pc SET id_printer = '$vsprint' WHERE id = '$id_pc'
            ");

        }else{

        }
    }

    function update_proses_time(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ket = $this->input->post('txt_kettutup');	    	/* Deklarasi variable */
        $ip = $this->input->ip_address();

        $cek = $this->db->query("
            SELECT dibuat,ditutup FROM tbl_permintaan WHERE id = '$id'
        ");

        $dibuat = $cek->row()->dibuat;
        $ditutup = $cek->row()->ditutup;

        $proses = $this->db->query("
            SELECT TIMEDIFF('$ditutup',' $dibuat') as b
        ");

        $proses_time = $proses->row()->b;

        $str1 = $proses_time;
        $str2 = "15:00:00";
        $str3 = "63:00:00";

        $he = explode(':', $str1);
        $he2 = explode(':', $str2);
        $he3 = explode(':', $str3);

        if($str1 > $str3){

            $jam = $he[0]-$he3[0];
            $menit = $he[1]-$he3[1];
            $detik = $he[2]-$he3[2];
    
            $fixed = $jam.":".$menit.":".$detik;
            //echo 'lebih dari 63 jam';
            
        }elseif($str1 > $str2){

            $jam = $he[0]-$he2[0];
            $menit = $he[1]-$he2[1];
            $detik = $he[2]-$he2[2];
    
            $fixed = $jam.":".$menit.":".$detik;
            //echo 'lebih dari 15 jam';
        }else{
            $fixed = $proses_time;
        }

        $update = $this->db->query("
            UPDATE tbl_permintaan SET proses_time = '$fixed' WHERE id = '$id'
        ");
    }

    //======================================================================================================================
    /* Hapus Permintaan */
    function hapus_permintaan(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $ket = $this->input->post('txt_kethapus');	    	/* Deklarasi variable */
        $ip = $this->input->ip_address();

        $query1 = "update tbl_permintaan set hapus = 'H', kondisi = 'Permintaan Dihapus' where id = ?;";
        
        $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Permintaan Dihapus', ?, now(), ?, ?);";

        $this->db->trans_begin();  
        try {
            $this->db->query($query1, array($id));
            $this->db->query($query2, array($id_per, $ket, $iduser, $ip)); 
            
            if($this->db->trans_commit()){
                $this->kirim_updatetutuphapus_permintaan_by_email($id_per , 'HAPUS');
                $this->kirim_tutuphapus_permintaan_by_email_to_admin($id_per, 'HAPUS');
            };            
        } catch (exception $e) {
            $this->db->trans_rollback();
        }  
    
        return True;
    }

    //======================================================================================================================
    /* Update Permintaan */
    function update_permintaan(){
        $iduser =  $this->session->userdata("id");
        $id = $this->input->post('id_modal');				/* Deklarasi variable */
        $id_per = $this->input->post('id_per_modal');		/* Deklarasi variable */
        $kond = $this->input->post('txt_kond');             /* Deklarasi variable */
        $ket = $this->input->post('txt_ketupdate');	    	/* Deklarasi variable */
        $ip = $this->input->ip_address();

        if($kond == 'Permintaan ditolak oleh Divisi IT' && $iduser != 'USR0004'){
            //do nothing
        }elseif($kond == 'Permintaan ditolak oleh Divisi IT' && $iduser == 'USR0004'){

            $query1 = "update tbl_permintaan set kondisi = ? where id = ?;";
            
            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, ?, ?, now(), ?, ?);";
    
            $this->db->trans_begin();  
            try {
                $this->db->query($query1, array($kond, $id));
                $this->db->query($query2, array($id_per, $kond, $ket, $iduser, $ip)); 
                
                if($this->db->trans_commit()){
                    $this->kirim_notif_penolakan($id_per);
                };            
            } catch (exception $e) {
                $this->db->trans_rollback();
            }  
        
            return True;

        }else{
            $query1 = "update tbl_permintaan set kondisi = ? where id = ?;";
            
            $query2 = "insert into tbl_permintaan_log
                (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
                values 
                (concat(uuid_short()), ?, ?, ?, now(), ?, ?);";
    
            $this->db->trans_begin();  
            try {
                $this->db->query($query1, array($kond, $id));
                $this->db->query($query2, array($id_per, $kond, $ket, $iduser, $ip)); 
                
                if($this->db->trans_commit()){
                    $this->kirim_updatetutuphapus_permintaan_by_email($id_per , 'update');
                };            
            } catch (exception $e) {
                $this->db->trans_rollback();
            }  
        
            return True;
        }
    }

    //======================================================================================================================    
    function kirim_permintaan_by_email($idpermintaan){        
        /* Kirim permintaan yang telah dibuat via email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
		
		$config = array();                          /* Deklarasi config sebagai array */
		$config['protocol'] = 'smtp';               /* Set konfigurasi email */
		$config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
		$config['smtp_user'] = '';                  /* Set konfigurasi email */
		$config['smtp_pass'] = '';                  /* Set konfigurasi email */
		$config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

        $query3 = $this->db->query("
        select GROUP_CONCAT(a.email SEPARATOR ',') as email from tbl_user as a 
        where a.level = 'ADMIN' and a.email is not null;
        ");

        $a = $query3->row();
        $daftarcc = $a->email;


        $query4 = $this->db->query("
            select a.email from tbl_user as a 
            where a.level = 'DEFAULT' and a.email is not null;
        ");
        
        $default = $query4->row();              
        
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
		//$this->email->set_newline("\r\n");                                                /**/
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */		
        $this->email->to($default->email);  
        $this->email->bcc($daftarcc);                                                 /* recipient / penerima */		                                                       
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		                        /* bcc */
        $this->email->subject('PERMINTAAN BARU '.$idpermintaan.' !');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
		$message = $this->load->view('forms_email/email_permintaan.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
            //echo "sukses coy";
        } else {
            //echo $this->email->print_debugger();
        }
       
    }

//======================================================================================================================    
    function kirim_email_ke_pembuat($idpermintaan){        
        /* Kirim permintaan yang telah dibuat via email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
		
		$config = array();                          /* Deklarasi config sebagai array */
		$config['protocol'] = 'smtp';               /* Set konfigurasi email */
		$config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
		$config['smtp_user'] = '';                  /* Set konfigurasi email */
		$config['smtp_pass'] = '';                  /* Set konfigurasi email */
		$config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

        /*$query3 = $this->db->query("
        select GROUP_CONCAT(a.email SEPARATOR ',') as email from tbl_user as a 
        where a.level = 'ADMIN' and a.email is not null;
        ");

        $a = $query3->row();
        $daftarcc = $a->email;
        */

        $query4 = $this->db->query("
            select a.emailaddress as email from tbl_permintaan as a 
            where a.id_permintaan = '$idpermintaan' and a.emailaddress is not null;
        ");
        
        $default = $query4->row();              
        
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
		//$this->email->set_newline("\r\n");                                                /**/
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */		
        $this->email->to($default->email);  
        //$this->email->bcc($daftarcc);                                                 /* recipient / penerima */		                                                       
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		                        /* bcc */
        $this->email->subject('PERMINTAAN '.$idpermintaan.' TELAH BERHASIL DIBUAT !');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
		$message = $this->load->view('forms_email/email_permintaan.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
           // echo "sukses coy";
        } else {
            //echo $this->email->print_debugger();
        }
       
	}

    //======================================================================================================================    
    function kirim_respon_permintaan_by_email($idpermintaan, $respon){        
        /* Kirim respon permintaan by email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
		
		$config = array();                          /* Deklarasi config sebagai array */
		$config['protocol'] = 'smtp';               /* Set konfigurasi email */
		$config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
		$config['smtp_user'] = '';                  /* Set konfigurasi email */
		$config['smtp_pass'] = '';                  /* Set konfigurasi email */
		$config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

        $query3 = $this->db->query("
            select a.emailaddress from tbl_permintaan as a 
            where a.id_permintaan = '$idpermintaan' 
            and a.emailaddress is not null 
            and not (a.emailaddress = '-') and hapus is null;
        ");
                
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
		//$this->email->set_newline("\r\n");                                                /**/
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */
		//$this->email->cc($daftarcc);                                                      /* cc */
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		                        /* bcc */
        if($respon == 'Diterima') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah diterima !');                                 /* subject / judul */
        } elseif($respon == 'Ditolak') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah ditolak !');                                  /* subject / judul */
        };        
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
		$message = $this->load->view('forms_email/email_permintaan.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                             /* KIRIM EMAIL */
        
        if ($query3->num_rows() > 0) {
            $target = $query3->row(); 
            $this->email->to($target->emailaddress);                                        /* recipient / penerima */
            $this->email->send();
        };
    }
    
    //======================================================================================================================    
    function kirim_updatetutuphapus_permintaan_by_email($idpermintaan, $statuz){        
        /* Kirim notifikasi tutup / hapus permintaan by email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
		
		$config = array();                          /* Deklarasi config sebagai array */
		$config['protocol'] = 'smtp';               /* Set konfigurasi email */
		$config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
		$config['smtp_user'] = '';                  /* Set konfigurasi email */
		$config['smtp_pass'] = '';                  /* Set konfigurasi email */
		$config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

        $query3 = $this->db->query("
            select a.emailaddress from tbl_permintaan as a 
            where a.id_permintaan = '$idpermintaan' 
            and a.emailaddress is not null 
            and not (a.emailaddress = '-');
        ");
                
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
		//$this->email->set_newline("\r\n");                                                /**/
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */		
		                                         
		//$this->email->cc($daftarcc);                                                      /* cc */
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		                        /* bcc */
        if($statuz == 'TUTUP') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah ditutup !');                       /* subject / judul */
        } elseif ($statuz == 'HAPUS') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah dihapus !');                       /* subject / judul */
        } elseif ($statuz == 'update') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah diupdate !');                       /* subject / judul */
        };

        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
		$message = $this->load->view('forms_email/email_permintaan.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                             /* KIRIM EMAIL */
        
        if ($query3->num_rows() > 0) {
            $target = $query3->row(); 
            $this->email->to($target->emailaddress);                                        /* recipient / penerima */
            $this->email->send();
        };
	}

    //======================================================================================================================    
    function kirim_tutuphapus_permintaan_by_email_to_admin($idpermintaan, $statuz){ 
        /* Kirim notifikasi tutup / hapus permintaan by email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
		
		$config = array();                          /* Deklarasi config sebagai array */
		$config['protocol'] = 'smtp';               /* Set konfigurasi email */
		$config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
		$config['smtp_user'] = '';                  /* Set konfigurasi email */
		$config['smtp_pass'] = '';                  /* Set konfigurasi email */
		$config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

        $query3 = $this->db->query("
            select a.email from tbl_user as a 
            where a.level = 'ADMIN' and a.email is not null;
        ");
                
        $daftarcc = array();                                    /* Deklarasi daftarcc sebagai cc */ 
        if ($query3->num_rows() > 0){   
            foreach ($query3->result() as $email) {             /* populating result ke dalam array */
                foreach ($email as $key => $value) {
                    $daftarcc[$key] = $value;
                };
            };
            $this->email->cc($daftarcc);                                                    /* cc */
        };

        $query4 = $this->db->query("
            select a.email from tbl_user as a 
            where a.level = 'DEFAULT' and a.email is not null;
        ");
        
        $default = $query4->row();  

        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
		//$this->email->set_newline("\r\n");                                                /**/
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */		
		$this->email->to($default->email);                                                  /* recipient / penerima */
		$this->email->cc($daftarcc);                                                        /* cc */
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		                        /* bcc */
        if($statuz == 'TUTUP') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah ditutup !');                            /* subject / judul */
        } elseif ($statuz == 'HAPUS') {
            $this->email->subject('Permintaan anda dengan ID : '. $idpermintaan . ', telah dihapus !');                            /* subject / judul */
        };
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */

        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
		$message = $this->load->view('forms_email/email_permintaan.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        $this->email->send();                                                               /* KIRIM EMAIL */
        
    }
    //========================================================================================================
    function kirim_permintaan_ke_atasan($idpermintaan){        
        /* Kirim permintaan yang telah dibuat via email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
		
		$config = array();                          /* Deklarasi config sebagai array */
		$config['protocol'] = 'smtp';               /* Set konfigurasi email */
		$config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
		$config['smtp_user'] = '';                  /* Set konfigurasi email */
		$config['smtp_pass'] = '';                  /* Set konfigurasi email */
		$config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

       /* $query3 = $this->db->query("
            select a.email from tbl_user as a 
            where a.level = 'ADMIN' and a.email is not null;
        ");

        $daftarcc = array();                                /* Deklarasi daftarcc sebagai cc *
        if ($query3->num_rows() > 0){   
            foreach ($query3->result() as $email) {             /* populating result ke dalam array *
                foreach ($email as $key => $value) {
                    $daftarcc[$key] = $value;
                };
            };
            $this->email->cc($daftarcc);                                                    /* cc 
        };
        */

        $query4 = $this->db->query("
            select a.email 
            from tbl_user as a
            left join tbl_department as b on b.nama_atasan = a.id
            where b.kd = (select c.dept from tbl_permintaan as c where c.id_permintaan = '$idpermintaan');
        ");
        
        $default = $query4->row();              
        
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
		//$this->email->set_newline("\r\n");                                                /**/
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */		
		$this->email->to($default->email);                                                  /* recipient / penerima */		                                                       
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		                        /* bcc */
        $this->email->subject('Permintaan Approval !');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
		$message = $this->load->view('forms_email/email_permintaan2.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
            //echo "sukses coy";
        } else {
            //echo $this->email->print_debugger();
        }
       
	}

//========================================================================================================
    function kirim_permintaan_ke_atasan2($idpermintaan){        
        /* Kirim permintaan yang telah dibuat via email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
        
        $config = array();                          /* Deklarasi config sebagai array */
        $config['protocol'] = 'smtp';               /* Set konfigurasi email */
        $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
        $config['smtp_user'] = '';                  /* Set konfigurasi email */
        $config['smtp_pass'] = '';                  /* Set konfigurasi email */
        $config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

       /* $query3 = $this->db->query("
            select a.email from tbl_user as a 
            where a.level = 'ADMIN' and a.email is not null;
        ");

        $daftarcc = array();                                /* Deklarasi daftarcc sebagai cc *
        if ($query3->num_rows() > 0){   
            foreach ($query3->result() as $email) {             /* populating result ke dalam array *
                foreach ($email as $key => $value) {
                    $daftarcc[$key] = $value;
                };
            };
            $this->email->cc($daftarcc);                                                    /* cc 
        };
        */

        $query4 = $this->db->query("
            select a.email 
            from tbl_user as a
            left join tbl_department as b on b.nama_atasan = a.id
            where b.kd = (select c.dept from tbl_permintaan as c where c.id_permintaan = '$idpermintaan');
        ");
        
        $default = $query4->row();   

        $query5 = $this->db->query("select nama from tbl_permintaan where id_permintaan = '$idpermintaan'");
        $nm_user = $query5->row();
        
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
        //$this->email->set_newline("\r\n");                                                /**/
        $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */        
        $this->email->to($default->email);                                                  /* recipient / penerima */                                                             
        //$this->email->bcc('miming.setiawan@sipatex.co.id');                               /* bcc */
        $this->email->subject('Permintaan Approval Dari '.$nm_user->nama.'');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
        $message = $this->load->view('forms_email/email_permintaan2.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
            //echo "sukses coy";
        } else {
            //echo $this->email->print_debugger();
        }
       
    }



    //========================================================================================================
    function kirim_notif_penolakan($idpermintaan){        
        /* Kirim permintaan yang telah dibuat via email */
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
        
        $config = array();                          /* Deklarasi config sebagai array */
        $config['protocol'] = 'smtp';               /* Set konfigurasi email */
        $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
        $config['smtp_user'] = '';                  /* Set konfigurasi email */
        $config['smtp_pass'] = '';                  /* Set konfigurasi email */
        $config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $query1 = $this->db->query("
            select a.id, a.id_permintaan, a.iduser, a.nama, a.emailaddress, a.dept, a.bagian, a.telp, a.perihal, a.detail, 
            b.nama_dept as 'dept2', c.nama_bagian as 'bagian2',
            case a.respon when 0 then 'Belum Ditentukan' when 1 then 'Diterima' when 2 then 'Ditolak' end as respon, 
            case a.jenis_permintaan when 0 then 'Belum Ditentukan' when 1 then 'Permintaan Service' 
            when 2 then 'Permintaan Barang' when 3 then 'Permintaan Aplikasi' when 4 then 'Lain-lain' end as jenis, 
            case a.approve when 0 then 'Belum Ditentukan' when 1 then 'Disetujui' when 2 then 'Tidak Disetujui' end as approve,
            a.kondisi,
            case a.statuz when 0 then 'Open' when 1 then 'Closed' end as statuz,
            a.id_bukti 
            from tbl_permintaan as a
            left join tbl_department as b on a.dept = b.kd
            left join tbl_bagian as c on a.bagian = c.kd
            where a.hapus is null and a.id_permintaan = '$idpermintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$idpermintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;

        $query4 = $this->db->query("
            select a.email 
            from tbl_user as a
            left join tbl_department as b on b.nama_atasan = a.id
            where b.kd = (select c.dept from tbl_permintaan as c where c.id_permintaan = '$idpermintaan');
        ");
        
        $default = $query4->row(); 

        /*cari id atasan
        $cek_dept = $this->db->query("
            select dept from tbl_permintaan a where a.id_permintaan = '$idpermintaan'
        ");
        $kd_dept = $cek_dept->row()->dept;

        $cek_atasan = $this->db->query("
            select nama_atasan from tbl_department where kd = '$kd_dept'
        ");
        $id_atasan = $cek_atasan->row()->nama_atasan;

        $q_email_atasan = $this->db->query("
            select email from tbl_user where id = '$id_atasan'
        ");
        $email_atasan = $q_email_atasan->row()->email;

        */

        $query5 = $this->db->query("select nama,emailaddress from tbl_permintaan where id_permintaan = '$idpermintaan'");
        $nm_user = $query5->row()->nama;
        $email_user = $query5->row()->emailaddress;
        
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
        //$this->email->set_newline("\r\n");                                                /**/
        $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */        
        $this->email->to($default->email);                                                  /* recipient / penerima */                                                             
        $this->email->bcc($email_user);                               /* bcc */
        $this->email->subject('Permintaan anda dengan ID :'.$idpermintaan.', telah ditolak !');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
        $message = $this->load->view('forms_email/email_penolakan.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
            //echo "sukses coy";
        } else {
            //echo $this->email->print_debugger();
        }
       
    }

}
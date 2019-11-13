<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    
    //======================================================================================================================
    /* Ambil data daftar user */
    function data_user(){
		$query1 = $this->db->query("
            select a.id, a.nama, a.username, a.email, a.level, a.departemen, a.bagian, a.tgl_buat, a.hapus,
            b.nama_dept, c.nama_bagian, if(a.hapus is null, 'Aktif', 'Tidak Aktif') as 'statuz' 
			from tbl_user as a
			left join tbl_department b on a.departemen = b.kd
			left join tbl_bagian c on a.bagian = c.kd
            order by a.nama;
        ");        
        return $query1;                 
    }

    //======================================================================================================================
    /* Update data user (nonaktifkan user) */
    function nonaktifuser($id){
		$query1 = $this->db->query("
            Update tbl_user set hapus = '*', tgl_hapus = now() where id = '$id';
        ");        
        return True;                 
    }

    //======================================================================================================================
    /* Update data user (aktifkan user) */
    function aktifuser($id){
		$query1 = $this->db->query("
            Update tbl_user set hapus = null, tgl_hapus = null where id = '$id';
        ");        
        return True;                 
    }

    //======================================================================================================================
    /* mengambil daftar departemen */
    function ambil_daftar_departemen(){
        $query1 = $this->db->query("select kd, nama_dept from tbl_department where hapus is null order by nama_dept;");
         
        return $query1;
    }

    //======================================================================================================================
    /* mengambil daftar bagian */
    function ambil_daftar_bagian(){
        $query1 = $this->db->query("select kd, nama_bagian from tbl_bagian where hapus is null order by nama_bagian;");
         
        return $query1;
    }

    function ambil_daftar_lokasi(){
        $query = $this->db->query("
            select * from mu_kat_parameter a where a.ref_kat = '98323530055155834';
        ");
        return $query;
    }

    //======================================================================================================================
    function generate_iduser(){
        $query1 = $this->db->query("
            select CONCAT('USR', 
            LPAD(IF(cast(max(RIGHT(a.id, 3)) AS unsigned) IS NULL, 1, cast(max(RIGHT(a.id, 3)) AS unsigned)+1), 4,'0')) as x
            from tbl_user as a
            where LEFT(a.id, 3) ='USR';        
        ");
        $idbaru = $query1->row();

        return $idbaru->x; 
    } 

    //======================================================================================================================
    /* menyimpan user */
    function simpan_user(){
        $iduser = $this->generate_iduser();
        $nama = $this->input->post('txt_nama');
        $username = $this->input->post('txt_username');
        $email =  $this->input->post('txt_email');
        $password = $this->input->post('txt_password');
        $dept = $this->input->post('txt_dept');
        $bagian = $this->input->post('txt_bagian');
        $level = $this->input->post('txt_level');
        $telp = $this->input->post('txt_telp');
        $lokasi = $this->input->post('txt_lokasi');
        $by = $this->session->userdata('id');
        

        $query1 = "insert into tbl_user (id, nama, username, email, password, level, departemen, bagian, telp, tgl_buat, pw_text, lokasi, add_by) 
            values 
            (?, ?, ?, ?, password(?), ?, ?, ?, ?, now(),?,?,?);";

        $this->db->trans_begin();
        try {
            $this->db->query($query1, array($iduser, $nama, $username, $email, $password, $level, $dept, $bagian, $telp, $password,$lokasi, $by));
            $this->db->trans_commit();
        } catch (exception $e) {
            $this->db->trans_rollback();
        }

        if($query1){
            /* Kirim permintaan yang telah dibuat via email */
            $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
            
            $config = array();                          /* Deklarasi config sebagai array */
            $config['protocol'] = 'smtp';               /* Set konfigurasi email */
            $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
            $config['smtp_user'] = '';                  /* Set konfigurasi email */
            $config['smtp_pass'] = '';                  /* Set konfigurasi email */
            $config['smtp_port'] = 25;                  /* Set konfigurasi email */
            $this->email->initialize($config);          /* Terapkan configurasi */

            //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
            //$this->email->to($list);                                                          /* recipient / penerima */ 
            //$this->email->set_newline("\r\n");                                                /**/
            $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */        
            $this->email->to($email);                                                  /* recipient / penerima */                                                             
            //$this->email->bcc('miming.setiawan@sipatex.co.id');                               /* bcc */
            $this->email->subject('Akun IT-Helpdesk a/n '.$email.' Telah Dibuat');                                         /* subject / judul */
            $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
            //$this->email->message('Testing the email class.'); 
            $row = array('kategori' => 'add','id_user' => $id_project, 'nama' => $tgl, 'username' => $username, 'email' =>$email, 'password' => $password);                             /* isi pesan email berupa text saja */        
            $message = $this->load->view('forms_email/email_notif_user_baru.php', $row, True);       /* isi pesan email berupa html */
            $this->email->message($message);                                                    /* */
            //$this->email->send();                                                               /* KIRIM EMAIL */
            
            if($this->email->send()){
                echo "sukses coy";
            } else {
                echo $this->email->print_debugger();
            }

        }else{

        }

        return Null;
    }
    
    //======================================================================================================================
    /* mengambil daftar departemen */
    function ambil_user_profile($id){
        $query1 = $this->db->query("
        select a.id, a.nama, a.username, a.email, a.level, a.departemen, a.bagian, a.telp, a.password, a.lokasi, b.nama_dept, c.nama_bagian,
        CASE
            WHEN a.lokasi = 1 THEN 'Pabrik'
            WHEN a.lokasi = 2 THEN 'Putri'
        END as lok
        from tbl_user as a 
        left join tbl_department as b on b.kd = a.departemen 
        left join tbl_bagian as c on c.kd = a.bagian
        where a.id = '$id';");
         
        return $query1;
    }

    //======================================================================================================================
    /* mengambil daftar departemen */
    function simpan_password_baru(){
        $id = $this->session->userdata('id');        
        $newpass = $this->input->post('txt_password');
        $query1 = $this->db->query("update tbl_user as a set a.password = password('$newpass'), a.pw_text = '$newpass' where a.id = '$id';");
         
        return $query1;
    }

    //======================================================================================================================
    /* menyimpan user hasil edit */
    function simpan_user_edited(){
        $iduser = $this->input->post('iduser');
        $nama = $this->input->post('txt_nama');
        $username = $this->input->post('txt_username');
        $email =  $this->input->post('txt_email');
        //$password = $this->input->post('txt_password');
        $dept = $this->input->post('txt_dept');
        $bagian = $this->input->post('txt_bagian');
        $level = $this->input->post('txt_level');
        $telp = $this->input->post('txt_telp');
        $lokasi = $this->input->post('txt_lokasi');

	$query1 = "
            update tbl_user as a 
            set a.nama = ?, a.username = ?, a.email = ?, a.level = ?, a.departemen = ?, a.bagian = ?, a.telp = ?, a.lokasi = ?
            where a.id = ?;
        	";

        	$this->db->trans_begin();
        	try {
            		$this->db->query($query1, array($nama, $username, $email, $level, $dept, $bagian, $telp, $lokasi, $iduser));
            		$this->db->trans_commit();
        	} catch (exception $e) {
            		$this->db->trans_rollback();
        	}
	
	/*$pl = $this->db->query("select password from tbl_user where id = '$iduser'");
	$rows = $pl->row();
	$pu = $rows->password;
	
	if($password == $pu){
		$query1 = "
            		update tbl_user as a 
            		set a.nama = ?, a.username = ?, a.email = ?, a.level = ?, a.departemen = ?, a.bagian = ?, a.telp = ?
            		where a.id = ?;
        	";

        	$this->db->trans_begin();
        	try {
            		$this->db->query($query1, array($nama, $username, $email, $level, $dept, $bagian, $telp, $iduser));
            		$this->db->trans_commit();
        	} catch (exception $e) {
            		$this->db->trans_rollback();
        	}		
	}else{
		$query1 = "
            		update tbl_user as a 
            		set a.nama = ?, a.username = ?, a.email = ?, a.level = ?, a.departemen = ?, a.bagian = ?, a.telp = ?, 
            		a.password = password(?), a.pw_text = ?
            		where a.id = ?;
        	";

        	$this->db->trans_begin();
        	try {
            		$this->db->query($query1, array($nama, $username, $email, $level, $dept, $bagian, $telp, $password, $password, $iduser));
            		$this->db->trans_commit();
        	} catch (exception $e) {
            		$this->db->trans_rollback();
        	}
	}
	*/

        if($query1){
            /* Kirim permintaan yang telah dibuat via email */
            $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
            
            $config = array();                          /* Deklarasi config sebagai array */
            $config['protocol'] = 'smtp';               /* Set konfigurasi email */
            $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
            $config['smtp_user'] = '';                  /* Set konfigurasi email */
            $config['smtp_pass'] = '';                  /* Set konfigurasi email */
            $config['smtp_port'] = 25;                  /* Set konfigurasi email */
            $this->email->initialize($config);          /* Terapkan configurasi */

            //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
            //$this->email->to($list);                                                          /* recipient / penerima */ 
            //$this->email->set_newline("\r\n");                                                /**/
            $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */        
            $this->email->to($email);                                                  /* recipient / penerima */                                                             
            //$this->email->bcc('miming.setiawan@sipatex.co.id');                               /* bcc */
            $this->email->subject('Akun IT-Helpdesk a/n '.$email.' Telah Diubah');                                         /* subject / judul */
            $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
            //$this->email->message('Testing the email class.'); 
            $row = array('kategori' => 'edit','id_user' => $id_project, 'nama' => $tgl, 'username' => $username, 'email' =>$email, 'password' => $password);                             /* isi pesan email berupa text saja */        
            $message = $this->load->view('forms_email/email_notif_user_baru.php', $row, True);       /* isi pesan email berupa html */
            $this->email->message($message);                                                    /* */
            //$this->email->send();                                                               /* KIRIM EMAIL */
            
            if($this->email->send()){
                echo "sukses coy";
            } else {
                echo $this->email->print_debugger();
            }

        }else{
            
        }

        return Null;
    }

	function password_baru(){
		$id_user = $this->input->post("vu");
		$password = $this->input->post("txt_password");
		$ce = $this->db->query("select email from tbl_user where id = '$id_user'");
		$email = $ce->row()->email;
		$query = $this->db->query("UPDATE tbl_user SET password = password('$password'), pw_text = '$password' WHERE id = '$id_user'");

		 $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
            
            $config = array();                          /* Deklarasi config sebagai array */
            $config['protocol'] = 'smtp';               /* Set konfigurasi email */
            $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
            $config['smtp_user'] = '';                  /* Set konfigurasi email */
            $config['smtp_pass'] = '';                  /* Set konfigurasi email */
            $config['smtp_port'] = 25;                  /* Set konfigurasi email */
            $this->email->initialize($config);          /* Terapkan configurasi */

            //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
            //$this->email->to($list);                                                          /* recipient / penerima */ 
            //$this->email->set_newline("\r\n");                                                /**/
            $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */        
            $this->email->to($email);                                                  /* recipient / penerima */                                                             
            //$this->email->bcc('miming.setiawan@sipatex.co.id');                               /* bcc */
            $this->email->subject('Akun IT-Helpdesk a/n '.$email.' Telah Diubah');                                         /* subject / judul */
            $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
            //$this->email->message('Testing the email class.'); 
            $row = array('kategori' => 'edit_password', 'password' => $password, 'email' => $email);                             /* isi pesan email berupa text saja */        
            $message = $this->load->view('forms_email/email_notif_user_baru.php', $row, True);       /* isi pesan email berupa html */
            $this->email->message($message);                                                    /* */
            //$this->email->send();                                                               /* KIRIM EMAIL */
            
            if($this->email->send()){
                echo "sukses coy";
            } else {
                echo $this->email->print_debugger();
            }


	}
    
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class C_Approve extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
    }

    function cek_uri($idp){
        //echo $idp;
        $data['data'] = $idp;
        $this->load->view('approve',$data);
    }

    function update_approve(){
        echo $id = $this->input->post('id');
        $keterangan = $this->input->post('alasan');
	    $ip = $this->input->ip_address();
        $iduser = $this->input->post('iduser');

        /*$cek_history = $this->db->query("select approve, dept, hapus from tbl_permintaan where id_permintaan = '$id'");
        $v_app = $cek_history->row();
        $dept = $v_app->dept;
        $approve = $v_app->approve;
        $hapus = $v_app->hapus;

        $q_atasan = $this->db->query("select nama_atasan from tbl_department where kd = '$dept'");
        $r_atasan = $q_atasan->row();
        if($r_atasan == NULL || $r_atasan == ""){
            $atasan = 'NULL';
        }else{
            $atasan = $r_atasan->nama_atasan;
        }

        if($approve != 0){

            echo 'Permintaan Sudah Di Response';

        }else{

            $data = array(
                'kondisi' => 'Permintaan Diterima Atasan',
                'approve' => 1
            );
    
            $this->db->where('id_permintaan', $id);
            $query = $this->db->update('tbl_permintaan',$data);   
        
            $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Permintaan Diterima Atasan', ?, now(), ?, ?);";
            
            $this->db->trans_begin();  
            try {
                $this->db->query($query2, array($id, $keterangan, $atasan, $ip)); 
                $this->db->trans_commit();
            } catch (exception $e) {
                $this->db->trans_rollback();
            } 

        }
        */
        
    }

    function update_reject(){
        $id = $this->input->post('id');
        $keterangan = $this->input->post('alasan');
        $ip = $this->input->ip_address();
        $iduser = $this->input->post('iduser');

        $cek_history = $this->db->query("select approve, dept, hapus from tbl_permintaan where id_permintaan = '$id'");
        $v_app = $cek_history->row();
        $dept = $v_app->dept;
        $approve = $v_app->approve;
        $hapus = $v_app->hapus;

        $q_atasan = $this->db->query("select nama_atasan from tbl_department where kd = '$dept'");
        $r_atasan = $q_atasan->row();
        if($r_atasan == NULL || $r_atasan == ""){
            $atasan = 'NULL';
        }else{
            $atasan = $r_atasan->nama_atasan;
        }

        if($approve != 0){

            echo 'Permintaan Sudah Di Response';

        }else{

            $data = array(
                'kondisi' => 'Permintaan Ditolak Atasan',
                'approve' => 2
            );
            
            $this->db->where('id_permintaan', $id);
            $query = $this->db->update('tbl_permintaan',$data);

            if($query){
                echo "Success Reject";
            }else{
                echo "Gagal Reject";
            }
          
            $query2 = "insert into tbl_permintaan_log
            (id, id_permintaan, statuz, keterangan, pada, oleh, ip_add) 
            values 
            (concat(uuid_short()), ?, 'Permintaan Service Ditolak Atasan', ?, now(), ?, ?);";
            
            $this->db->trans_begin();  
            try {
                $this->db->query($query2, array($id, $keterangan, $atasan, $ip)); 
                $this->db->trans_commit();
            } catch (exception $e) {
                $this->db->trans_rollback();
            }

            $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */
            $config = array();                          /* Deklarasi config sebagai array */
            $config['protocol'] = 'smtp';               /* Set konfigurasi email */
            $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
            $config['smtp_user'] = '';                  /* Set konfigurasi email */
            $config['smtp_pass'] = '';                  /* Set konfigurasi email */
            $config['smtp_port'] = 25;                  /* Set konfigurasi email */
            $this->email->initialize($config);          /* Terapkan configurasi */
    
            /*$email_atasan = $this->db->query("
                select a.email 
                from tbl_user as a
                left join tbl_department as b on b.nama_atasan = a.id
                where b.kd = (select c.dept from tbl_permintaan as c where c.id_permintaan = '$idpermintaan');
            ");*/

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
            where a.hapus is null and a.id_permintaan = '$id';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$id' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;
        $row['id_permintaan'] = $id;

        $email_admin = $this->db->query("select group_concat(email separator ',') as admin from tbl_user 
        where level = 'ADMIN' and email is not null");
        $admin_mail = $email_admin->row();
        $admin = $admin_mail->admin;

        $email_user = $this->db->query("select email from tbl_user where id = '$iduser'");
        $user_mail = $email_user->row();
        $user = $user_mail->email;
        
        $email_default = $this->db->query("select a.email from tbl_user as a 
        where a.level = 'DEFAULT' and a.email is not null");
        $default_mail = $email_default->row();
        $default = $default_mail->email;              
        
        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
        //$this->email->set_newline("\r\n");                                                /**/
        $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */		
        $this->email->to($default);     
        $this->email->cc($user);                                                  /* recipient / penerima */		                                                       
        $this->email->bcc($admin);		                        /* bcc */
        $this->email->subject('Permintaan '.$id.' Ditolak Atasan !');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
        
        $message = $this->load->view('forms_email/email_reject.php', $row, true);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
            //echo "sukses coy";
        } else {
            //echo $this->email->print_debugger();
        }

        }   

    }

    function notif(){
        $id = $this->input->post('id');

        $query2 = $this->db->query("SELECT tbl_permintaan.nama as nama,tbl_permintaan.perihal as perihal, tbl_permintaan.iduser as iduser,
		tbl_permintaan.detail as detail,tbl_department.nama_dept as departemen from tbl_permintaan 
		LEFT JOIN tbl_department on tbl_permintaan.dept = tbl_department.kd 
		where tbl_permintaan.id_permintaan = '$id'");

        $i=0;
        foreach ($query2->result() as $row)
        {
            $SubjectCode[] = array();
            $SubjectCode[$i]['nama']=$row->nama;
            $SubjectCode[$i]['perihal']=$row->perihal;
            $SubjectCode[$i]['detail']=$row->detail;
            $SubjectCode[$i]['departemen']=$row->departemen;
	        $SubjectCode[$i]['iduser']=$row->iduser;

        }

        header('Content-Type: application/json');
		echo json_encode ($SubjectCode);
    }
 
}
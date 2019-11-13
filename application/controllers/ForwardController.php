<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ForwardController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */

        if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}

    }

    function index(){

        $config = array();                          /* Deklarasi config sebagai array */
        $config['protocol'] = 'smtp';               /* Set konfigurasi email */
        $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
        $config['smtp_user'] = '';                  /* Set konfigurasi email */
        $config['smtp_pass'] = '';                  /* Set konfigurasi email */
        $config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */

        $id = $this->input->post("id_tbl");
        $id_permintaan = $this->input->post("id_request");
        $email_adm = $this->input->post("nm_adm");
        $pesan = $this->input->post("pesan");
        $sender = $this->session->userdata("nama");

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
            where a.hapus is null and a.id_permintaan = '$id_permintaan';
        ");       

        $query2 = $this->db->query("
            select a.id, a.id_permintaan, a.statuz, a.keterangan, a.pada, a.oleh, b.nama as 'user', a.ip_add
            from tbl_permintaan_log as a
            left join tbl_user as b on b.id = a.oleh 
            where a.id_permintaan = '$id_permintaan' order by a.pada;
        ");

        $row['data_permintaan'] = $query1;        
        $row['data_log_permintaan'] = $query2;
        $row['pesan'] = $pesan;
        $row['pengirim'] = $sender;
        

        $q_dp = $this->db->query("
        select a.nama,a.dept,a.bagian,b.nama_bagian,c.nama_dept 
        from tbl_permintaan a
        
        left join tbl_bagian b on a.bagian = b.kd
        left join tbl_department c on a.dept = c.kd
        
        where a.id_permintaan = '$id_permintaan'
        ");

        foreach($q_dp->result() as $y){
            $nm_user = $y->nama;     
            $dept = $y->nama_dept;
            $bag = $y->nama_bagian;       
        }

        //$nm_user = $q_dp->row()->nama;

        //$this->load->library('email');              /* Load Library Email agar fungsi email berfungsi */

        //$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');    /* set recipient / penerima */
        //$this->email->to($list);                                                          /* recipient / penerima */ 
        //$this->email->set_newline("\r\n");                                                /**/
        $this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');                         /* email sender dan nama pengirim */        
        $this->email->to($email_adm);                                                  /* recipient / penerima */                                                             
        //$this->email->bcc('miming.setiawan@sipatex.co.id');                               /* bcc */
        $this->email->subject('Forwarded Request From '.$nm_user.', '.$dept.', '.$bag.' ');                                         /* subject / judul */
        $this->email->set_mailtype("html");                                                 /* Set mailtype menjadi HTML */
        //$this->email->message('Testing the email class.');                                /* isi pesan email berupa text saja */        
        $message = $this->load->view('forms_email/forward.php', $row, True);       /* isi pesan email berupa html */
        $this->email->message($message);                                                    /* */
        //$this->email->send();                                                               /* KIRIM EMAIL */
        
        if($this->email->send()){
            //echo "sukses coy";
            redirect("permintaan/daftarpermintaan");
        } else {
            //echo $this->email->print_debugger();
        }
    }
 
}
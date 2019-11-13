<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Permintaan extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}	
	}
 
	//=================================================================================================================================================
	function index(){
		
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan');
		$row['qty'] = $this->m_permintaan->qty_permintaan();	

		$this->load->view('forms/test1.php', $row);
	}

	//=================================================================================================================================================
	function buatpermintaan(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->view('forms/buatpermintaan.php');
	}

	//=================================================================================================================================================
	function buatpermintaanadmin(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan');
	
		$row['daftar_user'] = $this->m_permintaan->ambil_daftar_user();

		$this->load->view('forms/buatpermintaanadmin.php', $row);
	}

	//=================================================================================================================================================
	function buatpermintaankeluar(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan');
	
		$row['daftar_bagian'] = $this->m_permintaan->ambil_daftar_bagian();
		$row['daftar_departemen'] = $this->m_permintaan->ambil_daftar_departemen();

		$this->load->view('forms/buatpermintaankeluar.php', $row);
	}

	//=================================================================================================================================================
	function lihatpermintaan(){	
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan'); 		/* di load dulu model nya agar bisa digunakan */

		$row['data_lihat_permintaan'] = $this->m_permintaan->data_lihat_permintaan();					/* panggil function di dalem model */
		$row['data_lihat_permintaan_close'] = $this->m_permintaan->data_lihat_permintaan_close();		/* panggil function di dalem model */
		//$row['total'] = $this->m_permintaan->data_lihat_permintaan()->num_rows;
		
		$this->load->view('forms/lihatpermintaan.php', $row);
	}

	//=================================================================================================================================================
	function daftarpermintaan(){
		$this->session->userdata('lokasi');
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$lok = $this->session->userdata('lokasi');

		$this->load->model('m_permintaan'); 		/* di load dulu model nya agar bisa digunakan */

		$row['data_daftar_permintaan'] = $this->m_permintaan->data_daftar_permintaan($lok);					/* panggil function di dalem model */
		$row['data_daftar_permintaan_close'] = $this->m_permintaan->data_daftar_permintaan_close($lok);		/* panggil function di dalem model */
		$row['data_daftar_kondisi'] = $this->m_permintaan->ambil_daftar_kondisi();
		//$row['total_record'] = $this->m_permintaan->total_permintaan();
		//$row['total_record_close'] = $this->m_permintaan->total_permintaan_close();						/* panggil function di dalem model */
		
		$this->load->view('forms/daftarpermintaan.php', $row);
	}

	//=================================================================================================================================================
	function daftarpermintaankeluar(){	
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan'); 		/* di load dulu model nya agar bisa digunakan */

		$row['data_daftar_permintaan_keluar'] = $this->m_permintaan->data_daftar_permintaan_keluar();					/* panggil function di dalem model */
		$row['data_daftar_permintaan_keluar_close'] = $this->m_permintaan->data_daftar_permintaan_keluar_close();		/* panggil function di dalem model */
		
		$this->load->view('forms/daftarpermintaankeluar.php', $row);
	}

	//=================================================================================================================================================
	function simpanpermintaan(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan');				/* di load dulu model nya agar bisa digunakan */

		$this->m_permintaan->simpan_permintaan();		/* panggil function di dalem model */

		redirect('/permintaan/lihatpermintaan'); 		/* pakai redirect agar input tidak terulang ketika page di reload */
	}

	//=================================================================================================================================================
	function simpanpermintaanadmin(){	
		$this->load->model('m_permintaan');				/* di load dulu model nya agar bisa digunakan */

		$this->m_permintaan->simpan_permintaan_admin();	/* panggil function di dalem model */

		redirect('/permintaan/daftarpermintaan'); 		/* pakai redirect agar input tidak terulang ketika page di reload */
	}

	//=================================================================================================================================================
	function simpanpermintaankeluar(){	
		$this->load->model('m_permintaan');					/* di load dulu model nya agar bisa digunakan */

		$this->m_permintaan->simpan_permintaan_keluar();	/* panggil function di dalem model */

		redirect('/dashboard'); 							/* pakai redirect agar input tidak terulang ketika page di reload */
	}
	
	//=================================================================================================================================================
	function lihatlogpermintaan(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */

		$id = $this->input->post('id');				/* Deklarasi variable */
		$id_per = $this->input->post('id_per');		/* Deklarasi variable */
		$row['data_permintaan'] = $this->m_permintaan->ambil_data_permintaan($id);			/* panggil function di dalem model */
		$row['data_log_permintaan'] = $this->m_permintaan->ambil_log_permintaan($id_per);	/* panggil function di dalem model */
		$row['data_daftar_kondisi'] = $this->m_permintaan->ambil_daftar_kondisi();	

		$this->load->view('forms/logpermintaan.php', $row);		
	}

	//=================================================================================================================================================
	function responterima(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->respon_terima();		/* panggil function di dalem model */	
		$this->m_permintaan->update_resp_time();	

		redirect('/permintaan/daftarpermintaan');
	}

	//=================================================================================================================================================
	function respontolak(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->respon_tolak();		/* panggil function di dalem model */		

		redirect('/permintaan/daftarpermintaan');		
	}

	//=================================================================================================================================================
	function jenisservice(){	

		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->jenis_service();		/* panggil function di dalem model */		

		redirect('/permintaan/daftarpermintaan');		
	}

	//=================================================================================================================================================
	function jenisbarang(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->jenis_barang();		/* panggil function di dalem model */		

		redirect('/permintaan/daftarpermintaan');		
	}

	//=================================================================================================================================================
	function jenisaplikasi(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->jenis_aplikasi();		/* panggil function di dalem model */		

		redirect('/permintaan/daftarpermintaan');		
	}

	//=================================================================================================================================================
	function updatekondisi(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->update_permintaan();	/* panggil function di dalem model */		

		redirect('/permintaan/daftarpermintaan');		
	}

	//=================================================================================================================================================
	function tutuppermintaan(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->tutup_permintaan();	/* panggil function di dalem model */	
		$this->m_permintaan->update_proses_time();

		$id_pc = $this->input->post("pc");

		if(!$id_pc){
			
		}else{
			$this->m_permintaan->ganti_komponen();
		}

		redirect('/permintaan/daftarpermintaan');	
	}

	//=================================================================================================================================================
	function hapuspermintaan(){	
		$this->load->model('m_permintaan');			/* di load dulu model nya agar bisa digunakan */
		
		$this->m_permintaan->hapus_permintaan();	/* panggil function di dalem model */		

		redirect('/permintaan/daftarpermintaan');		
	}
	
	//=================================================================================================================================================
	function laporanpermintaan(){	
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->view('forms/laporanpermintaan.php');
    }

	//=================================================================================================================================================
	function testkirim(){
		$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');

		$this->load->model('m_permintaan');	

		$row['data_permintaan'] = $this->m_permintaan->ambil_data_permintaan('97919100398862482');
		$row['data_log_permintaan'] = $this->m_permintaan->ambil_log_permintaan('97919100398862482');

		$this->load->view('forms_email/email_permintaan.php', $row);
	}

	//=================================================================================================================================================
	function testkirimemail(){
		$this->load->library('email');

		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = '192.168.225.2';
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = 25;
		$this->email->initialize($config);
		 
		//$list = array('miming.setiawan@sipatex.co.id', 'aris.munandar@sipatex.co.id');
		$this->email->set_newline("\r\n");
		$this->email->from('noreply@sipatex.co.id', 'IT HELPDESK');
		$this->email->to($list);
		$this->email->to('miming.setiawan@sipatex.co.id');
		$this->email->cc('aris.munandar@sipatex.co.id');
		//$this->email->bcc('miming.setiawan@sipatex.co.id');		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		//$message=$this->load->view('map_mail_format',$data,TRUE);
        //$this->email->message($message);
		
		if ($this->email->send()) {
			echo 'Email sent.';
		} else {
			show_error($this->email->print_debugger());
		}

		redirect('/dashboard');
	}

	/*
	function sendMail() 
	{
		$ci = get_instance();
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "xxxx@gmail.com";
		$config['smtp_pass'] = "xxxxx";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['priority']= "3"; //(range 1=highest ampe 5=lowers)
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		$ci->email->from('xxx@gmail.com', 'Rumahweb');
		$list = array('xxx@xxxx.com');
		$ci->email->to($list);
		$ci->email->subject('judul email');
		$ci->email->message('isi email');
		if ($this->email->send()) {
			echo 'Email sent.';
		} else {
			show_error($this->email->print_debugger());
		}
	}
	*/

	function ajax_close(){
		//$elemen = $this->input->post("el");
		$id_permintaan = $this->input->post('idper');

		$get_idb = $this->db->query("
			select bagian from tbl_permintaan where id_permintaan = '$id_permintaan'
		");

		$bag = $get_idb->row()->bagian;

		$query = $this->db->query("
			select a.*, b.user_pc from master_pc as a
			left join user_pc as b on a.id_user_pc = b.id 
			where a.id_bagian = '$bag' and a.hapus is null;
		");

		if($query->num_rows() < 1){

			echo '
				<option value="" disabled selected>Tidak Ada PC Pada Divisi Ini</option>
			';

		}else{

			echo '
				<option value="" disabled selected>Pilih PC</option>
			';

			foreach($query->result() as $dt1){
				echo '
					<option value="'.$dt1->id.'">'.$dt1->nama_pc.' / '.$dt1->user_pc.'</option>
				';
			}
		}

	}

	function cari_merk(){
		$elemen = $this->input->post("el");
			//get merk
		$q1 = $this->db->query("
			select * from master_merk where status = 1
		");

		echo '
			<option value="" disabled selected>Pilih Merk</option>
		';
		foreach($q1->result() as $dtm){
			echo '
			<option value="'.$dtm->id.'">'.$dtm->nama_merk.'</option>
			';
		}
	}

	function cari_type(){
		$elemen = $this->input->post("el");

		echo '
			<option value="" disabled selected>Pilih Type</option>
		';

		if($elemen == 1){
			//get merk
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 1
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}elseif($elemen == 2){
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 2
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}elseif($elemen == 3){
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 3
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}elseif($elemen == 4){
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 4
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}elseif($elemen == 5){
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 5
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}elseif($elemen == 6){
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 6
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}elseif($elemen == 7){
			$q1 = $this->db->query("
				select * from master_type where status = 1 and kat = 7
			");

			foreach($q1->result() as $dtm){
				echo '
				<option value="'.$dtm->id.'">'.$dtm->nama_type.'</option>
				';
			}
		}
	}

	function vas(){
		$element = $this->input->post("el");
		$pc = $this->input->post("pc");

		$qic = $this->db->query("
			select id_cpu from master_pc where id = '$pc'
		");

		$id_cpu = $qic->row()->id_cpu;

		if($element == 1){

			$sic = $this->db->query("
				select id_processor from master_cpu where id = '$id_cpu'
			");

			$id_proc = $sic->row()->id_processor;

			$query = $this->db->query("
				select * from tbl_processor where id = '$id_proc'
			");

		}elseif($element == 2){

			$sic = $this->db->query("
				select id_memory from master_cpu where id = '$id_cpu'
			");

			$id_mem = $sic->row()->id_memory;

			$query = $this->db->query("
				select * from tbl_memory where id = '$id_mem'
			");
			
		}elseif($element == 3){

			$sic = $this->db->query("
				select id_hardisk from master_cpu where id = '$id_cpu'
			");

			$id_hdd = $sic->row()->id_hardisk;

			$query = $this->db->query("
				select * from tbl_hardisk where id = '$id_hdd'
			");

		}elseif($element == 4){
			
		}elseif($element == 5){

		}elseif($element == 6){

		}elseif($element == 7){

		}else{

		}

		$i=0;
		foreach ($query->result() as $row)
		{
				$SubjectCode[] = array();
				
				$vmerk = $row->merk;
				if(!$vmerk){
					$merk = "";
				}else{
					$merk = $vmerk;
				}

				$vtype = $row->type;
				if(!$vtype){
					$type = "";
				}else{
					$type = $vtype;
				}

				$vclock = $row->clock;
				if(!$vclock){
					$clock = "";
				}else{
					$clock = $vclock;
				}

				$vhertz = $row->hertz;
				if(!$vhertz){
					$hertz = "";
				}else{
					$hertz = $vhertz;
				}

				$vkapas = $row->kapasitas;
				if(!$vkapas){
					$kapasitas = "";
				}else{
					$kapasitas = $vkapas;
				}

				$vbyte = $row->byte;
				if(!$vbyte){
					$byte = "";
				}else{
					$byte = $vbyte;
				}

				$vinch = $row->inches;
				if(!$vinch){
					$inches = "";
				}else{
					$inches = $vinch;
				}

				$SubjectCode[$i]['merk']=$merk; 
				$SubjectCode[$i]['type']=$type; 
				$SubjectCode[$i]['clock']=$clock; 
				$SubjectCode[$i]['hertz']=$hertz;
				
				$SubjectCode[$i]['kapasitas']=$kapasitas;
				$SubjectCode[$i]['byte']=$byte;
				$SubjectCode[$i]['inches']=$inches;

				$i ++;
		}
		
		header('Content-Type: application/json');
		echo json_encode ($SubjectCode);
	}

	function panel_data(){

		$id_pc = $this->input->post("id_pc");
		$ide = $this->input->post("ide");
		
		//get id cpu
		$qg_cpu = $this->db->query("
			select * from master_pc where id = '$id_pc' and hapus is null
		");

		$id_cpu = $qg_cpu->row()->id_cpu;
		$id_mouse = $qg_cpu->row()->id_mouse;
		$id_keyboard = $qg_cpu->row()->id_keyboard;
		$id_monitor = $qg_cpu->row()->id_monitor;
		$id_printer = $qg_cpu->row()->id_printer;
		$id_bagian = $qg_cpu->row()->id_bagian;
		
		//get id processor 
		$qd_cpu = $this->db->query("
			select * from master_cpu where id = '$id_cpu'
		");

		$id_processor = $qd_cpu->row()->id_processor;
		$id_memory = $qd_cpu->row()->id_memory;
		$id_hardisk = $qd_cpu->row()->id_hardisk;
		
		if($ide == 1){ //jka ide nya 1 ->processor

			$sc_proc = substr_count($id_processor,",");
			$tc_proc = ($sc_proc) + 1;
			$exp_proc = explode(",",$id_processor);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Processor : <span id="info_proc"></span></p>
			';
			for($loop1 = 0;$loop1 < $tc_proc;$loop1++){
				$arr_proc = $exp_proc[$loop1];
				$qproc = $this->db->query("
					select * from tbl_processor where id = '$arr_proc' and hapus is null
				");
	
				$all_proc = $this->db->query("
					select a.id as id, b.nama_merk as merk, c.nama_type as type, a.clock as clock, a.hertz as hertz
					from tbl_processor a 
					left join master_merk b on b.id = a.merk
					left join master_type c on c.id = a.`type`
					where
					a.hapus is null;
				");
	
				echo '
					<div class="col-sm-6">
						<select class="form-control" name="panel_proc[]" id="panel_select'.$loop1.'">
					';
	
				foreach($all_proc->result() as $dtp2){
					echo '<option value="'.$dtp2->id.'">'.$dtp2->merk.' '.$dtp2->type.' '.$dtp2->clock.' '.$dtp2->hertz.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_proc'.$loop1.'">Ganti</button>
					<input id="gat'.$loop1.'" name="gat[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select'.$loop1.'").val('.$arr_proc.').trigger("change");

						$("#btn_proc'.$loop1.'").click(function(){

							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat'.$loop1.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select'.$loop1.'").change(function(){
							$("#gat'.$loop1.'").val("0");
						})
					</script>
				';
	
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_processor.'" name="val_awal" id="val_awal" hidden>
			';

		}else{
			//no action
		}

		if($ide == 2){ //memory

			$sc_mem = substr_count($id_memory,",");
			$tc_mem = ($sc_mem) + 1;
			$exp_mem = explode(",",$id_memory);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Memory :</p>
			';

			for($loop2 = 0;$loop2 < $tc_mem;$loop2++){
				$arr_mem = $exp_mem[$loop2];
				$qmem = $this->db->query("
					select * from tbl_memory where id = '$arr_mem' and hapus is null
				");
	
				$all_mem = $this->db->query("
					select a.*, b.nama_merk as merk, c.nama_type as type,
					CASE
						WHEN a.byte = 1 THEN 'KB'
						WHEN a.byte = 2 THEN 'MB'
						WHEN a.byte = 3 THEN 'GB'
						WHEN a.byte = 4 THEN 'TB'
					END as byte_mem
					from tbl_memory a
					left join master_merk b on a.merk = b.id
					left join master_type c on a.type = c.id 
					where a.hapus is null
				");
	
				echo '
					<div class="col-sm-6">
					<select class="form-control" name="panel_mem[]" id="panel_select2'.$loop2.'">
				';
	
				foreach($all_mem->result() as $dtm2){
					echo '<option value="'.$dtm2->id.'">'.$dtm2->merk.' '.$dtm2->type.' '.$dtm2->kapasitas.' '.$dtm2->byte_mem.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_mem'.$loop2.'">Ganti</button>
					<input id="gat2'.$loop2.'" name="gat2[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select2'.$loop2.'").val('.$arr_mem.').trigger("change");

						$("#btn_mem'.$loop2.'").click(function(){
							
							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat2'.$loop2.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select2'.$loop2.'").change(function(){
							$("#gat2'.$loop2.'").val("0");
						})
					</script>
				';
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_memory.'" name="val_awal2" id="val_awal2" hidden>
			';

		}else{
			//no action
		}

		if($ide == 3){

			$sc_hdd = substr_count($id_hardisk,",");
			$tc_hdd = ($sc_hdd) + 1;
			$exp_hdd = explode(",",$id_hardisk);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Hardisk :</p>
			';

			for($loop3 = 0;$loop3 < $tc_hdd;$loop3++){

				$arr_hdd = $exp_hdd[$loop3];

				$qhdd = $this->db->query("
					select * from tbl_hardisk where id = '$arr_hdd' and hapus is null
				");
	
				$all_hdd = $this->db->query("
					select a.*, b.nama_merk as merk, c.nama_type as type,
					CASE
						WHEN a.byte = 1 THEN 'KB'
						WHEN a.byte = 2 THEN 'MB'
						WHEN a.byte = 3 THEN 'GB'
						WHEN a.byte = 4 THEN 'TB'
					END as byte_hdd
					from tbl_hardisk a
					left join master_merk b on a.merk = b.id
					left join master_type c on a.type = c.id 
					where a.hapus is null;
				");
	
				echo '
					<div class="col-sm-6">
					<select class="form-control" name="panel_hdd[]" id="panel_select3'.$loop3.'">
				';
	
				foreach($all_hdd->result() as $dth2){
					echo '<option value="'.$dth2->id.'">'.$dth2->merk.' '.$dth2->type.' '.$dth2->kapasitas.' '.$dth2->byte_hdd.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_hdd'.$loop3.'">Ganti</button>
					<input id="gat3'.$loop3.'" name="gat3[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select3'.$loop3.'").val('.$arr_hdd.').trigger("change");

						$("#btn_hdd'.$loop3.'").click(function(){
							
							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat3'.$loop3.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select3'.$loop3.'").change(function(){
							$("#gat3'.$loop3.'").val("0");
						})

					</script>
				';
	
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_hardisk.'" name="val_awal3" id="val_awal3" hidden>
			';

		}else{
			//no action
		}

		if($ide == 4){

			$sc_key = substr_count($id_keyboard,",");
			$tc_key = ($sc_key) + 1;
			$exp_key = explode(",",$id_keyboard);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Keyboard :</p>
			';

			for($loop4 = 0;$loop4 < $tc_key;$loop4++){

				$arr_key = $exp_key[$loop4];
				$qkey = $this->db->query("
					select * from tbl_keyboard where id = '$arr_key' and hapus is null
				");
	
				$all_key = $this->db->query("
					select a.*, b.nama_merk as merk, c.nama_type as type
					from tbl_keyboard a 
					left join master_merk b on a.merk = b.id
					left join master_type c on a.`type` = c.id
					where a.hapus is null;
				");
	
				echo '
					<div class="col-sm-6">
					<select class="form-control" name="panel_key[]" id="panel_select4'.$loop4.'">
				';
	
				foreach($all_key->result() as $dtk2){
					echo '<option value="'.$dtk2->id.'">'.$dtk2->merk.' '.$dtk2->type.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_key'.$loop4.'">Ganti</button>
					<input id="gat4'.$loop4.'" name="gat4[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select4'.$loop4.'").val('.$arr_key.').trigger("change");

						$("#btn_key'.$loop4.'").click(function(){
							
							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat4'.$loop4.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select4'.$loop4.'").change(function(){
							$("#gat4'.$loop4.'").val("0");
						})

					</script>
				';
	
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_keyboard.'" name="val_awal4" id="val_awal4" hidden>
			';
			
		}else{
			//no action
		}

		if($ide == 5){

			$sc_mouse = substr_count($id_mouse,",");
			$tc_mouse = ($sc_mouse) + 1;
			$exp_mouse = explode(",",$id_mouse);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Mouse :</p>
			';

			for($loop5 = 0;$loop5 < $tc_mouse;$loop5++){

				$arr_mouse = $exp_mouse[$loop5];
				$qmouse = $this->db->query("
					select * from tbl_mouse where id = '$arr_mouse' and hapus is null
				");
	
				$all_mouse = $this->db->query("
					select a.*, b.nama_merk as merk, c.nama_type as type
					from tbl_mouse a 
					left join master_merk b on a.merk = b.id
					left join master_type c on a.`type` = c.id
					where a.hapus is null;
				");
	
				echo '
					<div class="col-sm-6">
					<select class="form-control" name="panel_mouse[]" id="panel_select5'.$loop5.'">
				';
	
				foreach($all_mouse->result() as $dtmouse2){
					echo '<option value="'.$dtmouse2->id.'">'.$dtmouse2->merk.' '.$dtmouse2->type.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_mouse'.$loop5.'">Ganti</button>
					<input id="gat5'.$loop5.'" name="gat5[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select5'.$loop5.'").val('.$arr_mouse.').trigger("change");

						$("#btn_mouse'.$loop5.'").click(function(){
							
							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat5'.$loop5.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select5'.$loop5.'").change(function(){
							$("#gat5'.$loop5.'").val("0");
						})

					</script>
				';
	
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_mouse.'" name="val_awal5" id="val_awal5" hidden>
			';

		}else{
			//no action
		}

		if($ide == 6){

			$sc_monitor = substr_count($id_monitor,",");
			$tc_monitor = ($sc_monitor) + 1;
			$exp_monitor = explode(",",$id_monitor);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Monitor :</p>
			';

			for($loop6 = 0;$loop6 < $tc_monitor;$loop6++){

				$arr_monitor = $exp_monitor[$loop6];
				$qmonitor = $this->db->query("
					select * from tbl_monitor where id = '$arr_monitor' and hapus is null
				");
	
				$all_monitor = $this->db->query("
					select a.*, b.nama_merk as merk, c.nama_type as type
					from tbl_monitor a 
					left join master_merk b on a.merk = b.id
					left join master_type c on a.`type` = c.id
					where a.hapus is null;
				");
	
				echo '
					<div class="col-sm-6">
					<select class="form-control" name="panel_monitor[]" id="panel_select6'.$loop6.'">
				';
	
				foreach($all_monitor->result() as $dtmonitor2){
					echo '<option value="'.$dtmonitor2->id.'">'.$dtmonitor2->merk.' '.$dtmonitor2->type.' `'.$dtmonitor2->inches.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_mon'.$loop6.'">Ganti</button>
					<input id="gat6'.$loop6.'" name="gat6[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select6'.$loop6.'").val('.$arr_monitor.').trigger("change");

						$("#btn_mon'.$loop6.'").click(function(){
							
							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat6'.$loop6.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select6'.$loop6.'").change(function(){
							$("#gat6'.$loop6.'").val("0");
						})

					</script>
				';
	
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_monitor.'" name="val_awal6" id="val_awal6" hidden>
			';

		}else{
			//no action
		}

		if($ide == 7){

			$sc_printer = substr_count($id_printer,",");
			$tc_printer = ($sc_printer) + 1;
			$exp_printer = explode(",",$id_printer);
	
			echo '
				<div class="col-sm-12">
				<div class="row">
				<p style="font-weight:bold;">Printer :</p>
			';

			for($loop7 = 0;$loop7 < $tc_printer;$loop7++){

				$arr_printer = $exp_printer[$loop7];
				$qprinter = $this->db->query("
					select * from tbl_printer where id = '$arr_printer' and hapus is null
				");
	
				$all_printer = $this->db->query("
					select a.*, b.nama_merk as merk, c.nama_type as type
					from tbl_printer a 
					left join master_merk b on a.merk = b.id
					left join master_type c on a.`type` = c.id
					where a.hapus is null;
				");
	
				echo '
					<div class="col-sm-6">
					<select class="form-control" name="panel_printer[]" id="panel_select7'.$loop7.'">
				';
	
				foreach($all_printer->result() as $dtprinter2){
					echo '<option value="'.$dtprinter2->id.'">'.$dtprinter2->merk.' '.$dtprinter2->type.'</option>';
				}
	
				echo '
					</select>
					</br>
					<button type="button" class="btn btn-sm btn-success" id="btn_print'.$loop7.'">Ganti</button>
					<input id="gat7'.$loop7.'" name="gat7[]" value="0"></input>
					</div>
				';
	
				echo '
					<script>
						$("#panel_select7'.$loop7.'").val('.$arr_printer.').trigger("change");

						$("#btn_print'.$loop7.'").click(function(){
							
							if (confirm("Anda Yakin ?") == true) {
								
								$("#gat7'.$loop7.'").val("1");

							} else {
								//alert("Batal !");
							}

						})
						
						$("#panel_select7'.$loop7.'").change(function(){
							$("#gat7'.$loop7.'").val("0");
						})

					</script>
				';
	
			}
	
			echo '	</div>
				</div>
			';

			echo '
				<input type="text" value="'.$id_printer.'" name="val_awal7" id="val_awal7" hidden>
			';

		}else{
			//no action
		}
		
	}

	function cpu_serv(){
		$id_permintaan = $this->input->post("id_permintaan");

		$query = $this->db->query("select iduser from tbl_permintaan where id_permintaan = '$id_permintaan'");

		$iduser = $query->row()->iduser;

		if($query->num_rows() < 1){
			//kosong
			echo '
				<option value="" disabled selected>Tidak Ada PC</option>
			';
		}else{

			$q1 = $this->db->query("
				select a.bagian from tbl_user a where a.id = '$iduser';
			");

			$lokasi = $q1->row()->bagian;

			$q2 = $this->db->query("
				select a.nama_pc, a.id, b.user_pc from master_pc a 
				left join user_pc b on a.id_user_pc = b.id
				where a.id_bagian = '$lokasi';
			");

			echo '
				<option value="" disabled selected>Pilih PC</option>
			';

			foreach($q2->result() as $dtcpu){
				echo '
					<option value="'.$dtcpu->id.'">'.$dtcpu->nama_pc.' / '.$dtcpu->user_pc.'</option>
				';
			}
			
		}
		
	}

}
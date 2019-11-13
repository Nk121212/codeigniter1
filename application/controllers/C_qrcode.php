<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class C_qrcode extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php"));
		}

		/*$this->load->view('layouts/head.php');
		$this->load->view('layouts/topbar.php');
		$this->load->view('layouts/sidebar.php');
		$this->load->view('layouts/script.php');	
		$this->load->view('layouts/foot.php');*/	
    }

    function index(){
        $this->load->view("qr_code/v_qrcode");
	}

	function qrcode(){
		$opt1 = $this->input->post("saoo"); //option pilih all atau berdasarkan id
		$this->load->library('pdf');                /* Load Liblary pdf */
		$data["opt"] = $opt1;

		if($opt1 == 1){
			//echo 'panggil fungsi qr code all';
			$this->qr_all();
			//redirect("C_qrcode/index");
			$this->load->view('printout/v_qr.php', $data);
			
			$html = $this->output->get_output();    
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'Portrait'); //Landscape or Portrait
			$this->dompdf->render();
			$this->dompdf->stream("QR_Code_All.pdf", array("Attachment"=>0));
			
		}else{
			//echo 'panggil fungsi qrcode by id';
			$uid_pc = $this->input->post("uid_pc");
			$this->qr_byid($uid_pc);

			$data["uid"] = $uid_pc;
			$this->load->view('printout/v_qr.php', $data);
			
			$html = $this->output->get_output();    
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper(array(0, 0, 150, 200), 'landscape'); 
			$this->dompdf->render();
			$this->dompdf->stream("QR_Code_ById.pdf", array("Attachment"=>0));
			
		}
	}

	function qr_byid($uid_pc){
		$imp_uid = implode(",",$uid_pc); //ganti array jadi string dengan splitter koma

			$qpc = $this->db->query("
			select a.*, a.uid, a.id as id_pc, b.*, c.nama_bagian
			from master_pc a
			left join master_cpu b
			on a.id_cpu = b.id
			left join tbl_bagian c 
			on a.id_bagian = c.kd
			where a.uid IN ($imp_uid) and a.hapus is null;
		");

		$no = 1;
		foreach($qpc->result() as $dpc){

			$lok_pc = $dpc->nama_bagian;
			$id_pc = $dpc->id_pc;
			$id_cpu = $dpc->id_cpu;
			$nama_pc = $dpc->nama_pc;
			$nf_qrcode = $dpc->uid;
				
			$qcpu = $this->db->query("
				select * from master_cpu where id = '$id_cpu' and hapus is null
			");

			$id_processor = $qcpu->row()->id_processor;
			$hip = substr_count($id_processor, ",");
			$tip = ($hip) + 1;
			$exp_proc = explode(",",$id_processor);

				$i = "";
				$p1 = "";
				for($i=0; $i<$tip; $i++){
					//echo 'a';
					$arr_proc = $exp_proc[$i];
					$qproc2 = $this->db->query("
						select a.*,b.nama_merk,c.nama_type 
						from tbl_processor a
						left join master_merk b 
						on a.merk = b.id
						left join master_type c 
						on a.`type` = c.id
						where a.id = '$arr_proc' and a.hapus IS NULL;
					");

					$dt_proc = "";
					foreach($qproc2->result() as $dtproc2){
						$p1 .= $dtproc2->nama_merk.' '.$dtproc2->nama_type.' '.$dtproc2->clock.' '.$dtproc2->hertz.", ";
					}
				}

			$id_memory = $qcpu->row()->id_memory;
			$him = substr_count($id_memory, ",");
			$tim = ($him) + 1;
			$exp_mem = explode(",",$id_memory);

				$i2 = "";
				$p2 = "";
				for($i2=0; $i2<$tip; $i2++){
					//echo 'a';
					$arr_mem = $exp_mem[$i2];
					$qmem2 = $this->db->query("
						select a.*,b.nama_merk,c.nama_type,

							CASE
							WHEN a.byte = '1' THEN 'KB'
							WHEN a.byte = '2' THEN 'MB'
							WHEN a.byte = '3' THEN 'GB'
							WHEN a.byte = '4' THEN 'TB'
							END as byte1

						from tbl_memory a
						left join master_merk b 
						on a.merk = b.id
						left join master_type c 
						on a.`type` = c.id
						where a.id = '$arr_mem' and a.hapus IS NULL;
					");

					foreach($qmem2->result() as $dtmem2){
						$p2 .= $dtmem2->nama_merk.' '.$dtmem2->nama_type.' '.$dtmem2->kapasitas.' '.$dtmem2->byte1.", ";
					}
				}
			

			$id_hardisk = $qcpu->row()->id_hardisk;
			$hih = substr_count($id_hardisk, ",");
			$tih = ($hih) + 1;
			$exp_hdd = explode(",",$id_hardisk);

				$i3 = "";
				$p3 = "";
				for($i3=0; $i3<$tip; $i3++){
					//echo 'a';
					$arr_hdd = $exp_hdd[$i3];
					$qhdd2 = $this->db->query("
						select a.*,b.nama_merk,c.nama_type,

							CASE
							WHEN a.byte = '1' THEN 'KB'
							WHEN a.byte = '2' THEN 'MB'
							WHEN a.byte = '3' THEN 'GB'
							WHEN a.byte = '4' THEN 'TB'
							END as byte1

						from tbl_hardisk a
						left join master_merk b 
						on a.merk = b.id
						left join master_type c 
						on a.`type` = c.id
						where a.id = '$arr_hdd' and a.hapus IS NULL;
					");

					foreach($qhdd2->result() as $dthdd2){
						$p3 .= $dthdd2->nama_merk.' '.$dthdd2->nama_type.' '.$dthdd2->kapasitas.' '.$dthdd2->byte1.", ";

					}
				}

				$pc_name = trim($nama_pc, ", ");
				$proc_spec = trim($p1, ", ");
				$mem_spec = trim($p2, ", ");
				$hdd_spec = trim($p3, ", ");
				$div_name = trim($lok_pc, ", ");

$dtbc = 'Nama PC : '.$pc_name.'
Lokasi : '.$div_name.'';

				//echo '</br>';
			
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE

				$config['cacheable']	= true; //boolean, the default is true
				$config['cachedir']		= 'application/cache/'; //string, the default is application/cache/
				$config['errorlog']		= 'application/logs/'; //string, the default is application/logs/
				$config['imagedir']		= 'img/'; //direktori penyimpanan qr code
				$config['quality']		= true; //boolean, the default is true
				$config['size']			= '1024'; //interger, the default is 1024
				$config['black']		= array(224,255,255); // array, default is array(255,255,255)
				$config['white']		= array(70,130,180); // array, default is array(0,0,0)
				$config['overwrite'] = TRUE;
				$this->ciqrcode->initialize($config);
		
				$image_name=$nf_qrcode.'.png'; //buat name dari qr code sesuai dengan nim
		
				$params['data'] = $dtbc; //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
				$params['size'] = 10;
				$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
				$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$utmp = $this->db->query("
					update master_pc set qrcode = '$nf_qrcode' where id = '$id_pc'
				");

			}
	}
	
	function qr_all(){

		$qpc = $this->db->query("
			select a.*, a.uid, a.id as id_pc, b.*, c.nama_bagian
			from master_pc a
			left join master_cpu b
			on a.id_cpu = b.id
			left join tbl_bagian c 
			on a.id_bagian = c.kd
			where a.hapus is null;
		");

		$no = 1;
		foreach($qpc->result() as $dpc){

			$lok_pc = $dpc->nama_bagian;
			$id_pc = $dpc->id_pc;
			$id_cpu = $dpc->id_cpu;
			$nama_pc = $dpc->nama_pc;
			$nf_qrcode = $dpc->uid;
				
			$qcpu = $this->db->query("
				select * from master_cpu where id = '$id_cpu' and hapus is null
			");

			$id_processor = $qcpu->row()->id_processor;
			$hip = substr_count($id_processor, ",");
			$tip = ($hip) + 1;
			$exp_proc = explode(",",$id_processor);

				$i = "";
				$p1 = "";
				for($i=0; $i<$tip; $i++){
					//echo 'a';
					$arr_proc = $exp_proc[$i];
					$qproc2 = $this->db->query("
						select a.*,b.nama_merk,c.nama_type 
						from tbl_processor a
						left join master_merk b 
						on a.merk = b.id
						left join master_type c 
						on a.`type` = c.id
						where a.id = '$arr_proc' and a.hapus IS NULL;
					");

					$dt_proc = "";
					foreach($qproc2->result() as $dtproc2){
						$p1 .= $dtproc2->nama_merk.' '.$dtproc2->nama_type.' '.$dtproc2->clock.' '.$dtproc2->hertz.", ";
					}
				}

			$id_memory = $qcpu->row()->id_memory;
			$him = substr_count($id_memory, ",");
			$tim = ($him) + 1;
			$exp_mem = explode(",",$id_memory);

				$i2 = "";
				$p2 = "";
				for($i2=0; $i2<$tip; $i2++){
					//echo 'a';
					$arr_mem = $exp_mem[$i2];
					$qmem2 = $this->db->query("
						select a.*,b.nama_merk,c.nama_type,

							CASE
							WHEN a.byte = '1' THEN 'KB'
							WHEN a.byte = '2' THEN 'MB'
							WHEN a.byte = '3' THEN 'GB'
							WHEN a.byte = '4' THEN 'TB'
							END as byte1

						from tbl_memory a
						left join master_merk b 
						on a.merk = b.id
						left join master_type c 
						on a.`type` = c.id
						where a.id = '$arr_mem' and a.hapus IS NULL;
					");

					foreach($qmem2->result() as $dtmem2){
						$p2 .= $dtmem2->nama_merk.' '.$dtmem2->nama_type.' '.$dtmem2->kapasitas.' '.$dtmem2->byte1.", ";
					}
				}
			

			$id_hardisk = $qcpu->row()->id_hardisk;
			$hih = substr_count($id_hardisk, ",");
			$tih = ($hih) + 1;
			$exp_hdd = explode(",",$id_hardisk);

				$i3 = "";
				$p3 = "";
				for($i3=0; $i3<$tip; $i3++){
					//echo 'a';
					$arr_hdd = $exp_hdd[$i3];
					$qhdd2 = $this->db->query("
						select a.*,b.nama_merk,c.nama_type,

							CASE
							WHEN a.byte = '1' THEN 'KB'
							WHEN a.byte = '2' THEN 'MB'
							WHEN a.byte = '3' THEN 'GB'
							WHEN a.byte = '4' THEN 'TB'
							END as byte1

						from tbl_hardisk a
						left join master_merk b 
						on a.merk = b.id
						left join master_type c 
						on a.`type` = c.id
						where a.id = '$arr_hdd' and a.hapus IS NULL;
					");

					foreach($qhdd2->result() as $dthdd2){
						$p3 .= $dthdd2->nama_merk.' '.$dthdd2->nama_type.' '.$dthdd2->kapasitas.' '.$dthdd2->byte1.", ";

					}
				}

				$pc_name = trim($nama_pc, ", ");
				$proc_spec = trim($p1, ", ");
				$mem_spec = trim($p2, ", ");
				$hdd_spec = trim($p3, ", ");
				$div_name = trim($lok_pc, ", ");

$dtbc = 'Nama PC : '.$pc_name.'
Lokasi : '.$div_name.'';

				//echo '</br>';
			
			$this->load->library('ciqrcode'); //pemanggilan library QR CODE

			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './img/'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$config['overwrite'] = TRUE;
			$this->ciqrcode->initialize($config);
	
			$image_name=$nf_qrcode.'.png'; //buat name dari qr code sesuai dengan nim
	
			$params['data'] = $dtbc; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$utmp = $this->db->query("
				update master_pc set qrcode = '$nf_qrcode' where id = '$id_pc'
			");

		}

		//redirect("C_qrcode/index");
	}

} //tutup controller

?>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>  

<style>
.mt {
    margin-top:10px;
}
</style>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">PC List</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-8">
                <button class="btn btn-success" data-toggle="modal" data-target="#merk_modal"><i class="fa fa-plus"></i> Tambah PC</button>
            </div>
            <div class="col-lg-4" style="text-align:right;">
                <div class="row">
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="cari" id="cari">
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success" id="click_cari"><i class="fa fa-eye"></i> Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <!--button class="btn btn-success" data-toggle="modal" data-target="#merk_modal"><i class="fa fa-plus"></i> Tambah PC</button-->
        <br>
        
        <?php 
            error_reporting(0);
            echo $error;

            $tp = $_GET['tp'];
            $cari = $_GET['cari'];

            $qpc1 = $this->db->query("
                select a.*, a.uid, a.id as id_pc, b.*, c.bagian, z.nama_bagian as bagian_by_user, c.nama as nm_user, y.user_pc
                
                from master_pc a
                left join master_cpu b on a.id_cpu = b.id
                left join tbl_user c on a.id_user = c.id
                left join tbl_bagian z on c.bagian = z.kd
                left join user_pc y on a.id_user_pc = y.id
                
                where a.hapus is null;

            ");

            if($cari == ""){
                
                $total_rec = $qpc1->num_rows();
                $paging = ceil($total_rec/10);

                if($tp == 0 || $tp == ""){
                    $tp = 1;
                }

                $tsr = ($tp*10)-10;
                $tsr2 = ($tp*10)-9;

                $qpc = $this->db->query("
                    select a.*, a.uid, a.id as id_pc, b.*, c.bagian, z.nama_bagian as bagian_by_user, c.nama as nm_user, y.user_pc
                    
                    from master_pc a

                    left join master_cpu b on a.id_cpu = b.id
                    left join tbl_user c on a.id_user = c.id
                    left join tbl_bagian z on c.bagian = z.kd
                    left join user_pc y on a.id_user_pc = y.id
                    
                    where a.hapus is null

                    ORDER BY a.nama_pc ASC LIMIT 10 OFFSET $tsr;

                ");

            }else{

                $qpc = $this->db->query("
                    select a.*, a.uid, a.id as id_pc, b.*, c.bagian, z.nama_bagian as bagian_by_user, c.nama as nm_user, y.user_pc
                
                    from master_pc a
                    
                    left join master_cpu b on a.id_cpu = b.id
                    left join tbl_user c on a.id_user = c.id
                    left join tbl_bagian z on c.bagian = z.kd
                    left join user_pc y on a.id_user_pc = y.id
                    
                    where a.hapus is null
                    AND a.nama_pc LIKE '%$cari%' OR z.nama_bagian LIKE '%$cari%' OR y.user_pc LIKE '%$cari%' OR c.nama LIKE '%$cari%'

                    ORDER BY a.nama_pc ASC;
                ");

                $total_rec = $qpc->num_rows();
                $paging = ceil($total_rec/10);
                
            }
        ?>

<span>Show 10 From <?php echo $total_rec;?></span>

            <div class="table-responsive">

                <table class="table table" id="tbl_merk">
                    <thead>
                        <tr>
                            <th style="text-align:center;">No</th>
                            <th style="text-align:center;">Nama PC</th>
                            <th id="th_cpu" data-container="body" data-timeout="2000" data-toggle="popover" data-placement="top" data-content="Merah = Processor, Biru = Memory, Hijau = Hardisk" style="text-align:center;">CPU</th>
                            <th style="text-align:center;">Mouse</th>
                            <th style="text-align:center;">Keyboard</th>
                            <th style="text-align:center;">Monitor</th>
                            <th style="text-align:center;">Printer</th>
                            <th style="text-align:center;">Lokasi</th>
                            <th style="text-align:center;">Admin</th>
                            <th style="text-align:center;">User PC</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php 

                            if($total_rec < 1){
                                echo '
                                <tr>
                                    <td colspan="5">No Data !</td>
                                </tr>
                            ';
                            }else{

                                $no = $tsr2;
                                foreach($qpc->result() as $dpc){
                                    $id = $dpc->id_pc;
                                    echo '
                                        <tr>
                                            <td style="text-align:center;">'.$no.'</td>
                                            <td style="text-align:center;">'.$dpc->nama_pc.'</td>
                                        ';
                                        
                                        $id_cpu = $dpc->id_cpu;
                                        
                                        $qcpu = $this->db->query("
                                            select * from master_cpu where id = '$id_cpu' and hapus is null
                                        ");

                                        $id_processor = $qcpu->row()->id_processor;
                                        $hip = substr_count($id_processor, ",");
                                        $tip = ($hip) + 1;
                                        $exp_proc = explode(",",$id_processor);

                                        echo '
                                            <td style="text-align:center;">
                                        ';

                                        //$i = 0;
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
                                            //$dt_proc = "";
                                            foreach($qproc2->result() as $dtproc2){
                                                echo '
                                                    <p style="color:red;">'.$dtproc2->nama_merk.' '.$dtproc2->nama_type.' '.$dtproc2->clock.' '.$dtproc2->hertz.'</p>
                                                ';
                                            }

                                        }

                                        $id_memory = $qcpu->row()->id_memory;
                                        $him = substr_count($id_memory, ",");
                                        $him;
                                        $tim = ($him) + 1;
                                        $exp_mem = explode(",",$id_memory);

                                        //$i2 = 0;
                                        for($i2=0; $i2<$tim; $i2++){
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
                                            //$dt_proc = "";
                                            foreach($qmem2->result() as $dtmem2){
                                                echo '
                                                    <p style="color:blue;">'.$dtmem2->nama_merk.' '.$dtmem2->nama_type.' '.$dtmem2->kapasitas.' '.$dtmem2->byte1.'</p>
                                                ';
                                            }

                                        }

                                        $id_hardisk = $qcpu->row()->id_hardisk;
                                        $hih = substr_count($id_hardisk, ",");
                                        $tih = ($hih) + 1;
                                        $exp_hdd = explode(",",$id_hardisk);

                                        //$i3 = 0;
                                        for($i3=0; $i3<$tih; $i3++){
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
                                            //$dt_proc = "";
                                            foreach($qhdd2->result() as $dthdd2){
                                                echo '
                                                    <p style="color:green;">'.$dthdd2->nama_merk.' '.$dthdd2->nama_type.' '.$dthdd2->kapasitas.' '.$dthdd2->byte1.'</p>
                                                ';
                                            }

                                        }


                                        echo '
                                            </td>
                                        ';    

                                        echo '    
                                            <td style="text-align:center;">
                                            ';

                                        $id_mouse = $dpc->id_mouse;
                                        $himo = substr_count($id_mouse, ",");
                                        $timo = ($himo) + 1;
                                        $exp_mouse = explode(",",$id_mouse);

                                        //$i4 = 0;
                                        for($i4=0; $i4<$timo; $i4++){
                                            //echo 'a';
                                            $arr_mouse = $exp_mouse[$i4];
                                            $qmouse2 = $this->db->query("
                                                select a.*, b.nama_merk,c.nama_type from tbl_mouse a 
                                                left join master_merk b 
                                                on a.merk = b.id
                                                left join master_type c 
                                                on a.`type` = c.id
                                                where a.id = '$arr_mouse' and a.hapus IS NULL;
                                            ");
                                            //$dt_proc = "";
                                            foreach($qmouse2->result() as $dtmouse){
                                                echo '
                                                    <p>'.$dtmouse->nama_merk.' '.$dtmouse->nama_type.'</p>
                                                ';
                                            }

                                        }
                                        echo'    
                                            </td>
                                            ';

                                        echo '
                                            <td style="text-align:center;">
                                        ';

                                        $id_keyboard = $dpc->id_keyboard;
                                        $hikey = substr_count($id_keyboard, ",");
                                        $tikey = ($hikey) + 1;
                                        $exp_keyboard = explode(",",$id_keyboard);

                                        //$i5 = 0;
                                        for($i5=0; $i5<$tikey; $i5++){
                                            //echo 'a';
                                            $arr_keyboard = $exp_keyboard[$i5];
                                            $qkeyboard2 = $this->db->query("
                                                select a.*, b.nama_merk,c.nama_type 
                                                from tbl_keyboard a 
                                                left join master_merk b 
                                                on a.merk = b.id
                                                left join master_type c 
                                                on a.`type` = c.id
                                                where a.id = '$arr_keyboard' and a.hapus IS NULL;
                                            ");
                                            //$dt_proc = "";
                                            foreach($qkeyboard2->result() as $dtkeyboard){
                                                echo '
                                                    <p>'.$dtkeyboard->nama_merk.' '.$dtkeyboard->nama_type.'</p>
                                                ';
                                            }

                                        }
                                        echo'    
                                            </td>
                                        ';

                                        echo '
                                            <td style="text-align:center;">
                                        ';

                                    $id_monitor = $dpc->id_monitor;
                                    $himon = substr_count($id_monitor, ",");
                                    $timon = ($himon) + 1;
                                    $exp_monitor = explode(",",$id_monitor);

                                    //$i6 = 0;
                                    for($i6=0; $i6<$timon; $i6++){
                                        //echo 'a';
                                        $arr_monitor = $exp_monitor[$i6];
                                        $qmonitor2 = $this->db->query("
                                            select a.*, b.nama_merk,c.nama_type 
                                            from tbl_monitor a 
                                            left join master_merk b 
                                            on a.merk = b.id
                                            left join master_type c 
                                            on a.`type` = c.id
                                            where a.id = '$arr_monitor' and a.hapus IS NULL;
                                        ");
                                        //$dt_proc = "";
                                        foreach($qmonitor2->result() as $dtmonitor){
                                            echo '
                                                <p>'.$dtmonitor->nama_merk.' '.$dtmonitor->nama_type.' `'.$dtmonitor->inches.'</p>
                                            ';
                                        }

                                    }
                                        echo'    
                                            </td>
                                        ';
                                        echo '
                                            <td style="text-align:center;">
                                        ';
                                    $id_printer = $dpc->id_printer;
                                    $hiprint = substr_count($id_printer, ",");
                                    $tiprint = ($hiprint) + 1;
                                    $exp_printer = explode(",",$id_printer);

                                    //$i7 = 0;
                                    for($i7=0; $i7<$tiprint; $i7++){
                                        //echo 'a';
                                        $arr_printer = $exp_printer[$i7];
                                        $qprinter2 = $this->db->query("
                                            select a.*, b.nama_merk,c.nama_type 
                                            from tbl_printer a 
                                            left join master_merk b 
                                            on a.merk = b.id
                                            left join master_type c 
                                            on a.`type` = c.id
                                            where a.id = '$arr_printer' and a.hapus IS NULL;
                                        ");
                                        //$dt_proc = "";
                                        foreach($qprinter2->result() as $dtprinter){
                                            echo '
                                                <p>'.$dtprinter->nama_merk.' '.$dtprinter->nama_type.'</p>
                                            ';
                                        }

                                    }
                                        echo'    
                                            </td>
                                        ';


                                        echo '
                                            <td style="text-align:center;">
                                            '.$dpc->bagian_by_user.'
                                            </td>

                                            <td>
                                                '.$dpc->nm_user.'
                                            </td>

                                            <td>
                                                '.$dpc->user_pc.'
                                            </td>

                                            <td style="text-align:center;">
                                                <!--a href="'.base_url().'index.php/C_pc/del_pc/'.$id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a-->
                                                <a href="'.base_url().'index.php/C_pc/edit_page/'.$id.'" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Edit</a>
                                            </td>
                                        </tr>
                                    ';
                                    
                                    $no ++;
                                }

                            }
                        ?>

                    </tbody>
                </table>


            </div>

        

        <!-- navigation paging -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">

                <?php 
                    $no=1;
                    for($i=1;$i<=$paging;$i++){
                        if($i == 1){
                            $cnv = "First";
                        }elseif($i == $paging){
                            $cnv = "Last";
                        }else{
                            $cnv = $i;
                        }
                        echo '<li class="page-item"><a href="?tp='.$i.'" class="page-link">'.$cnv.'</a></li>';

                        $no++;
                    }
                ?>
                
            </ul>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="merk_modal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New PC</h4>
                </div>

                <form action="<?php echo base_url();?>index.php/C_pc/add_pc" method="post">
                
                    <div class="modal-body">

                        <div class="panel panel-default">
                            <div class="panel-body">
                            Nama PC :
                            <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="nm_pc" id="nm_pc" class="form-control" placeholder="Nama PC" required>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
                                CPU : 
                                <select name="cpu" id="cpu" class="form-control" required>
                                <?php 
                                    $qcpu = $this->db->query("
                                        select a.id, a.id_processor, a.id_memory, a.id_hardisk
                                        from master_cpu a where a.hapus IS NULL and used = 0;
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih CPU</option>
                                    ';

                                    foreach($qcpu->result() as $dproc){
                                        
                                        $z = $dproc->id;

                                        $qcpu2 = $this->db->query("
                                            select * from master_cpu where id = '$z'
                                        ");

                                        $id_proc2 = $qcpu2->row()->id_processor;
                                        $id_mem2 = $qcpu2->row()->id_memory;
                                        $id_hdd2 = $qcpu2->row()->id_hardisk;

                                        $hip2 = substr_count($id_proc2, ",");
                                        $tip2 = ($hip2) + 1;
                                        $exp_proc2 = explode(",",$id_proc2);

                                        echo '<option value = "'.$z.'">';
                                        echo 'PPROCESSOR :';

                                        $z1 = 0;
                                        for($z1=0;$z1<$tip2;$z1++){
                                            //echo 'a';
                                            
                                            $arr_proc2 = $exp_proc2[$z1];
                                            
                                            $qproc3 = $this->db->query("
                                                select a.*, b.nama_merk, c.nama_type
                                                from tbl_processor a 
                                                left join master_merk b on a.merk = b.id
                                                left join master_type c on a.`type` = c.id
                                                where a.id = '$arr_proc2' and a.hapus is null;
                                            ");
                                            
                                            $z2 = "";
                                            foreach($qproc3->result() as $dtproc3){
                                                
                                                echo $z2 .= $dtproc3->nama_merk.' '.$dtproc3->nama_type.' '.$dtproc3->clock.' '.$dtproc3->hertz.', </br>';
                                                
                                            }

                                            
                                            
                                        }

                                        $him2 = substr_count($id_mem2, ",");
                                        $tim2 = ($him2) + 1;
                                        $exp_mem2 = explode(",",$id_mem2);
                                        echo "RAM : ";
                                        for($z3=0;$z3<$tim2;$z3++){
                                            //echo 'a';
                                            $arr_idmem = $exp_mem2[$z3];
                                            $qmem3 = $this->db->query("
                                                select a.*, b.nama_merk, c.nama_type,
                                                CASE
                                                WHEN a.byte = 1 THEN 'KB'
                                                WHEN a.byte = 2 THEN 'MB'
                                                WHEN a.byte = 3 THEN 'GB'
                                                WHEN a.byte = 4 THEN 'TB'
                                                END as byte1
                                                from tbl_memory a 
                                                left join master_merk b on a.merk = b.id
                                                left join master_type c on a.`type` = c.id
                                                where a.id = '$arr_idmem' and a.hapus is null;
                                            ");

                                            foreach($qmem3->result() as $dtmem3){
                                                echo 
                                                $dtmem3->nama_merk." ".$dtmem3->nama_type." ".$dtmem3->kapasitas." ".$dtmem3->byte1.", ";
                                            }
                                        }

                                        $hih2 = substr_count($id_hdd2,",");
                                        $tih2 = ($hih2) + 1;
                                        $exp_hdd2 = explode(",",$id_hdd2);
                                        echo 'HDD : ';
                                        for($z4=0;$z4<$tih2;$z4++){
                                            $arr_idhdd = $exp_hdd2[$z4];
                                            $qhdd3 = $this->db->query("
                                                select a.*, b.nama_merk, c.nama_type,
                                                CASE
                                                WHEN a.byte = 1 THEN 'KB'
                                                WHEN a.byte = 2 THEN 'MB'
                                                WHEN a.byte = 3 THEN 'GB'
                                                WHEN a.byte = 4 THEN 'TB'
                                                END as byte1
                                                from tbl_hardisk a 
                                                left join master_merk b on a.merk = b.id
                                                left join master_type c on a.`type` = c.id
                                                where a.id = '$arr_idhdd' and a.hapus is null;
                                            ");

                                            foreach($qhdd3->result() as $dthdd3){
                                                echo 
                                                $dthdd3->nama_merk." ".$dthdd3->nama_type." ".$dthdd3->kapasitas." ".$dthdd3->byte1.", ";
                                            }
                                        }

                                        echo '</option>';


                                    }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body" id="div_mouse">
                            Mouse :
                            <button style="margin-left:40px;" class="btn btn-sm btn-success" id="add_mouse" type="button">
                                <i class="fa fa-plus"></i>
                            </button> 
                            <select name="mouse[]" id="mouse" class="form-control" required>
                                <?php 
                                    $qmerk = $this->db->query("
                                        select a.id, b.nama_merk, c.nama_type
                                        
                                        from tbl_mouse a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        
                                        where a.hapus is null;
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Mouse</option>
                                    ';
                                    $val_mouse = "";
                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.'</option>
                                        ';
                                        $val_mouse .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.'</option>';
                                    }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body" id="div_keyboard">
                            Keyboard : 
                            <button style="margin-left:22px;" class="btn btn-sm btn-success" id="add_keyboard" type="button">
                                <i class="fa fa-plus"></i>
                            </button> 
                            <select name="keyboard[]" id="keyboard" class="form-control" required>
                                <?php 
                                    $qmerk = $this->db->query("
                                        select a.id, b.nama_merk, c.nama_type
                                        
                                        from tbl_keyboard a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        
                                        where a.hapus is null;
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Keyboard</option>
                                    ';
                                    $val_keyboard = "";
                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.'</option>
                                        ';
                                        $val_keyboard .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.'</option>';
                                    }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body" id="div_monitor">
                            Monitor :
                            <button style="margin-left:34px;" class="btn btn-sm btn-success" id="add_monitor" type="button">
                                <i class="fa fa-plus"></i>
                            </button> 
                            <select name="monitor[]" id="monitor" class="form-control" required>
                                <?php 
                                    $qmerk = $this->db->query("
                                        select a.id, b.nama_merk, c.nama_type, a.inches
                                        
                                        from tbl_monitor a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        
                                        where a.hapus is null;
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Monitor</option>
                                    ';
                                    $val_monitor = "";
                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.' `'.$dproc->inches.'</option>
                                        ';
                                        $val_monitor .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.' `'.$dproc->inches.'</option>';

                                    }
                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body" id="div_printer">
                            Printer :
                            <button style="margin-left:38px;" class="btn btn-sm btn-success" id="add_printer" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                            <select name="printer[]" id="printer" class="form-control" required>
                                <?php 
                                    $qmerk = $this->db->query("
                                        select a.id, b.nama_merk, c.nama_type
                                        
                                        from tbl_printer a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        
                                        where a.hapus is null;
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Printer</option>
                                    ';
                                    $val_printer = "";
                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.'</option>
                                        ';
                                        $val_printer .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.'</option>';
                                    }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
                            Lokasi : 
                            <select name="lok" id="lok" class="form-control" required>
                                <?php 
                                    $qmerk = $this->db->query("
                                        select * from tbl_bagian where hapus is null order by nama_bagian asc
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Lokasi</option>
                                    ';

                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->kd.'">'.$dproc->nama_bagian.'</option>
                                        ';
                                    }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body" id="sidu">
                            
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
                            User PC : 
                            <select name="user_pc" id="user_pc" class="form-control" required>
                                <option value="" disabled selected>Choose User</option>
                                <?php 
                                    $qup = $this->db->query("
                                        select * from user_pc;
                                    ");

                                    foreach($qup->result() as $dtup){
                                        echo '
                                            <option value="'.$dtup->id.'">'.$dtup->user_pc.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
            
            </div>
        </div>


    </div>

</div>

<!--input type="text" name="idcpu" id="idcpu" value="<?php //echo $cpu;?>"-->

<script>
$(document).ready(function() {
    //$('#tbl_merk').DataTable();
});
//======================= MOUSE
var div = document.getElementById('div_mouse');
function addMouse() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_mouse;?>';
    input.name = 'mouse[]';
    input.id = 'id_mouse';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removeMouse;
  
    div.appendChild(input);
    div.appendChild(button);
}

function removeMouse() {
  // remove this button and its input
  div.removeChild(this.previousElementSibling);
  div.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_mouse').addEventListener('click', addMouse);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_proc').addEventListener('click', removeProc);

//==================== MOUSE

//======================= KEYBOARD
var div2 = document.getElementById('div_keyboard');
function addKeyboard() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_keyboard;?>';
    input.name = 'keyboard[]';
    input.id = 'id_keyboard';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removeKeyboard;
  
    div2.appendChild(input);
    div2.appendChild(button);
}

function removeKeyboard() {
  // remove this button and its input
  div2.removeChild(this.previousElementSibling);
  div2.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_keyboard').addEventListener('click', addKeyboard);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_proc').addEventListener('click', removeProc);

//==================== KEYBOARD

//======================= MONITOR
var div3 = document.getElementById('div_monitor');
function addMonitor() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_monitor;?>';
    input.name = 'monitor[]';
    input.id = 'id_monitor';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removeMonitor;
  
    div3.appendChild(input);
    div3.appendChild(button);
}

function removeMonitor() {
  // remove this button and its input
  div3.removeChild(this.previousElementSibling);
  div3.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_monitor').addEventListener('click', addMonitor);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_proc').addEventListener('click', removeProc);

//==================== MONITOR

//======================= PRINTER
var div4 = document.getElementById('div_printer');
function addPrinter() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_printer;?>';
    input.name = 'printer[]';
    input.id = 'id_printer';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removePrinter;
  
    div4.appendChild(input);
    div4.appendChild(button);
}

function removePrinter() {
  // remove this button and its input
  div4.removeChild(this.previousElementSibling);
  div4.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_printer').addEventListener('click', addPrinter);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_proc').addEventListener('click', removeProc);

//==================== PRINTER
$('#th_cpu').popover().hover(function () {
    setTimeout(function () {
        $('#th_cpu').popover('hide');
    }, 5000);
});  

$("#lok").change(function(){
    var id_bagian = $(this).val();

    $.ajax({  
    url: "<?php echo base_url(); ?>" + "index.php/C_pc/data_user",
    method:"POST",
    data:{id_bagian:id_bagian},  
        success:function(resp){
            $("#sidu").html(resp);
        }
    })
})

$("#click_cari").click(function(){
    var cr = $('#cari').val(); 
    location = 'view_pc?cari='+cr+'';
})
</script>


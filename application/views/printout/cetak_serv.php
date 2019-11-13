<?php
 
 /*header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Laporan Permintaan Aplikasi / Update Aplikasi.xls ");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 */
 ?>

<html>
    <head>
        <title>Service Card</title>
    </head>
    <style>
        .page_break2 { page-break-after: always; text-align:center;}
    </style>
    <body>

    <?php 
        $qpc = $this->db->query("
            select a.*, a.uid, a.id as id_pc, b.*, c.nama_bagian
            from master_pc a
            left join master_cpu b
            on a.id_cpu = b.id
            left join tbl_bagian c 
            on a.id_bagian = c.kd
            where a.hapus is null
            and a.id IN($id_pc);
        ");

        foreach($qpc->result() as $dtpc){

            $id_cpu = $dtpc->id_cpu;
            $uid_pc = $dtpc->uid;
            $lokasi = $dtpc->nama_bagian;
            $nm_pc = $dtpc->nama_pc;
            $id_mpc = $dtpc->id_pc;
        
            $qcpu = $this->db->query("
                select * from master_cpu where id = '$id_cpu' and hapus is null
            ");
        
            if($qcpu->num_rows() < 1){

                echo 'No Data';
                
            }else{
        
                $id_processor = $qcpu->row()->id_processor;
                $hip = substr_count($id_processor, ",");
                $tip = ($hip) + 1;
                $exp_proc = explode(",",$id_processor);
            
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
                    $det_proc = "";
                    $det_mem = "";
                    $det_hdd = "";
        
                    $det_mouse = "";
                    $det_keyboard = "";
                    $det_monitor = "";
                    $det_printer = "";
                    foreach($qproc2->result() as $dtproc2){
                        $det_proc .= $dtproc2->nama_merk.' '.$dtproc2->nama_type.' '.$dtproc2->clock.' '.$dtproc2->hertz.", ";
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
                        $det_mem .= $dtmem2->nama_merk.' '.$dtmem2->nama_type.' '.$dtmem2->kapasitas.' '.$dtmem2->byte1.", ";
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
                        $det_hdd .= $dthdd2->nama_merk.' '.$dthdd2->nama_type.' '.$dthdd2->kapasitas.' '.$dthdd2->byte1.", ";
                    }
        
                }
        
                $id_mouse = $dtpc->id_mouse;
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
                        $det_mouse .= $dtmouse->nama_merk.' '.$dtmouse->nama_type.", ";
                    }
        
                }
        
                $id_keyboard = $dtpc->id_keyboard;
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
                        $det_keyboard .= $dtkeyboard->nama_merk.' '.$dtkeyboard->nama_type.", ";
                    }
        
                }
        
                $id_monitor = $dtpc->id_monitor;
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
                        $det_monitor .= $dtmonitor->nama_merk.' '.$dtmonitor->nama_type.' `'.$dtmonitor->inches.", ";
                    }
        
                }
        
                $id_printer = $dtpc->id_printer;
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
                        $det_printer .= $dtprinter->nama_merk.' '.$dtprinter->nama_type.", ";
                    }
        
                }
        
            }
            
            ?>

        <div class="page_break2">
        
            <table border=1 style="text-align:center;">
                <tr>
                    <th colspan="8"><?php echo $nm_pc;?></th>
                </tr>
                <tr>
                    <th colspan="8" style="height:100px;"><img style="width:20%;height:100%;" src="img/<?php echo $uid_pc;?>.png" alt="No Image"></th>
                </tr>
                <tr>
                    <th>ID PC</th>
                    <th><?php echo $uid_pc;?></th>
                    <th>Processor</th>
                    <th><?php echo $k1 = trim($det_proc, ", ");?></th>
                    <th>Hardisk</th>
                    <th><?php echo $k3 = trim($det_hdd, ", ");?></th>
                    <th>KB/Mouse</th>
                    <th><?php echo $k4 = trim($det_keyboard,", "); echo ' / '; echo $k5 = trim($det_mouse,", ");?></th>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <th><?php echo $lokasi;?></th>
                    <th>Memory</th>
                    <th><?php echo $k2 = trim($det_mem, ", ");?></th>
                    <th>Monitor</th>
                    <th><?php echo $k6 = trim($det_monitor, ", ");?></th>
                    <th>Printer</th>
                    <th><?php echo $k7 = trim($det_printer,", ");?></th>
                </tr>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2" colspan="3">Tanggal</th>
                    <th rowspan="2" colspan="2">Keterangan</th>
                    <th colspan="2">Paraf</th>
                </tr>
                <tr>
                    <th>IT</th>
                    <th>User</th>
                </tr>
                <?php 
                    $myq1 = $this->db->query("
                        select a.*, b.keterangan from tbl_permintaan a
                        left join tbl_bukti b on a.id_bukti = b.id_bukti 
                        where a.id_pc = '$id_mpc' order by a.ditutup asc;
                    ");

                    $cr = $myq1->num_rows();
                    $n = 1;
                    foreach($myq1->result() as $dtq1){

                        echo '
                        <tr>
                            <td>'.$n.'</td>
                            <td colspan="3">'.date('d M Y H:i:s', strtotime($dtq1->ditutup)).'</td>
                            <td colspan="2">'.$dtq1->keterangan.'</td>
                            <td></td>
                            <td></td>
                        </tr>
                        ';
                        $n++;
                    }

                    $ttr = 20;
                    $ttru = ($ttr-$cr);

                    for($khv = 1+$cr; $khv<=$ttru; $khv++){
                        echo '
                        <tr>
                            <td>'.$khv.'</td>
                            <td colspan="3"></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        ';
                    }
                ?>
            </table>

        </div>
        



<?php
    }
?>
    </body>
</html>
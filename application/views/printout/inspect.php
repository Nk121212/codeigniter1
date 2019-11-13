<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <style>
        .page_break2 { page-break-after: always; text-align:center;}
    </style>
<body>
    <?php 
        foreach($data_pc->result() as $dtpc){

            $printer = $dtpc->id_printer;
            $keyboard = $dtpc->id_keyboard;
            $mouse = $dtpc->id_mouse;

            $qcpu = $this->db->query("
                select * from master_cpu where id = $dtpc->id_cpu;
            ");

            $processor = $qcpu->row()->id_processor;
            $hdd = $qcpu->row()->id_hardisk;

            $qgp = $this->db->query("
                select a.*, b.nama_merk, c.nama_type from tbl_processor a 
                left join master_merk b on a.merk = b.id
                left join master_type c on a.`type` = c.id
                where a.id IN($processor);
            ");

            $mproc = "";
            foreach($qgp->result() as $dtproc){
                $mproc .= $dtproc->nama_merk." ".$dtproc->nama_type.", ";
            }

            $proc1 = trim($mproc,", ");


            $qgh = $this->db->query("
                select a.*, b.nama_merk, c.nama_type,
                CASE 
                    WHEN a.byte = '1' THEN 'KB'
                    WHEN a.byte = '2' THEN 'MB'
                    WHEN a.byte = '3' THEN 'GB'
                    WHEN a.byte = '4' THEN 'TB'
                END as byte1
                from tbl_hardisk a 
                left join master_merk b on a.merk = b.id
                left join master_type c on a.`type` = c.id
                where a.id IN($hdd);
            ");

            $hddnya = "";
            foreach($qgh->result() as $dth){
                $hddnya .= $dth->nama_merk." ".$dth->nama_type." ".$dth->kapasitas." ".$dth->byte1.", ";
            }

            $hdd1 = trim($hddnya,", ");

            $qprint = $this->db->query("
                select a.*, b.nama_merk, c.nama_type from tbl_printer a
                left join master_merk b on a.merk = b.id
                left join master_type c on a.`type` = c.id
                where a.id IN($printer)
            ");

            $printernya = "";

            foreach($qprint->result() as $dtp){
                $printernya .= $dtp->nama_merk." ".$dtp->nama_type.", ";
            }

            $print1 = trim($printernya,", ");

            $qkey = $this->db->query("
                select a.*, b.nama_merk, c.nama_type from tbl_keyboard a
                left join master_merk b on a.merk = b.id
                left join master_type c on a.`type` = c.id
                where a.id IN($keyboard)
            ");

            $keyboardnya = "";
            foreach($qkey->result() as $dtk){
                $keyboardnya .= $dtk->nama_merk." ".$dtk->nama_type.", ";
            }

            $keyboard1 = trim($keyboardnya,", ");

            $qmouse = $this->db->query("
                select a.*, b.nama_merk, c.nama_type from tbl_mouse a
                left join master_merk b on a.merk = b.id
                left join master_type c on a.`type` = c.id
                where a.id IN($mouse)
            ");

            $mousenya = "";
            foreach($qmouse->result() as $dtm){
                $mousenya .= $dtm->nama_merk." ".$dtm->nama_type.", ";
            }

            $mouse1 = trim($mousenya,", ");
            

            echo '
            <div class="page_break2">
                <table style="width:100%;text-align:center;" border="2">
                    <tr>
                        <th colspan="8" style="text-align:center;">'.$dtpc->nama_pc.'</th>
                    </tr>
                    <tr>
                        <th colspan="8" style="text-align:center;">
                            <img style="width:140px;height:140px;" src="img/'.$dtpc->qrcode.'.png">
                        </th>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>'.$dtpc->nama_bagian.'</td>
                        <td>User</td>
                        <td>'.$dtpc->pengguna.'</td>
                        <td>Tgl Inspeksi</td>
                        <td></td>
                        <td>Ttd</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td colspan="4" rowspan="2">Item Pengecekan</td>
                        <td colspan="3">Status</td>
                    </tr>
                    <tr>
                        <td>Ok</td>
                        <td>Tidak</td>
                        <td>Keterangan</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Processor</td>
                        <td colspan="3">'.$proc1.'</td>
                        <td></td>
                        <td></td>
                        <td style="height:50px;"></td>
                    </tr>
                    
                    <tr>
                        <td>2</td>
                        <td>Hardisk</td>
                        <td colspan="3">'.$hdd1.'</td>
                        <td></td>
                        <td></td>
                        <td style="height:80px;"></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Printer</td>
                        <td colspan="3">'.$print1.'</td>
                        <td></td>
                        <td></td>
                        <td style="height:80px;"></td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>KB / Mouse</td>
                        <td colspan="3">'.$keyboard1.' / '.$mouse1.'</td>
                        <td></td>
                        <td></td>
                        <td style="height:80px;"></td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>Software</td>
                        <td colspan="3">Pengecekan Aplikasi</td>
                        <td></td>
                        <td></td>
                        <td style="height:80px;"></td>
                    </tr>

                </table>
            </div>
            ';
        }
    ?>
    
</body>
</html>
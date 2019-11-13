<?php 
    //echo $awal;
    //echo ' '.$akhir;
    $mulai = date("d M Y", strtotime($awal));
    $selesai = date("d M Y", strtotime($akhir));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penggantian Komponen</title>

</head>
<body>

    <div style="text-align:center;">
        <h3>Laporan Penggantian Komponen PC</h3>
        <h3><?php echo $mulai." - ".$selesai?></h3>
    </div>
    <br>

    <table style="text-align:center;width:100%;" border="1"> 
        <tr>
            <th>No</th>
            <th>Diganti</th>
            <th>Nama PC</th>
            <th>Komponen</th>
            <th>Komponen Diganti</th>
            <th>Komponen Pengganti</th>
            <th>Teknisi</th>
        </tr>
        <?php 

            $query = $this->db->query("
                select a.id_permintaan, a.id_pc, b.nama_pc, c.nama as jenis_komponen, a.id_komponen as komponen_diganti, a.id_komponen_baru as komponen_pengganti, a.add_by, a.log, f.nama as teknisi, d.ditutup
                from tbl_service a
                left join master_pc b on a.id_pc = b.id
                left join mu_kat_parameter c on a.komponen = c.ref_kat
                left join tbl_permintaan d on a.id_permintaan = d.id_permintaan
                left join tbl_bukti e on d.id_bukti = e.id_bukti
                left join tbl_user f on e.id_teknisi = f.id
                where a.log between '$awal' and '$akhir' order by a.log asc;
                ;
            ");

            if($query->num_rows() < 1){
                echo '<tr><td style="text-align:center;" colspan="6"><h3>No Data</h3></td></tr>';
            }else{
                $no = 1;
                foreach($query->result() as $dtsk){
    
                    $id_permintaan = $dtsk->id_permintaan;
                    $id_pc = $dtsk->id_pc;
                    $nama_pc = $dtsk->nama_pc;
                    $jenis_komponen = $dtsk->jenis_komponen;
                    $komponen_diganti = $dtsk->komponen_diganti;
                    $komponen_pengganti = $dtsk->komponen_pengganti;
    
                    if($jenis_komponen == 'Processor'){
                        //tbl_processor id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_processor';
                    }elseif($jenis_komponen == 'Memory'){
                        //tbl_Memory id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_memory';
                    }elseif($jenis_komponen == 'Hardisk'){
                        //tbl_Hardisk id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_hardisk';
                    }elseif($jenis_komponen == 'Keyboard'){
                        //tbl_Keyboard id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_keyboard';
                    }elseif($jenis_komponen == 'Mouse'){
                        //tbl_Mouse id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_mouse';
                    }elseif($jenis_komponen == 'Monitor'){
                        //tbl_Monitor id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_monitor';
                    }elseif($jenis_komponen == 'Printer'){
                        //tbl_Printer id -> $komponen_diganti -> $komponen_pengganti
                        $idk = 'tbl_printer';
                    }
    
                    $q2 = $this->db->query("
                        select a.*, b.nama_merk, c.nama_type 
                        from 
                        $idk a
                        left join master_merk b on a.merk = b.id
                        left join master_type c on a.`type` = c.id
                        where a.id = $komponen_diganti;
                    ");
    
                    $merk = $q2->row()->nama_merk;
                    $type = $q2->row()->nama_type;
    
                    $q3 = $this->db->query("
                        select a.*, b.nama_merk, c.nama_type 
                        from 
                        $idk a
                        left join master_merk b on a.merk = b.id
                        left join master_type c on a.`type` = c.id
                        where a.id = $komponen_pengganti;
                    ");
    
                    $merk2 = $q3->row()->nama_merk;
                    $type2 = $q3->row()->nama_type;
    
                    echo '
                        <tr style="text-align:center;">
                            <td>'.$no.'</td>
                            <td>'.date("d M Y H:i:s", strtotime($dtsk->ditutup)).'</td>
                            <td>'.$dtsk->nama_pc.'</td>
                            <td>'.$dtsk->jenis_komponen.'</td>
                            <td>'.$merk." ".$type.'</td>
                            <td>'.$merk2." ".$type2.'</td>
                            <td>'.$dtsk->teknisi.'</td>
                        </tr>
                    ';
    
                    $no++;
    
                }
            }
            

        ?>
    </table>
    
</body>
</html>
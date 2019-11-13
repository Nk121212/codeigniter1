<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
    
    <title>IT HELPDESK</title>
 
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/pc_memo.css" rel="stylesheet">

</head>

<body>
    <?php   
    $qm = $this->db->query("
        select a.id as id
        , a.uid
        , a1.nama_merk as proc_merk, a2.nama_type as proc_type, c.hertz, c.clock as clock
        , b1.nama_merk as memory_merk, b2.nama_type as type_memory, d.kapasitas as size_memory, 
        case 
            when d.byte = 1 then 'KB' 
            when d.byte = 2 then 'MB'
            when d.byte = 3 then 'GB'
            when d.byte = 4 then 'TB'
        end as mem_byte
        , c1.nama_merk as merk_hdd, c2.nama_type as type_hdd
        , e.kapasitas as size_hdd, 
        case 
            when e.byte = 1 then 'KB' 
            when e.byte = 2 then 'MB'
            when e.byte = 3 then 'GB'
            when e.byte = 4 then 'TB'
        end as hdd_byte
        , d1.nama_merk as merk_mouse, d2.nama_type as type_mouse	
        , e1.nama_merk as merk_keyboard, e2.nama_type as type_keyboard
        , f1.nama_merk as merk_monitor, f2.nama_type as type_monitor, h.inches as monitor_inches
        , g1.nama_merk as merk_printer, g2.nama_type as type_printer
        , j.nama_bagian

        from master_pc a

        left join master_cpu b on a.id_cpu = b.id
        left join tbl_processor c on b.id_processor = c.id
        left join tbl_memory d on b.id_memory = d.id
        left join tbl_hardisk e on b.id_hardisk = e.id  
        left join tbl_mouse f on a.id_mouse = f.id
        left join tbl_keyboard g on a.id_keyboard = g.id
        left join tbl_monitor h on a.id_monitor = h.id
        left join tbl_printer i on a.id_printer = i.id
        left join tbl_bagian j on a.id_bagian = j.kd

        left join master_merk a1 on c.merk = a1.id 
        left join master_type a2 on c.`type` = a2.id

        left join master_merk b1 on d.merk = b1.id
        left join master_type b2 on d.`type` = b2.id

        left join master_merk c1 on e.merk = c1.id
        left join master_type c2 on e.`type` = c2.id

        left join master_merk d1 on f.merk = d1.id
        left join master_type d2 on f.`type` = d2.id

        left join master_merk e1 on g.merk = e1.id
        left join master_type e2 on g.`type` = e2.id

        left join master_merk f1 on h.merk = f1.id
        left join master_type f2 on h.`type` = f2.id

        left join master_merk g1 on i.merk = g1.id
        left join master_type g2 on i.`type` = g2.id

        where a.hapus IS NULL and a.uid IN($uid);
    ");
        $total_rec = $qm->num_rows();
        $i = 1;

        echo '
        <style>
        tr {
            border: 1px solid #ddd;
            padding : 25px;
        }
        th {
            border: 1px solid #ddd;
            width: 60px;
        }
        td {
            border: 1px solid #ddd;
            height:250px;
        }
        table{
            text-align:center;
            font-size: 11px;
            border: 1px solid #ddd;
        }
        </style>
        ';

        foreach($qm->result() as $dt){
            echo '
            <div class="div_'.$i.'">
                <table>
                    <tr>
                        <th>ID-PC</th>
                        <th>Spesifikasi</th>
                        <th>Paraf IT</th>
                        <th>Paraf User</th>
                    </tr>
                    <tr>
                        <td>'.$dt->uid.'</td>
                        <td>
                        <span style="color:red;">PROCESSOR </span>: <br>'.$dt->proc_merk.' '.$dt->proc_type.' '.$dt->clock.' '.$dt->hertz.' <br>
                        <span style="color:green;">MEMORY </span>: <br>'.$dt->memory_merk.' '.$dt->type_memory.' '.$dt->size_memory.' '.$dt->mem_byte.' <br>
                        <span style="color:blue;">HARDISK </span>: <br>'.$dt->merk_hdd.' '.$dt->type_hdd.' '.$dt->size_hdd.' '.$dt->hdd_byte.' <br>
                        <span style="color:#7F55FF;">MOUSE </span>: <br>'.$dt->merk_mouse.' '.$dt->type_mouse.' <br>
                        <span style="color:#996666;">KEYBOARD </span>: <br>'.$dt->merk_keyboard.' '.$dt->type_keyboard.' <br>
                        <span style="color:#999900;">MONITOR </span>: <br>'.$dt->merk_monitor.' '.$dt->type_monitor.' `'.$dt->monitor_inches.' <br>
                        <span style="color:#336666;">PRINTER </span>: <br>'.$dt->merk_printer.' '.$dt->type_printer.' <br>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            ';
            $i ++;
        }
    ?>

</body>

</html>
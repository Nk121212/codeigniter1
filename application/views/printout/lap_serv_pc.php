<html>
    <head>
        <title>Laporan Service PC</title>
    </head>
    <body>

        <table border=0 style="width:100%;text-align:center;">
            <tr>
                <th>Laporan Service PC</th>
            </tr>
            <tr>
                <th><?php echo date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)); ?></th>
            </tr>
        </table>
        <br>

        <table border=1 style="font-size:12px;text-align:center;">
            <tr>
                <th>No</th>
                <th>Id Permintaan</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Perihal</th>
                <th>Detail</th>
                <th>Job Desc</th>
                <th>Bagian</th>
                <th>Nama PC</th>
                <th>User PC</th>
                <th>Teknisi</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>

            <?php 
                //echo $dari;
                $query = $this->db->query("
                    select 
                    a.id_permintaan, 
                    a.nama, 
                    a.emailaddress, 
                    a.perihal, 
                    a.detail, 
                    a.job_desc, 
                    b.nama_bagian, 
                    c.nama_pc, 
                    a.id_pc, 
                    d.keterangan, 
                    e.nama as teknisi, 
                    f.user_pc, 
                    CASE
                        WHEN a.statuz = '0' THEN 'Open' 
                        WHEN a.statuz = '1' THEN 'Close' 
                    END as statuz
                    
                    from tbl_permintaan a
                    left join tbl_bagian b on a.bagian = b.kd
                    left join master_pc c on a.id_pc = c.id
                    left join tbl_bukti d on a.id_bukti = d.id_bukti
                    left join tbl_user e on d.id_teknisi = e.id
                    left join user_pc f on c.id_user_pc = f.id
                    
                    where a.job_desc = 'Perbaikan CPU'
                    and a.dibuat between '$dari' and '$sampai' and a.statuz = $status;

                ");

                /*$query = $this->db->query("
                    select a.id_permintaan, a.nama, a.emailaddress, a.perihal, a.detail, a.job_desc, b.nama_bagian, c.nama_pc, a.id_pc
                    from tbl_permintaan a
                    left join tbl_bagian b on a.bagian = b.kd
                    left join master_pc c on a.id_pc = c.id
                    where a.job_desc = 'Perbaikan CPU'
                    and a.dibuat between '$dari' and '$sampai'
                    ;
                ");*/

                $no = 1;
                foreach($query->result() as $dtsp){

                    $idp = $dtsp->id_permintaan;

                    $cl = $this->db->query("
                        select a.keterangan from tbl_permintaan_log a where a.id_permintaan = '$idp' and a.pada = (select max(pada) as pada from tbl_permintaan_log where id_permintaan = '$idp');
                    ");

                    $kl = $cl->row()->keterangan;

                    echo '
                        <tr>
                            <td>'.$no.'</td>
                            <td>'.$dtsp->id_permintaan.'</td>
                            <td>'.$dtsp->nama.'</td>
                            <td>'.$dtsp->emailaddress.'</td>
                            <td>'.$dtsp->perihal.'</td>
                            <td>'.$dtsp->detail.'</td>
                            <td>'.$dtsp->job_desc.'</td>
                            <td>'.$dtsp->nama_bagian.'</td>
                            <td>'.$dtsp->nama_pc.'</td>
                            <td>'.$dtsp->user_pc.'</td>
                            <td>'.$dtsp->teknisi.'</td>
                            <td>'.$dtsp->statuz.'</td>
                            <td>'.$kl.'</td>
                        </tr>
                    ';

                    $no++;
                }

            ?>

        </table>
        
    </body>
</html>
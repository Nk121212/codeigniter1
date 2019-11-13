<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

    </head>

    <style>
        /*.page_break2 { page-break-after: always; text-align:center;}*/
    </style>

    <style>

        @page { margin: 100px 50px; }

        #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 150px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 150px;}
        #footer2 { position: fixed; left: 570px; bottom: -150px; right: 0px; height: 150px;}
        #footer .page:after { content: counter(page, decimal); }
     
   </style>

    <body>

    <div id="header">
        <h1>Laporan Stok Tersedia</h1>
    </div>
    <div id="footer">
        <p class="page">Page <?php $PAGE_NUM ?></p>
    </div>
    <div id="footer2">
        <p class="page"><?php echo date('d M Y');?></p>
    </div>
    
    <div id="content">

        <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="4">Processor</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query1 = $this->db->query("
                                SELECT a.clock, a.hertz, b.nama_merk, c.nama_type, a.stok 
                                FROM tbl_processor a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query1->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

            <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="5">Memory</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query2 = $this->db->query("
                                SELECT b.nama_merk, c.nama_type,
                                a.kapasitas,
                                CASE
                                    WHEN a.byte = '1' THEN 'KB'
                                    WHEN a.byte = '2' THEN 'MB'
                                    WHEN a.byte = '3' THEN 'GB'
                                    WHEN a.byte = '4' THEN 'TB'
                                END as byte,
                                a.stok 
                                FROM tbl_memory a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query2->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->kapasitas.' '.$dt1->byte.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

            <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="5">Hardisk</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query3 = $this->db->query("
                                SELECT b.nama_merk, c.nama_type,
                                a.kapasitas,
                                CASE
                                    WHEN a.byte = '1' THEN 'KB'
                                    WHEN a.byte = '2' THEN 'MB'
                                    WHEN a.byte = '3' THEN 'GB'
                                    WHEN a.byte = '4' THEN 'TB'
                                END as byte,
                                a.stok 
                                FROM tbl_hardisk a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query3->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->kapasitas.' '.$dt1->byte.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

            <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="4">Keyboard</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query4 = $this->db->query("
                                SELECT b.nama_merk, c.nama_type, a.stok FROM tbl_keyboard a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query4->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

            <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="4">Mouse</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query5 = $this->db->query("
                                SELECT b.nama_merk, c.nama_type, a.stok FROM tbl_mouse a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query5->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

            <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="5">Monitor</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Inc</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query6 = $this->db->query("
                                SELECT b.nama_merk, c.nama_type, a.inches, a.stok FROM tbl_monitor a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query6->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->inches.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

            <div class="page_break2">
                <table border = "1" style="width:100%;">
                    <thead>
                        <tr style="text-align:center;">
                            <th colspan="4">Printer</th>
                        </tr>
                        <tr style="text-align:center;"> 
                            <th>No</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query6 = $this->db->query("
                                SELECT b.nama_merk, c.nama_type, a.stok FROM tbl_printer a 
                                LEFT JOIN master_merk b
                                ON a.merk = b.id
                                LEFT JOIN master_type c ON a.type = c.id 
                                WHERE a.hapus IS NULL AND a.stok > 0;
                            ");
                            $no=1;
                            foreach($query6->result() as $dt1){
                                echo '
                                    <tr style="text-align:center;">
                                        <td>'.$no.'</td>
                                        <td>'.$dt1->nama_merk.'</td>
                                        <td>'.$dt1->nama_type.'</td>
                                        <td>'.$dt1->stok.'</td>
                                    </tr>
                                ';
                                $no++;
                            }
                        ?>
                    </tbody>            
                </table>
            </div>

        <!--p style="page-break-before: always;">the second page</p-->

    </div>
        
    </body>
</html>
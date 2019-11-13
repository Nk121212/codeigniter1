<html>
    <head>
        <title></title>
    </head>
    <style>
        /*.page_break2 { 
            page-break-after: always; text-align:center;
        }*/
    </style>
    <body>
        <?php 
        if($opt == 1){
            //echo 'buat semua';
            $query = $this->db->query("
                select * from master_pc where hapus is null order by id asc
            ");

            foreach($query->result() as $dtq){
                echo '
                    <img src="img/'.$dtq->uid.'.png" alt="noimage" height="100" width="100">
                ';
            }   

        }else{  
            //echo 'buat berdasarkan id';
            $imp_uid = implode(",",$uid);
            $query = $this->db->query("
                select * from master_pc where hapus is null and uid IN($imp_uid) order by id asc
            ");

            foreach($query->result() as $dtq){
                echo '
                    <div align="center">
                        <img src="img/'.$dtq->qrcode.'.png" alt="noimage" height="100" width="100">
                    </div>
                    ';
            }
        }
        ?>
    </body>
</html>
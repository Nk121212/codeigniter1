<html>
    <head>
        <title>Grafik Bulanan</title>
    </head>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



    <style>
        .center {text-align:center;}
        #print_this{
            width:100% !important;
            background-color:white;
        }
    </style>

    <body>

        <div class="col-lg-12" id="print_this">
            <h3 class="center">Grafik Perbaikan CPU</h3>
            <h3 class="center">
            <?php 
                echo date("M Y", strtotime($thn_dari.'-'.$bln_dari))." - ".date("M Y", strtotime($thn_sampai.'-'.$bln_sampai));
            ?>
            </h3>

            <?php 
            $query = $this->db->query("
                SELECT TIMESTAMPDIFF(MONTH, '$thn_dari-$bln_dari-01', TIMESTAMPADD(MONTH,1,'$thn_sampai-$bln_sampai-28')) as tfor;
            ");

            $tl = $query->row()->tfor;

            $zz = 0;
            for($i=intval($bln_dari); $i<$tl+intval($bln_dari); $i++){

                $tahun = intval($thn_dari);

                $q1 = $this->db->query("
                    SELECT COUNT(id) as total, month(dibuat) as bulan, year(dibuat) as tahun FROM tbl_permintaan Where Month(dibuat) = '$i' AND YEAR(dibuat) = '$tahun' and job_desc = 'Perbaikan CPU' 
                    group by YEAR(dibuat), MONTH(dibuat)
                    order by YEAR(dibuat) asc;
                ");



                if($q1->num_rows() < 1){
                    $ttl_val = 0;
                }else{
                    $ttl_val = $q1->row()->total;
                }     

                $arr[] = array();
                $arr[$zz] = $ttl_val;

                $arr2[] = array();
                $arr2[$zz] = date("M Y", strtotime($tahun.'-'.$i));

                $zz ++;
            }

            $jsttl = json_encode($arr);
            $jswkt = json_encode($arr2);
        ?>
        
        <div class="col-lg-12" id="print_this">
            <canvas id="myChart"></canvas>
        </div>

        </div>

        <br><br>

        <div class="col-lg-12" style="margin-top:25px;">
            <button class="btn btn-danger" id="pdf"><i class="fa fa-file-pdf-o"></i> Create PDF</button>
        </div>


    </body>

    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>sbadmin2/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>jspdf/html2canvas.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>jspdf/jspdf.debug.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/Chart.bundle.js"></script>

    <script>

    $("#pdf").click(function(){
        var doc = new jsPDF("p", "pt", "a4");
        doc.addHTML($('#print_this')[0], 15, 15, {
            pagesplit: false
        }, function() {
        doc.save("Graph_bulanan_<?php echo date("d M Y");?>.pdf");
        });
    })

    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: <?php echo $jswkt;?>,
            datasets: [{
                label: 'Perbaikan CPU',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(245, 245, 245)',
                data: <?php echo $jsttl;?>
            }]
        },

        // Configuration options go here
        options: {}
    });

    </script>

</html>
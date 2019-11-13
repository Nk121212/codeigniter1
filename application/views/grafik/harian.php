<html>
    <head>
        <title>Grafik Harian</title>
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
            <h3 class="center"><?php echo date('d M Y',strtotime($dari))." - ".date("d M Y",strtotime($sampai))?></h3>

            <?php 
                $hitung = $this->db->query("
                    select DATEDIFF(TIMESTAMPADD(SECOND,1,'$sampai'), '$dari') as total_hari;
                ");

                $tdays = $hitung->row()->total_hari;

                $from = date("Y-m-d",strtotime($dari));
                $to = date("Y-m-d",strtotime($sampai));

                $tgl = "";

                for ($i = 0; $i < $tdays; $i++) {
                    $qgd = $this->db->query("
                        select ('$from' + INTERVAL $i DAY) as tgl_data;
                    ");

                    $tgl2 = $qgd->row()->tgl_data;

                    $q1 = $this->db->query("
                        select count(a.id) as total_req from tbl_permintaan a where DATE(a.dibuat) = '$tgl2' and a.hapus is null and a.job_desc = 'Perbaikan CPU';
                    ");

                    $treq = $q1->row()->total_req;             

                    $arr[] = array();
                    $arr[$i] = $tgl2;

                    $arr2[] = array();
                    $arr2[$i] = $treq;

                }

                //header('Content-Type: application/json');
                $jtgl = json_encode($arr);
                $jtrph = json_encode($arr2);
            ?>

            <div class="col-lg-12">
                <canvas id="myChart"></canvas>
            </div>
            
        </div>

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
            labels: <?php echo $jtgl;?>,
            datasets: [{
                //label: '<?php echo date("d M Y", strtotime($dari))." - ".date("d M Y", strtotime($sampai));?>',
                label: 'Perbaikan CPU',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(245, 245, 245)',
                data: <?php echo $jtrph;?>
            }]
        },

        // Configuration options go here
        options: {}
    });

    </script>
    

</html>
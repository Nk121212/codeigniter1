<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Total Perbaikan Per PC</title>
</head>
<body>

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

            <h3 class="center">Grafik Total Perbaikan Per PC</h3>
            <h3 class="center"><?php echo date('d M Y',strtotime($awal))." - ".date("d M Y",strtotime($akhir))?></h3>

            <?php 

                $query = $this->db->query("
                    select a.id_pc from tbl_permintaan a where a.job_desc = 'Perbaikan CPU' AND a.dibuat BETWEEN '$awal' AND '$akhir' AND a.id_pc IS NOT NULL group by a.id_pc;
                ");

                $i = 0;
                foreach($query->result() as $dtr){

                    $idpc = $dtr->id_pc;

                    $q1 = $this->db->query("
                        select count(a.id_pc) as jumlah, b.nama_pc as nama_pc from tbl_permintaan a 
                        left join master_pc b on a.id_pc = b.id
                        where a.id_pc = '$idpc';
                    ");

                    $arr[] = array();
                    $arr[$i] = $q1->row()->jumlah;

                    $arr2[] = array();
                    $arr2[$i] = $q1->row()->nama_pc;

                    $i++;

                }
                
                $label = json_encode($arr);
                $nm_pc = json_encode($arr2);
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
            labels: <?php echo $nm_pc;?>,
            datasets: [{
                label: 'Total Perbaikan',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(245, 245, 245)',
                data: <?php echo $label;?>
            }]
        },

        // Configuration options go here
        options: {}
    });

    </script>
    

</html>


</body>
</html>
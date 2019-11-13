<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <link rel="stylesheet" href="<?php echo base_url();?>sbadmin2/vendor/bootstrap/css/bootstrap.css">

    <link href="<?php echo base_url(); ?>sbadmin2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        .kk{
            height:35px;
        }
        .tengah {
            text-align:center;
        }
        .italic {
            font-style : italic;
        }
        .alit {
            font-size: 14px;
        }
        #print_this{
            width:100% !important;
            background-color:white;
        }
    </style>

    <body>

    <!--div style="height:50%;width:50%;">
        <canvas id="tes"></canvas>
    </div-->
    

        <h1>
            <?php

                $monthNum  = $bulan;
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F'); // March

                $fx = 0;
                for($i = 1;$i<=12;$i++){

                    $z[$fx] = $bulan-$i;
                    $thn = $tahun;

                    $v = $z[$fx];

                    if($z[$fx] < 1){
                        $z[$fx] = $z[$fx]+12;
                        $thn = ($tahun-1);
                    }

                    //echo $thn;
                    //dapatkan 1 bulan yg lalu dari variabel blnnya

                    $monthNum2  = $z[$fx];
                    $dateObj2   = DateTime::createFromFormat('!m', $monthNum2);
                    $monthName2 = $dateObj2->format('F'); // March
                    $nm_bln[$fx] = $dateObj2->format('F'); // March

                    $arr[] = array();
                    $arr[$fx] = $monthName2." ".$thn;

                    //get total detik
                    $qtrt = $this->db->query("
                        SELECT SUM(TIME_TO_SEC(a.respon_time)) as detik from tbl_permintaan a where MONTH(a.dibuat) = '$v' and YEAR(a.dibuat) = '$thn' and a.hapus IS NULL;
                    ");

                    $td = $qtrt->row()->detik;

                    if($td == "" || $td == NULL){

                        $total_detik = 0; //total detik
                        $gt = 0;

                        $gt2[$fx] = 0; //querykeun deui make sec to time meh jadi waktu
                        
                        $waktunya2[$fx] = 0;

                    }else{

                            $total_detik = $qtrt->row()->detik; //total detik
                            //ganti detik ke waktu lihat total detiknya dlm format h:i:s
                            $conv_tt = $this->db->query("                   
                                SELECT SEC_TO_TIME($total_detik) as twb;
                            ");

                            $twb = $conv_tt->row()->twb; //total waktu keseluruhan
                            $twb2[$fx] = $conv_tt->row()->twb; //total waktu keseluruhan

                            //get total permintaan yang sudah close pada bulan terpilih
                            $qtcr = $this->db->query("
                                SELECT count(id) as total_closed FROM tbl_permintaan a where MONTH(a.dibuat) = '$v' and YEAR(a.dibuat) = '$thn' and a.statuz = 1 AND a.hapus IS NULL;
                            ");

                            $total_closed = $qtcr->row()->total_closed; //total closed requestnya
                            $total_closed2[$fx] = $qtcr->row()->total_closed; //total closed requestnya

                            $gt = CEIL($total_detik/$total_closed); //querykeun deui make sec to time meh jadi waktu
                            $gt2[$fx] = CEIL($total_detik/$total_closed); //querykeun deui make sec to time meh jadi waktu

                            $get_tf = $this->db->query("
                                SELECT SEC_TO_TIME($gt) as waktunya;
                            ");

                            $waktunya = $get_tf->row()->waktunya;
                            $waktunya2[$fx] = $get_tf->row()->waktunya;
                    }

                    $arr2[] = array();
                    $arr2[$fx] = $gt;


                    $fx++;
                }

                $arrm1 = array_reverse($arr);
                $arrm2 = array_reverse($arr2);

                $lbl = json_encode($arrm1);
                $dt = json_encode($arrm2);

                //echo $waktunya[2];

                //echo $z[2];

                //echo $monthName2[0];
                
                //kurangi satu bulan terpilih
                $bt = ($bulan-1);
                //jika hasil pengurangannya = 0 -> maka bulan menjadi 12 dan tahun dikurangi 1
                if($bt == 0){
                    $blnnya = 12;
                    $thnnya = ($tahun-1);
                }else{
                    $blnnya = $bt;
                    $thnnya = $tahun;
                }
                //jika hasilnya lebih dari 0 maka bulan = hasil pengurangan dan tahun tetap

            ?>
        </h1>

        <div id="print_this" class="col-lg-12">

            <div class="col-lg-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="tengah">PT. SIPATEX PUTRI LESTARI</th>
                            <th rowspan="2" colspan="4" class="tengah">LAPORAN EVALUASI <br> SASARAN PERUSAHAAN</th>
                            <th>No. Dokumen</th>
                            <th>FO/CA/SIMO/05</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="tengah">Dept. CA/SIMO</th>
                            <th>Revisi</th>
                            <th>00</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>DEPT./BAGIAN</td>
                            <td colspan="4">Information Technology</td>
                            <td>Periode</td>
                            <td colspan="2">
                                <?php 
                                    echo date('01', strtotime($nm_bln[0]))." ".$nm_bln[0]. " " . $thnnya." s/d ".date('t', strtotime($nm_bln[0]))." ".$nm_bln[0]. " " . $thnnya; 
                                    //echo date('01', strtotime($nm_bln[0]));
                                    //echo date('t', strtotime($nm_bln[0]));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>JUDUL</td>
                            <td colspan="7">Respon Penanganan masalah IT di User</td>
                        </tr>
                        <tr>
                            <td>TARGET</td>
                            <td colspan="7">Maximal 2 Jam sudah ada respon ke user ( Bukan Penyelesaian )</td>
                        </tr>
                        <tr>
                            <td>DASAR <br> PERHITUNGAN TARGET</td>
                            <td colspan="7">Maksimal 2 Jam setelah ada laporan masalah, baik lewat email, aplikasi dan/atau telepon sudah ada respon dari IT.
                            <br>Respon disini lebih ke arah report ke user tentang status permasalahan tersebut.
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="7">HASIL PENCAPAIAN</td>
                            <td rowspan="2" class="tengah">PARAMETER</td>
                            <td rowspan="2" class="tengah">TARGET</td>
                            <td rowspan="2" class="tengah">BLN INI</td>
                            <td rowspan="2" class="tengah">TERCAPAI</td>
                            <td colspan="2" class="tengah">2 BULAN LALU</td>
                            <td rowspan="2" class="tengah">PREDIKSI BULAN YAD</td>
                        </tr>
                        <tr class="tengah">
                            <td><?php echo $nm_bln[2];?></td>
                            <td><?php echo $nm_bln[1];?></td>
                        </tr>
                        <tr class="tengah">
                            <td>Waktu</td>
                            <td>2jam</td>
                            <td>
                                <?php 
                                    echo $waktunya2[0];
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($waktunya2[0] < "02:00:00"){
                                        echo 'Ya';
                                    }else{
                                        echo 'Tidak';
                                    }
                                ?>
                            </td>
                            <td><?php echo $waktunya2[2]." (".$gt2[2]." Sec )";?></td>
                            <td><?php echo $waktunya2[1]." (".$gt2[1]." Sec )";?></td>
                            <td>Kosong</td>
                        </tr>

                        <tr style="height:10px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="height:10px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr style="height:10px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8" class="tengah">
                                EVALUASI HASIL PENCAPAIAN DAN DATA PENDUKUNG **)
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <td colspan="2" style="width:25%;">
                                <table class="table table-bordered" style="margin-top:50%;">
                                    <tr>
                                        <th class="tengah">
                                        Hasil Pencapaian <br>
                                        <?php echo $twb2[0]."/".$total_closed2[0]." = ".$waktunya2[0]; ?>
                                        </th>
                                    </tr>
                                </table>
                            </td>

                            <td colspan="6" class="tengah">

                                <div style="width:100%;">
                                    <canvas id="myChart"></canvas>
                                </div>
                                
                            </td>

                        </tr>
                    </tbody>    
                    
                </table>

                <table class="table table-bordered">
                    <tr>
                        <th colspan="6" class="tengah">PENYEBAB DAN RENCANA TINDAKAN ( ACTION PLAN ) **)</th>
                    </tr> 
                    <tr>
                        <th width="6%" class="tengah">NO</th>
                        <th width="18%" class="tengah">PENYEBAB TERCAPAI / TDAK TERCAPAI</th>
                        <th width="18%" class="tengah">RENCANA TINDAKAN ( ACTION PLAN )</th>
                        <th width="18%" class="tengah">PIC</th>
                        <th width="18%" class="tengah">TGL SELESAI</th>
                        <th width="18%" class="tengah">Status Verifikasi</th>
                    </tr>  
                    <tr class="kk">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="kk">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="kk">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="kk">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="kk">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="kk">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="tengah italic alit">
                            *) Diisi dengan dasar perhitungan target contoh :
                            <br>
                            Total Waktu Respon
                            <br><hr style="width:40%;">
                            Jumlah Permintaan yang sudah close
                            <br>
                            *) jika kolom dalam formulir ini tidak mencukupi, dapat dilanjutkan pada halaman / kertas lain (sebagai lampiran)
                        </td>
                        <td class="tengah">Disusun Oleh</td>
                        <td class="tengah">Diperiksa Oleh</td>
                        <td class="tengah">Disetujui Oleh</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Nama & Tgl : Kabag</td>
                        <td>Nama & Tgl : Kadept</td>
                        <td>Nama & Tgl : Manager</td>
                    </tr>
                </table>

                <div class="col-lg-12">
                    Dicetak Pada : <?php echo date("d M Y");?>
                </div>
            
            </div>

        </div>

        <div style="margin-top:50px;">
            <button class="btn btn-danger" id="pdf"><i class="fa fa-file-pdf-o"></i> Create PDF</button>
        </div>
        

        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>jspdf/html2canvas.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>jspdf/jspdf.debug.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/Chart.bundle.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/moment.js"></script>

        <script>

            $("#pdf").click(function(){
                var doc = new jsPDF("p", "pt", "a4");
                doc.addHTML($('#print_this'), 0/*<-margin left*/, 30/*<- Margin top*/, {
                    pagesplit: false
                }, function() {
                    doc.save("Graph_evaluasi_<?php echo date("d M Y");?>.pdf");
                });
            })

            function formatTime(secs)
            {
                var hours = Math.floor(secs / (60 * 60));
            
                var divisor_for_minutes = secs % (60 * 60);
                var minutes = Math.floor(divisor_for_minutes / 60);
            
                var divisor_for_seconds = divisor_for_minutes % 60;
                var seconds = Math.ceil(divisor_for_seconds);
            
                return hours + ":" + minutes + ":" + seconds;
                //return secs;
            }


            var ctx = document.getElementById("myChart");


            var myChart = new Chart(ctx, {
            type: 'line',
            animation: false,
            data: {
                labels: <?php echo $lbl; ?>,
                datasets: [{
                    label: 'Detik',
                    data: <?php echo $dt; ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],

                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            callback: function(label, index, labels) {
                            return formatTime(label);
                            }
                        }
                    }]
                },
                legend: {
                        position: "right",
                        display:true
                    }
            }
            });

        </script>

        <!--script>
            var ctx = document.getElementById('tes').getContext('2d');
            var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan 01', 'Jan 02', 'Jan 03'],
                datasets: [{
                    label: 'Apples Sold',
                    data: [3, 5, 1],
                    borderColor: 'rgba(255, 99, 132, 0.8)',
                    fill: false
                }, {
                    label: 'Oranges Sold',
                    data: [0, 10, 2],
                    borderColor: 'rgba(255, 206, 86, 0.8)',
                    fill: false
                }, {
                    label: 'Gallons of Milk Sold',
                    data: [5, 7, 4],
                    borderColor: 'rgba(54, 162, 235, 0.8)',
                    fill: false
                }]
            },
            options: {
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                    intersect: false
                }
            }
            });
        </script-->   

    </body>
</html>
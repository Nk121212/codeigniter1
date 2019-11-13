<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>  
<style>
.mt {
    margin-top:10px;
}
</style>
<div id="page-wrapper" style="background-color:#d4d9ec;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">REQUEST REPORT</h3>
        </div>
    </div>
    <div class="row"> 
<!-- START -->
      
    <!--table class="table table-striped table-bordered table-hover" style="width:100%;">
        <thead>
            <tr class="danger">
                <th style="text-align:center;">Report Type</th>
                <th style="text-align:center;">Report Periode</th>
                <th style="text-align:center;">Report Format</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="25%" rowspan="2">Request Service Report</td>
                <form action="<?php echo base_url('index.php/laporan/exportexcelpermintaanservice'); ?>" method="post">
                    <td width="50%"><input type="text" name="datefilter1" style="width:100%;" required/></td>
                    <td width="25%">
                        <input type="hidden" id="ServiceAwalExcel" name="ServiceAwalExcel"/>
                        <input type="hidden" id="ServiceAkhirExcel" name="ServiceAkhirExcel"/>
                        <input class="btn btn-round btn-success" type="submit" value="Excel">                        
                    </td>
                </form>
            </tr>
            <tr>
                <form action="<?php echo base_url('index.php/cetakpdf/cetaklaporanpermintaanservice'); ?>" method="post" target="_blank">
                    <td><input type="text" name="datefilter2" style="width:100%;" required/></td> 
                    <td>                    
                        <input type="hidden" id="ServiceAwalPDF" name="ServiceAwalPDF"/>
                        <input type="hidden" id="ServiceAkhirPDF" name="ServiceAkhirPDF"/>
                        <input class="btn btn-round btn-primary" type="submit" value="PDF">                    
                    </td>
                </form>
            </tr>

            <tr>
                <td rowspan="2">Request Items Report</td>
                <form action="<?php echo base_url('index.php/laporan/exportexcelpermintaanbarang'); ?>" method="post">
                    <td><input type="text" name="datefilter3" style="width:100%;" required/></td>
                    <td>                    
                        <input type="hidden" id="BarangAwalExcel" name="BarangAwalExcel"/>
                        <input type="hidden" id="BarangAkhirExcel" name="BarangAkhirExcel"/>
                        <input class="btn btn-round btn-success" type="submit" value="Excel">                    
                    </td>
                </form>
            </tr>
            <tr>
                <form action="<?php echo base_url('index.php/cetakpdf/cetaklaporanpermintaanbarang'); ?>" method="post" target="_blank"> 
                    <td><input type="text" name="datefilter4" style="width:100%;" required/></td>
                    <td>     
                        <input type="hidden" id="BarangAwalPDF" name="BarangAwalPDF"/>
                        <input type="hidden" id="BarangAkhirPDF" name="BarangAkhirPDF"/>
                        <input class="btn btn-round btn-primary" type="submit" value="PDF">                        
                    </td>
                </form>
            </tr>

            <tr>
                <td rowspan="2">Request Application Report</td>
                <form action="<?php echo base_url('index.php/laporan/exportexcelpermintaanaplikasi'); ?>" method="post">
                    <td><input type="text" name="datefilter5" style="width:100%;" required/></td>
                    <td>                    
                        <input type="hidden" id="AplikasiAwalExcel" name="AplikasiAwalExcel"/>
                        <input type="hidden" id="AplikasiAkhirExcel" name="AplikasiAkhirExcel"/>
                        <input class="btn btn-round btn-success" type="submit" value="Excel">                    
                    </td>
                </form>
            </tr>
            <tr>
                <form action="<?php echo base_url('index.php/cetakpdf/cetaklaporanpermintaanaplikasi'); ?>" method="post" target="_blank"> 
                    <td><input type="text" name="datefilter6" style="width:100%;" required/></td>
                    <td>                        
                        <input type="hidden" id="AplikasiAwalPDF" name="AplikasiAwalPDF"/>
                        <input type="hidden" id="AplikasiAkhirPDF" name="AplikasiAkhirPDF"/>
                        <input class="btn btn-round btn-primary" type="submit" value="PDF">                    
                    </td>
                </form>
            </tr>

        </tbody>
    </table-->

    <!==========================================================================================>

   <table class="table">
    <tr>
        <th>Service Request Report</th>
    </tr>

    <form action="<?php echo base_url('index.php/laporan/exportexcelpermintaanservice2'); ?>" method="post" target="_blank">
        <tr>
            <th>
                <input type="text" class="form-control" id="serv_xcl" name="serv_xcl" required>
                <input type="text" name="val_sx1" id="val_sx1" hidden>
                <input type="text" name="val_sx2" id="val_sx2" hidden>
            </th>
            <th>
                <select name="lok" id="lok" class="form-control" required>
                    <?php 
                        $q = $this->db->query("
                            select * from mu_kat_parameter where ref_kat = '98323530055155834';
                        ");

                        echo '
                            <option value="" disabled selected>Lokasi</option>
                            <option value="">All</option>
                        ';

                        foreach($q->result() as $dtl){
                            echo '
                                <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                            ';
                        }
                        
                    ?>
                    
                </select>
            </th>
            <th>
                <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</button>
            </th>
        </tr>
    </form>
    
    <form action="<?php echo base_url('index.php/cetakpdf/cetaklaporanpermintaanservice2'); ?>" method="post" target="_blank">
        <tr>
            <th>
                <input type="text" class="form-control" id="serv_pdf" name="serv_pdf">
                <input type="text" name="val_sp1" id="val_sp1" hidden>
                <input type="text" name="val_sp2" id="val_sp2" hidden>
            </th>
            <th>
                <select name="lok" id="lok" class="form-control" required>
                    <?php 
                        $q = $this->db->query("
                            select * from mu_kat_parameter where ref_kat = '98323530055155834';
                        ");

                        echo '
                            <option value="" disabled selected>Lokasi</option>
                            <option value="">All</option>
                        ';

                        foreach($q->result() as $dtl){
                            echo '
                                <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                            ';
                        }
                        
                    ?>
                    
                </select>
            </th>
            <th>
                <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</button>
            </th>
        </tr>
    </form>
    
    <!======================================================================>
    <tr>
        <th>Item Request Report</th>
    </tr>

    <form action="<?php echo base_url('index.php/laporan/exportexcelpermintaanbarang2'); ?>" method="post" target="_blank">

    <tr>
        <th>
            <input type="text" class="form-control" id="item_xcl" name="item_xcl">
            <input type="text" name="val_ix1" id="val_ix1" hidden>
            <input type="text" name="val_ix2" id="val_ix2" hidden>
        </th>
        <th>
            <select name="lok" id="lok" class="form-control" required>
                <?php 
                    $q = $this->db->query("
                        select * from mu_kat_parameter where ref_kat = '98323530055155834';
                    ");

                    echo '
                        <option value="" disabled selected>Lokasi</option>
                        <option value="">All</option>
                    ';

                    foreach($q->result() as $dtl){
                        echo '
                            <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                        ';
                    }
                    
                ?>
                
            </select>
        </th>
        <th>
            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</button>
        </th>
    </tr>
    </form>
    
    <form action="<?php echo base_url('index.php/cetakpdf/cetaklaporanpermintaanbarang2'); ?>" method="post" target="_blank">
    <tr>
        <th>
            <input type="text" class="form-control" id="item_pdf" name="item_pdf">
            <input type="text" name="val_ip1" id="val_ip1" hidden>
            <input type="text" name="val_ip2" id="val_ip2" hidden>
        </th>
        <th>
            <select name="lok" id="lok" class="form-control" required>
                <?php 
                    $q = $this->db->query("
                        select * from mu_kat_parameter where ref_kat = '98323530055155834';
                    ");

                    echo '
                        <option value="" disabled selected>Lokasi</option>
                        <option value="">All</option>
                    ';

                    foreach($q->result() as $dtl){
                        echo '
                            <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                        ';
                    }
                    
                ?>
                
            </select>
        </th>
        <th>
            <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</button>
        </th>
    </tr>
    </form>

    <!======================================================================>
    <tr>
        <th>Applications Request Report</th>
    </tr>

    <form action="<?php echo base_url('index.php/laporan/exportexcelpermintaanaplikasi2'); ?>" method="post" target="_blank">

    <tr>
        <th>
            <input type="text" class="form-control" id="apps_xcl" name="apps_xcl">
            <input type="text" name="val_ax1" id="val_ax1" hidden>
            <input type="text" name="val_ax2" id="val_ax2" hidden>
        </th>
        <th>
            <select name="lok" id="lok" class="form-control" required>
                <?php 
                    $q = $this->db->query("
                        select * from mu_kat_parameter where ref_kat = '98323530055155834';
                    ");

                    echo '
                        <option value="" disabled selected>Lokasi</option>
                        <option value="">All</option>
                    ';

                    foreach($q->result() as $dtl){
                        echo '
                            <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                        ';
                    }
                    
                ?>
                
            </select>
        </th>
        <th>
            <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</button>
        </th>
    </tr>

    </form>


    <form action="<?php echo base_url('index.php/cetakpdf/cetaklaporanpermintaanaplikasi2'); ?>" method="post" target="_blank">
        <tr>
            <th>
                <input type="text" class="form-control" id="apps_pdf" name="apps_pdf">
                <input type="text" name="val_ap1" id="val_ap1" hidden>
                <input type="text" name="val_ap2" id="val_ap2" hidden>
            </th>
            <th>
                <select name="lok" id="lok" class="form-control" required>
                    <?php 
                        $q = $this->db->query("
                            select * from mu_kat_parameter where ref_kat = '98323530055155834';
                        ");

                        echo '
                            <option value="" disabled selected>Lokasi</option>
                            <option value="">All</option>
                        ';

                        foreach($q->result() as $dtl){
                            echo '
                                <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                            ';
                        }
                        
                    ?>
                    
                </select>
            </th>
            <th>
                <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</button>
            </th>
        </tr>
    </form>

    <tr>
        <th>Service PC Report</th>
    </tr>

    <form action="<?php echo base_url('index.php/cetakpdf/service_pc'); ?>" method="post" target="_blank">
        <tr>
            <th>
                <input type="text" class="form-control" id="serv_pc" name="serv_pc" placeholder>
                <input type="text" name="val_spc1" id="val_spc1" hidden>
                <input type="text" name="val_spc2" id="val_spc2" hidden>
            </th>
            <th>
                <select name="stat" id="stat" class="form-control" required>
                    <option value="" disabled selected>Status</option>
                    <option value="0">Open</option>
                    <option value="1">Close</option>
                </select>
            </th>
            <th>
                <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</button>
            </th>
        </tr>
    </form>

    <tr>
        <th>Grafik Request Service CPU</th>
    </tr>

    <form action="<?php echo base_url('index.php/cetakpdf/graph_harian'); ?>" method="post" target="_blank">
        <tr>
            <th>
                <input type="text" class="form-control" id="graph1" name="graph1" placeholder>
                <input type="text" name="val_graph1" id="val_graph1" hidden>
                <input type="text" name="val_graph2" id="val_graph2" hidden>
            </th>
            <th>
                <button type="submit" class="btn btn-outline btn-success"><i class="fa fa-bar-chart"></i> Graphic Harian</button>
            </th>
        </tr>
    </form>

    <form action="<?php echo base_url('index.php/cetakpdf/graph_bulanan'); ?>" method="post" target="_blank">
        <tr>
            <th>

                <select name="bulan1" id="bulan1" class="form-control" required>
                    <option value="" disabled selected>Bulan Awal</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

            </th>

            <th>

                <select name="bulan2" id="bulan2" class="form-control" required>
                    <option value="" disabled selected>Bulan Akhir</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

            </th>

            <th>
                <select name="tahun1" id="tahun1" class="form-control" required>
                    <option value="" disabled selected>Years</option>
                    <?php 
                        for($i = 1945 ; $i <= date('Y'); $i++){
                            echo "<option value=".$i.">$i</option>";
                        }
                    ?>
                    
                </select>
            </th>

            <th>
                <select style="display:none;" name="tahun2" id="tahun2" class="form-control" required>
                    <option value="" disabled selected>Years</option>
                    <?php 
                        for($i = 1945 ; $i <= date('Y'); $i++){
                            echo "<option value=".$i.">$i</option>";
                        }
                    ?>
                    
                </select>
            </th>
            <th>
                <button type="submit" class="btn btn-outline btn-success"><i class="fa fa-bar-chart"></i> Graphic Bulanan</button>
            </th>
        </tr>
    </form>

    <form target="_blank" action="<?php echo base_url();?>index.php/Cetakpdf/graph_cs" method="post">
        <tr>
            <th>Report Hitung Perbaikan</th>
        </tr>
        <tr>
            <th>
                <input type="text" class="form-control" id="vhg" name="vhg" placeholder>
                <input type="text" name="vhg1" id="vhg1" hidden>
                <input type="text" name="vhg2" id="vhg2" hidden>
            </th>
            <th>
                <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Graphic Perbaikan</button>
            </th>
        </tr>
    </form>

    <form target="_blank" action="<?php echo base_url();?>index.php/Cetakpdf/log_ganti" method="post">
        <tr>
            <th>Report Penggantian Komponen</th>
        </tr>
        <tr>
            <th>
                <input type="text" class="form-control" id="vcc" name="vcc" placeholder>
                <input type="text" name="val_vcc1" id="val_vcc1" hidden>
                <input type="text" name="val_vcc2" id="val_vcc2" hidden>
            </th>
            <th>
                <button type="submit" class="btn btn-outline btn-danger"><i class="fa fa-file-pdf-o"></i> Get Pdf</button>
            </th>
        </tr>
    </form>

    <form target="_blank" action="<?php echo base_url();?>index.php/Cetakpdf/astok" method="post">
        <tr>
            <th>Report Stok Tersedia</th>
        </tr>
        <tr>
            <th>
                <button type="submit" class="btn btn-outline btn-danger"><i class="fa fa-file-pdf-o"></i> Get Pdf</button>
            </th>
        </tr>
    </form>

    <form target="_blank" action="<?php echo base_url();?>index.php/Cetakpdf/evaluasi" method="post">
        <tr>
            <th>Report Evaluasi</th>
        </tr>
        <tr>
            <th>

                <select name="bln" id="bln" class="form-control" required>
                    <option value="" disabled selected>Bulan Akhir</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

            </th>

            <th>
                <select name="thn" id="thn" class="form-control" required>
                    <option value="" disabled selected>Years</option>
                    <?php 
                        for($i = 1945 ; $i <= date('Y'); $i++){
                            echo "<option value=".$i.">$i</option>";
                        }
                    ?>
                    
                </select>
            </th>
            <th>
                <button type="submit" class="btn btn-outline btn-danger"><i class="fa fa-file-pdf-o"></i> Get Pdf</button>
            </th>
        </tr>
    </form>

   </table>

<script>

    $("#bulan1").val("<?php echo date("m");?>");
    $("#bulan2").val("<?php echo date("m");?>");
    $("#tahun1").val("<?php echo date("Y");?>");
    $("#tahun2").val("<?php echo date("Y");?>");

    $("#bln").val("<?php echo date("m");?>");
    $("#thn").val("<?php echo date("Y");?>");

    var startDate;
    var endDate;

    //=========================================================================== DateTimePicker Service Excel anyar
    $('#vhg').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#vhg').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#vhg1').val(mulaicuy);
        $('#vhg2').val(akhircuy);
    });
    $('#vhg').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#vhg1').val('');
        $('#vhg2').val('');    
    }); 

    
    //=========================================================================== DateTimePicker Service Excel anyar
    $('#serv_xcl').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#serv_xcl').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_sx1').val(mulaicuy);
        $('#val_sx2').val(akhircuy);
    });
    $('#serv_xcl').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_sx1').val('');
        $('#val_sx2').val('');    
    });  

    //=========================================================================== DateTimePicker Service pdf anyar
    $('#serv_pdf').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#serv_pdf').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_sp1').val(mulaicuy);
        $('#val_sp2').val(akhircuy);
    });
    $('#serv_pdf').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_sp1').val('');
        $('#val_sp2').val('');    
    }); 


    //=========================================================================== DateTimePicker Item Excel anyar
    $('#item_xcl').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#item_xcl').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_ix1').val(mulaicuy);
        $('#val_ix2').val(akhircuy);
    });
    $('#item_xcl').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_ix1').val('');
        $('#val_ix2').val('');    
    });  

    //=========================================================================== DateTimePicker Item pdf anyar
    $('#item_pdf').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#item_pdf').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_ip1').val(mulaicuy);
        $('#val_ip2').val(akhircuy);
    });
    $('#item_pdf').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_ip1').val('');
        $('#val_ip2').val('');    
    }); 

    //=========================================================================== DateTimePicker App Excel anyar
    $('#apps_xcl').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#apps_xcl').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_ax1').val(mulaicuy);
        $('#val_ax2').val(akhircuy);
    });
    $('#apps_xcl').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_ax1').val('');
        $('#val_ax2').val('');    
    });  

    //=========================================================================== DateTimePicker App pdf anyar
    $('#apps_pdf').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#apps_pdf').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_ap1').val(mulaicuy);
        $('#val_ap2').val(akhircuy);
    });
    $('#apps_pdf').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_ap1').val('');
        $('#val_ap2').val('');    
    }); 

    //======================================================================dtpicker service pc
    $('#serv_pc').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('#serv_pc').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_spc1').val(mulaicuy);
        $('#val_spc2').val(akhircuy);
    });
    
    $('#serv_pc').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_spc1').val('');
        $('#val_spc2').val('');    
    }); 

    //================
    //======================================================================graph date
    $('#graph1').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    

    $('#graph1').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_graph1').val(mulaicuy);
        $('#val_graph2').val(akhircuy);
    });
    
    $('#graph1').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_graph1').val('');
        $('#val_graph2').val('');    
    }); 
    
     



    //=========================================================================== DateTimePicker Service Excel
    $('input[name="datefilter1"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('input[name="datefilter1"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#ServiceAwalExcel').val(mulaicuy);
        $('#ServiceAkhirExcel').val(akhircuy);
    });
    $('input[name="datefilter1"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');        
    });    

    //=========================================================================== DateTimePicker Service PDF
    $('input[name="datefilter2"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('input[name="datefilter2"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#ServiceAwalPDF').val(mulaicuy);
        $('#ServiceAkhirPDF').val(akhircuy);
    });
    $('input[name="datefilter2"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');        
    });   

    //=========================================================================== DateTimePicker Barang Excel
    $('input[name="datefilter3"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('input[name="datefilter3"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#BarangAwalExcel').val(mulaicuy);
        $('#BarangAkhirExcel').val(akhircuy);
    });
    $('input[name="datefilter3"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');        
    });  

    //=========================================================================== DateTimePicker Barang PDF
    $('input[name="datefilter4"]').daterangepicker({
            autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('input[name="datefilter4"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#BarangAwalPDF').val(mulaicuy);
        $('#BarangAkhirPDF').val(akhircuy);
    });
    $('input[name="datefilter4"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');        
    });  

    //=========================================================================== DateTimePicker Aplikasi PDF
    $('input[name="datefilter5"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('input[name="datefilter5"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#AplikasiAwalExcel').val(mulaicuy);
        $('#AplikasiAkhirExcel').val(akhircuy);
    });
    $('input[name="datefilter5"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');        
    });          

    //=========================================================================== DateTimePicker Aplikasi PDF
    $('input[name="datefilter6"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    
    $('input[name="datefilter6"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#AplikasiAwalPDF').val(mulaicuy);
        $('#AplikasiAkhirPDF').val(akhircuy);
    });

    $('input[name="datefilter6"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');        
    });     

    //======================================================================graph date
    $('#vcc').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });    

    $('#vcc').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

        var mulaicuy = picker.startDate.format('YYYY-MM-DD 00:00:00');
        var akhircuy = picker.endDate.format('YYYY-MM-DD 23:59:59');

        $('#val_vcc1').val(mulaicuy);
        $('#val_vcc2').val(akhircuy);
    });
    
    $('#vcc').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');    
        $('#val_vcc1').val('');
        $('#val_vcc2').val('');    
    }); 
     


    $("#tahun1").change(function(){
        var th1 = $(this).val();

        $("#tahun2").val(th1);

    }) 
    
    $("#bulan1").change(function(){

        var bln2 = $("#bulan2").val();
        var bln1 = $(this).val();

        if(bln2 < $(this).val()){
            //alert("lebih kecil");
            $("#bulan2").val(bln1);
        }else{

        }
    })

    $("#bulan2").change(function(){
        
        var bln1 = $("#bulan1").val();

        if($(this).val() > bln1){
            //$(this).val(bln1);
        }else if($(this).val() < bln1){
            alert("Tidak boleh lebih kecil dari bulan awal !");
            $(this).val(bln1);
        } 

    })    

</script>

<style>
     /*table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }*/

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<!-- END -->
    </div>
</div>


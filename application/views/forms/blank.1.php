<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>  


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Blank</h1>
        </div>
    </div>
    <div class="row">  
    
    <form action="<?php echo base_url('index.php/login/testsimpan'); ?>" method="post">
        
        <table border="0" align="center">
            <tr>
                <td>
                    <div style="width:300px;">
                        <label for="klpk_warna" class="control-label">Jam Mulai Gangguan </label>
                        <label for="klpk_warna" class="control-label">(Min : 0000 - Max : 2359)</label>
                        <input class="form-control" placeholder="Waktu Mulai Gangguan" type="text" maxlength="4" name="mul_ggu" id="mul_ggu" onkeyup="convertz()">
                    </div>
                </td>
                <td><div style="width:30px;"></div></td>
                <td>
                    <div style="width:300px;">
                        <label for="proses" class="control-label">Jam Selesai Gangguan</label>
                        <label for="klpk_warna" class="control-label">(Min : 0000 - Max : 2359)</label>
                        <input class="form-control" placeholder="Menit Selesai Gangguan" type="text" maxlength="4" name="sel_ggu" id="sel_ggu" onkeyup="convertz()">
                    </div>
                </td>
            </tr>    
    
            <tr>
                <td>
                    <div style="width:300px;">
                        <label for="klpk_warna" class="control-label">Jam Mulai Gangguan xxx</label>
                        <input class="form-control" placeholder="Waktu Mulai Gangguan" type="hidden" name="mul_ggux" id="mul_ggux">
                    </div>
                </td>
                <td><div style="width:30px;"></div></td>
                <td>
                    <div style="width:300px;">
                        <label for="proses" class="control-label">Jam Selesai Gangguan xxx</label>
                        <input class="form-control" placeholder="Menit Selesai Gangguan" type="hidden" name="sel_ggux" id="sel_ggux">
                    </div>
                </td>
            </tr>            

            <tr align="center">
                <td><div style="width:30px;"></div></td>
                <td><input type="submit" value="Simpan"></td>
                <td><div style="width:30px;"></div></td>
            </tr>            
        </table>
        
    </form>

    <br>
    <br>

    <form action="<?php echo base_url('index.php/permintaan/testkirim'); ?>" method="post">
        <table border="0" align="center">
            <tr align="center">
                <td><div style="width:30px;"></div></td>
                <td><input type="submit" value="Simpan"></td>
                <td><div style="width:30px;"></div></td>
            </tr>
        </table>
    </form>

    <!-- SAMPLE MODAL -->

    <table class="table">
        <thead>
            <tr>
                <th>SN</th>
                <th>Firstname</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Theophilus</td>
                <td>
                    <button class="btn btn-primary" first-name="Theophilus" second-name="Theo" data-toggle="modal" data-target="#myModal">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Omoregbee</td>
                <td>
                    <button class="btn btn-primary" first-name="Omoregbee" second-name="Omoro" data-toggle="modal" data-target="#myModal">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Endurance</td>
                <td>
                    <button class="btn btn-primary" first-name="Endurance" second-name="Endur" data-toggle="modal" data-target="#myModal">
                        Edit
                    </button>
                </td>
            </tr>

        </tbody>
    </table>

    <!-- test datatable --> 
    <table id="table_id" class="table table-striped table-bordered table-hover" width="100%"> 
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr>
        </tbody>
    </table>

    <br>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                <div class="modal-body">
                    <form id="profileForm">
                    Firstname : <input class="form-control" name="firstname" value="" placeholder="firstname">
                    Secondname : <input class="form-control" name="secondname" value="" placeholder="secondname">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>    


    <form action="<?php echo base_url('index.php/testpdf/laporan_pdf'); ?>" method="post" target="_blank">
        <table border="0" align="center">
            <tr align="center">
                <td><div style="width:30px;"></div></td>
                <td><input type="submit" value="export PDF"></td>
                <td><div style="width:30px;"></div></td>
            </tr>
        </table>
    </form>

<br>

<input type="text" name="daterange1" id="daterange1" />

<br><br><br><br><br><br><br>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body" id="mainpro">    

            <div class="row show-grid">
                <div class="col-md-10">
                    <input type="text" class="form-control has-feedback-left" name="txt_main_pro" id="txt_main_pro" placeholder="Main Project" required>
                </div>
                <div class="col-md-2 col-md-offset-0">  
                    <button id="btn1" class="btn btn-success" onclick="tambah_submain();"><i class="fa fa-plus"></i> Sub Main</button>
                </div>
            </div>

            <div id="sub_main">                
                <div class="row show-grid">
                    <div class="col-md-7 col-md-offset-1">
                        <input type="text" class="form-control has-feedback-left" name="txt_submain_pro" id="txt_submain_pro" placeholder="Sub Main Project" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control has-feedback-left" name="txt_bobot1" id="txt_bobot1" placeholder="Bobot" required></div>
                        <div class="col-md-2" style="height:56px; padding-top:17px;">
                            <button id="btn2" class="btn btn-xs btn-success"> Add Sub-submain </button>
                        </div>
                    </div>
                </div>
            
            
                <div id="' + idx + '" tabindex="' + ac + '">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Nama Kontak</label>
                            <input type="text" class="form-control" name="nm_kontak" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>No Kontak</label>
                            <input type="text" class="form-control" name="no_kontak" value="' + idx + '" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">
                        <button class="btn btn-info" onclick="fu_a_kontak();"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-danger" onclick="hapus_submain(\''+idx+'\');"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            
            </div>

            

        </div>
    </div>
</div>






<br><br><br><br><br><br><br>

<script>
    
    var jum_row=[];    

    function tambah_submain() {
        var ca = jum_row.length;
        var ac = ca + 1;
        var idx = "cf_kontak_" + ac;
        jum_row.push(idx);

        $("#sub_main").append('<div id="' + idx + '" tabindex="' + ac + '"><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>Nama Kontak</label><input type="text" class="form-control" name="nm_kontak" required></div></div><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>No Kontak</label><input type="text" class="form-control" name="no_kontak" value="' + idx + '" required></div></div><div class="col-md-12 col-sm-12 col-xs-12" align="center"><button class="btn btn-info" onclick="fu_a_kontak();"><i class="fa fa-plus"></i></button><button class="btn btn-danger" onclick="hapus_submain(\''+idx+'\');"><i class="fa fa-minus"></i></button></div></div>');
    }

    function hapus_submain(val) {
        var ix = jum_row.indexOf(val);
        jum_row.splice(ix, 1);
        $("#sub_main #" + val + "").hide();
    }






    $(document).ready(function(){
    });
/*
        $("#btn1").click(function(){
            $("#mainpro").append('<div class="row show-grid"><div class="col-md-7 col-md-offset-1"><input type="text" class="form-control has-feedback-left" name="txt_submain_pro" id="txt_submain_pro" placeholder="Sub Main Project" required></div><div class="col-md-2"><input type="number" class="form-control has-feedback-left" name="txt_bobot1" id="txt_bobot1" placeholder="Bobot" required></div><div class="col-md-2" style="height:56px; padding-top:17px;"><button id="btn2" class="btn btn-xs btn-success"> Add Sub-submain </button></div></div>');
        });

        $("#btn2").click(function(){
            $("#submain").append('<div class="row show-grid"><div class="col-md-6 col-md-offset-2"><input type="text" class="form-control has-feedback-left" name="txt_subsubmain_pro" id="txt_subsubmain_pro" placeholder="Sub Sub Main Project" required></div><div class="col-md-2"><input type="number" class="form-control has-feedback-left" name="txt_bobot2" id="txt_bobot2" placeholder="Bobot" required></div><div class="col-md-2" style="height:56px; padding-top:17px;"><button id="btn2" class="btn btn-xs btn-danger"> Hapus Sub-submain </button></div></div>');
        });

//------------------------------------------------------------------------------------------------
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body" id="mainpro">    

            <div class="row show-grid">
                <div class="col-md-10">
                    <input type="text" class="form-control has-feedback-left" name="txt_main_pro" id="txt_main_pro" placeholder="Main Project" required>
                </div>
                <div class="col-md-2 col-md-offset-0">  
                    <button id="btn1" class="btn btn-success" onclick="tambah_submain();"><i class="fa fa-plus"></i> Sub Main</button>
                </div>
            </div>

            <div id="sub_main">                

            </div>

            

        </div>
    </div>
</div> 
*/

<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
  var jum_row = [];    

    function tambah_submain() {
      if (jum_row == ''){
        var ca = 0;
          var ac = ca + 1;
          var idx = ac;
          jum_row.push(idx);

          $("#sub_main").append('<div id="' + idx + '" tabindex="' + ac + '"><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>Nama Kontak</label><input type="text" class="form-control" name="nm_kontak" required></div></div><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>No Kontak</label><input type="text" class="form-control" name="no_kontak" value="cf_kontak_' + idx + '" required></div></div><div class="col-md-12 col-sm-12 col-xs-12" align="center"><button class="btn btn-info" onclick="fu_a_kontak();"><i class="fa fa-plus"></i></button><button class="btn btn-danger" onclick="hapus_submain(\''+idx+'\');"><i class="fa fa-minus"></i></button></div></div>');
      }else{
        var ca = jum_row.slice(-1)[0];
          var ac = ca + 1;
          var idx = ac;
          jum_row.push(idx);

          $("#sub_main").append('<div id="' + idx + '" tabindex="' + ac + '"><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>Nama Kontak</label><input type="text" class="form-control" name="nm_kontak" required></div></div><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>No Kontak</label><input type="text" class="form-control" name="no_kontak" value="cf_kontak_' + idx + '" required></div></div><div class="col-md-12 col-sm-12 col-xs-12" align="center"><button class="btn btn-info" onclick="fu_a_kontak();"><i class="fa fa-plus"></i></button><button class="btn btn-danger" onclick="hapus_submain(\''+idx+'\');"><i class="fa fa-minus"></i></button></div></div>');
      }
        
      
    }


    function hapus_submain(val) {
        //var ix = jum_row.indexOf(val);
        //alert(ix);
        //jum_row.splice(ix, 1);
        //alert(e);
        $("#sub_main #" + val + "").remove();
    }


    
</script>















<script type="text/javascript" charset="utf-8">

    function convertz(){         
        val1 = document.getElementById("mul_ggu").value;
        val2 = document.getElementById("sel_ggu").value;

        if (val1.length == 4) {    
            if (val1 > 2359) {
                document.getElementById("mul_ggu").value = "2359"; 
                val1 = document.getElementById("mul_ggu").value;             
            }
                jam1 = val1.substr(0, 2);            
                mnt1 = val1.substr(2);        
            
                if (jam1 > 23){
                    jam1 = "23";
                }
                if (mnt1 > 59) {
                    mnt1 = "59";
                }

                hasil1 = jam1.concat(":", mnt1);
                document.getElementById("mul_ggux").value = hasil1;
        } 

        if (val2.length == 4) {    
            if (val2 > 2359) {
                document.getElementById("sel_ggu").value = "2359";    
                val2 = document.getElementById("sel_ggu").value;       
            }
                jam2 = val2.substr(0, 2);            
                mnt2 = val2.substr(2);        
            
                if (jam2 > 23){
                    jam2 = "23";
                }
                if (mnt2 > 59) {
                    mnt2 = "59";
                }

                hasil2 = jam2.concat(":", mnt2);
                document.getElementById("sel_ggux").value = hasil2;
        }         
    }

    //---------------------------------------------------------
    $('#myModal').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener=e.relatedTarget;//this holds the element who called the modal
        
        //we get details from attributes
        var firstname=$(opener).attr('first-name');
        var secondname=$(opener).attr('second-name');

        //set what we got to our form
        $('#profileForm').find('[name="firstname"]').val(firstname);
        $('#profileForm').find('[name="secondname"]').val(secondname);    
    });

    //-----------------------------------------------------------
    $(document).ready(function() {
        $('#table_id').DataTable();
    });

    //-----------------------------------------------------------
    $(function() {
        $('input[name="daterange1"]').daterangepicker({
            opens: 'right'
        }, 
        function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });























</script>

    </div>
</div>


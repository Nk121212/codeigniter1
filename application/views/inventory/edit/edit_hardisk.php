<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>sbadmin2/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>  

<style>
.mt {
    margin-top:10px;
}
</style>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Edit Hardisk</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <form action="<?php echo base_url();?>index.php/C_hardisk/update_hardisk" method="post">

            <input type="text" name="id" value="<?php echo $id;?>" hidden>
                    
            <div class="modal-body">

                <table class="table">
                    <tr>
                        <th>
                            Merk : 
                            <select name="merk" id="merk" class="form-control">
                                <?php 
                                    $qmerk = $this->db->query("
                                        select * from master_merk where hapus is null and status = 1
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Merk</option>
                                    ';

                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->id.'">'.$dproc->nama_merk.'</option>
                                        ';
                                    }

                                ?>
                            </select>
                        </th>
                        <th>
                            Type : 
                            <select name="type" id="type" class="form-control">
                                <?php 
                                    $qmerk = $this->db->query("
                                        select * from master_type where hapus is null and status = 1 and kat = 3
                                    ");

                                    echo '
                                        <option value="" disabled selected>Pilih Type</option>
                                    ';

                                    foreach($qmerk->result() as $dproc){
                                        echo '
                                            <option value="'.$dproc->id.'">'.$dproc->nama_type.'</option>
                                        ';
                                    }

                                ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Kapasitas :
                            <input type="text" name="kapasitas" id="kapasitas" class="form-control" placeholder="Ex. 100 Gb">
                        </th>
                        <th>
                            Byte :
                            <select name="byte" id="byte" class="form-control">
                                <option value="" disabled selected>Pilih Byte</option>
                                <option value="1">KiloByte (KB)</option>
                                <option value="2">MegaByte (MB)</option>
                                <option value="3">GigaByte (GB)</option>
                                <option value="4">TeraByte (TB)</option>
                            </select>
                        </th>
                    </tr>
                </table>

            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url();?>index.php/C_hardisk/view_hardisk" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>

</div>

<input type="text" id="merk1" value="<?php echo $merk; ?>" hidden>
<input type="text" id="type1" value="<?php echo $type; ?>" hidden>
<input type="text" id="kapasitas1" value="<?php echo $kapasitas; ?>" hidden>
<input type="text" id="byte1" value="<?php echo $byte; ?>" hidden>

<script>
    $(document).ready(function(){
        var merk =  $("#merk1").val();
        var type =  $("#type1").val();
        var kapasitas = $("#kapasitas1").val();
        var byte = $("#byte1").val();

        $("#merk").val(merk);
        $("#type").val(type);
        $("#kapasitas").val(kapasitas);
        $("#byte").val(byte);
        //console.log(merk);
    })
</script>


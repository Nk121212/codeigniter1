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
            <h3 class="page-header">Edit Monitor</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <form action="<?php echo base_url();?>index.php/C_monitor/update_monitor" method="post">

            <input type="text" name="id" value="<?php echo $id;?>" hidden>
                    
            <div class="modal-body">
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
                Type : 
                <select name="type" id="type" class="form-control">
                    <?php 
                        $qmerk = $this->db->query("
                            select * from master_type where hapus is null and status = 1 and kat = 6
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

                Inches :
                <input type="text" name="inches" id="inches" class="form-control" placeholder="Ex. 8">
            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url();?>index.php/C_monitor/view_monitor" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>

</div>

<input type="text" id="merk1" value="<?php echo $merk; ?>" hidden>
<input type="text" id="type1" value="<?php echo $type; ?>" hidden>
<input type="text" id="inches1" value="<?php echo $inches; ?>" hidden>

<script>
    $(document).ready(function(){
        var merk = $("#merk1").val();
        var type =  $("#type1").val();
        var inches = $("#inches1").val();

        $("#merk").val(merk);
        $("#type").val(type);
        $("#inches").val(inches);
        //console.log(merk);
    })
</script>


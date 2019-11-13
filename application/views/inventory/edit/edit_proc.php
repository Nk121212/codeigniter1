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
            <h3 class="page-header">Edit Processor</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <form action="<?php echo base_url();?>index.php/C_processor/update_proc" method="post">

            <input type="text" name="id_proc" value="<?php echo $id_proc;?>" hidden>
                    
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
                            select * from master_type where hapus is null and status = 1 and kat = 1
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

                <div class="row">

                    <div class="col-sm-6">
                        Clock :
                        <input type="number" name="clock" id="clock" class="form-control" placeholder="Ex. 32">
                    </div>
                    <div class="col-sm-6">
                        Hertz :
                        <select name="hertz" id="hertz" class="form-control">
                            <option value="" disabled selected>Pilih hertz</option>
                            <option value="MHz">MHz (MegaHertz)</option>
                            <option value="GHz">GHz (GigaHertz)</option>
                            <option value="THz">THz (TeraHertz)</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url();?>index.php/C_processor/view_proc" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>

</div>

<input type="text" id="merk1" value="<?php echo $merk; ?>" hidden>
<input type="text" id="type1" value="<?php echo $type; ?>" hidden>
<input type="text" id="clock1" value="<?php echo $clock; ?>" hidden>
<input type="text" id="hertz1" value="<?php echo $hertz; ?>" hidden>

<script>
    $(document).ready(function(){
        var merk = $("#merk1").val();
        var type =  $("#type1").val();
        var clock = $("#clock1").val();
        var hrtz = $("#hertz1").val();

        $("#merk").val(merk);
        $("#type").val(type);
        $("#clock").val(clock);
        $("#hertz").val(hrtz);
        //console.log(merk);
    })
</script>


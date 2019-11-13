<style>
.mt {
    margin-top:10px;
}
</style>

<link href="<?php echo base_url(); ?>sbadmin2/dist/css/bootstrap-select.css" rel="stylesheet">

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Service Card</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <form target="_blank" action="<?php echo base_url();?>index.php/C_service/create_pdf" method="post">

            <div class="row">
                <!--div class="col-lg-3">
                    <select name="sas" id="sas" class="form-control">
                        <option value="" disabled selected>Choose</option>
                        <option value="1">Print All</option>
                        <option value="2">By Pc</option>
                    </select>
                </div-->
                <div class="col-lg-2" id="hos">
                    <select name="id_pc[]" id="id_pc" class="selectpicker" multiple>
                        <option value="" disabled>Pilih PC</option>
                        <?php 
                            $query = $this->db->query("
                                select * from master_pc where hapus is null;
                            ");
                            foreach($query->result() as $dtpc){
                                echo '
                                    <option value="'.$dtpc->id.'">'.$dtpc->nama_pc.'</option>
                                ';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-outline btn-success">Submit</button>
                </div>
            </div>

        </form>

        
        
    </div>

</div>

<script src="<?php echo base_url(); ?>sbadmin2/js/bootstrap-select.min.js"></script>
<script>
   /* $(document).ready(function(){
        $("#hos").hide();
    })

    $("#sas").change(function(){

        var val = $(this).val();

        if(val == 1){

            $("#hos").hide();
            $("#id_pc").val("");

        }else{

            $("#hos").show();

        }

    })
    */

</script>
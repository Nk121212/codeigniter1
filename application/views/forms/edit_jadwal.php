<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Penjadwalan</h3>
        </div>
    </div>

    <form action="<?php echo base_url();?>index.php/C_service/edit_jadwal" method="post">

        <div class="row">
            <div class="col-lg-6">

                <input type="hidden" name="id" id="id" value="<?php echo $detail->row()->id;?>">
            
                <select name="bag" id="bag" class="form-control">
                    <option value="" disabled selected>Lokasi / Divisi</option>
                    <?php 
                        $sd = $this->db->query("
                            select * from tbl_bagian order by nama_bagian
                        ");

                        foreach($sd->result() as $dtdiv){

                            echo '
                                <option value="'.$dtdiv->kd.'">'.$dtdiv->nama_bagian.'</option>
                            ';

                        }
                    ?>
                </select>

            </div>

            <div class="col-lg-6"> 
                <select name="jns_ins" id="jns_ins" class="form-control">
                        <option value="" disababled selected>Jenis Jadwal</option>
                        <option value="Inspeksi Hardware">Inspeksi Hardware</option>
                </select>
            </div>
            
            <div class="col-lg-12" style="margin-top:10px;"></div>

            <div class="col-lg-6"> 
                <input type="text" name="est_mulai" id="est_mulai" class="form-control" placeholder="Mulai">
            </div>

            <div class="col-lg-6"> 
                <input type="number" name="est_hari" id="est_hari" class="form-control" placeholder="Rentang Hari">
            </div>

            <div class="col-lg-12" style="margin-top:10px;">
                <button type="button" class="btn btn-danger">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>

        </div>
        
        </div>

    </form>

</div>

<link rel="stylesheet" href="<?php echo base_url();?>dt_picker/css/bootstrap-datepicker.css">
<script src="<?php echo base_url();?>dt_picker/js/bootstrap-datepicker.js"></script>

    <?php
        $lokasi = $detail->row()->lokasi;
        $jenis = $detail->row()->jenis;
        $est_mulai = $detail->row()->est_mulai;
        $est_hari = $detail->row()->est_hari;
    ?>

<script>

$('#est_mulai').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    }
);

$("#bag").val("<?php echo $lokasi; ?>");
$("#jns_ins").val("<?php echo $jenis; ?>");
$("#est_mulai").val("<?php echo $est_mulai ?>");
$("#est_hari").val("<?php echo $est_hari; ?>");

</script>
    
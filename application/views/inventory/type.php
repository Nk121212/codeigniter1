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
            <h3 class="page-header">Type List</h3>
        </div>
    </div>

    <div class="col-lg-12">
        <?php 
            error_reporting(0);
            echo $error;
            echo $hapus;
        ?>

        <button class="btn btn-success" data-toggle="modal" data-target="#type_modal"><i class="fa fa-plus"></i> Tambah Type</button>
        <br>
        <br>
        
        <div class="table-responsive">
        
            <table class="table table-striped" id="tbl_type">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Type</th>
                        <th style="text-align:center;">Kategori</th>
                        <th style="text-align:center;">Status</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                        $qmerk = $this->db->query("
                            select id,nama_type, 
                            CASE
                                WHEN status = 0 THEN 'Non Aktif'
                                ELSE 'Aktif'
                            END
                            AS stat,
                            CASE
                                WHEN kat = 1 THEN 'Processor'
                                WHEN kat = 2 THEN 'Memory'
                                WHEN kat = 3 THEN 'Hardisk'
                                WHEN kat = 4 THEN 'Keyboard'
                                WHEN kat = 5 THEN 'Mouse'
                                WHEN kat = 6 THEN 'Monitor'
                                WHEN kat = 7 THEN 'Printer'
                                ELSE '-'
                            END
                            AS kategori
                            from master_type
                            where hapus IS NULL
                            order by nama_type asc
                        ");

                        $total_rec = $qmerk->num_rows();

                        if($total_rec < 1){
                            echo '
                            <tr>
                                <td colspan="4">No Data !</td>
                            </tr>
                        ';
                        }else{

                            $no = 1;
                            foreach($qmerk->result() as $dm){
                                $id = $dm->id;
                                if($dm->stat == 'Non Aktif'){
                                    $stat1 = '
                                        <i style="color:red;" class="fa fa-times"></i>
                                    ';
                                    $button = '
                                        <a href="'.base_url().'index.php/C_type/ganti_status/'.$id.'" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Aktifkan</a>
                                    ';
                                }else{
                                    $stat1 = '
                                        <i style="color:green;" class="fa fa-check"></i>
                                    ';
                                    $button = '
                                    <a href="'.base_url().'index.php/C_type/ganti_status/'.$id.'" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Non-Aktifkan</a>
                                    ';
                                }
                                echo '
                                    <tr>
                                        <td style="text-align:center;">'.$no.'</td>
                                        <td style="text-align:center;">'.$dm->nama_type.'</td>
                                        <td style="text-align:center;">'.$dm->kategori.'</td>
                                        <td style="text-align:center;">'.$stat1.'</td>
                                        <td style="text-align:center;">
                                            <a href="'.base_url().'index.php/C_type/del_type/'.$id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                            '.$button.'
                                        </td>
                                    </tr>
                                ';
                                $no ++;
                            }

                        }
                    ?>

                </tbody>
            </table>

        </div>
        

        <!-- Modal -->
        <div class="modal fade" id="type_modal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Type</h4>
                </div>

                <form action="<?php echo base_url();?>index.php/C_type/add_type" method="post">
                
                    <div class="modal-body">
                        Type : <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="type" id="type" class="form-control" placeholder="Input Nama Type" required>
                        
                        Kategori : 
                        <select name="kat" id="kat" class="form-control" required>
                            <?php 
                            echo '
                                <option value="" disabled selected>Pilih Kategori</option>
                            ';

                            $q_kat = $this->db->query("
                                select * from reff_kat_type
                            ");

                                foreach($q_kat->result() as $rd){
                                    echo '
                                        <option value="'.$rd->id.'">'.$rd->nama_kat.'</option>
                                    ';
                                }

                            ?>
                        </select>

                        Status : 
                        <select name="status" id="status" class="form-control" required>
                            <option value="" disabled selected>Status</option>
                            <option value="0">Non Aktif</option>
                            <option value="1">Aktif</option>
                        </select>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
            
            </div>
        </div>


    </div>

</div>

<script>
$(document).ready(function() {
    $('#tbl_type').DataTable();
});
</script>


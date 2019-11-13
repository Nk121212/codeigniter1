<style>
.mt {
    margin-top:10px;
}
</style>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">User PC</h3>
        </div>
    </div>

    <div class="col-lg-12">
        <?php 
            error_reporting(0);
            echo $error;
            echo $hapus;
        ?>

        <button class="btn btn-success" data-toggle="modal" data-target="#user_pm"><i class="fa fa-plus"></i> Tambah User PC</button>
        <br>
        <br>

        <?php echo "<h4>$error_insert</h4><br>";?>
        <?php echo "<h4>$error_update</h4><br>";?>

        <div class="modal fade" id="user_pm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New User PC</h4>
                    </div>

                    <form id="Form1" action="<?php echo base_url('index.php/C_pc/add_user_pc'); ?>" method="post">
                        <div class="modal-body">  

                            <table class="table table-borderless">
                                <tr>
                                    <th><input onkeyup="this.value = this.value.toUpperCase();" type="text" name="nm_user" id="nm_user" class="form-control" style="text-transform: uppercase;" placeholder = "Nama User PC"></th>
                                </tr>
                            </table>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                        </div>

                    </form> 

                </div>
            </div>

        </div>

        <div class="col-lg-12 table-responsive">
            <table id="tbl_up" class="table table-striped">
                <thead>
                    <tr>    
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        $qdup = $this->db->query("
                            select * from user_pc order by user_pc asc;
                        ");

                        $no = 1;
                        foreach($qdup->result() as $dtup){
                            echo '
                                <tr>
                                    <td>'.$no.'</td>
                                    <td>'.$dtup->user_pc.'</td>
                                    <td><a type="button" class="btn btn-warning" href="'.base_url().'index.php/C_pc/edit_user_pc/'.$dtup->id.'">Edit</a></td>
                                </tr>
                                    ';

                                $no++;
                        }

                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tbl_up').DataTable();
});
</script>


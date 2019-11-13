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
            <h3 class="page-header">Memory List</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <?php 
        error_reporting(0);
        echo $error;
        ?>

        <button class="btn btn-success" data-toggle="modal" data-target="#merk_modal"><i class="fa fa-plus"></i> Tambah Memory</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#stok_modal"><i class="fa fa-plus"></i> Tambah Stok</button>
        <br>
        <br>
        
        <div class="table-responsive">
        

            <table class="table table-striped" id="tbl_merk">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Merk</th>
                        <th style="text-align:center;">Type</th>
                        <th style="text-align:center;">Size</th>
                        <th style="text-align:center;">Stok</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                        $qproc = $this->db->query("
                        select a.*, 
                            case 
                                when a.byte = 1 then 'KB'
                                when a.byte = 2 then 'MB'
                                when a.byte = 3 then 'GB'
                                when a.byte = 4 then 'TB'
                            end 
                            as byte1,
                        b.nama_type, c.nama_merk
                        from tbl_memory a
                        left join master_type b
                        on a.`type` = b.id
                        left join master_merk c
                        on a.merk = c.id
                        where a.hapus IS NULL
                        order by a.kapasitas asc
                        ");

                        $total_rec = $qproc->num_rows();

                        if($total_rec < 1){
                            echo '
                            <tr>
                                <td colspan="5">No Data !</td>
                            </tr>
                        ';
                        }else{

                            $no = 1;
                            foreach($qproc->result() as $dproc){
                                $id = $dproc->id;
                                echo '
                                    <tr>
                                        <td style="text-align:center;">'.$no.'</td>
                                        <td style="text-align:center;">'.$dproc->nama_merk.'</td>
                                        <td style="text-align:center;">'.$dproc->nama_type.'</td>
                                        <td style="text-align:center;">'.$dproc->kapasitas.' '.$dproc->byte1.'</td>
                                        <td style="text-align:center;">'.$dproc->stok.'</td>
                                        <td style="text-align:center;">
                                            <a href="'.base_url().'index.php/C_memory/del_memory/'.$id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="'.base_url().'index.php/C_memory/edit_page/'.$id.'" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Edit</a>
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
        <div class="modal fade" id="merk_modal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Memory</h4>
                </div>

                <form action="<?php echo base_url();?>index.php/C_memory/add_memory" method="post">
                
                    <div class="modal-body">

                        <table class="table">
                            <thead>
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
                                                    select * from master_type where hapus is null and status = 1 and kat = 2
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
                                        <input type="text" name="kapasitas" id="kapasitas" class="form-control" placeholder="Ex. 8">
                                    </th>
                                    <th>    
                                        <select name="byte" id="byte" class="form-control">
                                            <option value="" disabled selected>Pilih Byte</option>
                                            <option value="1">KiloByte (KB)</option>
                                            <option value="2">MegaByte (MB)</option>
                                            <option value="3">GigaByte (GB)</option>
                                            <option value="4">TeraByte (TB)</option>
                                        </select>
                                    </th>
                                </tr>
                            </thead>
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


        <!-- Modal -->
        <div class="modal fade" id="stok_modal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Memory</h4>
                </div>

                <form action="<?php echo base_url();?>index.php/C_memory/add_stok" method="post">
                
                    <div class="modal-body">
                        Memory :
                        <select name="id_mem" id="id_mem" class="form-control" required>
                           <option value="" disabled selected>Pilih Memory</option>    
                           <?php 
                            $qmem = $this->db->query("
                                select a.id, b.nama_merk, c.nama_type, a.kapasitas, 
                                case 
                                when a.byte = 1 then 'KB'
                                when a.byte = 2 then 'MB'
                                when a.byte = 3 then 'GB'
                                when a.byte = 4 then 'TB'
                                end as byte1
                                
                                from tbl_memory a
                                
                                left join master_merk b on a.merk = b.id
                                left join master_type c on a.`type` = c.id
                                
                                where a.hapus IS NULL
                            ");

                            foreach($qmem->result() as $dm){
                                echo '
                                <option value = "'.$dm->id.'">
                                '.$dm->nama_merk.' - '.$dm->nama_type.' '.$dm->kapasitas.' '.$dm->byte1.'
                                </option>
                                ';
                            }
                           ?>                 
                        </select>
                        
                        Stok :
                        <input type="text" name="mem_stok" id="mem_stok" class="form-control">

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
    $('#tbl_merk').DataTable();
});
</script>


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
            <h3 class="page-header">CPU List</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <button class="btn btn-success" data-toggle="modal" data-target="#merk_modal"><i class="fa fa-plus"></i> Tambah CPU</button>
        <br>
        <br>

        <?php 
        error_reporting(0);
        echo $error;
        ?>
        
        <div class="table-responsive">
        

            <table class="table table-striped" id="tbl_merk">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Processor</th>
                        <th style="text-align:center;">Memory</th>
                        <th style="text-align:center;">Hardisk</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                        $qproc = $this->db->query("
                            select * from master_cpu where hapus IS NULL and used = 0 order by id asc
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

                                $id_proc = $dproc->id_processor;
                                $id_mem = $dproc->id_memory;
                                $id_hdd = $dproc->id_hardisk;

                                $hip = substr_count($id_proc, ",");
                                $tip = ($hip) + 1;
                                $exp_proc = explode(",",$id_proc);

                                $him = substr_count($id_mem, ",");
                                $tim = ($him) + 1;
                                $exp_mem = explode(",",$id_mem);

                                $hih = substr_count($id_hdd, ",");
                                $tihdd = ($hih) + 1;
                                $exp_hdd = explode(",",$id_hdd);
                                
                                echo '
                                <tr>
                                    <td style="text-align:center;">'.$no.'</td>
                                    ';
                                
                                echo '
                                    <td style="text-align:center;">
                                ';
                                $zh = 0;
                                for($zh = 0; $zh < $tip; $zh++){
                                    $arr_expp = $exp_proc[$zh];
                                    $qproc2 = $this->db->query("
                                        select * from tbl_processor a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        where a.id = '$arr_expp' and a.hapus IS NULL;
                                    ");

                                    $mtkb = "";
                                    foreach($qproc2->result() as $dtproc){
                                        echo $mtkb .= $dtproc->nama_merk." ".$dtproc->nama_type." ".$dtproc->clock." ".$dtproc->hertz."</br>";
                                    }

                                }

                                echo '
                                    </td>
                                ';

                                echo '
                                <td style="text-align:center;">
                                ';
                                $zh2 = 0;
                                for($zh2 = 0; $zh2 < $tim; $zh2++){
                                    $arr_expm = $exp_mem[$zh2];
                                    $qmem = $this->db->query("
                                        select a.*,b.nama_merk as merk,c.nama_type as type, a.kapasitas as size,
                                        CASE
                                        WHEN a.byte = 1 THEN 'KB'
                                        WHEN a.byte = 2 THEN 'MB'
                                        WHEN a.byte = 3 THEN 'GB'
                                        WHEN a.byte = 4 THEN 'TB'
                                        END
                                        as byte2
                                        from tbl_memory a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        where a.id = '$arr_expm' and a.hapus IS NULL;
                                    ");

                                    $mtkb2 = "";
                                    foreach($qmem->result() as $dtmem){
                                        echo $mtkb2 .= $dtmem->nama_merk." ".$dtmem->nama_type." ".$dtmem->kapasitas." ".$dtmem->byte2."</br>";
                                    }

                                }

                                echo '
                                    </td>
                                ';

                                echo '
                                    <td style="text-align:center;">
                                ';
                                $zh3 = 0;
                                for($zh3 = 0; $zh3 < $tihdd; $zh3++){
                                    $arr_exph = $exp_hdd[$zh3];
                                    $qhdd = $this->db->query("
                                        select a.*, b.nama_merk, c.nama_type,
                                        CASE
                                        WHEN a.byte = 1 THEN 'KB'
                                        WHEN a.byte = 2 THEN 'MB'
                                        WHEN a.byte = 3 THEN 'GB'
                                        WHEN a.byte = 4 THEN 'TB'
                                        END
                                        as byte3
                                        from tbl_hardisk a 
                                        left join master_merk b on a.merk = b.id
                                        left join master_type c on a.`type` = c.id
                                        where a.id = '$arr_exph' and a.hapus IS NULL;
                                    ");

                                    $mtkb3 = "";
                                    foreach($qhdd->result() as $dthdd){
                                        echo $mtkb3 .= $dthdd->nama_merk." ".$dthdd->nama_type." ".$dthdd->kapasitas." ".$dthdd->byte3."</br>";
                                    }

                                }

                                echo '
                                    </td>
                                ';

                                echo'
                                    <td style="text-align:center;">
                                        <a href="'.base_url().'index.php/C_cpu/del_cpu/'.$id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                        <a href="'.base_url().'index.php/C_cpu/edit_page/'.$id.'" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Edit</a>
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
                    <h4 class="modal-title">Add New CPU</h4>
                </div>

                <form action="<?php echo base_url();?>index.php/C_cpu/add_cpu2" method="post">
                
                    <div class="modal-body">

                        <table class="table">
                            <tr>
                                <th id="sec_proc">    
                                    <label for=""> Processor : </label> 
                                    <button style="margin-left:50px;" type="button" id="add_proc" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i></span></button>
                                        <?php 
                                            $qmerk = $this->db->query("
                                                select a.id, a.hertz, b.nama_merk, c.nama_type, a.clock
                                                
                                                from tbl_processor a 
                                                
                                                left join master_merk b on a.merk = b.id 
                                                left join master_type c on a.`type` = c.id
                                                
                                                where a.hapus is null
                                                order by b.nama_merk asc
                                            ");

                                            echo '
                                                <select name="proc[]" id="proc" class="form-control" required>
                                            ';

                                            echo '
                                                <option value="" disabled selected>Pilih Processor</option>
                                            ';

                                            foreach($qmerk->result() as $dproc){
                                                echo '
                                                    <option value="'.$dproc->id.'">'.$dproc->nama_merk.' - '.$dproc->nama_type.' '.$dproc->clock.'  '.$dproc->hertz.'</option>
                                                ';
                                                $val_proc .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' - '.$dproc->nama_type.' '.$dproc->clock.'  '.$dproc->hertz.'</option>';
                                            }
                                            echo '
                                                </select>
                                            ';

                                        ?>
                                        
                                </th>
                            </tr>
                            <tr>
                                <th id="sec_mem">
                                    <label for="">Memory :</label> 
                                    <button style="margin-left:65px;" type="button" id="add_mem" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i></span></button>
                                    <select name="memory[]" id="memory" class="form-control" required>
                                        <?php 
                                            $qmerk = $this->db->query("
                                                select a.id, b.nama_merk as merk, c.nama_type as type, a.kapasitas as ram, 
                                                case 
                                                when a.byte = 1 then 'KB'
                                                when a.byte = 2 then 'MB'
                                                when a.byte = 3 then 'GB'
                                                when a.byte = 4 then 'TB'
                                                end as byte1
                                                
                                                from tbl_memory a 
                                                
                                                left join master_merk b on a.merk = b.id 
                                                left join master_type c on a.`type` = c.id 
                                                
                                                where a.hapus is null
                                                order by b.nama_merk asc
                                            ");

                                            echo '
                                                <option value="" disabled selected>Pilih Memory</option>
                                            ';

                                            foreach($qmerk->result() as $dproc){
                                                echo '
                                                    <option value="'.$dproc->id.'">'.$dproc->merk.' - '.$dproc->type.' '.$dproc->ram.' '.$dproc->byte1.' </option>
                                                ';
                                                $val_mem .= '<option value="'.$dproc->id.'">'.$dproc->merk.' - '.$dproc->type.' '.$dproc->ram.' '.$dproc->byte1.' </option>';
                                            }

                                        ?>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th id = "sec_hdd">
                                    <label for="">Hardisk :</label> 
                                    <button style="margin-left:66px;" type="button" id="add_hdd" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i></span></button>
                                    <select name="hardisk[]" id="hardisk" class="form-control" required>
                                        <?php 
                                            $qmerk = $this->db->query("
                                                select a.id, b.nama_merk , c.nama_type, a.kapasitas,
                                                case 
                                                    when a.byte = 1 then 'KB'
                                                    when a.byte = 2 then 'MB'
                                                    when a.byte = 3 then 'GB'
                                                    when a.byte = 4 then 'TB'
                                                end
                                                as byte1
                                            
                                                from tbl_hardisk a 
                                            
                                                left join master_merk b on a.merk = b.id
                                                left join master_type c on a.`type` = c.id 
                                            
                                                where a.hapus is null
                                                order by b.nama_merk asc
                                            ");

                                            echo '
                                                <option value="" disabled selected>Pilih Hardisk</option>
                                            ';

                                            foreach($qmerk->result() as $dproc){
                                                echo '
                                                    <option value="'.$dproc->id.'">'.$dproc->nama_merk.' - '.$dproc->nama_type.' '.$dproc->kapasitas.' '.$dproc->byte1.'</option>
                                                ';
                                                $val_hdd .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' - '.$dproc->nama_type.' '.$dproc->kapasitas.' '.$dproc->byte1.'</option>';
                                            }

                                        ?>
                                    </select>
                                </th>
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


    </div>

</div>

<script>

$(document).ready(function() {
    $('#tbl_merk').DataTable();
});

//add/del processor
var div = document.getElementById('sec_proc');

function addProc() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_proc;?>';
    input.name = 'proc[]';
    input.id = 'id_processor';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removeProc;
  
    div.appendChild(input);
    div.appendChild(button);
}

function removeProc() {
  // remove this button and its input
  div.removeChild(this.previousElementSibling);
  div.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_proc').addEventListener('click', addProc);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_proc').addEventListener('click', removeProc);

// end of add/del processor

//add/del memory
var div2 = document.getElementById('sec_mem');

function addMem() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_mem;?>';
    input.name = 'memory[]';
    input.id = 'memory';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removeMem;
  
    div2.appendChild(input);
    div2.appendChild(button);
}

function removeMem() {
  // remove this button and its input
  div2.removeChild(this.previousElementSibling);
  div2.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_mem').addEventListener('click', addMem);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_mem').addEventListener('click', removeMem);

// end of add/del memory

//add/del hdd
var div3 = document.getElementById('sec_hdd');

function addHdd() {
    var input = document.createElement('select'),
    button = document.createElement('button');
  
    //input.placeholder = "More hobbies";
    input.innerHTML = '<?php echo $val_hdd;?>';
    input.name = 'hardisk[]';
    input.id = 'hardisk';
    input.setAttribute("class", "form-control");
    
    button.setAttribute("class", "btn btn-sm btn-danger");
    button.innerHTML = '<i class="fa fa-minus"></i>';
    // attach onlick event handler to remove button
    button.onclick = removeHdd;
  
    div3.appendChild(input);
    div3.appendChild(button);
}

function removeHdd() {
  // remove this button and its input
  div3.removeChild(this.previousElementSibling);
  div3.removeChild(this);
}

// attach onclick event handler to add button
document.getElementById('add_hdd').addEventListener('click', addHdd);
// attach onclick event handler to 1st remove button
//document.getElementById('remove_mem').addEventListener('click', removeMem);

// end of add/del hdd

</script>
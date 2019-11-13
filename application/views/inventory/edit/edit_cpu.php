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
            <h3 class="page-header">Edit CPU</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <form action="<?php echo base_url();?>index.php/C_cpu/update_cpu" method="post">

            <input type="text" name="id" value="<?php echo $id;?>" hidden>
                    
            <div class="modal-body">

                <table class="table">
                    <tr>
                        <th>Processor : 
                            <button style="margin-left:50px;" type="button" id="add_proc" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i></span></button>
                        </th>
                    </tr>

                    <tr>
                    <th id="div_proc">
                        <?php 
                            $hip = substr_count($id_processor, ",");
                            $tiproc = ($hip) + 1;
                            $exp_proc = explode(",", $id_processor);

                            $i = 0;
                            for ($i = 0; $i < $tiproc; $i++) {
                                $expp = $exp_proc[$i];
                                $qmerk = $this->db->query("
                                    select a.id, b.nama_merk, c.nama_type, a.clock
                                    
                                    from tbl_processor a 
                                    
                                    left join master_merk b on a.merk = b.id 
                                    left join master_type c on a.`type` = c.id
                                    
                                    where a.hapus is null
                                    order by b.nama_merk asc
                                ");

                                echo '
                                    <input type="text" id="id_processor'.$i.'" value="'.$expp.'" hidden>
                                ';

                                echo '
                                    <select name="proc[]" id="proc'.$i.'" class="form-control" required>
                                ';

                                echo '
                                    <option value="" disabled selected>Pilih Processor</option>
                                ';
                                $val_proc = "";
                                foreach($qmerk->result() as $dproc){
                                    echo '
                                        <option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.' '.$dproc->clock.'</option>
                                    ';

                                    $val_proc .= '<option value="'.$dproc->id.'">'.$dproc->nama_merk.' '.$dproc->nama_type.' '.$dproc->clock.'</option>';
                                }

                                echo '
                                    </select>
                                ';

                                echo '
                                    <button type="button" class="btn btn-sm btn-danger" id="btn_proc'.$i.'"> <i class="fa fa-minus"></i></button>
                                ';

                                echo '
                                    <script>
                                        var idproc = $("#id_processor'.$i.'").val();
                                        $("#proc'.$i.'").val(idproc).trigger("change");
                                        $("#btn_proc'.$i.'").click(function(){
                                            $("#proc'.$i.'").remove();
                                            $("#btn_proc'.$i.'").remove();
                                        })
                                    </script>
                                ';
                            }
                        ?>
                        </th>
                    </tr>

                    <tr>
                        <th>Memory :
                            <button style="margin-left:65px;" type="button" id="add_mem" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i></span></button>
                        </th>
                    </tr>

                    <tr>

                        <th id="div_mem">

                        <?php 
                            $him = substr_count($id_memory, ",");
                            $tim = ($him) + 1;
                            $exp_mem = explode(",", $id_memory);

                            $i = 0;
                            for ($i = 0; $i < $tim; $i++) {
                                $expm = $exp_mem[$i];
                                $qmem = $this->db->query("
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
                                    <input type="text" id="id_memory'.$i.'" value="'.$expm.'" hidden>
                                ';

                                echo '
                                    <select name="memory[]" id="memory'.$i.'" class="form-control" required>
                                ';

                                echo '
                                    <option value="" disabled selected>Pilih Memory</option>
                                ';
                                $val_mem = "";
                                foreach($qmem->result() as $dtmem){
                                    echo '
                                        <option value="'.$dtmem->id.'">'.$dtmem->merk.' '.$dtmem->type.' '.$dtmem->ram.' '.$dtmem->byte1.'</option>
                                    ';
                                    $val_mem .= '<option value="'.$dtmem->id.'">'.$dtmem->merk.' '.$dtmem->type.' '.$dtmem->ram.' '.$dtmem->byte1.'</option>';
                                }

                                echo '
                                    </select>
                                ';

                                echo '
                                    <button type="button" class="btn btn-sm btn-danger" id="btn_mem'.$i.'"> <i class="fa fa-minus"></i></button>
                                ';
                                echo '
                                    <script>
                                        var idmem = $("#id_memory'.$i.'").val();
                                        $("#memory'.$i.'").val(idmem).trigger("change");
                                        $("#btn_mem'.$i.'").click(function(){
                                            $("#memory'.$i.'").remove();
                                            $("#btn_mem'.$i.'").remove();
                                        })
                                    </script>
                                ';
                            }
                        ?>
                        </th>
                    </tr>
                    <tr>
                        <th>Hardisk :
                            <button style="margin-left:66px;" type="button" id="add_hdd" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i></span></button>
                        </th>
                    </tr>
                    <tr>
                        <th id="div_hdd">
                        <?php 
                            $hih = substr_count($id_hardisk, ",");
                            $tih = ($hih) + 1;
                            $exp_hdd = explode(",", $id_hardisk);

                            $i = 0;
                            for ($i = 0; $i < $tih; $i++) {
                                $exph = $exp_hdd[$i];
                                $qhdd = $this->db->query("
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
                                    <input type="text" id="id_hardisk'.$i.'" value="'.$exph.'" hidden>
                                ';

                                echo '
                                    <select name="hardisk[]" id="hardisk'.$i.'" class="form-control" required>
                                ';

                                echo '
                                    <option value="" disabled selected>Pilih Hardisk</option>
                                ';
                                $val_hdd = "";
                                foreach($qhdd->result() as $dthdd){
                                    echo '
                                        <option value="'.$dthdd->id.'">'.$dthdd->nama_merk.' '.$dthdd->nama_type.' '.$dthdd->kapasitas.' '.$dthdd->byte1.'</option>
                                    ';
                                    $val_hdd .= '<option value="'.$dthdd->id.'">'.$dthdd->nama_merk.' '.$dthdd->nama_type.' '.$dthdd->kapasitas.' '.$dthdd->byte1.'</option>';
                                }

                                echo '
                                    </select>
                                ';

                                echo '
                                    <button type="button" id="btn_hdd'.$i.'" class="btn btn-sm btn-danger"> <i class="fa fa-minus"></i></span></button>
                                ';
                                echo '
                                    <script>
                                        var idhdd = $("#id_hardisk'.$i.'").val();
                                        $("#hardisk'.$i.'").val(idhdd).trigger("change");
                                        $("#btn_hdd'.$i.'").click(function(){
                                            $("#hardisk'.$i.'").remove();
                                            $("#btn_hdd'.$i.'").remove();
                                        }) 
                                    </script>
                                ';
                            }
                        ?>
                        </th>
                    </tr>
                
                </table>

            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url();?>index.php/C_cpu/view_cpu" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>

</div>

<script>
    //add/del processor
    var div = document.getElementById('div_proc');

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

    //add/del memory
var div2 = document.getElementById('div_mem');

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
var div3 = document.getElementById('div_hdd');

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


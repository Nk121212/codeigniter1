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
            <h3 class="page-header">Edit PC</h3>
        </div>
    </div>

    <div class="col-lg-12">

        <form action="<?php echo base_url();?>index.php/C_pc/update_pc" method="post">

            <input type="text" name="id" value="<?php echo $id;?>" hidden>
                    
            <div class="modal-body">

                <div class="col-sm-12">
                    </br>
                
                    Nama PC :
                    <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="nm_pc" id="nm_pc" class="form-control" value="<?php echo $nama_pc;?>">
                    
                </div>
                
                <div class="col-sm-12">
                    <input type="text" name="bef_cpu" id="bef_cpu" value="<?php echo $cpu;?>" hidden>
                    </br>
                    CPU :
                    <?php 

                    echo '
                        <select name="cpu" id="cpu" class="form-control" required>
                    ';

                    echo '
                        <option value="" disabled selected>Pilih CPU</option>
                    ';
                    //echo 'a';
                    $qcpu = $this->db->query("
                        select * from master_cpu where hapus is null and used = 0 OR id = '$cpu';
                    ");

                    foreach($qcpu->result() as $dtcpu){
                        $idcpu = $dtcpu->id;

                        $id_processor = $dtcpu->id_processor;
                        
                        $sc_proc = substr_count($id_processor, ",");
                        $tc_proc = ($sc_proc) + 1;
                        $exp_proc = explode(",",$id_processor);

                        echo '<option value="'.$idcpu.'">';

                        echo 'PROCESSOR : ';
                        for($tproc = 0; $tproc < $tc_proc; $tproc ++){
                            $arr_idproc = $exp_proc[$tproc];
                            $qproc = $this->db->query("
                                select a.*,b.nama_merk,c.nama_type 
                                from tbl_processor a 
                                left join master_merk b on a.merk = b.id
                                left join master_type c on a.type = c.id
                                where a.id = '$arr_idproc'
                            ");

                            foreach($qproc->result() as $dtproc){
                                echo $dtproc->nama_merk." ".$dtproc->nama_type." ".$dtproc->clock." ".$dtproc->hertz.", ";
                            }
                        }

                        $id_memory = $dtcpu->id_memory;
                        $sc_mem = substr_count($id_memory,",");
                        $tc_mem = ($sc_mem) + 1;
                        $exp_mem = explode(",",$id_memory);

                        echo 'RAM : ';

                        for($tmem=0;$tmem<$tc_mem;$tmem++){
                            $arr_idmem = $exp_mem[$tmem];
                            $qmem = $this->db->query("
                                select a.*, b.nama_merk, c.nama_type,
                                CASE
                                WHEN a.byte = 1 THEN 'KB'
                                WHEN a.byte = 2 THEN 'MB'
                                WHEN a.byte = 3 THEN 'GB'
                                WHEN a.byte = 4 THEN 'TB'
                                END AS byte1
                                from tbl_memory a 
                                left join master_merk b on a.merk = b.id
                                left join master_type c on a.type = c.id
                                where a.id = '$arr_idmem'
                            ");

                            foreach($qmem->result() as $dtmem){
                                echo $dtmem->nama_merk." ".$dtmem->nama_type." ".$dtmem->kapasitas." ".$dtmem->byte1.", ";
                            }
                        }

                        $id_hardisk = $dtcpu->id_hardisk;
                        $sc_hdd = substr_count($id_hardisk,",");
                        $tc_hdd = ($sc_hdd) + 1;
                        $exp_hdd = explode(",",$id_hardisk);

                        echo 'HDD : ';
                        for($thdd=0;$thdd<$tc_hdd;$thdd++){
                            $arr_hdd = $exp_hdd[$thdd];
                            $qhdd = $this->db->query("
                                select a.*,b.nama_merk,c.nama_type,
                                CASE
                                WHEN a.byte = 1 THEN 'KB'
                                WHEN a.byte = 2 THEN 'MB'
                                WHEN a.byte = 3 THEN 'GB'
                                WHEN a.byte = 4 THEN 'TB'
                                END AS byte1
                                from tbl_hardisk a 
                                left join master_merk b on a.merk = b.id
                                left join master_type c on a.type = c.id
                                where a.id = '$arr_hdd'
                            ");

                            foreach($qhdd->result() as $dthdd){
                                echo $dthdd->nama_merk." ".$dthdd->nama_merk." ".$dthdd->kapasitas." ".$dthdd->byte1;
                            }

                        }

                        echo '</option>';

                    }

            echo '</select>';

            ?>

            </div>
                        
            <div class="col-sm-12">
                    
                </br>
                    
                <div class="panel panel-default">
                    <div class="panel-body" id="div_mouse">

                        Mouse : <button type="button" id="add_mouse" style="margin-left: 50px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                        
                        <?php 
                        $sc_mouse = substr_count($mouse,",");
                        $tc_mouse = ($sc_mouse) + 1;
                        $exp_mouse = explode(",",$mouse);

                        for($tmouse=0;$tmouse<$tc_mouse;$tmouse++){

                            $arr_mouse = $exp_mouse[$tmouse];

                            echo '<select name="mouse[]" id="mouse'.$tmouse.'" class="form-control" required>';

                                $qmouse = $this->db->query("
                                    select a.id, b.nama_merk, c.nama_type
                                    
                                    from tbl_mouse a 
                                    left join master_merk b on a.merk = b.id
                                    left join master_type c on a.`type` = c.id
                                    
                                    where a.hapus is null;
                                ");

                                echo '
                                    <option value="" disabled selected>Pilih Mouse</option>
                                ';
                                $val_mouse = "";
                                foreach($qmouse->result() as $dtmouse){
                                    echo '
                                        <option value="'.$dtmouse->id.'">'.$dtmouse->nama_merk.' '.$dtmouse->nama_type.'</option>
                                    ';
                                    $val_mouse .= '<option value="'.$dtmouse->id.'">'.$dtmouse->nama_merk.' '.$dtmouse->nama_type.'</option>'; 
                                }
                            echo '</select>';
                            echo '<button id="btn_mouse'.$tmouse.'" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>';
                            echo '
                                <script>
                                    $("#mouse'.$tmouse.'").val('.$arr_mouse.');
                                    $("#btn_mouse'.$tmouse.'").click(function(){
                                        $("#mouse'.$tmouse.'").remove();
                                        $("#btn_mouse'.$tmouse.'").remove();
                                    })
                                </script>
                            ';
                        }
                        ?>

                    </div>
                </div>
                
            </div>
                    
            <div class="col-sm-12">

                </br>
                    
                <div class="panel panel-default">
                    <div class="panel-body" id="div_keyboard">

                        Keyboard : <button type="button" id="add_keyboard" style="margin-left: 32px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>

                        <?php 
                        $sc_keyboard = substr_count($keyboard,",");
                        $tc_keyboard = ($sc_keyboard) + 1;
                        $exp_keyboard = explode(",",$keyboard);

                        for($tkey=0;$tkey<$tc_keyboard;$tkey++){

                            $arr_key = $exp_keyboard[$tkey];
                            echo '
                            <select name="keyboard[]" id="keyboard'.$tkey.'" class="form-control" required>
                            ';
                                $qkey = $this->db->query("
                                    select a.id, b.nama_merk, c.nama_type
                                    
                                    from tbl_keyboard a 
                                    left join master_merk b on a.merk = b.id
                                    left join master_type c on a.`type` = c.id
                                    
                                    where a.hapus is null;
                                ");

                                echo '
                                    <option value="" disabled selected>Pilih Keyboard</option>
                                ';
                                $val_keyboard = "";
                                foreach($qkey->result() as $dkey){
                                    echo '
                                        <option value="'.$dkey->id.'">'.$dkey->nama_merk.' '.$dkey->nama_type.'</option>
                                    ';
                                    $val_keyboard .= '<option value="'.$dkey->id.'">'.$dkey->nama_merk.' '.$dkey->nama_type.'</option>';
                                }
                                echo '</select>';
                                echo '<button id="btn_key'.$tkey.'" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>';
                                echo '
                                    <script>
                                        $("#keyboard'.$tkey.'").val('.$arr_key.');
                                        $("#btn_key'.$tkey.'").click(function(){
                                            $("#keyboard'.$tkey.'").remove();
                                            $("#btn_key'.$tkey.'").remove();
                                        })
                                    </script>
                                ';
                        }
                        ?>

                    </div>
                </div>
                
            </div>
                        

            <div class="col-sm-12">

                </br>
                        
                <div class="panel panel-default">
                    <div class="panel-body" id="div_monitor">

                        Monitor : <button type="button" id="add_monitor" style="margin-left: 45px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>

                        <?php
                            $sc_mon = substr_count($monitor,",");
                            $tc_mon = ($sc_mon) + 1; 
                            $exp_mon = explode(",",$monitor);

                            for($tmon=0;$tmon<$tc_mon;$tmon++){

                                $arr_mon = $exp_mon[$tmon];

                                echo '
                                <select name="monitor[]" id="monitor'.$tmon.'" class="form-control" required>
                                ';
                                $qmonitor = $this->db->query("
                                    select a.id, b.nama_merk, c.nama_type, a.inches
                                    
                                    from tbl_monitor a 
                                    left join master_merk b on a.merk = b.id
                                    left join master_type c on a.`type` = c.id
                                    
                                    where a.hapus is null;
                                ");

                                echo '
                                    <option value="" disabled selected>Pilih Monitor</option>
                                ';
                                $val_monitor = "";
                                foreach($qmonitor->result() as $dmon){
                                    echo '
                                        <option value="'.$dmon->id.'">'.$dmon->nama_merk.' '.$dmon->nama_type.' `'.$dmon->inches.'</option>
                                    ';
                                    $val_monitor .= '<option value="'.$dmon->id.'">'.$dmon->nama_merk.' '.$dmon->nama_type.' `'.$dmon->inches.'</option>';
                                }

                                echo '</select>';
                                echo '<button id="btn_mon'.$tmon.'" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>';
                                echo '
                                    <script>
                                        $("#monitor'.$tmon.'").val('.$arr_mon.');
                                        $("#btn_mon'.$tmon.'").click(function(){
                                            $("#monitor'.$tmon.'").remove();
                                            $("#btn_mon'.$tmon.'").remove();
                                        })
                                    </script>
                                ';
                            }

                        ?>

                    </div>
                </div>
                
            </div>
                        
            <div class="col-sm-12">
                            
                </br>
                        
                <div class="panel panel-default">
                    <div class="panel-body" id="div_printer">

                        Printer : <button type="button" id="add_printer" style="margin-left: 50px;" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                        <?php
                            $sc_print = substr_count($printer,",");
                            $tc_print = ($sc_print) + 1;
                            $exp_print = explode(",",$printer);

                            for($tprint=0;$tprint<$tc_print;$tprint++){

                                $arr_print = $exp_print[$tprint];
                                echo '
                                    <select name="printer[]" id="printer'.$tprint.'" class="form-control" required>
                                ';

                                $qprint = $this->db->query("
                                    select a.id, b.nama_merk, c.nama_type
                                    
                                    from tbl_printer a 
                                    left join master_merk b on a.merk = b.id
                                    left join master_type c on a.`type` = c.id
                                    
                                    where a.hapus is null;
                                ");

                                echo '
                                    <option value="" disabled selected>Pilih Printer</option>
                                ';

                                foreach($qprint->result() as $dprint){
                                    echo '
                                        <option value="'.$dprint->id.'">'.$dprint->nama_merk.' '.$dprint->nama_type.'</option>
                                    ';
                                    $val_printer .= '<option value="'.$dprint->id.'">'.$dprint->nama_merk.' '.$dprint->nama_type.'</option>';
                                }

                                echo '
                                    </select>
                                ';
                                echo '<button id="btn_print'.$tprint.'" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>';
                                echo '
                                    <script>
                                    $("#printer'.$tprint.'").val('.$arr_print.');
                                    $("#btn_print'.$tprint.'").click(function(){
                                        $("#printer'.$tprint.'").remove();
                                        $("#btn_print'.$tprint.'").remove();
                                    })
                                    </script>
                                ';
                            }
                        ?>

                    </div>
                </div>
                
            </div>
                        
                        
            <div class="col-sm-12">

                <div class="panel-default">
                    <div class="panel-body">
                    
                        Lokasi : 
                        <select name="lok" id="lok" class="form-control" required>
                            <?php 
                                $qlok = $this->db->query("
                                    select * from tbl_bagian where hapus is null
                                ");

                                echo '
                                    <option value="" disabled selected>Pilih Lokasi</option>
                                ';

                                foreach($qlok->result() as $dtlok){
                                    echo '
                                        <option value="'.$dtlok->kd.'">'.$dtlok->nama_bagian.'</option>
                                    ';
                                }

                            ?>
                        </select>

                    </div>
                </div>
                
            </div>

            </br>

            <div class="col-sm-12">

                <div class="panel-default">
                    <div class="panel-body">
                
                        User : 
                        <select name="id_user" id="id_user" class="form-control" required>
                            
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-sm-12">

                <div class="panel-default">
                    <div class="panel-body">
                
                        User PC : 
                        <select name="user_pc" id="user_pc" class="form-control" required>
                            <option value="" disabled selected>Choose User</option>
                            <?php 
                                $qup = $this->db->query("
                                    select * from user_pc order by user_pc asc;
                                ");

                                foreach($qup->result() as $dtup){
                                    echo '
                                        <option value="'.$dtup->id.'">'.$dtup->user_pc.'</option>
                                    ';
                                }
                            ?>
                        </select>
                        
                    </div>
                </div>

            </div>
            <br>
                
            </div>

            

        </div>

        <!--div class="col-sm-12">
            <h2><?php echo $bagian;?></h2>
        </div-->

        <div class="modal-footer">
            <div class="col-sm-12"><br>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo base_url();?>index.php/C_pc/view_pc" type="button" class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>

        </form>

    </div>

</div>

<script>

    $(document).ready(function(){

        $("#lok").val("<?php echo $lok;?>");
        $("#cpu").val("<?php echo $cpu;?>");
        $("#user_pc").val("<?php echo $user_pc;?>");

        //alert("<?php echo $lok;?>");

        var lokasi = $("#lok").val();

        $.ajax({  
            url: "<?php echo base_url(); ?>" + "index.php/C_pc/data_user_edit",
            method:"POST",
            data:{lokasi:lokasi},  
                success:function(resp){
                    $("#id_user").html(resp);
                    //alert(resp);
                    $("#id_user").val("<?php echo $id_user;?>");
                }
        })

    })
    

    $("#lok").change(function(){
        var lokasi = $(this).val();
        //alert(lokasi);
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "index.php/C_pc/data_user_edit",
            method:"POST",
            data:{lokasi:lokasi},  
                success:function(resp){
                    $("#id_user").html(resp);
                    //alert(resp);
                    $("#id_user").val("<?php echo $id_user;?>");
                }
        })
    })

    //======================= MOUSE
    var div = document.getElementById('div_mouse');
    function addMouse() {
        var input = document.createElement('select'),
        button = document.createElement('button');
    
        //input.placeholder = "More hobbies";
        input.innerHTML = '<?php echo $val_mouse;?>';
        input.name = 'mouse[]';
        input.id = 'id_mouse';
        input.setAttribute("class", "form-control");
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = removeMouse;
    
        div.appendChild(input);
        div.appendChild(button);
    }

    function removeMouse() {
    // remove this button and its input
    div.removeChild(this.previousElementSibling);
    div.removeChild(this);
    }

    // attach onclick event handler to add button
    document.getElementById('add_mouse').addEventListener('click', addMouse);
    // attach onclick event handler to 1st remove button
    //document.getElementById('remove_proc').addEventListener('click', removeProc);

    //==================== MOUSE

    //======================= KEYBOARD
    var div2 = document.getElementById('div_keyboard');
    function addKeyboard() {
        var input = document.createElement('select'),
        button = document.createElement('button');
    
        //input.placeholder = "More hobbies";
        input.innerHTML = '<?php echo $val_keyboard;?>';
        input.name = 'keyboard[]';
        input.id = 'id_keyboard';
        input.setAttribute("class", "form-control");
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = removeKeyboard;
    
        div2.appendChild(input);
        div2.appendChild(button);
    }

    function removeKeyboard() {
    // remove this button and its input
    div2.removeChild(this.previousElementSibling);
    div2.removeChild(this);
    }

    // attach onclick event handler to add button
    document.getElementById('add_keyboard').addEventListener('click', addKeyboard);
    // attach onclick event handler to 1st remove button
    //document.getElementById('remove_proc').addEventListener('click', removeProc);

    //==================== KEYBOARD

    //======================= MONITOR
    var div3 = document.getElementById('div_monitor');
    function addMonitor() {
        var input = document.createElement('select'),
        button = document.createElement('button');
    
        //input.placeholder = "More hobbies";
        input.innerHTML = '<?php echo $val_monitor;?>';
        input.name = 'monitor[]';
        input.id = 'id_monitor';
        input.setAttribute("class", "form-control");
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = removeMonitor;
    
        div3.appendChild(input);
        div3.appendChild(button);
    }

    function removeMonitor() {
    // remove this button and its input
    div3.removeChild(this.previousElementSibling);
    div3.removeChild(this);
    }

    // attach onclick event handler to add button
    document.getElementById('add_monitor').addEventListener('click', addMonitor);
    // attach onclick event handler to 1st remove button
    //document.getElementById('remove_proc').addEventListener('click', removeProc);

    //==================== MONITOR

    //======================= PRINTER
    var div4 = document.getElementById('div_printer');
    function addPrinter() {
        var input = document.createElement('select'),
        button = document.createElement('button');
    
        //input.placeholder = "More hobbies";
        input.innerHTML = '<?php echo $val_printer;?>';
        input.name = 'printer[]';
        input.id = 'id_printer';
        input.setAttribute("class", "form-control");
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = removePrinter;
    
        div4.appendChild(input);
        div4.appendChild(button);
    }

    function removePrinter() {
    // remove this button and its input
    div4.removeChild(this.previousElementSibling);
    div4.removeChild(this);
    }

    // attach onclick event handler to add button
    document.getElementById('add_printer').addEventListener('click', addPrinter);
    // attach onclick event handler to 1st remove button
    //document.getElementById('remove_proc').addEventListener('click', removeProc);

    //==================== PRINTER


</script>


<div id="page-wrapper" style="background-color:#d2f2f1;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">SUPERVISOR SEARCH</h3>
        </div>
    </div>

    <div class="row" style="font-size:12px;">  

        <div class="col-sm-6">
            <?php
                $query = $this->db->query("
                    select * from tbl_user where level = 'USER'
                ");
                echo '
                <select style="cursor:pointer;" name="id_user" id="id_user" class="form-control">
                <option value="" selected disabled>Pilih User</option>
                ';
                foreach($query->result() as $data){ 
                    $nm_user = $data->nama;
                    $id = $data->id;
                    echo '
                    <option value="'.$id.'">'.$nm_user.'</option>
                    ';
                }
                echo '
                </select>
                ';
            ?>
        </div>
        <div class="col-sm-6">
            <button class="btn btn-success" id="search">Search</button>
        </div>

        <div id="show" class="col-sm-6">
            
        </div>

    </div>      
</div>

<script>
$("#search").click(function(){
    var id_user = $("#id_user").val();
    $.ajax({  
        url: "<?php echo base_url(); ?>" + "index.php/cari_spv/search_spv",
        method:"POST",
        data:{id_user:id_user},             
            success:function(data){
                //console.log(data);
                $("#show").html(data); 
            }
    });
})

</script>
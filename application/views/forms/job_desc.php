<div id="page-wrapper" style="background-color:#d2f2f1;">
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">JOB DESCRIPTION LIST</h3>
    </div>
</div>

<div class="row" style="font-size:12px;">  
    
<!-- START -->
    <table id="daftar_kondisi" class="table table-striped table-bordered table-hover" style="width:100%;">
        <thead>
            <tr class="danger">
                <th>No</th>
                <th style="text-align:center;">Description</th>
                <th>Jenis Request</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jobdesc = $this->db->query("select * from tbl_job_desc");
            if($jobdesc->num_rows() < 1){
                echo '
                <tr>
                    <td colspan="3">
                    <div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Please Insert Description.
                    </div>
                    </td>
                </tr>
                ';
            }else{
                $no = 1;
                foreach($jobdesc->result() as $data){
                    $service = $data->jenis_service;
                    if($service == '1'){
                        $serv = 'Service';
                    }elseif($service == '2'){
                        $serv = 'Item';
                    }elseif($service == '3'){
                        $serv = 'Application';
                    }
                    echo '
                    <tr>
                        <td>'.$no.'</td>
                        <td>'.$data->deskripsi.'</td>
                        <td>'.$serv.'</td>
                    </tr>
                    ';
                    $no++;
                }
            }
            
            ?>              
        </tbody>
    </table>   
    
    <br>

    <button class="btn btn-success" data-toggle="modal" data-target="#ModalTambahKondisi">ADD DESCRIPTION</button>

    <br><br>

    <!-- Modal Tambah Kondisi -->
    <div class="modal fade" id="ModalTambahKondisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ADD DESCRIPTION</h4>
                </div>
                
                <form id="Form3" action="<?php echo base_url('index.php/lainlain/tambah_desc'); ?>" method="post"> 
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="comment">Job Desc :</label>
                            <textarea class="form-control kapital" name="txt_kondisi" id="txt_kondisi" rows="5" id="comment" required></textarea>
                        </div>
                        <!--input type="text" class="form-control has-feedback-left"  placeholder="Condition" required-->
                        <select style="margin-top:10px;" name="js" id="js" class="form-control" required>
                            <option value="" disabled selected>Jenis Permintaan</option>
                            <option value="1">Service</option>
                            <option value="2">Item</option>
                            <option value="3">Application</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
                        <button type="submit" class="btn btn-success">Save</button>                      
                    </div>   
                </form>                 
            </div>
            <!-- / Modal content -->
        </div>
    </div>
    <!-- / The Modal -->

<style>
/*
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}
*/

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<script>
//------------------------------------------------------------------------------
//Datatable
$(document).ready(function() {
    //$('#tsi_usr_napp').DataTable();   //Polosan
    //$('#tsi_usr_napp2').DataTable();  //Polosan

    $('#daftar_kondisi').DataTable({
        "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],       //Set Show Entries
        "iDisplayLength": 10                                                //Set Default Show Entries
    });

});
</script>

<script>
$(".kapital").keyup(function(){
    this.value = this.value.toUpperCase();
    //console.log("fungsi di script view !");
    //alert("a");
})
</script>

<!-- END -->

</div>      
</div>
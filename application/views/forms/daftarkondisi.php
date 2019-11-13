<div id="page-wrapper" style="background-color:#d2f2f1;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">CONDITION LIST</h3>
        </div>
    </div>

    <div class="row" style="font-size:12px;">  
        
<!-- START -->
        <table id="daftar_kondisi" class="table table-striped table-bordered table-hover" style="width:100%;">
            <thead>
                <tr class="danger">
                    <th style="text-align:center;">CONDITION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($daftar_kondisi->result_array() as $kondisi): { ?>
                <tr>
                    <td width="70%"><?php echo $kondisi['kondisi']; ?></td>          
                </tr>
                <?php } endforeach; ?>                       
            </tbody>
        </table>   
        
        <br>

        <button class="btn btn-success" data-toggle="modal" data-target="#ModalTambahKondisi">ADD CONDITION</button>

        <br><br>

        <!-- Modal Tambah Kondisi -->
        <div class="modal fade" id="ModalTambahKondisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ADD CONDITION</h4>
                    </div>
                    
                    <form id="Form3" action="<?php echo base_url('index.php/lainlain/tambahkondisi'); ?>" method="post"> 
                        <div class="modal-body">
                            <input type="text" class="form-control has-feedback-left kapital" name="txt_kondisi" id="txt_kondisi" placeholder="Condition" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>                        
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
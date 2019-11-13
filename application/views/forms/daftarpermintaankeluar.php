<div id="page-wrapper" style="background-color:#f7a8e7;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">OUTWARD REQUESTS LIST</h3>
        </div>
    </div>

    <div class="row" style="font-size:12px;">  

<!-- START -->

        <ul class="nav nav-tabs">
            <li class="active"><a style="background-color:#dff0d8;" data-toggle="tab" href="#tbl1"> OPEN </a></li> 
            <li><a style="background-color:#f2dede;" data-toggle="tab" href="#tbl2"> CLOSED </a></li>
            <li><a data-toggle="tab" href="#tbl3"> --- </a></li>
            <li><a data-toggle="tab" href="#tbl4"> --- </a></li>
        </ul>
        <br>

        <div class="tab-content">

            <div id="tbl1" class="tab-pane fade in active">
                <table id="tsi_usr_napp" class="table table-striped table-bordered table-hover" style="width:100%;">
                    <thead>
                        <tr class="success">
                            <th style="text-align:center;">Request ID</th>
                            <th style="text-align:center;">Description</th>
                            <th style="text-align:center;">Detail</th>                        
                            <th style="text-align:center;">Type</th>                            
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_daftar_permintaan_keluar->result_array() as $hasil): { ?>
                        <tr>
                            <td width="15%"><?php echo $hasil['id_permintaan']; ?> <br> 
                                            <?php echo $hasil['nama']; ?> <br>
                                            <?php echo $hasil['nama_dept']; ?> <br>
                                            <?php echo $hasil['nama_bagian']; ?>
                            </td>
                            <td width="20%"><?php echo $hasil['perihal']; ?></td>
                            <td width="20%"><?php echo $hasil['detail']; ?></td>     
                            <td width="9%"><?php echo $hasil['jenis']; ?></td>
                            <td width="7%">                                  
                                <form action="<?php echo base_url('index.php/permintaan/lihatlogpermintaan'); ?>" method="post">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-default" type="submit" value="Detail">    
                                </form>

                                <br>

                                <form action="<?php echo base_url('index.php/cetakpdf/cetakpermintaan2'); ?>" method="post" target="_blank">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-primary" type="submit" value="Print Request">    
                                </form>
                      
                                <br>

                                <?php if($hasil['statuz'] == 'Open') { ?>
                                    <button class="btn btn-xs btn-warning" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalTutup">Close Request</button> <br>
                                <?php }; ?>

                                <br>
                            
                                <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#ModalHapus">Delete Request</button> <br>
                                                         
                            </td>
                        </tr>
                        <?php } endforeach; ?>                       
                    </tbody>
                </table>                            
            </div>

            <div id="tbl2" class="tab-pane fade">
                <table id="tsi_usr_napp2" class="table table-striped table-bordered table-hover" style="width:100%;">
                    <thead>
                        <tr class="danger">
                            <th style="text-align:center;">Request ID</th>
                            <th style="text-align:center;">Description</th>
                            <th style="text-align:center;">Detail</th>                           
                            <th style="text-align:center;">Type</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_daftar_permintaan_keluar_close->result_array() as $hasil2): { ?>
                        <tr>
                            <td width="15%"><?php echo $hasil2['id_permintaan']; ?></td>
                            <td width="20%"><?php echo $hasil2['perihal']; ?></td>
                            <td width="20%"><?php echo $hasil2['detail']; ?></td>                           
                            <td width="9%"><?php echo $hasil2['jenis']; ?></td>        
                            <td width="7%">
                                <form action="<?php echo base_url('index.php/permintaan/lihatlogpermintaan'); ?>" method="post">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil2['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-default" type="submit" value="Detail">    
                                </form>
                                
                                <br>
                                
                                <form action="<?php echo base_url('index.php/cetakpdf/cetakpermintaan'); ?>" method="post" target="_blank">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil2['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-primary" type="submit" value="Print Request">    
                                </form>                               

                                <br>
                        
                                <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil2['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#ModalHapus">Delete Request</button> <br>
                                         
                            </td> 
                        </tr>
                        <?php } endforeach; ?>  
                    </tbody>
                </table>
            </div>
       
            <div id="tbl3" class="tab-pane fade">
                <table id="tsi_usr_napp3" class="table table-striped table-bordered dt-responsive" style="width:100%;">
                <thead>
              
                </thead>
                <tbody>
                    
                </tbody>
                </table>
            </div>
                      
            <div id="tbl4" class="tab-pane fade">
                <table id="tsi_usr_napp4" class="table table-striped table-bordered dt-responsive" style="width:100%;">
                <thead>
        
                </thead>
                <tbody>
                    
                </tbody>
                </table>
            </div>
                                    
            <br>
            <table border="0">
                <tr>
                    <!-- <td>{!! HTML::linkRoute('crt_tmo', 'INPUT PERMINTAAN', [], ['class' => 'btn btn-round btn-primary']) !!}</td>
                    <td>{!! HTML::linkRoute('tmo_mv_hmemo', 'Tambah Memo Penyerahan Manual', [], ['class' => 'btn btn-round btn-primary']) !!}</td> -->
                </tr>
            </table>
        </div>
       
        <!-- Modal Permintaan Diterima -->
        <div class="modal fade" id="ModalDiterima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">REQUEST ACCEPTED</h4>
                    </div>
                    
                    <form id="Form1" action="<?php echo base_url('index.php/permintaan/responterima'); ?>" method="post">
                        <div class="modal-body">  
                            <input type="text" class="form-control has-feedback-left" name="txt_ketditerima" id="txt_ketditerima" placeholder="Give Information" required>
                            <input type="hidden" name="id_modal" id="id_modal" value="">
                            <input type="hidden" name="id_per_modal" id="id_per_modal" value="">                                                
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                        </div>      
                    </form>                
                </div>
                <!-- / Modal content -->
            </div>
        </div>
        <!-- / The Modal -->

        <!-- Modal Permintaan Ditolak -->
        <div class="modal fade" id="ModalDitolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">REQUEST REJECTED</h4>
                    </div>
                    
                    <form id="Form2" action="<?php echo base_url('index.php/permintaan/respontolak'); ?>" method="post"> 
                        <div class="modal-body">
                            <input type="text" class="form-control has-feedback-left" name="txt_ketditolak" id="txt_ketditolak" placeholder="Give Information" required>
                            <input type="hidden" name="id_modal" id="id_modal" value="">
                            <input type="hidden" name="id_per_modal" id="id_per_modal" value="">   
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                        </div>   
                    </form>                 
                </div>
                <!-- / Modal content -->
            </div>
        </div>
        <!-- / The Modal -->

        <!-- Modal Update Permintaan -->
        <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">REQUEST CONDITION UPDATE</h4>
                    </div>
                    
                    <form id="Form3" action="<?php echo base_url('index.php/permintaan/updatekondisi'); ?>" method="post"> 
                        <div class="modal-body">
                            <select type="text" class="form-control has-feedback-left" name="txt_kond" id="txt_kond" List="kondlist" required>
                                <datalist id="kondlist">
                                    <?php // foreach ($data_daftar_kondisi->result_array() as $kondisi): { ?>
                                        <option value="<?php //echo $kondisi['kondisi']; ?>"><?php //echo $kondisi['kondisi']; ?></option>
                                    <?php// } endforeach; ?>
                                </datalist>  
                            </select>
                            <br>
                            <input type="text" class="form-control has-feedback-left" name="txt_ketupdate" id="txt_ketupdate" placeholder="Give Information" required>
                            <input type="hidden" name="id_modal" id="id_modal" value="">
                            <input type="hidden" name="id_per_modal" id="id_per_modal" value="">   
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                        </div>   
                    </form>                 
                </div>
                <!-- / Modal content -->
            </div>
        </div>
        <!-- / The Modal -->

        <!-- Modal Tutup Permintaan -->
        <div class="modal fade" id="ModalTutup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">CLOSE REQUEST</h4>
                    </div>
                    
                    <form id="Form4" action="<?php echo base_url('index.php/permintaan/tutuppermintaan'); ?>" method="post"> 
                        <div class="modal-body">
                            <input type="text" class="form-control has-feedback-left" name="txt_kettutup" id="txt_kettutup" placeholder="Give Information" required>
                            <input type="hidden" name="id_modal" id="id_modal" value="">
                            <input type="hidden" name="id_per_modal" id="id_per_modal" value="">   
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                        </div>   
                    </form>                 
                </div>
                <!-- / Modal content -->
            </div>
        </div>
        <!-- / The Modal -->

        <!-- Modal Hapus Permintaan -->
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">DELETE REQUEST</h4>
                    </div>
                    
                    <form id="Form5" action="<?php echo base_url('index.php/permintaan/hapuspermintaan'); ?>" method="post"> 
                        <div class="modal-body">
                            <input type="text" class="form-control has-feedback-left" name="txt_kethapus" id="txt_kethapus" placeholder="Give Information" required>
                            <input type="hidden" name="id_modal" id="id_modal" value="">
                            <input type="hidden" name="id_per_modal" id="id_per_modal" value="">   
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                        </div>   
                    </form>                 
                </div>
                <!-- / Modal content -->
            </div>
        </div>
        <!-- / The Modal -->


<style>
     /*table {
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
    }*/

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<script type="text/javascript" charset="utf-8">  
    //------------------------------------------------------------------------------
    $('#ModalDiterima').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');           /* Deklarasi variable idp yang isinya id-p */
        var idper = $(opener).attr('id-per');       /* Deklarasi variable idper yang isinya id-per */
    
        //set what we got to our form
        $('#Form1').find('[name="id_modal"]').val(idp);
        $('#Form1').find('[name="id_per_modal"]').val(idper);        
    });

    //------------------------------------------------------------------------------
    $('#ModalDitolak').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form2').find('[name="id_modal"]').val(idp);
        $('#Form2').find('[name="id_per_modal"]').val(idper);        
    });

    //------------------------------------------------------------------------------
    $('#ModalUpdate').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form3').find('[name="id_modal"]').val(idp);
        $('#Form3').find('[name="id_per_modal"]').val(idper);        
    });

    //------------------------------------------------------------------------------
    $('#ModalTutup').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form4').find('[name="id_modal"]').val(idp);
        $('#Form4').find('[name="id_per_modal"]').val(idper);        
    });

    //------------------------------------------------------------------------------
    $('#ModalHapus').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form5').find('[name="id_modal"]').val(idp);
        $('#Form5').find('[name="id_per_modal"]').val(idper);        
    });

    //------------------------------------------------------------------------------
    //Datatable
    $(document).ready(function() {
        //$('#tsi_usr_napp').DataTable();   //Polosan
        //$('#tsi_usr_napp2').DataTable();  //Polosan

        $('#tsi_usr_napp').DataTable({
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],       //Set Show Entries
            "iDisplayLength": 5,                                                //Set Default Show Entries
            "order": [['0', 'desc']]                                            //Set sorting descending column 0                                            
        });

        $('#tsi_usr_napp2').DataTable({
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],       //Set Show Entries
            "iDisplayLength": 5,                                                //Set Default Show Entries
            "order": [['0', 'desc']]                                            //Set sorting descending column 0
        });
    });

</script>

    </div>      
</div>
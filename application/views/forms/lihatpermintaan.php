<div id="page-wrapper" style="background-color:#eafbcf";>
    <div class="row" >
        <div class="col-lg-12">
            <h3 class="page-header">MY REQUESTS LIST</h3>
        </div>
    </div>

    <div class="row" style="font-size:12px;">

<!-- START -->
        <ul class="nav nav-tabs">
            <li class="active"><a style="background-color:#dff0d8;" data-toggle="tab" href="#tbl1"> <b>OPEN</b></a></li> 
            <li><a style="background-color:#f2dede;" data-toggle="tab" href="#tbl2"> <b>CLOSED</b></a></li>
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
                            <th style="text-align:center;">Response</th>
                            <th style="text-align:center;">Type</th>
                            <th style="text-align:center;">Condition</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_lihat_permintaan->result_array() as $hasil): { ?>
                        <tr>
                            <td width="12%"><strong><?php echo $hasil['id_permintaan']; ?></strong></td>
                            <td width="20%"><?php echo $hasil['perihal']; ?></td>
                            <td width="20%"><?php echo $hasil['detail']; ?></td>
                            <td width="10%"><?php echo $hasil['respon']; ?></td>
                            <td width="10%"><?php echo $hasil['jenis']; ?></td>
                            <td width="10%"><?php echo $hasil['kondisi']; ?></td>
                            <td width="9%"><?php echo $hasil['statuz']; ?></td>
                            <td width="9%">  
                                <form action="<?php echo base_url('index.php/permintaan/lihatlogpermintaan'); ?>" method="post">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-default" type="submit" value="Detail">    
                                </form>
                                
                                <br>
                                
                                <form action="<?php echo base_url('index.php/cetakpdf/cetakpermintaan'); ?>" method="post" target="_blank">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-primary" type="submit" value="Print">    
                                </form> 
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
                            <th style="text-align:center;">Response</th>
                            <th style="text-align:center;">Type</th>
                            <th style="text-align:center;">Condition</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_lihat_permintaan_close->result_array() as $hasil2): { ?>
                        <tr>
                            <td width="12%"><?php echo $hasil2['id_permintaan']; ?></td>
                            <td width="20%"><?php echo $hasil2['perihal']; ?></td>
                            <td width="20%"><?php echo $hasil2['detail']; ?></td>
                            <td width="10%"><?php echo $hasil2['respon']; ?></td>
                            <td width="10%"><?php echo $hasil2['jenis']; ?></td>
                            <td width="10%"><?php echo $hasil2['kondisi']; ?></td>
                            <td width="9%"><?php echo $hasil2['statuz']; ?></td>
                            <td width="9%">  
                                <form action="<?php echo base_url('index.php/permintaan/lihatlogpermintaan'); ?>" method="post">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil2['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-default" type="submit" value="Detail">    
                                </form> 

                                <br>
                                 
                                <form action="<?php echo base_url('index.php/cetakpdf/cetakpermintaan'); ?>" method="post" target="_blank">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil2['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-primary" type="submit" value="Print">    
                                </form>   
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

<script>
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

<!-- END -->

    </div>      
</div>
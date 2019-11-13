<div id="page-wrapper" style="background-color:#d2f7d6;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">ALL REQUESTS LIST</h3>
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

            <div id="tbl1" class="tab-pane fade in active table-responsive">
                <table id="tsi_usr_napp" class="table table-striped table-bordered table-hover" style="width:100%;">
                    <thead>
                        <tr class="success">
                            <th style="text-align:center;">No.</th>
                            <th style="text-align:center;">Request ID</th>
                            <th style="text-align:center;">Description</th>
                            <th style="text-align:center;">Detail</th>
                            <th style="text-align:center;">Response</th>
                            <th style="text-align:center;">Type</th>
                            <th style="text-align:center;">Condition</th>
                            <th style="text-align:center;">Status</th>
                            <!--th style="text-align:center;">Image</th-->
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($data_daftar_permintaan->result_array() as $hasil): { ?>
                        <tr>
                            <td width="4%"><?php echo $no++; ?></td>
                            <td width="15%"><strong><?php echo $hasil['id_permintaan']; ?></strong> <br> 
                                            <?php echo $hasil['nama']; ?> <br>
                                            <?php echo $hasil['nama_dept']; ?> <br>
                                            <?php echo $hasil['nama_bagian']; ?>

                            </td>
                            <td width="20%"><br><?php echo $hasil['perihal']; ?></td>
                            <td width="20%"><br><?php echo $hasil['detail']; ?></td>
                            <td width="10%"><br>
                                <?php if($hasil['respon'] == 'Belum Ditentukan') { ?> 
                                    <button class="btn btn-xs btn-primary" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalDiterima">Accept</button>  <br>

                                    <br>

                                    <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalDitolak">Reject</button>
                                <?php } else { echo $hasil['respon']; }; ?>
                            </td>
                            <td width="9%"><br>
                                <?php if($hasil['respon'] != 'Belum Ditentukan') { ?>
                                    <?php if($hasil['jenis'] == 'Belum Ditentukan') { ?>                                       
                                        <!--form action="<?php //echo base_url('index.php/permintaan/jenisservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php //echo $hasil['id']; ?>">
                                            <input type="hidden" name="id_per" id="id_per" value="<?php //echo $hasil['id_permintaan']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Service" onclick="return confirm(&#039;Kategorikan sebagai Permintaan SERVICE ?&#039;)">    
                                        </form><br-->
                                        <!-- Service Button-->
                                        <button class="btn btn-xs btn-primary" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalService">Service Request</button>  <br>

                                        <br>

                                        <!--form action="<?php //echo base_url('index.php/permintaan/jenisbarang'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php //echo $hasil['id']; ?>">
                                            <input type="hidden" name="id_per" id="id_per" value="<?php //echo $hasil['id_permintaan']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Items" onclick="return confirm(&#039;Kategorikan sebagai Permintaan BARANG ?&#039;)">    
                                        </form><br-->
                                        <!-- Service Button-->
                                        <button class="btn btn-xs btn-success" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalItem">Item Request</button>  <br>

                                        <br>

                                        <!--form action="<?php echo base_url('index.php/permintaan/jenisaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                            <input class="btn btn-xs btn-danger" type="submit" value="Application" onclick="return confirm(&#039;Kategorikan sebagai Permintaan APLIKASI ?&#039;)">    
                                        </form><br-->
                                        <!-- Service Button-->
                                        <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalApp">Application Request</button>  <br>

                                    <?php } else { echo $hasil['jenis']; }; ?>
                                <?php } else { echo $hasil['jenis']; }; ?>
                            </td>
                            <td width="10%"><br><?php echo $hasil['kondisi']; ?></td>
                            <td width="9%"><br><?php echo $hasil['statuz']; ?></td>
                            <!--td>

                            <br>
                            <a href="<?php echo base_url();?><?php echo $hasil['upload']; ?>" target="_blank">
                                <img src="<?php echo base_url();?><?php echo $hasil['upload']; ?>" alt="No Image" height="100" width="100">
                            </a-->
                                
                                
                            </td>

                            <td width="7%"><br>                                
                                <form action="<?php echo base_url('index.php/permintaan/lihatlogpermintaan'); ?>" method="post">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-default" type="submit" value="Detail">    
                                </form>

                                <br>

                                <form action="<?php echo base_url('index.php/cetakpdf/cetakpermintaan'); ?>" method="post" target="_blank">                  
                                    <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                    <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                    <input class="btn btn-xs btn-primary" type="submit" value="Print Request">    
                                </form>
                                
                                <br>

                                <?php if($hasil['id_bukti'] == NULL) { ?>
                                    <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/buktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Service">    
                                        </form>
                                    <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/buktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Handover of Goods">    
                                        </form>
                                    <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/buktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Application Update">    
                                        </form>   
                                    <?php }; ?>
                                <?php } elseif($hasil['id_bukti'] != NULL) { ?>
                                    <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktiservice'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Service">    
                                        </form>
                                    <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktipenyerahan'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Handover of Goods">    
                                        </form>
                                    <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktiupdateaplikasi'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Application Update">    
                                        </form> 
                                    <?php }; ?>
                                <?php }; ?>
                                
                                <br>

                                <?php if($hasil['id_bukti'] != NULL) { ?>
                                    <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Service">    
                                        </form>
                                    <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/editbuktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Handover of Goods">    
                                        </form>
                                    <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Application Update">    
                                        </form> 
                                    <?php }; ?>
                                <?php }; ?>

                                <?php if($hasil['jenis'] != 'Belum Ditentukan') { ?>
                                    <button class="btn btn-xs btn-info" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalUpdate">Update Condition</button> <br>
                                <?php }; ?>   

                                <br>

                                <?php if($hasil['statuz'] == 'Open') { ?>
                                    <button class="btn btn-xs btn-warning" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalTutup">Close Request</button> <br>
                                <?php }; ?>

                                <br>

                                <button class="btn btn-xs btn-info" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#for_to">Forward To</button>
                                

                                <br><br>
                            
                                <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#ModalHapus">Delete Request</button> <br>
                                                         
                            </td>
                        </tr>
                        <?php } endforeach; ?>                       
                    </tbody>
                </table>                            
            </div>

            <div id="tbl2" class="tab-pane fade table-responsive">
                <table id="tsi_usr_napp2" class="table table-striped table-bordered table-hover" style="width:100%;">
                    <thead>
                        <tr class="danger">
                            <th style="text-align:center;">No</th>
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
                        <?php $no = 1; foreach($data_daftar_permintaan_close->result_array() as $hasil2): { ?>
                        <tr>
                            <td width="4%"><?php echo $no++;?></td>
                            <td width="15%"><strong><?php echo $hasil2['id_permintaan']; ?></strong> <br> 
                                            <?php echo $hasil2['nama']; ?> <br>
                                            <?php echo $hasil2['nm_dept']; ?> <br>
                                            <?php echo $hasil2['nm_bag']; ?>
                            <td width="20%"><br><?php echo $hasil2['perihal']; ?></td>
                            <td width="20%"><br><?php echo $hasil2['detail']; ?></td>
                            <td width="10%"><br><?php echo $hasil2['respon']; ?></td>
                            <td width="9%"><br><?php echo $hasil2['jenis']; ?></td>
                            <td width="10%"><br><?php echo $hasil2['kondisi']; ?></td>
                            <td width="9%"><br><?php echo $hasil2['statuz']; ?></td> 
                            <td width="7%"><br>
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

                                <?php if($hasil2['id_bukti'] == NULL) { ?>
                                    <?php if($hasil2['jenis'] == 'Permintaan Service') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/buktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Service">    
                                        </form>
                                    <?php } elseif($hasil2['jenis'] == 'Permintaan Barang') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/buktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Handover of Goods">    
                                        </form>
                                    <?php } elseif($hasil2['jenis'] == 'Permintaan Aplikasi') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/buktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Application Update">    
                                        </form>   
                                    <?php }; ?>
                                <?php } elseif($hasil2['id_bukti'] != NULL) { ?>
                                    <?php if($hasil2['jenis'] == 'Permintaan Service') { ?>
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktiservice'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Service">    
                                        </form>
                                    <?php } elseif($hasil2['jenis'] == 'Permintaan Barang') { ?>
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktipenyerahan'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Handover of Goods">    
                                        </form>
                                    <?php } elseif($hasil2['jenis'] == 'Permintaan Aplikasi') { ?>
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktiupdateaplikasi'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Application Update">    
                                        </form> 
                                    <?php }; ?>
                                <?php }; ?>
                                <br>

                                <?php if($hasil2['id_bukti'] != NULL) { ?>
                                    <?php if($hasil2['jenis'] == 'Permintaan Service') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Service">    
                                        </form>
                                    <?php } elseif($hasil2['jenis'] == 'Permintaan Barang') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/editbuktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Handover of Goods">    
                                        </form>
                                    <?php } elseif($hasil2['jenis'] == 'Permintaan Aplikasi') { ?>
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil2['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Application Update">    
                                        </form> 
                                    <?php }; ?>
                                <?php }; ?>

                                <br>
                        
                                <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil2['id']; ?>" id-per="<?php echo $hasil2['id_permintaan'];?>" 
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

                            <table class="table">
                                <tr>
                                    <th colspan="3">
                                        <input type="text" class="form-control has-feedback-left" name="txt_ketditerima" id="txt_ketditerima" placeholder="Give Information" required>
                                        <input type="hidden" name="id_modal" id="id_modal" value="">
                                        <input type="hidden" name="id_per_modal" id="id_per_modal" value="">  
                                    </th>
                                </tr> 
                                <tr>
                                    <th>
                                        <label class="checkbox-inline" style="margin-top:10px;">
                                            <input type="checkbox" value="1" name="acc"><p>Approval Atasan ?</p>
                                        </label>
                                    </th>
                                </tr>
                                <!--tr>
                                    <th colspan="3">
                                        <p>Estimasi Waktu Proses</p> <br>
                                    </th>
                                </tr>
                                <tr>
                                
                                </tr>
                                <tr>
                                    <th>
                                        Jam : <input onkeypress="return isNumberKey(event)" type="text" maxlength="3" name="jam" id="jam" class="form-control has-feedback-left" placeholder="000">
                                    </th>
                                    <th>
                                        Menit :<input onkeypress="return isNumberKey(event)" type="text" maxlength="2" name="menit" id="menit" class="form-control has-feedback-left" placeholder="00">
                                    </th>
                                    <th>
                                        Detik :<input onkeypress="return isNumberKey(event)" type="text" maxlength="2" name="detik" id="detik" class="form-control has-feedback-left" placeholder="00">
                                    </th>
                                </tr--> 
                            </table>

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
                                    <?php foreach ($data_daftar_kondisi->result_array() as $kondisi): { ?>
                                        <option value="<?php echo $kondisi['kondisi']; ?>"><?php echo $kondisi['kondisi']; ?></option>
                                    <?php } endforeach; ?>
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
                            <input class="close_id" type="hidden" name="id_per_modal" id="id_per_modal" value=""> 
                            <br>
                            <p style="font-weight:bold;"><span style="color:red;">*</span> Jangan Pilih PC jika tidak ada komponen yang diganti</p>
                            
                            <select name="pc" id="pc" class="form-control">
                                
                            </select> 
                            
                            <br> 

                            <div class="col-sm-12 sumput">
                                
                                <table class="table">
                                    <tr>
                                        <th style="text-align:center;"><h4>Komponen Diganti</h4></th>
                                    </tr>
                                </table>

                                <div class="row">

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_proc" name="c_proc" onclick="show_fproc()">
                                        <input type="text" name="vc_proc" id="vc_proc" hidden>
                                        <label class="form-check-label" for="c_proc">Processor</label>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_mem" name="c_mem" onclick="show_fmem()">
                                        <input type="text" name="vc_mem" id="vc_mem" hidden>
                                        <label class="form-check-label" for="c_mem">Memory</label>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_hdd" name="c_hdd" onclick="show_fhdd()">
                                        <input type="text" name="vc_hdd" id="vc_hdd" hidden>
                                        <label class="form-check-label" for="c_hdd">Hardisk</label>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_key" name="c_key" onclick="show_fkey()">
                                        <input type="text" name="vc_key" id="vc_key" hidden>
                                        <label class="form-check-label" for="c_key">Keyboard</label>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_mouse" name="c_mouse" onclick="show_fmouse()">
                                        <input type="text" name="vc_mouse" id="vc_mouse" hidden>
                                        <label class="form-check-label" for="c_mouse">Mouse</label>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_monitor" name="c_monitor" onclick="show_fmon()">
                                        <input type="text" name="vc_monitor" id="vc_monitor" hidden>
                                        <label class="form-check-label" for="c_monitor">Monitor</label>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="checkbox" id="c_printer" name="c_printer" onclick="show_fprint()">
                                        <input type="text" name="vc_printer" id="vc_printer" hidden>
                                        <label class="form-check-label" for="c_printer">Printer</label>
                                    </div>

                                </div>
                                
                            </div>

                            <div class="col-sm-12">
                            
                                <div class="panel panel-default div_proc2">
                                    <div class="panel-body div_proc2" id="pnl_proc">
                                        processor
                                    </div>
                                </div>

                                <div class="panel panel-default div_mem2">
                                    <div class="panel-body div_mem2" id="pnl_mem">
                                        memory
                                    </div>
                                </div>
                                
                                <div class="panel panel-default div_hdd2">
                                    <div class="panel-body div_hdd2" id="pnl_hdd">
                                        hardisk
                                    </div>
                                </div>

                                <div class="panel panel-default div_key2">
                                    <div class="panel-body div_key2" id="pnl_key">
                                        keyboard
                                    </div>
                                </div>

                                <div class="panel panel-default div_mouse2">
                                    <div class="panel-body div_mouse2" id="pnl_mouse">
                                        mouse
                                    </div>
                                </div>
                                
                                <div class="panel panel-default div_mon2">
                                    <div class="panel-body div_mon2" id="pnl_mon">
                                        monitor
                                    </div>
                                </div>

                                <div class="panel panel-default div_print2">
                                    <div class="panel-body div_print2" id="pnl_print">
                                        printer
                                    </div>
                                </div>

                            </div>
                            

                            <!--select name="elemen" id="elemen" class="form-control sumput" id="el" required>
                                <option value="" disabled selected>Pilih Parts</option>
                                <option value="1">Processor</option>
                                <option value="2">Memory</option>
                                <option value="3">Hardisk</option>
                                <option value="4">Keyboard</option>
                                <option value="5">Mouse</option>
                                <option value="6">Monitor</option>
                                <option value="7">Printer</option>
                            </select>
                            <br>

                            <div class="row sumput">
                                <div class="col-sm-6" id="div_merk">
                                    <select name="merk" id="merk" class="form-control" required>
                                        
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="type" id="type" class="form-control" required>
                                
                                    </select>
                                </div>
                            </div>   

                            <div id="apd" class="row sumput">
                                        
                            </div-->

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="ttp_mdl">Close</button>                        
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

        <!-- Modal Permintaan Service -->
        <div class="modal fade" id="ModalService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">SERVICE REQUEST</h4>
                    </div>
                    
                    <form id="Form6" action="<?php echo base_url('index.php/permintaan/jenisservice'); ?>" method="post"> 
                        <div class="modal-body">
                            <select style="cursor:pointer;" name="ket_service" id="ket_service" class="form-control" required>
                                <?php
                                $desc = $this->db->query("select * from tbl_job_desc where jenis_service = '1'");
                                echo '
                                    <option value="" disabled selected>Description</option>
                                ';
                                foreach($desc->result() as $data){
                                    echo '
                                    <option value="'.$data->deskripsi.'">'.$data->deskripsi.'</option>
                                    ';
                                }
                                ?>
                            </select>
                            <br>

                            <select name="plh_cpu" id="plh_cpu" class="form-control">
                                
                            </select>
                            <!--input type="text" class="form-control has-feedback-left" name="ket_service" id="ket_service" placeholder="Give Information" required></br-->

                            <!--label class="checkbox-inline" style="margin-top:10px;">
                              <input type="checkbox" value="1" name="acc">Approval Atasan ?
                            </label>
                            <br-->
                                
                            <div class="form-check" style="margin-top:10px;">
                            <input style="cursor:pointer;" class="form-check-input" type="radio" name="kelas" id="r1" value="0" checked>
                            <label style="cursor:pointer;" class="form-check-label" for="r1">
                                Ringan (Kurang Dari 2 Jam)
                            </label>
                            </div>
                            
                            <div class="form-check">
                            <input style="cursor:pointer;" class="form-check-input" type="radio" name="kelas" id="r2" value="1">
                            <label style="cursor:pointer;" class="form-check-label" for="r2">
                                Sedang (Lebih Dari 2 Jam & Kurang Dari / Sama dengan 8 Jam)
                            </label>
                            </div>
                            <div class="form-check">
                            <input style="cursor:pointer;" class="form-check-input" type="radio" name="kelas" id="r3" value="2">
                            <label style="cursor:pointer;" class="form-check-label" for="r3">
                                Berat (Lebih Dari 24 Jam (Jam Kerja))
                            </label>
                            </div>

                            <input type="hidden" name="id_modal" id="id_modal" value="">
                            <input type="hidden" class="idsr" name="id_per_modal" id="id_per_modal" value="">   
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

        <!-- Modal Permintaan Item -->
        <div class="modal fade" id="ModalItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ITEM REQUEST</h4>
                    </div>
                    
                    <form id="Form7" action="<?php echo base_url('index.php/permintaan/jenisbarang'); ?>" method="post"> 
                        <div class="modal-body">

                            <select style="cursor:pointer;" name="ket_item" id="ket_item" class="form-control" required>
                                <?php
                                $desc = $this->db->query("select * from tbl_job_desc where jenis_service = '2'");
                                echo '
                                <option value="" disabled selected>Description</option>
                                ';
                                foreach($desc->result() as $data){
                                    echo '
                                    <option value="'.$data->deskripsi.'">'.$data->deskripsi.'</option>
                                    ';
                                }
                                ?>
                            </select>
                            <!--input type="text" class="form-control has-feedback-left" name="ket_item" id="ket_item" placeholder="Give Information" required></br-->

                            <label class="checkbox-inline" style="margin-top:10px;">
                              <input type="checkbox" value="1" name="acc">Approval Atasan ?
                            </label>

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

        <!-- Modal Permintaan Item -->
        <div class="modal fade" id="ModalApp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">APP REQUEST</h4>
                    </div>
                    
                    <form id="Form8" action="<?php echo base_url('index.php/permintaan/jenisaplikasi'); ?>" method="post"> 
                        <div class="modal-body">
                            <select style="cursor:pointer;" name="ket_app" id="ket_app" class="form-control" required>
                                <?php
                                $desc = $this->db->query("select * from tbl_job_desc where jenis_service = '3'");
                                echo '
                                <option value="" disabled selected>Description</option>
                                ';
                                foreach($desc->result() as $data){
                                    echo '
                                    <option value="'.$data->deskripsi.'">'.$data->deskripsi.'</option>
                                    ';
                                }
                                ?>
                            </select>
                            <!--input type="text" class="form-control has-feedback-left" name="ket_app" id="ket_app" placeholder="Give Information" required></br-->

                            <label class="checkbox-inline" style="margin-top:10px;">
                              <input type="checkbox" value="1" name="acc">Approval Atasan ?
                            </label>

                            <br>
                                
                            <div class="form-check" style="margin-top:10px;">
                            <input style="cursor:pointer;" class="form-check-input" type="radio" name="kelas" id="r1" value="0" checked>
                            <label style="cursor:pointer;" class="form-check-label" for="r1">
                                Ringan (Kurang Dari 2 Jam)
                            </label>
                            </div>
                            
                            <div class="form-check">
                            <input style="cursor:pointer;" class="form-check-input" type="radio" name="kelas" id="r2" value="1">
                            <label style="cursor:pointer;" class="form-check-label" for="r2">
                                Sedang (Lebih Dari 2 Jam & Kurang Dari / Sama dengan 8 Jam)
                            </label>
                            </div>
                            <div class="form-check">
                            <input style="cursor:pointer;" class="form-check-input" type="radio" name="kelas" id="r3" value="2">
                            <label style="cursor:pointer;" class="form-check-label" for="r3">
                                Berat (Lebih Dari 24 Jam (Jam Kerja))
                            </label>
                            </div>

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

        <!-- Modal -->
        <div id="for_to" class="modal fade" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Forward to</h4>
                </div>
                <div class="modal-body">

                    <form id="Form9" action="<?php echo base_url();?>index.php/ForwardController/index" method="post">
                        <input type="hidden" name="id_tbl" id="id_tbl" required>
                        <input type="hidden" name="id_request" id="id_request" required>
                        <br>

                        <table class="table table-striped">
                            <tr>
                                <th>
                                    <p><span style="color:red;">*</span> Untuk email yang lebih dari satu pisahkan dengan koma (,)</p>
                                    <input type="email" list="emails" name="nm_adm" id="nm_adm" class="form-control" placeholder="Input Email" required multiple>
                                    <?php 
                                        $q1 = $this->db->query("select email from tbl_user where level = 'ADMIN' or level = 'DEFAULT' or email = 'aris.munandar@sipatex.co.id'");
                                        echo '
                                            <datalist id="emails">
                                        ';
                                        foreach($q1->result() as $dt1){
                                            echo '
                                                <option value="'.$dt1->email.'">
                                            ';
                                        }
                                        echo '
                                            </datalist>
                                        ';
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <textarea name="pesan" id="pesan" cols="75" rows="10" placeholder="Pesan" required></textarea>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align:left;">
                                    <button type="submit" class="btn btn-success">Forward</button>
                                </th>
                            </tr>
                        </table>
                </form>
                    
                    
                </div>

                <div class="modal-footer">
                    <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
                </div>

                </div>

            </div>
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

<script type="text/javascript" charset="utf-8">  

    /*
    $('#jam, #menit, #detik').keypress(function(event){
        console.log(event.which);
    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
        event.preventDefault();
    }});
    */

    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

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
        //$("#pc").html(""); 
        //$("#c_proc").val("");
        // $("#elemen").val("");
        //$(".sumput").hide(); 
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form4').find('[name="id_modal"]').val(idp);
        $('#Form4').find('[name="id_per_modal"]').val(idper);  

        $.ajax({  
            url: "<?php echo base_url(); ?>" + "index.php/permintaan/ajax_close",
            method:"POST",
            data:{idper:idper},             
                success:function(data){
                    $("#pc").html(data);  
                    //alert(data);             
                }
        });

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
    $('#ModalService').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form6').find('[name="id_modal"]').val(idp);
        $('#Form6').find('[name="id_per_modal"]').val(idper);       
    });

    //------------------------------------------------------------------------------
    $('#ModalItem').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form7').find('[name="id_modal"]').val(idp);
        $('#Form7').find('[name="id_per_modal"]').val(idper);       
    });

    //------------------------------------------------------------------------------
    $('#ModalApp').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form8').find('[name="id_modal"]').val(idp);
        $('#Form8').find('[name="id_per_modal"]').val(idper);       
    });

     //------------------------------------------------------------------------------
     $('#for_to').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener = e.relatedTarget; //this holds the element who called the modal
        
        //we get details from attributes
        var idp = $(opener).attr('id-p');
        var idper = $(opener).attr('id-per');
    
        //set what we got to our form
        $('#Form9').find('[name="id_tbl"]').val(idp);
        $('#Form9').find('[name="id_request"]').val(idper);        
    });

    //------------------------------------------------------------------------------
    //Datatable
    $(document).ready(function() {
        $(".sumput").hide();

        $(".div_proc2").hide();
        $(".div_mem2").hide();
        $(".div_hdd2").hide();
        $(".div_key2").hide();
        $(".div_mouse2").hide();
        $(".div_mon2").hide();
        $(".div_print2").hide();
        $("#plh_cpu").hide();

        $('#tsi_usr_napp').DataTable({
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],       //Set Show Entries
            "iDisplayLength": 5,                                                //Set Default Show Entries
            "order": [['0', 'asc']]                                            //Set sorting descending column 0                                            
        });

        $('#tsi_usr_napp2').DataTable({
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],       //Set Show Entries
            "iDisplayLength": 5,                                                //Set Default Show Entries
            "order": [['0', 'asc']]                                            //Set sorting descending column 0
        });
    });

    /*$("#ModalTutup").on('show.bs.modal',function(){
        //alert("abcdefg");
        var id_per = $(".close_id").val();
        console.log(id_per);
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "index.php/permintaan/ajax_close",
            method:"POST",
            data:{id_per:id_per},             
                success:function(data){
                    $("#pc").html(data);  
                    //alert(data);             
                }
        });
    })*/

    $("#elemen").change(function(){
        var el = $("#elemen").val();
        console.log(el);
        var pc = $("#pc").val();
        //alert(comp);

        if(el == 1){
            $(".added").remove();
            $("#apd").append("<div class='col-sm-6 added'><br><input type='text' name='clk' id='clk' class='form-control' placeholder='Clock - Ex. 100'></input></div>");
            $("#apd").append("<div class='col-sm-6 added'><br><select name='hertz' id='hertz' class='form-control'><option value='' disabled selected>Choose Hertz</option><option value='MHz'>MHz</option><option value='GHz'>GHz</option><option value='THz'>THz</option></div>");
        }else if(el == 2){
            $(".added").remove();
            $("#apd").append("<div class='col-sm-6 added'><br><input type='text' name='kap' class='form-control' placeholder='Kapasitas - Ex. 100'></input></div>");
            $("#apd").append("<div class='col-sm-6 added'><br><select name='byte' class='form-control'><option value='1'>KB</option><option value='2'>MB</option><option value='3'>GB</option><option value='4'>TB</option></select></div>");
        }else if(el == 3){
            $(".added").remove();
            $("#apd").append("<div class='col-sm-6 added'><br><input type='text' name='kap' class='form-control' placeholder='Kapasitas - Ex. 100'></input></div>");
            $("#apd").append("<div class='col-sm-6 added'><br><select name='byte' class='form-control'><option value='1'>KB</option><option value='2'>MB</option><option value='3'>GB</option><option value='4'>TB</option></select></div>");
        }else if(el == 6){
            $(".added").remove();
            $("#apd").append("<div class='col-sm-6 added'><br><input type='text' name='inches' class='form-control' placeholder='Inches - Ex. 8'></input></div>");
        }
        else{
            $(".added").remove();
        }

        if(!pc){
            alert("PC tidak boleh kosong !");
            $("#elemen").val("");
            $("#pc").focus();
        }else{
            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/cari_merk",
                method:"POST",
                data:{el:el,pc:pc},             
                    success:function(data){
                        $("#merk").html(data);  

                        $.ajax({  
                            url: "<?php echo base_url(); ?>" + "index.php/permintaan/cari_type",
                            method:"POST",
                            data:{el:el},             
                                success:function(resp){
                                    $("#type").html(resp);              
                                }
                        });
                        //alert(data);             
                    }
            });

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/vas",
                method:"POST",
                data:{el:el,pc:pc},             
                    success:function(resp2){
                        var merk = resp2[0].merk;
                        $("#merk").val(merk).trigger("change");
                        console.log(merk);
                    }
            });
            //alert(data); 
        }
        
    })

    $("#pc").change(function(){
        $(".sumput").show();
        //$("#pnl_proc").html("");
        $("#c_proc").val("");
    })  

    function show_fproc() {
        var val_cproc = $("#c_proc").is(":checked");
        if(val_cproc == true){
            $("#vc_proc").val("1");
        }else{
            $("#vc_proc").val("");
        }

        var checkBox = document.getElementById("c_proc");
        var id_pc = $("#pc").val();
        var ide = 1;

        if (checkBox.checked == true){

            $(".div_proc2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_proc").html(resp);
                    }
            });

        } else {

            $(".div_proc2").hide();
            $("#pnl_proc").html("");

        }
        
    }

    function show_fmem() {

        var val_cmem = $("#c_mem").is(":checked");
        if(val_cmem == true){
            $("#vc_mem").val("1");
        }else{
            $("#vc_mem").val("");
        }

        var checkBox = document.getElementById("c_mem");
        var id_pc = $("#pc").val();
        var ide = 2;

        if (checkBox.checked == true){

            $(".div_mem2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_mem").html(resp);
                    }
            });

        } else {

            $(".div_mem2").hide();
            $("#pnl_mem").html("");

        }

    }

    function show_fhdd() {
        var val_hdd = $("#c_hdd").is(":checked");
        if(val_hdd == true){
            $("#vc_hdd").val("1");
        }else{
            $("#vc_hdd").val("");
        }

        var checkBox = document.getElementById("c_hdd");
        var id_pc = $("#pc").val();
        var ide = 3;

        if (checkBox.checked == true){

            $(".div_hdd2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_hdd").html(resp);
                    }
            });

        } else {

            $(".div_hdd2").hide();
            $("#pnl_hdd").html("");

        }
    }

    function show_fkey() {

        var val_key = $("#c_key").is(":checked");
        if(val_key == true){
            $("#vc_key").val("1");
        }else{
            $("#vc_key").val("");
        }

        var checkBox = document.getElementById("c_key");
        var id_pc = $("#pc").val();
        var ide = 4;

        if (checkBox.checked == true){

            $(".div_key2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_key").html(resp);
                    }
            });

        } else {

            $(".div_key2").hide();
            $("#pnl_key").html("");

        }
        
    }

    function show_fmouse() {
        
        var val_mouse = $("#c_mouse").is(":checked");
        if(val_mouse == true){
            $("#vc_mouse").val("1");
        }else{
            $("#vc_mouse").val("");
        }

        var checkBox = document.getElementById("c_mouse");
        var id_pc = $("#pc").val();
        var ide = 5;

        if (checkBox.checked == true){

            $(".div_mouse2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_mouse").html(resp);
                    }
            });

        } else {

            $(".div_mouse2").hide();
            $("#pnl_mouse").html("");

        }

    }

    function show_fmon() {

        var val_mon = $("#c_monitor").is(":checked");
        if(val_mon == true){
            $("#vc_monitor").val("1");
        }else{
            $("#vc_monitor").val("");
        }

        var checkBox = document.getElementById("c_monitor");
        var id_pc = $("#pc").val();
        var ide = 6;

        if (checkBox.checked == true){

            $(".div_mon2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_mon").html(resp);
                    }
            });

        } else {

            $(".div_mon2").hide();
            $("#pnl_mon").html("");

        }

    }

    function show_fprint() {
        
        var val_print = $("#c_printer").is(":checked");
        if(val_print == true){
            $("#vc_printer").val("1");
        }else{
            $("#vc_printer").val("");
        }

        var checkBox = document.getElementById("c_printer");
        var id_pc = $("#pc").val();
        var ide = 7;

        if (checkBox.checked == true){

            $(".div_print2").show();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/panel_data",
                method:"POST",
                data:{id_pc:id_pc,ide:ide},             
                    success:function(resp){
                        $("#pnl_print").html(resp);
                    }
            });

        } else {

            $(".div_print2").hide();
            $("#pnl_print").html("");

        }

    }

    $("#ttp_mdl").click(function(){
        location.reload();
    })

    $("#ket_service").change(function(){
        //alert("a");
        var id_permintaan = $(".idsr").val();

        if($(this).val() == "Perbaikan CPU"){
            //alert(id_permintaan);
            $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/permintaan/cpu_serv",
                method:"POST",
                data:{id_permintaan:id_permintaan},             
                    success:function(resp){
                        //$("#pnl_print").html(resp);
                        $("#plh_cpu").html(resp);
                        $("#plh_cpu").show();
                        //alert(resp);
                    }
            });
        }else{
            $("#plh_cpu").val("");
            $("#plh_cpu").hide();
        }
    })
    
    

</script>

    </div>      
</div>
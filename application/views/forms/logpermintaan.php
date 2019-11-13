<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">REQUEST DETAIL</h3>
        </div>
    </div>

    <div class="row" style="font-size:12px;">  
    
<!-- START -->
        <div class="col-lg-12">      

            <table class="table table-striped table-bordered table-hover" style="width:100%;">
                <?php foreach($data_permintaan->result_array() as $hasil): { ?>

                <tr>
                    <td width="20%">Request ID</td>
                    <td width="1%">:</td> 
                    <td width="79%"><?php echo $hasil['id_permintaan']; ?></td> 
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td> : </td>
                    <td><?php echo $hasil['nama']; ?></td>
                </tr>

                <tr>
                    <td>Email Address</td>
                    <td> : </td>
                    <td><?php echo $hasil['emailaddress']; ?></td>
                </tr>

                <tr>
                    <td>Department</td>
                    <td> : </td>
                    <td><?php echo $hasil['dept2']; ?></td>
                </tr>

                <tr>
                    <td>Section</td>
                    <td> : </td>
                    <td><?php echo $hasil['bagian2']; ?></td>
                </tr>      

                <tr>
                    <td>Phone</td>
                    <td> : </td>
                    <td><?php echo $hasil['telp']; ?></td>
                </tr> 

                <tr>
                    <td>Description</td>
                    <td> : </td>
                    <td><?php echo $hasil['perihal']; ?></td>
                </tr>   

                <tr>
                    <td>Request Detail</td>
                    <td> : </td>
                    <td><?php echo $hasil['detail']; ?></td>
                </tr>             

                <tr>
                    <td>Respon</td>
                    <td> : </td>
                    <td>
                        <?php if($hasil['respon'] == 'Belum Ditentukan') { ?> 
                            <?php if($this->session->userdata("level") == 'ADMIN' || $this->session->userdata("level") == 'DEFAULT') { ?>
                                <button class="btn btn-xs btn-primary" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#ModalDiterima"> Accept </button>  

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#ModalDitolak"> Reject </button>
                            <?php }; ?>
                        <?php } else { echo $hasil['respon']; }; ?>
                    </td>
                </tr>

                <tr>
                    <td>Type</td>
                    <td> : </td>
                    <td>
                        <?php if($hasil['respon'] != 'Belum Ditentukan') { ?>
                            <?php if($hasil['jenis'] == 'Belum Ditentukan') { ?> 
                                <?php if($this->session->userdata("level") == 'ADMIN' || $this->session->userdata("level") == 'DEFAULT') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/permintaan/jenisservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                            <input class="btn btn-xs btn-primary" style="width:75px;" type="submit" value="Service" onclick="return confirm(&#039;Kategorikan sebagai Permintaan SERVICE ?&#039;)">    
                                        </form> 
                                    </div>                       

                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/permintaan/jenisbarang'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                            <input class="btn btn-xs btn-success" style="width:75px;" type="submit" value="Items" onclick="return confirm(&#039;Kategorikan sebagai Permintaan BARANG ?&#039;)">    
                                        </form>
                                    </div>

                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/permintaan/jenisaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                            <input class="btn btn-xs btn-danger" style="width:75px;" type="submit" value="Application" onclick="return confirm(&#039;Kategorikan sebagai Permintaan APLIKASI ?&#039;)">    
                                        </form>
                                    </div>
                                <?php }; ?>
                            <?php } else { echo $hasil['jenis']; }; ?>
                        <?php } else { echo $hasil['jenis']; }; ?>  
                    </td>
                </tr>

                <tr>
                    <td>Action</td>
                    <td> : </td>
                    <td>
                        <div class="col-xs-2">
                            <?php 
                            if($hasil['jenis'] == 'Permintaan Keluar'){
                                $tp = 'cetakpermintaan2';
                            }else{
                                $tp = 'cetakpermintaan';
                            }
                            ?>
                            <form action="<?php echo base_url();?>index.php/cetakpdf/<?php echo $tp;?>" method="post" target="_blank">                  
                                <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                <input type="hidden" name="id_per" id="id_per" value="<?php echo $hasil['id_permintaan']; ?>">
                                <input class="btn btn-xs btn-primary" type="submit" value="Print Request">    
                            </form>
                        </div>
                        
                        <?php if($this->session->userdata("level") == 'ADMIN' || $this->session->userdata("level") == 'DEFAULT') { ?>

                            <?php if($hasil['id_bukti'] == NULL) { ?>
                                <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/buktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Service">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/buktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Handover of Goods">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/buktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Proof of Application Update">    
                                        </form>
                                    </div>   
                                <?php }; ?>
                            <?php } elseif($hasil['id_bukti'] != NULL) { ?>
                                <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktiservice'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Service">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktipenyerahan'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Handover of Goods">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/cetakpdf/cetakbuktiupdateaplikasi'); ?>" method="post" target="_blank">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-primary" type="submit" value="Print Proof of Application Update">    
                                        </form> 
                                    </div>
                                <?php }; ?>
                            <?php }; ?>                       

                            <?php if($hasil['id_bukti'] != NULL) { ?>
                                <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Service">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/editbuktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Handover of Goods">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Application Update">    
                                        </form> 
                                    </div>
                                <?php }; ?>
                            <?php }; ?>                        

                            <?php if($hasil['id_bukti'] != NULL) { ?>
                                <?php if($hasil['jenis'] == 'Permintaan Service') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiservice'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Service">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Barang') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/editbuktipenyerahan'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Handover of Goods">    
                                        </form>
                                    </div>
                                <?php } elseif($hasil['jenis'] == 'Permintaan Aplikasi') { ?>
                                    <div class="col-xs-2">
                                        <form action="<?php echo base_url('index.php/bukti/editbuktiupdateaplikasi'); ?>" method="post">                  
                                            <input type="hidden" name="id" id="id" value="<?php echo $hasil['id_bukti']; ?>">
                                            <input class="btn btn-xs btn-success" type="submit" value="Edit Proof of Application Update">    
                                        </form> 
                                    </div>
                                <?php }; ?>
                            <?php }; ?>                       
                       
                            <?php if($hasil['jenis'] != 'Belum Ditentukan') { ?>
                                <div class="col-xs-2">
                                    <button class="btn btn-xs btn-info" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalUpdate">Update Condition</button>
                                </div>
                            <?php }; ?>   

                            <?php if($hasil['statuz'] == 'Open') { ?>
                                <div class="col-xs-2">
                                    <button class="btn btn-xs btn-warning" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                    data-toggle="modal" data-target="#ModalTutup">Close Request</button>
                                </div>
                            <?php }; ?>

                            <div class="col-xs-2">
                                <button class="btn btn-xs btn-danger" id-p="<?php echo $hasil['id']; ?>" id-per="<?php echo $hasil['id_permintaan'];?>" 
                                data-toggle="modal" data-target="#ModalHapus">Delete Request</button>
                            </div>

                        <?php }; ?>
                    </td>
                </tr>

                <?php } endforeach; ?> 
            </table>                    

            <h3>REQUEST LOG</h3>

            <hr>

            <table class="table table-striped table-bordered table-hover" style="width:100%;">              
                <tr>
                    <th style="text-align:center; width:20%">Status</td>
                    <th style="text-align:center; width:50%">Information</td>
                    <th style="text-align:center; width:15%">Update At</td>
                    <th style="text-align:center; width:15%">Update By</th>
                </tr>

                <?php foreach($data_log_permintaan->result_array() as $hasil2): { ?>

                <tr>                    
                    <td><?php echo $hasil2['statuz']; ?></td>
                    <td><?php echo $hasil2['keterangan']; ?></td>
                    <td><?php echo $hasil2['pada']; ?></td>
                    <td><?php echo $hasil2['user']; ?></td>
                </tr>

                <?php } endforeach; ?>
            </table>

            <hr>
            <br>
           
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
                            <input type="hidden" name="id_modal" id="id_modal">
                            <input type="hidden" name="id_per_modal" id="id_per_modal">                                                
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
                            <input type="hidden" name="id_modal" id="id_modal">
                            <input type="hidden" name="id_per_modal" id="id_per_modal">   
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
</script>

<!-- END -->

    </div>
</div>


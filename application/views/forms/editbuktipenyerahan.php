<div id="page-wrapper" style="background-color:#d2f7d6;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">EDIT PROOF OF HANDOVER OF GOODS</h3>
        </div>
    </div>
    
    <div class="row" style="font-size:12px;">  

<!-- START -->

        <form action="<?php echo base_url('index.php/bukti/simpaneditbuktipenyerahan'); ?>" method="post">

            <div class="col-lg-12">
                <table class="table table-striped table-bordered table-hover">
                    <?php foreach($data_bukti_penyerahan->result_array() as $hasil): { ?>

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

                    <?php } endforeach; ?> 
                </table>
        
                <h3>PROOF OF HANDOVER OF GOODS DETAIL</h3>
                <hr>
                <table class="table table-striped table-bordered table-hover">

                    <tr>
                        <td width="20%">IT Technicians Who Deliver Goods</td>
                        <td width="1%">:</td> 
                        <td width="79%">
                            <select type="text" class="form-control has-feedback-left" name="id_teknisi" id="id_teknisi" List="teknisilist" required>
                                <datalist id="teknisilist">
                                    <?php foreach ($data_teknisi->result_array() as $teknisi): { ?>
                                        <?php if($hasil['id_teknisi'] == $teknisi['id']) { ?>
                                            <option value="<?php echo $teknisi['id']; ?>" selected>
                                                <?php echo $teknisi['nama']; ?> 
                                                <?php echo '( '; ?>
                                                <?php echo $teknisi['email']; ?> 
                                                <?php echo ' )'; ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $teknisi['id']; ?>">
                                                <?php echo $teknisi['nama']; ?> 
                                                <?php echo '( '; ?>
                                                <?php echo $teknisi['email']; ?> 
                                                <?php echo ' )'; ?>
                                            </option>
                                        <?php }; ?>
                                    <?php } endforeach; ?>
                                </datalist>  
                            </select> 
                        </td> 
                    </tr>

                    <tr>
                        <td colspan="3">Submitted Items And Remarks : </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <textarea class="col-md-12 col-sm-12 col-xs-12" name="txt_ket" id="txt_ket" placeholder="Explain" rows="6" required><?php echo $hasil['keterangan']; ?></textarea>
                        </td>
                    </tr>

                </table>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $this->session->userdata("id"); ?>" required>
                    <input type="hidden" id="idbukti" name="idbukti" value="<?php echo $hasil["id_bukti"]; ?>" required>
                        <table border="0" align="center">
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Save</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>
                
            </div>

            <br>
        </form>

<!-- END -->
    </div>
    
</div>
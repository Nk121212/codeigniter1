<div id="page-wrapper" style="background-color:#d2f2f1;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">EDIT USER</h3>
        </div>
    </div>
    
    <div class="row" style="font-size:12px;">  
        
<!-- START -->
        <?php foreach($user_profile->result_array() as $user) {};?>

        <div class="x_content">
            <form action="<?php echo base_url('index.php/user/simpanuseredited'); ?>" method="post">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Name</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_nama" id="txt_nama" value="<?php echo $user['nama']; ?>" required>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Username</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_username" id="txt_username" value="<?php echo $user['username']; ?>" required>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-envelope fa-fw"></span>
                    <label>Email Address</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_email" id="txt_email" placeholder="Email" value="<?php echo $user['email']; ?>" required>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-building fa-fw"></span>
                    <label>Department</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_dept" id="txt_dept" List="deptlist" required>
                        <datalist id="deptlist">
                            <?php foreach ($daftar_departemen->result_array() as $dept): { ?>
                                <?php if($user['departemen'] == $dept['kd'] ) { ?>
                                    <option value="<?php echo $dept['kd']; ?>" selected>
                                        <?php echo $dept['nama_dept']; ?> 
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $dept['kd']; ?>">
                                        <?php echo $dept['nama_dept']; ?> 
                                    </option>
                                <?php }; ?>
                            <?php } endforeach; ?>
                        </datalist>  
                    </select>                   
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bank fa-fw"></span>
                    <label>Section</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_bagian" id="txt_bagian" List="bagianlist" required>
                        <datalist id="bagianlist">
                            <?php foreach ($daftar_bagian->result_array() as $bagian): { ?>
                                <?php if($user['bagian'] == $bagian['kd'] ) { ?>
                                    <option value="<?php echo $bagian['kd']; ?>" selected>
                                        <?php echo $bagian['nama_bagian']; ?> 
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $bagian['kd']; ?>">
                                        <?php echo $bagian['nama_bagian']; ?> 
                                    </option>
                                <?php }; ?>
                            <?php } endforeach; ?>
                        </datalist>  
                    </select>                
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bank fa-fw"></span>
                    <label>Lokasi</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_lokasi" id="txt_lokasi" List="bagianlist" required>
                        <option value="" disabled>Lokasi</option> 
                        <?php 
                            foreach($daftar_lokasi->result() as $dtu){
                                echo '
                                    <option value="'.$dtu->kd.'">'.$dtu->nama.'</option>
                                ';
                            }
                        ?>
                    </select>                
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bars fa-fw"></span>
                    <label>Level</label>                  
                    <select type="text" class="form-control has-feedback-left" name="txt_level" id="txt_level" List="levellist" required>
                        <datalist id="levellist">         
                            <?php if($user['level'] == 'USER') { ?>                  
                                <option value="USER" selected>USER</option>
                            <?php } else { ?>
                                <option value="USER">USER</option>
                            <?php }; ?>

                            <?php if($user['level'] == 'IT') { ?>
                                <option value="ADMIN" selected>ADMIN</option>
                            <?php } else { ?>
                                <option value="ADMIN">ADMIN</option>
                            <?php }; ?>
                        </datalist>  
                    </select> 
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-phone fa-fw"></span>
                    <label>Phone</label>
                    <input type="text" maxlength="3" class="form-control has-feedback-left" name="txt_telp" id="txt_telp" value="<?php echo $user['telp']; ?>" required>
                </div>

		  <!--div class="col-md-3 col-sm-3 col-xs-5 form-group has-feedback">
                    <span class="fa fa-phone fa-fw"></span>
                    <label>Password</label>
                    <input type="password" class="form-control has-feedback-left" name="txt_password" id="txt_password" value="<?php echo $user['password']; ?>" required>
                </div-->

                <!--div class="col-md-3 col-sm-3 col-xs-5 form-group has-feedback">
                    <span class="fa fa-phone fa-fw"></span>
                    <label>Confirm Password</label>
                    <input type="password" class="form-control has-feedback-left" name="txt_password1" id="txt_password1" value="<?php echo $user['password']; ?>" required>
                </div-->

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $user['id']; ?>" required>
                        <table border="0" align="center">
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Save</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>

            </form>
        </div>    

        <?php 
            foreach($user_profile->result() as $dtup){
                $idl = $dtup->lokasi;
            }
        ?>

<script>
    /* Script untuk validasi input agar input numerik saja */
    $("#txt_telp").keyup(function() {
        $("#txt_telp").val(this.value.match(/[0-9]*/));
    });

    $(document).ready(function(){
        $("#txt_lokasi").val("<?php echo $idl;?>");
    })
</script>

<!-- END -->
    </div>
    
</div>
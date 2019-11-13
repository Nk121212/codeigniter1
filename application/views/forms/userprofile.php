<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">USER PROFILE</h3>
        </div>
    </div>
    
    <div class="row">  
        
<!-- START -->
        <?php foreach($user_profile->result_array() as $user) {?>
        <div class="x_content">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Nama</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_nama" id="txt_nama" value="<?php echo $user['nama']; ?>" readonly>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Username</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_username" id="txt_username" value="<?php echo $user['username']; ?>" readonly>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-envelope fa-fw"></span>
                    <label>Email</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_email" id="txt_email" placeholder="Email" value="<?php echo $user['email']; ?>" readonly>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-ticket fa-fw"></span>
                    <label>Password</label>
                    <input type="password" class="form-control has-feedback-left" name="txt_password" id="txt_password" value="******" readonly>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-building fa-fw"></span>
                    <label>Departemen</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_departemen" id="txt_departemen" value="<?php echo $user['nama_dept']; ?>" readonly>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bank fa-fw"></span>
                    <label>Bagian</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_bagian" id="txt_bagian" value="<?php echo $user['nama_bagian']; ?>" readonly>                
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bars fa-fw"></span>
                    <label>Level</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_level" id="txt_level" value="<?php echo $user['level']; ?>" readonly>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-phone fa-fw"></span>
                    <label>Telepon</label>
                    <input type="text" maxlength="3" class="form-control has-feedback-left" name="txt_telp" id="txt_telp" value="<?php echo $user['telp']; ?>" readonly>
                </div>
        </div>         
    <?php }; ?>

<script>
    /* Script untuk validasi input agar input numerik saja */
    $("#txt_Telp").keyup(function() {
        $("#txt_Telp").val(this.value.match(/[0-9]*/));
    });
</script>

<!-- END -->
    </div>
    
</div>
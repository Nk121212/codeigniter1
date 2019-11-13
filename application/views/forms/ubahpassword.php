<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">UBAH PASSWORD</h3>
        </div>
    </div>
    
    <div class="row">  
        
<!-- START -->
        <?php foreach($user_profile->result_array() as $user) {};?>

        <div class="x_content">
            <form action="<?php echo base_url('index.php/user/updatepassword'); ?>" method="post">
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

                <div class="col-md-3 col-sm-3 col-xs-5 form-group has-feedback">
                    <span class="fa fa-ticket fa-fw"></span>
                    <label>Password</label>
                    <input type="password" class="form-control has-feedback-left" name="txt_password" id="txt_password" placeholder="Masukan password baru" autofocus required>                    
                </div>

		        <div class="col-md-3 col-sm-3 col-xs-5 form-group has-feedback">
                    <span class="fa fa-ticket fa-fw"></span>
                    <label>Confirm Password</label>
                    <input type="password" class="form-control has-feedback-left" name="txt_password1" id="txt_password1" placeholder="Masukan Kembali password baru" autofocus required>                    
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

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $this->session->userdata("id"); ?>" required>
                        <table border="0" align="center">
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Simpan</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>

            </form>
        </div>    

<script>
    /* Script untuk validasi input agar input numerik saja */
    $("#txt_Telp").keyup(function() {
        $("#txt_Telp").val(this.value.match(/[0-9]*/));
    });
    
    var password = document.getElementById("txt_password")
  , confirm_password = document.getElementById("txt_password1");

    function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

<!-- END -->
    </div>
    
</div>
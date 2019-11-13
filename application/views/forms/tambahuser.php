<div id="page-wrapper" style="background-color:#d2f2f1;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">ADD USER</h3>
        </div>
    </div>
    
    <div class="row" style="font-size:12px;">  

<!-- START -->
        <div class="x_content">
            <form action="<?php echo base_url('index.php/user/simpanuser'); ?>" method="post">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Name</label>
                    <input type="text" class="form-control has-feedback-left kapital" name="txt_nama" id="txt_nama" placeholder="Name" required>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Username</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_username" id="txt_username" placeholder="Username" required>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-envelope fa-fw"></span>
                    <label>Email Address</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_email" id="txt_email" placeholder="Email Address" required>                    
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
                    <label>Department</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_dept" id="txt_dept" List="deptlist" required>
                        <datalist id="deptlist">
                            <?php foreach ($daftar_departemen->result_array() as $dept): { ?>
                                <option value="<?php echo $dept['kd']; ?>">
                                    <?php echo $dept['nama_dept']; ?> 
                                </option>
                            <?php } endforeach; ?>
                        </datalist>  
                    </select> 
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bank fa-fw"></span>
                    <label>Section</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_bagian" id="txt_bagian" List="bagianlist" required>
                        <datalist id="bagianlist">
                            <?php foreach ($daftar_bagian->result_array() as $bagian): { ?>
                                <option value="<?php echo $bagian['kd']; ?>">
                                    <?php echo $bagian['nama_bagian']; ?> 
                                </option>
                            <?php } endforeach; ?>
                        </datalist>  
                    </select> 
                </div>

                <!-- baru -->
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bank fa-fw"></span>
                    <label>Lokasi</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_lokasi" id="txt_lokasi" List="bagianlist" required>
                        <option value="" disabled selected>Pilih Lokasi</option>
                        <?php 
                            $ql = $this->db->query("
                                select * from mu_kat_parameter where ref_kat = '98323530055155834';
                            ");

                            foreach($ql->result() as $dtl){
                                echo '
                                    <option value="'.$dtl->kd.'">'.$dtl->nama.'</option>
                                ';
                            }
                        ?>
                    </select> 
                </div>
                <!-- baru -->


                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bars fa-fw"></span>
                    <label>Level</label>
                    <select type="text" class="form-control has-feedback-left" name="txt_level" id="txt_level" List="levellist" required>
                        <datalist id="levellist">                           
                            <option value="USER">USER</option>
                            <option value="ADMIN">ADMIN</option>
                        </datalist>  
                    </select> 
                </div>
                

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-phone fa-fw"></span>
                    <label>Phone</label>
                    <input type="text" maxlength="3" class="form-control has-feedback-left" name="txt_telp" id="txt_telp" placeholder="Section Phone Number" required>
                </div>

                <br>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $this->session->userdata("id"); ?>" required>
                        <table border="0" align="center">
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Save</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>

            </form>
        </div>         

<script>
    /* Script untuk validasi input agar input numerik saja */
    $("#txt_telp").keyup(function() {
        $("#txt_telp").val(this.value.match(/[0-9]*/));
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


    $(".kapital").keyup(function(){
        this.value = this.value.toUpperCase();
        //console.log("fungsi di script view !");
        //alert("a");
    })

</script>

<!-- END -->
    </div>
    
</div>
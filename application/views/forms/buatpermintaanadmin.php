<div id="page-wrapper" style="background-color:#d2f7d6;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">CREATE REQUEST (ADMIN)</h3>
        </div>
    </div>
    
    <div class="row" style="font-size:12px">  

<!-- START -->
        <div class="x_content">
            <form action="<?php echo base_url('index.php/permintaan/simpanpermintaanadmin'); ?>" method="post">

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>User</label>
                    <select type="text" class="form-control has-feedback-left" name="id_user" id="id_user" List="userlist" required>
                        <datalist id="userlist">
                            <?php foreach ($daftar_user->result_array() as $user): { ?>
                                <option value="<?php echo $user['id']; ?>">
                                    <?php echo $user['nama']; ?> 
                                    <?php echo '/'; ?>
                                    <?php echo $user['email']; ?> 
                                    <?php echo '/'; ?>
                                    <?php echo $user['nama_dept']; ?>
                                    <?php echo '/'; ?>
                                    <?php echo $user['nama_bagian']; ?>
                                    <?php echo '/'; ?>
                                    <?php echo $user['telp']; ?>
                                </option>
                            <?php } endforeach; ?>
                        </datalist>  
                    </select> 
                </div>            
   
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-info fa-fw"></span>
                    <label>Description</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_perihal" id="txt_perihal" placeholder="Description" required>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <span class="fa fa-edit fa-fw"></span>
                    <label>Request Detail </label>
                    <textarea class="col-md-12 col-sm-12 col-xs-12" name="txt_detail" id="txt_detail" placeholder="Request Detail" rows="6" required></textarea>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $this->session->userdata("id"); ?>" required>
                        <table border="0" align="center">
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Send</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>

            </form>
        </div>         

<!-- END -->
    </div>
    
</div>
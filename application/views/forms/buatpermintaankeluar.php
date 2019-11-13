<div id="page-wrapper" style="background-color:#f7a8e7;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">CREATE REQUEST (OUTWARD)</h3>
        </div>
    </div>
    
    <div class="row" style="font-size:12px">  

<!-- START -->
        <div class="x_content">
            <form action="<?php echo base_url('index.php/permintaan/simpanpermintaankeluar'); ?>" method="post">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>To : </label>
                    <input type="text" class="form-control has-feedback-left" name="txt_kepada" id="txt_kepada" placeholder="To" required>
                </div>          

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-user fa-fw"></span>
                    <label>Email : </label>
                    <input type="text" class="form-control has-feedback-left" name="txt_email" id="txt_email" placeholder="Email Address" required>
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

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
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

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-phone fa-fw"></span>
                    <label>Phone : </label>
                    <input type="text" maxlength="3" class="form-control has-feedback-left" name="txt_telp" id="txt_telp" placeholder="Section Phone Number" required>
                </div> 

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-info fa-fw"></span>
                    <label>Description</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_perihal" id="txt_perihal" placeholder="Description" required>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <span class="fa fa-edit fa-fw"></span>
                    <label>Request Detail </label>
                    <textarea class="col-md-12 col-sm-12 col-xs-12" name="txt_detail" id="txt_detail" placeholder="Request Detail" rows="4" required></textarea>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-eye fa-fw"></span>
                    <label>Mengetahui</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_tahu" id="txt_tahu" placeholder="Mengetahui">
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-pencil fa-fw"></span>
                    <label>Menyetujui</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_setuju" id="txt_setuju" placeholder="Menyetujui">
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

        <script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>

<script>
    /* Script untuk validasi input agar input numerik saja */
    $("#txt_telp").keyup(function() {
        $("#txt_telp").val(this.value.match(/[0-9]*/));
    });

    var roxyFileman = '../ckeditor/plugins/fileman/index.html';
    $(function () {
        CKEDITOR.replace('txt_detail', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
</script>      

<!-- END -->
    </div>
    
</div>
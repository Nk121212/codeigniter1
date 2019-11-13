<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">TAMBAH BAGIAN</h3>
        </div>
    </div>
    
    <div class="row">  

<!-- START -->
        <div class="x_content">
            <form action="<?php echo base_url('index.php/bagian/simpanbagian'); ?>" method="post">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-bank fa-fw"></span>
                    <label>Nama Bagian</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_namabagian" id="txt_namabagian" placeholder="Nama Bagian" required>                    
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table border="0" align="left">
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Simpan</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>

            </form>
        </div>      
<!-- END -->

    </div>
    
</div>
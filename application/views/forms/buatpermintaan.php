<style>
.thumb-image{
    width : 100%;
    height : 100%;
    border-radius : 25px;
}
</style>

<div id="page-wrapper" style="background-color:#eafbcf";>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">CREATE REQUEST</h3>
        </div>
    </div>
    
    <div class="row" style="font-size:12px;">  

<!-- START -->
        <div class="x_content">
            <form action="<?php echo base_url('index.php/permintaan/simpanpermintaan'); ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <span class="fa fa-info fa-fw"></span>
                    <label>Description</label>
                    <input type="text" class="form-control has-feedback-left" name="txt_perihal" id="txt_perihal" placeholder="Description" required>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <span class="fa fa-edit fa-fw"></span>
                    <label>Request Detail</label>
                    <textarea class="col-md-12 col-sm-12 col-xs-12" name="txt_detail" id="txt_detail" placeholder="Request Detail" rows="6" required></textarea>
                </div>

                <div class="col-md-6" id="image-holder">
                </div>

                <div class="col-md-6">
                    <span class="fa fa-upload"></span>
                    <label for="file">Upload Image</label>
                    <input type="file" id="file" class="form-control" name="file" placeholder="upload">
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" style="margin-top:50px;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $this->session->userdata("id"); ?>" required>
                        <table border="0" align="center">
                            <tr>
                                <td><button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send</button></td>
                            </tr>
                        </table>                            
                    </div>
                </div>

            </form>
        </div>         

<!-- END -->
    </div>
    
</div>

<script type="text/javascript">

$("#file").on('change', function () {

    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                        "class": "thumb-image"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    } else {
        alert("Pls select only images");
    }
});

</script>
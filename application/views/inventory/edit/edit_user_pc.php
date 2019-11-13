    <body>
        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">User PC</h3>
                </div>
            </div>
        
            <form action="<?php echo base_url();?>index.php/C_pc/update_user_pc" method="post">

                <div class="row">

                    <div class="col-lg-4">
                        <input type="text" name="id_up" id="id_up" value="<?php echo $id;?>" hidden>
                        <input onkeyup = "this.value = this.value.toUpperCase();" type="text" name="nm_user" id="nm_user" class="form-control" value="<?php echo $nm_user;?>">
                    </div>

                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
            

        </div>
    </body>

</html>
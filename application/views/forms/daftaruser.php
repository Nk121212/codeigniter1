<div id="page-wrapper" style="background-color:#d2f2f1;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">USER LIST</h3>
        </div>
    </div>

    <div class="row" style="font-size:12px;">  
        
<!-- START -->
        <table id="daftar_user" class="table table-striped table-bordered table-hover" style="width:100%;">
            <thead>
                <tr class="danger">
                    <th style="text-align:center;">Name</th>
                    <th style="text-align:center;">Username</th>
                    <th style="text-align:center;">Email Address</th>
                    <th style="text-align:center;">Level</th>
                    <th style="text-align:center;">Department</th>
                    <th style="text-align:center;">Section</th>
                    <th style="text-align:center;">Status</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($daftar_user->result_array() as $user): { ?>
                <tr>
                    <td><?php echo $user['nama']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['level']; ?></td>
                    <td><?php echo $user['nama_dept']; ?></td>
                    <td><?php echo $user['nama_bagian']; ?></td>
                    <td><?php echo $user['statuz']; ?></td>
                    <td>  
                        <?php if($user['statuz'] == 'Aktif') { ?>
                            <form action="<?php echo base_url('index.php/user/nonaktifkanuser'); ?>" method="post">                  
                                <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
                                <input class="btn btn-xs btn-danger" type="submit" value="Deactivate">    
                            </form> 
                        <?php } else { ?>                          
                            <form action="<?php echo base_url('index.php/user/aktifkanuser'); ?>" method="post">                  
                                <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
                                <input class="btn btn-xs btn-success" type="submit" value="Activate">    
                            </form>
                        <?php }; ?> 
                        
                        <br>

                        <form action="<?php echo base_url('index.php/user/edituser'); ?>" method="post">                  
                            <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
                            <input class="btn btn-xs btn-success" type="submit" value="Edit User"></br> 
                        </form>

				<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#cp" id="<?php echo $user['id']; ?>">Change Password</button>   
				
			   <script>
				$("#<?php echo $user['id']; ?>").click(function(){
					//var opener = e.relatedTarget;
					//var idp = $(opener).attr('id-p');
					var id = $("#<?php echo $user['id']; ?>").attr('id');
					//alert(id);
					$("#vu").val(id);
				})
			   </script>
			
                    </td>
                </tr>
                <?php } endforeach; ?>                       
            </tbody>
        </table>   
    <br>
	


<div class="container">
  	<!-- Modal -->
  	<div class="modal fade" id="cp" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
        </div>

<form method="post" action="<?php echo base_url('index.php/user/password_baru'); ?>" id="reset">
    <div class="modal-body">

        <input type="text" name ="vu" id="vu" hidden>
        <div class="row">
            <div class="col-lg-6">
            <span class="fa fa-phone fa-fw"></span>
            <label>Password</label>
            <input type="password" class="form-control has-feedback-left" name="txt_password" id="txt_password" value="" required>
            </div>

            <div class="col-lg-6">
            <span class="fa fa-phone fa-fw"></span>
            <label>Confirm Password</label>
            <input type="password" class="form-control has-feedback-left" name="txt_password1" id="txt_password1" value="" required>
            </div>
            </div>

            </div>

            <div class="modal-footer">
            
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>

        </div>
    </div>  
</form>   

    </div>
  </div>
  
	</div>

	
    <form action="<?php echo base_url('index.php/user/tambahuser'); ?>" method="post">     
        <button class="btn btn-success" data-toggle="modal" data-target="#ModalTambahDepartemen">ADD USER</button>
    </form>


    <hr>

<style>
     /*table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;a
    }

    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }*/

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<script>
document.getElementById("reset").reset();

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
    //------------------------------------------------------------------------------
    //Datatable
    $(document).ready(function() {
        //$('#tsi_usr_napp').DataTable();   //Polosan
        //$('#tsi_usr_napp2').DataTable();  //Polosan

        $('#daftar_user').DataTable({
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],       //Set Show Entries
            "iDisplayLength": 10                                                 //Set Default Show Entries
        });

    });
</script>

<!-- END -->

    </div>      
</div>
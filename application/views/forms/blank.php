<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>

    <div class="row"> 
<!-- Start -->

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="new_req"></div>
                                <div>New Requests !</div>
                            </div>
                        </div>
                    </div>
                    <?php $lvl = $this->session->userdata('level'); 
                        if($lvl == 'ADMIN' || $lvl == 'DEFAULT'){
                            echo '<a href="permintaan/daftarpermintaan">';
                        }else{
                            echo '<a href="permintaan/lihatpermintaan">';
                        }   
                    ?>
                        <div class="panel-footer">
                            <span class="pull-left">View List</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-wrench fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="serv_req"></div>
                                <div>Service Requests</div>
                            </div>
                        </div>
                    </div>
                    <?php $lvl = $this->session->userdata('level'); 
                        if($lvl == 'ADMIN' || $lvl == 'DEFAULT'){
                            echo '<a href="permintaan/daftarpermintaan">';
                        }else{
                            echo '<a href="permintaan/lihatpermintaan">';
                        }   
                    ?>
                        <div class="panel-footer">
                            <span class="pull-left">View List</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="item_req"></div>
                                <div>Items Requests</div>
                            </div>
                        </div>
                    </div>
                    <?php $lvl = $this->session->userdata('level'); 
                        if($lvl == 'ADMIN' || $lvl == 'DEFAULT'){
                            echo '<a href="permintaan/daftarpermintaan">';
                        }else{
                            echo '<a href="permintaan/lihatpermintaan">';
                        }   
                    ?>
                        <div class="panel-footer">
                            <span class="pull-left">View List</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-desktop fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="app_req"></div>
                                <div>Application Requests</div>
                            </div>
                        </div>
                    </div>
                    <?php $lvl = $this->session->userdata('level'); 
                        if($lvl == 'ADMIN' || $lvl == 'DEFAULT'){
                            echo '<a href="permintaan/daftarpermintaan">';
                        }else{
                            echo '<a href="permintaan/lihatpermintaan">';
                        }   
                    ?>
                        <div class="panel-footer">
                            <span class="pull-left">View List</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="complete_req"></div>
                                <div>Request Completed and Closed</div>
                            </div>
                        </div>
                    </div>
                    <?php $lvl = $this->session->userdata('level'); 
                        if($lvl == 'ADMIN' || $lvl == 'DEFAULT'){
                            echo '<a href="permintaan/daftarpermintaan">';
                        }else{
                            echo '<a href="permintaan/lihatpermintaan">';
                        }   
                    ?>
                        <div class="panel-footer">
                            <span class="pull-left">View List</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
			<script>
			$(document).ready(function(){
				$.ajax({  
					url: "<?php echo base_url(); ?>" + "index.php/ListController/new_req",
					method:"POST",
					data:{},             
						success:function(data){
							$("#new_req").html(data); 
							//console.log(data);
						}
				});
				
				$.ajax({  
					url: "<?php echo base_url(); ?>" + "index.php/ListController/serv_req",
					method:"POST",
					data:{},             
						success:function(data){
							$("#serv_req").html(data); 
							//console.log(data);
						}
				});
				
				$.ajax({  
					url: "<?php echo base_url(); ?>" + "index.php/ListController/item_req",
					method:"POST",
					data:{},             
						success:function(data){
							$("#item_req").html(data); 
							//console.log(data);
						}
				});
				
				$.ajax({  
					url: "<?php echo base_url(); ?>" + "index.php/ListController/app_req",
					method:"POST",
					data:{},             
						success:function(data){
							$("#app_req").html(data); 
							//console.log(data);
						}
				});
				
				$.ajax({  
					url: "<?php echo base_url(); ?>" + "index.php/ListController/complete_req",
					method:"POST",
					data:{},             
						success:function(data){
							$("#complete_req").html(data); 
							//console.log(data);
						}
				});
				
			})
			</script>

<!-- End -->
    </div>
</div>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
    
    <title>IT HELPDESK</title>
 
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url(); ?>sbadmin2/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>sbadmin2/dist/css/bootstrap-select.css" rel="stylesheet">

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
    <body>

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('index.php/dashboard'); ?>">IT HELPDESK - PT. SIPATEX PUTRI LESTARI</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> &nbsp;<?php echo $this->session->userdata('nama') ?> &nbsp;<i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php echo base_url('index.php/user/userprofile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="<?php echo base_url('index.php/user/ubahpassword'); ?>"><i class="fa fa-gear fa-fw"></i> Ubah Password</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('index.php/login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <!--
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </li>
                -->
                
                <li>
                    <a style="background-color:#ffc000; color:black;" href="<?php echo base_url('index.php/dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> <b>Dashboard</b></a>
                </li>

                <?php if($this->session->userdata("level") != 'ADMIN') { ?>
                    <?php if($this->session->userdata("level") != 'DEFAULT') { ?>
                        <li>
                            <a style="background-color:#86f010; color:black;" href="#"><i class="fa fa-edit fa-fw"></i> <b>Request</b><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a style="background-color:#eafbcf; color:black;" href="<?php echo base_url('index.php/permintaan/buatpermintaan'); ?>"><span class="fa fa-edit fa-fw"></span> <b>Create Request</b></a>
                                </li>
                                <li>
                                    <a style="background-color:#eafbcf; color:black;" href="<?php echo base_url('index.php/permintaan/lihatpermintaan'); ?>"><span class="fa fa-file-text-o fa-fw"></span> <b>My Requests List</b></a>
                                </li>
                            </ul>
                        </li>
                    <?php }; ?>   
                <?php }; ?>

                <?php if($this->session->userdata("level") == 'ADMIN' || $this->session->userdata("level") == 'DEFAULT') { ?>
                <li>
                    <a style="background-color:#23c149; color:black;" href="#"><i class="fa fa-edit fa-fw"></i> <b>Request Management</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a style="background-color:#d2f7d6; color:black;" href="<?php echo base_url('index.php/permintaan/buatpermintaanadmin'); ?>"><span class="fa fa-edit fa-fw"></span> <b>Create Request (Admin)</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d2f7d6; color:black;" href="<?php echo base_url('index.php/permintaan/daftarpermintaan'); ?>"><span class="fa fa-book fa-fw"></span> <b>All Requests List</b></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a style="background-color:#a53a90; color:black;" href="#"><i class="fa fa-edit fa-fw"></i> <b>Outward Request</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a style="background-color:#f7a8e7; color:black;" href="<?php echo base_url('index.php/permintaan/buatpermintaankeluar'); ?>"><span class="fa fa-edit fa-fw"></span> <b>Create Request (Outward)</b></a>
                        </li>
                        <li>
                            <a style="background-color:#f7a8e7; color:black;" href="<?php echo base_url('index.php/permintaan/daftarpermintaankeluar'); ?>"><span class="fa fa-book fa-fw"></span> <b>Outward Requests List</b></a>
                        </li>
                    </ul>
                </li>
                           
                <li>
                    <a style="background-color:#34d2c4; color:black;" href="#"><i class="fa fa-wrench fa-fw"></i> <b>Others</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a style="background-color:#d2f2f1; color:black;" href="<?php echo base_url('index.php/user/daftaruser'); ?>"><span class="fa fa-user fa-fw"></span> <b>Users List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d2f2f1; color:black;" href="<?php echo base_url('index.php/lainlain/daftardepartemen'); ?>"><span class="fa fa-building fa-fw"></span> <b>Department List</b></a>
                        </li> 
                        <li>
                            <a style="background-color:#d2f2f1; color:black;" href="<?php echo base_url('index.php/lainlain/daftarbagian'); ?>"><span class="fa fa-bank fa-fw"></span> <b>Section List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d2f2f1; color:black;" href="<?php echo base_url('index.php/lainlain/daftarkondisi'); ?>"><span class="fa fa-tasks fa-fw"></span> <b>Condition List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d2f2f1; color:black;" href="<?php echo base_url('index.php/lainlain/job_desc'); ?>"><span class="fa fa-tasks fa-fw"></span> <b>Job Description</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d2f2f1; color:black;" href="<?php echo base_url('index.php/cari_spv/spv_list'); ?>"><span class="fa fa-tasks fa-fw"></span> <b>Search Supervisor</b></a>
                        </li>

                        
                    </ul>
                </li>     

                <li>
                    <a style="background-color:#1464e5; color:black;" href="#"><i class="fa fa-laptop fa-fw"></i> <b>Sparepart</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_pc/view_user_pc'); ?>"><span class="fa fa-tag fa-fw"></span> <b>User PC List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_merk/merk_view'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Merk List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_type/type_view'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Type List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_processor/view_proc'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Processor List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_memory/view_memory'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Memory List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_hardisk/view_hardisk'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Hardisk List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_keyboard/view_keyboard'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Keyboard List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_mouse/view_mouse'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Mouse List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_monitor/view_monitor'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Monitor List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_printer/view_printer'); ?>"><span class="fa fa-tag fa-fw"></span> <b>Printer List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_cpu/view_cpu'); ?>"><span class="fa fa-tag fa-fw"></span> <b>CPU List</b></a>
                        </li>
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_pc/view_pc'); ?>"><span class="fa fa-tag fa-fw"></span> <b>PC List</b></a>
                        </li>
                    </ul>
                </li>                          

                <li>
                    <a style="background-color:#4473c5; color:black;" href="#"><i class="fa fa-file-text-o fa-fw"></i> <b>Report</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/permintaan/laporanpermintaan'); ?>"><span class="fa fa-file-text-o fa-fw"></span> <b>Request Report</b></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a style="background-color:#003177; color:white;" href="#"><i class="fa fa-file-text-o fa-fw"></i> <b>Cetak</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_pc_memo/index'); ?>"><span class="fa fa-file-text-o fa-fw"></span> <b>Memo PC</b></a>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_qrcode/index'); ?>"><span class="fa fa-file-text-o fa-fw"></span> <b>QR Code</b></a>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_service/index'); ?>"><span class="fa fa-file-text-o fa-fw"></span> <b>Service Card</b></a>
                            <a style="background-color:#d4d9ec; color:black;" href="<?php echo base_url('index.php/C_service/inspect_form'); ?>"><span class="fa fa-pencil fa-fw"></span> <b>Penjadwalan</b></a>
                        </li>
                    </ul>
                </li>
 
                <?php }; ?>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->

    <style>
    .mt {
        margin-top:10px;
    }
    </style>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Create QR Code</h3>
                </div>
            </div>

            <!--img src="<?php //echo base_url();?>img/0720190005.png" alt=""-->

            <div class="col-sm-12">
                <div class="row">

                    <form target="_blank" action="<?php echo base_url();?>index.php/C_qrcode/qrcode" method="post">
                        <div class="col-sm-6">
                            <select name="saoo" id="saoo" class="form-control" required>
                                <option value="0" disabled selected>Choose</option>
                                <option value="1" >Create All</option>
                                <option value="2" >Create By Id</option>
                            </select>
                        </div>
                        <div class="col-sm-3 sumput">
                            <?php
                                $qap = $this->db->query("
                                    select * from master_pc where hapus is null
                                ");

                                echo '
                                    <select class="selectpicker" name="uid_pc[]" multiple data-live-search="true">
                                ';
                                    foreach($qap->result() as $dtpc){
                                            $id_pc = $dtpc->uid;
                                            $nm_pc = $dtpc->nama_pc;
                                            echo '
                                                <option value="'.$id_pc.'">'.$nm_pc.'</option>
                                            ';
                                        }
                                echo '
                                    </select>
                                ';
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-success" type="submit" id="sfqr">Create</button>
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>

    </body>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/morrisjs/morris.min.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin2/data/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>sbadmin2/dist/js/sb-admin-2.js"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin2/vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin2/js/bootstrap-select.min.js"></script>

        <script>
            $(document).ready(function(){
                $(".sumput").hide();
                $("#sfqr").hide();
            })

            $("#saoo").change(function(){
                var aoo = $(this).val();
                if(aoo == 1){
                    $("#sfqr").show();
                    $(".sumput").hide();
                }else{
                    $("#sfqr").show();
                    $(".sumput").show();
                }
            })
        </script>

</html>
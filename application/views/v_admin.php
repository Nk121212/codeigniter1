<!DOCTYPE html>
<html>
<head>
    <title>IT HELPDESK</title>
	<meta charset="utf-8"/>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css"/>
    
    <script src="<?php echo base_url(); ?>js/frontend.js" type="text/javascript"></script>
        

</head>

<body>
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="{{ url ('') }}">SB Admin v2.0 | Laravel 5</a>  ============================== ini Judul -->
                <a class="navbar-brand" href="{{ url ('main') }}">~ IT HELPDESK ~</a>                
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown-alerts -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata("nama"); ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url ('userprofile') }}"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->
 
            <!-- NAVIGATION SIDE BAR START HERE -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <!-- dashboard --> 
                        <li {{ (Request::is('/main') ? 'class="active"' : '') }}>
                            <a href="{{ url ('main') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>         

                        <!-- My Project -->
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>Inisialisasi Project<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('/viewmyproject') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('viewmyproject') }}">Lihat Project Saya</a>
                                </li>                             

                                @if($userpro->proppro==1)
                                <li {{ (Request::is('/proposeproject') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('proposeproject') }}">Pengajuan Draft Project</a>
                                </li>  
                                @endif 
                            </ul>                            
                        </li> 
                        
                        <!-- Project Management --> 
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Project Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if($userpro->viewpro==1)
                                <li {{ (Request::is('/viewprojectlist') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('viewprojectlist') }}">Lihat Daftar Project</a>
                                </li>
                                @endif

                                @if($userpro->appvend==1)
                                <li {{ (Request::is('/viewproposevendorlist') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('viewproposevendorlist') }}">Lihat Daftar Pengajuan Kontrak dan Penawaran Vendor</a>
                                </li>  
                                @endif
                            </ul>                            
                        </li> 

                        <!-- Vendor Management -->
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i>Vendor Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if($userpro->viewvend==1)
                                <li {{ (Request::is('/viewvendorlist') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('viewvendorlist') }}">Lihat Daftar Vendor</a>
                                </li>
                                @endif

                                @if($userpro->tambahvend==1)
                                <li {{ (Request::is('/addnewvendor') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('addnewvendor') }}">Tambah Vendor Baru</a>
                                </li>
                                @endif

                                @if($userpro->propvend==1)
                                <li {{ (Request::is('/proposevendor') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('proposevendor') }}">Tambah Pengajuan Kontrak dan Penawaran Vendor</a>
                                </li>  
                                @endif                                 
                            </ul>                            
                        </li> 

                        <!-- User Management --> 
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if($userpro->lihatuser==1)
                                <li {{ (Request::is('/viewuserlist') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('viewuserlist') }}">View User List</a>
                                </li>
                                @endif

                                @if($userpro->tambahuser==1)
                                <li {{ (Request::is('/addnewuser') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('addnewuser') }}">Add New User</a>
                                </li>  
                                @endif                 
                            </ul>                            
                        </li> 

                        <!-- Forms menu -->                        
                        <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                            <a href="{{ url ('buttons') }}"><i class="fa fa-edit fa-fw"></i>Buttons</a>
                        </li> 

                        <li {{ (Request::is('*forms') ? 'class="active"' : '') }}>
                            <a href="{{ url ('forms') }}"><i class="fa fa-edit fa-fw"></i>Forms</a>
                        </li>       

                         <li {{ (Request::is('*testuploadfiles') ? 'class="active"' : '') }}>
                            <a href="{{ url ('testuploadfiles') }}"><i class="fa fa-edit fa-fw"></i>Upload Files</a>
                        </li>                  

                        <!-- chart menu --> 
                        <li {{ (Request::is('*charts') ? 'class="active"' : '') }}>
                            <a href="{{ url ('charts') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</a>                            
                        </li>  
                    


                    </ul>
                </div>               
            </div>   
        </nav>

        <?php include "forms/blank.php"; ?>
        <?php include "forms/test1.php"; ?>
    </div>
	
</body>
</html>
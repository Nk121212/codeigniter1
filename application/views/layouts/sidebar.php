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
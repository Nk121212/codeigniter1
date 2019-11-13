    <!-- /.navbar-static-side -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="<?php echo base_url('index.php/dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Permintaan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('index.php/permintaan/buatpermintaan'); ?>"><span class="fa fa-edit fa-fw"></span> Buat Permintaan</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/permintaan/lihatpermintaan'); ?>"><span class="fa fa-file-text-o fa-fw"></span> Lihat Permintaan</a>
                        </li>
                    </ul>
                </li>

                <?php if($this->session->userdata("level") == 'IT' || $this->session->userdata("level") == 'DEFAULT') { ?>
                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Management Permintaan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('index.php/permintaan/buatpermintaanadmin'); ?>"><span class="fa fa-edit fa-fw"></span> Buat Permintaan</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/permintaan/daftarpermintaan'); ?>"><span class="fa fa-book fa-fw"></span> Daftar Permintaan</a>
                        </li>
                    </ul>
                </li>
                <?php }; ?>

                <?php if($this->session->userdata("level") == 'IT' || $this->session->userdata("level") == 'DEFAULT') { ?>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Management User<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('index.php/user/tambahuser'); ?>"><span class="fa fa-user fa-fw"></span> Tambah User</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/user/daftaruser'); ?>"><span class="fa fa-file-text-o fa-fw"></span> Daftar User</a>
                        </li>
                    </ul>
                </li>
                <?php }; ?>

                <?php if($this->session->userdata("level") == 'IT' || $this->session->userdata("level") == 'DEFAULT') { ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Lain - Lain<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('index.php/lainlain/daftardepartemen'); ?>"><span class="fa fa-file-text-o fa-fw"></span> Daftar Departemen</a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url('index.php/lainlain/daftarbagian'); ?>"><span class="fa fa-file-text-o fa-fw"></span> Daftar Bagian</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/lainlain/daftarkondisi'); ?>"><span class="fa fa-file-text-o fa-fw"></span> Daftar Kondisi</a>
                        </li>
                    </ul>
                </li>
                <?php }; ?>

                <li>
                    <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('index.php/permintaan/laporanpermintaan'); ?>"><span class="fa fa-file-text-o fa-fw"></span> Laporan Permintaan</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
    
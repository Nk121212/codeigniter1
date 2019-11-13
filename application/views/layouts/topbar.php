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
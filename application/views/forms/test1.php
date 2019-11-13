<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Login berhasil !</h1>
        </div>
    </div>
    <div class="row">  
        <p>Hai, <?php echo $this->session->userdata("id"); ?></p>
        <p>Hai, <?php echo $this->session->userdata("nama"); ?></p>
        <p>Hai, <?php echo $this->session->userdata("email"); ?></p>
        <p>Hai, <?php echo $this->session->userdata("level"); ?></p>
        <a href="<?php echo base_url('index.php/login/logout'); ?>">Logout</a>
    </div>
</div>
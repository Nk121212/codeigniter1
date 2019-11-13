<html>
<head></head>
<body>
    <?php
        if($kategori == 'add'){
            echo '
                <h3>Selamat Datang Di Aplikasi IT-Helpdesk</h3>
                <p>User email : <b>'.$email.'</b> dan Password : <b>'.$password.'</b> sudah berhasil dibuat</p>
                <p>Silahkan gunakan Aplikasi IT-Helpdesk <a href="http://help-desk.local.sipatex.co.id:3500/">Disini.</a></p>
                <p>Untuk Bantuan Reset Password Silakan hubungi IT Division setempat.</p>
                <p>Terima Kasih.</p>
                </br></br>
                <p>Team IT Developer</p></br>
                <p>PT. Sipatex</p></br>
                <p>Bandung</p>
            ';
        }elseif($kategori == 'edit'){
            echo '
            <h3>Selamat Datang Di Aplikasi IT-Helpdesk</h3>
            <p>User email : '.$email.' sudah berhasil diubah</p>
            <p>Silahkan gunakan Aplikasi IT-Helpdesk <a href="http://help-desk.local.sipatex.co.id:3500/">Disini.</a></p>
            <p>Untuk Bantuan Reset Password Silakan hubungi IT Division setempat.</p>
            <p>Terima Kasih.</p>
            </br></br>
            <p>Team IT Developer</p></br>
            <p>PT. Sipatex</p></br>
            <p>Bandung</p>
            ';
        }else{
		echo '
            <h3>Selamat Datang Di Aplikasi IT-Helpdesk</h3>
            <p>Password untuk akun '.$email.' sudah berhasil diubah</p>
            <p>Silahkan gunakan Aplikasi IT-Helpdesk <a href="http://help-desk.local.sipatex.co.id:3500/">Disini.</a></p>
            <p>Untuk Bantuan Reset Password Silakan hubungi IT Division setempat.</p>
            <p>Terima Kasih.</p>
            </br></br>
            <p>Team IT Developer</p></br>
            <p>PT. Sipatex</p></br>
            <p>Bandung</p>
            ';	
	 }
    ?>
</body>
</html>
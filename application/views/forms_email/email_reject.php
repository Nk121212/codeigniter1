<html>
    <head></head>
    <body>
        <h3>Selamat Datang Di Aplikasi IT-Helpdesk</h3>
        <p>Permintaan dengan ID <?php echo $id_permintaan; ?> Telah <b>Ditolak</b> Atasan</p>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">PERMINTAAN DETAIL</h3>
            <hr>
        </div>
    </div>
<div class="row">  

    <div class="col-lg-12">      

        <table>
            <?php foreach($data_permintaan->result_array() as $hasil): { ?>

            <tr>
                <td >ID Permintaan</td>
                <td width="1%">:</td> 
                <td width="79%"><?php echo $hasil['id_permintaan']; ?></td> 
            </tr>
            
            <tr>
                <td>Nama</td>
                <td> : </td>
                <td><?php echo $hasil['nama']; ?></td>
            </tr>

            <tr>
                <td>Email Address</td>
                <td> : </td>
                <td><?php echo $hasil['emailaddress']; ?></td>
            </tr>

            <tr>
                <td>Departemen</td>
                <td> : </td>
                <td><?php echo $hasil['dept2']; ?></td>
            </tr>

            <tr>
                <td>Bagian</td>
                <td> : </td>
                <td><?php echo $hasil['bagian2']; ?></td>
            </tr>      

            <tr>
                <td>Telp</td>
                <td> : </td>
                <td><?php echo $hasil['telp']; ?></td>
            </tr> 

            <tr>
                <td>Perihal</td>
                <td> : </td>
                <td><?php echo $hasil['perihal']; ?></td>
            </tr>   

            <tr>
                <td>Detail</td>
                <td> : </td>
                <td><?php echo $hasil['detail']; ?></td>
            </tr>             

            <?php } endforeach; ?> 
        </table>
        
        <br>
        <h3>LOG PERMINTAAN</h3>
        <hr>

        <table>              
            <tr>
                <th width="35%">Status</td>
                <th width="40%">Keterangan</td>
                <th width="15%">Pada</td>
                <th width="10%">Oleh</th>
            </tr>

            <?php foreach($data_log_permintaan->result_array() as $hasil2): { ?>

            <tr>                    
                <td><?php echo $hasil2['statuz']; ?></td>
                <td><?php echo $hasil2['keterangan']; ?></td>
                <td><?php echo $hasil2['pada']; ?></td>
                <td><?php echo $hasil2['user']; ?></td>
            </tr>

            <?php } endforeach; ?>
        </table>

        <br>
       
    </div>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
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
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

</div>
</div>

        <p>Untuk Membuat Request Baru</p>
        <p>Silahkan gunakan Aplikasi IT-Helpdesk <a href="http://help-desk.local.sipatex.co.id:3500/">Disini.</a></p>
        <p>Terima Kasih.</p>
        </br></br>
        <p>Team IT Developer</p></br>
        <p>PT. Sipatex</p></br>
        <p>Bandung</p>
    </body>
</html>
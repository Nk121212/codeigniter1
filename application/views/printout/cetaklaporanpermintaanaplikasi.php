<!DOCTYPE html>
<html>
<head>
    <title>CETAK LAPORAN PERMINTAAN APLIKASI</title>
    <style>
        th{
            font-size: 10px;
            text-align: center;
        }

        label{
            font-size: 10px;
        }

        td{
            font-size: 10px;
        };
    </style>
</head>
<body>  

    <h5 align="center">LAPORAN PERMINTAAN APLIKASI</h5>
    <h6 align="center">Periode : <?php echo $dari; ?> s/d <?php echo $sampai; ?></h6>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Permintaan</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Departemen</th>
                <th>Bagian</th>
                <th>Telp</th>
                <th>Perihal</th>
                <th>Detail</th>
                <th>Respon</th>
                <th>Jenis</th>
                <th>No. Bukti</th>
                <th>Respon Time</th>
                <th>Proses Time</th>
                <th>Status</th>
                <th>Pada</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($view_data_permintaan_aplikasi->result_array() as $hasil) { ?>
            <tr>
                <td width="5%"><?php echo $i.'.';?></td>
                <td><?php echo $hasil['id_permintaan']; ?></td>
                <td><?php echo $hasil['nama']; ?></td>
                <td><?php echo $hasil['emailaddress']; ?></td>
                <td><?php echo $hasil['dept2']; ?></td>
                <td><?php echo $hasil['bagian2']; ?></td>
                <td><?php echo $hasil['telp']; ?></td>
                <td><?php echo $hasil['perihal']; ?></td>
                <td><?php echo $hasil['detail']; ?></td>
                <td><?php echo $hasil['respon']; ?></td>
                <td><?php echo $hasil['jenis']; ?></td>
                <td><?php echo $hasil['id_bukti']; ?></td>
                <td><?php echo $hasil['respon_time']; ?></td>
                <td><?php echo $hasil['proses_time']; ?></td>
                <td><?php echo $hasil['statuz']; ?></td>
                <td><?php echo $hasil['dibuat']; ?></td>
            </tr>
            <?php $i++; }; ?>
        </tbody> 
    </table>
 
    <br>

    <label>Laporan ini dibuat oleh <strong><?php echo $this->session->userdata('nama'); ?></strong> pada <strong><?php echo date('d F Y h:i:s'); ?></strong>. </label> 

</body>
</html>
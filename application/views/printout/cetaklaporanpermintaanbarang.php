<!DOCTYPE html>
<html>
<head>
    <title>CETAK LAPORAN PERMINTAAN BARANG</title>
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

    <h5 align="center">LAPORAN PERMINTAAN BARANG</h5>
    <h6 align="center">Periode : <?php echo $dari; ?> s/d <?php echo $sampai; ?></h6>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Permintaan</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Departemen</th>
                <th>Detail</th>
                <th>Respon</th>
                <th>Job Desc</th>
                <th>Respon Time</th>
                <th>Proses Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($view_data_permintaan_barang->result_array() as $hasil) { ?>
            <tr>
                <td><?php echo $i.'.';?></td>
                <td><?php echo $hasil['id_permintaan']; ?></td>
                <td><?php echo $hasil['nama']; ?></td>
                <td><?php echo $hasil['emailaddress']; ?></td>
                <td><?php echo $hasil['dept2']; ?></td>
                <td><?php echo $hasil['detail']; ?></td>
                <td><?php echo $hasil['respon']; ?></td>
                <td><?php echo $hasil['job_desc']; ?></td>
                <td><?php echo $hasil['respon_time']; ?></td>
                <td><?php echo $hasil['proses_time']; ?></td>
                <td><?php echo $hasil['statuz']; ?></td>
            </tr>
            <?php $i++; }; ?>
        </tbody> 
    </table>
 
    <br>

    <label>Laporan ini dibuat oleh <strong><?php echo $this->session->userdata('nama'); ?></strong> pada <strong><?php echo date('d F Y h:i:s'); ?></strong>. </label> 

</body>
</html>
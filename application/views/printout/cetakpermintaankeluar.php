<!DOCTYPE html>
<html>
<head>
    <title>CETAK PERMINTAAN</title>
    <style>
        td{
            font-size: 10px;
        };
    </style>
</head>
<body>  

    <?php foreach($ambil_data_permintaan->result_array() as $hasil): { ?>
    
    <table border="0" width="100%">

        <tr>
            <td colspan="6">
                <div align="left">
                    PT. SIPATEX PUTRI LESTARI
                    <img src="/home/web-apps/www/help-apps/img/lg3.png" alt="Icon1" style="width:52px;height:25px"; align="right"/>
                </div>
                <div align="center">&nbsp;</div>
            </td>
        </tr>

        <tr>
            <td colspan="6" align="center">
                <div style="text-align:center; font-size:100%;"><b>PERMINTAAN KELUAR</b></div>
            </td>
        </tr>

        <tr>
            <td colspan="3" align="left">*</td>
            <td colspan="3" align="right">Tanggal : <?php echo date("d F Y", strtotime($hasil['pada']));?></td>
        </tr>

        <tr>
            <td colspan="6">
                
                <table border="1" align="center" width="100%">
                    <tr>
                        <td colspan="3" width="50%">
                            <table border="0" width="100%">
                                <tr>
                                    <td width="35%">NO. PERMINTAAN </td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?php echo $hasil['id_permintaan'];?></td>
                                </tr>   
				<tr class="clearfix">
					<td>DARI</td>
					<td>:</td>
					<td>IT</td>
				</tr> 
				<tr class="clearfix">
					<td>BAGIAN</td>
					<td>:</td>
					<td>DIVISI IT</td>
				</tr> 
                                <tr>
                                    <td>PERIHAL</td>
                                    <td>:</td>
                                    <td><?php echo $hasil['perihal'];?></td>                                        
                                </tr>
                                
                                
                                <tr class="clearfix"><td colspan="3">&nbsp;</td></tr>
                            </table>
                        </td>

                        <td colspan="3" width="50%">
                            <table border="0" width="100%">
                                <tr>
                                    <td width="25%">KEPADA</td>
                                    <td width="5%">:</td>
                                    <td width="75%"><?php echo $hasil['nama'];?></td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>:</td>
                                    <td><?php echo $hasil['emailaddress'];?></td>
                                </tr>
                                <tr>
                                    <td>DEPARTEMEN</td>
                                    <td> : </td>
                                    <td><?php echo $hasil['dept2'];?></td>
                                </tr>
                                <tr>
                                    <td>BAGIAN</td>
                                    <td> : </td>
                                    <td><?php echo $hasil['bagian2'];?></td>
                                </tr>
                                <tr>
                                    <td>TELP</td>
                                    <td> : </td>
                                    <td><?php echo $hasil['telp'];?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                    <td colspan="6">

                        <table border="0" width="100%">
                            <tr>
                                <td colspan="6">DETAIL PERMINTAAN : </td>
                            </tr>
                            <tr>
                                <td>Dengan Hormat, </td>
                            </tr>
                            <tr><td colspan="6"><?php echo $hasil['detail'];?></td></tr>   
                            <tr>
                                <td>
                                    Terima Kasih
                                </td>
                            </tr>                                                              
                            <tr><td colspan="6"><br></td></tr>                                            
                            
                            <tr>                                    
                                <td colspan="2" align="center" width="50%">
                                    <div style="text-align: center;">Pemohon</div>
                                </td>
                                <td colspan="2" align="center" width="50%">
                                    <div style="text-align: center;">Mengetahui</div>
                                </td>
                                <td colspan="2" align="center" width="50%">
                                    <div style="text-align: center;">Menyetujui **</div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6" align="center" width="100%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6" align="center" width="100%">&nbsp;</td>
                            </tr>
                            

                            <tr>                                 
                                <td colspan="2" align="center" width="50%">
                                    <div style="text-align:center;">
                                        <?php //echo $hasil['nama'];
                                        echo $this->session->userdata('nama');
                                        ?>
                                    </div>                                        
                                </td>
                                <td colspan="2" align="center" width="50%">
                                    <div style="text-align:center;">
                                        <?php echo $hasil['mengetahui'];?>
                                    </div>                                        
                                </td>
                                <td colspan="2" align="center" width="50%">
                                    <div style="text-align:center;">
                                        <?php echo $hasil['menyetujui'];?>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr><td colspan="6" ><br></td></tr>
                        </table>

                    </td>
                </tr>

                </table>  
                    
            </td>
        </tr>

    </table>
    <?php }; endforeach;?>
    <label style="font-size: 10px;">Ket : (*) = PERMINTAAN ini silahkan di print jika memang diperlukan.</label>
    <br>
    <label style="font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (**) = Menyetujui silahkan di isi jika memang diperlukan.</label>
    <br><br>
    <label style="font-size: 10px;">Dicetak pada : <?php echo date("d F Y h:i:s "); ?> oleh <?php echo $this->session->userdata('nama'); ?></label>
</body>
</html>

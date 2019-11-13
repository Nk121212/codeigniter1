<!DOCTYPE html>
<html>
<head>
    <title>CETAK BUKTI PENYERAHAN APLIKASI / UPDATE APLIKASI</title>
    <style>
        td{
            font-size: 10px;
        };
    </style>
</head>
<body>  

    <?php foreach($data_bukti_updateaplikasi->result_array() as $hasil): { ?>
    
    <table border="0" width="100%">

        <tr>
            <td colspan="6">
                <div align="left">
                    PT. SIPATEX PUTRI LESTARI 
                    <img src="D:\wamp\www\adi_lit_web\public\img\lg3.png" alt="Icon1" style="width:52px;height:25px"; align="right"/>
                </div>
                <div align="center">&nbsp;</div>
            </td>
        </tr>

        <tr>
            <td colspan="6" align="center">
                <div style="text-align:center; font-size:100%;"><b>BUKTI PENYERAHAN APLIKASI / UPDATE APLIKASI</b></div>
            </td>
        </tr>

        <tr>
            <td colspan="3" align="left">NO. BUKTI UPDATE : <strong><?php echo $hasil['id_bukti'];?></strong> *</td>
            <td colspan="3" align="right">Tanggal : <?php echo date("d F Y", strtotime($hasil['pada']));?></td>
        </tr>

        <tr>
            <td colspan="6">
                
                <table border="1" align="center" width="100%">
                    <tr>
                        <td colspan="3" width="50%">
                            <table border="0" width="100%">
                                <tr>
                                    <td colspan="3"><strong>BERDASARKAN PERMINTAAN :</strong></td>
                                </tr>
                            </table>
                            <table border="0" width="100%">  
                                <tr>
                                    <td width="30%">NO. PERMINTAAN </td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?php echo $hasil['id_permintaan'];?></td>
                                </tr>   
                                <tr>
                                    <td>DARI</td>
                                    <td>:</td>
                                    <td><?php echo $hasil['nama'];?></td>
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

                        <td colspan="3" width="50%">
                            <table border="0" width="100%">            
                                <tr>
                                    <td colspan="3"><strong>DETAIL PERMINTAAN :</strong></td>                
                                </tr>
                            </table>
                            <table border="0" width="100%">
                                <tr>
                                    <td width="30%">PERIHAL</td>
                                    <td width="5%">:</td>
                                    <td width="65%"><?php echo $hasil['perihal'];?></td>                                        
                                </tr>
                                <tr>
                                    <td rowspan="5" valign="top">DETAIL</td>
                                    <td>:</td>
                                    <td rowspan="5" valign="top"><?php echo $hasil['detail'];?></td>                                        
                                </tr>  
                                <tr>                                    
                                    <td width="5%">&nbsp;</td>                                                                                                 
                                </tr> 
                                <tr>                                
                                    <td width="5%">&nbsp;</td>                                                                                
                                </tr> 
                                <tr>                                 
                                    <td width="5%">&nbsp;</td>                                                                                
                                </tr>     
                                <tr>                                 
                                    <td width="5%">&nbsp;</td>                                                                                
                                </tr>   
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">

                            <table border="0" width="100%">
                                <tr><td colspan="6"><strong>APLIKASI YANG DISERAHKAN / DIUPDATE : </strong></td></tr>
                                <tr><td colspan="6"><?php echo $hasil['keterangan'];?></td></tr>                                                                 
                                <tr><td colspan="6"><br></td></tr>                                            
                                
                                <tr>                                    
                                    <td colspan="2" align="center" width="33%">
                                        <div style="text-align: center;">Yang Menyerahkan</div>
                                    </td>
                                    <td colspan="2" align="center" width="33%">
                                        <div style="text-align: center;">Diterima Oleh</div>
                                    </td>
                                    <td colspan="2" align="center" width="33%">
                                        <div style="text-align: center;">Mengetahui</div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6" align="center" width="100%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="6" align="center" width="100%">&nbsp;</td>
                                </tr>

                                <tr>                                 
                                    <td colspan="2" align="center" width="33%">
                                        <div style="text-align:center;"><?php echo $hasil['nama_teknisi'];?></div>                                        
                                    </td>
                                    <td colspan="2" align="center" width="33%">
                                        <div style="text-align:center;"><?php echo $hasil['nama'];?></div>                                        
                                    </td>
                                    <td colspan="2" align="center" width="33%">
                                        <div style="text-align:center;">.........................</div>
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
    <label style="font-size: 10px;">Ket : * = BUKTI PENYERAHAN APLIKASI / UPDATE APLIKASI ini silahkan di print jika memang diperlukan.</label>
    <br>
    <label style="font-size: 10px;">Dibuat pada : <?php echo date("d F Y h:i:s", strtotime($hasil['pada'])); ?> oleh <?php echo $hasil['dibuat_oleh']; ?></label>
    <br>
    <label style="font-size: 10px;">Dicetak pada : <?php echo date("d F Y h:i:s"); ?> oleh <?php echo $this->session->userdata('nama'); ?></label>
</body>
</html>

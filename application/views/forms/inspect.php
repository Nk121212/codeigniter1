<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Penjadwalan</h3>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Buat Jadwal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jadwal Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?php echo base_url();?>index.php/C_service/add_jadwal" method="post">

                        <div class="row">
                            <div class="col-lg-6">
                            
                                <select name="bag" id="bag" class="form-control">
                                    <option value="" disabled selected>Lokasi / Divisi</option>
                                    <?php 
                                        $sd = $this->db->query("
                                            select * from tbl_bagian order by nama_bagian
                                        ");

                                        foreach($sd->result() as $dtdiv){

                                            echo '
                                                <option value="'.$dtdiv->kd.'">'.$dtdiv->nama_bagian.'</option>
                                            ';

                                        }
                                    ?>
                                </select>

                            </div>

                            <div class="col-lg-6"> 
                                <select name="jns_ins" id="jns_ins" class="form-control">
                                        <option value="" disababled selected>Jenis Jadwal</option>
                                        <option value="Inspeksi Hardware">Inspeksi Hardware</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-12" style="margin-top:10px;"></div>

                            <div class="col-lg-6"> 
                                <input type="text" name="est_mulai" id="est_mulai" class="form-control" placeholder="Mulai">
                            </div>

                            <div class="col-lg-6"> 
                                <input type="number" name="est_hari" id="est_hari" class="form-control" placeholder="Rentang Hari">
                            </div>

                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Lokasi</th>
                <th>Jenis</th>
                <th>Est Mulai</th>
                <th>Durasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
                $dtj = $this->db->query("
                    SELECT a.*, b.nama_bagian FROM jadwal a
                    left join tbl_bagian b on a.lokasi = b.kd
                    ORDER BY g_id DESC;
                ");
                $no = 1;
                foreach($dtj->result() as $dt){
                    echo '
                    <tr>
                        <td>'.$no.'</td>
                        <td>'.$dt->g_id.'</td>
                        <td>'.$dt->nama_bagian.'</td>
                        <td>'.$dt->jenis.'</td>
                        <td>'.$dt->est_mulai.'</td>
                        <td>'.$dt->est_hari.' Hari</td>
                        <td>
                            <a target="_blank" data-toggle="tooltip" title="Print" href="'.base_url().'index.php/C_service/print_jadwal/'.$dt->id.'" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                            <a data-toggle="tooltip" title="Update" href="#" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i></a>
                            <a data-toggle="tooltip" title="Edit" href="'.base_url().'index.php/C_service/edit_page/'.$dt->id.'" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                            <a onclick="return confirm(\'Yakin delete ?\');" data-toggle="tooltip" title="Hapus" href="'.base_url().'index.php/C_service/del_jadwal/'.$dt->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    ';
                    $no++;
                }
            ?>
            
        </tbody>
    </table>

</div>

<link rel="stylesheet" href="<?php echo base_url();?>dt_picker/css/bootstrap-datepicker.css">
<script src="<?php echo base_url();?>dt_picker/js/bootstrap-datepicker.js"></script>

<script>

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

    $('#est_mulai').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        }
    );

</script>

    
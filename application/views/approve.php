<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css">
        <style>
            .bold{
                font-weight:bold;
            }
        </style>
    </head>
    <body onload="alert1()">

            <div align="center">
                <div class="col-lg-8 card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10">

                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-danger" onclick="close()"></button><i style="cursor:pointer;" class="fa fa-times"></i>
                            </div>
                            
                        </div>
                        Approval Form
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Permintaan Detail</h5>
                        <p id="pemohon"></p>
                        <p class="card-text" id="perihal"></p>
                        <p class="card-text" id="detail"></p>
                        <p class="card-text" id="dept"></p>
                        <textarea class="form-control" id="alasan" name="alasan" placeholder="Tulis alasan disini !" style="margin-bottom: 10px;"></textarea>
                        <!--button class="btn btn-primary" onclick="tes()">Klik Disini Untuk merespon permintaan !</button-->
                        <button onclick="approve()" class="btn btn-outline-success"><i class="fa fa-check"></i> Accept</button>
                        <button onclick="reject()" class="btn btn-outline-danger"><i class="fa fa-ban"></i> Reject</button>
                    </div>
                </div>
            </div>
            <!-- ========================================================================================== -->
            <input id="idp" type="text" value="<?php echo $data; ?>" hidden>
	        <input id="iduser" name="iduser" type="text" hidden>

        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/sweetalert.min.js"></script>
        
        <script>
        function alert1(){
            var id = $("#idp").val();
                $.ajax({  
                url: "<?php echo base_url(); ?>"+"index.php/ApproveController/notif",
                method:"POST",
                data:{id:id},
                    success:function(data){     
                    //alert(resp);
                        console.log(data);
                        for (var i in data){
                            var pemohon_txt = 'Pemohon : ';
                            var perihal_txt = 'Perihal : ';
                            var detail_txt = 'Detail : ';
                            var dept_txt = 'Departemen : ';
                            var a = data[0].nama;
                            var b = data[0].perihal;
                            var c = data[0].detail;
                            var d = data[0].departemen;
                            document.getElementById("pemohon").innerHTML = pemohon_txt + a;
                            document.getElementById("perihal").innerHTML = perihal_txt + b;
                            document.getElementById("detail").innerHTML = detail_txt + c;  
                            document.getElementById("dept").innerHTML = dept_txt + d;  
				            $("#iduser").val(data[0].iduser);
                        }
                    }
                });    
        }
        function close(){
            window.close();
            open(location, '_self').close();
        }
        function approve(){
            var id = $("#idp").val();
            var alasan = $("#alasan").val();
	        var iduser = $("#iduser").val();
                $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/ApproveController/update_approve",
                method:"POST",
                data:{id:id,alasan:alasan,iduser:iduser},
                success:function(resp){
                    console.log(resp);
                    swal({
                        title: "Approve",
                        text: resp,
                        icon: "success",
                        button: "Ok",
                    });

                    //alert(resp);
			        //open(location, '_self').close();
                }
            });
        }
        function reject(){
            var id = $("#idp").val();
            var alasan = $("#alasan").val();
            var iduser = $("#iduser").val();
                $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/ApproveController/update_reject",
                method:"POST",
                data:{id:id,alasan:alasan,iduser:iduser},
                success:function(resp){
                    //alert(resp);
                    swal({
                    title: "Reject",
                    text: resp,
                    icon: "error",
                    button: "Ok",
                    });
			        //open(location, '_self').close();
                    //window.close();
                }
            });
        }

        /*function tes(){
            //confirm("Press");
            if (confirm("Klik OK Untuk Approve !")) {
                var id = $("#idp").val();
                $.ajax({  
                url: "<?php echo base_url(); ?>" + "index.php/ApproveController/update",
                method:"POST",
                data:{id:id},
                    success:function(resp){     
                    alert(resp);
                    alert("Terima Kasih");
                    //location.reload();  
                    window.close();          
                    }  
                });
            }else {
                alert("Terima Kasih");
                window.close();
            }
        }*/
        </script>
    </body>
</html>
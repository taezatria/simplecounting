<?php
    session_start();
    $_SESSION['page'] = "customer";
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
        <?php include 'header.php'; ?>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">New Customer</h4>
                            <p class="category"></p>
                        </div>
                        <div class="content">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control border-input" id="nama">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control border-input" id="alamat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control border-input" id="telp">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="text" class="form-control border-input" id="email">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-top: 25px;">
                                            <button type="button" class="btn btn-primary btn-fill" id="addcust">Add Customer</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                            <h4 class="title">Customer</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>E-mail</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>

        </div>

        <!-- Modal -->
        <div id="detailModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- Title nya -->
                <h4 class="modal-title">Customer's Order</h4>
              </div>
              <!-- Isi nya -->
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control border-input" id="idcust" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control border-input" id="namecust" readonly>
                        </div>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>ID Sales</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </thead>
                    <tbody id="detBody">
                    </tbody>
                </table>
                </div>
              </div>
              <!-- footernya -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
    </body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#<?php echo $_SESSION['page'] ?>").addClass("active");
            showData();
            $("#addcust").click(function(){
                if(!$("#nama").val() || !$("#alamat").val() || !$("#telp").val() || !$("#email").val()) {
                    alert("Please Fill the Blank");
                }
                else {
                    addCustomer();
                }
            });
            $("#tbody").on("click","tr",function(){
                var id = $(this).children("td:eq(0)").html();
                var nama = $(this).children("td:eq(1)").html();
                $("#idcust").val(id);
                $("#namecust").val(nama);
                showDetail(id);
                $("#detailModal").modal('show');
            });
        });
        function showDetail(id){
            $.ajax({
                url: "customerdata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    detail: 1,
                    idcust: id
                },
                success:function(hasil){
                    $("#detBody").html("");
                    $.each(hasil, function(i,field){
                        $("#detBody").append("<tr><td>"+field.id+"</td><td>"+field.tgl+"</td><td>"+field.total+"</td><td>"+field.status+"</td></tr>");
                    });
                }
            });
        }
        function showData(){
            $.ajax({
                url: "customerdata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    show: 1
                },
                success:function(hasil){
                    $("#tbody").html("");
                    $.each(hasil, function(i,field){
                        $("#tbody").append("<tr><td>"+field.id+"</td><td>"+field.name+"</td><td>"+field.address+"</td><td>"+field.phone+"</td><td>"+field.email+"</td></tr>");
                    });
                }
            });
        }
        function addCustomer(){
            $.ajax({
                url: "customerdata.php",
                type: "POST",
                async: "false",
                data: {
                    insert: 1,
                    nama: $("#nama").val(),
                    alamat: $("#alamat").val(),
                    telp: $("#telp").val(),
                    email: $("#email").val()
                },
                success:function(hasil){
                    alert(hasil);
                    showData();
                }
            });
        }
    </script>

    </html>

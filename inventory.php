<?php
$_SESSION['page'] = "inventory";
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
                            <h4 class="title">New Item</h4>
                            <p class="category"></p>
                        </div>
                        <div class="content">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-top: 25px;">
                                            <button type="button" class="btn btn-primary btn-fill">Add Item</button>
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
                            <h4 class="title">Inventory</h4>
                                <p class="category">List Item</p>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Stock</th>
                                                <th>Price</th>
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
                <h4 class="modal-title">Inventory's History</h4>
              </div>
              <!-- Isi nya -->
              <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>ID PO</th>
                        <th>ID SO</th>
                        <th>ID Detail</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Sub Total</th>
                        <th>Sent/Rec</th>
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
            $("#tbody").on("click","tr",function(){
                var id = $(this).children("td:eq(0)").html();
                showDetail(id);
                $("#detailModal").modal('show');
            })
        });
        function showDetail(id){
            $.ajax({
                url: "inventorydata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    detail: 1,
                    idinvent: id
                },
                success:function(hasil){
                    $("#detBody").html("");
                    $.each(hasil[0], function(i,field){
                        $("#detBody").append("<tr><td>"+field.id_po+"</td><td> - </td><td>"+field.id+"</td><td>"+field.tgl+"</td><td>"+field.amount+"</td><td>"+field.subtotal+"</td><td>"+field.received+"</td></tr>");
                    });
                    $.each(hasil[1], function(i,field){
                       $("#detBody").append("<tr><td> - </td><td>"+field.id_so+"</td><td>"+field.id+"</td><td>"+field.tgl+"</td><td>"+field.amount+"</td><td>"+field.subtotal+"</td><td>"+field.sent+"</td></tr>");
                    });
                }
            });
        }
        function showData(){
            $.ajax({
                url: "inventorydata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    show: 1
                },
                success:function(hasil){
                    $("#tbody").html("");
                    $.each(hasil, function(i,field){
                        $("#tbody").append("<tr><td>"+field.id+"</td><td>"+field.name+"</td><td>"+field.stock+"</td><td>"+field.price+"</td></tr>");
                    });
                }
            });
        }
    </script>

    </html>

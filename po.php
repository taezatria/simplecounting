<?php
$_SESSION['page'] = "purchases";
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
                        <div class="content">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control border-input" id="tgl">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="form-control border-input" id="idsupplier">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-top: 25px;">
                                            <button type="button" class="btn btn-primary btn-fill btn-wd" data-toggle="modal" id="addpo">Add Purchases</button>
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
                            <h4 class="title">Purchases</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Supplier's ID</th>
                                                <th>Supplier's Name</th>
                                                <th>Total</th>
                                                <th>Status</th>
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
                <h4 class="modal-title">Detail Order</h4>
              </div>
              <!-- Isi nya -->
              <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ID Supplier</label>
                                <input type="text" class="form-control border-input" id="idtemp" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control border-input" id="datetemp" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total</label>
                                <input type="text" class="form-control border-input" id="ttl" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="barang">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item</label>
                                <select class="form-control border-input" id="iditem"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" min="0" class="form-control border-input" id="amount" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control border-input" id="subtotal" value="0">
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 25px;">
                            <button class="btn btn-info btn-fill" id="additem" type="button">Add Item</button>
                        </div>
                    </div>
                    <div class="table-responsive" id="listbarang">
                        <table class="table table-hover">
                            <thead>
                                <th>Item's ID</th>
                                <th>Item's Name</th>
                                <th>Amount</th>
                                <th>Subtotal</th>
                                <th>Delete</th>
                            </thead>
                            <tbody id="listBody">
                            </tbody>
                        </table>
                    </div>
                    
                </form>
              </div>
              <!-- footernya -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success btn-fill" data-dismiss="modal" id="submit">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

        <!-- Modal -->
        <div id="detailHistory" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- Title nya -->
                <h4 class="modal-title">Detail's Order</h4>
              </div>
              <!-- Isi nya -->
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control border-input" id="idpurc" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ID Supplier</label>
                            <input type="text" class="form-control border-input" id="suppid" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Supplier's Name</label>
                            <input type="text" class="form-control border-input" id="suppname" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control border-input" id="datepo" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" class="form-control border-input" id="totalpo" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select id="stts" class="form-control border-input">
                                <option>pending</option>
                                <option>approved</option>
                                <option>on process</option>
                                <option>done</option>
                            </select>
                        </div>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>ID Detail</th>
                        <th>Item's ID</th>
                        <th>Item's Name</th>
                        <th>Amount</th>
                        <th>Sub Total</th>
                        <th>Received</th>
                    </thead>
                    <tbody id="detBody">
                    </tbody>
                </table>
                </div>
              </div>
              <!-- footernya -->
              <div class="modal-footer">
                 <button type="button" class="btn btn-success btn-fill" data-dismiss="modal" id="update">Submit</button>
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

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        var items = [];
        var amount = [];
        var subtotal = [];
        var total = 0;
        $(document).ready(function(){
            $("#<?php echo $_SESSION['page'] ?>").addClass("active");
            showData();
            showSupplier();
            showItems();
            $("#additem").click(function(){
                $("#listBody").append("<tr><td>"+$("#iditem").val()+"</td><td>"+$("#iditem option:selected").html()+"</td><td>"+$("#amount").val()+"</td><td>"+$("#subtotal").val()+"</td><td><button type='button' class='btn btn-danger'><i class='ti-close'></i></button></td></tr>");
                total += parseInt($("#subtotal").val());
                $("#ttl").val(total);
                $("#amount").val(0);
                $("#subtotal").val(0);
            });
            $("#listbarang").on("click","button",function(){
                total -= parseInt($(this).parent().siblings("td:eq(3)").html());
                $("#ttl").val(total);
                $(this).parent().parent().remove();
            });
            $("#addpo").click(function(){
                if(!$("#tgl").val() || !$("#idsupplier").val()) {
                    alert("Please Fill the Blank");
                }
                else {
                    $("#idtemp").val($("#idsupplier").val());
                    $("#datetemp").val($("#tgl").val());
                    $("#detailModal").modal('show');
                }
            });
            $("#submit").click(function(){
                items = [];
                amount = [];
                subtotal = [];
                $("#listBody").children("tr").each(function(i){
                    items.push($(this).children("td:eq(0)").html());
                    amount.push($(this).children("td:eq(2)").html());
                    subtotal.push($(this).children("td:eq(3)").html());
                });
                insertTrans();
            });
            $("#update").click(function(){
                amount=[];
                items=[];
                $("#detBody").children("tr").each(function(i){
                    items.push($(this).children("td:eq(0)").html());
                    amount.push($(this).children("td:eq(5)").find("input").val());
                });
                updateTrans();
            });
            $("#iditem").change(function(){
                $("#amount").val(0);
                $("#subtotal").val(0);
            });
            $("#tbody").on("click","tr",function(){
                var id = $(this).children("td:eq(0)").html();
                var dte = $(this).children("td:eq(1)").html();
                var tot = $(this).children("td:eq(5)").html();
                var st = $(this).children("td:eq(6)").html();
                $("#idpurc").val(id);
                $("#datepo").val(dte);
                $("#totalpo").val(tot);
                $("#suppid").val($(this).children("td:eq(3)").html());
                $("#suppname").val($(this).children("td:eq(4)").html());
                $("#stts").val(st);
                showDetail(id);
                $("#detailHistory").modal('show');

            });
            $("#stts").change(function(){
                if($(this).val() == 'done'){
                    $("#detBody").children("tr").each(function(i){
                        var max = parseInt($(this).children("td:eq(5)").find("input").attr("max"));
                        $(this).children("td:eq(5)").find("input").val(max);
                        $(this).children("td:eq(5)").find("input").attr("disabled","true");
                    });
                }
                else {
                    $("#detBody").children("tr").each(function(i){
                        $(this).children("td:eq(5)").find("input").removeAttr("disabled");
                    });
                }
            })
        });
        function updateTrans(){
            $.ajax({
                url: "podata.php",
                type: "POST",
                async: "false",
                data: {
                    update: 1,
                    iddet: items,
                    amount: amount,
                    idpo: $("#idpurc").val(),
                    status: $("#stts").val()
                },
                success: function(hasil){
                    alert(hasil);
                    showData();
                }
            });
        }
        function insertTrans(){
            $.ajax({
                url: "podata.php",
                type: "POST",
                async: "false",
                data: {
                    insert: 1,
                    idsup: $("#idtemp").val(),
                    tgl: $("#datetemp").val(),
                    total: $("#ttl").val(),
                    iditem: items,
                    amount: amount,
                    subtotal: subtotal
                },
                success: function(hasil){
                    alert(hasil);
                    showData();
                }
            });
        }
        function showSupplier(){
            $.ajax({
                url: "podata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    supplier: 1
                },
                success:function(hasil){
                    $("#idsupplier").html("");
                    $.each(hasil, function(i,field){
                        $("#idsupplier").append('<option value="'+field.id+'">'+field.name+'</option>');
                    });
                }
            });
        }
        function showItems(){
            $.ajax({
                url: "podata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    item: 1
                },
                success:function(hasil){
                    $("#iditem").html("");
                    $.each(hasil, function(i,field){
                        $("#iditem").append('<option value="'+field.id+'">'+field.name+'</option>');
                    });
                }
            });
        }
        function showDetail(id){
            $.ajax({
                url: "podata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    detail: 1,
                    idpo: id
                },
                success:function(hasil){
                    $("#detBody").html("");
                    $.each(hasil, function(i,field){
                        $("#detBody").append("<tr><td>"+field.id+"</td><td>"+field.id_invent+"</td><td>"+field.name+"</td><td>"+field.amount+"</td><td>"+field.subtotal+"</td><td><input type='number' class='form-control border-input' min='"+field.received+"' max='"+field.amount+"' value='"+field.received+"'></td></tr>");
                    });
                }
            });
        }
        function showData(){
            $.ajax({
                url: "podata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    show: 1
                },
                success:function(hasil){
                    $("#tbody").html("");
                    $.each(hasil, function(i,field){
                        $("#tbody").append("<tr><td>"+field.id+"</td><td>"+field.date+"</td><td>"+field.time+"</td><td>"+field.id_sup+"</td><td>"+field.name+"</td><td>"+field.total+"</td><td>"+field.status+"</td></tr>");
                    });
                }
            });
        }
    </script>

    </html>

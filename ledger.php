<?php
session_start();
$_SESSION['page'] = "ledger";
$_SESSION['title'] = "Ledger";
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
                                <h4 class="title">Add New Account</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Reference Number</label>
                                                <input type="text" class="form-control border-input" id="ref">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control border-input" id="name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Normally</label>
                                                <select class="form-control border-input" id="norm">
                                                    <option>debit</option>
                                                    <option>credit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Type Account</label>
                                                <select class="form-control border-input" id="type"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="padding-top: 25px;">
                                                <button type="button" class="btn btn-info btn-fill btn-wd" id="addacc">Add Account</button>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="title">Journal</h4>
                                        <p class="category">By now</p>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-info btn-fill" data-toggle="modal" id="addModal">Add Journal</button>
                                    </div>
                                    <div class="col-md-3 input-group">
                                        <input type="date" class="form-control border-input" id="tglsearch">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="search"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Description</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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

        <div id="detModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- Title nya -->
                <h4 class="modal-title">Add Journal</h4>
              </div>
              <!-- Isi nya -->
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah Account</label>
                            <input class="form-control border-input" id="jumlah" type="number" min="2" value="2">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Date</label>
                            <input class="form-control border-input" id="tgl" type="date">
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top: 25px;">
                        <button type="button" class="btn btn-info btn-fill" id="addjournal">Show</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">   
                        <thead>
                            <th>Reference</th>
                            <th>Description</th>
                            <th>Value</th>
                            <th>Debit/Credit</th>
                        </thead>
                        <tbody id="listJournal">
                        </tbody>
                    </table>
                </div>
              </div>
              <!-- footernya -->
              <div class="modal-footer">
                 <button type="button" class="btn btn-success btn-fill" id="submit">Submit</button>
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

    <script type="text/javascript">
        var ref = [];
        var desc = [];
        var val = [];
        var norm = [];
        $(document).ready(function(){
            $("#<?php echo $_SESSION['page'] ?>").addClass("active");
            $("#title").html("<?php echo $_SESSION['title'] ?>");
            showData();
            showType();
            $("#addacc").click(function(){
                if(!$("#ref").val() || !$("#name").val() || !$("#norm").val() || !$("#type").val()) {
                    alert("Please Fill the Blank");
                }
                else {
                    addAccount();
                }
            });
            $("#addModal").click(function(){
                $("#listJournal").html("");
                $("#detModal").modal('show');
            });
            $("#addjournal").click(function(){
                var i = 0;
                $("#listJournal").html("");
                while(i < $("#jumlah").val() ){
                    $("#listJournal").append('<tr><td><input type="text" class="form-control border-input" id="reff"></td><td><input type="text" class="form-control border-input" id="desc"></td><td><input type="text" class="form-control border-input" id="val"></td><td><select class="form-control border-input" id="norm"><option>debit</option><option>credit</option></select></td></tr>');
                    i+=1;
                }
            });
            $("#search").click(function(){
                if(!$("#tglsearch").val()) {
                    alert("Please Fill the Blank");
                }
                else {
                    //searchData();
                }
            });
            $("#submit").click(function(){
                if(!$("#tgl").val()) {
                    alert("Please Fill the Blank");
                }
                else {
                    ref = [];
                    desc = [];
                    val = [];
                    norm = [];
                    $("#listJournal").children("tr").each(function(){
                        ref.push($(this).find("#reff").val());
                        desc.push($(this).find("#desc").val());
                        val.push($(this).find("#val").val());
                        norm.push($(this).find("#norm").val());
                    });
                    addJournal();
                    $("#detModal").modal('hide');
                }
            });
        });
        function searchData(){
            $.ajax({
                url: "journaldata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    search: 1,
                    tgl: $("#tglsearch").val()
                },
                success:function(hasil){
                    $("tbody").html("");
                    $.each(hasil, function(i,field){
                        $("tbody").append("<tr><td>"+field.date+"</td><td>"+field.ref+"</td><td>"+field.det+"</td><td>"+field.debit+"</td><td>"+field.credit+"</td><td>"+field.posted+"</td></tr>");
                    });
                }
            });
        }
        function addJournal(){
            $.ajax({
                url: "journaldata.php",
                type: "POST",
                async: "false",
                data: {
                    journal: 1,
                    ref: ref,
                    desc: desc,
                    val: val,
                    tgl: $("#tgl").val(),
                    norm: norm
                },
                success:function(hasil){
                    alert(hasil);
                    showData();
                }
            });
        }
        function addAccount(){
            $.ajax({
                url: "journaldata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    add: 1,
                    ref: $("#ref").val(),
                    name: $("#name").val(),
                    norm: $("#norm").val(),
                    type: $("#type").val()
                },
                success:function(hasil){
                    alert(hasil);
                    showData();
                }
            });
        }
        function showData(){
        	$.ajax({
        		url: "journaldata.php",
        		type: "POST",
        		dataType: "JSON",
        		data: {
        			show: 1
        		},
        		success:function(hasil){
        			$("tbody").html("");
        			$.each(hasil, function(i,field){
        				$("tbody").append("<tr><td>"+field.date+"</td><td>"+field.ref+"</td><td>"+field.det+"</td><td>"+field.debit+"</td><td>"+field.credit+"</td><td>"+field.posted+"</td></tr>");
        			});
        		}
        	});
        }
        function showType(){
            $.ajax({
                url: "journaldata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    type: 1
                },
                success:function(hasil){
                    $("#type").html("");
                    $.each(hasil, function(i,field){
                        $("#type").append('<option value="'+field.id+'">'+field.name+'</option>');
                    });
                }
            });
        }
    </script>

    </html>
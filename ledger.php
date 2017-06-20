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
                        <div class="content">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Contoh</label>
                                            <input type="text" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Contoh</label>
                                            <input type="text" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding-top: 25px;">
                                            <button type="button" class="btn btn-info btn-fill">Contoh Button</button>
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
                            <div class="col-md-6">
                            <h4 class="title">Journal</h4>
                                <p class="category">By now</p>
                            </div>
                            <div class="col-md-4 input-group">
                                <input type="date" class="form-control border-input">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="ti-search"></i></button>
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
        $(document).ready(function(){
            $("#<?php echo $_SESSION['page'] ?>").addClass("active");
            $("#title").html("<?php echo $_SESSION['title'] ?>");
            showData();
        });
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
    </script>

    </html>
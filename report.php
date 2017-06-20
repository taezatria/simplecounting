<?php
$_SESSION['page'] = "report";
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Category</h4>
                            <p class="category">Choose One</p>
                        </div>
                        <div class="content">
                            <select class="form-control border-input" id="sect">
                                <option value="1">Balance Sheet</option>
                                <option value="2">Income Statement</option>
                                <option value="3">Owner's Equity</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Search Date</h4>
                            <p class="category">Choose a date</p>
                        </div>
                        <div class="content">
                            <input type="date" class="form-control border-input">
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="isi">
                            <div class="header">
                            <h4 class="title">Balance Sheet</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div class="table-responsive" id="isi">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>Reference</th>
                                            <th>Name</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
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
            $("#sect").change(function(){
                if($("#sect").val() == 1){

                }
                else if($("#sect").val() == 2){
                    
                }
                else if($("#sect").val() == 3){
                    
                }
            });
        });
        function incomeData(){
            $.ajax({
                url: "reportdata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    income: 1
                },
                success: function(hasil){
                    $("#tbody").html("");
                    $.each(hasil['debit'], function(i,field){
                        $("#tbody").append('<tr><td></td><td></td><td></td><td></td></tr>')
                    })
                }
            })
        }
    </script>

    </html>

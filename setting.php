<?php
$_SESSION['page'] = "settings";
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
                                <h4 class="title">Sales</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <select class="form-control border-input" id="setsales">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Account Receivable</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <select class="form-control border-input" id="setaccr">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Inventory</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <select class="form-control border-input" id="setinventory">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Cost of Goods Sold</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <select class="form-control border-input" id="setcogs">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Account Payable</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <select class="form-control border-input" id="setaccp">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Cash</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <select class="form-control border-input" id="setcash">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-10">
                            <div class="content" style="margin-top: 25px;">
                                <button type="button" class="btn btn-success btn-fill btn-wd" id="save">Save</button>
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

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#<?php echo $_SESSION['page'] ?>").addClass("active");
            setAll();
            $("#save").click(function(){
                save();
            });
        });
        function save(){
            var temp = [];
            temp.push($("#setsales").val());
            temp.push($("#setaccr").val());
            temp.push($("#setinventory").val());
            temp.push($("#setcogs").val());
            temp.push($("#setaccp").val());
            temp.push($("#setcash").val());
            $.ajax({
                url: "setdata.php",
                type: "POST",
                async: "false",
                data: {
                    save: 1,
                    dta: temp
                },
                success: function(hasil) {
                    alert(hasil);
                }
            });
        }
        function setAll() {
            $.ajax({
                url: "setdata.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    setup: 1
                },
                success: function(hasil) {
                    $.each(hasil[0],function(i,field){
                        $("#setsales").append('<option value="'+field.ref+'">'+field.name+'</option>');
                        $("#setaccr").append('<option value="'+field.ref+'">'+field.name+'</option>');
                        $("#setinventory").append('<option value="'+field.ref+'">'+field.name+'</option>');
                        $("#setcogs").append('<option value="'+field.ref+'">'+field.name+'</option>');
                        $("#setaccp").append('<option value="'+field.ref+'">'+field.name+'</option>');
                        $("#setcash").append('<option value="'+field.ref+'">'+field.name+'</option>');
                    });
                     $("#setsales").val(hasil[1][0].ref);
                     $("#setaccr").val(hasil[1][1].ref);
                     $("#setinventory").val(hasil[1][2].ref);
                     $("#setcogs").val(hasil[1][3].ref);
                     $("#setaccp").val(hasil[1][4].ref);
                     $("#setcash").val(hasil[1][5].ref);
                }
            });
        }
    </script>

    </html>

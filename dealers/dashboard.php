<?php session_start(); ?>
<?php include '../inc/connect.inc.php'; ?>
<?php 
    $dealer_id = $_SESSION['dealer'];

?>
<!doctype html>
<html lang="en">

<head>
<title>Dashboard</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
<meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../vendor/animate-css/animate.min.css">
<link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
<link rel="stylesheet" href="../vendor/chartist/css/chartist.min.css">
<link rel="stylesheet" href="../vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/color_skins.css">
<style type="text/css">
    .btn,.page-link,.nav-pills .nav-link.active{
                background-color: #28a745 !important;
                color: white !important;
            }
            .centerbutton{
                margin:0 auto !important;
                text-align: center;
            }
</style>
</head>
<body class="theme-blue">

<!-- Page Loader -->
<div class="page-loader-wrapper" style="background-color: #28a745">
    <div class="loader">
        <div class="m-t-30"><img src="../images/thumbnail.png" width="48" height="48" alt="Mplify"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay" style="display: none;"></div>

<div id="wrapper">

    <nav class="navbar navbar-fixed-top text-white" style="background-color:  #28a745;color: white">
        <div class="container-fluid">

            <div class="navbar-brand" style="background-color: #28a745;color: white">
                <a href="index.html" style="color: white">
                    <!-- <img src="images/logo-icon.svg" alt="Mplify Logo" class="img-responsive logo">
                    <span class="name">mplify</span> -->
                    Registration System
                </a>
            </div>
            
            <div class="navbar-right">
                <ul class="list-unstyled clearfix mb-0">
                    <li>
                        <div class="navbar-btn btn-toggle-show">
                            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars text-white"></i></button>
                        </div>                        
                        <!-- <a href="javascript:void(0);" class="btn-toggle-fullwidth btn-toggle-hide"><i class="fa fa-bars"></i></a> -->
                    </li>
                   
                    <li>
                        <div id="navbar-menu">
                            <ul class="nav navbar-nav">
                                <li>
                                   Welcome <?php 
                                   $fullname = $_SESSION['dealer_fullname']; 
                                   echo $fullname;?>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="leftsidebar" class="sidebar" style="background-color:  #28a745;color: white">
        <div class="sidebar-scroll">
            <nav id="leftsidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="active"><a href="dashboard"><i class="icon-home"></i><span>Dashboard</span></a></li>
                    <li><a href="logout"><i class="fa fa-power-off"></i><span>Logout</span></a></li>
                </ul>
            </nav>
        </div>
    </div>


<?php 
// $dealer_id = $_GET['dealer_id'];
$get_dealer_details = mysqli_query($conn,"SELECT * FROM dealers where dealer_id = '$dealer_id' AND deleted = '0'");
if (mysqli_num_rows($get_dealer_details) > 0) {
    $row = mysqli_fetch_array($get_dealer_details);
    $company_name = $row['company_name'];
    $address = $row['address'];
    $fullname = $row['fullname'];
}else{
    echo "<script> location.href= '../dealers';</script>";
}
 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Dealer's Details</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dealer's Details</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                
                 <div class="col-lg-12">
                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Dealer Details</h2>
                        </div>                    
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="receipt-left">
                                        <img class="img-fluid" alt="" src="../images/user.png" style="width: 71px; border-radius: 43px;">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 text-right">
                                    <h5><?php echo($company_name); ?></h5>
                                    <p class="mb-0">Owner: <?php echo ucfirst($fullname); ?></p>
                                    <p class="mb-0">Address: <?php echo ucfirst($address); ?></p>
                                </div>
                            </div>                    
                                           
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th>Summary</th>
                                            <th class="text-right">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-9">Total Number of PINS Allocated</td>
                                            <?php 
                                                $pin_rows = mysqli_query($conn,"SELECT * from dealer_pin_allocated where dealer_id = '$dealer_id'");
                                                if (mysqli_num_rows($pin_rows) > 0) {
                                                    $num = 0;
                                                    while ($row = mysqli_fetch_array($pin_rows)) {
                                                        $num_of_pins = $row['number_of_pins'];
                                                        $amount_per_pin = $row['amount_per_pin'];
                                                        $num = $num + $num_of_pins;
                                                        $total_pin_amount = $num * $amount_per_pin;
                                                    }
                                                        echo '<td class="col-md-3 text-right">'.$num.'</td>';
                                                    
                                                }else{
                                                        echo '<td class="col-md-3 text-right">Nil</td>';
                                                }

                                             ?>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Total Amount For PINS</td>
                                            <td class="col-md-3 text-right"><?php if (isset($total_pin_amount)) {
                                                 echo "&#8358;  ".number_format($total_pin_amount);
                                            }else{echo "Nil";} ?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Total Amount Paid</td>
                                            <?php 
                                                $get_payments = mysqli_query($conn,"SELECT * FROM dealer_reconcile where dealer_id = '$dealer_id'");
                                                if (mysqli_num_rows($get_payments) > 0) {
                                                    $paid = 0;
                                                    while ($row = mysqli_fetch_array($get_payments)) {
                                                        $amount_paid = $row['amount_paid'];
                                                        $paid = $paid + $amount_paid;
                                                    }
                                                     echo '<td class="col-md-3 text-right">&#8358; '.number_format($paid).'</td>';
                                                }else{
                                                    echo '<td class="col-md-3 text-right">Nil</td>';

                                                }
                                             ?>
                                            
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Amount Remaining</td> 
                                            <td class="col-md-3 text-right">
                                                <?php 
                                                    if (isset($paid) && isset($total_pin_amount)) {
                                                        $remaining = number_format($total_pin_amount - $paid);
                                                        echo "&#8358; $remaining";
                                                    }elseif(isset($total_pin_amount)){
                                                        echo "&#8358; ".number_format($total_pin_amount);
                                                    }else{
                                                        echo "Nil";
                                                    }
                                                 ?>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>                    
                            
                        </div>
                    </div>
                </div>

            <div class="card product_item_list product-order-list">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="header">
                            <h2>Pin allocation summary</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>Date</th>
                                        <th>No. of Pins Allocated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $pin_rows = mysqli_query($conn,"SELECT * from dealer_pin_allocated where dealer_id = '$dealer_id'");
                                        if (mysqli_num_rows($pin_rows) > 0) {
                                            while ($row = mysqli_fetch_array($pin_rows)) {
                                                $num_of_pins = $row['number_of_pins'];
                                                $allocate_date = $row['allocate_date'];
                                                echo'<tr>
                                                    <td>'.date('D, jS M, Y',$allocate_date).'</td>
                                                    <td>'.$num_of_pins.'</td>
                                                </tr>';
                                            }
                                        }
                                     ?>
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="header">
                            <h2>Payment summary</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $get_payments = mysqli_query($conn,"SELECT * FROM dealer_reconcile where dealer_id = '$dealer_id'");
                                        if (mysqli_num_rows($get_payments) > 0) {
                                            while ($row = mysqli_fetch_array($get_payments)) {
                                                $amount_paid = $row['amount_paid']; 
                                                $payment_date = $row['payment_date'];
                                                echo'<tr>
                                                    <td>'.date('D, jS M, Y',$payment_date).'</td>
                                                    <td>&#8358; '.number_format($amount_paid).'</td>
                                                </tr>';
                                            }
                                        }
                                     ?>
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>       
            </div>                   
                </div>                
            </div>
        </div>
    </div>
   <!-- Javascript -->
        <script src="../assets/bundles/libscripts.bundle.js"></script>    
        <script src="../assets/bundles/vendorscripts.bundle.js"></script>

        <script src="../assets/bundles/chartist.bundle.js"></script>
        <script src="../assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
        <script src="../assets/bundles/flotscripts.bundle.js"></script> <!-- flot charts Plugin Js --> 
        <script src="../vendor/flot-charts/jquery.flot.selection.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.js"></script>

        <script src="../assets/bundles/mainscripts.bundle.js"></script>
        <script src="../assets/js/index.js"></script>
        <script src="../vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
        <script src="../assets/js/pages/ui/dialogs.js"></script>
        <script src="../assets/js/pages/tables/jquery-datatable.js"></script>
        <script src="../assets/bundles/datatablescripts.bundle.js"></script>

        <script src="../vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
        <script src="../vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
        <script src="../vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
        <script src="../vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
        <script src="../vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
</body>
</html>

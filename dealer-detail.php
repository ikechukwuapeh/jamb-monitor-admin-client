<?php include "inc/header2.php" ?>
<?php 
$dealer_id = $_GET['dealer_id'];
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
<title><?php echo($company_name); ?> Details</title>

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
                <div class="col-lg-6 col-md-12">
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
                                            <td class="col-md-9">Total Amount Remitted</td>
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
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Assign PIN To Branch</h2>
                        </div>
                        <div class="body">
                            <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="pill" href="#nav-tab-card"><i class="fa fa-plus"></i> Add New PIN Record</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#nav-tab-paypal"><i class="fa fa-upload"></i>  Update Payment</a></li>
                            </ul>                            
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="nav-tab-card">
                                    <form>
                                        <div class="form-group">
                                            <label>Number of PINS given</label>
                                            <input type="number" class="form-control" name="number" placeholder="" required="" id="number">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount Per PIN (&#8358;)</label>
                                            <input type="number" class="form-control" name="amount" placeholder="" required="" id="amount">
                                            <input type="text" id="id" style="display: block;height: 0;opacity: 0;" value="<?php echo($dealer_id); ?>">
                                        </div>
                                        <button class="subscribe btn btn-success btn-block" type="button" id="assign_pin"> ADD RECORD  </button>
                                    </form>
                                    <div id="allocate_error" class="mt-4"></div>
                                </div>
                                <div class="tab-pane fade" id="nav-tab-paypal">
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Amount Paid</label>
                                            <input type="number" class="form-control" name="amount_sub" id="amount_sub" placeholder="" required="">
                                        </div>
                                        <button class="subscribe btn btn-success btn-block" type="button" id="update_payment">UPDATE</button>
                                    </form>
                                    <div id="payment_error" class="mt-4"></div>

                                </div>
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
<?php include "inc/footer2.php" ?>
<script src="../assets/js/dealer_manager.js"></script>

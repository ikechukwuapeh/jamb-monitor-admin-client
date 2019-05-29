<?php include "inc/header2.php" ?>
<?php 
$branch_id = $_GET['branch_id'];
$get_branch_details = mysqli_query($conn,"SELECT * FROM branches where branch_id = '$branch_id' AND deleted = '0'");
if (mysqli_num_rows($get_branch_details) > 0) {
    $row = mysqli_fetch_array($get_branch_details);
    $branch_name = $row['branch_name'];
    $branch_location = $row['branch_location'];
}else{
    echo "<script> location.href= '../branches';</script>";
}
 ?>
<title><?php echo($branch_name); ?> Details</title>

  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Branch's Detail</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Branch's Detail</li>
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
                                    <h2>Branch Details</h2>
                                </div>                    
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="receipt-left">
                                                <img class="img-fluid" alt="" src="../images/user.png" style="width: 71px; border-radius: 43px;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 text-right">
                                            <h5><?php echo($branch_name); ?></h5>
                                            <?php 
                                                $get_branch_workers = mysqli_query($conn,"SELECT * FROM client_users where branch_id = '$branch_id'");
                                                if (mysqli_num_rows($get_branch_workers) > 0) {
                                                    while ($row = mysqli_fetch_array($get_branch_workers)) {
                                                        $fullname = $row['fullname'];
                                                        $role = $row['role'];?>
                                                        <p class="mb-0"><?php echo ucfirst($role); ?>: <?php echo ucfirst($fullname); ?></p>
                                                        <?php
                                                    }
                                                }
                                             ?>
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
                                                        $pin_rows = mysqli_query($conn,"SELECT * from branch_pin_allocated where branch_id = '$branch_id'");
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
                                                         echo "&#8358;".number_format($total_pin_amount);
                                                    }else{echo "Nil";} ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-9">Total Amount Remitted</td>
                                                    <?php 
                                                        $get_payments = mysqli_query($conn,"SELECT * FROM branch_reconcile where branch_id = '$branch_id'");
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
                                                                echo "&#8358;  $remaining";
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
                                                    <input type="text" id="id" style="display: block;height: 0;opacity: 0;" value="<?php echo($branch_id); ?>">
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
                                                $pin_rows = mysqli_query($conn,"SELECT * from branch_pin_allocated where branch_id = '$branch_id'");
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
                                                $get_payments = mysqli_query($conn,"SELECT * FROM branch_reconcile where branch_id = '$branch_id'");
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
                    <div class="card product_item_list product-order-list">
                        <div class="header">
                            <h2>Branch Registration details</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Jamb Profile Code</th>
                                            <th>Reference Key</th>
                                            <th>Center</th>
                                            <th>Amount</th>
                                            <th>Pin status</th>
                                            <th>Register status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $getdetails = mysqli_query($conn,"SELECT * FROM student_record where (branch_id = '$branch_id'AND client_id = '$client_id' AND register_status = 1) OR (branch_id = '$branch_id' AND client_id = '$client_id' AND pin_status = 1)");
                                            if (mysqli_num_rows($getdetails) > 0) {
                                                while ($row = mysqli_fetch_array($getdetails)) {
                                                    $fullname = $row['fullname'];
                                                    $phone = $row['phone'];
                                                    $jamb_profile_code = $row['jamb_profile_code'];
                                                    $ref_key = $row['ref_key'];
                                                    $pin_status = $row['pin_status'];
                                                    $register_status = $row['register_status'];
                                                    $key_date = $row['key_date'];
                                                     ?>
                                                    <tr>
                                                        <td><?php if (empty($fullname)) {
                                                            echo "Not provided";
                                                        }else{
                                                            echo($fullname);
                                                        } ?></td>
                                                        <td><?php if (empty($phone)) {
                                                            echo "Not provided";
                                                        }else{
                                                            echo($phone);
                                                        } ?></td>
                                                        <td><?php if (empty($jamb_profile_code)) {
                                                            echo "Not provided";
                                                        }else{
                                                            echo($jamb_profile_code);
                                                        } ?></td>
                                                        <td><?php echo($ref_key); ?></td>
                                                        <td>NIL</td>
                                                        <td>NIL</td>
                                                        <td><?php if ($pin_status == '0') {
                                                            echo "<i class='fa fa-times'></i>";
                                                            }else{
                                                                echo "<i class='fa fa-check'></i>";
                                                            } ?>
                                                        </td>
                                                        <td><?php if ($register_status == '0') {
                                                            echo "<i class='fa fa-times'></i>";
                                                            }else{
                                                                echo "<i class='fa fa-check'></i>";
                                                            } ?>
                                                        </td>
                                                        <td><?php echo(date('jS F, Y',$key_date)); ?></td>
                                                    </tr>
                                                    <?php
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
<?php include "inc/footer2.php" ?>
<script src="../assets/js/branch_manager.js"></script>

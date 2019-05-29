<?php include 'inc/header.php'; ?>
<title>Dashboard</title>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Dashboard</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="table-responsive">
                        <h5>Registered Users</h5>
                        <table class="table table-bordered table-striped table-hover ">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Branch</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $getusers = mysqli_query($conn,"SELECT client_users.*, branches.* FROM client_users INNER JOIN branches where client_users.client_id = '$client_id' AND client_users.branch_id = branches.branch_id AND client_users.deleted = 0 LIMIT 2");
                                    if (mysqli_num_rows($getusers) > 0) {
                                        while ($row = mysqli_fetch_array($getusers)) {
                                            $fullname = $row['fullname'];
                                            $phone = $row['phone'];
                                            $role  = $row['role'];
                                            $client_user_id  = $row['client_user_id'];
                                            $branch = $row['branch_name'];?>
                                            <tr>
                                                <td><?php echo "$fullname"; ?></td>
                                                <td><?php echo "$phone"; ?></td>
                                                <td><?php echo "$branch"; ?></td>
                                                <td><?php echo "$role"; ?></td>
                                            </tr>  
                                            <?php
                                        }
                                    }
                                 ?>
                            </tbody>
                        </table>
                            <a href="users" class="btn btn-success btn-lg btn-block centerbutton">View more</a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="clearfix">
                        <div class="table-responsive">
                            <h5>Registered Dealers</h5>
                            <table class="table table-bordered table-striped table-hover ">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>Name</th>
                                    <th>Phone</th>
                                    <th>Company Name</th>
                                    <th>Address</th>    
                                    </tr>
                                </thead>
                                 <tbody>
                                <?php 
                                    $fetchdealers = mysqli_query($conn,"SELECT * FROM dealers where client_id = '$client_id' AND deleted = 0 LIMIT 2");
                                    if (mysqli_num_rows($fetchdealers) > 0) {
                                        while ($row = mysqli_fetch_array($fetchdealers)) {
                                            $dealer_id = $row['dealer_id'];
                                            $fullname = $row['fullname'];
                                            $address = $row['address'];
                                            $company = $row['company_name'];
                                            $phone = $row['phone']; ?> 
                                            <tr>
                                                <td><?php echo "$fullname"; ?></td>
                                                <td><?php echo "$phone"; ?></td>
                                                <td><?php echo "$company"; ?></td>
                                                <td><?php echo "$address"; ?></td>
                                            </tr>  

                                            <?php
                                        }
                                    }
                                 ?>
                            </tbody>
                            </table>
                            <a href="view-dealers" class="btn btn-success btn-lg btn-block centerbutton">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php include 'inc/footer.php'; ?>

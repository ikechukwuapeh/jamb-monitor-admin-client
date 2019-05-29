<?php include "inc/header.php" ?>
<title>Add user or branch</title>
  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>New User</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">New User</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="card  pr-2 pl-2 pt-2 pb-2">
                    <h5>Add new Branch</h5>

                        <form class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="branch_name" class="control-label">Branch Name</label>
                                    <input type="text" id="branch_name" class="form-control" placeholder="E.g. John Doe">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="branch_location" class="control-label">Branch Location</label>
                                    <input type="text" id="branch_location" class="form-control" placeholder="E.g. John Doe">
                                </div>
                            </div>
                            <div class="centerbutton">
                                <button class="btn btn-outline-success mt-1" id="branch_adder">Add Branch</button>
                            </div>

                        </form>
                        <div class="centerbutton mt-5 pt-2" id="available"></div>
                    </div>
                    <div class="card pr-2 pl-2 pt-2 pb-2">
                        <h5>Add new User</h5>

                        <form class="row" id="form">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Fullname</label>
                                    <input required="" type="text" id="fullname" name= "fullname" class="form-control" placeholder="E.g. John Doe">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input required="" type="text" id="phone" name="phone" class="form-control" placeholder="E.g. 081082......">
                                </div>        
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input required="" type="text" id="email" name="email" class="form-control" placeholder="Eg. lorem@gmail.com">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input required="" type="password" id="password" name="password" class="form-control">
                                </div>        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="password2" class="control-label">Confirm Password</label>
                                    <input required="" type="password" id="password2" name="password2" class="form-control">
                                    <input type="hidden" name="add_user">
                                </div>        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Assign Branch</label>
                                    <select class="custom-select" name="branch">
                                        <option selected>Choose...</option>
                                        <?php 
                                            $get_branches = mysqli_query($conn,"SELECT * FROM branches where `client_id` = '$client_id' AND deleted = 0");
                                            if (mysqli_num_rows($get_branches) > 0) {
                                                while ($row = mysqli_fetch_array($get_branches)){
                                                    $branch_name = $row['branch_name'];
                                                    $branch_id = $row['branch_id']; ?>
                                                     <option value="<?php echo($branch_id); ?>"><?php echo $branch_name; ?></option>
                                                    <?php
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone-ex" class="control-label">Assign Role</label>
                                    <select class="custom-select" name="role">
                                        <option selected>Choose...</option>
                                        <option value="pin">Pin Vendor</option>
                                        <option value="registration">Registration Personnel</option>
                                    </select>
                                </div>      
                            </div>
                            <div class="centerbutton">
                                <button class="btn btn-outline-success mt-1">Register User</button>
                            </div>
                        </form>
                        <div class="centerbutton mt-5 pt-2" id="error"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "inc/footer.php" ?>
<script src="assets/js/branch_adder.js"></script>
<script src="assets/js/user_adder.js"></script>
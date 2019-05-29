<?php include "inc/header.php" ?>
<title>Add dealer</title>

  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>New Dealer</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">New Dealer</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="card pr-2 pl-2 pt-2 pb-2 mt-5">
                        <h5>Add New Dealer</h5>

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
                                    <input type="hidden" name="add_dealer">
                                </div>        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="company" class="control-label">Company Name</label>
                                    <input type="text" id="company" name="company" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control">
                                </div>      
                            </div>
                            <div class="centerbutton">
                                <button class="btn btn-outline-success mt-1">Register Dealer</button>
                            </div>
                    </form>
                        <div class="centerbutton mt-5 pt-2" id="error"></div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "inc/footer.php" ?>
<script src="assets/js/dealer_adder.js"></script>

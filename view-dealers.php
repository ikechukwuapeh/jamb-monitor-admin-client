<?php include "inc/header.php" ?>
<title>Dealers</title>
  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Dealers</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dealers</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $fetchdealers = mysqli_query($conn,"SELECT * FROM dealers where client_id = '$client_id' AND deleted = 0");
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
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="dealer/<?php echo($dealer_id); ?>"><i class="fa fa-eye"></i> View Transactions</a>
                                                         <a href="#defaultModal" class="dropdown-item" data-toggle="modal" data-target="#defaultModal" onclick= "editthis('<?php echo($dealer_id); ?>','<?php echo($fullname); ?>','<?php echo($company); ?>','<?php echo($phone); ?>','<?php echo($address); ?>')">
                                                                               <i class="fa fa-edit"></i> Edit
                                                                            </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="deletedealer('<?php echo $dealer_id; ?>')"><i class="fa fa-trash"></i> Delete</a>
                                                        </div>
                                                     </div>
                                                </td>
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
     <!-- modal begins -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="defaultModalLabel">Edit Dealer</h4>
                    </div>
                    <div class="modal-body"> 
                        <form class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Name</label>
                                    <input type="text" id="fullname" class="form-control" placeholder="E.g. John Doe">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input type="text" id="phone" class="form-control" placeholder="E.g. 081082......">
                                </div>        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Address</label>
                                    <input type="text" id="address" class="form-control" placeholder="Eg. lorem@gmail.com">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="company" class="control-label">Company Name</label>
                                    <input type="text" id="company" class="form-control">
                                    <input type="text" id="id" style="display: block;height: 0;opacity: 0;">
                                </div>        
                            </div>
                            
                            <div class="centerbutton">
                                <button class="btn btn-outline-success mt-1" id="savethis">Save</button>
                            </div>
                        </form>       
                        <div id="available"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal ends -->
<?php include "inc/footer.php" ?>
<script src="assets/js/editdealer.js"></script>
<script type="text/javascript">
    function deletedealer(dealer_id){
        confirmaction = confirm("Are you sure you want to delete this branch?");
        if (confirmaction) {
            $.post('inc/processor.php',{delete_dealer:1,id:dealer_id},function(data){
                if (data == 'Yes') {
                    location.href = "";
                }else{
                    alert(data);
                }
            });
        }
    }

     function editthis(dealer_id,fullname,company,phone,address){
        $("#fullname").attr('value',fullname);
        $("#phone").attr('value',phone);
        $("#address").attr('value',address);
        $("#company").attr('value',company);
        $("#id").attr('value',dealer_id);
    }
</script>
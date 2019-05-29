<?php include "inc/header.php" ?>
<title>Users</title>
  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Registered Users</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Registered Users</li>
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
                                    <th>Branch</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $getusers = mysqli_query($conn,"SELECT client_users.*, branches.* FROM client_users INNER JOIN branches where client_users.client_id = '$client_id' AND client_users.branch_id = branches.branch_id AND client_users.deleted = 0");
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
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a href="#defaultModal" class="dropdown-item" data-toggle="modal" data-target="#defaultModal" onclick="editthis('<?php echo($client_user_id); ?>','<?php echo($phone); ?>','<?php echo($fullname); ?>')">
                                                                               <i class="fa fa-edit"></i> Edit
                                                                            </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="deleteuser('<?php echo($client_user_id); ?>')"><i class="fa fa-trash"></i> Delete</a>
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
                        <h4 class="title" id="defaultModalLabel">Edit User</h4>
                    </div>
                    <div class="modal-body"> 
                        <form class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Fullname</label>
                                    <input type="text" id="fullname" class="form-control" placeholder="E.g. John Doe">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input type="text" id="phone" class="form-control" placeholder="E.g. 081082......">
                                    <input type="text" id="id" style="display: block;height: 0;opacity: 0;">

                                </div>        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone-ex" class="control-label">Assign Role</label>
                                    <select class="custom-select" id="role">
                                        <option selected>Choose...</option>
                                        <option value="pin">Pin Vendor</option>
                                        <option value="registration">Registration Personnel</option>
                                    </select>
                                </div>        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone-ex" class="control-label">Assign Branch</label>
                                    <select class="custom-select" id="branch">
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
                            <div class="centerbutton">
                                <button class="btn btn-outline-success mt-1" id="save-edit">Save</button>
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
<script src="assets/js/edituser.js"></script>
<script type="text/javascript">
    function editthis(client_user_id,phone,fullname){
        $('#fullname').attr('value', fullname);
        $('#phone').attr('value', phone);
        $('#id').attr('value', client_user_id);
    }
    function deleteuser(user_id){
        confirmaction = confirm("Are you sure you want to delete this User?");
        if (confirmaction) {
            $.post('inc/processor.php',{delete_user:1,id:user_id},function(data){
                if (data == 'Yes') {
                    location.href = "";
                }else{
                    alert(data);
                }
            });
        }
    }
</script>

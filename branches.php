<?php include "inc/header.php" ?>
<title>Branches</title>
  <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Branches</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Branches</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix mt-5">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $getbranches = mysqli_query($conn,"SELECT * FROM branches where client_id = '$client_id' AND deleted = 0");
                                    if (mysqli_num_rows($getbranches) > 0) {
                                        while ($row = mysqli_fetch_array($getbranches)) {
                                            $branch_name = $row['branch_name'];
                                            $branch_id = $row['branch_id'];
                                            $branch_location = $row['branch_location'];?>
                                            <tr>
                                                <td><?php echo "$branch_name"; ?></td>
                                                <td><?php echo "$branch_location"; ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="branch/<?php echo($branch_id); ?>"><i class="fa fa-eye"></i> View Performance</a>
                                                         <a onclick= "editthis('<?php echo($branch_id); ?>','<?php echo($branch_name); ?>','<?php echo($branch_location); ?>')" href="#defaultModal" class="dropdown-item" data-toggle="modal" data-target="#defaultModal">
                                                                               <i class="fa fa-edit"></i> Edit
                                                                            </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="deletebranch('<?php echo $branch_id; ?>')"><i class="fa fa-trash"></i> Delete</a>
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
                        <h4 class="title" id="defaultModalLabel">Edit Branch</h4>
                    </div>
                    <div class="modal-body"> 
                        <form class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Branch Name</label>
                                    <input type="text" id="fullname" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="location" class="control-label">Location</label>
                                    <input type="text" id="location" class="form-control">
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
<script src="assets/js/editbranch.js"></script>

<script type="text/javascript">
    function editthis(branch_id,branch_name,branch_location){
        $("#fullname").attr('value',branch_name);
        $("#location").attr('value',branch_location);
        $("#id").attr('value',branch_id);
    }


    function deletebranch(branch_id){
        confirmaction = confirm("Are you sure you want to delete this branch?");
        if (confirmaction) {
            $.post('inc/processor.php',{delete_branch:1,id:branch_id},function(data){
                if (data == 'Yes') {
                    location.href = "";
                }else{
                    alert(data);
                }
            });
        }
    }
</script>
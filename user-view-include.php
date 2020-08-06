<?php
   if(($result['company_id'] == $_SESSION['company_id']) || $_SESSION['user_role_id'] == '3' || $_SESSION['user_role_id'] =='4')
      {

       ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <h3>Company Registered Users</h3>
                            <div class="table-responsive">
                         <form id="userActionView" method="post"> 
                        <table class="table table-hover c_table theme-color">
                            <thead>
                                <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>email</th>
                                            <th width="20%">Action</th>
                                </tr>
                            </thead>
                           





                            <tbody>
                                        
                                        <?php
                                                
                                                $companyId = $result['company_id'];
                                                $ch = new Chempo();
                                                $rows = $ch->companyregisteredUsers($companyId,$_SESSION['user_role_id']);
                                                if ($rows <> 0)
                                                {
                                                foreach ($rows as $row) 
                                                {

                                            ?>
                        
                                                    <tr>
                                                    <th scope="row"><?php echo $row['user_id']; ?></th>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>

                                                    <td>

                                                        <?php
                                                        if($_SESSION['user_role_id'] == '1')
                                                        {
                                                            if($_SESSION['user_group_id'] == '1' || $_SESSION['user_group_id'] == '2')
                                                            {
                                                        ?>      
                                                                <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>
                                                                 
                                                            <?php
                                                            }
                                                            elseif($_SESSION['user_group_id'] == '3')
                                                            {
                                                            ?>
                                                                <!-- EDIT USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("edit");'><i class="zmdi zmdi-edit" ></i>&nbsp;</button> &nbsp;
                                                        
                                                                <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>
                                                            <?php
                                                            }
                                                            elseif($_SESSION['user_group_id'] == '4')
                                                            {
                                                            ?>
                                                                <!-- EDIT USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("edit");'><i class="zmdi zmdi-edit" ></i>&nbsp;</button> &nbsp;

                                                                <!-- DELETE USER DETAILS -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteUserID" data-id="<?php echo $row['user_id']; ?>"><i class="zmdi zmdi-delete"></i>&nbsp;</button>&nbsp;

                                                                <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>

                                                            <?php
                                                            }
                                                            ?>

                                                            

                                                        <?php
                                                        }
                                                        elseif($_SESSION['user_role_id'] == '2')
                                                        {
                                                            if($_SESSION['company_id'] == $result['company_id'] )
                                                            {
                                                        ?>
                                                                <!-- EDIT USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("edit");'><i class="zmdi zmdi-edit" ></i>&nbsp;</button> &nbsp;

                                                                <!-- DELETE USER DETAILS -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteUserID" data-id="<?php echo $row['user_id']; ?>"><i class="zmdi zmdi-delete"></i>&nbsp;</button>&nbsp;

                                                                <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>


                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>

                                                            <?php
                                                            }
                                                            ?>



                                                        <?php
                                                        }
                                                        elseif ($_SESSION['user_role_id'] == '3') 
                                                        {
                                                        ?>
                                                            <!-- EDIT USER DETAILS -->
                                                            <button class="btn btn-sm btn-outline-info waves-effect" name="editUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("edit");'><i class="zmdi zmdi-edit" ></i>&nbsp;</button> &nbsp;
                                                               

                                                            <!-- VIEW USER DETAILS -->
                                                            <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>

                                                        <?php
                                                        }
                                                        elseif($_SESSION['user_role_id'] == '4')
                                                        {
                                                        ?>
                                                            <!-- EDIT USER DETAILS -->
                                                            <button class="btn btn-sm btn-outline-info waves-effect" name="editUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("edit");'><i class="zmdi zmdi-edit" ></i>&nbsp;</button> &nbsp;

                                                            <!-- DELETE USER DETAILS -->
                                                            <button type="button" class="btn btn-sm btn-outline-danger deleteUserID" data-id="<?php echo $row['user_id']; ?>"><i class="zmdi zmdi-delete"></i>&nbsp;</button>&nbsp;

                                                            <!-- VIEW USER DETAILS -->
                                                            <button class="btn btn-sm btn-outline-success" name="viewUser" value="<?php echo $row['user_id']; ?>" onclick='gotoActionView("view");'><i class="zmdi zmdi-eye"></i>&nbsp;</button>

                                                        <?php
                                                        }
                                                        
                                                        ?>
                                                        

                                                       
             
                                                    </td>
                                                    </tr>
                                            <?php
                                                }
                                                } else {
                                                    echo "<td colspan='4'><center>No data available.</center></td>";
                                                }

                                            ?>
                                      
                                        
                                    </tbody>


                        </table>
                    </form>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php
    }
    ?>
<script type="text/javascript">
    $(".deleteUserID").click(function () {
    var ids = $(this).attr('data-id');
    $("#userID").val( ids );
    $('#myModal').modal('show');
        
});
    
function gotoActionView(action_name) {
    document.getElementById('userActionView').action;
   if(action_name == "view"){
       document.getElementById('userActionView').action = "company-view.php";
       document.getElementById('userActionView').submit();
   }else if(action_name == "edit"){
       document.getElementById('userActionView').action = "company-view.php";
       document.getElementById('userActionView').submit();
   }
}

</script>

<!--///////////////////////////////////////////////Delete Modal//////////////// -->
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="zmdi zmdi-alert-triangle"></i></i>&nbsp;Confirm</h5><br>
        </div>
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal-body">
          Are you sure you want to delete this User ?<br>
        You can't undo this action.<br>
            <input type="text" class="form-control" name="userID" id="userID" value="" hidden>
         
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn btn-outline-danger waves-effect" name="delete-user" value=""><i class="zmdi zmdi-delete" ></i>&nbsp;Yes</button>
            
          

        </div>
        </form>
      </div>
      
    </div>
  </div>
    

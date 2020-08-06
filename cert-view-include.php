<?php
   if(($result['company_id'] == $_SESSION['company_id']) || $_SESSION['user_role_id'] == '3' || $_SESSION['user_role_id'] =='4')
      {

       ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <h3>Company 38.3 Certificates</h3>
                            <div class="table-responsive">
                        <form id="userAction" method="post">  
                        <table class="table table-hover c_table theme-color">
                            <thead>
                                <tr>
                                            <!--<th>#</th>-->
                                            <th>Product Name</th>
                                            <th>Battery Name</th>
                                            <th>Supplier</th>
                                            <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                        
                                        <?php
                                                 //UNSET SESSION FOR CERT-UID
                                                $ch = new Chempo();
                                                $rows = $ch->companyUploadedCertificates($companyId);
                                                
                                                if ($rows <> 0)
                                                {
                                                foreach ($rows as $row) 
                                                {
                                            ?>
                        
                                                    <tr>
                                                    <!--<th scope="row"><?php //echo $row['battery_cert_id']; ?></th>-->
                                                    <td><?php echo $row['prod_name']; ?></td>
                                                    <td><?php echo $row['batt_name']; ?></td>
                                                    <td><?php echo $row['batt_supplier']; ?></td>

                                                    <td>

                                                        <?php
                                                        if($_SESSION['user_role_id'] == '1')
                                                        {
                                                            if($_SESSION['user_group_id'] == '1' || $_SESSION['user_group_id'] == '2')
                                                            {
                                                        ?>     
                                                            <!-- VIEW USER DETAILS -->
                                                            <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button>
                                                                 
                                                            <?php
                                                            }
                                                            elseif($_SESSION['user_group_id'] == '3')
                                                            {
                                                            ?>
                                                                <!-- EDIT USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("edit");'><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                        
                                                                <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button>
                                                            <?php
                                                            }
                                                            elseif($_SESSION['user_group_id'] == '4')
                                                            {
                                                            ?>
                                                                <!-- EDIT USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("edit");'><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                        
                                                                <!-- DELETE USER DETAILS -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteCertID" data-id="<?php echo $row['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>&nbsp;

                                                                 <!-- VIEW USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button><br>

                                                            <?php
                                                            }
                                                            ?>

                                                            

                                                        <?php
                                                        }
                                                        elseif($_SESSION['user_role_id'] == '2')
                                                        {
                                                            if($_SESSION['company_id'] == $row['company_id'] )
                                                            {
                                                        ?>
                                                                <!-- EDIT USER DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("edit");'><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                        
                                                                <!-- DELETE USER DETAILS -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteCertID" data-id="<?php echo $row['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>&nbsp;

                                                                <!-- VIEW CERTIFICATE DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button><br>


                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                        
                                                                <!-- VIEW CERTIFICATE DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button>

                                                            <?php
                                                            }
                                                            ?>



                                                        <?php
                                                        }
                                                        elseif ($_SESSION['user_role_id'] == '3') 
                                                        {
                                                        ?>
                                                                <!-- EDIT CERTIFICATE DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("edit");'><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                        
                                                                <!-- VIEW CERTIFICATE DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button>


                                                        <?php
                                                        }
                                                        elseif($_SESSION['user_role_id'] == '4')
                                                        {
                                                        ?>
                                                                <!-- EDIT CERTIFICATE DETAILS -->
                                                                <button class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("edit");'><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                                
                                                                <!-- DELETE CERTIFICATE DETAILS -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteCertID" data-id="<?php echo $row['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>&nbsp;
                                                                
                                                                <!-- VIEW CERTIFICATE DETAILS -->
                                                                <button class="btn btn-sm btn-outline-success" name="viewCert" value="<?php echo $row['battery_cert_id']; ?>" onclick='gotoAction("view");'><i class="zmdi zmdi-eye"></i></button>

                                                        <?php
                                                        }
                                                        ?>
                                                        

                                                       
             
                                                    </td>
                                                    </tr>
                                            <?php
                                                }
                                                } else {
                                                    echo "<td colspan='4'><center>No data available.</center> </td>";
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

<script type="text/javascript">
    $(".deleteCertID").click(function () {
    var ids = $(this).attr('data-id');
    $("#certID").val( ids );
    $('#myModal').modal('show');
});

function gotoAction(action_name) {
    document.getElementById('userAction').action;
   if(action_name == "view"){
       document.getElementById('userAction').action = "company-view.php";
       document.getElementById('userAction').submit();
   }else if(action_name == "edit"){
       document.getElementById('userAction').action = "company-view.php";
       document.getElementById('userAction').submit();
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
          Are you sure you want to delete this 38.3 Certificate ?<br>
        You can't undo this action.<br>
            <input type="text" class="form-control" name="certID" id="certID" value="" hidden>
         
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn btn-outline-danger waves-effect" name="delete-cert" value=""><i class="zmdi zmdi-delete" ></i>&nbsp;Yes</button>
            
          

        </div>
        </form>
      </div>
      
    </div>
  </div>


        <?php

    }
    ?>
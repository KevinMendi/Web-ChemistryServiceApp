<?php
   if(($result['company_id'] == $_SESSION['company_id']) || $_SESSION['user_role_id'] == '3' || $_SESSION['user_role_id'] =='4')
      {

       ?>
       <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <h3>Company Chemicals</h3>
                            <div class="table-responsive">
                        <form action="chemicals-edit-new.php" method="post">  
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>Un No</th>
                                            <th>User</th>
                                            <th width="36%">Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>Un No</th>
                                            <th>User</th>
                                            <th width="36%">Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        <?php
                                                $companyId = $result['company_id'];
                                                $ch = new Chempo();
                                                $rows = $ch->companyChemicalsList($companyId);
                                                foreach ($rows as $row) 
                                                {
                                            ?>
                        
                                                    <tr>
                                                    
                                                    <td><?php echo $row['begin_of_pname']; ?></td>
                                                    <td><?php echo $row['cas_no']; ?></td>
                                                    <td><?php echo $row['un_no']; ?></td>
                                                    <td><?php echo ($row['f_name'].' '.$row['l_name']); ?></td>

                                                    <td>
                                                        <?php

                                                        if($_SESSION['user_role_id'] == '1' )
                                                        {
                                                            if($_SESSION['user_group_id'] == '1' || $_SESSION['user_group_id'] == '2')
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>

                                                            <?php

                                                            }
                                                            else if($_SESSION['user_group_id'] == '3' && ($row['company_id'] == $_SESSION['company_id']))
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>

                                                            <?php
                                                            }
                                                            else if($_SESSION['user_group_id'] == '4' && ($row['company_id'] == $_SESSION['company_id']))
                                                            {

                                                            ?>
                                                            <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" ><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>


                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>

                                                            <?php
                                                            }
                                                            ?>


                                                            


                                                            <?php
                                                        }
                                                         else if($_SESSION['user_role_id'] == '2')
                                                        {
                                                            if($row['company_id'] == $_SESSION['company_id'])
                                                            {

                                                        ?>
                                                                 <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>" ><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" ><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>


                                                            <?php
                                                            }
                                                            else
                                                            {


                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>

                                                            <?php
                                                            }
                                                            ?>


                                                         
                                                        <?php

                                                        }
                                                        else if($_SESSION['user_role_id'] == '3')
                                                        {

                                                        ?>
                                                        <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                        <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                        <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                        <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>


                                                        <?php
                                                            
                                                        }
                                                         else if($_SESSION['user_role_id'] == '4')
                                                        {
                                                        ?>

                                                         <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                        <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                        <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                        <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print"></i>&nbsp;Print</button>

                                                        <?php
                                                            
                                                        }
                                                        
                                                        ?>
                                                        
                                                    </td>
                                                    </tr>
                                            <?php
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

  <!-- /////////////////////////////////////////////Delete Chemical-->

<script type="text/javascript">
    $(".passingID").click(function () {
    var ids = $(this).attr('data-id');
    $("#chemicalID").val( ids );
    $('#myModalChemical').modal('show');
});
</script>

<div class="modal fade" id="myModalChemical" role="dialog" >
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="zmdi zmdi-alert-triangle"></i></i>&nbsp;Confirm</h5><br>
        </div>
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal-body">
          Are you sure you want to delete this Chemical ?<br>
        You can't undo this action.<br>
            <input type="text" class="form-control" name="chemicalID" id="chemicalID" value="" hidden="">
         
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn btn-outline-danger waves-effect" name="delete-chemical" value=""><i class="zmdi zmdi-delete" ></i>&nbsp;Yes</button>
            
          

        </div>
        </form>
      </div>
      
    </div>
  </div>


<!--///////////////////////////////////////////////////////////Print Modal-->
<script type="text/javascript">
    $(".printID").click(function () {
    var ids = $(this).attr('data-id');
    $("#chemicalIDPrint").val( ids );
    $('#myModal2').modal('show');
});
</script>
<div class="modal fade" id="myModal2" role="dialog" >
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="zmdi zmdi-alert-circle"></i></i></i>&nbsp;Select Label Size</h5><br>
        </div>
        <form  method="post" action="print-label.php">
        <div class="modal-body">
          Please select one of the three label sizes in order to get the PDF document.
            <input type="text" class="form-control" name="chemicalID" id="chemicalIDPrint" value="" hidden >
         
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn btn-outline-success waves-effect" name="A4-Size" value=""><i class="zmdi zmdi-print" ></i>&nbsp;A4</button>
          <button type="submit" class="btn btn btn-outline-success waves-effect" name="A5-Size" value=""><i class="zmdi zmdi-print" ></i>&nbsp;A5</button>
          <button type="submit" class="btn btn btn-outline-success waves-effect" name="A6-Size" value=""><i class="zmdi zmdi-print" ></i>&nbsp;A6</button>


            
          

        </div>
        </form>
      </div>
      
    </div>
  </div>
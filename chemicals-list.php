<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in_time'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: sign-in.php');
    exit;
}


function __autoload($class)
{
  require_once "classes/$class.php";
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (isset($_POST['delete-chemical']) && $_SERVER["REQUEST_METHOD"] == "POST") {


$chemicalID = test_input($_POST["chemicalID"]);
$tableName = "tb_chemical_header";
$whereClause = "chemical_header_id";
$ch = new Chempo();

$fields = [ 
         
            'del_status'=>'X'
           
        ];

$check = $ch->delete($fields,$chemicalID,$tableName,$whereClause);

if($check == 1)
{
    header("Location: chemicals-list.php");
}
else
{
    echo "Error Deleting !";
}



}






?>



<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: List of Chemicals</title>
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

<!-- Custom Css -->
<link  rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush" id="body" onload="bodyOnLoad()">



<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.png" width="48" height="48" alt="ChemPO"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Navbar -->
<?php include_once('navbar.php') ?>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>List of Chemicals</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">Chemicals</li>
                        <li class="breadcrumb-item active">Chemicals List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!--<h2><strong>Basic</strong> Examples </h2>-->
                            <!--
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right slideUp">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        -->
                        </div>
                        <div class="body">
                            
                            <div class="table-responsive">
                                <form action="chemicals-edit-new.php" method="post">  
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>Un No</th>
                                          
                                            <th width="38%">Action</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            <th>Un No</th>
                                         
                                            <th width="38%">Action</th>
                                            
                                           
                                        </tr>
                                    </tfoot>
                                
                                    <tbody>
                                        
                                        <?php
                                                $ch = new Chempo();
                                                $rows = $ch->chemicalsList();
                                                foreach ($rows as $row) 
                                                {
                                            ?>
                        
                                                    <tr>
                                                    <th scope="row"><?php echo $row['chemical_header_id']; ?></th>
                                                    <td><?php echo $row['begin_of_pname']; ?></td>
                                                    <td><?php echo $row['cas_no']; ?></td>
                                                    <td><?php echo $row['un_no']; ?></td>

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

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>

                                                            <?php

                                                            }
                                                            else if($_SESSION['user_group_id'] == '3' && ($row['company_id'] == $_SESSION['company_id']))
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>

                                                            <?php
                                                            }
                                                            else if($_SESSION['user_group_id'] == '4' && ($row['company_id'] == $_SESSION['company_id']))
                                                            {

                                                            ?>
                                                            <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" ><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>


                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>

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

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>


                                                            <?php
                                                            }
                                                            else
                                                            {


                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                                <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>" disabled><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                                <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                                <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>

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

                                                        <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>


                                                        <?php
                                                            
                                                        }
                                                         else if($_SESSION['user_role_id'] == '4')
                                                        {
                                                        ?>

                                                         <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editChemical" value="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-edit" ></i>&nbsp;Edit</button>

                                                        <button type="button" class="btn btn-sm btn-outline-danger passingID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-delete"></i>&nbsp;Delete</button>

                                                        <a  class="btn btn-sm btn-outline-success" href="chemicals-view-new.php?read=<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-eye"></i>&nbsp;View</a>

                                                        <button type="button" class="btn btn-sm btn-outline-warning printID" data-id="<?php echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>

                                                        <?php
                                                            
                                                        }
                                                        
                                                        ?>


                                                      

                                                        

                                                        



                                                       <!--
                                                        <button type="button" class="btn btn-sm btn-outline-info waves-effect" data-toggle="modal" data-target="#exampleModalCenter" onclick="myFunction()" value="<?php //echo $row['chemical_header_id']; ?>"><i class="zmdi zmdi-print" ></i>&nbsp;Print</button>
                                                        -->



                                                        
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

            <!-- Exportable Table -->
            
        </div>

<script type="text/javascript">
    $(".passingID").click(function () {
    var ids = $(this).attr('data-id');
    $("#chemicalID").val( ids );
   
    $("#delete-chemical").val( ids );
    $('#myModal').modal('show');
});
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
          Are you sure you want to delete this chemical ?<br>
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
        <form  method="post" action="tcpdf_a6/examples/print-label2.php" target="_blank" id="printForm_id" >

         
        <div class="modal-body">
            Please select one of the three label sizes in order to get the PDF document.<br><br>
            <input type="text" class="form-control" name="chemicalID" id="chemicalIDPrint" value="" hidden >
            <?php
                $result = $ch->selectCompanyStatus($_SESSION['company_id']);
                if($result['comp_priority'] == '2')
                {
                   if (isset($_COOKIE['FLangCode']) && isset($_COOKIE['SLangCode']))
                     {
            ?>



          
            <!-- Example split danger button -->

            Choose Language:
            <select class="form-control show-tick ms select2" data-placeholder="Select" name="language1" onchange="checkFirstLang()" id="firstLang">
                    
                    <option value="<?php echo $_COOKIE['FLangCode']; ?>"><?php 
                    $langText1 = $ch->selectLanguagetext($_COOKIE['FLangCode']);
                    echo $langText1['langText'].' - '.$_COOKIE['FLangText'];

                    ?></option>
                  <?php
                           //       $ch = new Chempo();
                                  $rows = $ch->selectLanguageToPrint();

                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['languageID']; ?>"><?php echo $row['lang']; ?></option>

                                   <?php 
                                    }
                                   ?>
             </select><p id="messageLang1" style="color:red;"></p><br>
             
            <select class="form-control show-tick ms select2" data-placeholder="Select" name="language2" onchange="checkSecondLang()" id="secondLang">
                 <option value="<?php echo $_COOKIE['SLangCode']; ?>"><?php 

                 $langText2 = $ch->selectLanguagetext($_COOKIE['SLangCode']);
                echo $langText2['langText'].' - '.$_COOKIE['SLangText']; 

                 ?></option>
                  <?php
                           //       $ch = new Chempo();
                                  $rows = $ch->selectLanguageToPrint();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['languageID']; ?>"><?php echo $row['lang']; ?></option>

                                   <?php 
                                    }
                                   ?>
             </select><p id="messageLang2" style="color:red;"><br>

            <div class="checkbox">
                            <input type="checkbox" name="remember_my_choice" id="remember_my_choice" value="1" onchange="rememberCheck()" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#cookieNotice" checked>
                            <label for="remember_my_choice">Remember My Choice</label>
              </div>

            

         <?php
            }
            else
            {
            ?>
                Choose Language:
            <select class="form-control show-tick ms select2" data-placeholder="Select" name="language1" onchange="checkFirstLang()" id="firstLang">
                    <option value='0' selected >Select First Language</option>
                  <?php
                           //       $ch = new Chempo();
                                  $rows = $ch->selectLanguageToPrint();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['languageID']; ?>"><?php echo $row['lang']; ?></option>

                                   <?php 
                                    }
                                   ?>
             </select><p id="messageLang1" style="color:red;"></p><br>
             
            <select class="form-control show-tick ms select2" data-placeholder="Select" name="language2" onchange="checkSecondLang()" id="secondLang">
                <option value='0' selected >Select Second Language</option>
                  <?php
                           //       $ch = new Chempo();
                                  $rows = $ch->selectLanguageToPrint();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['languageID']; ?>"><?php echo $row['lang']; ?></option>

                                   <?php 
                                    }
                                   ?>
             </select><p id="messageLang2" style="color:red;"><br>

            <div class="checkbox">
                            <input type="checkbox" name="remember_my_choice" id="remember_my_choice" value="0" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#cookieNotice">
                            <label for="remember_my_choice">Remember My Choice</label>
              </div>

             


            <?php
            }
            ?>
            



        <?php
         }
         else
         {
        ?>
            In order to print A5, A6 and enjoy all the functionalities offered by Chemistry service portal. Upgrade your company account now !. Please email us regarding your payment option. you can email us at: <a href="mailto:contact_us@rimpido.com" target="_top" >contact_us@rimpido.com</a>
        <?php
        }
        ?>

        </div>
        
        <div class="modal-footer">
            <?php
                $result = $ch->selectCompanyStatus($_SESSION['company_id']);
                if($result['comp_priority'] == '2')
                {
            ?>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn btn-outline-success waves-effect" name="A4-Size" value="" id="a4-btn" ><i class="zmdi zmdi-print" ></i>&nbsp;A4</button>
                <button type="submit" class="btn btn btn-outline-success waves-effect" name="A5-Size" value="" id="a5-btn"><i class="zmdi zmdi-print" ></i>&nbsp;A5</button>
                <button type="submit" class="btn btn btn-outline-success waves-effect" name="A6-Size" value="" id="a6-btn"><i class="zmdi zmdi-print" ></i>&nbsp;A6</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?php

                }
                else
                {
            ?>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn btn-outline-success waves-effect" name="A4-Size-Free" value="" ><i class="zmdi zmdi-print" ></i>&nbsp;A4</button>
                <button style="color:#000;" type="submit" class="btn btn btn-outline-success waves-effect" name="A5-Size" value="" disabled><i class="zmdi zmdi-print" ></i>&nbsp;A5</button>
                <button type="submit" style="color:#000;" class="btn btn btn-outline-success waves-effect" name="A6-Size" value="" disabled><i class="zmdi zmdi-print" ></i>&nbsp;A6</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><br>
                <div class="modal-footer">
                
            </div>

            <?php
                }
            ?>
            
            
         


            
          

        </div>
       </form>
      </div>
      
    </div>
  </div>




    </div>
</section>
<script type="text/javascript">
    function checkLangInput()
    {
        if(document.getElementById("firstLang").value == '0' && document.getElementById("secondLang").value == '0')
        {
            alert("Please select First and Second Language !");
        }
        else if(document.getElementById("firstLang").value == '0' && document.getElementById("secondLang").value != '0')
        {
            alert("Please select First Language !");
        }
        else if(document.getElementById("firstLang").value != '0' && document.getElementById("secondLang").value == '0')
        {
            alert("Please select Second Language !");
        }
        else
        {
            document.getElementById("printForm_id").submit();
        }
    }

    function checkFirstLang()
    {
        if(document.getElementById("firstLang").value == '0' )
        {
            //alert("Please select First and Second Language !");
            document.getElementById("messageLang1").innerHTML = "Please select first langauage to be printed !";
            document.getElementById("a4-btn").disabled = true;
            document.getElementById("a5-btn").disabled = true;
            document.getElementById("a6-btn").disabled = true;
            document.getElementById("a4-btn").style.color = "white";
            document.getElementById("a5-btn").style.color = "white";
            document.getElementById("a6-btn").style.color = "white";

        }
        else if(document.getElementById("firstLang").value != '0' && document.getElementById("secondLang").value == '0')
        {
            document.getElementById("messageLang1").innerHTML = "";
        }
        else if(document.getElementById("firstLang").value != '0' && document.getElementById("secondLang").value != '0')
        {
            document.getElementById("messageLang1").innerHTML = "";
            document.getElementById("a4-btn").disabled = false;
            document.getElementById("a5-btn").disabled = false;
            document.getElementById("a6-btn").disabled = false;
        }
      
       
    }

    function checkSecondLang()
    {
        if(document.getElementById("secondLang").value == '0')
        {
            document.getElementById("messageLang2").innerHTML = "Please select Second Language to be printed !";
            document.getElementById("a4-btn").disabled = true;
            document.getElementById("a5-btn").disabled = true;
            document.getElementById("a6-btn").disabled = true;
            document.getElementById("a4-btn").style.color = "white";
            document.getElementById("a5-btn").style.color = "white";
            document.getElementById("a6-btn").style.color = "white";
        }
        else if(document.getElementById("firstLang").value == '0' && document.getElementById("secondLang").value != '0')
        {
            document.getElementById("messageLang2").innerHTML = "";
        }
        else if(document.getElementById("firstLang").value != '0' && document.getElementById("secondLang").value != '0')
        {
            document.getElementById("messageLang2").innerHTML = "";
            document.getElementById("a4-btn").disabled = false;
            document.getElementById("a5-btn").disabled = false;
            document.getElementById("a6-btn").disabled = false;
        }
        
        
    }

    function bodyOnLoad()
    {
            

            if(document.getElementById("remember_my_choice").value == "1")
            {
                document.getElementById("a4-btn").disabled = false;
                document.getElementById("a5-btn").disabled = false;
                document.getElementById("a6-btn").disabled = false;
            }
            else
            {
                document.getElementById("a4-btn").disabled = true;
                document.getElementById("a5-btn").disabled = true;
                document.getElementById("a6-btn").disabled = true;
                document.getElementById("a4-btn").style.color = "white";
                document.getElementById("a5-btn").style.color = "white";
                document.getElementById("a6-btn").style.color = "white";
            }






    }

    function rememberCheck()
    {
        
        if(document.getElementById("remember_my_choice").checked == false)
        {
            document.cookie = "FLangCode=; SLangCode=; FLangText=; SLangText=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
        }
    }


        
</script>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/tables/jquery-datatable.js"></script>


</body>


</html>
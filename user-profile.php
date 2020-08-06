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


if(isset($_SESSION['user_id']))
{

    $ch = new Chempo();

    $result = $ch->readUserInfo($_SESSION['user_id']);

}


?>



<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: User Profile</title>
<link rel="icon" href="assets/images/rimpido-header.png" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/rimpido-header.png" width="48" height="48" alt="ChemPO"></div>
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
            <form action="user-edit.php" method="post"> 
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>User Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item">User</li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                 
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <?php
                        if($_SESSION['user_role_id'] == '2' && ($_SESSION['company_id'] == $result['company_id']))
                        {
                        ?>
                            <button type="submit" class="btn btn-info btn-icon float-right" name="editUser" value="<?php echo $result['user_id']; ?>"><i class="zmdi zmdi-edit" ></i></button>
                        <?php
                        }
                        elseif($_SESSION['user_role_id'] == '3' || $_SESSION['user_role_id'] == '4')
                        {
                        ?>
                        <button type="submit" class="btn btn-info btn-icon float-right" name="editUser" value="<?php echo $result['user_id']; ?>"><i class="zmdi zmdi-edit" ></i></button>
                        <?php
                        }
                        elseif($_SESSION['company_id'] == '0')
                        {
                        ?>
                            <button type="submit" class="btn btn-info btn-icon float-right" name="editUser" value="<?php echo $result['user_id']; ?>"><i class="zmdi zmdi-edit" ></i></button>
                        <?php
                        }

                    ?>


                        


               

                    
                </div>
            
            </div>
        </form>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <?php
                            $picture = $result['profile_pic'];
                            if($picture == "")
                            {
                                echo '<img src="img/users-pic/default.jpg" class="rounded-circle shadow " alt="user-profile-image">';
                            }
                            else
                            {
                               echo '<img src="img/users-pic/'.$picture.'" class="rounded-circle shadow " alt="user-profile-image">'; 
                            }
                            
                            //FOR SALUTATION
                            // 0 - MR.
                            // 1 - MS.
                            // 2 - MRS.
                            
                            if (((int)$result['salutation']) === 0) {
                                $salutation = 'Mr.';
                            } elseif (((int)$result['salutation']) === 1) {
                                $salutation = 'Ms.';
                            } elseif (((int)$result['salutation']) === 2) {
                                $salutation = 'Mrs.';
                            } else {
                                $salutation = '';
                            }
                            ?>
                            <h4 class="m-t-10"><?php echo ($salutation.' '.$result['f_name'].' '. $result['m_name'].' '.$result['l_name']); ?></h4>                            
                            <div class="row">
                                <div class="col-12">
                                    <ul class="social-links list-unstyled">
                                        <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                    </ul>
                                    <p class="text-muted mt-3 mb-3"></p>
                                </div>
                                <div class="col-5 ">                                    
                                    <small>Chemicals</small>
                                    <h5><?php 
                                        $userid = $result['user_id'];
                                        $chemRes = $ch->countNumOfChemAdded($userid);
                                        echo $chemRes['chemAdded'];
                                     ?></h5>
                                </div>
                                <div class="col-2">                                    
                                    
                                </div>
                                <div class="col-5">                                    
                                    <!--<small>Users</small>
                                    <h5>15</h5>-->
                                    <small>Certificates</small>
                                    <h5><?php
                                    $userid = $result['user_id'];
                                    $certRes = $ch->countNumOfCertAdded($userid);
                                    echo $certRes['certAdded'];
                                    ?></h5>
                                </div>                            
                            </div><br><br>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                                <!--<small>Credentials</small>-->
                                </div>
                                 <div class="col-3"></div> 
                                 <div class="col-12">
                                    <!--<p>
                                        Not yet Implemented<br><br>
                                        Not yet Implemented<br><br>
                                        Not yet Implemented
                                    </p>-->
                                </div>                             
                            </div>
                        </div>
                    </div>
                                       
                </div>
                <?php
                if($result['user_id'] != $_SESSION['user_id'])
                {
                ?>
                 <div class="col-lg-8 col-md-12">
                     <div class="card">
                        <div class="body">
                          <h3>Chemicals Added</h3>
                            <div class="table-responsive">
                        <form action="chemicals-edit-new.php" method="post">  
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                            
                                            
                                            <th width="55%">Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                            <th>Chemical Name</th>
                                            <th>CAS No</th>
                                          
                                            
                                            <th width="55%">Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        <?php
                                                
                                                $ch = new Chempo();
                                                $rows = $ch->userChemicalsList($result['user_id']);
                                                if(!empty($rows)) {
                                                foreach ($rows as $row) 
                                                {
                                                
                                            ?>
                        
                                                    <tr>
                                                    
                                                    <td><?php echo $row['begin_of_pname']; ?></td>
                                                    <td><?php echo $row['cas_no']; ?></td>
                                                    
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
                                                }
                                            ?>
                                      
                                        
                                    </tbody>
                                </table>
                            </form>
                        </div>
                           <!------------------------------------------------------------->
                           <h3 class="mt-5">38.3 Certificates Added</h3>
                            <div class="table-responsive">
                        <form action="cert-edit.php" method="post">  
                        <table class="table table-hover c_table theme-color">
                            <thead>
                                <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Battery Name</th>
                                            <th>Supplier</th>
                                            <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                        
                                        <?php
                                               
                                                
                                                $ch = new Chempo();
                                                $rows = $ch->userUploadedCertificates($result['user_id']);
                                                if($rows == "")
                                                {
                                                    echo "No Certificates Added";
                                                }
                                                else
                                                {
                                                foreach ($rows as $row) 
                                                {
                                            ?>
                        
                                                    <tr>
                                                    <th scope="row"><?php echo $row['battery_cert_id']; ?></th>
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
                                                               

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>
                                                                 
                                                            <?php
                                                            }
                                                            elseif($_SESSION['user_group_id'] == '3')
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                             

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>
                                                            <?php
                                                            }
                                                            elseif($_SESSION['user_group_id'] == '4')
                                                            {
                                                            ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteCertID" data-id="<?php echo $row['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>&nbsp;

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>

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
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteCertID" data-id="<?php echo $row['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>&nbsp;

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>


                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>

                                                            <?php
                                                            }
                                                            ?>



                                                        <?php
                                                        }
                                                        elseif ($_SESSION['user_role_id'] == '3') 
                                                        {
                                                        ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                               

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>


                                                        <?php
                                                        }
                                                        elseif($_SESSION['user_role_id'] == '4')
                                                        {
                                                        ?>
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect" name="editCert" value="<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-edit" ></i></button> &nbsp;
                                                                <button type="button" class="btn btn-sm btn-outline-danger deleteCertID" data-id="<?php echo $row['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>&nbsp;

                                                                <a  class="btn btn-sm btn-outline-success" href="cert-view.php?read=<?php echo $row['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>

                                                        <?php
                                                        }
                                                        ?>
                                                        

                                                       
             
                                                    </td>

                                                 
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                      
                                        
                                    </tbody>
                        </table>
                    </form>
                        </div>
                        </div>
                    </div>                    
                </div>


                <?php
                }
                else
                {
                ?>
                
                    <div class="col-lg-8 col-md-12">
                     <div class="card">
                         <div class="header">
                            <h2><strong>YOUR SUBSCRIPTION</strong>
                              
                            </h2>
                         </div>
                        <div class="body">
                            <?php
                                if ($result['verified'] == 1)
                                {
                            ?>
                            <div class="alert alert-success">
                                <strong>Well done!</strong> You have succesfully verified your e- mail!
                            </div>
                           
                           
                            <?php
                                }else
                                {
                            ?>
                            <div class="alert alert-warning">
                                <strong>Please verify your e- mail Address.</strong> Until then, you are only limited to viewing chemicals. Verify your e-mail to print labels!
                            </div>
                           
                            <?php
                              }
                    
                                if ($result['company_id'] == 0)
                                {
                            ?>
                             <div class="alert alert-danger">
                                <strong>Your Status:</strong> Registered User ~ <i>Free</i>. It seems that you are not registered under a company. In order to have enjoy the full capabilities of ChemPO, upgrade your account to Paid. Please email us regarding your payment option. you can email us at: contact_us@rimpido.com. Until then, you are registered as a Free Regular User. Thank You!
                            </div>
                            <?php
                              }else
                                {
                                    
                                    //echo $result['company_id'];
                                    $compCheck = $result['company_id'];
                                    //check for company subscription
                                   $checkCompSubscription = new Chempo();
                                    //$ch = new Chempo();
                                    
                                   $result22 = $checkCompSubscription->checkSubscription($compCheck);
                                    
                                   //echo $result22['comp_priority'];
                                
                                    //echo "slakidjflksajdflksajdf";
                                    
                                    //echo $result22['comp_priority'];
                                    
                                    if($result22['comp_priority'] == 2)
                                    { 
                            ?>
                            <div class="alert alert-success">
                                <strong>Your Status:</strong> Company User ~ <i>Paid</i>.  <strong>Well done!</strong> Enjoy all the functionalities and services offered by Chemistry Service Portal!.
                            </div>  
                            <?php
                                    }else if ($result22['comp_priority'] == 1)
                                    {
                                        ?>
                                        <div class="alert alert-warning">
                                            <strong>Payment not yet confirmed!</strong> Please email us regarding your payment option. you can email us at: <a href="mailto:schuur@rimpido.com" target="_top">schuur@rimpido.com</a>. Until then, users under this company are downgraded as Free Users.
                                        </div>
                                    <?php            
                                    }else{
                                    ?>
                                     <div class="alert alert-danger">
                                        <strong>Oh snap!</strong> You are missing out on a lot of features! E-mail us at <a href="mailto:schuur@rimpido.com" target="_top">schuur@rimpido.com</a> to upgrade! 
                                    </div>
                                    <?php            
                                    }
                                }
                            ?>
                        </div>
                         <div class="header">
                            <h2><strong>YOUR PROFILE INFORMATION</strong>
                              
                            </h2>
                         </div>
                    <div class="body">
                            <div class="container-fluid">
                                <small>Username</small>
                                <p><?php echo $result['username']; ?></p>
                                <hr>
                                <small>User Role</small>
                                <p><?php 

                                echo $result['role_name']; 


                                ?></p>
                                <hr>
                                <small>User Group</small>
                                <p><?php 
                                echo ($result['usergroup_name'].' = '.$result['usergroup_desc']);

                               
                                ?></p>
                                <hr>
                            </div>
                    </div>                    
                </div>
                </div>
    
                
                  <div class="col-lg-12 col-md-12">
                     <div class="card">
                         <div class="header">
                            <h2><strong>YOUR PERSONAL INFORMATION</strong>
                            </h2>
                         </div>
                        <div class="body">
                            <small class="text-muted">First Name: </small>
                            <p><?php echo $result['f_name']; ?></p>
                            <hr>
                            <small class="text-muted">Middle Name: </small>
                            <p><?php echo $result['m_name']; ?></p>
                            <hr>
                            <small class="text-muted">Last Name: </small>
                            <p><?php echo $result['l_name']; ?></p>
                            <hr>
                            <small class="text-muted">Email address: </small>
                            <p><?php echo $result['email']; ?></p>
                            <hr>
                            <small class="text-muted">Phone: </small>
                            <p><?php echo $result['phone_no']; ?></p>
                            <hr>
                            <small class="text-muted">Birthdate: </small>
                            <p><?php echo $result['birthdate']; ?></p>
                            <hr>
                            <small class="text-muted">Address: </small>
                            <p><?php echo ($result['address1'].', '.$result['address2'].', '.$result['address3']); ?></p>
                            <hr>
                            <small class="text-muted">Sex: </small>
                            <p><?php 
                            $sex = $result['sex']; 
                            $sexVal = "";
                            if($sex == 0)
                            {
                                $sexVal = "Female";
                            }
                            else
                            {
                                $sexVal = "Male";
                            }

                            echo $sexVal;
                            ?></p>
                            <hr>
                           
                        </div>
                    </div>                    
                </div>
                </div>

                <?php
                }

                ?>
              
            </div>
        </div>

      
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/js/pages/medias/image-gallery.js"></script>
<script src="assets/js/pages/calendar/calendar.js"></script>
</body>

</html>
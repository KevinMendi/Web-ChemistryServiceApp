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

if (isset($_POST['delete-cert']) && $_SERVER["REQUEST_METHOD"] == "POST") {

$certID = test_input($_POST["certID"]);
$tableName = "tb_battery_cert";
$whereClause = "battery_cert_id";
$ch = new Chempo();

$fields = [ 
         
            'del_status'=>'X'
           
        ];

$check = $ch->delete($fields,$certID,$tableName,$whereClause);

if($check == 1)
{
    
    if($_SESSIO['company_id'] == '0')
    {
        header("Location: 38.3-certificate.php");
    }
    else
    {
        header("Location: cert-lists.php");
    }
}
else
{
   
    echo '<div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                    <strong>Oh snap!</strong> There was a problem occured during the deletion of this record. Please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
}


}


?>




<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: ChemPO :: 38.3 Certificates</title>
<!-- Favicon-->
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<!-- Font Icon -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body class="theme-blush">

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

<section class="content file_manager">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Documents</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">38.3 Certificates</li>
                        <li class="breadcrumb-item active">Documents</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    
                    

                                    <?php
                                        if($_SESSION['user_role_id'] == '1')
                                        {
                                            if($_SESSION['user_group_id'] == '1')
                                            {
                                    ?>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <a href="cert-add.php" class="btn btn-success btn-icon float-right"><i class="zmdi zmdi-upload"></i></a>
                                            <?php
                                            }
                                            
                                            ?>

                                           
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <a href="cert-add.php" class="btn btn-success btn-icon float-right"><i class="zmdi zmdi-upload"></i></a>

                                    <?php
                                        }
                                    ?>

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs pl-0 pr-0">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#doc">PDF</a></li>
                         
                        </ul>                    
                        <div class="tab-content">
                            <div class="tab-pane active" id="doc">
                                <div class="row clearfix">


                                                <?php
                                                    $ch = new Chempo();
                                                $rows = $ch->certsList($_SESSION['user_id']);
                                                $rows2 = $ch->certsListPerUser($_SESSION['user_id']);



                                               
                                if($_SESSION['company_id'] == '0')
                                {
                                    if($rows2 == "")
                                    {
                                        echo "No Certificates Found !";
                                    }
                                    foreach ($rows2 as $row2) 
                                                {
                                                
                                ?>

                                
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <form action="cert-edit.php" method="post">  
                                <div class="card" >
                                            <div class="file" style="padding: 50px 15px 10px !important;">
                                                <a href="javascript:void(0);">
                                                    <div class="hover">
                                                        <!--
                                                        <a href="certification/certs/<?php echo $result['batt_cert']; ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-success">
                                                            <i class="zmdi zmdi-download"></i>
                                                        </button></a>
                                                    -->
                                                    <button type="button" class="btn btn-icon btn-icon-mini btn-round btn-danger deleteCertID" data-id="<?php echo $row2['battery_cert_id']; ?>" ><i class="zmdi zmdi-delete"></i></button>
                                                    <button type="submit" class="btn btn-icon btn-icon-mini btn-round btn-warning" name="editCert" value="<?php echo $row2['battery_cert_id']; ?>"><i class="zmdi zmdi-edit" ></i></button>
                                                    <a  class="btn btn-icon btn-icon-mini btn-round btn-info" href="cert-view.php?read=<?php echo $row2['battery_cert_id']; ?>"><i class="zmdi zmdi-eye"></i></a>
                                                    <a  class="btn btn-icon btn-icon-mini btn-round btn-success" href="certification/certs/<?php echo $row2['batt_cert']; ?>"><i class="zmdi zmdi-download"></i></a>

                                                    </div>
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><?php echo $row2['prod_name']; ?><br>

                                                            
                                                        </p>
                                                        
                                                        <small class="date text-muted"><?php echo $row2['date_added']; ?></small><br>
                                                        <?php
                                                            $file = 'certification/certs/'.$row2['batt_cert'];
                                                            $filesize = filesize($file);
                                                            $filesize = round($filesize / 1024, 2);
                                                            echo '<small>Size: '.$filesize.' </small>';
                                                        ?>
                                                        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                         </form>
                                    </div>
                               

                                <?php
                                }
                            }
                                else {
                                



                                                foreach ($rows as $row) 
                                                {
                                                ?>


                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <?php
                                        if($_SESSION['user_role_id'] == '1' && $_SESSION['company_id'] == $row['company_id'])
                                        {
                                            
                                    ?>
                                        <div class="card" >
                                            <div class="file" style="padding: 50px 15px 10px !important;">
                                                <a href="javascript:void(0);">
                                                    <div class="hover">
                                                        <!--
                                                        <a href="certification/certs/<?php echo $result['batt_cert']; ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-success">
                                                            <i class="zmdi zmdi-download"></i>
                                                        </button></a>
                                                    --><a  class="btn btn-icon btn-icon-mini btn-round btn-success" href="certification/certs/<?php echo $row['batt_cert']; ?>"><i class="zmdi zmdi-download"></i></a>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><?php echo $row['prod_name']; ?><br>

                                                            
                                                        </p>
                                                        
                                                        <small class="date text-muted"><?php echo $row['date_added']; ?></small><br>
                                                        <?php
                                                            $file = 'certification/certs/'.$row['batt_cert'];
                                                            $filesize = filesize($file);
                                                            $filesize = round($filesize / 1024, 2);
                                                            echo '<small>Size: '.$filesize.' </small>';
                                                        ?>
                                                        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                            


                                    <?php
                                        }
                                        elseif($_SESSION['user_role_id'] == '2')
                                        {
                                            if($_SESSION['company_id'] == $row['company_id'])
                                            {
                                    ?>
                                            <div class="card" >
                                            <div class="file" style="padding: 50px 15px 10px !important;">
                                                <a href="javascript:void(0);">
                                                    <div class="hover">
                                                        <!--
                                                        <a href="certification/certs/<?php echo $result['batt_cert']; ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-success">
                                                            <i class="zmdi zmdi-download"></i>
                                                        </button></a>
                                                    --><a  class="btn btn-icon btn-icon-mini btn-round btn-success" href="certification/certs/<?php echo $row['batt_cert']; ?>"><i class="zmdi zmdi-download"></i></a>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><?php echo $row['prod_name']; ?><br>

                                                            
                                                        </p>
                                                        
                                                        <small class="date text-muted"><?php echo $row['date_added']; ?></small><br>
                                                        <?php
                                                            $file = 'certification/certs/'.$row['batt_cert'];
                                                            $filesize = filesize($file);
                                                            $filesize = round($filesize / 1024, 2);
                                                            echo '<small>Size: '.$filesize.' </small>';
                                                        ?>
                                                        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                            <?php

                                            }
                                            else
                                            {
                                            ?>

                                            <?php
                                            }
                                            ?>


                                    <?php
                                        }
                                        elseif($_SESSION['user_role_id'] == '3' || $_SESSION['user_role_id'] == '4')
                                        {
                                    ?>
                                    <div class="card" >
                                            <div class="file" style="padding: 50px 15px 10px !important;">
                                                <a href="javascript:void(0);">
                                                    <div class="hover">
                                                        <!--
                                                        <a href="certification/certs/<?php echo $result['batt_cert']; ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-success">
                                                            <i class="zmdi zmdi-download"></i>
                                                        </button></a>
                                                    --><a  class="btn btn-icon btn-icon-mini btn-round btn-success" href="certification/certs/<?php echo $row['batt_cert']; ?>"><i class="zmdi zmdi-download"></i></a>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><?php echo $row['prod_name']; ?><br>

                                                            
                                                        </p>
                                                        
                                                        <small class="date text-muted"><?php echo $row['date_added']; ?></small><br>
                                                        <?php
                                                            $file = 'certification/certs/'.$row['batt_cert'];
                                                            $filesize = filesize($file);
                                                            $filesize = round($filesize / 1024, 2);
                                                            echo '<small>Size: '.$filesize.' </small>';
                                                        ?>
                                                        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>


                                    <?php
                                        }
                                        else{
                                      
                                    ?>
                                            <div class="card" >
                                            <div class="file" style="padding: 50px 15px 10px !important;">
                                                <a href="javascript:void(0);">
                                                    <div class="hover">
                                                        <!--
                                                        <a href="certification/certs/<?php echo $result['batt_cert']; ?>"><button type="button" class="btn btn-icon btn-icon-mini btn-round btn-success">
                                                            <i class="zmdi zmdi-download"></i>
                                                        </button></a>
                                                    <a  class="btn btn-icon btn-icon-mini btn-round btn-success" href="certification/certs/<?php echo $row['batt_cert']; ?>"><i class="zmdi zmdi-download"></i></a>-->
                                                    </div>
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><?php echo $row['prod_name']; ?><br>

                                                            
                                                        </p>
                                                        
                                                        <small class="date text-muted"><?php echo $row['date_added']; ?></small><br>
                                                        <?php
                                                            $file = 'certification/certs/'.$row['batt_cert'];
                                                            $filesize = filesize($file);
                                                            $filesize = round($filesize / 1024, 2);
                                                            echo '<small>Size: '.$filesize.' </small>';
                                                        ?>
                                                        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                            }
                                        ?>

                                    
                                        


                                    </div>

                                    <?php
                                }
                            }
                                ?>


                            
<script type="text/javascript">
    $(".deleteCertID").click(function () {
    var ids = $(this).attr('data-id');
    $("#certID").val( ids );
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
                                    
   
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>    
</body>

</html>
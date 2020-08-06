

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


if(isset($_GET['read']))
{
    $uid = $_GET['read'];

    $ch = new Chempo();

    $result = $ch->readChemicalInfo($uid);


    //////////////////
    $ghs = $ch->readGhs($uid);
$ghs1 = (int)$ghs['ghs1'];
$ghs2 = (int)$ghs['ghs2'];
$ghs3 = (int)$ghs['ghs3'];
$ghs4 = (int)$ghs['ghs4'];
$ghs5 = (int)$ghs['ghs5'];
$ghs6 = (int)$ghs['ghs6'];
$ghs7 = (int)$ghs['ghs7'];
$ghs8 = (int)$ghs['ghs8'];
$ghs9 = (int)$ghs['ghs9'];
$path1="";
$path2="";
$path3="";
$path4="";
$path5="";
$path6="";
$path7="";
$path8="";
$path9="";

if($ghs1 == 1)
{
    $path1 = "img/ghs/GHS01.jpg";
}
else
{
    $path1 = "";
}

if($ghs2 == 1)
{
    $path2 = "img/ghs/GHS02.jpg";
}
else
{
    $path2 = "";
}

if($ghs3 == 1)
{
    $path3 = "img/ghs/GHS03.jpg";
}
else
{
    $path3 = "";
}

if($ghs4 == 1)
{
    $path4 = "img/ghs/GHS04.jpg";
}
else
{
    $path4 = "";
}

if($ghs5 == 1)
{
    $path5 = "img/ghs/GHS05.jpg";
}
else
{
    $path5 = "";
}

if($ghs6 == 1)
{
    $path6 = "img/ghs/GHS06.jpg";
}
else
{
    $path6 = "";
}
if($ghs7 == 1)
{
    $path7 = "img/ghs/GHS07.jpg";
}
else
{
   $path7 = ""; 
}
if($ghs8 == 1)
{
    $path8 = "img/ghs/GHS08.jpg";
}
else
{
    $path8 = "";
}
if($ghs9 == 1)
{
    $path9 = "img/ghs/GHS09.jpg";
}
else
{
    $path9 = "";
}

$ghsLabel = array($path1, $path2, $path3, $path4, $path5, $path6, $path7, $path8, $path9);

}



?>


<!DOCTYPE html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: View Chemical</title>
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">

</head>

<body class="theme-blush">
    

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.png" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <!--
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

-->
</div>

<!-- Navbar -->
<?php include_once('navbar.php') ?>

<section class="content">
    <div class="body_scroll">
        <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Chemical Information</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">Chemicals</li>
                        <li class="breadcrumb-item active">View Chemical</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>


        <!---Chemical Info -->
        <div class="container-fluid">
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical</strong> General Information</h2>
                            <!--
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
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
                                <div class="header">
                                <h2><strong style="font-size: 30px;"><?php echo $result['begin_of_pname']; ?></strong></h2>
                                </div>
                                <small>CAS Number</small>
                                <div class="form-group form-float">
                                    
                                    <input type="text" class="form-control"  name="casNumber" value="<?php echo $result['cas_no']; ?>" readonly>
                                </div>
                                <small>UN Number</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="unNumber" value="<?php echo $result['un_no']; ?>" readonly>
                                </div>
                                <small>Chemical Name</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="chemicalName" value="<?php echo $result['begin_of_pname']; ?>" readonly>
                                </div>
                                <small>IUPAC Name</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="iupacName" value="<?php echo $result['iupac_name']; ?>" readonly>
                                </div>
                                <small>Commercial Name</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="commercialName" value="<?php echo $result['commercial_name']; ?>" readonly>
                                </div>
                                
                                <!--
                                <button class="btn btn-raised btn-primary waves-effect" name="submit-header" type="submit">SUBMIT</button>-->
                               
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chemical</strong> Properties</h2>
                            <!--
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
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
                            
                                
                                <div class=" form-group form-float">
                                    
                                    <small>State of Matter</small>

                                    
                                    <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="stateOfMatter" 
                                    value="<?php 
                                     $state = $result['state_of_matter']; 
                                        if($state == '0')
                                        {
                                            $stateVal = "";
                                        }
                                        elseif ($state == '1') 
                                        {
                                             $stateVal = "Not Applicable";
                                        }
                                        elseif ($state == '2') 
                                        {
                                             $stateVal = "Solid";
                                        } 
                                        elseif ($state == '3') 
                                        {
                                             $stateVal = "Liquid";
                                        }
                                        elseif ($state == '4') 
                                        {
                                             $stateVal = "Gas";
                                        }
                                        elseif ($state == '5') 
                                        {
                                             $stateVal = "Plasma";
                                        } 

                                        echo $stateVal;   

                                    ?>" readonly>
                                    </div>
                                   
                                </div>
                                <small>Density</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="density" value="<?php echo $result['density']; ?>" readonly>
                                </div>
                                <small>PH Value</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="phValue" value="<?php echo $result['ph_value']; ?>" readonly>
                                </div>
                                <small>Boiling Point</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="boilingPoint" value="<?php echo $result['boiling_point']; ?>" readonly>
                                </div>
                                <small>Melting Point</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="meltingPoint" value="<?php echo $result['melting_point']; ?>" readonly>
                                </div>
                                <small>Flash Point</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="flashPoint" value="<?php echo $result['flash_point']; ?>" readonly>
                                </div>
                                <small>Refractive Index</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="refractiveIndex" value="<?php echo $result['refractive_index']; ?>" readonly>
                                </div>
                                <small>Molecular Weight</small>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="molecularWeight" value="<?php echo $result['molecular_weight']; ?>" readonly>
                                </div>
                                <small>Chemical Type</small>
                                <div class=" form-group form-float">
                                    
                                    
                                    <div class="form-group form-float">
                                    <input type="text" class="form-control"  name="chemicalType" 
                                    value="<?php 
                                     $type = $result['chemical_type']; 
                                        if ($type == '1') 
                                        {
                                             $typeVal = "Substance";
                                        }
                                        elseif ($type == '2') 
                                        {
                                             $typeVal = "Substance under REACH but Mixture";
                                        } 
                                        elseif ($type == '3') 
                                        {
                                             $typeVal = "Mixture";
                                        }
                                        else
                                        {
                                            
                                        }
                                       

                                        echo $typeVal;   

                                    ?>" readonly>
                                    </div>
                                    
                                </div>
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
         
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>H & P</strong> Phrases</h2>
                           
                        </div>
                        <div class="body">
                           
                           
                                <div class=" form-group form-float">
                                <small>Signal Word</small>
                                     <input type="text" class="form-control"  name="signalWord" 
                                    value="<?php 
                                     $signal = $result['signal_word']; 
                                        if($signal == 'W')
                                        {
                                            $signalVal = "Warning";
                                        }
                                        elseif ($signal == 'D') 
                                        {
                                             $signalVal = "Danger";
                                        }
                                        
                                       

                                        echo $signalVal;   

                                    ?>" readonly>
                                </div><br><br>
                               
                                <div class="form-group form-float">
                                    <h6><b style="font-size: 15px !important;">Hazard Statements</b></h6><hr>
                                    <?php 
                                    
                                     $temp = (string)($result['hphrase1']);
                                     $temp2 = (string)($result['hphrase2']);
                                     $temp3 = (string)($result['hphrase3']);
                                     $temp4 = (string)($result['hphrase4']);
                                     $temp5 = (string)($result['hphrase5']);
                                     $temp6 = (string)($result['hphrase6']);

                                     if($temp == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp);
                                        echo $result['hphrase1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp2);
                                     echo $result['hphrase2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp3);
                                     echo $result['hphrase3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp4);
                                     echo $result['hphrase4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp5);
                                     echo $result['hphrase5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp6);
                                     echo $result['hphrase6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     ?>
                                    
                                </div><br><br>
                                <div class="form-group form-float">
                                    <h6><b style="font-size: 15px !important;">Precautionary Statements: General</b></h6><hr>
                                    <?php 
                                    
                                     $tempp = (string)($result['pphrase1']);
                                     $tempp2 = (string)($result['pphrase2']);
                                     $tempp3 = (string)($result['pphrase3']);
                                     $tempp4 = (string)($result['pphrase4']);
                                     $tempp5 = (string)($result['pphrase5']);
                                     $tempp6 = (string)($result['pphrase6']);

                                     if($tempp == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp);
                                        echo $result['pphrase1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($tempp2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp2);
                                     echo $result['pphrase2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($tempp3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp3);
                                     echo $result['pphrase3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($tempp4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp4);
                                     echo $result['pphrase4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($tempp5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp5);
                                     echo $result['pphrase5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($tempp6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($tempp6);
                                     echo $result['pphrase6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     ?>
                                    
                                </div><br><br>
                                 <div class="form-group form-float">
                                    <h6><b style="font-size: 15px !important;">Precautionary Statements: Prevention</b></h6><hr>
                                    <?php 
                                    
                                     $temp_prev = (string)($result['pphrase_prev1']);
                                     $temp_prev2 = (string)($result['pphrase_prev2']);
                                     $temp_prev3 = (string)($result['pphrase_prev3']);
                                     $temp_prev4 = (string)($result['pphrase_prev4']);
                                     $temp_prev5 = (string)($result['pphrase_prev5']);
                                     $temp_prev6 = (string)($result['pphrase_prev6']);

                                     if($temp_prev == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev);
                                        echo $result['pphrase_prev1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_prev2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev2);
                                     echo $result['pphrase_prev2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_prev3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev3);
                                     echo $result['pphrase_prev3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_prev4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev4);
                                     echo $result['pphrase_prev4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_prev5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev5);
                                     echo $result['pphrase_prev5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_prev6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_prev6);
                                     echo $result['pphrase_prev6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                    
                                </div><br><br>
                                <div class="form-group form-float">
                                    <h6><b style="font-size: 15px !important;">Precautionary Statements: Response</b></h6><hr>
                                    <?php 
                                    
                                     $temp_res = (string)($result['pphrase_res1']);
                                     $temp_res2 = (string)($result['pphrase_res2']);
                                     $temp_res3 = (string)($result['pphrase_res3']);
                                     $temp_res4 = (string)($result['pphrase_res4']);
                                     $temp_res5 = (string)($result['pphrase_res5']);
                                     $temp_res6 = (string)($result['pphrase_res6']);

                                     if($temp_res == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res);
                                        echo $result['pphrase_res1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_res2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res2);
                                     echo $result['pphrase_res2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_res3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res3);
                                     echo $result['pphrase_res3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_res4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res4);
                                     echo $result['pphrase_res4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_res5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res5);
                                     echo $result['pphrase_res5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_res6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_res6);
                                     echo $result['pphrase_res6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                    
                                </div><br><br>
                                 <div class="form-group form-float">
                                    <h6><b style="font-size: 15px !important;">Precautionary Statements: Storage</b></h6><hr>
                                    <?php 
                                    
                                     $temp_storage = (string)($result['pphrase_storage1']);
                                     $temp_storage2 = (string)($result['pphrase_storage2']);
                                     $temp_storage3 = (string)($result['pphrase_storage3']);
                                     $temp_storage4 = (string)($result['pphrase_storage4']);
                                     $temp_storage5 = (string)($result['pphrase_storage5']);
                                     $temp_storage6 = (string)($result['pphrase_storage6']);

                                     if($temp_storage == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage);
                                        echo $result['pphrase_storage1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_storage2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage2);
                                     echo $result['pphrase_storage2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_storage3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage3);
                                     echo $result['pphrase_storage3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_storage4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage4);
                                     echo $result['pphrase_storage4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_storage5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage5);
                                     echo $result['pphrase_storage5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_storage6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_storage6);
                                     echo $result['pphrase_storage6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                    
                                </div><br><br>
                                 <div class="form-group form-float">
                                    <h6><b style="font-size: 15px !important;">Precautionary Statements: Disposal</b></h6><hr>
                                    <?php 
                                    
                                     $temp_disp = (string)($result['pphrase_disp1']);
                                     $temp_disp2 = (string)($result['pphrase_disp2']);
                                     $temp_disp3 = (string)($result['pphrase_disp3']);
                                     $temp_disp4 = (string)($result['pphrase_disp4']);
                                     $temp_disp5 = (string)($result['pphrase_disp5']);
                                     $temp_disp6 = (string)($result['pphrase_disp6']);

                                     if($temp_disp == "" )
                                     {
                                        echo "No data Available";
                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp);
                                        echo $result['pphrase_disp1'].' - '.$rp['phrasentext'];echo "<br>";
                                     }


                                     if($temp_disp2 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp2);
                                     echo $result['pphrase_disp2'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_disp3 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp3);
                                     echo $result['pphrase_disp3'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_disp4 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp4);
                                     echo $result['pphrase_disp4'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     if($temp_disp5 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp5);
                                     echo $result['pphrase_disp5'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                      if($temp_disp6 == "")
                                     {

                                     }
                                     else
                                     {
                                        $rp = $ch->selectPhrasetext($temp_disp6);
                                     echo $result['pphrase_disp6'].' - '.$rp['phrasentext'];echo "<br>";
                                     }

                                     ?>
                                    
                                </div><br><br>
                               
                          
                            
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>GHS</strong> Label</h2>
                            <!--
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
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
                            <?php
                            
                            foreach ($ghsLabel as $img) {
                                
                                if($img == "")
                                {

                                }
                                else
                                {
                                    

                                    $name = str_replace("img/ghs/","",$img);
                                    $name = str_replace(".jpg","",$name);
                                    echo'<img src="'.$img.'">';
                                    echo "&nbsp;&nbsp;";
                                    echo '<b>'.$name.'</b>';
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                                    


                                    
                                    
                                }
                                
                            }


                            ?>
                            
                                
                    
                     
                                
                                
                               <!-- <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>



                
     </form>   
    </div>
</section>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
<script src="assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/form-validation.js"></script> 
</body>


</html>
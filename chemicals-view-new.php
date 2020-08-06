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
<html lang="en">


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


<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<style type="text/css">
    .select2 {
        width: 100% !important;
    }
    
</style>
<!-- SET NAVIGATION BAR TO TOGGLE -->
<script type="text/javascript">
$("document").ready(function() {
    setTimeout(function(){$("body").toggleClass("ls-toggle-menu")});
    check_PHRange();
    check_BPRange();
    check_MPRange();
});


    
</script>
    
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
    <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="body_scroll">
        
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>View Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Chemicals</a></li>
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
                        </div>
                        <div class="body">
                            
                            <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>
                            
                                <div class="row clearfix">
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">  
                                    <small for="chemicalname">Chemical Name/Commercial Name: </small>
                                    <input type="text" class="form-control" placeholder="Chemical Name" name="chemicalName" value="<?php echo $result['begin_of_pname']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    <small for="chemicalType">Chemical Type: </small>
                                    <?php
                                        $type = $result['chemical_type'];
                                        if ($type == '1')
                                        { ?>
                                            <input type="text" class="form-control" data-placeholder="Select" name="chemicalType" id="chemicalType" onchange='chemicalTypeChange();' placeholder="Please Select" value = "Substance" readonly>
                                            
                                        <?php
                                        } elseif($type == '2') { ?>
                                            <input type="text" class="form-control" data-placeholder="Select" name="chemicalType" id="chemicalType" onchange='chemicalTypeChange();' placeholder="Please Select" value = "Substance under REACH but Mixture" readonly>
                                        <?php
                                        } elseif($type == "3") {?>
                                            <input type="text" class="form-control" data-placeholder="Select" name="chemicalType" id="chemicalType" onchange='chemicalTypeChange();' placeholder="Please Select" value = "Mixture" readonly>
                                        <?php
                                        }else {?>
                                            <input type="text" class="form-control" data-placeholder="Select" name="chemicalType" id="chemicalType" onchange='chemicalTypeChange();' placeholder="Please Select" value = "" readonly>
                                        <?php
                                        }?>
                                    </div>

                                    <br>
                                    <div class="col-sm-12" id="title" style="margin-left:-15px">
                                        <label for="chem-identifiers"><b>Chemical Identifiers</b></label>
                                    </div>
                                    <div class="row clearfix" id="chem-identifiers">
                                        
                                        
                                        <div class="col-sm-4">
                                        <small for="casNumber" id="casNumberLabel">CAS Number</small>
                                        <input type="text" class="form-control" placeholder="" name="casNumber" id="casNumber" onchange='check_CASNumber();' value="<?php echo $result['cas_no']; ?>" readonly>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                        <small for="ecNumber" id="ecNumberLabel">EC Number</small>
                                        <input type="text" class="form-control" placeholder="" name="ecNumber" id="ecNumber" onchange='check_ECNumber();' value="<?php echo $result['ec_number']; ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="iupacName" id="iupacNameLabel">IUPAC Name:</small>
                                        <input type="text" class="form-control" placeholder="" name="iupacName" id="iupacName" value="<?php echo $result['iupac_name']; ?>" readonly>
                                        </div>
                                    </div>
                                    
                                        
                                    <div class="row clearfix" id="chem-identifiers2">
                                        <div class="col-sm-4">
                                        <small for="ufi" id="ufiLabel">UFI:</small>
                                        <input type="text" class="form-control" placeholder="" name="ufi" id="ufi" onchange='check_UFI();' value="<?php echo $result['ufi']; ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="unNumber" id="unNumberLabel">UN Number</small>
                                        <input type="text" class="form-control" placeholder="" name="unNumber" id="unNumber" onchange='check_UNNumber();' value="<?php echo $result['un_no']; ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="reachNumber" id="reachNumberLabel">REACH Number</small>
                                        <input type="text" class="form-control" placeholder="" name="reachNumber" id="reachNumber" onchange='check_REACHNumber();' value="<?php echo $result['reach_number']; ?>" readonly>
                                        </div>
                                    </div>
                                   
                                    
                                    <br>
                                    <div class="row clearfix" id="chem-characteristics">
                                    <div class="col-sm-12">
                                        <label for="chem-identifiers"><b>Chemical Characteristics</b></label>
                                    </div>
                                    <div class="col-sm-6">
                                     <small>State of Matter</small>
                                        <?php
                                        $state = $result['state_of_matter'];
                                        if($state == "1") { ?>
                                            <input type="text" class ="form-control" data-placeholder="Select" name="stateOfMatter" value="Not Applicable" readonly> 

                                        <?php    
                                        } elseif ($state == "2") { ?>
                                            <input type="text" class ="form-control" data-placeholder="Select" name="stateOfMatter" value="Solid" readonly>                        
                                        <?php
                                        } elseif ($state == "3") { ?>
                                            <input type="text" class ="form-control" data-placeholder="Select" name="stateOfMatter" value="Liquid" readonly> 
                                        <?php
                                        } elseif ($state == "4") { ?>
                                            <input type="text" class ="form-control" data-placeholder="Select" name="stateOfMatter" value="Gas" readonly> 
                                        <?php
                                        } elseif ($state == "5") { ?>
                                            <input type="text" class ="form-control" data-placeholder="Select" name="stateOfMatter" value="Plasma" readonly> 
                                        
                                        <?php
                                        } else { ?>
                                            <input type="text" class ="form-control" data-placeholder="Select" name="stateOfMatter" value="" readonly> 
                                            
                                        <?php
                                        } ?>
                                        

                                    
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                             <small>Density</small>
                                            <?php
                                            $density = $result['density'];
                                            
                                            ?>
                                            <input type="text" class="form-control" name="density" id="density"  onkeypress="return isNumber(event)" value="<?php echo $density; ?>" readonly>
                                        </div>
                                        
                                        
                                    </div>
                                    PH Value/Range  
                                        <br>
                                        <?php 
                                            $phValue = $result['ph_value']; 
                                            
                                        ?>
                                    <div class="row clearfix">
                                        <div class="col-sm-12" id="phValueMin">
                                            <input type="number" class="form-control" name="phValueMin" id="phValueMinInput" min="0" max="14" value="<?php echo $result['ph_value']; ?>" readonly>
                                        </div>
                                    </div>
  
                                    Boiling Point/Range
                                    <br> 
                                     <?php 
                                            $boilingPoint = $result['boiling_point'];
                                        ?>
                                        
                                        
                                    <div class="row clearfix">
                                        <div class="col-sm-12" id="boilingPointMin">       
                                            <input type="text" class="form-control" name="boilingPointMin" id="boilingPointMinInput" value="<?php echo $boilingPoint; ?>" readonly>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    Melting Point/Range
                                    <br>
                                    <?php 
                                            $meltingPoint = $result['melting_point'];
                                        ?>
                                    <div class="row clearfix">
                                        <div class="col-sm-12" id="meltingPointMin">
                                            <input type="text" class="form-control" name="meltingPointMin" id="meltingPointMinInput" value="<?php echo $meltingPoint; ?>" onkeypress="return isNumber(event)" readonly>
                                            
                                        </div>
                                    </div> 
                                    Flash Point
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="flashPoint" value="<?php echo $result['flash_point']; ?>" onkeypress="return isNumber(event)" readonly>
                                        </div>
                                        
                                    </div> 
                                    Refractive Index
                                    
                                    <input type="text" class="form-control" name="refractiveIndex" value="<?php echo preg_replace('/[^-?0-9.,]/', '', $result['refractive_index']); ?>" onkeypress="return isNumber(event)" readonly>
                                    Molecular Weight
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            
                                            <input type="text" class="form-control" name="molecularWeight" id="molecularWeight" value="<?php echo  $result['molecular_weight']; ?>" onkeypress="return isNumber(event)" readonly>
                                        </div>
                                    </div> 
                                </div>
                                </div>
                                </div>
 
                                
                                <div class="col-sm-6">
                            
        <!-- H AND P PHRASES COLLAPSED -->
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-sm-12 mb-1">
                            <input type ="text" name="internalNo" class="form-control" value = "<?php echo $result['chemical_header_id']; ?>" hidden>
                            
                        <div class=" form-group form-float">
                                <small><b>Signal Word</b></small>
                                        <?php
                                        $signal = $result['signal_word'];
                                        if($signal === "W") {
                                            echo "<h3>Warning</h3>";
                                        } elseif ($signal === "D") {
                                             echo "<h3>Danger</h3>";
                                        } else {
                                            echo "<h3>No Signal Word Assigned</h3>";
                                        }
                                        ?>
                                </div>
                              </div>
                            <div class="panel-group full-body" id="accordion_5" role="tablist" aria-multiselectable="true">
                                <div class="panel l-coral">
                                    <div class="panel-heading" role="tab" id="headingOne_5">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseOne_5" aria-expanded="true" aria-controls="collapseOne_5"> Hazard and Precaution Phrases <b>(Click Here)</b> </a> </h4>
                                    </div>
                                    <div id="collapseOne_5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_5">
                                        <div class="panel-body">
                                               <div class="panel-body">
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <b>Hazard Statements</b><br>
                                  <?php
                                    
                                  for ($a=1; $a < 7; $a++) { 
                                    if($result['hphrase'.$a] != '' || $result['hphrase'.$a] != '')
                                    {

                                    ?>
                                     <?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['hphrase'.$a]);
                                    echo "<b>".$result['hphrase'.$a].'</b> - '. $phrasetext['phrasentext']."<br>"; 
                                    ?>
                                <?php

                                    }
                                  }

        
                                ?>  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <b>Precautionary Statements: General</b><br>
                                     <?php

                                  for ($b=1; $b < 7; $b++) { 
                                    if($result['pphrase'.$b] != '' || $result['pphrase'.$b] != '')
                                    {

                                    ?>
                                     <?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase'.$b]);
                                    echo "<b>".$result['pphrase'.$b].'</b> - '. $phrasetext['phrasentext']."<br>"; 
                                    ?>
                                <?php

                                    }
                                  }

                                  ?>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <b>Precautionary Statements: Prevention</b><br>
                                   <?php

                                  for ($c=1; $c < 7; $c++) { 
                                    if($result['pphrase_prev'.$c] != '' || $result['pphrase_prev'.$c] != '')
                                    {

                                    ?>
                                    <?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_prev'.$c]);
                                    echo "<b>".$result['pphrase_prev'.$c].'</b> - '. $phrasetext['phrasentext']."<br>"; 
                                    ?>
                                <?php

                                    }
                                  }

                                  ?>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                    <b>Precautionary Statements: Response</b><br>
                                    <?php

                                  for ($d=1; $d < 7; $d++) { 
                                    if($result['pphrase_res'.$d] != '' || $result['pphrase_res'.$d] != '')
                                    {

                                    ?>
                                     <?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_res'.$d]);
                                    echo "<b>".$result['pphrase_res'.$d].'</b> - '. $phrasetext['phrasentext']."<br>"; 
                                    ?>
                                <?php

                                    }
                                  }

                                  ?>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <b>Precautionary Statements: Storage</b> <br>
                                   
                                  <?php

                                  for ($e=1; $e < 7; $e++) { 
                                    if($result['pphrase_storage'.$e] != '' || $result['pphrase_storage'.$e] != '')
                                    {

                                    ?>
                                     <?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_storage'.$e]);
                                    echo "<b>".$result['pphrase_storage'.$e].'</b> - '. $phrasetext['phrasentext']."<br>"; 
                                    ?>
                                <?php

                                    }
                                  }

                                  ?>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                  
                                  <b>Precautionary Statements: Disposal</b><br>
                                   <?php

                                  for ($f=1; $f < 7; $f++) { 
                                    if($result['pphrase_disp'.$f] != '' || $result['pphrase_disp'.$f] != '')
                                    {

                                    ?>
                                     <?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['pphrase_disp'.$f]);
                                    echo "<b>".$result['pphrase_disp'.$f].'</b> - '. $phrasetext['phrasentext']."<br>"; 
                                    ?>
                                <?php
                                    
                                    }
                                  }

                                  ?>
                                  
                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        <!-- GHS LABEL -->
                                <div class="panel l-coral">
                                    <div class="panel-heading" role="tab" id="headingTwo_5">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseTwo_5" aria-expanded="false"
                                                aria-controls="collapseTwo_5">GHS Label <b>(Click Here)</b></a> </h4>
                                    </div>
                                    <div id="collapseTwo_5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_5">
                                        <div class="panel-body"> 
                                            <div class="form-row">
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
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                
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
                        </div>
                        
                        
                    </div>
                </div>

            </div>
        </div>
<!---------------------------------------------------------->


                       <!--<button type="submit" class="btn btn-info" name="submit">Save</button>-->
                
     </form>   
    </div>
</section>

<script type="text/javascript">
    $(".js-example-theme-multiple").select2({
  theme: "classic"
});
    
    function isNumber(evt) {
        debugger;
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode == 46 && evt.srcElement.value.split('.').length>1) {
            return false;
        }
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    
    function chemicalTypeChange(){
        var chemicalType = document.getElementById('chemicalType').value;
        if (chemicalType == "3") {
            document.getElementById("chem-identifiers").style.display = 'none';
            document.getElementById("reachNumberLabel").style.display = 'none';
            document.getElementById("reachNumber").style.display = 'none';
            document.getElementById("unNumber").style.display = 'none';
            document.getElementById("unNumberLabel").style.display = 'none';
        } else {
            document.getElementById("chem-identifiers").style.display = '';
            document.getElementById("reachNumberLabel").style.display = '';
            document.getElementById("reachNumber").style.display = '';
            document.getElementById("unNumber").style.display = '';
            document.getElementById("unNumberLabel").style.display = '';
        }
    }
    

    
    function check_CASNumber() {
        var CASformat = /^[0-9]{2,6}-[0-9]{2}-[0-9]{1}$/;
        
        if(document.getElementById('casNumber').value.match(CASformat)) {
            
        } else {
            alert("Invalid CAS Number.");
            document.getElementById('casNumber').value = '';
            document.getElementById('casNumber').focus();
        }
        
    }
    
    function check_REACHNumber() {
        var reachformat = /^[0-9]{2}-[0-9]{10}-[0-9]{2}-[0-9]{4}$/;
        
        if(document.getElementById('reachNumber').value.match(reachformat)) {
            
        } else {
            alert("Invalid Reach Number.");
            document.getElementById('reachNumber').value = '';
            document.getElementById('reachNumber').focus();
        }
        
    }
    
    function check_UFI(){
        var UFIformat = /^[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}$/;
        if(document.getElementById('ufi').value.match(UFIformat)) {
            
        } else {
            alert("Invalid Unique Formula Identifier.");
            document.getElementById('ufi').value = '';
            document.getElementById('ufi').focus();
        }       
    }
    
    function check_UNNumber() {
        var UNformat = /^[0-9]{4}$/;
        if(document.getElementById('unNumber').value.match(UNformat)) {
            
        } else {
            alert("Invalid UN Number.");
            document.getElementById('unNumber').value = '';
            document.getElementById('unNumber').focus();
        }
    }
    
    function check_ECNumber() {
        var ECformat = /^[0-9]{3}-[0-9]{3}-[0-9]{1}$/;
        
        if (document.getElementById('ecNumber').value.match(ECformat)){
            
        } else {
            alert("Invalid EC Number.");
            document.getElementById('ecNumber').value = '';
            document.getElementById('ecNumber').focus();
        }
    }
    
    function check_Density() {
        var densityValue = document.getElementById('density').value;
        if (densityValue > "30") {
            alert ("Maximum density value is 30.");
            document.getElementById('density').value = '';
            document.getElementById('density').focus;
        } else if (densityValue < "0") {
            alert ("Minimum density value is 0.");
            document.getElementById('density').value = '';
            document.getElementById('density').focus;
        } else {
            
        }
    }
    
    function check_PHRange() {
        var checkbox = document.getElementById('phValueSingle');
        var placeholderModify = document.getElementById('phValueMinInput');
        
        if(checkbox.checked) {
            
            document.getElementById("phValueMin").className = "col-sm-12";
            document.getElementById("phValueMax").style.display = 'none';  
            placeholderModify.placeholder = "pH Value";
        } else {  
            document.getElementById("phValueMax").style.display = '';
            document.getElementById("phValueMin").className = "col-sm-6";
            placeholderModify.placeholder = "Min Value";
        }
        
    }
    
    function check_BPRange(){
        var checkbox = document.getElementById('boilingPointSingle');
        var placeholderModify = document.getElementById('boilingPointMinInput');
        
        if(checkbox.checked) {
            document.getElementById("boilingPointMin").className = "col-sm-8";
            document.getElementById("boilingPointMax").style.display = 'none';
            placeholderModify.placeholder = "Boiling Point";
        } else {
            document.getElementById("boilingPointMin").className = "col-sm-4";
            document.getElementById("boilingPointMax").style.display = '';
            placeholderModify.placeholder = "Min";
        }
    }
    
    function check_MPRange(){
        var checkbox = document.getElementById('meltingPointSingle');
        var placeholderModify = document.getElementById('meltingPointMinInput');
        if(checkbox.checked) {
            document.getElementById("meltingPointMin").className = "col-sm-8";
            document.getElementById("meltingPointMax").style.display = 'none';
            placeholderModify.placeholder = "Melting Point";
        } else {
            document.getElementById("meltingPointMin").className = "col-sm-4";
            document.getElementById("meltingPointMax").style.display = '';
            placeholderModify.placeholder = "Min";
        }
    }
    
</script>
        
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Jquery Validation Plugin Css --> 
<script src="assets/plugins/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/form-validation.js"></script> 

<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> <!-- Select2 Js -->

  <script type="text/javascript">
      
      
  $(document).ready(function() {
    $("#hazardStatements").select2({
        maximumSelectionLength: 6
    });
});


  </script>

<script src="assets/js/pages/forms/advanced-form-elements.js"></script>  

</body>


</html>
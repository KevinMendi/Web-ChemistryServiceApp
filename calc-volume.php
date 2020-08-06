

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

global $answerStr; 
global $g_mass; 
global $g_density; 
global $g_mass_unit; 
global $g_density_unit; 
global $g_volume_unit_text; 
global $g_density_unit_text; 
global $g_volume_result;
global $g_conversion_result;
global $g_conversion_result_unit;
global $g_conversion_result_unit_text;
global $indicator;

if (isset($_POST['calculate']) && $_SERVER["REQUEST_METHOD"] == "POST") {


  $massValue = test_input($_POST["massValue"]);
  $massUnit = test_input($_POST["massUnit"]);
  $densityValue = test_input($_POST["densityValue"]);
  $densityUnit = test_input($_POST["densityUnit"]);




  $result = 0;
  $answer = 0;
  
  $resultUnit = "";
  $result = (int)$massValue / (int)$densityValue;

//mass unit to grams
 //status = good
  $convMass = array(
    "ct"=>0.2, //1 carat = 0.2 g
    "oz"=>28.3495231,// 1 ounce = 28.3495231 g
    "lb"=>453.59237, // 1lb = 453.59237 g
    "t"=>907184.74, // 1short ton = 907 184.74 g
    "mg"=>0.001, // 1mg = 0.001 g
    "g"=>1,
    "kg"=>1000 // 1kg = 1000 g

  );


//conversion of density for Volume (kg/cm3 = g/L)
//status = good
    $convDensityForVolume = array(
    "kg/cm3"=>1000000, // 1kg/cm3 = 1 000 000 g/l
    "kg/m3"=>1, // 1kg/m3 = 1 g/l
    "g/cm3"=>1000,//1g/cm3 = 1000 g/l
    "g/m3"=>0.001,//1g/m3 = 0.001 g/l
    "g/L"=>1,
    "lb/in3"=>27679.9047,//1lb/in3 = 27 679.9047 g/l
    "lb/ft3"=>16.0184634,//1 lb/ft3 = 16.0184634 g/l
    "lb/yd3"=>0.593276,//1 lb/yd3 = 0.593276 g/l
    "lb/gal"=>119.826427,//1 lb/US gal = 119.826427 g/l
    "oz/in3"=>1729.99404,//1 oz/in3 = 1 729.99404 g/l
    "oz/ft3"=>1.00115396,// 1 oz/ft3 = 1.00115396 g/l
    "oz/gal"=>7.48915171,// 1 oz/gal = 7.48915171 g/l
    "ton/yd3"=>1307.873398//1 ton/yd3 = 1307.873398 g/l

);


    $convMassUnit = array(
    "ct"=>"carat",
    "oz"=>"ounce",
    "lb"=>"pound",
    "t"=>"short ton",
    "mg"=>"milligram",
    "g"=>"gram",
    "kg"=>"kilogram"


  );

  $convVolumeUnit = array(
    "in3"=>"cubic inch",
    "yd3"=>"cubic yard",
    "ft3"=>"cubic foot",
    "m3"=>"cubic meter",
    "mm3"=>"cubic millimeter",
    "cm3"=>"cubic centimeter",
    "mi3"=>"cubic mile",
    "km3"=>"cubic kilometer",
    "L"=>"liter",
    "mL"=>"milliliter",
    "qt"=>"quart",
    "gal"=>"gallon"


  );


  $convDensityUnit = array(
    "kg/cm3"=>"kilogram/cubic centimeter",
    "kg/m3"=>"kilogram/cubic meter",
    "g/cm3"=>"gram/cubic centimeter",
    "g/m3"=>"gram/cubic meter",
    "g/L"=>"gram/Liter",
    "lb/in3"=>"pound/cubic inch",
    "lb/ft3"=>"pound/cubic foot",
    "lb/yd3"=>"pound/cubic yard",
    "lb/gal"=>"pound/US gallon",
    "oz/in3"=>"ounce/cubic inch",
    "oz/ft3"=>"ounce/cubic foot",
    "oz/gal"=>"ounce/US gallon",
    "ton/yd3"=>"short ton/cubic yard",
    


  );

 
  



if($massUnit == '0' || $densityUnit == '0')
  {

    $answerStr = "Please provide the unit for Density and Mass"; 
 

  }
  else
  {
  $indicator = 1;
  $g_mass = $massValue;
  $g_density = $densityValue;

  $g_mass_unit_text = $convMassUnit[''.$massUnit];
  $g_density_unit_text = $convDensityUnit[''.$densityUnit];

  $g_mass_unit = $massUnit;
  $g_density_unit = $densityUnit;



$massToGram = $convMass[''.$massUnit];
$convertedMass = $massToGram * (double)$massValue;


$densityToGramPerLiter = $convDensityForVolume[''.$densityUnit];
$convertedDensity = $densityToGramPerLiter * (double)$densityValue;


$resultNumeratorUnit = $convVolumeUnit['L'];
//$resultDenominatorUnit = $convDensityUnit['g/L'];

$answer  = $convertedMass / $convertedDensity;

//
//$removeSciNotation = sprintf('%.10f', floatval($answer));
$removeSciNotation;
      
if (strlen($answer)>6 && strlen($answer)<10)
{
    $removeSciNotation = sprintf('%.10f', floatval($answer));
}else if (strlen($answer)>=10){
    $removeSciNotation = sprintf('%.17f', floatval($answer));
}else if(fmod($answer,1) == 0.0)
{
   $removeSciNotation = $answer;   
}else
{
    $removeSciNotation = sprintf('%.3f', floatval($answer));
}

//

//$answerStr = $answer."   ".$resultNumeratorUnit;
$answerStr = $removeSciNotation."   ".$resultNumeratorUnit;

  }





}

///////////////////
if (isset($_POST['convert']) && $_SERVER["REQUEST_METHOD"] == "POST" ) {

  $indicator = 1;

  $massValue = test_input($_POST["massValue"]);
  $massUnit = test_input($_POST["massUnit"]);
  $densityValue = test_input($_POST["densityValue"]);
  $densityUnit = test_input($_POST["densityUnit"]);




  $result = 0;
  $answer = 0;
  
  $resultUnit = "";
  $result = (int)$massValue / (int)$densityValue;


  $volumeResultConversion = array(
    "in3"=>61.0237441,
    "yd3"=>0.00130795062,
    "ft3"=>0.0353146667,
    "m3"=>0.001,
    "mm3"=>1000000,
    "cm3"=>1000,
    "mi3"=>0.0000000000002399,
    "km3"=>0.0000000000010,
    "L"=>1,
    "mL"=>1000,
    "qt"=>1.05668821,
    "gal"=>0.264172052
  );







//mass unit to grams
 //status = good
  $convMass = array(
    "ct"=>0.2, //1 carat = 0.2 g
    "oz"=>28.3495231,// 1 ounce = 28.3495231 g
    "lb"=>453.59237, // 1lb = 453.59237 g
    "t"=>907184.74, // 1short ton = 907 184.74 g
    "mg"=>0.001, // 1mg = 0.001 g
    "g"=>1,
    "kg"=>1000 // 1kg = 1000 g

  );


//conversion of density for Volume (kg/cm3 = g/L)
//status = good
    $convDensityForVolume = array(
    "kg/cm3"=>1000000, // 1kg/cm3 = 1 000 000 g/l
    "kg/m3"=>1, // 1kg/m3 = 1 g/l
    "g/cm3"=>1000,//1g/cm3 = 1000 g/l
    "g/m3"=>0.001,//1g/m3 = 0.001 g/l
    "g/L"=>1,
    "lb/in3"=>27679.9047,//1lb/in3 = 27 679.9047 g/l
    "lb/ft3"=>16.0184634,//1 lb/ft3 = 16.0184634 g/l
    "lb/yd3"=>0.593276,//1 lb/yd3 = 0.593276 g/l
    "lb/gal"=>119.826427,//1 lb/US gal = 119.826427 g/l
    "oz/in3"=>1729.99404,//1 oz/in3 = 1 729.99404 g/l
    "oz/ft3"=>1.00115396,// 1 oz/ft3 = 1.00115396 g/l
    "oz/gal"=>7.48915171,// 1 oz/gal = 7.48915171 g/l
    "ton/yd3"=>1307.873398//1 ton/yd3 = 1307.873398 g/l

);


    $convMassUnit = array(
    "ct"=>"carat",
    "oz"=>"ounce",
    "lb"=>"pound",
    "t"=>"short ton",
    "mg"=>"milligram",
    "g"=>"gram",
    "kg"=>"kilogram"


  );

  $convVolumeUnit = array(
    "in3"=>"cubic inch",
    "yd3"=>"cubic yard",
    "ft3"=>"cubic foot",
    "m3"=>"cubic meter",
    "mm3"=>"cubic millimeter",
    "cm3"=>"cubic centimeter",
    "mi3"=>"cubic mile",
    "km3"=>"cubic kilometer",
    "L"=>"liter",
    "mL"=>"milliliter",
    "qt"=>"US quart",
    "gal"=>"US gallon"


  );


  $convDensityUnit = array(
    "kg/cm3"=>"kilogram/cubic centimeter",
    "kg/m3"=>"kilogram/cubic meter",
    "g/cm3"=>"gram/cubic centimeter",
    "g/m3"=>"gram/cubic meter",
    "g/L"=>"gram/Liter",
    "lb/in3"=>"pound/cubic inch",
    "lb/ft3"=>"pound/cubic foot",
    "lb/yd3"=>"pound/cubic yard",
    "lb/gal"=>"pound/US gallon",
    "oz/in3"=>"ounce/cubic inch",
    "oz/ft3"=>"ounce/cubic foot",
    "oz/gal"=>"ounce/US gallon",
    "ton/yd3"=>"short ton/cubic yard",
    


  );
///////////////////////////////////////////////////////////////////END
$convertToThisUnit =  test_input($_POST["convertToThisUnit"]);
$volumeResult =  test_input($_POST["volumeResult"]);



  $g_density = $densityValue;
  $g_mass = $massValue;
  $g_density_unit_text = $convDensityUnit[''.$densityUnit];
  $g_mass_unit_text = $convMassUnit[''.$massUnit];
  $g_density_unit = $densityUnit;
  $g_mass_unit = $massUnit;


$massToGram = $convMass[''.$massUnit];
$convertedMass = $massToGram * (int)$massValue;


$densityToGramPerLiter = $convDensityForVolume[''.$densityUnit];
$convertedDensity = $densityToGramPerLiter * (int)$densityValue;


$resultNumeratorUnit = $convVolumeUnit['L'];

$answer  = $convertedMass / $convertedDensity;



$convertVolumeValue = $volumeResultConversion[''.$convertToThisUnit];

$conversionResult = $answer  * $convertVolumeValue;
/// Remove Scientific notation

$removeSciNotation = "";

if (strlen($conversionResult>6)&& strlen($conversionResult<10))
{
    $removeSciNotation = sprintf('%.10f', floatval($conversionResult));
}else if (strlen($conversionResult)>=10)
{
    $removeSciNotation = sprintf('%.17f', floatval($conversionResult));
}else if (fmod($conversionResult,1) == 0.00)
{
    $removeSciNotation = (int)$conversionResult;
}else
{
    $removeSciNotation = sprintf("%.3f", floatval($conversionResult));
}
    
//$removeSciNotation = sprintf('%.10f', floatval($conversionResult));

///



$conversionResultUnit = $convVolumeUnit[''.$convertToThisUnit];

//$answerStr = $conversionResult."   ". $conversionResultUnit;
$answerStr = $removeSciNotation."   ". $conversionResultUnit;


$g_conversion_result_unit = $convertToThisUnit;
$g_conversion_result_unit_text = $convVolumeUnit[''.$convertToThisUnit];



}







?>


<!DOCTYPE html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: ChemPO :: Density Calculator</title>
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
<link rel="stylesheet" href="assets/plugins/select2/select2.css" />

<link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">



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
        <form  method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Density Calculator</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">Density Calculator</li>
                        <li class="breadcrumb-item active">Calculate Volume</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

         <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <h3>How to Use</h3>
                    <p><b>Step 1:</b><br> In the navigation bar, choose a calculation for Density, Mass, or Volume.<br><br>
                    <b>Step 2:</b><br> Provide any two values to the fields below to calculate the unknown.
                     Also, do not forget to select the unit or else it won't work.<br><br>
                    <b>Note:</b> The formula is:<br><br><b> ρ = m / V</b><br><br>
                    Where:<br> 
                    <b>ρ</b> = density<br>
                    <b>m</b> = mass<br>
                     <b>V</b> = Volume <br><br>
                    <b>Step 3:</b><br> Press Calculate button to calculate and show the answer.</p>
                </div>
                <div class="col-md-7">
                    <div class="row clearfix">
                       <div class="card">
                            <div class="header">
                                <h2>Calculator for<strong> Volume</strong></h2>
                           
                            </div>
                            <div class="body">
                                
                                <div class="col-md-12">
                                    <label><b>Answer</b></label>
                                </div>
                                <div class="col-md-12 mb-5">
                                    <input type="text" class="form-control"  name="volumeResult" style="height: 70px;font-size: 17px;" readonly value="<?php echo($answerStr); ?>">
                                </div>
                                <div class="col-md-12 mb-5" style="text-align: center;">
                                    <label>Formula:</label>
                                    <p><b>V = m / p</b></p>
                                </div>
                                <div class="row mt-3 ">
                                    <div class="col-md-2">
                                        <label><b>Mass</b></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" step="any" class="form-control"  name="massValue"  required value="<?php echo($g_mass); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="massUnit" required>
                                        <?php 
                                            if(!empty($g_density_unit_text) && !empty($g_mass_unit_text))
                                            {
                                        ?>
                                            <option selected value="<?php echo($g_mass_unit); ?>" ><?php echo($g_mass_unit_text); ?></option>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                            <option selected value="0" >---Select the Unit---</option>
                                        <?php
                                            }
                                        ?>
                                        <option value="ct">carat</option>
                                        <option value="oz">ounce</option>
                                        <option value="lb">pound</option>
                                        <option value="t">short ton</option>
                                        <option value="mg">milligram</option>
                                        <option value="g">gram</option>
                                        <option value="kg">kilogram</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2" style="padding-top: 10px;">
                                        <label><b>Density</b></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" step="any" class="form-control"  name="densityValue"  required value="<?php echo($g_density); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="densityUnit" required>
                                        <?php 
                                            if(!empty($g_density_unit_text) && !empty($g_mass_unit_text))
                                            {
                                        ?>
                                            <option selected value="<?php echo($g_density_unit); ?>" ><?php echo($g_density_unit_text); ?></option>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                            <option selected value="0" >---Select the Unit---</option>
                                        <?php
                                            }
                                        ?>
                                        
                                        <option value="kg/cm3">kilogram/cubic centimeter</option>
                                        <option value="kg/m3">kilogram/cubic meter</option>
                                        <option value="g/cm3">gram/cubic centimeter</option>
                                        <option value="g/m3">gram/cubic meter</option>
                                        <option value="g/L">gram/Liter</option>
                                        <option value="lb/in3">pound/cubic inch</option>
                                        <option value="lb/ft3">pound/cubic foot</option>
                                        <option value="lb/yd3">pound/cubic yard</option>
                                        <option value="lb/gal">pound/US gallon</option>
                                        <option value="oz/in3">ounce/cubic inch</option>
                                        <option value="oz/ft3">ounce/cubic foot</option>
                                        <option value="oz/gal">ounce/US gallon</option>
                                        <option value="ton/yd3">short ton/cubic yard</option>
                                        </select>
                                    </div>
                                </div>
                          <!--
                                <div class="row mt-5">
                                    <div class="col-md-2">
                                        <label><b>Volume</b></label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control"  name="densityVal"  required >
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="batterCat" required>
                                        <option selected value="densityDefault" >---Select the Unit---</option>
                                        <option value="in3">cubic inch</option>
                                        <option value="yd3">cubic yard</option>
                                        <option value="ft3">cubic foot</option>
                                        <option value="m3">cubic meter</option>
                                        <option value="mm3">cubic millimeter</option>
                                        <option value="cm3">cubic centimeter</option>
                                        <option value="mi3">cubic mile</option>
                                        <option value="km3">cubic kilometer</option>
                                        <option value="L">liter</option>
                                        <option value="mL">milliliter</option>
                                        <option value="qt">quart</option>
                                        <option value="gal">gallon</option>
                                        </select>
                                    </div>
                                </div>
                            -->
                                

                                <div class="row mt-5">
                                    <div class="col-md-4" style="padding-left: 40px; ">
                                        <button class="btn btn-raised btn-success btn-lg waves-effect" type="submit" name="calculate" >Calculate</button>
                                    </div>
                                    <div class="col-md-4" style="padding-left: 40px; ">
                                        <button class="btn btn-raised btn-primary btn-lg waves-effect" type="button" onClick="window.location.href=window.location.href">Clear</button>
                                    </div>
                                    
                                    <div class="col-md-4" style="padding-left: 40px; ">
                                        <a href="index.php"><button class="btn btn-raised btn-warning btn-lg waves-effect" type="button">Cancel</button></a>
                                    </div>
                                    
                                </div><hr>
                                <?php
                                if($indicator === 1)
                                {
                                ?>
                                <div class="col-md-12 mb-5">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <small>Convert the result to</small>
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="convertToThisUnit" required >
                                               <?php 
                                            if(!empty($g_density_unit_text) && !empty($g_mass_unit_text) && !empty($g_conversion_result_unit))
                                            {
                                        ?>
                                            <option selected value="<?php echo($g_conversion_result_unit); ?>" ><?php echo($g_conversion_result_unit_text); ?></option>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                            <option selected value="0" >---Select the Unit---</option>
                                        <?php
                                            }
                                        ?>
                                                <option value="in3">cubic inch</option>
                                                <option value="yd3">cubic yard</option>
                                                <option value="ft3">cubic foot</option>
                                                <option value="m3">cubic meter</option>
                                                <option value="mm3">cubic millimeter</option>
                                                <option value="cm3">cubic centimeter</option>
                                                <option value="mi3">cubic mile</option>
                                                <option value="km3">cubic kilometer</option>
                                                <option value="L">liter</option>
                                                <option value="mL">milliliter</option>
                                                <option value="qt">US quart</option>
                                                <option value="gal">US gallon</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 20px;">
                                            <button class="btn btn-raised btn-success btn-md waves-effect" type="submit" name="convert" >Convert</button>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }

                                ?>
                                
                            </div>
                       </div>
                    </div>
                </div>
                <div class="col-md-4">
                    
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

<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 

<script src="assets/plugins/select2/select2.min.js"></script> <!-- Select2 Js -->



<script src="assets/js/pages/forms/advanced-form-elements.js"></script> 

<script src="assets/plugins/dropify/js/dropify.min.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>


</body>


</html>
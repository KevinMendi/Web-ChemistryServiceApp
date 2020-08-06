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
global $g_volume; 
global $g_density; 
global $g_volume_unit; 
global $g_density_unit; 
global $g_volume_unit_text; 
global $g_density_unit_text;
global $g_mass_result;
global $g_conversion_result;
global $g_conversion_result_unit;
global $g_conversion_result_unit_text; 
global $indicator;

if (isset($_POST['calculate']) && $_SERVER["REQUEST_METHOD"] == "POST") {


  $volumeValue = test_input($_POST["volumeValue"]);
  $volumeUnit = test_input($_POST["volumeUnit"]);
  $densityValue = test_input($_POST["densityValue"]);
  $densityUnit = test_input($_POST["densityUnit"]);




  $result = 0;
  $answer = 0;
  
  $resultUnit = "";
  $result = (int)$volumeValue * (int)$densityValue;



//conversion of volume for mass(volume to cubic meter)
//status = good
  $convVolumeForMass = array(
    "in3"=>0.000016387064, // 1 in3 = 1.6387064 × 10^-5 m3
    "yd3"=>0.764554858,// 1yd3 = 0.764554858 m3
    "ft3"=>0.0283168466,//1 ft3 = 0.0283168466 m3
    "m3"=>1,
    "mm3"=>0.0000000010,// 1mm3 = 1.0 × 10^-9 m3
    "cm3"=>0.0000010,// 1cm3 = 1.0 × 10^-6 m3
    "mi3"=>4168181825,// 1mi3 = 4.16818183 × 10^9 m3
    "km3"=>1000000000,//1km3 = 1000000000 m3
    "L"=>0.001,// 1L = 0.001 m3
    "mL"=>0.0000010,//1mL = 1.0 × 10^-6 m3
    "qt"=>0.000946352946,//1 US quart = 0.000946352946 m3
    "gal"=>0.00378541178 // 1 US gallon = 0.00378541178 m3

);

//conversion of density for mass(density to g/m3)
    $convDensityForMass = array(
    "kg/cm3"=>1000000000,//g
    "kg/m3"=>1000,//g
    "g/cm3"=>1000000,//g
    "g/m3"=>1,
    "g/L"=>1000,//g
    "lb/in3"=>27679904.7,//g
    "lb/ft3"=>16018.4634,//g
    "lb/yd3"=>593.2764212,//g
    "lb/gal"=>119826.427,//g
    "oz/in3"=>1729994.04,//g
    "oz/ft3"=>1001.15396,//g
    "oz/gal"=>7489.15171,//g
    "ton/yd3"=>1186552.8424907//g

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
    "ton/yd3"=>"short ton/cubic yard"


  );

  



if($volumeUnit == '0' || $densityUnit == '0')
  {

    $answerStr = "Please provide the unit for Density and Volume"; 
 

  }
  else
  {

  $indicator = 1;
  $g_volume = $volumeValue;
  $g_density = $densityValue;

  $g_volume_unit_text = $convVolumeUnit[''.$volumeUnit];
  $g_density_unit_text = $convDensityUnit[''.$densityUnit];

  $g_volume_unit = $volumeUnit;
  $g_density_unit = $densityUnit;



$volumeToCubicMeter = $convVolumeForMass[''.$volumeUnit];
$convertedVolume = $volumeToCubicMeter * (double)$volumeValue;


$densityToGramPerCubicMeter = $convDensityForMass[''.$densityUnit];
$convertedDensity = $densityToGramPerCubicMeter * (double)$densityValue;


$resultNumeratorUnit = $convMassUnit['kg'];
//$resultDenominatorUnit = $convVolumeUnit['cm3'];

$answer  = $convertedVolume * $convertedDensity;
$answerToKg = $answer / 1000;//convert to kg

//
//$removeSciNotation = sprintf('%.10f', floatval($answerToKg));
//$removeSciNotation = sprintf('%f', floatval($answerToKg));
      
$removeSciNotation;
      
if (strlen($answerToKg)>6 && strlen($answerToKg) < 10)
{
    //$removeSciNotation = sprintf('%.10f', floatval($answerToKg));
    if (fmod($answerswerToKg, 1) == 0.0)
    {
        //$removeSciNotation = sprintf('%.1f', floatval($answerToKg));
        $shortenedAnswer = rtrim(sprintf('%.17f', floatval($answerToKg)), '0');
        //checks for dots
        if (strpos($shortenedAnswer, ".") !== false)
        {
            $removeSciNotation = str_replace(".", " ", $shortenedAnswer);
        }
    }
    else
    {
        $removeSciNotation = rtrim(sprintf('%.10f', floatval($answerToKg)), '0');
    }
}else if (strlen($answerToKg)>=10)
{
    if (fmod($answerToKg,1) == 0.0)
    {
        //$removeSciNotation = sprintf('%.1f', floatval($answerToKg));
        $shortenedAnswer = rtrim(sprintf('%.17f', floatval($answerToKg)), '0');
        //checks for dots
        if (strpos($shortenedAnswer, ".") !== false)
        {
            $removeSciNotation = str_replace(".", " ", $shortenedAnswer);
        }
    }
    else
    {
    $removeSciNotation = rtrim(sprintf('%.17f', floatval($answerToKg)), '0');
    }
}else if(fmod($answerToKg,1) == 0.0)
{
   $removeSciNotation = $answerToKg;   
}else
{
    $removeSciNotation = sprintf('%.3f', floatval($answerToKg));
}
      
      
//
//echo rtrim(sprintf('%f',floatval(-1.0E-5)),'0');//remove trailing zeros
//$answerStr = $answerToKg."   ".$resultNumeratorUnit;
$answerStr = $removeSciNotation."   ".$resultNumeratorUnit;
  }





}

////////////////////////////////
if (isset($_POST['convert']) && $_SERVER["REQUEST_METHOD"] == "POST") {

$indicator = 1;
  $volumeValue = test_input($_POST["volumeValue"]);
  $volumeUnit = test_input($_POST["volumeUnit"]);
  $densityValue = test_input($_POST["densityValue"]);
  $densityUnit = test_input($_POST["densityUnit"]);




  $result = 0;
  $answer = 0;
  
  $resultUnit = "";
  $result = (int)$volumeValue * (int)$densityValue;

//Result Conversion
  //good
  $massResultConversion = array(
    "ct"=>5000,
    "oz"=>35.2739619,
    "lb"=>2.20462262,
    "t"=>0.00110231131,
    "mg"=>1000000,
    "g"=>1000,
    "kg"=>1


  );



//conversion of volume for mass(volume to cubic meter)
//status = good
  $convVolumeForMass = array(
    "in3"=>0.000016387064, // 1 in3 = 1.6387064 × 10^-5 m3
    "yd3"=>0.764554858,// 1yd3 = 0.764554858 m3
    "ft3"=>0.0283168466,//1 ft3 = 0.0283168466 m3
    "m3"=>1,
    "mm3"=>0.0000000010,// 1mm3 = 1.0 × 10^-9 m3
    "cm3"=>0.0000010,// 1cm3 = 1.0 × 10^-6 m3
    "mi3"=>4168181830,// 1mi3 = 4.16818183 × 10^9 m3
    "km3"=>1000000000,//1km3 = 1000000000 m3
    "L"=>0.001,// 1L = 0.001 m3
    "mL"=>0.0000010,//1mL = 1.0 × 10^-6 m3
    "qt"=>0.000946352946,//1 US quart = 0.000946352946 m3
    "gal"=>0.00378541178 // 1 US gallon = 0.00378541178 m3

);

//conversion of density for mass(density to g/m3)
    $convDensityForMass = array(
    "kg/cm3"=>1000000000,//g
    "kg/m3"=>1000,//g
    "g/cm3"=>1000000,//g
    "g/m3"=>1,
    "g/L"=>1000,//g
    "lb/in3"=>27679904.7,//g
    "lb/ft3"=>16018.4634,//g
    "lb/yd3"=>593.2764212,//g
    "lb/gal"=>119826.427,//g
    "oz/in3"=>1729994.04,//g
    "oz/ft3"=>1001.15396,//g
    "oz/gal"=>7489.15171,//g
    "ton/yd3"=>1186552.8424907//g

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
    "ton/yd3"=>"short ton/cubic yard"


  );


///////////////////////
$convertToThisUnit =  test_input($_POST["convertToThisUnit"]);
$massResult =  test_input($_POST["massResult"]);



  $g_volume = $volumeValue;
  $g_density = $densityValue;

  $g_volume_unit_text = $convVolumeUnit[''.$volumeUnit];
  $g_density_unit_text = $convDensityUnit[''.$densityUnit];

  $g_volume_unit = $volumeUnit;
  $g_density_unit = $densityUnit;





$volumeToCubicMeter = $convVolumeForMass[''.$volumeUnit];
$convertedVolume = $volumeToCubicMeter * (double)$volumeValue;


$densityToGramPerCubicMeter = $convDensityForMass[''.$densityUnit];
$convertedDensity = $densityToGramPerCubicMeter * (double)$densityValue;


$resultNumeratorUnit = $convMassUnit['kg'];
//$resultDenominatorUnit = $convVolumeUnit['cm3'];

$answer  = $convertedVolume * $convertedDensity;
$answerToKg = $answer / 1000;//convert to kg

$answerStr = $answerToKg."   ".$resultNumeratorUnit;




$convertMassValue = $massResultConversion[''.$convertToThisUnit];

$conversionResult = $answerToKg  * $convertMassValue;
$removeSciNotation = "";
/// Remove Scientific notation

//$removeSciNotation = sprintf('%.10f', floatval($conversionResult));

///
    
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



$conversionResultUnit = $convMassUnit[''.$convertToThisUnit];

//$answerStr = $conversionResult."   ". $conversionResultUnit;
$answerStr = $removeSciNotation."   ". $conversionResultUnit;

$g_conversion_result_unit = $convertToThisUnit;
$g_conversion_result_unit_text = $convMassUnit[''.$convertToThisUnit];
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
                        <li class="breadcrumb-item active">Calculate Mass</li>
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
                                <h2>Calculator for<strong> Mass</strong></h2>
                           
                            </div>
                            <div class="body">
                                
                                <div class="col-md-12">
                                    <label><b>Answer</b></label>
                                </div>
                                <div class="col-md-12 mb-5">
                                    <input type="text" class="form-control"  name="massResult" style="height: 70px;font-size: 17px;" readonly value="<?php echo($answerStr); ?>">
                                </div>
                                <div class="col-md-12 mb-5" style="text-align: center;">
                                    <label>Formula:</label>
                                    <p><b>m = V * p</b></p>
                                </div>
                               
                                <div class="row mt-5">
                                    <div class="col-md-2" style="padding-top: 10px;">
                                        <label><b>Density</b></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" step="any" class="form-control"  name="densityValue"  required value="<?php echo($g_density); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="densityUnit" required >
                                        <?php 
                                            if(!empty($g_volume_unit_text) && !empty($g_density_unit_text))
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
                         
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label><b>Volume</b></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" step="any" class="form-control"  name="volumeValue"  required value="<?php echo($g_volume); ?>" >
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="volumeUnit" required>
                                          <?php 
                                            if(!empty($g_volume_unit_text) && !empty($g_density_unit_text))
                                            {
                                        ?>
                                            <option selected value="<?php echo($g_volume_unit); ?>" ><?php echo($g_volume_unit_text); ?></option>
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
                                        <option value="qt">quart</option>
                                        <option value="gal">gallon</option>
                                        </select>
                                    </div>
                                </div>
                                <!--
                                <div class="row mt-3 mb-5">
                                    <div class="col-md-2">
                                        <label><b>Mass</b></label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control"  name="densityVal"  required >
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" name="batterCat" required>
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
                                -->
                                <div class="row mt-5 ,mb-5">
                                    <div class="col-md-4" style="padding-left: 40px; ">
                                        <button class="btn btn-raised btn-success btn-lg waves-effect" type="submit" name="calculate">Calculate</button>
                                    </div>
                                    <div class="col-md-4" style="padding-left: 40px; ">
                                        <button class="btn btn-raised btn-primary btn-lg waves-effect" type="button" onClick="window.location.href=window.location.href">Clear</button>
                                    </div>
                                    
                                    <div class="col-md-4" style="padding-left: 40px; ">
                                        <a href="index.php"><button class="btn btn-raised btn-warning btn-lg waves-effect" type="button">Cancel</button></a>
                                    </div>
                                    
                                </div>
                                <hr>
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
                                            if(!empty($g_volume_unit_text) && !empty($g_density_unit_text) && !empty($g_conversion_result_unit))
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
                              
                                        <option value="ct">carat</option>
                                        <option value="oz">ounce</option>
                                        <option value="lb">pound</option>
                                        <option value="t">short ton</option>
                                        <option value="mg">milligram</option>
                                        <option value="g">gram</option>
                                        <option value="kg">kilogram</option>
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
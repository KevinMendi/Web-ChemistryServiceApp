

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

if (isset($_POST['editChemical'])) {
    $pt = new Chempo();
    $uid  = $_POST['editChemical'];
   
    $result = $pt->readChemicalInfo($uid);

  
       
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}





//Not yet tested !!!!!!!
if(isset($_POST['update-hp-phrases']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
  ///////////////////////////////////////////////
$hPhrases;
if(isset($_POST['hPhrases']))
{
$hPhrases = $_POST['hPhrases'];
}
else
{
  $hPhrases = NULL;
}
///////////////////////////////////////////////////

////////////////////////////////////////////////
$hPhrases1;
if(isset($_POST['hPhrases1']))
{
$hPhrases1 = $_POST['hPhrases1'];
}
else
{
  $hPhrases1 = NULL;
}

///////////////////////////////////////////

$phrasesTableName = "tb_phrases";
$whereClause = "chemical_header_id";

$internalNo = test_input($_POST["internalNo"]);



////////////////////////////////////////////////////
$hphrasesMerge = array();

if((empty($hPhrases1)) && (!empty($hPhrases)))
{
  $hphrasesMerge = $hPhrases;
}
else if((empty($hPhrases)) && (!empty($hPhrases1)))
{
  $hphrasesMerge = $hPhrases1;
}
else if((!empty($hPhrases)) && (!empty($hPhrases1)))
{
  $hphrasesMerge = array_merge($hPhrases,$hPhrases1);
}
else
{
  $hphrasesMerge = NULL;
}
////////////////////////////////////////////////////////////////
  //$hphrasesMerge = array_merge($hPhrases,$hPhrases1);
  //print_r($hphrases);
  //print_r($hPhrases);
  //print_r($hPhrases1);
  //print_r($hphrasesMerge);
 //////////////////////////////////////////////////////////// 
  if(empty($hphrasesMerge))
  {
    $hPhrasesMax = 0;
  }
  else
  {
    $hPhrasesMax = (int)max(array_keys($hphrasesMerge));
  }
////////////////////////////////////////////////////////////////////  
  //echo $indexTemp2;

///////////////////////////

$hprases_fields = [];
  if($hPhrasesMax == 5)
  {
    
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>$hphrasesMerge[3],
            'hphrase5'=>$hphrasesMerge[4],
            'hphrase6'=>$hphrasesMerge[5]

        ];
  }
  else if ($hPhrasesMax == 4)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>$hphrasesMerge[3],
            'hphrase5'=>$hphrasesMerge[4]

        ];
  }
  else if ($hPhrasesMax == 3)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2],
            'hphrase4'=>$hphrasesMerge[3]

        ];
  }
  else if ($hPhrasesMax == 2)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1],
            'hphrase3'=>$hphrasesMerge[2]

        ];
  }
  else if ($hPhrasesMax == 1)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0],
            'hphrase2'=>$hphrasesMerge[1]

        ];
  }
  else if ($hPhrasesMax == 0)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hphrasesMerge[0]

        ];
  }
  else
  {

      $hphrases_fields = [ 
            'hphrase1'=>NULL,
            'hphrase2'=>NULL,
            'hphrase3'=>NULL,
            'hphrase4'=>NULL,
            'hphrase5'=>NULL,
            'hphrase6'=>NULL
            ];
  }
////////////////////////////////////////////////////////////////////END HS
 $fk_field = [        
     'chemical_header_id'=>$internalNo

 ];

$phrases_fields = array_merge($hphrases_fields,$fk_field);
print_r($phrases_fields);

 $ch = new Chempo();
$success = $ch->update($phrases_fields,$internalNo,$phrasesTableName,$whereClause);
if($success == '0')
   {
    echo '<div class="alert alert-warning" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </div>
                                    <strong>Sorry !</strong> There was a problem in updating this chemical.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>';
   } 
   else{
     header("Location:chemicals-list.php");
      echo '<div class="alert alert-success" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-thumb-up"></i>
                                    </div>
                                    <strong>Well done!</strong> Succesfully Updated.
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


<!DOCTYPE html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: Edit Chemical</title>
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
        
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Chemicals</a></li>
                        <li class="breadcrumb-item active">Edit Chemical</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>



        <div class="container-fluid">
          <form id="form_validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>H & P</strong> Phrases</h2>
                           
                        </div>
                        
                     
                      <div class="body">
                        <div class="row clearfix">
                               
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  <input type="text"  name="internalNo" class="form-control" value="<?php echo $result['chemical_header_id']; ?>" hidden>






                                  <small><b>Hazard Statements</b></small>

                                   <select style="height: 100px !important;  border-bottom :none !important;" class="form-control show-tick ms select2" multiple  name="hPhrases[]">
                                     <?php

                                  for ($a=1; $a < 7; $a++) { 
                                    if($result['hphrase'.$a] != '' || $result['hphrase'.$a] != '')
                                    {

                                    ?>
                                     <option value="<?php echo $result['hphrase'.$a]; ?>" selected=""><?php 
                                    $ch = new Chempo();
                                    $phrasetext = $ch->selectPhrasetext($result['hphrase'.$a]);
                                    echo $result['hphrase'.$a].' - '. $phrasetext['phrasentext']; 
                                    ?></option>
                                <?php

                                    }
                                  }

                                  ?>
                                      
                                    </select>
<!--////////////////////////////////////////////////////////-->
                                     <select style="height: 100px !important; border-top: none !important;" class="form-control show-tick ms select2" multiple data-placeholder="Select H Phrases. Click Here" name="hPhrases1[]">

                                         <?php
                                  $ch2 = new Chempo();
                                  $rows1 = $ch2->hphrasesList();
                                   foreach ($rows1 as $row1) 
                                                {

                                  ?>
                                   <option value="<?php echo $row1['h_phrasencode']; ?>"><?php echo $row1['hphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                 
                   
                           
                              
                        
                   
                        </div><br>
                          <button class="btn btn-raised btn-primary btn-block waves-effect" type="submit" name="update-hp-phrases">Update H & P Phrases</button>
                      </div>

                     



                    </div>
                </div>
            </div>
          </form>
        </div>

    
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> <!-- Select2 Js -->


  <script type="text/javascript">
      
      
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
  </script>

<script src="assets/js/pages/forms/advanced-form-elements.js"></script>   
</body>


</html>
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $casNumber = test_input($_POST["casNumber"]);
  $unNumber = test_input($_POST["unNumber"]);
  $chemicalName = test_input($_POST["chemicalName"]);
  $iupacName = test_input($_POST["iupacName"]);
  $commercialName = test_input($_POST["commercialName"]);


  
  $stateOfMatter = test_input($_POST["stateOfMatter"]);
  $density = test_input($_POST["density"]);
  $phValue = test_input($_POST["phValue"]);
  $boilingPoint = test_input($_POST["boilingPoint"]);
  $meltingPoint = test_input($_POST["meltingPoint"]);
  $flashPoint = test_input($_POST["flashPoint"]);
  $refractiveIndex = test_input($_POST["refractiveIndex"]);
  $molecularWeight = test_input($_POST["molecularWeight"]);
  $chemicalType = test_input($_POST["chemicalType"]);

  $signalWord = test_input($_POST["signalWord"]);
  $hPhrases = $_POST["hPhrases"];
  $pPhrases = $_POST["pPhrases"];

  $pPhrases_prev = $_POST["pPhrases_prev"];
  $pPhrases_resp = $_POST["pPhrases_resp"];
  $pPhrases_storage = $_POST["pPhrases_storage"];
  $pPhrases_disp = $_POST["pPhrases_disp"];


 $ecNumber = test_input($_POST['ecNumber']);
 $reachNumber = test_input($_POST['reachNumber']);
 $otherInfos = test_input($_POST['otherInfos']);
 $otherProperties = test_input($_POST['otherProperties']);





  $hPhrasesMax = (int)max(array_keys($hPhrases));
  $pPhrasesMax = (int)max(array_keys($pPhrases));

  $pPhrases_prevMax = (int)max(array_keys($pPhrases_prev));
  $pPhrases_respMax = (int)max(array_keys($pPhrases_resp));
  $pPhrases_storageMax = (int)max(array_keys($pPhrases_storage));
  $pPhrases_dispMax = (int)max(array_keys($pPhrases_disp));





  //$h_p_phrases = $_POST["h_p_phrases"];

  //$hp = explode(";","$hPhrases");
  //$maxHp = (int)max(array_keys($hp)) ;

  //////////////////////////////////////////////////////////////HS
  $hprases_fields = [];
  if($hPhrasesMax == 5)
  {
    
    $hphrases_fields = [        
            'hphrase1'=>$hPhrases[0],
            'hphrase2'=>$hPhrases[1],
            'hphrase3'=>$hPhrases[2],
            'hphrase4'=>$hPhrases[3],
            'hphrase5'=>$hPhrases[4],
            'hphrase6'=>$hPhrases[5]

        ];
  }
  else if ($hPhrasesMax == 4)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hPhrases[0],
            'hphrase2'=>$hPhrases[1],
            'hphrase3'=>$hPhrases[2],
            'hphrase4'=>$hPhrases[3],
            'hphrase5'=>$hPhrases[4]

        ];
  }
  else if ($hPhrasesMax == 3)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hPhrases[0],
            'hphrase2'=>$hPhrases[1],
            'hphrase3'=>$hPhrases[2],
            'hphrase4'=>$hPhrases[3]

        ];
  }
  else if ($hPhrasesMax == 2)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hPhrases[0],
            'hphrase2'=>$hPhrases[1],
            'hphrase3'=>$hPhrases[2]

        ];
  }
  else if ($hPhrasesMax == 1)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hPhrases[0],
            'hphrase2'=>$hPhrases[1]

        ];
  }
  else if ($hPhrasesMax == 0)
  {
    $hphrases_fields = [        
            'hphrase1'=>$hPhrases[0]

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
  //////////
  //$pp = explode(";","$pPhrases");
  //$maxPp = (int)max(array_keys($pp)) ;
////////////////////////////////////////////////////////////////////PS GENERAL
  $pprases_fields = [];
  if($pPhrasesMax == 5)
  {
    
    $pphrases_fields = [        
            'pphrase1'=>$pPhrases[0],
            'pphrase2'=>$pPhrases[1],
            'pphrase3'=>$pPhrases[2],
            'pphrase4'=>$pPhrases[3],
            'pphrase5'=>$pPhrases[4],
            'pphrase6'=>$pPhrases[5]

        ];
  }
  else if ($pPhrasesMax == 4)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pPhrases[0],
            'pphrase2'=>$pPhrases[1],
            'pphrase3'=>$pPhrases[2],
            'pphrase4'=>$pPhrases[3],
            'pphrase5'=>$pPhrases[4]

        ];
  }
  else if ($pPhrasesMax == 3)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pPhrases[0],
            'pphrase2'=>$pPhrases[1],
            'pphrase3'=>$pPhrases[2],
            'pphrase4'=>$pPhrases[3]

        ];
  }
  else if ($pPhrasesMax == 2)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pPhrases[0],
            'pphrase2'=>$pPhrases[1],
            'pphrase3'=>$pPhrases[2]

        ];
  }
  else if ($pPhrasesMax == 1)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pPhrases[0],
            'pphrase2'=>$pPhrases[1]

        ];
  }
  else if ($pPhrasesMax == 0)
  {
    $pphrases_fields = [        
            'pphrase1'=>$pPhrases[0]

        ];
  }
  else
  {
    $pphrases_fields = [ 
            'pphrase1'=>NULL,
            'pphrase2'=>NULL,
            'pphrase3'=>NULL,
            'pphrase4'=>NULL,
            'pphrase5'=>NULL,
            'pphrase6'=>NULL
              ];

  }

////////////////////////////////////////////////////////////////END PS GENERAL

///////////////////////////////////////////////////////////////PS PREVENTION
 $pprases_prev_fields = [];
  if($pPhrases_prevMax == 5)
  {
    
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pPhrases_prev[0],
            'pphrase_prev2'=>$pPhrases_prev[1],
            'pphrase_prev3'=>$pPhrases_prev[2],
            'pphrase_prev4'=>$pPhrases_prev[3],
            'pphrase_prev5'=>$pPhrases_prev[4],
            'pphrase_prev6'=>$pPhrases_prev[5]

        ];
  }
  else if ($pPhrases_prevMax == 4)
  {
    $pprases_prev_fields = [        
            'pphrase_preve1'=>$pPhrases_prev[0],
            'pphrase_prev2'=>$pPhrases_prev[1],
            'pphrase_prev3'=>$pPhrases_prev[2],
            'pphrase_prev4'=>$pPhrases_prev[3],
            'pphrase_prev5'=>$pPhrases_prev[4]

        ];
  }
  else if ($pPhrases_prevMax == 3)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pPhrases_prev[0],
            'pphrase_prev2'=>$pPhrases_prev[1],
            'pphrase_prev3'=>$pPhrases_prev[2],
            'pphrase_prev4'=>$pPhrases_prev[3]

        ];
  }
  else if ($pPhrases_prevMax == 2)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pPhrases_prev[0],
            'pphrase_prev2'=>$pPhrases_prev[1],
            'pphrase_prev3'=>$pPhrases_prev[2]

        ];
  }
  else if ($pPhrases_prevMax == 1)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pPhrases_prev[0],
            'pphrase_prev2'=>$pPhrases_prev[1]

        ];
  }
  else if ($pPhrases_prevMax == 0)
  {
    $pprases_prev_fields = [        
            'pphrase_prev1'=>$pPhrases_prev[0]

        ];
  } 
  else
  {
    $pprases_prev_fields = [ 
            'pphrase_prev1'=>NULL,
            'pphrase_prev2'=>NULL,
            'pphrase_prev3'=>NULL,
            'pphrase_prev4'=>NULL,
            'pphrase_prev5'=>NULL,
            'pphrase_prev6'=>NULL
            ];
  }

///////////////////////////////////////////////////////////////END PS PREVENTION


//////////////////////////////////////////////////////////////PS RESPONSE
    $pprases_resp_fields = [];
  if($pPhrases_respMax == 5)
  {
    
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_resp[0],
            'pphrase_res2'=>$pPhrases_resp[1],
            'pphrase_res3'=>$pPhrases_resp[2],
            'pphrase_res4'=>$pPhrases_resp[3],
            'pphrase_res5'=>$pPhrases_resp[4],
            'pphrase_res6'=>$pPhrases_resp[5]

        ];
  }
  else if ($pPhrases_respMax == 4)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_resp[0],
            'pphrase_res2'=>$pPhrases_resp[1],
            'pphrase_res3'=>$pPhrases_resp[2],
            'pphrase_res4'=>$pPhrases_resp[3],
            'pphrase_res5'=>$pPhrases_resp[4]

        ];
  }
  else if ($pPhrases_respMax == 3)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_resp[0],
            'pphrase_res2'=>$pPhrases_resp[1],
            'pphrase_res3'=>$pPhrases_resp[2],
            'pphrase_res4'=>$pPhrases_resp[3]

        ];
  }
  else if ($pPhrases_respMax == 2)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_resp[0],
            'pphrase_res2'=>$pPhrases_resp[1],
            'pphrase_res3'=>$pPhrases_resp[2]

        ];
  }
  else if ($pPhrases_respMax == 1)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_resp[0],
            'pphrase_res2'=>$pPhrases_resp[1]

        ];
  }
  else if ($pPhrases_respMax == 0)
  {
    $pprases_resp_fields = [        
            'pphrase_res1'=>$pPhrases_resp[0]

        ];
  } 
  else
  {
    $pprases_resp_fields = [ 
            'pphrase_res1'=>NULL,
            'pphrase_res2'=>NULL,
            'pphrase_res3'=>NULL,
            'pphrase_res4'=>NULL,
            'pphrase_res5'=>NULL,
            'pphrase_res6'=>NULL
            ];
  }

//////////////////////////////////////////////////////////////END PS RESPONSE

//////////////////////////////////////////////////////////////PS STORAGE
    $pprases_storage_fields = [];
  if($pPhrases_storageMax == 5)
  {
    
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storage[0],
            'pphrase_storage2'=>$pPhrases_storage[1],
            'pphrase_storage3'=>$pPhrases_storage[2],
            'pphrase_storage4'=>$pPhrases_storage[3],
            'pphrase_storage5'=>$pPhrases_storage[4],
            'pphrase_storage6'=>$pPhrases_storage[5]

        ];
  }
  else if ($pPhrases_storageMax == 4)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storage[0],
            'pphrase_storage2'=>$pPhrases_storage[1],
            'pphrase_storage3'=>$pPhrases_storage[2],
            'pphrase_storage4'=>$pPhrases_storage[3],
            'pphrase_storage5'=>$pPhrases_storage[4]

        ];
  }
  else if ($pPhrases_storageMax == 3)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storage[0],
            'pphrase_storage2'=>$pPhrases_storage[1],
            'pphrase_storage3'=>$pPhrases_storage[2],
            'pphrase_storage4'=>$pPhrases_storage[3]

        ];
  }
  else if ($pPhrases_storageMax == 2)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storage[0],
            'pphrase_storage2'=>$pPhrases_storage[1],
            'pphrase_storage3'=>$pPhrases_storage[2]

        ];
  }
  else if ($pPhrases_storageMax == 1)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storage[0],
            'pphrase_storage2'=>$pPhrases_storage[1]

        ];
  }
  else if ($pPhrases_storageMax == 0)
  {
    $pprases_storage_fields = [        
            'pphrase_storage1'=>$pPhrases_storage[0]

        ];
  }
  else
  {
    $pprases_storage_fields = [ 
            'pphrase_storage1'=>NULL,
            'pphrase_storage2'=>NULL,
            'pphrase_storage3'=>NULL,
            'pphrase_storage4'=>NULL,
            'pphrase_storage5'=>NULL,
            'pphrase_storage6'=>NULL
             ];
  } 

/////////////////////////////////////////////////////////////END PS STORAGE

/////////////////////////////////////////////////////////////PS DISPOSAL
  $pprases_disp_fields = [];
  if($pPhrases_dispMax == 5)
  {
    
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_disp[0],
            'pphrase_disp2'=>$pPhrases_disp[1],
            'pphrase_disp3'=>$pPhrases_disp[2],
            'pphrase_disp4'=>$pPhrases_disp[3],
            'pphrase_disp5'=>$pPhrases_disp[4],
            'pphrase_disp6'=>$pPhrases_disp[5]

        ];
  }
  else if ($pPhrases_dispMax == 4)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_disp[0],
            'pphrase_disp2'=>$pPhrases_disp[1],
            'pphrase_disp3'=>$pPhrases_disp[2],
            'pphrase_disp4'=>$pPhrases_disp[3],
            'pphrase_disp5'=>$pPhrases_disp[4]

        ];
  }
  else if ($pPhrases_dispMax == 3)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_disp[0],
            'pphrase_disp2'=>$pPhrases_disp[1],
            'pphrase_disp3'=>$pPhrases_disp[2],
            'pphrase_disp4'=>$pPhrases_disp[3]

        ];
  }
  else if ($pPhrases_dispMax == 2)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_disp[0],
            'pphrase_disp2'=>$pPhrases_disp[1],
            'pphrase_disp3'=>$pPhrases_storage[2]

        ];
  }
  else if ($pPhrases_dispMax == 1)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_storage[0],
            'pphrase_disp2'=>$pPhrases_storage[1]

        ];
  }
  else if ($pPhrases_dispMax == 0)
  {
    $pprases_disp_fields = [        
            'pphrase_disp1'=>$pPhrases_storage[0]

        ];
  }
  else{
    $pprases_disp_fields = [ 
            'pphrase_disp1'=>NULL,
            'pphrase_disp2'=>NULL,
            'pphrase_disp3'=>NULL,
            'pphrase_disp4'=>NULL,
            'pphrase_disp5'=>NULL,
            'pphrase_disp6'=>NULL
               ];
  } 
/////////////////////////////////////////////////////////////END PS DISPOSAL

 



  $ghs1 = (int)test_input($_POST["ghs1"]);
  $ghs2 = (int)test_input($_POST["ghs2"]);
  $ghs3 = (int)test_input($_POST["ghs3"]);
  $ghs4 = (int)test_input($_POST["ghs4"]);
  $ghs5 = (int)test_input($_POST["ghs5"]);
  $ghs6 = (int)test_input($_POST["ghs6"]);
  $ghs7 = (int)test_input($_POST["ghs7"]);
  $ghs8 = (int)test_input($_POST["ghs8"]);
  $ghs9 = (int)test_input($_POST["ghs9"]);

if($stateOfMatter == '0')
{
    $stateOfMatter = "";
}
else
{
    $stateOfMatter = $stateOfMatter;
}

if($chemicalType == '0')
{
    $chemicalType = "";
}
else
{
    $chemicalType = $chemicalType;
}
  /*
  $ghs = $_POST["ghs"];

  $ghsTemp = (int)$ghs;

  $temp = 'wala pa';

  $length = $ghsTemp;
  if ($length === 1)
  {
    $ghs = $ghs;
  }
  else
  {
    $ghs = implode(", ", $ghs);
  }
*/
 
  $propertiesTableName = "tb_chemical_properties";
  $phrasesTableName = "tb_phrases";
  $ghsTableName = "tb_ghs_label_temp";

  $user_id_session = $_SESSION['user_id'];
   $header_fields = [   
            'cas_no'=>$casNumber,
            'un_no'=>$unNumber,
            'ec_number'=>$ecNumber,
            'reach_number'=>$reachNumber,
            'begin_of_pname'=>$chemicalName,
            'iupac_name'=>$iupacName,
            'commercial_name'=>$commercialName,
            'other_infos'=>$otherInfos,
            'user_id'=>$user_id_session

        ];


        
       $ch = new Chempo();
       $internalNo = $ch->insertHeader($header_fields);

       if ($internalNo == '0')
       {
        echo "error!!!!!!!!!!!!!!!!!!!!!";

       }
       else
       {

        $properties_fields = [   
            'state_of_matter'=>$stateOfMatter,
            'density'=>$density,
            'ph_value'=>$phValue,
            'boiling_point'=>$boilingPoint,
            'melting_point'=>$meltingPoint,
            'flash_point'=>$flashPoint,
            'refractive_index'=>$refractiveIndex,
            'molecular_weight'=>$molecularWeight,
            'chemical_type'=>$chemicalType,
            'other_properties'=>$otherProperties,
            'chemical_header_id'=>$internalNo

        ];

        $ghs_fields = [ 
            'signal_word'=>$signalWord,       
            'ghs1'=>$ghs1,
            'ghs2'=>$ghs2,
            'ghs3'=>$ghs3,
            'ghs4'=>$ghs4,
            'ghs5'=>$ghs5,
            'ghs6'=>$ghs6,
            'ghs7'=>$ghs7,
            'ghs8'=>$ghs8,
            'ghs9'=>$ghs9,
            'chemical_header_id'=>$internalNo

        ];
         $fk_field = [        
            'chemical_header_id'=>$internalNo

        ];

       //$phrases_fields = array_merge($hphrases_fields,$pphrases_fields,$fk_field);
       $phrases_fields = array_merge($hphrases_fields,$pphrases_fields,$pprases_prev_fields,$pprases_resp_fields,$pprases_storage_fields,$pprases_disp_fields,$fk_field);

       $success = $ch->insert($properties_fields,$propertiesTableName);
       if($success === 1)
       {
          $success = $ch->insert($phrases_fields,$phrasesTableName);
          if($success === 1)
          {
            $success = $ch->insert($ghs_fields,$ghsTableName);
            if($success === 1)
            {
              header('Location: chemicals-list.php');
            }
          }
       }
       
  

   
       



       }

}



?>


<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">

<title>:: ChemPO :: Add Chemical</title>
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
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Chemicals</a></li>
                        <li class="breadcrumb-item active">Add Chemical</li>
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
                                
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="CAS Number" name="casNumber" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="UN Number" name="unNumber" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="EC Number" name="ecNumber" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="REACH Number" name="reachNumber" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Chemical Name" name="chemicalName" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="IUPAC Name" name="iupacName" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Commercial Name" name="commercialName" >
                                </div>
                                
                                <!--
                                <button class="btn btn-raised btn-primary waves-effect" name="submit-header" type="submit">SUBMIT</button>-->
                                <div class="try">
                                    
                                
                               
                                </div>
                            
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
                            <h2><strong>Other Informations</strong></h2>
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
                                  <div class="form-group">
                                    <label for="other-info"><b>Other Informations</b></label>
                                    <p>Example: Chemical Description, df5, Systematic Names, Formula and etc.</p>
                                    <textarea class="form-control" rows="7" id="other-info" name="otherInfos"></textarea>
                                  </div>
                                    
                                   
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
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
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="stateOfMatter">
                                        <option value="0" selected="">Please Select</option>
                                        <option value="1">Not Applicable</option>
                                        <option value="2">Solid</option>
                                        <option value="3">Liquid</option>
                                        <option value="4">Gas</option>
                                        <option value="5">Plasma</option>
                                    </select>
                                </div>
                            
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Density" name="density" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="PH Value" name="phValue" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Boiling Point" name="boilingPoint" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Melting Point" name="meltingPoint" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Flash Point" name="flashPoint" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Refractive Index" name="refractiveIndex" >
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Molecular Weight" name="molecularWeight" >
                                </div>
                                <div class=" form-group form-float">
                                    
                                    <small>Chemical Type</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="chemicalType">
                                        <option value="0" selected>Please Select</option>
                                        <option value="1">No Data Available</option>
                                        <option value="2">Mixture</option>
                                        <option value="3">Pure Substance</option>
                                        
                                    </select>
                                </div>
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
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
                            <h2>Other  <strong>Chemical Properties</strong></h2>
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
                                  <div class="form-group">
                                    <label for="other-properties"><b>Other Information</b></label>
                                    <p>Example: Temperature, Pressure, Concentration and etc.</p>
                                    <textarea class="form-control" rows="7" id="other-properties" name="otherProperties"></textarea>
                                  </div>
                                    
                                   
                                
                                <!--<button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
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
                        <!--
                        <div class="body">
                           
                           
                                <div class=" form-group form-float">
                                <small>Signal Word</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="signalWord">
                                        <option value="W">Warning</option>
                                        <option value="D">Danger</option>
                                       
                                        
                                    </select>
                                </div>
                               
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="ex. H201;H332;H400" name="hPhrases" >
                                    <small>Enter up to six GHS H-Phrase codes separated by semi-colon (;). The corresponding Phrases will be detected automatically and printed in the selected language.</small>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="ex. P260;P264" name="pPhrases" >
                                    <small>Enter up to six GHS P-Phrase codes separated by  semi-colon (;). The corresponding Phrases will be detected automatically and printed in the selected language.</small>
                                </div>
                          
                            
                        </div>
                      -->
                     
                      <div class="body">
                        <div class="row clearfix">
                                <div class="col-lg-12 col-sm-12 mb-1">
                        <div class=" form-group form-float">
                                <small><b>Signal Word</b></small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="signalWord">
                                        <option value="W">Warning</option>
                                        <option value="D">Danger</option>
                                       
                                        
                                    </select>
                                </div>
                              </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small><b>Hazard Statements</b></small>
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Select H Phrases. Click Here" name="hPhrases[]">
                                         <?php
                                  $ch = new Chempo();
                                  $rows = $ch->hphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['h_phrasencode']; ?>"><?php echo $row['hphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>General</b> </small>
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases[]">
                                         <?php
                            //      $ch = new Chempo();
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Prevention</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_prev[]">
                                         <?php
                           //       $ch = new Chempo();
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Response<b></small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_resp[]">
                                         <?php
                         //         $ch = new Chempo();
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small>Precautionary Statements: <b>Storage</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_storage[]">
                                         <?php
                       //           $ch = new Chempo();
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                  
                                  <small>Precautionary Statements: <b>Disposal</b> </small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_disp[]">
                                         <?php
                       //           $ch = new Chempo();
                                  $rows = $ch->pphrasesList();
                                   foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php echo $row['p_phrasencode']; ?>"><?php echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                    </select>
                                  
                                </div>
                        
                        
                           <!--
                            <select id="optgroup" class="ms" multiple="multiple"  name="h_p_phrases[]">
                                <optgroup label="H Phrases">
                                  <?php
                                  //$ch = new Chempo();
                                  //$rows = $ch->hphrasesList();
                                   //foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php //echo $row['h_phrasencode']; ?>"><?php// echo $row['hphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>

                                </optgroup>
                                <optgroup label="P Phrases">
                                    <?php
                                  //$ch = new Chempo();
                                  //$rows = $ch->pphrasesList();
                                  // foreach ($rows as $row) 
                                                {

                                  ?>
                                   <option value="<?php //echo $row['p_phrasencode']; ?>"><?php //echo $row['pphrase']; ?></option>

                                   <?php 
                                    }
                                   ?>
                                </optgroup>
                               
                              
                            </select>
                            -->
                        </div>
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
                            
                                <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS01.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs1">
                                        <label for="checkbox"><b>GHS01</b></label>
                                        <h5>Exploding bomb</h5>
                                        <p>Danger Unstable<br>Explosive</p>
                                    </div>
                              
                                </div>
                                

                                
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS02.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs2">
                                        <label for="checkbox"><b>GHS02</b></label>
                                        <h5>Flame</h5>
                                     <p>Danger or Warning<br>Flammable</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS03.jpg">
                                </div>
                               
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs3">
                                        <label for="checkbox"><b>GHS03</b></label>
                                        <h5>Flame over circle</h5>
                                     <p>Danger or Warning<br>Oxidising</p>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS04.jpg">
                                </div>
                                
                                  <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs4">
                                        <label for="checkbox"><b>GHS04</b></label>
                                        <h5>Gas cylinder</h5>
                                     <p>Warning<br>Compressed Gas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS05.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5">
                                        <label for="checkbox"><b>GHS05</b></label>
                                        <h5>Corrosion</h5>
                                     <p>Danger or Warning<br>Corrosive cat. 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS06.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6">
                                        <label for="checkbox"><b>GHS06</b></label>
                                        <h5>Skull and crossbones</h5>
                                     <p>Danger<br>Toxic cat. 1 - 3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS07.jpg">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs7">
                                        <label for="checkbox"><b>GHS07</b></label>
                                        <h5>Exclamation Mark</h5>
                                     <p>Warning<br>Toxic cat. 4<br>Irritant cat. 2 or 3<br>Lower systematic health hazzards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS08.jpg">
                                </div>
                                

                                <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs8">
                                        <label for="checkbox"><b>GHS08</b></label>
                                        <h5>Health hazard</h5>
                                     <p>Danger or Warning<br>Systematic health hazard</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <img src="img/GHS09.jpg">
                                </div>
                               
                                 <div class="form-group col-md-6">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs9">
                                        <label for="checkbox"><b>GHS09</b></label>
                                        <h5>Environment</h5>
                                     <p>Warning (for cat. 1)<br>(for cat. 2 no signal word)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>  
                                
                                
                               <!-- <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!--<button type="submit" class="btn btn-info" name="submit">Save</button>-->
                <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
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

</body>


</html>
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

if(isset($_POST['density']) && $_POST['density'] !== "") {
    $densityValue = test_input($_POST["density"]);
    $densityUnit = test_input($_POST["densityUnit"]);
    $density = $densityValue." ".$densityUnit;
} else {
    $density = "";
}
  
    
    
 if (isset($_POST['phValueSingle']) && $_POST['phValueMin'] !== "") {
     $phValue = test_input($_POST["phValueMin"]); 
 } elseif ($_POST['phValueMax'] !== "") {
     $phValueMin = test_input($_POST['phValueMin']);
     $phValueMax = test_input($_POST['phValueMax']);
     $phValue = $phValueMin."-".$phValueMax;
 } else {
     $phValue = "";
 }
    
  
if (isset($_POST['boilingPointSingle']) && $_POST["boilingPointMin"] !== "") {
    $boilingPointValue = test_input($_POST["boilingPointMin"]);
    $boilingPointUnit = test_input($_POST["boilingPointUnit"]);
    $boilingPoint = $boilingPointValue." ".$boilingPointUnit;
} elseif ($_POST["boilingPointMax"] !== "") {
    $boilingPointMin = test_input($_POST["boilingPointMin"]);
    $boilingPointMax = test_input($_POST["boilingPointMax"]);
    $boilingPointUnit = test_input($_POST["boilingPointUnit"]);
    $boilingPoint = $boilingPointMin."-".$boilingPointMax." ".$boilingPointUnit;
} else {
    $boilingPoint = "";
}
    
if (isset($_POST['meltingPointSingle']) && $_POST['meltingPointMin'] !== "") {
    $meltingPointValue = test_input($_POST["meltingPointMin"]);
    $meltingPointUnit = test_input($_POST["meltingPointUnit"]);
    $meltingPoint = $meltingPointValue." ".$meltingPointUnit;
} elseif ($_POST["meltingPointMax"] !== "") {
    $meltingPointMin = test_input($_POST["meltingPointMin"]);
    $meltingPointMax = test_input($_POST["meltingPointMax"]);
    $meltingPointUnit = test_input($_POST["meltingPointUnit"]);
    $meltingPoint = $meltingPointMin."-".$meltingPointMax." ".$meltingPointUnit;
} else {
    $meltingPoint = "";
}

  if(isset($_POST["flashPoint"]) && $_POST["flashPoint"] !== "") {
    $flashPointValue = test_input($_POST["flashPoint"]);
    $flashPointUnit = test_input($_POST["flashpointUnit"]);
    $flashPoint = $flashPointValue." ".$flashPointUnit;  
  } else {
    $flashPoint = "";
  }

  if(isset($_POST["refractiveIndex"]) && $_POST["refractiveIndex"] !== "") {
      $refractiveIndex = test_input($_POST["refractiveIndex"]);
  } else {
      $refractiveIndex = "";
  }
  
  if(isset($_POST["molecularWeight"]) && $_POST["molecularWeight"] !== "") {
      $molecularWeightValue = test_input($_POST["molecularWeight"]);
      $molecularWeightUnit = test_input($_POST["molecularWeightUnit"]);
      $molecularWeight = $molecularWeightValue." ".$molecularWeightUnit;
  }else {
      $molecularWeight = "";
  }

    
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
 $ufi = test_input($_POST['ufi']);
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
            'ufi'=>$ufi,
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
    <div class="body_scroll">
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!-- <form  action="" method="post"> -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Chemical</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://chemistryservice.rimpido.com"><i class="zmdi zmdi-home"></i> ChemPO</a></li>
                        <li class="breadcrumb-item active">Chemicals</li>
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
                    <button class="btn btn-raised btn-primary waves-effect" type="submit" style="float:right">SUBMIT DATA</button>
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                                <div class="row clearfix">
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">  
                                    <small for="chemicalname">Chemical Name/Commercial Name:* </small>
                                    <input type="text" class="form-control" placeholder="Chemical Name" name="chemicalName" required>
                                    </div>
                                    <div class="form-group">  
                                    <small>Chemical Type:*</small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="chemicalType" id="chemicalType" onchange='chemicalTypeChange();' placeholder="Please Select">
                                        <option value="1">Substance</option>
                                        <option value="2">Substance under REACH but Mixture</option>
                                        <option value="3">Mixture</option>
                                    </select>
                                    </div>
                                    <br>
                                    <div class="col-sm-12" id="title" style="margin-left:-15px">
                                        <label for="chem-identifiers"><b>Chemical Identifiers</b></label>
                                    </div>
                                    <div class="row clearfix" id="chem-identifiers">
                                        
                                        
                                        <div class="col-sm-4">
                                        <small for="casNumber" id="casNumberLabel">CAS Number</small>
                                        <input type="text" class="form-control" placeholder="e.g. 12002-61-8" name="casNumber" id="casNumber" onchange='check_CASNumber();'>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                        <small for="ecNumber" id="ecNumberLabel">EC Number</small>
                                        <input type="text" class="form-control" placeholder="234-417-6" name="ecNumber" id="ecNumber" onchange='check_ECNumber();'>
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="iupacName" id="iupacNameLabel">IUPAC Name:</small>
                                        <input type="text" class="form-control" placeholder="e.g. ACTINIUM(III) OXIDE" name="iupacName" id="iupacName">
                                        </div>
                                    </div>
                                    
                                        
                                    <div class="row clearfix" id="chem-identifiers2">
                                        <div class="col-sm-4">
                                        <small for="ufi" id="ufiLabel">UFI:</small>
                                        <input type="text" class="form-control" placeholder="e.g. 09AZ-10BC-29FG-89TG" name="ufi" id="ufi" onchange='check_UFI();'>
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="unNumber" id="unNumberLabel">UN Number</small>
                                        <input type="text" class="form-control" placeholder="e.g. 4567" name="unNumber" id="unNumber" onchange='check_UNNumber();'>
                                        </div>
                                        <div class="col-sm-4">
                                        <small for="reachNumber" id="reachNumberLabel">REACH Number</small>
                                        <input type="text" class="form-control" placeholder="e.g. 05-2114087395-52-0000" name="reachNumber" id="reachNumber" onchange='check_REACHNumber();'>
                                        </div>
                                    </div>
                                   
                                    
                                    <br>
                                    <div class="row clearfix" id="chem-characteristics">
                                    <div class="col-sm-12">
                                        <label for="chem-identifiers"><b>Chemical Characteristics</b></label>
                                    </div>
                                    <div class="col-sm-6">
                                     State of Matter
                                    <select class ="form-control show-tick ms select2" data-placeholder="Select" name="stateOfMatter" style="width: 50%" placeholder="Select">
                                        <option value="1">Not Applicable</option>
                                        <option value="2">Solid</option>
                                        <option value="3">Liquid</option>
                                        <option value="4">Gas</option>
                                        <option value="5">Plasma</option>
                                    </select>
                                    Density
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                             
                                            <input type="text" class="form-control" placeholder="Density" name="density" min="0" max="30" onchange='check_Density();' onkeypress="return isNumber(event)">
                                        </div>
                                        
                                        <div class="col-sm-6" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="densityUnit" id="densityUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <option value="g/cm3">g/cm3</option>
                                            <option value="g/m3">g/m3</option>
                                            <option value="g/l">g/l</option>
                                            <option value="kg/m3">kg/m3</option>
                                            <option value="kg/l">kg/l</option>
                                            <option value="kg/cm3">oz (av.)/ft3</option>
                                            <option value="lbm/in3">lbm/in3</option>
                                            <option value="lbm/ft3">lbm/ft3</option>
                                            <option value="lbm/yd3">lbm/yd3</option>
                                            <option value="lbm/gal (US, liq.)">lbm/gal (US, liq.)</option>
                                            <option value="oz/in3">oz/in3</option>
                                            <option value="lbm/ft3">lbm/ft3</option>
                                        </select>
                                        </div>
                                    </div>   
                                    PH Value/Range  
                                        <br> 
                                        <input type="checkbox" name="phValueSingle" id="phValueSingle" onclick='check_PHRange();' value="1">
                                        <small>check if PH Value is not in range</small>
                                    <div class="row clearfix">
                                        <div class="col-sm-6" id="phValueMin">
                                            <input type="text" class="form-control" placeholder="Min Value" name="phValueMin" id="phValueMinInput" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="col-sm-6" id="phValueMax">
                                            <input type="text" class="form-control" placeholder="Max Value" name="phValueMax" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    Boiling Point/Range
                                    <br> 
                                        <input type="checkbox" name="boilingPointSingle" id="boilingPointSingle" onclick="check_BPRange();" value="1">
                                        <small>check if Boiling Point is not in range</small>
                                    <div class="row clearfix">
                                        
                                        <div class="col-sm-4" id="boilingPointMin">       
                                            <input type="text" class="form-control" placeholder="Min" name="boilingPointMin" id="boilingPointMinInput" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="col-sm-4" id="boilingPointMax">
                                            <input type="text" class="form-control" placeholder="Max" name="boilingPointMax" onkeypress="return isNumber(event)">
                                        </div>
                                        
                                        <div class="col-sm-4" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="boilingPointUnit" id="boilingPointUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <option value="°C">°C</option>
                                            <option value="°F">°F</option>
                                            <option value="K">K</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    Melting Point/Range
                                    <br> 
                                        <input type="checkbox" name="meltingPointSingle" id="meltingPointSingle" onclick="check_MPRange();" value="1">
                                        <small>check if Melting Point is not in range</small>
                                    <div class="row clearfix">
                                        <div class="col-sm-4" id="meltingPointMin">
                                            <input type="text" class="form-control" placeholder="Min" name="meltingPointMax" id="meltingPointMinInput" onkeypress="return isNumber(event)"> 
                                        </div>
                                        <div class="col-sm-4" id="meltingPointMax">
                                            <input type="text" class="form-control" placeholder="Max" name="meltingPointMax" id="meltingPointMin" onkeypress="return isNumber(event)"> 
                                        </div>
                                        
                                        <div class="col-sm-4" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="meltingPointUnit" id="meltingPointUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <option value="°C">°C</option>
                                            <option value="°F">°F</option>
                                            <option value="K">K</option>
                                        </select>
                                        </div>
                                    </div> 
                                    Flash Point
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Flash Point" name="flashPoint" onkeypress="return isNumber(event)">
                                        </div>
                                        
                                        <div class="col-sm-4" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="flashPointUnit" id="flashPointUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <option value="°C">°C</option>
                                            <option value="°F">°F</option>
                                            <option value="K">K</option>
                                        </select>
                                        </div>
                                    </div> 
                                    Refractive Index
                                    <input type="text" class="form-control" placeholder="Refractive Index" name="refractiveIndex" onkeypress="return isNumber(event)">
                                    Molecular Weight
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            
                                            <input type="text" class="form-control" placeholder="Molecular Weight" name="molecularWeight" id="molecularWeight" onkeypress="return isNumber(event)">
                                        </div>
                                        
                                        <div class="col-sm-6" id="density">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="molecularWeightUnit" id="molecularWeightUnit" placeholder="Please Select" STYLE="height: 500px !important">
                                            <option value="g/mol">g/mol</option>
                                            <option value="kg/mol">kg/mol</option>
                                        </select>
                                        </div>
                                    </div> 
                                </div>
                                </div>
                                </div>
 
                                
                                <div class="col-sm-6">
                            
        <!-- H AND P PHRASES COLLAPSED -->
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-sm-12 mb-1">
                        <div class=" form-group form-float">
                                <small><b>Signal Word</b></small>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="signalWord">
                                        <option value="W">Warning</option>
                                        <option value="D">Danger</option>
                                       
                                        
                                    </select>
                                </div>
                              </div>
                            <div class="panel-group full-body" id="accordion_5" role="tablist" aria-multiselectable="true">
                                <div class="panel l-coral">
                                    <div class="panel-heading" role="tab" id="headingOne_5">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseOne_5" aria-expanded="true" aria-controls="collapseOne_5"> Add H and P Phrases <b>(Click Here)</b> </a> </h4>
                                    </div>
                                    <div id="collapseOne_5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_5">
                                        <div class="panel-body">
                                               <div class="panel-body">
                                <div class="col-lg-12 col-sm-12 mb-4">
                                  
                                  <small><b>Hazard Statements</b></small>
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select H Phrases. Click Here" name="hPhrases[]">
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
                                   <select style="height: 100px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases[]">
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
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_prev[]">
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
                                  
                                    <small>Precautionary Statements: <b>Response</b></small>
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_resp[]">
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
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_storage[]">
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
                                   <select style="height: 50px !important ;" class="form-control show-tick ms select2" data-maximum-selection-length="6" multiple data-placeholder="Select P Phrases. Click Here" name="pPhrases_disp[]">
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
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        <!-- GHS LABEL -->
                                <div class="panel l-coral">
                                    <div class="panel-heading" role="tab" id="headingTwo_5">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseTwo_5" aria-expanded="false"
                                                aria-controls="collapseTwo_5">Add GHS Label <b>(Click Here)</b></a> </h4>
                                    </div>
                                    <div id="collapseTwo_5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_5">
                                        <div class="panel-body"> 
                                            <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS01.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs1">
                                        <label for="checkbox"><b>GHS01</b></label>
                                        <h6>Exploding bomb</h6>
                                        <p>Danger Unstable<br><b>Explosive</b></p>
                                    </div>
                              
                                </div>                              
                                <div class="form-group col-md-3">
                                    <img src="img/GHS02.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs2">
                                        <label for="checkbox"><b>GHS02</b></label>
                                        <h6>Flame</h6>
                                        <p>Danger or Warning<br><b>Flammable</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS03.png"  width="120px" height="120px">
                                </div>
                               
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs3" width="120px" height="120px">
                                        <label for="checkbox"><b>GHS03</b></label>
                                        <h6>Flame over circle</h6>
                                        <p>Danger or Warning<br><b>Oxidising</b></p>
                                    </div>
                                </div>                             
                                <div class="form-group col-md-3">
                                    <img src="img/GHS04.png" width="120px" height="120px">
                                </div>
                                
                                  <div class="form-group col-md-3"  width="120px" height="120px">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs4">
                                        <label for="checkbox"><b>GHS04</b></label>
                                        <h6>Gas cylinder</h6>
                                        <p>Warning<br><b>Compressed Gas</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS05.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5">
                                        <label for="checkbox"><b>GHS05</b></label>
                                        <h6>Corrosion</h6>
                                        <p>Danger or Warning<br><b>Corrosive cat.</b> 1</p>
                                    </div>
                                </div>                           
                                <div class="form-group col-md-3">
                                    <img src="img/GHS06.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3" width="120px" height="120px">
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6">
                                        <label for="checkbox"><b>GHS06</b></label>
                                        <h6>Skull and crossbones</h6>
                                        <p>Danger<br><b>Toxic cat. 1 - 3</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS07.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs5">
                                        <label for="checkbox"><b>GHS07</b></label>
                                        <h6>Exclamation Mark</h6>
                                        <p>Warning Toxic cat. 4 Irritant cat. 2 or 3 Lower systematic health hazards</p>
                                    </div>
                                </div>                           
                                <div class="form-group col-md-3">
                                    <img src="img/GHS08.png" width="120px" height="120px">
                                </div>
                                
                                <div class="form-group col-md-3" width="120px" height="120px">
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs6">
                                        <label for="checkbox"><b>GHS08</b></label>
                                        <h6>Health Hazard</h6>
                                        <p>Danger<br> ro Warning systematic health hazard</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <img src="img/GHS09.png" width="120px" height="120px">
                                </div>
                               
                                 <div class="form-group col-md-3">
                                    
                                    <div class="form-check">
                                        <input id="checkbox" type="checkbox" class="form-check-input"  value="1" name="ghs9">
                                        <label for="checkbox"><b>GHS09</b></label>
                                        <h6>Environment</h6>
                                     <p>Warning (for cat. 1)<br>(for cat. 2 no signal word)</p>
                                    </div>
                                </div>                           
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
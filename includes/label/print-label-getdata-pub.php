  <?php
    $pt = new Chempo();
    $uid  = $_GET['read'];
    $ch = new Chempo();

    $result = $ch->countGHS($uid);

    $result2 = $ch->readChemicalInfo($uid);


    $chemicalName = $result2['begin_of_pname'];
    $casNo = $result2['cas_no'];
    $unNo = $result2['un_no'];
    $unNo = $ch->checkUnNumberIfExist($unNo);
    $reachNo = $result2['reach_number'];
    $reachNo = $ch->checkReachNumberIfExist($reachNo);

    $ufiNo = $result2['ufi'];
    $ufiNo = $ch->checkUfiNumberIfExist($ufiNo);

    $signalWord = $result2['signal_word'];
    $signalWordVal = "";
    if($signalWord == 'D')
    {
            $signalWordVal = "DANGER";
    }
    else if($signalWord == 'W')
    {
            $signalWordVal = "WARNING";
    }


    $hp1 = $result2['hphrase1'];
    $hp2 = $result2['hphrase2'];
    $hp3 = $result2['hphrase3'];
    $hp4 = $result2['hphrase4'];
    $hp5 = $result2['hphrase5'];
    $hp6 = $result2['hphrase6'];

    $hptext1 = $ch->selectPhrasetext($hp1);
    $hptext2 = $ch->selectPhrasetext($hp2);
    $hptext3 = $ch->selectPhrasetext($hp3);
    $hptext4 = $ch->selectPhrasetext($hp4);
    $hptext5 = $ch->selectPhrasetext($hp5);
    $hptext6 = $ch->selectPhrasetext($hp6);

    
    $hphrase1 = $result2['hphrase1'].' '. $hptext1['phrasentext'];
    $hphrase2 = $result2['hphrase2'].' '. $hptext2['phrasentext'];
    $hphrase3 = $result2['hphrase3'].' '. $hptext3['phrasentext'];
    $hphrase4 = $result2['hphrase4'].' '. $hptext4['phrasentext'];
    $hphrase5 = $result2['hphrase5'].' '. $hptext5['phrasentext'];
    $hphrase6 = $result2['hphrase6'].' '. $hptext6['phrasentext'];


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $pp1 = $result2['pphrase1'];
    $pp2 = $result2['pphrase2'];
    $pp3 = $result2['pphrase3'];
    $pp4 = $result2['pphrase4'];
    $pp5 = $result2['pphrase5'];
    $pp6 = $result2['pphrase6'];

    //Prevention
    
    $pp1_prev = $result2['pphrase_prev1'];
    $pp2_prev = $result2['pphrase_prev2'];
    $pp3_prev = $result2['pphrase_prev3'];
    $pp4_prev = $result2['pphrase_prev4'];
    $pp5_prev = $result2['pphrase_prev5'];
    $pp6_prev = $result2['pphrase_prev6'];

    //Response
    $pp1_resp = $result2['pphrase_res1'];
    $pp2_resp = $result2['pphrase_res2'];
    $pp3_resp = $result2['pphrase_res3'];
    $pp4_resp = $result2['pphrase_res4'];
    $pp5_resp = $result2['pphrase_res5'];
    $pp6_resp = $result2['pphrase_res6'];

    //Storage
    $pp1_storage = $result2['pphrase_storage1'];
    $pp2_storage = $result2['pphrase_storage2'];
    $pp3_storage = $result2['pphrase_storage3'];
    $pp4_storage = $result2['pphrase_storage4'];
    $pp5_storage = $result2['pphrase_storage5'];
    $pp6_storage = $result2['pphrase_storage6'];

    //Disposal
    $pp1_disp = $result2['pphrase_disp1'];
    $pp2_disp = $result2['pphrase_disp2'];
    $pp3_disp = $result2['pphrase_disp3'];
    $pp4_disp = $result2['pphrase_disp4'];
    $pp5_disp = $result2['pphrase_disp5'];
    $pp6_disp = $result2['pphrase_disp6'];


    $pptext1 = $ch->selectPhrasetext($pp1);
    $pptext2 = $ch->selectPhrasetext($pp2);
    $pptext3 = $ch->selectPhrasetext($pp3);
    $pptext4 = $ch->selectPhrasetext($pp4);
    $pptext5 = $ch->selectPhrasetext($pp5);
    $pptext6 = $ch->selectPhrasetext($pp6);

    $pptext1_prev = $ch->selectPhrasetext($pp1_prev);
    $pptext2_prev = $ch->selectPhrasetext($pp2_prev);
    $pptext3_prev = $ch->selectPhrasetext($pp3_prev);
    $pptext4_prev = $ch->selectPhrasetext($pp4_prev);
    $pptext5_prev = $ch->selectPhrasetext($pp5_prev);
    $pptext6_prev = $ch->selectPhrasetext($pp6_prev);

    $pptext1_resp = $ch->selectPhrasetext($pp1_resp);
    $pptext2_resp = $ch->selectPhrasetext($pp2_resp);
    $pptext3_resp = $ch->selectPhrasetext($pp3_resp);
    $pptext4_resp = $ch->selectPhrasetext($pp4_resp);
    $pptext5_resp = $ch->selectPhrasetext($pp5_resp);
    $pptext6_resp = $ch->selectPhrasetext($pp6_resp);


    $pptext1_storage = $ch->selectPhrasetext($pp1_storage);
    $pptext2_storage = $ch->selectPhrasetext($pp2_storage);
    $pptext3_storage = $ch->selectPhrasetext($pp3_storage);
    $pptext4_storage = $ch->selectPhrasetext($pp4_storage);
    $pptext5_storage = $ch->selectPhrasetext($pp5_storage);
    $pptext6_storage = $ch->selectPhrasetext($pp6_storage);

    $pptext1_disp = $ch->selectPhrasetext($pp1_disp);
    $pptext2_disp = $ch->selectPhrasetext($pp2_disp);
    $pptext3_disp = $ch->selectPhrasetext($pp3_disp);
    $pptext4_disp = $ch->selectPhrasetext($pp4_disp);
    $pptext5_disp = $ch->selectPhrasetext($pp5_disp);
    $pptext6_disp = $ch->selectPhrasetext($pp6_disp);


    $pphrase1 = $result2['pphrase1'].'  '. $pptext1['phrasentext'];
    $pphrase2 = $result2['pphrase2'].'  '. $pptext2['phrasentext'];
    $pphrase3 = $result2['pphrase3'].'  '. $pptext3['phrasentext'];
    $pphrase4 = $result2['pphrase4'].'  '. $pptext4['phrasentext'];
    $pphrase5 = $result2['pphrase5'].'  '. $pptext5['phrasentext'];
    $pphrase6 = $result2['pphrase6'].'  '. $pptext6['phrasentext'];


    $pphrase1_prev = $result2['pphrase_prev1'].'  '. $pptext1_prev['phrasentext'];
    $pphrase2_prev = $result2['pphrase_prev2'].'  '. $pptext2_prev['phrasentext'];
    $pphrase3_prev = $result2['pphrase_prev3'].'  '. $pptext3_prev['phrasentext'];
    $pphrase4_prev = $result2['pphrase_prev4'].'  '. $pptext4_prev['phrasentext'];
    $pphrase5_prev = $result2['pphrase_prev5'].'  '. $pptext5_prev['phrasentext'];
    $pphrase6_prev = $result2['pphrase_prev6'].'  '. $pptext6_prev['phrasentext'];

    $pphrase1_resp = $result2['pphrase_res1'].'  '. $pptext1_resp['phrasentext'];
    $pphrase2_resp = $result2['pphrase_res2'].'  '. $pptext2_resp['phrasentext'];
    $pphrase3_resp = $result2['pphrase_res3'].'  '. $pptext3_resp['phrasentext'];
    $pphrase4_resp = $result2['pphrase_res4'].'  '. $pptext4_resp['phrasentext'];
    $pphrase5_resp = $result2['pphrase_res5'].'  '. $pptext5_resp['phrasentext'];
    $pphrase6_resp = $result2['pphrase_res6'].'  '. $pptext6_resp['phrasentext'];

    $pphrase1_storage = $result2['pphrase_storage1'].'  '. $pptext1_storage['phrasentext'];
    $pphrase2_storage = $result2['pphrase_storage2'].'  '. $pptext2_storage['phrasentext'];
    $pphrase3_storage = $result2['pphrase_storage3'].'  '. $pptext3_storage['phrasentext'];
    $pphrase4_storage = $result2['pphrase_storage4'].'  '. $pptext4_storage['phrasentext'];
    $pphrase5_storage = $result2['pphrase_storage5'].'  '. $pptext5_storage['phrasentext'];
    $pphrase6_storage = $result2['pphrase_storage6'].'  '. $pptext6_storage['phrasentext'];

    $pphrase1_disp = $result2['pphrase_disp1'].'  '. $pptext1_disp['phrasentext'];
    $pphrase2_disp = $result2['pphrase_disp2'].'  '. $pptext2_disp['phrasentext'];
    $pphrase3_disp = $result2['pphrase_disp3'].'  '. $pptext3_disp['phrasentext'];
    $pphrase4_disp = $result2['pphrase_disp4'].'  '. $pptext4_disp['phrasentext'];
    $pphrase5_disp = $result2['pphrase_disp5'].'  '. $pptext5_disp['phrasentext'];
    $pphrase6_disp = $result2['pphrase_disp6'].'  '. $pptext6_disp['phrasentext'];






$withGhs = array();
$ghs = array($result['ghs1'], $result['ghs2'], $result['ghs3'], $result['ghs4'], $result['ghs5'], $result['ghs6'], $result['ghs7'], $result['ghs8'], $result['ghs9']);
$arrlength = count($ghs);
$count = 0;
for($x = 0; $x < $arrlength; $x++) {
    if($ghs[$x] == '1')
    {
        $temp = (string)$x+1;
        $label = "GHS0".$temp;
        $count += 1;
        array_push($withGhs, $label);


    }



}
<?php



function __autoload($class)
{
  require_once "../../classes/$class.php";
}


if(isset($_GET['print_id']))
{
    $uid = $_GET['print_id'];
    $language1 = $_GET['lang1'];
    $language2 = $_GET['lang2'];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////08-5-19
$ch = new Chempo();

    $result = $ch->countGHS($uid);

    $result2 = $ch->readChemicalInfo($uid);


    $chemicalName = $result2['begin_of_pname'];
    $casNo = $result2['cas_no'];
    $unNo = $result2['un_no'];
    $signalWord = $result2['signal_word'];


    $signalWordVal = "";
    $phrasenkopf_id = 0;
    if($signalWord == 'D')
    {
            $signalWordVal = "DANGER";
            $phrasenkopf_id=7091;
    }
    else if($signalWord == 'W')
    {
            $signalWordVal = "WARNING";
            $phrasenkopf_id=7093;
    }

    /*
    $fLang_signalWord = $ch->selectSignalWord($result2['first_language'],$phrasenkopf_id);
    $sLang_signalWord = $ch->selectSignalWord($result2['second_language'],$phrasenkopf_id);
    */
     $fLang_signalWord = $ch->selectSignalWord($language1,$phrasenkopf_id);
    $sLang_signalWord = $ch->selectSignalWord($language2,$phrasenkopf_id);

    $signalWordLang1 = $fLang_signalWord['phrasentext'];
    $signalWordLang2 = $sLang_signalWord['phrasentext'];



    $fLang_lang = $ch->selectLanguage($language1);
    $sLang_lang = $ch->selectLanguage($language2);




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

/*
    $hptextbi1 = $ch->selectPhrasetext2($hp1,$result2['first_language'],$result2['second_language']);
    $hptextbi2 = $ch->selectPhrasetext2($hp2,$result2['first_language'],$result2['second_language']);
    $hptextbi3 = $ch->selectPhrasetext2($hp3,$result2['first_language'],$result2['second_language']);
    $hptextbi4 = $ch->selectPhrasetext2($hp4,$result2['first_language'],$result2['second_language']);
    $hptextbi5 = $ch->selectPhrasetext2($hp5,$result2['first_language'],$result2['second_language']);
    $hptextbi6 = $ch->selectPhrasetext2($hp6,$result2['first_language'],$result2['second_language']);
*/

    $hptextbi1 = $ch->selectPhrasetext2($hp1,$language1,$language2);
    $hptextbi2 = $ch->selectPhrasetext2($hp2,$language1,$language2);
    $hptextbi3 = $ch->selectPhrasetext2($hp3,$language1,$language2);
    $hptextbi4 = $ch->selectPhrasetext2($hp4,$language1,$language2);
    $hptextbi5 = $ch->selectPhrasetext2($hp5,$language1,$language2);
    $hptextbi6 = $ch->selectPhrasetext2($hp6,$language1,$language2);

    //$signalWordLang2 = $ch->selectPhrasetext2();
   // $signalWordLang = $ch->readSignalWord($signalWord,$result2['first_language'],$result2['second_language']);
    



    $hphraseFLang1 = $hptextbi1['pcode1'].' '.$hptextbi1['ptext1'];
    $hphraseFLang2 = $hptextbi2['pcode1'].' '.$hptextbi2['ptext1'];
    $hphraseFLang3 = $hptextbi3['pcode1'].' '.$hptextbi3['ptext1'];
    $hphraseFLang4 = $hptextbi4['pcode1'].' '.$hptextbi4['ptext1'];
    $hphraseFLang5 = $hptextbi5['pcode1'].' '.$hptextbi5['ptext1'];
    $hphraseFLang6 = $hptextbi6['pcode1'].' '.$hptextbi6['ptext1'];


    $hphraseSLang1 = $hptextbi1['pcode2'].' '.$hptextbi1['ptext2'];
    $hphraseSLang2 = $hptextbi2['pcode2'].' '.$hptextbi2['ptext2'];
    $hphraseSLang3 = $hptextbi3['pcode2'].' '.$hptextbi3['ptext2'];
    $hphraseSLang4 = $hptextbi4['pcode2'].' '.$hptextbi4['ptext2'];
    $hphraseSLang5 = $hptextbi5['pcode2'].' '.$hptextbi5['ptext2'];
    $hphraseSLang6 = $hptextbi6['pcode2'].' '.$hptextbi6['ptext2'];



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //General
    $pp1 = $result2['pphrase1'];
    $pp2 = $result2['pphrase2'];
    $pp3 = $result2['pphrase3'];
    $pp4 = $result2['pphrase4'];
    $pp5 = $result2['pphrase5'];
    $pp6 = $result2['pphrase6'];
//////////////////////Not yet implemented
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
    

//////////////////////Not yet implemented end

    $pptext1 = $ch->selectPhrasetext($pp1);
    $pptext2 = $ch->selectPhrasetext($pp2);
    $pptext3 = $ch->selectPhrasetext($pp3);
    $pptext4 = $ch->selectPhrasetext($pp4);
    $pptext5 = $ch->selectPhrasetext($pp5);
    $pptext6 = $ch->selectPhrasetext($pp6);

//////////////////////Not yet implemented
    
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
    
//////////////////////Not yet implemented end


    $pphrase1 = $result2['pphrase1'].'  '. $pptext1['phrasentext'];
    $pphrase2 = $result2['pphrase2'].'  '. $pptext2['phrasentext'];
    $pphrase3 = $result2['pphrase3'].'  '. $pptext3['phrasentext'];
    $pphrase4 = $result2['pphrase4'].'  '. $pptext4['phrasentext'];
    $pphrase5 = $result2['pphrase5'].'  '. $pptext5['phrasentext'];
    $pphrase6 = $result2['pphrase6'].'  '. $pptext6['phrasentext'];

//////////////////////Not yet implemented
    
    $pphrase1_prev = $result2['pphrase_prev1'].'  '. $pptext1_prev['phrasentext'];
    $pphrase2_prev = $result2['pphrase_prev2'].'  '. $pptext1_prev['phrasentext'];
    $pphrase3_prev = $result2['pphrase_prev3'].'  '. $pptext1_prev['phrasentext'];
    $pphrase4_prev = $result2['pphrase_prev4'].'  '. $pptext1_prev['phrasentext'];
    $pphrase5_prev = $result2['pphrase_prev5'].'  '. $pptext1_prev['phrasentext'];
    $pphrase6_prev = $result2['pphrase_prev6'].'  '. $pptext1_prev['phrasentext'];

    $pphrase1_resp = $result2['pphrase_res1'].'  '. $pptext1_resp['phrasentext'];
    $pphrase2_resp = $result2['pphrase_res2'].'  '. $pptext1_resp['phrasentext'];
    $pphrase3_resp = $result2['pphrase_res3'].'  '. $pptext1_resp['phrasentext'];
    $pphrase4_resp = $result2['pphrase_res4'].'  '. $pptext1_resp['phrasentext'];
    $pphrase5_resp = $result2['pphrase_res5'].'  '. $pptext1_resp['phrasentext'];
    $pphrase6_resp = $result2['pphrase_res6'].'  '. $pptext1_resp['phrasentext'];

    $pphrase1_storage = $result2['pphrase_storage1'].'  '. $pptext1_storage['phrasentext'];
    $pphrase2_storage = $result2['pphrase_storage2'].'  '. $pptext1_storage['phrasentext'];
    $pphrase3_storage = $result2['pphrase_storage3'].'  '. $pptext1_storage['phrasentext'];
    $pphrase4_storage = $result2['pphrase_storage4'].'  '. $pptext1_storage['phrasentext'];
    $pphrase5_storage = $result2['pphrase_storage5'].'  '. $pptext1_storage['phrasentext'];
    $pphrase6_storage = $result2['pphrase_storage6'].'  '. $pptext1_storage['phrasentext'];

    $pphrase1_disp = $result2['pphrase_disp1'].'  '. $pptext1_disp['phrasentext'];
    $pphrase2_disp = $result2['pphrase_disp2'].'  '. $pptext1_disp['phrasentext'];
    $pphrase3_disp = $result2['pphrase_disp3'].'  '. $pptext1_disp['phrasentext'];
    $pphrase4_disp = $result2['pphrase_disp4'].'  '. $pptext1_disp['phrasentext'];
    $pphrase5_disp = $result2['pphrase_disp5'].'  '. $pptext1_disp['phrasentext'];
    $pphrase6_disp = $result2['pphrase_disp6'].'  '. $pptext1_disp['phrasentext'];
    


//////////////////////Not yet implemented end

/*
    $pptextbi1 = $ch->selectPhrasetext2($pp1,$result2['first_language'],$result2['second_language']);
    $pptextbi2 = $ch->selectPhrasetext2($pp2,$result2['first_language'],$result2['second_language']);
    $pptextbi3 = $ch->selectPhrasetext2($pp3,$result2['first_language'],$result2['second_language']);
    $pptextbi4 = $ch->selectPhrasetext2($pp4,$result2['first_language'],$result2['second_language']);
    $pptextbi5 = $ch->selectPhrasetext2($pp5,$result2['first_language'],$result2['second_language']);
    $pptextbi6 = $ch->selectPhrasetext2($pp6,$result2['first_language'],$result2['second_language']);
    */

    $pptextbi1 = $ch->selectPhrasetext2($pp1,$language1,$language2);
    $pptextbi2 = $ch->selectPhrasetext2($pp2,$language1,$language2);
    $pptextbi3 = $ch->selectPhrasetext2($pp3,$language1,$language2);
    $pptextbi4 = $ch->selectPhrasetext2($pp4,$language1,$language2);
    $pptextbi5 = $ch->selectPhrasetext2($pp5,$language1,$language2);
    $pptextbi6 = $ch->selectPhrasetext2($pp6,$language1,$language2);

    //////////////////////Not yet implemented

/*
    $pptextbi1_prev = $ch->selectPhrasetext2($pp1_prev,$result2['first_language'],$result2['second_language']);
    $pptextbi2_prev = $ch->selectPhrasetext2($pp2_prev,$result2['first_language'],$result2['second_language']);
    $pptextbi3_prev = $ch->selectPhrasetext2($pp3_prev,$result2['first_language'],$result2['second_language']);
    $pptextbi4_prev = $ch->selectPhrasetext2($pp4_prev,$result2['first_language'],$result2['second_language']);
    $pptextbi5_prev = $ch->selectPhrasetext2($pp5_prev,$result2['first_language'],$result2['second_language']);
    $pptextbi6_prev = $ch->selectPhrasetext2($pp6_prev,$result2['first_language'],$result2['second_language']);
*/

    $pptextbi1_prev = $ch->selectPhrasetext2($pp1_prev,$language1,$language2);
    $pptextbi2_prev = $ch->selectPhrasetext2($pp2_prev,$language1,$language2);
    $pptextbi3_prev = $ch->selectPhrasetext2($pp3_prev,$language1,$language2);
    $pptextbi4_prev = $ch->selectPhrasetext2($pp4_prev,$language1,$language2);
    $pptextbi5_prev = $ch->selectPhrasetext2($pp5_prev,$language1,$language2);
    $pptextbi6_prev = $ch->selectPhrasetext2($pp6_prev,$language1,$language2);

/*
    $pptextbi1_resp = $ch->selectPhrasetext2($pp1_resp,$result2['first_language'],$result2['second_language']);
    $pptextbi2_resp = $ch->selectPhrasetext2($pp2_resp,$result2['first_language'],$result2['second_language']);
    $pptextbi3_resp = $ch->selectPhrasetext2($pp3_resp,$result2['first_language'],$result2['second_language']);
    $pptextbi4_resp = $ch->selectPhrasetext2($pp4_resp,$result2['first_language'],$result2['second_language']);
    $pptextbi5_resp = $ch->selectPhrasetext2($pp5_resp,$result2['first_language'],$result2['second_language']);
    $pptextbi6_resp = $ch->selectPhrasetext2($pp6_resp,$result2['first_language'],$result2['second_language']);
*/

    $pptextbi1_resp = $ch->selectPhrasetext2($pp1_resp,$language1,$language2);
    $pptextbi2_resp = $ch->selectPhrasetext2($pp2_resp,$language1,$language2);
    $pptextbi3_resp = $ch->selectPhrasetext2($pp3_resp,$language1,$language2);
    $pptextbi4_resp = $ch->selectPhrasetext2($pp4_resp,$language1,$language2);
    $pptextbi5_resp = $ch->selectPhrasetext2($pp5_resp,$language1,$language2);
    $pptextbi6_resp = $ch->selectPhrasetext2($pp6_resp,$language1,$language2);
/*
    $pptextbi1_storage = $ch->selectPhrasetext2($pp1_storage,$result2['first_language'],$result2['second_language']);
    $pptextbi2_storage = $ch->selectPhrasetext2($pp2_storage,$result2['first_language'],$result2['second_language']);
    $pptextbi3_storage = $ch->selectPhrasetext2($pp3_storage,$result2['first_language'],$result2['second_language']);
    $pptextbi4_storage = $ch->selectPhrasetext2($pp4_storage,$result2['first_language'],$result2['second_language']);
    $pptextbi5_storage = $ch->selectPhrasetext2($pp5_storage,$result2['first_language'],$result2['second_language']);
    $pptextbi6_storage = $ch->selectPhrasetext2($pp6_storage,$result2['first_language'],$result2['second_language']);

*/
    $pptextbi1_storage = $ch->selectPhrasetext2($pp1_storage,$language1,$language2);
    $pptextbi2_storage = $ch->selectPhrasetext2($pp2_storage,$language1,$language2);
    $pptextbi3_storage = $ch->selectPhrasetext2($pp3_storage,$language1,$language2);
    $pptextbi4_storage = $ch->selectPhrasetext2($pp4_storage,$language1,$language2);
    $pptextbi5_storage = $ch->selectPhrasetext2($pp5_storage,$language1,$language2);
    $pptextbi6_storage = $ch->selectPhrasetext2($pp6_storage,$language1,$language2);

/*    
    $pptextbi1_disp = $ch->selectPhrasetext2($pp1_disp,$result2['first_language'],$result2['second_language']);
    $pptextbi2_disp = $ch->selectPhrasetext2($pp2_disp,$result2['first_language'],$result2['second_language']);
    $pptextbi3_disp = $ch->selectPhrasetext2($pp3_disp,$result2['first_language'],$result2['second_language']);
    $pptextbi4_disp = $ch->selectPhrasetext2($pp4_disp,$result2['first_language'],$result2['second_language']);
    $pptextbi5_disp = $ch->selectPhrasetext2($pp5_disp,$result2['first_language'],$result2['second_language']);
    $pptextbi6_disp = $ch->selectPhrasetext2($pp6_disp,$result2['first_language'],$result2['second_language']);
*/

    $pptextbi1_disp = $ch->selectPhrasetext2($pp1_disp,$language1,$language2);
    $pptextbi2_disp = $ch->selectPhrasetext2($pp2_disp,$language1,$language2);
    $pptextbi3_disp = $ch->selectPhrasetext2($pp3_disp,$language1,$language2);
    $pptextbi4_disp = $ch->selectPhrasetext2($pp4_disp,$language1,$language2);
    $pptextbi5_disp = $ch->selectPhrasetext2($pp5_disp,$language1,$language2);
    $pptextbi6_disp = $ch->selectPhrasetext2($pp6_disp,$language1,$language2);
    //////////////////////Not yet implemented end

    $pphraseFLang1 = $pptextbi1['pcode1'].' '.$pptextbi1['ptext1'];
    $pphraseFLang2 = $pptextbi2['pcode1'].' '.$pptextbi2['ptext1'];
    $pphraseFLang3 = $pptextbi3['pcode1'].' '.$pptextbi3['ptext1'];
    $pphraseFLang4 = $pptextbi4['pcode1'].' '.$pptextbi4['ptext1'];
    $pphraseFLang5 = $pptextbi5['pcode1'].' '.$pptextbi5['ptext1'];
    $pphraseFLang6 = $pptextbi6['pcode1'].' '.$pptextbi6['ptext1'];


    $pphraseSLang1 = $pptextbi1['pcode2'].' '.$pptextbi1['ptext2'];
    $pphraseSLang2 = $pptextbi2['pcode2'].' '.$pptextbi2['ptext2'];
    $pphraseSLang3 = $pptextbi3['pcode2'].' '.$pptextbi3['ptext2'];
    $pphraseSLang4 = $pptextbi4['pcode2'].' '.$pptextbi4['ptext2'];
    $pphraseSLang5 = $pptextbi5['pcode2'].' '.$pptextbi5['ptext2'];
    $pphraseSLang6 = $pptextbi6['pcode2'].' '.$pptextbi6['ptext2'];


    //////////////////////Not yet implemented 
    $pphraseFLang1_prev = $pptextbi1_prev['pcode1'].' '.$pptextbi1_prev['ptext1'];
    $pphraseFLang2_prev = $pptextbi2_prev['pcode1'].' '.$pptextbi2_prev['ptext1'];
    $pphraseFLang3_prev = $pptextbi3_prev['pcode1'].' '.$pptextbi3_prev['ptext1'];
    $pphraseFLang4_prev = $pptextbi4_prev['pcode1'].' '.$pptextbi4_prev['ptext1'];
    $pphraseFLang5_prev = $pptextbi5_prev['pcode1'].' '.$pptextbi5_prev['ptext1'];
    $pphraseFLang6_prev = $pptextbi6_prev['pcode1'].' '.$pptextbi6_prev['ptext1'];


    $pphraseSLang1_prev = $pptextbi1_prev['pcode2'].' '.$pptextbi1_prev['ptext2'];
    $pphraseSLang2_prev = $pptextbi2_prev['pcode2'].' '.$pptextbi2_prev['ptext2'];
    $pphraseSLang3_prev = $pptextbi3_prev['pcode2'].' '.$pptextbi3_prev['ptext2'];
    $pphraseSLang4_prev = $pptextbi4_prev['pcode2'].' '.$pptextbi4_prev['ptext2'];
    $pphraseSLang5_prev = $pptextbi5_prev['pcode2'].' '.$pptextbi5_prev['ptext2'];
    $pphraseSLang6_prev = $pptextbi6_prev['pcode2'].' '.$pptextbi6_prev['ptext2'];


    $pphraseFLang1_resp = $pptextbi1_resp['pcode1'].' '.$pptextbi1_resp['ptext1'];
    $pphraseFLang2_resp = $pptextbi2_resp['pcode1'].' '.$pptextbi2_resp['ptext1'];
    $pphraseFLang3_resp = $pptextbi3_resp['pcode1'].' '.$pptextbi3_resp['ptext1'];
    $pphraseFLang4_resp = $pptextbi4_resp['pcode1'].' '.$pptextbi4_resp['ptext1'];
    $pphraseFLang5_resp = $pptextbi5_resp['pcode1'].' '.$pptextbi5_resp['ptext1'];
    $pphraseFLang6_resp = $pptextbi6_resp['pcode1'].' '.$pptextbi6_resp['ptext1'];


    $pphraseSLang1_resp = $pptextbi1_resp['pcode2'].' '.$pptextbi1_resp['ptext2'];
    $pphraseSLang2_resp = $pptextbi2_resp['pcode2'].' '.$pptextbi2_resp['ptext2'];
    $pphraseSLang3_resp = $pptextbi3_resp['pcode2'].' '.$pptextbi3_resp['ptext2'];
    $pphraseSLang4_resp = $pptextbi4_resp['pcode2'].' '.$pptextbi4_resp['ptext2'];
    $pphraseSLang5_resp = $pptextbi5_resp['pcode2'].' '.$pptextbi5_resp['ptext2'];
    $pphraseSLang6_resp = $pptextbi6_resp['pcode2'].' '.$pptextbi6_resp['ptext2'];


    $pphraseFLang1_storage = $pptextbi1_storage['pcode1'].' '.$pptextbi1_storage['ptext1'];
    $pphraseFLang2_storage = $pptextbi2_storage['pcode1'].' '.$pptextbi2_storage['ptext1'];
    $pphraseFLang3_storage = $pptextbi3_storage['pcode1'].' '.$pptextbi3_storage['ptext1'];
    $pphraseFLang4_storage = $pptextbi4_storage['pcode1'].' '.$pptextbi4_storage['ptext1'];
    $pphraseFLang5_storage = $pptextbi5_storage['pcode1'].' '.$pptextbi5_storage['ptext1'];
    $pphraseFLang6_storage = $pptextbi6_storage['pcode1'].' '.$pptextbi6_storage['ptext1'];


    $pphraseSLang1_storage = $pptextbi1_storage['pcode2'].' '.$pptextbi1_storage['ptext2'];
    $pphraseSLang2_storage = $pptextbi2_storage['pcode2'].' '.$pptextbi2_storage['ptext2'];
    $pphraseSLang3_storage = $pptextbi3_storage['pcode2'].' '.$pptextbi3_storage['ptext2'];
    $pphraseSLang4_storage = $pptextbi4_storage['pcode2'].' '.$pptextbi4_storage['ptext2'];
    $pphraseSLang5_storage = $pptextbi5_storage['pcode2'].' '.$pptextbi5_storage['ptext2'];
    $pphraseSLang6_storage = $pptextbi6_storage['pcode2'].' '.$pptextbi6_storage['ptext2'];


    $pphraseFLang1_disp = $pptextbi1_disp['pcode1'].' '.$pptextbi1_disp['ptext1'];
    $pphraseFLang2_disp = $pptextbi2_disp['pcode1'].' '.$pptextbi2_disp['ptext1'];
    $pphraseFLang3_disp = $pptextbi3_disp['pcode1'].' '.$pptextbi3_disp['ptext1'];
    $pphraseFLang4_disp = $pptextbi4_disp ['pcode1'].' '.$pptextbi4_disp['ptext1'];
    $pphraseFLang5_disp = $pptextbi5_disp['pcode1'].' '.$pptextbi5_disp['ptext1'];
    $pphraseFLang6_disp = $pptextbi6_disp['pcode1'].' '.$pptextbi6_disp['ptext1'];


    $pphraseSLang1_disp = $pptextbi1_disp['pcode2'].' '.$pptextbi1_disp['ptext2'];
    $pphraseSLang2_disp = $pptextbi2_disp['pcode2'].' '.$pptextbi2_disp['ptext2'];
    $pphraseSLang3_disp = $pptextbi3_disp['pcode2'].' '.$pptextbi3_disp['ptext2'];
    $pphraseSLang4_disp = $pptextbi4_disp['pcode2'].' '.$pptextbi4_disp['ptext2'];
    $pphraseSLang5_disp = $pptextbi5_disp['pcode2'].' '.$pptextbi5_disp['ptext2'];
    $pphraseSLang6_disp = $pptextbi6_disp['pcode2'].' '.$pptextbi6_disp['ptext2'];

    //////////////////////Not yet implemented end


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


    //$chemicalName = $chemicalName
    //$casNo = $casNo;
    //$unNo = $unNo
    $firstGhs = $withGhs[0];
    $secondGhs = $withGhs[1];

    //$signalWordLang1 = $signalWordLang1
    //$signalWordLang2 = $signalWordLang2

    $hpFLang1 = $hphraseFLang1;
    $hpFLang2 = $hphraseFLang2;
    $hpFLang3 = $hphraseFLang3;
    $hpFLang4 = $hphraseFLang4;
    $hpFLang5 = $hphraseFLang5;
    $hpFLang6 = $hphraseFLang6;


    $hpSLang1 = $hphraseSLang1;
    $hpSLang2 = $hphraseSLang2;
    $hpSLang3 = $hphraseSLang3;
    $hpSLang4 = $hphraseSLang4;
    $hpSLang5 = $hphraseSLang5;
    $hpSLang6 = $hphraseSLang6;

    $ppFLang1 = $pphraseFLang1;
    $ppFLang2 = $pphraseFLang2;
    $ppFLang3 = $pphraseFLang3;
    $ppFLang4 = $pphraseFLang4;
    $ppFLang5 = $pphraseFLang5;
    $ppFLang6 = $pphraseFLang6;

    $ppSLang1 = $pphraseSLang1;
    $ppSLang2 = $pphraseSLang2;
    $ppSLang3 = $pphraseSLang3;
    $ppSLang4 = $pphraseSLang4;
    $ppSLang5 = $pphraseSLang5;
    $ppSLang6 = $pphraseSLang6;

    //Prevention
    $ppFLang1_prev = $pphraseFLang1_prev;
    $ppFLang2_prev = $pphraseFLang2_prev;
    $ppFLang3_prev = $pphraseFLang3_prev;
    $ppFLang4_prev = $pphraseFLang4_prev;
    $ppFLang5_prev = $pphraseFLang5_prev;
    $ppFLang6_prev = $pphraseFLang6_prev;

    $ppSLang1_prev = $pphraseSLang1_prev;
    $ppSLang2_prev = $pphraseSLang2_prev;
    $ppSLang3_prev = $pphraseSLang3_prev;
    $ppSLang4_prev = $pphraseSLang4_prev;
    $ppSLang5_prev = $pphraseSLang5_prev;
    $ppSLang6_prev = $pphraseSLang6_prev;

    //Response
    $ppFLang1_resp = $pphraseFLang1_resp;
    $ppFLang2_resp = $pphraseFLang2_resp;
    $ppFLang3_resp = $pphraseFLang3_resp;
    $ppFLang4_resp = $pphraseFLang4_resp;
    $ppFLang5_resp = $pphraseFLang5_resp;
    $ppFLang6_resp = $pphraseFLang6_resp;

    $ppSLang1_resp = $pphraseSLang1_resp;
    $ppSLang2_resp = $pphraseSLang2_resp;
    $ppSLang3_resp = $pphraseSLang3_resp;
    $ppSLang4_resp = $pphraseSLang4_resp;
    $ppSLang5_resp = $pphraseSLang5_resp;
    $ppSLang6_resp = $pphraseSLang6_resp;

    //Storage
    $ppFLang1_storage = $pphraseFLang1_storage;
    $ppFLang2_storage = $pphraseFLang2_storage;
    $ppFLang3_storage = $pphraseFLang3_storage;
    $ppFLang4_storage = $pphraseFLang4_storage;
    $ppFLang5_storage = $pphraseFLang5_storage;
    $ppFLang6_storage = $pphraseFLang6_storage;

    $ppSLang1_storage = $pphraseSLang1_storage;
    $ppSLang2_storage = $pphraseSLang2_storage;
    $ppSLang3_storage = $pphraseSLang3_storage;
    $ppSLang4_storage=  $pphraseSLang4_storage;
    $ppSLang5_storage = $pphraseSLang5_storage;
    $ppSLang6_storage = $pphraseSLang6_storage;

    //Disposal
    $ppFLang1_disp = $pphraseFLang1_disp;
    $ppFLang2_disp = $pphraseFLang2_disp;
    $ppFLang3_disp = $pphraseFLang3_disp;
    $ppFLang4_disp = $pphraseFLang4_disp;
    $ppFLang5_disp = $pphraseFLang5_disp;
    $ppFLang6_disp = $pphraseFLang6_disp;

    $ppSLang1_disp = $pphraseSLang1_disp;
    $ppSLang2_disp = $pphraseSLang2_disp;
    $ppSLang3_disp = $pphraseSLang3_disp;
    $ppSLang4_disp = $pphraseSLang4_disp;
    $ppSLang5_disp = $pphraseSLang5_disp;
    $ppSLang6_disp = $pphraseSLang6_disp;



    $lang1 = $signalWordLang1;
    $lang1 = strtoupper($lang1);
    $lang2 = $signalWordLang2;
    $lang2 = strtoupper($lang2);


    echo $ppFLang1_resp;





////////////////////////////////////////////////////////////////////////////////////////////////////////////////08-5-19 end

/*
    $chemicalName = $_GET['chem_name'];
    $casNo = $_GET['cas_no'];
    $unNo = $_GET['un_no'];
    $firstGhs = $_GET['fghs'];
    $secondGhs = $_GET['sghs'];
    //$thirdGhs = $_GET['tghs'];
    //$fourthGhs = $_GET['ftghs'];
    $signalWordVal = $_GET['signal_word'];
    $signalWordLang1 = $_GET['sw1'];
    $signalWordLang2 = $_GET['sw2'];



    $hpFLang1 = $_GET['fl1'];
    $hpFLang2 = $_GET['fl2'];
    $hpFLang3 = $_GET['fl3'];
    $hpFLang4 = $_GET['fl4'];
    $hpFLang5 = $_GET['fl5'];
    $hpFLang6 = $_GET['fl6'];


    $hpSLang1 = $_GET['sl1'];
    $hpSLang2 = $_GET['sl2'];
    $hpSLang3 = $_GET['sl3'];
    $hpSLang4 = $_GET['sl4'];
    $hpSLang5 = $_GET['sl5'];
    $hpSLang6 = $_GET['sl6'];

    $ppFLang1 = $_GET['pfl1'];
    $ppFLang2 = $_GET['pfl2'];
    $ppFLang3 = $_GET['pfl3'];
    $ppFLang4 = $_GET['pfl4'];
    $ppFLang5 = $_GET['pfl5'];
    $ppFLang6 = $_GET['pfl6'];

    $ppSLang1 = $_GET['psl1'];
    $ppSLang2 = $_GET['psl2'];
    $ppSLang3 = $_GET['psl3'];
    $ppSLang4 = $_GET['psl4'];
    $ppSLang5 = $_GET['psl5'];
    $ppSLang6 = $_GET['psl6'];

    //Prevention
    $ppFLang1_prev = $_GET['pfl1_prev'];
    $ppFLang2_prev = $_GET['pfl2_prev'];
    $ppFLang3_prev = $_GET['pfl3_prev'];
    $ppFLang4_prev = $_GET['pfl4_prev'];
    $ppFLang5_prev = $_GET['pfl5_prev'];
    $ppFLang6_prev = $_GET['pfl6_prev'];

    $ppSLang1_prev = $_GET['pfl1_prev'];
    $ppSLang2_prev = $_GET['pfl2_prev'];
    $ppSLang3_prev = $_GET['pfl3_prev'];
    $ppSLang4_prev = $_GET['pfl4_prev'];
    $ppSLang5_prev = $_GET['pfl5_prev'];
    $ppSLang6_prev = $_GET['pfl6_prev'];

    //Response
    $ppFLang1_resp = $_GET['pfl1_resp'];
    $ppFLang2_resp = $_GET['pfl2_resp'];
    $ppFLang3_resp = $_GET['pfl3_resp'];
    $ppFLang4_resp = $_GET['pfl4_resp'];
    $ppFLang5_resp = $_GET['pfl5_resp'];
    $ppFLang6_resp = $_GET['pfl6_resp'];

    $ppSLang1_resp = $_GET['pfl1_resp'];
    $ppSLang2_resp = $_GET['pfl2_resp'];
    $ppSLang3_resp = $_GET['pfl3_resp'];
    $ppSLang4_resp = $_GET['pfl4_resp'];
    $ppSLang5_resp = $_GET['pfl5_resp'];
    $ppSLang6_resp = $_GET['pfl6_resp'];

    //Storage
    $ppFLang1_storage = $_GET['pfl1_storage'];
    $ppFLang2_storage = $_GET['pfl2_storage'];
    $ppFLang3_storage = $_GET['pfl3_storage'];
    $ppFLang4_storage = $_GET['pfl4_storage'];
    $ppFLang5_storage = $_GET['pfl5_storage'];
    $ppFLang6_storage = $_GET['pfl6_storage'];

    $ppSLang1_storage = $_GET['pfl1_storage'];
    $ppSLang2_storage = $_GET['pfl2_storage'];
    $ppSLang3_storage = $_GET['pfl3_storage'];
    $ppSLang4_storage= $_GET['pfl4_storage'];
    $ppSLang5_storage = $_GET['pfl5_storage'];
    $ppSLang6_storage = $_GET['pfl6_storage'];

    //Disposal
    $ppFLang1_disp = $_GET['pfl1_disp'];
    $ppFLang2_disp = $_GET['pfl2_disp'];
    $ppFLang3_disp = $_GET['pfl3_disp'];
    $ppFLang4_disp = $_GET['pfl4_disp'];
    $ppFLang5_disp = $_GET['pfl5_disp'];
    $ppFLang6_disp = $_GET['pfl6_disp'];

    $ppSLang1_disp = $_GET['pfl1_disp'];
    $ppSLang2_disp = $_GET['pfl2_disp'];
    $ppSLang3_disp = $_GET['pfl3_disp'];
    $ppSLang4_disp = $_GET['pfl4_disp'];
    $ppSLang5_disp = $_GET['pfl5_disp'];
    $ppSLang6_disp = $_GET['pfl6_disp'];



    $lang1 = $_GET['lang1'];
    $lang1 = strtoupper($lang1);
    $lang2 = $_GET['lang2'];
    $lang2 = strtoupper($lang2);


    */
    
    

}
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


//define ('PDF_HEADER_STRING', "by Rimpido GmbH\nwww.rimpido.com");




// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Rimpido GmbH');
$pdf->SetTitle('Label Printing');
$pdf->SetSubject('Rimpido GmbH label printing');
$pdf->SetKeywords('Rimpido, GHS label PDF, GHS label, print label, ghs');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->AddPage();
/*
$left_column = '<h1><b style="font-size:30px">'.htmlspecialchars($chemicalName).'</b></h1> 

<p style="color:black; font-size:18px;"><b>CAS Number: </b>'.htmlspecialchars($casNo).'</p>
<p style="color:black; font-size:18px;"><b>UN Number: </b>UN '.htmlspecialchars($unNo).'</p>
<p style="color:black; font-size:16px;">
<b>Hazzard Statements </b><hr>
'.htmlspecialchars($hp1).'<br>
'.htmlspecialchars($hp2).'<br>
'.htmlspecialchars($hp3).'<br>
'.htmlspecialchars($hp4).'<br>
'.htmlspecialchars($hp5).'<br>
'.htmlspecialchars($hp6).'<br>
'.htmlspecialchars($hpFLang1).'<br>
'.htmlspecialchars($hpFLang2).'<br>
'.htmlspecialchars($hpFLang3).'<br>
'.htmlspecialchars($hpFLang4).'<br>
'.htmlspecialchars($hpFLang5).'<br>
'.htmlspecialchars($hpFLang6).'
</p>

<p style="color:black; font-size:16px;">
<b>Precautionary Statements</b><hr>
'.htmlspecialchars($pp1).'<br>
'.htmlspecialchars($pp2).'<br>
'.htmlspecialchars($pp3).'<br>
'.htmlspecialchars($pp4).'<br>
'.htmlspecialchars($pp5).'<br>
'.htmlspecialchars($pp6).'
</p>





';
*/
//////////////////////////////////////////////////
$hp_phrases_f = array();
$hp_f_lang = array();
$test = "";


 if($hpFLang1 != '')
    {
        array_push($hp_phrases_f, $hpFLang1);
    }
    if($hpFLang2 != '')
    {
        array_push($hp_phrases_f, $hpFLang2);
    }
   if($hpFLang3 != '')
    {
        array_push($hp_phrases_f, $hpFLang3);
    }
    if($hpFLang4 != '')
    {
        array_push($hp_phrases_f, $hpFLang4);
    }
    if($hpFLang5 != '')
    {
        array_push($hp_phrases_f, $hpFLang5);
    }
    if($hpFLang6 != '')
    {
        array_push($hp_phrases_f, $hpFLang6);
    }



foreach ($hp_phrases_f as $key => $valuehpf) {
    $valuehpf = trim($valuehpf);
    if (empty($valuehpf))
    {

    }
        
    else
    {
        array_push($hp_f_lang, $valuehpf);
    }
}


$hp_phrases_f_toString = implode("\n", $hp_f_lang);
////////////////////////////////////////////////////////////////

$hp_phrases_s = array();
$hp_s_lang = array();



 if($hpSLang1 != '')
    {
        array_push($hp_phrases_s, $hpSLang1);
    }
    if($hpSLang2 != '')
    {
        array_push($hp_phrases_s, $hpSLang2);
    }
   if($hpSLang3 != '')
    {
        array_push($hp_phrases_s, $hpSLang3);
    }
    if($hpSLang4 != '')
    {
        array_push($hp_phrases_s, $hpSLang4);
    }
    if($hpSLang5 != '')
    {
        array_push($hp_phrases_s, $hpSLang5);
    }
    if($hpSLang6 != '')
    {
        array_push($hp_phrases_s, $hpSLang6);
    }



foreach ($hp_phrases_s as $key2 => $valuehps) {
    $valuehps = trim($valuehps);
    if (empty($valuehps))
    {

    }
        
    else
    {
        array_push($hp_s_lang, $valuehps);
    }
}


$hp_phrases_s_toString = implode("\n", $hp_s_lang);
///////////////////////////////////////////////////////////////////////////Precautions
$pp_phrases_f = array();
$pp_f_lang = array();
$test = "";


 if($ppFLang1 != '')
    {
        array_push($pp_phrases_f, $ppFLang1);
    }
    if($ppFLang2 != '')
    {
        array_push($pp_phrases_f, $ppFLang2);
    }
   if($ppFLang3 != '')
    {
        array_push($pp_phrases_f, $ppFLang3);
    }
    if($ppFLang4 != '')
    {
        array_push($pp_phrases_f, $ppFLang4);
    }
    if($ppFLang5 != '')
    {
        array_push($pp_phrases_f, $ppFLang5);
    }
    if($ppFLang6 != '')
    {
        array_push($pp_phrases_f, $ppFLang6);
    }



foreach ($pp_phrases_f as $key => $valueppf) {
    $valueppf = trim($valueppf);
    if (empty($valueppf))
    {

    }
        
    else
    {
        array_push($pp_f_lang, $valueppf);
    }
}


$pp_phrases_f_toString = implode("\n", $pp_f_lang);
//////////////////////////////////////////////////////////////Precation second language
$pp_phrases_s = array();
$pp_s_lang = array();



 if($ppSLang1 != '')
    {
        array_push($pp_phrases_s, $ppSLang1);
    }
    if($ppSLang2 != '')
    {
        array_push($pp_phrases_s, $ppSLang2);
    }
   if($ppSLang3 != '')
    {
        array_push($pp_phrases_s, $ppSLang3);
    }
    if($ppSLang4 != '')
    {
        array_push($pp_phrases_s, $ppSLang4);
    }
    if($ppSLang5 != '')
    {
        array_push($pp_phrases_s, $ppSLang5);
    }
    if($ppSLang6 != '')
    {
        array_push($pp_phrases_s, $ppSLang6);
    }



foreach ($pp_phrases_s as $key2 => $valuepps) {
    $valuepps = trim($valuepps);
    if (empty($valuepps))
    {

    }
        
    else
    {
        array_push($pp_s_lang, $valuepps);
    }
}


$pp_phrases_s_toString = implode("\n", $pp_s_lang);



///////////////////////////////////////////////////////////////////////////Prevention
$pp_phrases_f_prev = array();
$pp_f_lang_prev = array();
$test = "";


 if($ppFLang1_prev != '')
    {
        array_push($pp_phrases_f_prev, $ppFLang1_prev);
    }
    if($ppFLang2_prev != '')
    {
        array_push($pp_phrases_f_prev, $ppFLang2_prev);
    }
   if($ppFLang3_prev != '')
    {
        array_push($pp_phrases_f_prev, $ppFLang3_prev);
    }
    if($ppFLang4_prev != '')
    {
        array_push($pp_phrases_f_prev, $ppFLang4_prev);
    }
    if($ppFLang5_prev != '')
    {
        array_push($pp_phrases_f_prev, $ppFLang5_prev);
    }
    if($ppFLang6_prev != '')
    {
        array_push($pp_phrases_f_prev, $ppFLang6_prev);
    }



foreach ($pp_phrases_f_prev as $key => $valueppf_prev) {
    $valueppf_prev = trim($valueppf_prev);
    if (empty($valueppf_prev))
    {

    }
        
    else
    {
        array_push($pp_f_lang_prev, $valueppf_prev);
    }
}


$pp_phrases_f_toString_prev = implode("\n", $pp_f_lang_prev);
//////////////////////////////////////////////////////////////Precation second language
$pp_phrases_s_prev = array();
$pp_s_lang_prev = array();



 if($ppSLang1_prev != '')
    {
        array_push($pp_phrases_s_prev, $ppSLang1_prev);
    }
    if($ppSLang2_prev != '')
    {
        array_push($pp_phrases_s_prev, $ppSLang2_prev);
    }
   if($ppSLang3_prev != '')
    {
        array_push($pp_phrases_s_prev, $ppSLang3_prev);
    }
    if($ppSLang4_prev != '')
    {
        array_push($pp_phrases_s_prev, $ppSLang4_prev);
    }
    if($ppSLang5_prev != '')
    {
        array_push($pp_phrases_s_prev, $ppSLang5_prev);
    }
    if($ppSLang6_prev != '')
    {
        array_push($pp_phrases_s_prev, $ppSLang6_prev);
    }



foreach ($pp_phrases_s_prev as $key2 => $valuepps_prev) {
    $valuepps_prev = trim($valuepps_prev);
    if (empty($valuepps_prev))
    {

    }
        
    else
    {
        array_push($pp_s_lang_prev, $valuepps_prev);
    }
}


$pp_phrases_s_toString_prev = implode("\n", $pp_s_lang_prev);
///////////////////////////////////////////////////////////////////////////Prevention END

///////////////////////////////////////////////////////////////////////////Response
$pp_phrases_f_resp = array();
$pp_f_lang_resp = array();
$test = "";


 if($ppFLang1_resp != '')
    {
        array_push($pp_phrases_f_resp, $ppFLang1_resp);
    }
    if($ppFLang2_resp != '')
    {
        array_push($pp_phrases_f_resp, $ppFLang2_resp);
    }
   if($ppFLang3_resp != '')
    {
        array_push($pp_phrases_f_resp, $ppFLang3_resp);
    }
    if($ppFLang4_resp != '')
    {
        array_push($pp_phrases_f_resp, $ppFLang4_resp);
    }
    if($ppFLang5_resp != '')
    {
        array_push($pp_phrases_f_resp, $ppFLang5_resp);
    }
    if($ppFLang6_resp != '')
    {
        array_push($pp_phrases_f_resp, $ppFLang6_resp);
    }



foreach ($pp_phrases_f_resp as $key => $valueppf_resp) {
    $valueppf_resp = trim($valueppf_resp);
    if (empty($valueppf_resp))
    {

    }
        
    else
    {
        array_push($pp_f_lang_resp, $valueppf_resp);
    }
}


$pp_phrases_f_toString_resp = implode("\n", $pp_f_lang_resp);
//////////////////////////////////////////////////////////////Response second language
$pp_phrases_s_resp = array();
$pp_s_lang_resp = array();



 if($ppSLang1_resp != '')
    {
        array_push($pp_phrases_s_resp, $ppSLang1_resp);
    }
    if($ppSLang2_resp != '')
    {
        array_push($pp_phrases_s_resp, $ppSLang2_resp);
    }
   if($ppSLang3_resp != '')
    {
        array_push($pp_phrases_s_resp, $ppSLang3_resp);
    }
    if($ppSLang4_resp != '')
    {
        array_push($pp_phrases_s_resp, $ppSLang4_resp);
    }
    if($ppSLang5_resp != '')
    {
        array_push($pp_phrases_s_resp, $ppSLang5_resp);
    }
    if($ppSLang6_resp != '')
    {
        array_push($pp_phrases_s_resp, $ppSLang6_resp);
    }



foreach ($pp_phrases_s_resp as $key2 => $valuepps_resp) {
    $valuepps_resp = trim($valuepps_resp);
    if (empty($valuepps_resp))
    {

    }
        
    else
    {
        array_push($pp_s_lang_resp, $valuepps_resp);
    }
}


$pp_phrases_s_toString_resp = implode("\n", $pp_s_lang_resp);
///////////////////////////////////////////////////////////////////////////Response END

///////////////////////////////////////////////////////////////////////////Storage
$pp_phrases_f_storage = array();
$pp_f_lang_storage = array();
$test = "";


 if($ppFLang1_storage != '')
    {
        array_push($pp_phrases_f_storage, $ppFLang1_storage);
    }
    if($ppFLang2_storage != '')
    {
        array_push($pp_phrases_f_storage, $ppFLang2_storage);
    }
   if($ppFLang3_storage != '')
    {
        array_push($pp_phrases_f_storage, $ppFLang3_storage);
    }
    if($ppFLang4_storage != '')
    {
        array_push($pp_phrases_f_storage, $ppFLang4_storage);
    }
    if($ppFLang5_storage != '')
    {
        array_push($pp_phrases_f_storage, $ppFLang5_storage);
    }
    if($ppFLang6_storage != '')
    {
        array_push($pp_phrases_f_storage, $ppFLang6_storage);
    }



foreach ($pp_phrases_f_storage as $key => $valueppf_storage) {
    $valueppf_storage = trim($valueppf_storage);
    if (empty($valueppf_storage))
    {

    }
        
    else
    {
        array_push($pp_f_lang_storage, $valueppf_storage);
    }
}


$pp_phrases_f_toString_storage = implode("\n", $pp_f_lang_storage);
//////////////////////////////////////////////////////////////Storage second language
$pp_phrases_s_storage = array();
$pp_s_lang_storage = array();



 if($ppSLang1_storage != '')
    {
        array_push($pp_phrases_s_storage, $ppSLang1_storage);
    }
    if($ppSLang2_storage != '')
    {
        array_push($pp_phrases_s_storage, $ppSLang2_storage);
    }
   if($ppSLang3_storage != '')
    {
        array_push($pp_phrases_s_storage, $ppSLang3_storage);
    }
    if($ppSLang4_storage != '')
    {
        array_push($pp_phrases_s_storage, $ppSLang4_storage);
    }
    if($ppSLang5_storage != '')
    {
        array_push($pp_phrases_s_storage, $ppSLang5_storage);
    }
    if($ppSLang6_storage != '')
    {
        array_push($pp_phrases_s_storage, $ppSLang6_storage);
    }



foreach ($pp_phrases_s_storage as $key2 => $valuepps_storage) {
    $valuepps_storage = trim($valuepps_storage);
    if (empty($valuepps_storage))
    {

    }
        
    else
    {
        array_push($pp_s_lang_storage, $valuepps_storage);
    }
}


$pp_phrases_s_toString_storage = implode("\n", $pp_s_lang_storage);
///////////////////////////////////////////////////////////////////////////Storage END

///////////////////////////////////////////////////////////////////////////Disposal
$pp_phrases_f_disp = array();
$pp_f_lang_disp = array();
$test = "";


 if($ppFLang1_disp != '')
    {
        array_push($pp_phrases_f_disp, $ppFLang1_disp);
    }
    if($ppFLang2_disp != '')
    {
        array_push($pp_phrases_f_disp, $ppFLang2_disp);
    }
   if($ppFLang3_disp != '')
    {
        array_push($pp_phrases_f_disp, $ppFLang3_disp);
    }
    if($ppFLang4_disp != '')
    {
        array_push($pp_phrases_f_disp, $ppFLang4_disp);
    }
    if($ppFLang5_disp != '')
    {
        array_push($pp_phrases_f_disp, $ppFLang5_disp);
    }
    if($ppFLang6_disp != '')
    {
        array_push($pp_phrases_f_disp, $ppFLang6_disp);
    }



foreach ($pp_phrases_f_disp as $key => $valueppf_disp) {
    $valueppf_disp = trim($valueppf_disp);
    if (empty($valueppf_disp))
    {

    }
        
    else
    {
        array_push($pp_f_lang_disp, $valueppf_disp);
    }
}


$pp_phrases_f_toString_disp = implode("\n", $pp_f_lang_disp);
//////////////////////////////////////////////////////////////Disposal second language
$pp_phrases_s_disp = array();
$pp_s_lang_disp = array();



 if($ppSLang1_disp != '')
    {
        array_push($pp_phrases_s_disp, $ppSLang1_disp);
    }
    if($ppSLang2_disp != '')
    {
        array_push($pp_phrases_s_disp, $ppSLang2_disp);
    }
   if($ppSLang3_disp != '')
    {
        array_push($pp_phrases_s_disp, $ppSLang3_disp);
    }
    if($ppSLang4_disp != '')
    {
        array_push($pp_phrases_s_disp, $ppSLang4_disp);
    }
    if($ppSLang5_disp != '')
    {
        array_push($pp_phrases_s_disp, $ppSLang5_disp);
    }
    if($ppSLang6_disp != '')
    {
        array_push($pp_phrases_s_disp, $ppSLang6_disp);
    }



foreach ($pp_phrases_s_disp as $key2 => $valuepps_disp) {
    $valuepps_disp = trim($valuepps_disp);
    if (empty($valuepps_disp))
    {

    }
        
    else
    {
        array_push($pp_s_lang_disp, $valuepps_disp);
    }
}


$pp_phrases_s_toString_disp = implode("\n", $pp_s_lang_disp);
///////////////////////////////////////////////////////////////////////////Disposal END


/*
$left_column = '<h1><b style="font-size:30px">'.htmlspecialchars($chemicalName).'</b></h1> 

<p style="color:black; font-size:18px;"><b>CAS Number: </b>'.htmlspecialchars($casNo).'</p>
<p style="color:black; font-size:18px;"><b>UN Number: </b>UN '.htmlspecialchars($unNo).'</p>
<p style="color:black; font-size:16px;">
<b>Hazzard Statements </b><hr>

'.htmlspecialchars($hp_phrases_f_toString).'<br>
'.htmlspecialchars($hp_phrases_s_toString).'<br>

</p>

<p style="color:black; font-size:16px;">
<b>Precautionary Statements</b><hr>
'.htmlspecialchars($pp_phrases_f_toString).'<br><br>


'.htmlspecialchars($pp_phrases_s_toString).'<br>

</p>





';
*/

$left_column = '<h1><b style="font-size:30px">'.htmlspecialchars($chemicalName).'</b></h1> 
<p style="color:black; font-size:18px;"><b>UN'.htmlspecialchars($unNo).'</b></p>
<p style="color:black; font-size:9px; text-align:left;">
'.htmlspecialchars($lang1).':<br>
<b>'.htmlspecialchars($signalWordLang1).'</b><br>
'.htmlspecialchars($hp_phrases_f_toString).'
'.htmlspecialchars($pp_phrases_f_toString).'<br>
'.htmlspecialchars($pp_phrases_f_toString_prev).'<br>
'.htmlspecialchars($pp_phrases_f_toString_resp).'<br>
'.htmlspecialchars($pp_phrases_f_toString_storage).'<br>
'.htmlspecialchars($pp_phrases_f_toString_disp).'<br>

</p>

<p style="color:black; font-size:9px;">

'.htmlspecialchars($lang2).':<br>
<b>'.htmlspecialchars($signalWordLang2).'</b><br>
'.htmlspecialchars($hp_phrases_s_toString).'<br>
'.htmlspecialchars($pp_phrases_s_toString).'<br>
'.htmlspecialchars($pp_phrases_s_toString_prev).'<br>
'.htmlspecialchars($pp_phrases_s_toString_resp).'<br>
'.htmlspecialchars($pp_phrases_s_toString_storage).'<br>
'.htmlspecialchars($pp_phrases_s_toString_disp).'<br>

</p>


';


$signalWord = '<h1 style="font-size:30px; color:black;">'.htmlspecialchars($signalWordVal).'</h1>';
$companyAddress = '
<p style="font-size:11px; color:black;">Reiherstieg 40<br>
21244 Buchholz i.d.N. <br>(bei Hamburg)</p>
';
$companyContact ='
<p style="font-size:11px; color:black;">
Tel. +49 (0) 4181 - 1386 456<br>
Fax. +49 (0) 4181 - 1386 457<br>
Email. info@rimpido.com


</p>
';



$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(245, 166, 47);

// write the first column
$pdf->writeHTMLCell(190, '', '', $y, $left_column,0, 0, 1, true, 'J', true);
//$pdf->writeHTMLCell(140, '', 210, 140, $signalWord, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(140, '', 240, 5, $companyAddress, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(140, '', 130, 5, $companyContact, 0, 0, 1, true, 'J', true);

// set JPEG quality
$pdf->setJPEGQuality(100);
/*
$pdf->SetXY(65, 35);
//$pdf->Image('images/GHS01.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

$horizontal_alignments = array('L', 'C', 'R');
$vertical_alignments = array('T', 'M', 'B');

$x = 20;
$y = 35;
$w = 40;
$h = 40;
// test all combinations of alignments

for ($i = 0; $i < 3; ++$i) {
	$fitbox = $horizontal_alignments[$i].' ';
	$x = 20;

	for ($j = 0; $j < 1; ++$j) {
		$fitbox[1] = $vertical_alignments[$j];
		$pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,128));
		$pdf->Image('images/GHS01.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
		$x += 32; // new column
	}
	$y += 45; // new row
}

$txt = 'H226 - Flammable liquid and vapour.
H302 - Harmful if swallowed.
H335 - May cause respiratory irritation.';
$pdf->MultiCell(130, 5, '[JUSTIFY] '.$txt."\n", 1, 'J', 1, 2, '' ,'', true);

/*
$x = 115;
$y = 35;
$w = 25;
$h = 50;
for ($i = 0; $i < 3; ++$i) {
	$fitbox = $horizontal_alignments[$i].' ';
	$x = 115;
	for ($j = 0; $j < 3; ++$j) {
		$fitbox[1] = $vertical_alignments[$j];
		$pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,255));
		$pdf->Image('images/GHS01.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
		$x += 27; // new column
	}
	$y += 52; // new row
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
*/
// Stretching, position and alignment example

//$pdf->SetXY(150, 30);
//$pdf->Image('images/GHS01.jpg', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

//$pdf->SetXY(230, 30);
//$pdf->Image('images/GHS01.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
$pdf->SetXY(231, 50);
$pdf->Image('images/'.$firstGhs.'.png', '', '', 45, 45, '', '', '', false, 300, '', false, false, 1, false, false, false);
//$pdf->SetXY(190, 70);
//$pdf->Image('images/GHS01.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
$pdf->SetXY(208, 74);
$pdf->Image('images/'.$secondGhs.'.png', '', '', 45, 45, '', '', '', false, 300, '', false, false, 1, false, false, false);






// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($chemicalName.'_rimpido'.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

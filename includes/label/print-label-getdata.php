   <?php
    $pt = new Chempo();
    $uid  = $_POST['chemicalID'];
    $language1 = $_POST['language1'];
    $language2 = $_POST['language2'];

    $myChoice = $_POST['remember_my_choice'];



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

    $signalWordLang1 = $ch->checkSignalwordIfExist($fLang_signalWord['phrasentext']);
    $signalWordLang2 = $ch->checkSignalwordIfExist($sLang_signalWord['phrasentext']);



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


    ////////////////////////////////////////////////////NOT YET TESTED 8/16/2019
    $hptextbi1_f = $ch->selectFirstPhrasetext($hp1,$language1);
    $hptextbi2_f = $ch->selectFirstPhrasetext($hp2,$language1);
    $hptextbi3_f = $ch->selectFirstPhrasetext($hp3,$language1);
    $hptextbi4_f = $ch->selectFirstPhrasetext($hp4,$language1);
    $hptextbi5_f = $ch->selectFirstPhrasetext($hp5,$language1);
    $hptextbi6_f = $ch->selectFirstPhrasetext($hp6,$language1);

    $hptextbi1_s = $ch->selectSecondPhrasetext($hp1,$language2);
    $hptextbi2_s = $ch->selectSecondPhrasetext($hp2,$language2);
    $hptextbi3_s = $ch->selectSecondPhrasetext($hp3,$language2);
    $hptextbi4_s = $ch->selectSecondPhrasetext($hp4,$language2);
    $hptextbi5_s = $ch->selectSecondPhrasetext($hp5,$language2);
    $hptextbi6_s = $ch->selectSecondPhrasetext($hp6,$language2);

    $hphraseFLang1_f = $hptextbi1_f['pcode1'].' - '.$hptextbi1_f['ptext1'];
    $hphraseFLang1_f = $ch->checkPhrasencodeIfExist($hp1,$hphraseFLang1_f);

    $hphraseFLang2_f = $hptextbi2_f['pcode1'].' - '.$hptextbi2_f['ptext1'];
    $hphraseFLang2_f = $ch->checkPhrasencodeIfExist($hp2,$hphraseFLang2_f);

    $hphraseFLang3_f = $hptextbi3_f['pcode1'].' - '.$hptextbi3_f['ptext1'];
    $hphraseFLang3_f = $ch->checkPhrasencodeIfExist($hp3,$hphraseFLang3_f);

    $hphraseFLang4_f = $hptextbi4_f['pcode1'].' - '.$hptextbi4_f['ptext1'];
    $hphraseFLang4_f = $ch->checkPhrasencodeIfExist($hp4,$hphraseFLang4_f);

    $hphraseFLang5_f = $hptextbi5_f['pcode1'].' - '.$hptextbi5_f['ptext1'];
    $hphraseFLang5_f = $ch->checkPhrasencodeIfExist($hp5,$hphraseFLang5_f);

    $hphraseFLang6_f = $hptextbi6_f['pcode1'].' - '.$hptextbi6_f['ptext1'];
    $hphraseFLang6_f = $ch->checkPhrasencodeIfExist($hp6,$hphraseFLang6_f);

    $hphraseSLang1_s = $hptextbi1_s['pcode2'].' - '.$hptextbi1_s['ptext2'];
    $hphraseSLang1_s = $ch->checkPhrasencodeIfExist($hp1,$hphraseSLang1_s);

    $hphraseSLang2_s = $hptextbi2_s['pcode2'].' - '.$hptextbi2_s['ptext2'];
    $hphraseSLang2_s = $ch->checkPhrasencodeIfExist($hp2,$hphraseSLang2_s);

    $hphraseSLang3_s = $hptextbi3_s['pcode2'].' - '.$hptextbi3_s['ptext2'];
    $hphraseSLang3_s = $ch->checkPhrasencodeIfExist($hp3,$hphraseSLang3_s);

    $hphraseSLang4_s = $hptextbi4_s['pcode2'].' - '.$hptextbi4_s['ptext2'];
    $hphraseSLang4_s = $ch->checkPhrasencodeIfExist($hp4,$hphraseSLang4_s);

    $hphraseSLang5_s = $hptextbi5_s['pcode2'].' - '.$hptextbi5_s['ptext2'];
    $hphraseSLang5_s = $ch->checkPhrasencodeIfExist($hp5,$hphraseSLang5_s);

    $hphraseSLang6_s = $hptextbi6_s['pcode2'].' - '.$hptextbi6_s['ptext2'];
    $hphraseSLang6_s = $ch->checkPhrasencodeIfExist($hp6,$hphraseSLang6_s);



    ////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //General
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

/////////////////////////////////////////////////////////NOT YET DONE (8/15/19)

    //P Phrases - General
    $pptextbi1_f = $ch->selectFirstPhrasetext($pp1,$language1);
    $pptextbi2_f = $ch->selectFirstPhrasetext($pp2,$language1);
    $pptextbi3_f = $ch->selectFirstPhrasetext($pp3,$language1);
    $pptextbi4_f = $ch->selectFirstPhrasetext($pp4,$language1);
    $pptextbi5_f = $ch->selectFirstPhrasetext($pp5,$language1);
    $pptextbi6_f = $ch->selectFirstPhrasetext($pp6,$language1);

    $pptextbi1_s = $ch->selectSecondPhrasetext($pp1,$language2);
    $pptextbi2_s = $ch->selectSecondPhrasetext($pp2,$language2);
    $pptextbi3_s = $ch->selectSecondPhrasetext($pp3,$language2);
    $pptextbi4_s = $ch->selectSecondPhrasetext($pp4,$language2);
    $pptextbi5_s = $ch->selectSecondPhrasetext($pp5,$language2);
    $pptextbi6_s = $ch->selectSecondPhrasetext($pp6,$language2);

    //Prevention
    $pptextbi1_prev_f = $ch->selectFirstPhrasetext($pp1_prev,$language1);
    $pptextbi2_prev_f = $ch->selectFirstPhrasetext($pp2_prev,$language1);
    $pptextbi3_prev_f = $ch->selectFirstPhrasetext($pp3_prev,$language1);
    $pptextbi4_prev_f = $ch->selectFirstPhrasetext($pp4_prev,$language1);
    $pptextbi5_prev_f = $ch->selectFirstPhrasetext($pp5_prev,$language1);
    $pptextbi6_prev_f = $ch->selectFirstPhrasetext($pp6_prev,$language1);

    $pptextbi1_prev_s = $ch->selectSecondPhrasetext($pp1_prev,$language2);
    $pptextbi2_prev_s = $ch->selectSecondPhrasetext($pp2_prev,$language2);
    $pptextbi3_prev_s = $ch->selectSecondPhrasetext($pp3_prev,$language2);
    $pptextbi4_prev_s = $ch->selectSecondPhrasetext($pp4_prev,$language2);
    $pptextbi5_prev_s = $ch->selectSecondPhrasetext($pp5_prev,$language2);
    $pptextbi6_prev_s = $ch->selectSecondPhrasetext($pp6_prev,$language2);

    //Response
    $pptextbi1_resp_f = $ch->selectFirstPhrasetext($pp1_resp,$language1);
    $pptextbi2_resp_f = $ch->selectFirstPhrasetext($pp2_resp,$language1);
    $pptextbi3_resp_f = $ch->selectFirstPhrasetext($pp3_resp,$language1);
    $pptextbi4_resp_f = $ch->selectFirstPhrasetext($pp4_resp,$language1);
    $pptextbi5_resp_f = $ch->selectFirstPhrasetext($pp5_resp,$language1);
    $pptextbi6_resp_f = $ch->selectFirstPhrasetext($pp6_resp,$language1);

    $pptextbi1_resp_s = $ch->selectSecondPhrasetext($pp1_resp,$language2);
    $pptextbi2_resp_s = $ch->selectSecondPhrasetext($pp2_resp,$language2);
    $pptextbi3_resp_s = $ch->selectSecondPhrasetext($pp3_resp,$language2);
    $pptextbi4_resp_s = $ch->selectSecondPhrasetext($pp4_resp,$language2);
    $pptextbi5_resp_s = $ch->selectSecondPhrasetext($pp5_resp,$language2);
    $pptextbi6_resp_s = $ch->selectSecondPhrasetext($pp6_resp,$language2);

    //Storage
    $pptextbi1_storage_f = $ch->selectFirstPhrasetext($pp1_storage,$language1);
    $pptextbi2_storage_f = $ch->selectFirstPhrasetext($pp2_storage,$language1);
    $pptextbi3_storage_f = $ch->selectFirstPhrasetext($pp3_storage,$language1);
    $pptextbi4_storage_f = $ch->selectFirstPhrasetext($pp4_storage,$language1);
    $pptextbi5_storage_f = $ch->selectFirstPhrasetext($pp5_storage,$language1);
    $pptextbi6_storage_f = $ch->selectFirstPhrasetext($pp6_storage,$language1);

    $pptextbi1_storage_s = $ch->selectSecondPhrasetext($pp1_storage,$language2);
    $pptextbi2_storage_s = $ch->selectSecondPhrasetext($pp2_storage,$language2);
    $pptextbi3_storage_s = $ch->selectSecondPhrasetext($pp3_storage,$language2);
    $pptextbi4_storage_s = $ch->selectSecondPhrasetext($pp4_storage,$language2);
    $pptextbi5_storage_s = $ch->selectSecondPhrasetext($pp5_storage,$language2);
    $pptextbi6_storage_s = $ch->selectSecondPhrasetext($pp6_storage,$language2);

    //Disposal
    $pptextbi1_disp_f = $ch->selectFirstPhrasetext($pp1_disp,$language1);
    $pptextbi2_disp_f = $ch->selectFirstPhrasetext($pp2_disp,$language1);
    $pptextbi3_disp_f = $ch->selectFirstPhrasetext($pp3_disp,$language1);
    $pptextbi4_disp_f = $ch->selectFirstPhrasetext($pp4_disp,$language1);
    $pptextbi5_disp_f = $ch->selectFirstPhrasetext($pp5_disp,$language1);
    $pptextbi6_disp_f = $ch->selectFirstPhrasetext($pp6_disp,$language1);

    $pptextbi1_disp_s = $ch->selectSecondPhrasetext($pp1_disp,$language2);
    $pptextbi2_disp_s = $ch->selectSecondPhrasetext($pp1_disp,$language2);
    $pptextbi3_disp_s = $ch->selectSecondPhrasetext($pp1_disp,$language2);
    $pptextbi4_disp_s = $ch->selectSecondPhrasetext($pp1_disp,$language2);
    $pptextbi5_disp_s = $ch->selectSecondPhrasetext($pp1_disp,$language2);
    $pptextbi6_disp_s = $ch->selectSecondPhrasetext($pp1_disp,$language2);

    // Phrasecode - phrasetext (General)
    $pphraseFLang1_f = $pptextbi1_f['pcode1'].' - '.$pptextbi1_f['ptext1'];
    $pphraseFLang1_f = $ch->checkPhrasencodeIfExist($pp1,$pphraseFLang1_f);

    $pphraseFLang2_f = $pptextbi2_f['pcode1'].' - '.$pptextbi2_f['ptext1'];
    $pphraseFLang2_f = $ch->checkPhrasencodeIfExist($pp2,$pphraseFLang2_f);

    $pphraseFLang3_f = $pptextbi3_f['pcode1'].' - '.$pptextbi3_f['ptext1'];
    $pphraseFLang3_f = $ch->checkPhrasencodeIfExist($pp3,$pphraseFLang3_f);

    $pphraseFLang4_f = $pptextbi4_f['pcode1'].' - '.$pptextbi4_f['ptext1'];
    $pphraseFLang4_f = $ch->checkPhrasencodeIfExist($pp4,$pphraseFLang4_f);

    $pphraseFLang5_f = $pptextbi5_f['pcode1'].' - '.$pptextbi5_f['ptext1'];
    $pphraseFLang5_f = $ch->checkPhrasencodeIfExist($pp5,$pphraseFLang5_f);

    $pphraseFLang6_f = $pptextbi6_f['pcode1'].' - '.$pptextbi6_f['ptext1'];
    $pphraseFLang6_f = $ch->checkPhrasencodeIfExist($pp6,$pphraseFLang6_f);

    $pphraseSLang1_s = $pptextbi1_s['pcode2'].' - '.$pptextbi1_s['ptext2'];
    $pphraseSLang1_s = $ch->checkPhrasencodeIfExist($pp1,$pphraseSLang1_s);

    $pphraseSLang2_s = $pptextbi2_s['pcode2'].' - '.$pptextbi2_s['ptext2'];
    $pphraseSLang2_s = $ch->checkPhrasencodeIfExist($pp2,$pphraseSLang2_s);

    $pphraseSLang3_s = $pptextbi3_s['pcode2'].' - '.$pptextbi3_s['ptext2'];
    $pphraseSLang3_s = $ch->checkPhrasencodeIfExist($pp3,$pphraseSLang3_s);

    $pphraseSLang4_s = $pptextbi4_s['pcode2'].' - '.$pptextbi4_s['ptext2'];
    $pphraseSLang4_s = $ch->checkPhrasencodeIfExist($pp4,$pphraseSLang4_s);

    $pphraseSLang5_s = $pptextbi5_s['pcode2'].' - '.$pptextbi5_s['ptext2'];
    $pphraseSLang5_s = $ch->checkPhrasencodeIfExist($pp5,$pphraseSLang5_s);

    $pphraseSLang6_s = $pptextbi6_s['pcode2'].' - '.$pptextbi6_s['ptext2'];
    $pphraseSLang6_s = $ch->checkPhrasencodeIfExist($pp6,$pphraseSLang6_s);

    // Phrasecode - phrasetext (Prevention)
    $pphraseFLang1_prev_f = $pptextbi1_prev_f['pcode1'].' - '.$pptextbi1_prev_f['ptext1'];
    $pphraseFLang1_prev_f = $ch->checkPhrasencodeIfExist($pp1_prev,$pphraseFLang1_prev_f);

    $pphraseFLang2_prev_f = $pptextbi2_prev_f['pcode1'].' - '.$pptextbi2_prev_f['ptext1'];
    $pphraseFLang2_prev_f = $ch->checkPhrasencodeIfExist($pp2_prev,$pphraseFLang2_prev_f);

    $pphraseFLang3_prev_f = $pptextbi3_prev_f['pcode1'].' - '.$pptextbi3_prev_f['ptext1'];
    $pphraseFLang3_prev_f = $ch->checkPhrasencodeIfExist($pp3_prev,$pphraseFLang3_prev_f);

    $pphraseFLang4_prev_f = $pptextbi4_prev_f['pcode1'].' - '.$pptextbi4_prev_f['ptext1'];
    $pphraseFLang4_prev_f = $ch->checkPhrasencodeIfExist($pp4_prev,$pphraseFLang4_prev_f);

    $pphraseFLang5_prev_f = $pptextbi5_prev_f['pcode1'].' - '.$pptextbi5_prev_f['ptext1'];
    $pphraseFLang5_prev_f = $ch->checkPhrasencodeIfExist($pp5_prev,$pphraseFLang5_prev_f);

    $pphraseFLang6_prev_f = $pptextbi6_prev_f['pcode1'].' - '.$pptextbi6_prev_f['ptext1'];
    $pphraseFLang6_prev_f = $ch->checkPhrasencodeIfExist($pp6_prev,$pphraseFLang6_prev_f);

    $pphraseSLang1_prev_s = $pptextbi1_prev_s['pcode2'].' - '.$pptextbi1_prev_s['ptext2'];
    $pphraseSLang1_prev_s = $ch->checkPhrasencodeIfExist($pp1_prev,$pphraseSLang1_prev_s);

    $pphraseSLang2_prev_s = $pptextbi2_prev_s['pcode2'].' - '.$pptextbi2_prev_s['ptext2'];
    $pphraseSLang2_prev_s = $ch->checkPhrasencodeIfExist($pp2_prev,$pphraseSLang2_prev_s);

    $pphraseSLang3_prev_s = $pptextbi3_prev_s['pcode2'].' - '.$pptextbi3_prev_s['ptext2'];
    $pphraseSLang3_prev_s = $ch->checkPhrasencodeIfExist($pp3_prev,$pphraseSLang3_prev_s);

    $pphraseSLang4_prev_s = $pptextbi4_prev_s['pcode2'].' - '.$pptextbi4_prev_s['ptext2'];
    $pphraseSLang4_prev_s = $ch->checkPhrasencodeIfExist($pp4_prev,$pphraseSLang4_prev_s);

    $pphraseSLang5_prev_s = $pptextbi5_prev_s['pcode2'].' - '.$pptextbi5_prev_s['ptext2'];
    $pphraseSLang5_prev_s = $ch->checkPhrasencodeIfExist($pp5_prev,$pphraseSLang5_prev_s);

    $pphraseSLang6_prev_s = $pptextbi6_prev_s['pcode2'].' - '.$pptextbi6_prev_s['ptext2'];
    $pphraseSLang6_prev_s = $ch->checkPhrasencodeIfExist($pp6_prev,$pphraseSLang6_prev_s);

    // Phrasecode - phrasetext (Response)
    $pphraseFLang1_resp_f = $pptextbi1_resp_f['pcode1'].' - '.$pptextbi1_resp_f['ptext1'];
    $pphraseFLang1_resp_f = $ch->checkPhrasencodeIfExist($pp1_resp,$pphraseFLang1_resp_f);

    $pphraseFLang2_resp_f = $pptextbi2_resp_f['pcode1'].' - '.$pptextbi2_resp_f['ptext1'];
    $pphraseFLang2_resp_f = $ch->checkPhrasencodeIfExist($pp2_resp,$pphraseFLang2_resp_f); 

    $pphraseFLang3_resp_f = $pptextbi3_resp_f['pcode1'].' - '.$pptextbi3_resp_f['ptext1'];
    $pphraseFLang3_resp_f = $ch->checkPhrasencodeIfExist($pp3_resp,$pphraseFLang3_resp_f); 

    $pphraseFLang4_resp_f = $pptextbi4_resp_f['pcode1'].' - '.$pptextbi4_resp_f['ptext1'];
    $pphraseFLang4_resp_f = $ch->checkPhrasencodeIfExist($pp4_resp,$pphraseFLang4_resp_f); 

    $pphraseFLang5_resp_f = $pptextbi5_resp_f['pcode1'].' - '.$pptextbi5_resp_f['ptext1'];
    $pphraseFLang5_resp_f = $ch->checkPhrasencodeIfExist($pp5_resp,$pphraseFLang5_resp_f);

    $pphraseFLang6_resp_f = $pptextbi6_resp_f['pcode1'].' - '.$pptextbi6_resp_f['ptext1'];
    $pphraseFLang6_resp_f = $ch->checkPhrasencodeIfExist($pp6_resp,$pphraseFLang6_resp_f);

    $pphraseSLang1_resp_s = $pptextbi1_resp_s['pcode2'].' - '.$pptextbi1_resp_s['ptext2'];
    $pphraseSLang1_resp_s = $ch->checkPhrasencodeIfExist($pp1_resp,$pphraseSLang1_resp_s);

    $pphraseSLang2_resp_s = $pptextbi2_resp_s['pcode2'].' - '.$pptextbi2_resp_s['ptext2'];
    $pphraseSLang2_resp_s = $ch->checkPhrasencodeIfExist($pp2_resp,$pphraseSLang2_resp_s);

    $pphraseSLang3_resp_s = $pptextbi3_resp_s['pcode2'].' - '.$pptextbi3_resp_s['ptext2'];
    $pphraseSLang3_resp_s = $ch->checkPhrasencodeIfExist($pp3_resp,$pphraseSLang3_resp_s);

    $pphraseSLang4_resp_s = $pptextbi4_resp_s['pcode2'].' - '.$pptextbi4_resp_s['ptext2'];
    $pphraseSLang4_resp_s = $ch->checkPhrasencodeIfExist($pp4_resp,$pphraseSLang4_resp_s);

    $pphraseSLang5_resp_s = $pptextbi5_resp_s['pcode2'].' - '.$pptextbi5_resp_s['ptext2'];
    $pphraseSLang5_resp_s = $ch->checkPhrasencodeIfExist($pp5_resp,$pphraseSLang5_resp_s);

    $pphraseSLang6_resp_s = $pptextbi6_resp_s['pcode2'].' - '.$pptextbi6_resp_s['ptext2'];
    $pphraseSLang6_resp_s = $ch->checkPhrasencodeIfExist($pp6_resp,$pphraseSLang6_resp_s);

    // Phrasecode - phrasetext (Storage)
    $pphraseFLang1_storage_f = $pptextbi1_storage_f['pcode1'].' - '.$pptextbi1_storage_f['ptext1'];
    $pphraseFLang1_storage_f = $ch->checkPhrasencodeIfExist($pp1_storage,$pphraseFLang1_storage_f);

    $pphraseFLang2_storage_f = $pptextbi2_storage_f['pcode1'].' - '.$pptextbi2_storage_f['ptext1'];
    $pphraseFLang2_storage_f = $ch->checkPhrasencodeIfExist($pp2_storage,$pphraseFLang2_storage_f);

    $pphraseFLang3_storage_f = $pptextbi3_storage_f['pcode1'].' - '.$pptextbi3_storage_f['ptext1'];
    $pphraseFLang3_storage_f = $ch->checkPhrasencodeIfExist($pp3_storage,$pphraseFLang3_storage_f);

    $pphraseFLang4_storage_f = $pptextbi4_storage_f['pcode1'].' - '.$pptextbi4_storage_f['ptext1'];
    $pphraseFLang4_storage_f = $ch->checkPhrasencodeIfExist($pp4_storage,$pphraseFLang4_storage_f);

    $pphraseFLang5_storage_f = $pptextbi5_storage_f['pcode1'].' - '.$pptextbi5_storage_f['ptext1'];
    $pphraseFLang5_storage_f = $ch->checkPhrasencodeIfExist($pp5_storage,$pphraseFLang5_storage_f);

    $pphraseFLang6_storage_f = $pptextbi6_storage_f['pcode1'].' - '.$pptextbi6_storage_f['ptext1'];
    $pphraseFLang6_storage_f = $ch->checkPhrasencodeIfExist($pp6_storage,$pphraseFLang6_storage_f);

    $pphraseSLang1_storage_s = $pptextbi1_storage_s['pcode2'].' - '.$pptextbi1_storage_s['ptext2'];
    $pphraseSLang1_storage_s = $ch->checkPhrasencodeIfExist($pp1_storage,$pphraseSLang1_storage_s);

    $pphraseSLang2_storage_s = $pptextbi2_storage_s['pcode2'].' - '.$pptextbi2_storage_s['ptext2'];
    $pphraseSLang2_storage_s = $ch->checkPhrasencodeIfExist($pp2_storage,$pphraseSLang2_storage_s);

    $pphraseSLang3_storage_s = $pptextbi3_storage_s['pcode2'].' - '.$pptextbi3_storage_s['ptext2'];
    $pphraseSLang3_storage_s = $ch->checkPhrasencodeIfExist($pp3_storage,$pphraseSLang3_storage_s);

    $pphraseSLang4_storage_s = $pptextbi4_storage_s['pcode2'].' - '.$pptextbi4_storage_s['ptext2'];
    $pphraseSLang4_storage_s = $ch->checkPhrasencodeIfExist($pp4_storage,$pphraseSLang4_storage_s);

    $pphraseSLang5_storage_s = $pptextbi5_storage_s['pcode2'].' - '.$pptextbi5_storage_s['ptext2'];
    $pphraseSLang5_storage_s = $ch->checkPhrasencodeIfExist($pp5_storage,$pphraseSLang5_storage_s);

    $pphraseSLang6_storage_s = $pptextbi6_storage_s['pcode2'].' - '.$pptextbi6_storage_s['ptext2'];
    $pphraseSLang6_storage_s = $ch->checkPhrasencodeIfExist($pp6_storage,$pphraseSLang6_storage_s);

    // Phrasecode - phrasetext (Storage)
    $pphraseFLang1_disp_f = $pptextbi1_disp_f['pcode1'].' - '.$pptextbi1_disp_f['ptext1'];
    $pphraseFLang1_disp_f = $ch->checkPhrasencodeIfExist($pp1_disp,$pphraseFLang1_disp_f);

    $pphraseFLang2_disp_f = $pptextbi2_disp_f['pcode1'].' - '.$pptextbi2_disp_f['ptext1'];
    $pphraseFLang2_disp_f = $ch->checkPhrasencodeIfExist($pp2_disp,$pphraseFLang2_disp_f);

    $pphraseFLang3_disp_f = $pptextbi3_disp_f['pcode1'].' - '.$pptextbi3_disp_f['ptext1'];
    $pphraseFLang3_disp_f = $ch->checkPhrasencodeIfExist($pp3_disp,$pphraseFLang3_disp_f);

    $pphraseFLang4_disp_f = $pptextbi4_disp_f['pcode1'].' - '.$pptextbi4_disp_f['ptext1'];
    $pphraseFLang4_disp_f = $ch->checkPhrasencodeIfExist($pp4_disp,$pphraseFLang4_disp_f);

    $pphraseFLang5_disp_f = $pptextbi5_disp_f['pcode1'].' - '.$pptextbi5_disp_f['ptext1'];
    $pphraseFLang5_disp_f = $ch->checkPhrasencodeIfExist($pp5_disp,$pphraseFLang5_disp_f);

    $pphraseFLang6_disp_f = $pptextbi6_disp_f['pcode1'].' - '.$pptextbi6_disp_f['ptext1'];
    $pphraseFLang6_disp_f = $ch->checkPhrasencodeIfExist($pp6_disp,$pphraseFLang6_disp_f);

    $pphraseSLang1_disp_s = $pptextbi1_disp_s['pcode2'].' - '.$pptextbi1_disp_s['ptext2'];
    $pphraseSLang1_disp_s = $ch->checkPhrasencodeIfExist($pp1_disp,$pphraseSLang1_disp_s);

    $pphraseSLang2_disp_s = $pptextbi2_disp_s['pcode2'].' - '.$pptextbi2_disp_s['ptext2'];
    $pphraseSLang2_disp_s = $ch->checkPhrasencodeIfExist($pp2_disp,$pphraseSLang2_disp_s);

    $pphraseSLang3_disp_s = $pptextbi3_disp_s['pcode2'].' - '.$pptextbi3_disp_s['ptext2'];
    $pphraseSLang3_disp_s = $ch->checkPhrasencodeIfExist($pp3_disp,$pphraseSLang3_disp_s);

    $pphraseSLang4_disp_s = $pptextbi4_disp_s['pcode2'].' - '.$pptextbi4_disp_s['ptext2'];
    $pphraseSLang4_disp_s = $ch->checkPhrasencodeIfExist($pp4_disp,$pphraseSLang4_disp_s);

    $pphraseSLang5_disp_s = $pptextbi5_disp_s['pcode2'].' - '.$pptextbi5_disp_s['ptext2'];
    $pphraseSLang5_disp_s = $ch->checkPhrasencodeIfExist($pp5_disp,$pphraseSLang5_disp_s);

    $pphraseSLang6_disp_s = $pptextbi6_disp_s['pcode2'].' - '.$pptextbi6_disp_s['ptext2'];
    $pphraseSLang6_disp_s = $ch->checkPhrasencodeIfExist($pp6_disp,$pphraseSLang6_disp_s);
/*
    $ch = new Chempo();
    $temp = "_f";


    
        for($ptext=1;$ptext<=6;$ptext++)
        {

            $ptextToStr = (String)$ptext;
            $phrasetext = $ch->checkPhrasencodeIfExist($$hptextbi1_f.$ptextToStr.$temp); 
            if($phrasetext == "NONE")
            {
                $$hptextbi1_f.$ptextToStr.$temp = "There is no available phrasetext for this language!";
            }
            else
            {
                $$hptextbi1_f.$ptextToStr.$temp = $$hptextbi1_f.$ptextToStr.$temp;
            }


        }
*/
    






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
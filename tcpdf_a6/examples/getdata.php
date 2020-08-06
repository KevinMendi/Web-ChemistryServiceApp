<?php

    $uid = $_GET['print_id'];
    $chemicalName = $_GET['chem_name'];
    $casNo = $_GET['cas_no'];
    $unNo = $_GET['un_no'];

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

    $ppSLang1_prev = $_GET['psl1_prev'];
    $ppSLang2_prev = $_GET['psl2_prev'];
    $ppSLang3_prev = $_GET['psl3_prev'];
    $ppSLang4_prev = $_GET['psl4_prev'];
    $ppSLang5_prev = $_GET['psl5_prev'];
    $ppSLang6_prev = $_GET['psl6_prev'];

    //Response
    $ppFLang1_resp = $_GET['pfl1_resp'];
    $ppFLang2_resp = $_GET['pfl2_resp'];
    $ppFLang3_resp = $_GET['pfl3_resp'];
    $ppFLang4_resp = $_GET['pfl4_resp'];
    $ppFLang5_resp = $_GET['pfl5_resp'];
    $ppFLang6_resp = $_GET['pfl6_resp'];

    $ppSLang1_resp = $_GET['psl1_resp'];
    $ppSLang2_resp = $_GET['psl2_resp'];
    $ppSLang3_resp = $_GET['psl3_resp'];
    $ppSLang4_resp = $_GET['psl4_resp'];
    $ppSLang5_resp = $_GET['psl5_resp'];
    $ppSLang6_resp = $_GET['psl6_resp'];

    //Storage
    $ppFLang1_storage = $_GET['pfl1_storage'];
    $ppFLang2_storage = $_GET['pfl2_storage'];
    $ppFLang3_storage = $_GET['pfl3_storage'];
    $ppFLang4_storage = $_GET['pfl4_storage'];
    $ppFLang5_storage = $_GET['pfl5_storage'];
    $ppFLang6_storage = $_GET['pfl6_storage'];

    $ppSLang1_storage = $_GET['psl1_storage'];
    $ppSLang2_storage = $_GET['psl2_storage'];
    $ppSLang3_storage = $_GET['psl3_storage'];
    $ppSLang4_storage = $_GET['psl4_storage'];
    $ppSLang5_storage = $_GET['psl5_storage'];
    $ppSLang6_storage = $_GET['psl6_storage'];

    //Disposal
    $ppFLang1_disp = $_GET['pfl1_disp'];
    $ppFLang2_disp = $_GET['pfl2_disp'];
    $ppFLang3_disp = $_GET['pfl3_disp'];
    $ppFLang4_disp = $_GET['pfl4_disp'];
    $ppFLang5_disp = $_GET['pfl5_disp'];
    $ppFLang6_disp = $_GET['pfl6_disp'];

    $ppSLang1_disp = $_GET['psl1_disp'];
    $ppSLang2_disp = $_GET['psl2_disp'];
    $ppSLang3_disp = $_GET['psl3_disp'];
    $ppSLang4_disp = $_GET['psl4_disp'];
    $ppSLang5_disp = $_GET['psl5_disp'];
    $ppSLang6_disp = $_GET['psl6_disp'];

     $lang1 = $_GET['lang1'];
    $lang1 = strtoupper($lang1);
    $lang2 = $_GET['lang2'];
    $lang2 = strtoupper($lang2);
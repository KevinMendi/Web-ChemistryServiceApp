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


//////////////////////////////////////////////////////////////////////////A6
if (isset($_POST['A6-Size'])) {
    include_once('includes/label/print-label-getdata.php');

      
      if(isset($_POST['remember_my_choice']))
      {
            include_once('includes/label/setcookie.php');
      }
  



//echo $count;
if($count == 1)
{
        
header("Location:tcpdf_a6/examples/test_1.php?print_id=".rawurlencode($uid).
            "&chem_name=".rawurlencode($chemicalName).
            "&cas_no=".rawurlencode($casNo).
            "&un_no=".rawurlencode($unNo).
            "&signal_word=".rawurlencode($signalWordVal).
            "&fghs=".rawurlencode($withGhs[0]).
            //"&sghs=".urldecode($withGhs[1]).
            //"&tghs=".urldecode($withGhs[2]).
            //"&ftghs=".urldecode($withGhs[3]).
            //"&fifghs=".urldecode($withGhs[4]).
            //"&sixghs=".urldecode($withGhs[5]).
            "&lang1=".rawurlencode($fLang_lang['lang']).
            "&lang2=".rawurlencode($sLang_lang['lang']).
            /*
            "&hp1=".urldecode($hphrase1).
            "&hp2=".urldecode($hphrase2).
            "&hp3=".urldecode($hphrase3).
            "&hp4=".urldecode($hphrase4).
            "&hp5=".urldecode($hphrase5).
            "&hp6=".urldecode($hphrase6).
            "&pp1=".urldecode($pphrase1).
            "&pp2=".urldecode($pphrase2).
            "&pp3=".urldecode($pphrase3).
            "&pp4=".urldecode($pphrase4).
            "&pp5=".urldecode($pphrase5).
            "&pp6=".urldecode($pphrase6).
            */
            "&fl1=".rawurlencode($hphraseFLang1_f).
            "&fl2=".rawurlencode($hphraseFLang2_f).
            "&fl3=".rawurlencode($hphraseFLang3_f).
            "&fl4=".rawurlencode($hphraseFLang4_f).
            "&fl5=".rawurlencode($hphraseFLang5_f).
            "&fl6=".rawurlencode($hphraseFLang6_f).
            "&sl1=".rawurlencode($hphraseSLang1_s).
            "&sl2=".rawurlencode($hphraseSLang2_s).
            "&sl3=".rawurlencode($hphraseSLang3_s).
            "&sl4=".rawurlencode($hphraseSLang4_s).
            "&sl5=".rawurlencode($hphraseSLang5_s).
            "&sl6=".rawurlencode($hphraseSLang6_s).
            "&pfl1=".rawurlencode($pphraseFLang1_f).
            "&pfl2=".rawurlencode($pphraseFLang2_f).
            "&pfl3=".rawurlencode($pphraseFLang3_f).
            "&pfl4=".rawurlencode($pphraseFLang4_f).
            "&pfl5=".rawurlencode($pphraseFLang5_f).
            "&pfl6=".rawurlencode($pphraseFLang6_f).
            "&psl1=".rawurlencode($pphraseSLang1_s).
            "&psl2=".rawurlencode($pphraseSLang2_s).
            "&psl3=".rawurlencode($pphraseSLang3_s).
            "&psl4=".rawurlencode($pphraseSLang4_s).
            "&psl5=".rawurlencode($pphraseSLang5_s).
            "&psl6=".rawurlencode($pphraseSLang6_s).
            //Prevention
            "&pfl1_prev=".rawurlencode($pphraseFLang1_prev_f).
            "&pfl2_prev=".rawurlencode($pphraseFLang2_prev_f).
            "&pfl3_prev=".rawurlencode($pphraseFLang3_prev_f).
            "&pfl4_prev=".rawurlencode($pphraseFLang4_prev_f).
            "&pfl5_prev=".rawurlencode($pphraseFLang5_prev_f).
            "&pfl6_prev=".rawurlencode($pphraseFLang6_prev_f).

            "&psl1_prev=".rawurlencode($pphraseSLang1_prev_s).
            "&psl2_prev=".rawurlencode($pphraseSLang2_prev_s).
            "&psl3_prev=".rawurlencode($pphraseSLang3_prev_s).
            "&psl4_prev=".rawurlencode($pphraseSLang4_prev_s).
            "&psl5_prev=".rawurlencode($pphraseSLang5_prev_s).
            "&psl6_prev=".rawurlencode($pphraseSLang6_prev_s).
            //Response
            "&pfl1_resp=".rawurlencode($pphraseFLang1_resp_f).
            "&pfl2_resp=".rawurlencode($pphraseFLang2_resp_f).
            "&pfl3_resp=".rawurlencode($pphraseFLang3_resp_f).
            "&pfl4_resp=".rawurlencode($pphraseFLang4_resp_f).
            "&pfl5_resp=".rawurlencode($pphraseFLang5_resp_f).
            "&pfl6_resp=".rawurlencode($pphraseFLang6_resp_f).

            "&psl1_resp=".rawurlencode($pphraseSLang1_resp_s).
            "&psl2_resp=".rawurlencode($pphraseSLang2_resp_s).
            "&psl3_resp=".rawurlencode($pphraseSLang3_resp_s).
            "&psl4_resp=".rawurlencode($pphraseSLang4_resp_s).
            "&psl5_resp=".rawurlencode($pphraseSLang5_resp_s).
            "&psl6_resp=".rawurlencode($pphraseSLang6_resp_s).
            //Storage
            "&pfl1_storage=".rawurlencode($pphraseFLang1_storage_f).
            "&pfl2_storage=".rawurlencode($pphraseFLang2_storage_f).
            "&pfl3_storage=".rawurlencode($pphraseFLang3_storage_f).
            "&pfl4_storage=".rawurlencode($pphraseFLang4_storage_f).
            "&pfl5_storage=".rawurlencode($pphraseFLang5_storage_f).
            "&pfl6_storage=".rawurlencode($pphraseFLang6_storage_f).

            "&psl1_storage=".rawurlencode($pphraseSLang1_storage_s).
            "&psl2_storage=".rawurlencode($pphraseSLang2_storage_s).
            "&psl3_storage=".rawurlencode($pphraseSLang3_storage_s).
            "&psl4_storage=".rawurlencode($pphraseSLang4_storage_s).
            "&psl5_storage=".rawurlencode($pphraseSLang5_storage_s).
            "&psl6_storage=".rawurlencode($pphraseSLang6_storage_s).
            //Disposal
            "&pfl1_disp=".rawurlencode($pphraseFLang1_disp_f).
            "&pfl2_disp=".rawurlencode($pphraseFLang2_disp_f).
            "&pfl3_disp=".rawurlencode($pphraseFLang3_disp_f).
            "&pfl4_disp=".rawurlencode($pphraseFLang4_disp_f).
            "&pfl5_disp=".rawurlencode($pphraseFLang5_disp_f).
            "&pfl6_disp=".rawurlencode($pphraseFLang6_disp_f).

            "&psl1_disp=".rawurlencode($pphraseSLang1_disp_s).
            "&psl2_disp=".rawurlencode($pphraseSLang2_disp_s).
            "&psl3_disp=".rawurlencode($pphraseSLang3_disp_s).
            "&psl4_disp=".rawurlencode($pphraseSLang4_disp_s).
            "&psl5_disp=".rawurlencode($pphraseSLang5_disp_s).
            "&psl6_disp=".rawurlencode($pphraseSLang6_disp_s).


            "&sw1=".rawurlencode($signalWordLang1).
            "&sw2=".rawurlencode($signalWordLang2));

}
//Added 7/2/19
else if($count == 2)
{
    /*
    header("Location:tcpdf_a6/examples/test_2_try.php?print_id=".rawurlencode($uid).
            "&chem_name=".rawurlencode($chemicalName).
            "&cas_no=".rawurlencode($casNo).
            "&un_no=".rawurlencode($unNo).
            "&signal_word=".rawurlencode($signalWordVal).
            "&fghs=".rawurlencode($withGhs[0]).
            "&sghs=".rawurlencode($withGhs[1]).
            //"&tghs=".urldecode($withGhs[2]).
            //"&ftghs=".urldecode($withGhs[3]).
            //"&fifghs=".urldecode($withGhs[4]).
            //"&sixghs=".urldecode($withGhs[5]).
            "&lang1=".rawurlencode($fLang_lang['lang']).
            "&lang2=".rawurlencode($sLang_lang['lang']).
          
             "&fl1=".rawurlencode($hphraseFLang1_f).
            "&fl2=".rawurlencode($hphraseFLang2_f).
            "&fl3=".rawurlencode($hphraseFLang3_f).
            "&fl4=".rawurlencode($hphraseFLang4_f).
            "&fl5=".rawurlencode($hphraseFLang5_f).
            "&fl6=".rawurlencode($hphraseFLang6_f).
            "&sl1=".rawurlencode($hphraseSLang1_s).
            "&sl2=".rawurlencode($hphraseSLang2_s).
            "&sl3=".rawurlencode($hphraseSLang3_s).
            "&sl4=".rawurlencode($hphraseSLang4_s).
            "&sl5=".rawurlencode($hphraseSLang5_s).
            "&sl6=".rawurlencode($hphraseSLang6_s).
            "&pfl1=".rawurlencode($pphraseFLang1_f).
            "&pfl2=".rawurlencode($pphraseFLang2_f).
            "&pfl3=".rawurlencode($pphraseFLang3_f).
            "&pfl4=".rawurlencode($pphraseFLang4_f).
            "&pfl5=".rawurlencode($pphraseFLang5_f).
            "&pfl6=".rawurlencode($pphraseFLang6_f).
            "&psl1=".rawurlencode($pphraseSLang1_s).
            "&psl2=".rawurlencode($pphraseSLang2_s).
            "&psl3=".rawurlencode($pphraseSLang3_s).
            "&psl4=".rawurlencode($pphraseSLang4_s).
            "&psl5=".rawurlencode($pphraseSLang5_s).
            "&psl6=".rawurlencode($pphraseSLang6_s).
            //Prevention
            "&pfl1_prev=".rawurlencode($pphraseFLang1_prev_f).
            "&pfl2_prev=".rawurlencode($pphraseFLang2_prev_f).
            "&pfl3_prev=".rawurlencode($pphraseFLang3_prev_f).
            "&pfl4_prev=".rawurlencode($pphraseFLang4_prev_f).
            "&pfl5_prev=".rawurlencode($pphraseFLang5_prev_f).
            "&pfl6_prev=".rawurlencode($pphraseFLang6_prev_f).

            "&psl1_prev=".rawurlencode($pphraseSLang1_prev_s).
            "&psl2_prev=".rawurlencode($pphraseSLang2_prev_s).
            "&psl3_prev=".rawurlencode($pphraseSLang3_prev_s).
            "&psl4_prev=".rawurlencode($pphraseSLang4_prev_s).
            "&psl5_prev=".rawurlencode($pphraseSLang5_prev_s).
            "&psl6_prev=".rawurlencode($pphraseSLang6_prev_s).
            //Response
            "&pfl1_resp=".rawurlencode($pphraseFLang1_resp_f).
            "&pfl2_resp=".rawurlencode($pphraseFLang2_resp_f).
            "&pfl3_resp=".rawurlencode($pphraseFLang3_resp_f).
            "&pfl4_resp=".rawurlencode($pphraseFLang4_resp_f).
            "&pfl5_resp=".rawurlencode($pphraseFLang5_resp_f).
            "&pfl6_resp=".rawurlencode($pphraseFLang6_resp_f).

            "&psl1_resp=".rawurlencode($pphraseSLang1_resp_s).
            "&psl2_resp=".rawurlencode($pphraseSLang2_resp_s).
            "&psl3_resp=".rawurlencode($pphraseSLang3_resp_s).
            "&psl4_resp=".rawurlencode($pphraseSLang4_resp_s).
            "&psl5_resp=".rawurlencode($pphraseSLang5_resp_s).
            "&psl6_resp=".rawurlencode($pphraseSLang6_resp_s).
            //Storage
            "&pfl1_storage=".rawurlencode($pphraseFLang1_storage_f).
            "&pfl2_storage=".rawurlencode($pphraseFLang2_storage_f).
            "&pfl3_storage=".rawurlencode($pphraseFLang3_storage_f).
            "&pfl4_storage=".rawurlencode($pphraseFLang4_storage_f).
            "&pfl5_storage=".rawurlencode($pphraseFLang5_storage_f).
            "&pfl6_storage=".rawurlencode($pphraseFLang6_storage_f).

            "&psl1_storage=".rawurlencode($pphraseSLang1_storage_s).
            "&psl2_storage=".rawurlencode($pphraseSLang2_storage_s).
            "&psl3_storage=".rawurlencode($pphraseSLang3_storage_s).
            "&psl4_storage=".rawurlencode($pphraseSLang4_storage_s).
            "&psl5_storage=".rawurlencode($pphraseSLang5_storage_s).
            "&psl6_storage=".rawurlencode($pphraseSLang6_storage_s).
            //Disposal
            "&pfl1_disp=".rawurlencode($pphraseFLang1_disp_f).
            "&pfl2_disp=".rawurlencode($pphraseFLang2_disp_f).
            "&pfl3_disp=".rawurlencode($pphraseFLang3_disp_f).
            "&pfl4_disp=".rawurlencode($pphraseFLang4_disp_f).
            "&pfl5_disp=".rawurlencode($pphraseFLang5_disp_f).
            "&pfl6_disp=".rawurlencode($pphraseFLang6_disp_f).

            "&psl1_disp=".rawurlencode($pphraseSLang1_disp_s).
            "&psl2_disp=".rawurlencode($pphraseSLang2_disp_s).
            "&psl3_disp=".rawurlencode($pphraseSLang3_disp_s).
            "&psl4_disp=".rawurlencode($pphraseSLang4_disp_s).
            "&psl5_disp=".rawurlencode($pphraseSLang5_disp_s).
            "&psl6_disp=".rawurlencode($pphraseSLang6_disp_s).


            "&sw1=".rawurlencode($signalWordLang1).
            "&sw2=".rawurlencode($signalWordLang2));

*/

echo "string";

}
else if($count == 3)
{
  header("Location:tcpdf_a6/examples/test_3.php?print_id=".rawurlencode($uid).
            "&chem_name=".rawurlencode($chemicalName).
            "&cas_no=".rawurlencode($casNo).
            "&un_no=".rawurlencode($unNo).
            "&signal_word=".rawurlencode($signalWordVal).
            "&fghs=".rawurlencode($withGhs[0]).
            "&sghs=".rawurlencode($withGhs[1]).
            "&tghs=".rawurlencode($withGhs[2]).
            //"&ftghs=".urldecode($withGhs[3]).
            //"&fifghs=".urldecode($withGhs[4]).
            //"&sixghs=".urldecode($withGhs[5]).
            "&lang1=".rawurlencode($fLang_lang['lang']).
            "&lang2=".rawurlencode($sLang_lang['lang']).
            /*
            "&hp1=".urldecode($hphrase1).
            "&hp2=".urldecode($hphrase2).
            "&hp3=".urldecode($hphrase3).
            "&hp4=".urldecode($hphrase4).
            "&hp5=".urldecode($hphrase5).
            "&hp6=".urldecode($hphrase6).
            "&pp1=".urldecode($pphrase1).
            "&pp2=".urldecode($pphrase2).
            "&pp3=".urldecode($pphrase3).
            "&pp4=".urldecode($pphrase4).
            "&pp5=".urldecode($pphrase5).
            "&pp6=".urldecode($pphrase6).
            */
            "&fl1=".rawurlencode($hphraseFLang1_f).
            "&fl2=".rawurlencode($hphraseFLang2_f).
            "&fl3=".rawurlencode($hphraseFLang3_f).
            "&fl4=".rawurlencode($hphraseFLang4_f).
            "&fl5=".rawurlencode($hphraseFLang5_f).
            "&fl6=".rawurlencode($hphraseFLang6_f).
            "&sl1=".rawurlencode($hphraseSLang1_s).
            "&sl2=".rawurlencode($hphraseSLang2_s).
            "&sl3=".rawurlencode($hphraseSLang3_s).
            "&sl4=".rawurlencode($hphraseSLang4_s).
            "&sl5=".rawurlencode($hphraseSLang5_s).
            "&sl6=".rawurlencode($hphraseSLang6_s).
            "&pfl1=".rawurlencode($pphraseFLang1_f).
            "&pfl2=".rawurlencode($pphraseFLang2_f).
            "&pfl3=".rawurlencode($pphraseFLang3_f).
            "&pfl4=".rawurlencode($pphraseFLang4_f).
            "&pfl5=".rawurlencode($pphraseFLang5_f).
            "&pfl6=".rawurlencode($pphraseFLang6_f).
            "&psl1=".rawurlencode($pphraseSLang1_s).
            "&psl2=".rawurlencode($pphraseSLang2_s).
            "&psl3=".rawurlencode($pphraseSLang3_s).
            "&psl4=".rawurlencode($pphraseSLang4_s).
            "&psl5=".rawurlencode($pphraseSLang5_s).
            "&psl6=".rawurlencode($pphraseSLang6_s).
            //Prevention
            "&pfl1_prev=".rawurlencode($pphraseFLang1_prev_f).
            "&pfl2_prev=".rawurlencode($pphraseFLang2_prev_f).
            "&pfl3_prev=".rawurlencode($pphraseFLang3_prev_f).
            "&pfl4_prev=".rawurlencode($pphraseFLang4_prev_f).
            "&pfl5_prev=".rawurlencode($pphraseFLang5_prev_f).
            "&pfl6_prev=".rawurlencode($pphraseFLang6_prev_f).

            "&psl1_prev=".rawurlencode($pphraseSLang1_prev_s).
            "&psl2_prev=".rawurlencode($pphraseSLang2_prev_s).
            "&psl3_prev=".rawurlencode($pphraseSLang3_prev_s).
            "&psl4_prev=".rawurlencode($pphraseSLang4_prev_s).
            "&psl5_prev=".rawurlencode($pphraseSLang5_prev_s).
            "&psl6_prev=".rawurlencode($pphraseSLang6_prev_s).
            //Response
            "&pfl1_resp=".rawurlencode($pphraseFLang1_resp_f).
            "&pfl2_resp=".rawurlencode($pphraseFLang2_resp_f).
            "&pfl3_resp=".rawurlencode($pphraseFLang3_resp_f).
            "&pfl4_resp=".rawurlencode($pphraseFLang4_resp_f).
            "&pfl5_resp=".rawurlencode($pphraseFLang5_resp_f).
            "&pfl6_resp=".rawurlencode($pphraseFLang6_resp_f).

            "&psl1_resp=".rawurlencode($pphraseSLang1_resp_s).
            "&psl2_resp=".rawurlencode($pphraseSLang2_resp_s).
            "&psl3_resp=".rawurlencode($pphraseSLang3_resp_s).
            "&psl4_resp=".rawurlencode($pphraseSLang4_resp_s).
            "&psl5_resp=".rawurlencode($pphraseSLang5_resp_s).
            "&psl6_resp=".rawurlencode($pphraseSLang6_resp_s).
            //Storage
            "&pfl1_storage=".rawurlencode($pphraseFLang1_storage_f).
            "&pfl2_storage=".rawurlencode($pphraseFLang2_storage_f).
            "&pfl3_storage=".rawurlencode($pphraseFLang3_storage_f).
            "&pfl4_storage=".rawurlencode($pphraseFLang4_storage_f).
            "&pfl5_storage=".rawurlencode($pphraseFLang5_storage_f).
            "&pfl6_storage=".rawurlencode($pphraseFLang6_storage_f).

            "&psl1_storage=".rawurlencode($pphraseSLang1_storage_s).
            "&psl2_storage=".rawurlencode($pphraseSLang2_storage_s).
            "&psl3_storage=".rawurlencode($pphraseSLang3_storage_s).
            "&psl4_storage=".rawurlencode($pphraseSLang4_storage_s).
            "&psl5_storage=".rawurlencode($pphraseSLang5_storage_s).
            "&psl6_storage=".rawurlencode($pphraseSLang6_storage_s).
            //Disposal
            "&pfl1_disp=".rawurlencode($pphraseFLang1_disp_f).
            "&pfl2_disp=".rawurlencode($pphraseFLang2_disp_f).
            "&pfl3_disp=".rawurlencode($pphraseFLang3_disp_f).
            "&pfl4_disp=".rawurlencode($pphraseFLang4_disp_f).
            "&pfl5_disp=".rawurlencode($pphraseFLang5_disp_f).
            "&pfl6_disp=".rawurlencode($pphraseFLang6_disp_f).

            "&psl1_disp=".rawurlencode($pphraseSLang1_disp_s).
            "&psl2_disp=".rawurlencode($pphraseSLang2_disp_s).
            "&psl3_disp=".rawurlencode($pphraseSLang3_disp_s).
            "&psl4_disp=".rawurlencode($pphraseSLang4_disp_s).
            "&psl5_disp=".rawurlencode($pphraseSLang5_disp_s).
            "&psl6_disp=".rawurlencode($pphraseSLang6_disp_s).


            "&sw1=".rawurlencode($signalWordLang1).
            "&sw2=".rawurlencode($signalWordLang2));

}
else if($count == 4)
{
        header("Location:tcpdf_a6/examples/test_4.php?print_id=".rawurlencode($uid).
            "&chem_name=".rawurlencode($chemicalName).
            "&cas_no=".rawurlencode($casNo).
            "&un_no=".rawurlencode($unNo).
            "&signal_word=".rawurlencode($signalWordVal).
            "&fghs=".rawurlencode($withGhs[0]).
            "&sghs=".rawurlencode($withGhs[1]).
            "&tghs=".rawurlencode($withGhs[2]).
            "&ftghs=".rawurlencode($withGhs[3]).
            //"&fifghs=".urldecode($withGhs[4]).
            //"&sixghs=".urldecode($withGhs[5]).
            "&lang1=".rawurlencode($fLang_lang['lang']).
            "&lang2=".rawurlencode($sLang_lang['lang']).
            /*
            "&hp1=".urldecode($hphrase1).
            "&hp2=".urldecode($hphrase2).
            "&hp3=".urldecode($hphrase3).
            "&hp4=".urldecode($hphrase4).
            "&hp5=".urldecode($hphrase5).
            "&hp6=".urldecode($hphrase6).
            "&pp1=".urldecode($pphrase1).
            "&pp2=".urldecode($pphrase2).
            "&pp3=".urldecode($pphrase3).
            "&pp4=".urldecode($pphrase4).
            "&pp5=".urldecode($pphrase5).
            "&pp6=".urldecode($pphrase6).
            */
             "&fl1=".rawurlencode($hphraseFLang1_f).
            "&fl2=".rawurlencode($hphraseFLang2_f).
            "&fl3=".rawurlencode($hphraseFLang3_f).
            "&fl4=".rawurlencode($hphraseFLang4_f).
            "&fl5=".rawurlencode($hphraseFLang5_f).
            "&fl6=".rawurlencode($hphraseFLang6_f).
            "&sl1=".rawurlencode($hphraseSLang1_s).
            "&sl2=".rawurlencode($hphraseSLang2_s).
            "&sl3=".rawurlencode($hphraseSLang3_s).
            "&sl4=".rawurlencode($hphraseSLang4_s).
            "&sl5=".rawurlencode($hphraseSLang5_s).
            "&sl6=".rawurlencode($hphraseSLang6_s).
            "&pfl1=".rawurlencode($pphraseFLang1_f).
            "&pfl2=".rawurlencode($pphraseFLang2_f).
            "&pfl3=".rawurlencode($pphraseFLang3_f).
            "&pfl4=".rawurlencode($pphraseFLang4_f).
            "&pfl5=".rawurlencode($pphraseFLang5_f).
            "&pfl6=".rawurlencode($pphraseFLang6_f).
            "&psl1=".rawurlencode($pphraseSLang1_s).
            "&psl2=".rawurlencode($pphraseSLang2_s).
            "&psl3=".rawurlencode($pphraseSLang3_s).
            "&psl4=".rawurlencode($pphraseSLang4_s).
            "&psl5=".rawurlencode($pphraseSLang5_s).
            "&psl6=".rawurlencode($pphraseSLang6_s).
            //Prevention
            "&pfl1_prev=".rawurlencode($pphraseFLang1_prev_f).
            "&pfl2_prev=".rawurlencode($pphraseFLang2_prev_f).
            "&pfl3_prev=".rawurlencode($pphraseFLang3_prev_f).
            "&pfl4_prev=".rawurlencode($pphraseFLang4_prev_f).
            "&pfl5_prev=".rawurlencode($pphraseFLang5_prev_f).
            "&pfl6_prev=".rawurlencode($pphraseFLang6_prev_f).

            "&psl1_prev=".rawurlencode($pphraseSLang1_prev_s).
            "&psl2_prev=".rawurlencode($pphraseSLang2_prev_s).
            "&psl3_prev=".rawurlencode($pphraseSLang3_prev_s).
            "&psl4_prev=".rawurlencode($pphraseSLang4_prev_s).
            "&psl5_prev=".rawurlencode($pphraseSLang5_prev_s).
            "&psl6_prev=".rawurlencode($pphraseSLang6_prev_s).
            //Response
            "&pfl1_resp=".rawurlencode($pphraseFLang1_resp_f).
            "&pfl2_resp=".rawurlencode($pphraseFLang2_resp_f).
            "&pfl3_resp=".rawurlencode($pphraseFLang3_resp_f).
            "&pfl4_resp=".rawurlencode($pphraseFLang4_resp_f).
            "&pfl5_resp=".rawurlencode($pphraseFLang5_resp_f).
            "&pfl6_resp=".rawurlencode($pphraseFLang6_resp_f).

            "&psl1_resp=".rawurlencode($pphraseSLang1_resp_s).
            "&psl2_resp=".rawurlencode($pphraseSLang2_resp_s).
            "&psl3_resp=".rawurlencode($pphraseSLang3_resp_s).
            "&psl4_resp=".rawurlencode($pphraseSLang4_resp_s).
            "&psl5_resp=".rawurlencode($pphraseSLang5_resp_s).
            "&psl6_resp=".rawurlencode($pphraseSLang6_resp_s).
            //Storage
            "&pfl1_storage=".rawurlencode($pphraseFLang1_storage_f).
            "&pfl2_storage=".rawurlencode($pphraseFLang2_storage_f).
            "&pfl3_storage=".rawurlencode($pphraseFLang3_storage_f).
            "&pfl4_storage=".rawurlencode($pphraseFLang4_storage_f).
            "&pfl5_storage=".rawurlencode($pphraseFLang5_storage_f).
            "&pfl6_storage=".rawurlencode($pphraseFLang6_storage_f).

            "&psl1_storage=".rawurlencode($pphraseSLang1_storage_s).
            "&psl2_storage=".rawurlencode($pphraseSLang2_storage_s).
            "&psl3_storage=".rawurlencode($pphraseSLang3_storage_s).
            "&psl4_storage=".rawurlencode($pphraseSLang4_storage_s).
            "&psl5_storage=".rawurlencode($pphraseSLang5_storage_s).
            "&psl6_storage=".rawurlencode($pphraseSLang6_storage_s).
            //Disposal
            "&pfl1_disp=".rawurlencode($pphraseFLang1_disp_f).
            "&pfl2_disp=".rawurlencode($pphraseFLang2_disp_f).
            "&pfl3_disp=".rawurlencode($pphraseFLang3_disp_f).
            "&pfl4_disp=".rawurlencode($pphraseFLang4_disp_f).
            "&pfl5_disp=".rawurlencode($pphraseFLang5_disp_f).
            "&pfl6_disp=".rawurlencode($pphraseFLang6_disp_f).

            "&psl1_disp=".rawurlencode($pphraseSLang1_disp_s).
            "&psl2_disp=".rawurlencode($pphraseSLang2_disp_s).
            "&psl3_disp=".rawurlencode($pphraseSLang3_disp_s).
            "&psl4_disp=".rawurlencode($pphraseSLang4_disp_s).
            "&psl5_disp=".rawurlencode($pphraseSLang5_disp_s).
            "&psl6_disp=".rawurlencode($pphraseSLang6_disp_s).


            "&sw1=".rawurlencode($signalWordLang1).
            "&sw2=".rawurlencode($signalWordLang2));
}
else
{
        echo "<script type='text/javascript'>alert('The chemical data is too much for A6 Size. Please Select Different label Size!')</script>";
}

       
}



?>
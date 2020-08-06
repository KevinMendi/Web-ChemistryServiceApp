<?php

$chemName = '<p><b style="font-size:15px">'.htmlspecialchars($chemicalName).'</b></p>';

/*
$left_column = '<p><b style="font-size:13px">'.htmlspecialchars($chemicalName).'</b>

<div class="" style="color:black; font-size:5px; text-align:justify;">
'.htmlspecialchars($lang1).':<br>
<b>'.htmlspecialchars($signalWordLang1).'</b><br>
'.htmlspecialchars($hp_phrases_f_toString).'<br>
'.htmlspecialchars($pp_phrases_f_toString).'<br>
'.htmlspecialchars($pp_phrases_f_toString_prev).'<br>
'.htmlspecialchars($pp_phrases_f_toString_resp).'<br>
'.htmlspecialchars($pp_phrases_f_toString_storage).'<br>
'.htmlspecialchars($pp_phrases_f_toString_disp).'<br>



'.htmlspecialchars($lang2).':<br>
<b>'.htmlspecialchars($signalWordLang2).'</b><br>
'.htmlspecialchars($hp_phrases_s_toString).'<br>
'.htmlspecialchars($pp_phrases_s_toString).'<br>
'.htmlspecialchars($pp_phrases_s_toString_prev).'<br>
'.htmlspecialchars($pp_phrases_s_toString_resp).'<br>
'.htmlspecialchars($pp_phrases_s_toString_storage).'<br>
'.htmlspecialchars($pp_phrases_s_toString_disp).'
</div>
</p>


';
*/
$phrasesF = "";

if(!empty($hp_phrases_f_toString))
{
	$phrasesF = $hp_phrases_f_toString;
}
if(!empty($pp_phrases_f_toString))
{
	$phrasesF = $phrasesF."\n".$pp_phrases_f_toString;
}
if(!empty($pp_phrases_f_toString_prev))
{
	$phrasesF = $phrasesF."\n".$pp_phrases_f_toString_prev;
}
if(!empty($pp_phrases_f_toString_resp))
{
	$phrasesF = $phrasesF."\n".$pp_phrases_f_toString_resp;
}
if(!empty($pp_phrases_f_toString_storage))
{
	$phrasesF = $phrasesF."\n".$pp_phrases_f_toString_storage;
}
if(!empty($pp_phrases_f_toString_disp))
{
	$phrasesF = $phrasesF."\n".$pp_phrases_f_toString_disp;
}

$phrasesS = "";
if(!empty($hp_phrases_s_toString))
{
	$phrasesS = $hp_phrases_s_toString;
}
if(!empty($pp_phrases_s_toString))
{
	$phrasesS = $phrasesS."\n".$pp_phrases_s_toString;
}
if(!empty($pp_phrases_s_toString_prev))
{
	$phrasesS = $phrasesS."\n".$pp_phrases_s_toString_prev;
}
if(!empty($pp_phrases_s_toString_resp))
{
	$phrasesS = $phrasesS."\n".$pp_phrases_s_toString_resp;
}
if(!empty($pp_phrases_s_toString_storage))
{
	$phrasesS = $phrasesS."\n".$pp_phrases_s_toString_storage;
}
if(!empty($pp_phrases_s_toString_disp))
{
	$phrasesS = $phrasesS."\n".$pp_phrases_s_toString_disp;
}








$phrases = $lang1."\n".$signalWordLang1."\n".$phrasesF."\n\n".$lang2."\n".$signalWordLang2."\n".$phrasesS;



//$signalWord = '<h1 style="font-size:18px; color:black;">'.htmlspecialchars($signalWordVal).'</h1>';
$companyAddress = '
<p style="font-size:5px; color:black;">Reiherstieg 40<br>
21244 Buchholz i.d.N. (bei Hamburg)</p>
';
$companyContact ='
<p style="font-size:5px; color:black;">
Tel. +49 (0) 4181 - 1386 456<br>
Fax. +49 (0) 4181 - 1386 457
</p>
';

$mail = '<p style="font-size:5px; color:black;">
Email. info@rimpido.com<br>
www.rimpido.com
</p>';

//$left_column = utf8_encode($left_column);
//$left_column = utf8_decode($left_column);
//$left_column_iso = iconv('utf-8','iso-8859-1',$left_column);

$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(245, 166, 47);   //

if($unNo == "NONE")
{
	$unNo = "";
}
else
{
	$unNo = "UN".$unNo;
}


if($reachNo == "NONE")
{
	$reachNo = "";
}
else
{
	$reachNo = "Reach No.".$reachNo;
}

if($ufiNo == "NONE")
{
	$ufiNo = "";
}
else
{
	$ufiNo = "UFI No.".$ufiNo;
}
$un_num = '<b style="color:black;font-size:28px;">'.htmlspecialchars($unNo).'</b>';
$reach_num = '<p style="color:black;font-size:9px;">'.htmlspecialchars($reachNo).'</p>';
$ufi_num = '<p style="color:black;font-size:9px;">'.htmlspecialchars($ufiNo).'</p>';
// write the first column



$pdf->writeHTMLCell(35, '', 3, 10, $un_num, 0, 0, 1, true, 'J', true);
//$pdf->writeHTMLCell(40, '', 103, 70, $signalWord, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(30, '', 120, 3, $companyAddress, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(25, '', 45, 3, $companyContact, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(35, '', 85, 3, $mail, 0, 0, 1, true, 'J', true);

$pdf->writeHTMLCell(45, '', 3, 93, $reach_num, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(45, '', 3, 96, $ufi_num, 0, 0, 1, true, 'J', true);

// set JPEG quality
$pdf->setJPEGQuality(100);


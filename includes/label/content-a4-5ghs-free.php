<?php
/*
$left_column = '<h1><b style="font-size:23px">'.htmlspecialchars($chemicalName).'</b></h1> 
<p style="color:black; font-size:11px;">
'.htmlspecialchars($hp_phrases_f_toString).'<br><br>
'.htmlspecialchars($pp_phrases_f_toString).'<br>
'.htmlspecialchars($pp_phrases_f_toString_prev).'<br>
'.htmlspecialchars($pp_phrases_f_toString_resp).'<br>
'.htmlspecialchars($pp_phrases_f_toString_storage).'<br>
'.htmlspecialchars($pp_phrases_f_toString_disp).'<br>
</p>

';
*/
$chemName = '<p><b style="font-size:30px">'.htmlspecialchars($chemicalName).'</b></p>';

$phrases = $hp_phrases_f_toString.$pp_phrases_f_toString.$pp_phrases_f_toString_prev.$pp_phrases_f_toString_resp.$pp_phrases_f_toString_storage.$pp_phrases_f_toString_disp;


$signalWord = '<h1 style="font-size:25px; color:rgb(251,27,20);">'.htmlspecialchars($signalWordVal).'</h1>';

$companyAddress = '
<p style="font-size:8px; color:black;">Reiherstieg 40<br>
21244 Buchholz i.d.N. (bei Hamburg)</p>
';
$companyContact ='
<p style="font-size:8px; color:black;">
Tel. +49 (0) 4181 - 1386 456<br>
Fax. +49 (0) 4181 - 1386 457
</p>
';

$mail = '<p style="font-size:8px; color:black;">
Email. info@rimpido.com<br>
www.rimpido.com
</p>';

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
$un_num = '<b style="color:black;font-size:34px;">'.htmlspecialchars($unNo).'</b>';
$reach_num = '<p style="color:black;font-size:12px;">'.htmlspecialchars($reachNo).'</p>';
$ufi_num = '<p style="color:black;font-size:12px;">'.htmlspecialchars($ufiNo).'</p>';
// write the first column



$pdf->writeHTMLCell(40, '', 80, 15, $un_num, 0, 0, 1, true, 'J', true);
//$pdf->writeHTMLCell(40, '', 103, 70, $signalWord, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(40, '', 250, 3, $companyAddress, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(35, '', 90, 3, $companyContact, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(45, '', 180, 3, $mail, 0, 0, 1, true, 'J', true);

$pdf->writeHTMLCell(140, '', 80, 28, $signalWord, 0, 0, 1, true, 'J', true);

$pdf->writeHTMLCell(60, '', 70, 195, $reach_num, 0, 0, 1, true, 'J', true);
$pdf->writeHTMLCell(60, '', 70, 200, $ufi_num, 0, 0, 1, true, 'J', true);

// set JPEG quality
$pdf->setJPEGQuality(100);

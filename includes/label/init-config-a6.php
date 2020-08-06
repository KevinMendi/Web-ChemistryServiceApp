<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A6', true, 'UTF-8', false);

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
$pdf->setPrintFooter(false);


if($lang1 == "BG" || $lang1 == "ZH" || $lang1 == "EL" || $lang1 == "JA" || $lang1 == "RU" || $lang2 == "BG" || $lang2 == "ZH" || $lang2 == "EL" || $lang2 == "JA" || $lang2 == "RU")
{
//TCPDF_FONTS::addTTFfont('../fonts/DroidSansFallback.ttf');
//$pdf->SetFont('DroidSansFallback',", 12, ",false);
	$pdf->SetFont('DroidSansFallback','', 10);
}
else
{
	$pdf->SetFont('aealarabiya', '', 18);

}

//$pdf->SetFont('kozminproregular', '', 12);
//$pdf->addTTFfont('./tcpdf/fonts/DroidSansFallback.ttf');



//$pdf->SetFont('aealarabiya', '', 18);
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
<?php


if(isset($_GET['print_id']))
{
    
    $firstGhs = $_GET['fghs'];
    $secondGhs = $_GET['sghs'];
    //$thirdGhs = $_GET['tghs'];
    //$fourthGhs = $_GET['ftghs'];

    include_once('../../includes/label/getdata-free.php');
    

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

require_once('../../includes/label/init-config-a4.php');
require_once('../../includes/label/phrase-compressed-free.php');

require_once('../../includes/label/content-a4-free.php');

//$pdf->writeHTMLCell(148, '', 145, $y, $left_column, 0, 0, 1, true, 'J', true);

$pdf->writeHTMLCell(147, '', 145, 12, $chemName, 0, 0, 1, true, 'J', true);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(147, 182, $phrases."\n", 0, 'J', 1, 1, 145, 23, true, 0, false, true, 60, 'M', true);


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
$pdf->SetXY(51, 23);
$pdf->Image('images/'.$firstGhs.'.png', '', '', 93.5, 93.5, '', '', '', false, 300, '', false, false, 1, false, false, false);

$pdf->SetXY(3, 71);
$pdf->Image('images/'.$secondGhs.'.png', '', '', 93.5, 93.5, '', '', '', false, 300, '', false, false, 1, false, false, false);





// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($chemicalName.'_rimpido'.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

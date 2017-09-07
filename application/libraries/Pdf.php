<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// include autoloader
require_once realpath(__DIR__ . '/dompdf/autoload.inc.php');

class Pdf {

    function pdf_create($html, $filename='', $stream=TRUE, $paper='F4')
    {

        $dompdf = new Dompdf\Dompdf;
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
    	$dompdf->setPaper($paper, 'portrait');
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf");
        } else {
            return $dompdf->output();
        }
        
    }

    function pdf_createf4_landscape($html, $filename='', $stream=TRUE, $paper='F4')
    {

        $dompdf = new Dompdf\Dompdf;
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, 'landscape');
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf");
        } else {
            return $dompdf->output();
        }

    }

    function pdf_create_85x55($html, $filename='', $stream=TRUE)
    {

        $dompdf = new Dompdf\Dompdf;
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper(array(0,0,612.00,468.00));
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf");
        } else {
            return $dompdf->output();
        }

    }
}
?>
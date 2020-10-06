<?php
require 'pdfcrowd.php';

try
{   
    // create an API client instance
    $client = new Pdfcrowd("CreativeKits", "4d7c1a94a2b03e472e13423df8c81c5f");

    // convert a web page and store the generated PDF into a $pdf variable
    $pdf = $client->convertURI('http://www.creativekits.es/admin/parsecart.php?id='.$_GET['id']);

    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"CreativeKits_factura".$_GET['id'].".pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>
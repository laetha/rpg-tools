<?php
// LOAD XML AND XSLT
$doc = new DOMDocument();
$doc->load('UOitems.xml');

$xsl = new DOMDocument;
$xsl->load('xml-conv.xsl');

// CONFIGURE TRANSFORMER
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

// RUN TRANSFORMATION
$newXML = $proc->transformToXML($doc);

// OUTPUT TO CONSOLE
echo $newXML;

// OUTPUT TO FILE
file_put_contents('Output1.xml', $newXML);

?>

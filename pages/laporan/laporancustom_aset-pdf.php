<?php
ob_start();
 include('laporan_custom_aset.php');
 $content = ob_get_clean();
 
// conversion HTML => PDF
 require_once('../html2pdf/html2pdf.class.php');
 try
 {
 $html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15',array(20, 10, 10, 10));
 $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
 $html2pdf->Output('laporan.pdf');
 }
 catch(HTML2PDF_exception $e) { echo $e; }
 
?>
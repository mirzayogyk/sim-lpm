<?php
		$SQL = "SELECT ttandatangan.* FROM ttandatangan ";
		$myQry = mysqli_query($koneksidb, $SQL)  or die ("Query Lurah : ".mysqli_error($koneksidb)); 
		$datane = mysqli_fetch_array($myQry); 
		$today = date("Y-m-d");
 ?>
<p>&nbsp;</p>
<table class="headtab" align="center" width="700" border="0">
  <tr>
    <td width="320" rowspan="12">&nbsp;</td>
    <td width="230">&nbsp;</td>
    <td width="170" align="left">Banjarbaru, <?php echo indonesia2Tgl($today); ?></td>
  </tr>  
  <tr> 
    <td>&nbsp;</td>
    <td align="center">&nbsp; </td>
  </tr>   
  <tr> 
    <td>&nbsp;</td>
    <td align="left"><?php echo $datane['jabatan_tertanda']; ?></td>
  </tr> 
   <tr>
    <td>&nbsp;</td>
    <td class="g3" align="center">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td class="g3" align="center">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td class="g3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><b><u><?php echo $datane['nama_tertanda']; ?></u></b></td>
  </tr>
  <!--<tr>
    <td>&nbsp;</td>
    <td align="left"><b><?php echo $datane['pangkat_tertanda']; ?></b></td>
  </tr>-->
  <tr>
    <td>&nbsp;</td>
    <td align="left"><?php echo $datane['nip_tertanda']; ?> </td>
  </tr>
</table>

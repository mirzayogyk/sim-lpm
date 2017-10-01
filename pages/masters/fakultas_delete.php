<?php 
include_once "library/seslogin.php"; 
include_once "fakultas_config.php"; 

if($_GET) { 
	if(empty($_GET['Kode'])){ 
		buatLog($_SESSION['BONCLINK_M4SUK'],"DELETE FAIL","NULL");
		echo "<b>Data yang dihapus tidak ada</b>"; 
	} 
	else { 
		$mySql = "DELETE FROM ".$tableName." WHERE ".$field[0]."='".$_GET['Kode']."'"; 
		$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysql_error());  
		if($myQry){  
			buatLog($_SESSION['BONCLINK_M4SUK'],"DELETE SUCCESS",$mySql);
			echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-Data'>";  
		} 
	} 
} 
?>
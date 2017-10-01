<?php 
include_once "library/seslogin.php"; 
include_once "prodi_config.php"; 

if($_GET) { 
	if(empty($_GET['Kode'])){ 
		echo "<b>Data yang dihapus tidak ada</b>"; 
	} 
	else { 
		$mySql = "DELETE FROM ".$tableName." WHERE ".$field[0]."='".$_GET['Kode']."'"; 
		$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysql_error());  
		if($myQry){  
			echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-Data'>";  
		} 
	} 
} 
?>
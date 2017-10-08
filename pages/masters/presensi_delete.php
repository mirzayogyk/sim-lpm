<?php 
include_once "library/seslogin.php"; 
include_once "presensi_config.php"; 

if($_GET) { 
	if(empty($_GET['Kode'])){ 
		buatLog($_SESSION['USERMRZ'],"DELETE FAIL","NULL"); 
		echo "<b>Data yang dihapus tidak ada</b>"; 
	} 
	else { 
		$mySql = "DELETE FROM ".$tableName." WHERE ".$field[0]."='".$_GET['Kode']."'"; 
		$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysql_error());  
		if($myQry){  
		buatLog($_SESSION['USERMRZ'],"DELETE SUCCESS",$mySql); 
		$id=$_GET['id'];
		echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-Data&Kode=$id'>"; 
		} 
	} 
} 
?>
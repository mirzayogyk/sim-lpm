<?php 
include_once "library/seslogin.php"; 
include_once "presensi_config.php"; 

if($_GET) { 
	if(empty($_GET['Kode'])){ 
		buatLog($_SESSION['USERMRZ'],"CONFIRM FAIL","NULL"); 
		echo "<b>Data yang dikonfirmasi tidak ada</b>"; 
	} 
	else { 
		$mySql = "UPDATE ".$tableName." SET verifikasi_status='Y', verifikasi_tanggal='".date('Y/m/d')."', verifikasi_oleh='".$_SESSION['USERMRZ']."' WHERE ".$field[0]."='".$_GET['Kode']."'"; 
		$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysql_error());  
		if($myQry){  
		buatLog($_SESSION['USERMRZ'],"CONFIRM SUCCESS",$mySql); 
		$id=$_GET['id'];
		echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-KK&Kode=$id'>"; 
		} 
	} 
} 
?>
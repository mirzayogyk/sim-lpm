<?php
if(empty($_SESSION['BONCLINK_M4SUK'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Anda Ditolak!</b> <br>
		  Silahkan masukkan Data Login Anda dengan benar untuk bisa mengakses halaman ini.";
	echo "</center>";
	include_once "index.php";
	exit;
}
?>
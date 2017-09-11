<?php
if(empty($_SESSION['MAIN_FROZEN_THRON3'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Anda Ditolak!</b> <br>
		  Login Anda tidak memilik hak akses untuk melakukan ini, Hubungi Administrator. Terima Kasih.";
	echo "</center>";
	include_once "index.php";
	exit;
}
?>
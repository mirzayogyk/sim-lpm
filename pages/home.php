<h1 align="center">BERITA ACARA</h1>
<?php
	if(isset($_SESSION['dosen'])) {
		echo "<meta http-equiv='refresh' content='0; url=?page=Home-Dosen&Kode=".$_SESSION['USERMRZ']."'>"; 
	}
	else if (isset($_SESSION['ketuakelas'])) {
		echo "<meta http-equiv='refresh' content='0; url=?page=Home-KK&Kode=".$_SESSION['USERMRZ']."'>"; 
	}
	else  {?>
		<div class="hero-unit">
			<legend align="center">LOGIN</legend>	 
			<div class="well"> 
				<!-- <p>Sistem Informasi Manajemen Barang merupakan perwujudan transparansi dari DPRD Kota Banjarbaru khususnya dan pemerintahan Indonesia pada umumnya. Sistem informasi ini memberikan informasi mengenai berbagai Aset yang ada pada Kantor Dewan Perwakilan Rakyat Daerah Kota Banjarbaru </p>  -->
				<form action="superadmin/index.php">
    					<input type="submit" class="btn btn-primary btn-block" value="LOGIN" />
				</form>
			</div>

	<?php }?>

			
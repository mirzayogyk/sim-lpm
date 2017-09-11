<h1>Beranda</h1>
<?php
	if(isset($_SESSION['MAIN_FROZEN_THRON3'])) {?>
	
	<div class="hero-unit"><legend>ADMIN Sistem Informasi Manajemen Barang </legend>  
	
 

 


	<p> Selamat datang di SIMBa (Sistem Informasi Manajemen Barang), silakan gunakan menu navigasi untuk mencari/merubah informasi lebih lanjut. Anda telah login sebagai <?php echo $_SESSION['MAIN_FROZEN_THRON3']; ?>.</p>
	<?php }
	else if (isset($_SESSION['MAIN_DAS_L4H'])) {?>
	<div class="hero-unit">
	
	<legend>ADMIN Sistem Informasi Manajemen Barang </legend>
	
	
		   
	<p> Selamat datang di SIMBa (Sistem Informasi Manajemen Barang), silakan gunakan menu navigasi untuk mencari/merubah informasi lebih lanjut. Anda telah login sebagai <?php echo $_SESSION['MAIN_DAS_L4H']; ?>.</p>
	 
	<?php }
	else if (isset($_SESSION['MAIN_DOTA_KAH'])) {?>
	<div class="hero-unit">
	<legend>User Register </legend>
	<p> Selamat datang <b><?php echo $_SESSION['NGARAN_SHARPSHOOT3R']; ?></b> di website kami, silakan gunakan menu navigasi untuk mencari informasi lebih lanjut.</p>
	<?php }
	else  {?>
	<div class="hero-unit">
	<legend>SELAMAT DATANG di SIMBa (Sistem Informasi Manajemen Barang)</legend>
	 
	<div class="well"> 
		<p>Sistem Informasi Manajemen Barang merupakan perwujudan transparansi dari DPRD Kota Banjarbaru khususnya dan pemerintahan Indonesia pada umumnya. Sistem informasi ini memberikan informasi mengenai berbagai Aset yang ada pada Kantor Dewan Perwakilan Rakyat Daerah Kota Banjarbaru </p> 
	</div>
	<?php }?>
</div>
			
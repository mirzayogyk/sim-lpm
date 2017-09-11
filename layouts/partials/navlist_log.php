
<div id="sidebar"><a href="?page=Home" class="visible-phone"><i class="icon icon-home"></i> Beranda</a>
  <ul>
    <li class="active"><a href="?page=Home"><i class="icon icon-home"></i> <span>Beranda</span></a></li>  
		 
	  <li> <a href="#"><i class="icon icon-hdd"></i> <span>Data Akun</span></a> 
		<ul>
        <li><a href="?page=Aktifasi-Detail">Data Akun</a></li>
        <li><a href="?page=Ormas-Detail">Data Organisasi</a></li>
        <li><a href="?page=Pengurus-Detail">Data Pengurus</a></li>  
		</ul>	 
	</li> 
	  <li> <a href="?page=Laporan-Kegiatan-User"><i class="icon icon-th-list"></i> <span>Laporan kegiatan</span></a>  	 
	</li>
    <li> <a href="#"><i class="icon icon-inbox"></i> <span>Permohonan SKT</span></a>
		<ul>
        <li><a href="?page=Tata-Cara-SKT">Persyaratan Permohonan SKT</a></li> 
		<li> <a href="?page=SKT-Mohon">  Formulir Permohonan SKT</a> </li> 		
		</ul>	
	</li>
	 
	  <li> <a href="#"><i class="icon icon-print"></i> <span>Cetak Data</span></a> 
		<ul> 
        <li><a href="page/laporan/tanda-pdf.php" target="_blank">Tanda Bukti Pendataan</a></li>  
        <li><a href="page/laporan/ormas-pdf.php" target="_blank">Pendataan Ormas</a></li>  
<?php 	$sqla = "SELECT * FROM tskt   WHERE tskt.no_register='$_SESSION[MAIN_DOTA_KAH]'";
		$qryb = mysqli_query($koneksidb, $sqla)  or die ("Query ambil data kategori salah : ".mysqli_error($koneksidb));
		// $dataShow = mysqli_fetch_array($qryb);
		$juma = mysqli_num_rows($qryb);
		if($juma>0) { ?>
		 <li><a href="page/laporan/skt-pdf.php" target="_blank">Data Permohonan SKT</a></li>  
		<?php } ?>
		</ul>	 
	</li>
    
    <li><a href="?page=Buku-Tamu-User"><i class="icon icon-retweet"></i> <span>Buku Tamu</span></a></li>
    <li><a href="?page=Kontak-User"><i class="icon icon-book"></i> <span>Kontak Kami</span></a></li>

  </ul>
</div>
<?php 
include_once "library/seslogin.php"; 
include_once "presensi_config.php"; 
if($_GET) { 
	$Kode	 =  $_GET['Kode'];
	if(isset($_POST['btnSave'])){ 
 
		$txt[1] = $_POST['txt1'];  
		$txt[2] = $_POST['txt2']; 
		$txt[3] = $_POST['txt3']; 
		$txt[4] = $_POST['txt4']; 
		$txt[5] = $_POST['txt5']; 
		$txt[6] = $_POST['txt6']; 
		$txt[7] = $_POST['txt7']; 
		$txt[8] = $_POST['txt8']; 
		$txt[9] = $_POST['txt9']; 
		$txt[10] = $_POST['txt10']; 
		$txt[11] = $_POST['txt11']; 
		$txt[12] = $_POST['txt12']; 
		$txt[13] = $_POST['txt13']; 
		$txt[14] = $_POST['txt14']; 
		$txt[15] = $_POST['txt15']; 
		$txt[16] = $_POST['txt16']; 
		$txt[17] = $_POST['txt17']; 
		$txt[18] = $_POST['txt18']; 
		$txt[19] = $_POST['txt19']; 
		$txt[20] = $_POST['txt20']; 
		
		$pesanError = array(); 
		for($i=3;$i<=$jmlField;$i++){ 
			if (trim($txt[$i])=="") { 
				$pesanError[] = "Data <b>".$isian[$i]."</b> tidak boleh kosong !"; 
			} 
		} 
 
		/*
		$ada = cekAda($koneksidb,$tableName,$field[3],$isian[3],$txt[3]); 
		if($ada)        {  
			$pesanError[] = "Maaf, ".$isian[3]." <b> ".$txt[3]." </b> Sudah Ada.";	 
		} 
		*/
 
		if (count($pesanError)>=1 ){  
			echo "<div class='mssgBox'>";  
			$noPesan=0; 
			foreach ($pesanError as $indeks=>$pesan_tampil) {  
				$noPesan++;  
				echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a> 
				<h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$pesan_tampil.'</div><br>';	 
			}  
			echo "</div> <br>";  
			buatLog($_SESSION['USERMRZ'],"INSERT FAIL",getStringArray($pesanError)); 
		} 
		else { 
			$mySql	= "INSERT INTO ".$tableName." ".getInsert($jmlField,$field,$txt); 
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query insert :".getInsert($jmlField,$field,$txt)); 
			if($myQry){ 
			buatLog($_SESSION['USERMRZ'],"INSERT SUCCESS",$mySql); 
				echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-Data&Kode=$Kode'>"; 
			} 
			exit; 
		} 
 
	} 
 
	$kode_prodi = $_SESSION['PRODIMRZ'];
	$cariSql = "SELECT m_program_studi.* FROM m_program_studi WHERE kode_prodi=$kode_prodi"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$kode_pt = $hasilCari['kode_pt'];
		$kode_fak = $hasilCari['kode_fak'];
		$kode_jenjang = $hasilCari['kode_jenjang'];
		$kode_jurusan = $hasilCari['kode_jurusan'];
	};

	$cariSql = "SELECT m_tahun.* FROM m_tahun WHERE buka='Y'"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$tahun_id = $hasilCari['tahun_id'];
	}

	$Kode	 =  $_GET['Kode'];

	$cariSql = "SELECT t_jadwal.* FROM t_jadwal WHERE idj=$Kode"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$semester = $hasilCari['semester'];
		$kelas = $hasilCari['kelas'];
		$kode_mk = $hasilCari['kode_mk'];
	}

	$cariSql = "SELECT * FROM m_kelas WHERE idk=$kelas"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$kelas_nama = $hasilCari['kelas'];
	}

	$cariSql = "SELECT * FROM m_mata_kuliah WHERE kode_mk='$kode_mk'"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$nama_mk = $hasilCari['nama_mk'];
	}

	$hari = date('l');
	if($hari=='Monday')
		$hari='Senin';
	else if($hari=='Tuesday')
		$hari='Selasa';
	else if($hari=='Wednesday')
		$hari='Rabu';
	else if($hari=='Thursday')
		$hari='Kamis';
	else if($hari=='Friday')
		$hari='Jumat';
	else if($hari=='Saturday')
		$hari='Sabtu';
	else if($hari=='Sunday')
		$hari='Minggu';
	

	$Kode	 = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txt0']; 
	$data[1]	= isset($_POST['txt1']) ? $_POST['txt1'] : ''; 
	$data[2]	= isset($_POST['txt2']) ? $_POST['txt2'] : ''; 
	$data[3]	= isset($_POST['txt3']) ? $_POST['txt3'] : ''; 
	$data[4]	= isset($_POST['txt4']) ? $_POST['txt4'] : ''; 
	$data[5]	= isset($_POST['txt5']) ? $_POST['txt5'] : ''; 
	$data[6]	= isset($_POST['txt6']) ? $_POST['txt6'] : ''; 
	$data[7]	= isset($_POST['txt7']) ? $_POST['txt7'] : ''; 
	$data[8]	= isset($_POST['txt8']) ? $_POST['txt8'] : ''; 
	$data[9]	= isset($_POST['txt9']) ? $_POST['txt9'] : ''; 
	$data[10]	= isset($_POST['txt10']) ? $_POST['txt10'] : ''; 
	$data[11]	= isset($_POST['txt11']) ? $_POST['txt11'] : ''; 
	$data[12]	= isset($_POST['txt12']) ? $_POST['txt12'] : ''; 
	$data[13]	= isset($_POST['txt13']) ? $_POST['txt13'] : ''; 
	$data[14]	= isset($_POST['txt14']) ? $_POST['txt14'] : ''; 
	$data[15]	= isset($_POST['txt15']) ? $_POST['txt15'] : ''; 
	$data[16]	= isset($_POST['txt16']) ? $_POST['txt16'] : ''; 
	$data[17]	= isset($_POST['txt17']) ? $_POST['txt17'] : ''; 
	$data[18]	= isset($_POST['txt18']) ? $_POST['txt18'] : ''; 
	$data[19]	= isset($_POST['txt19']) ? $_POST['txt19'] : ''; 
	$data[20]	= isset($_POST['txt20']) ? $_POST['txt20'] : ''; 
} 
$row = 20; 
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0; 
$pageSql = "SELECT $tableName.* FROM ".$tableName." WHERE tahun_id='$tahun_id' AND semester='$semester' AND kelas = '$kelas' "; 
 
if(isset($_POST['qcari'])){ 
  $qcari=$_POST['qcari']; 
  $pageSql="SELECT $tableName.* FROM ".$tableName." WHERE  (".$field[4]." like '%$qcari%')"; 
} 
 
$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".$pageSql); 
$jml	 = mysqli_num_rows($pageQry); 
$max	 = ceil($jml/$row); 
 
?> 
 
<table class="table table-striped"> 
	<tr> 
	  <td colspan="2">
	  	<h5><b> <?php echo $kode_mk." - ".$nama_mk." - ".$kelas_nama;?> </b> </h5> 
	  </td> 
	</tr> 
		<!-- <td>
			<form class="navbar-search pull-right"  method="POST" action="?page=<?php echo $formName?>-Data">  
				<input type="text" name="qcari" placeholder="Cari..." autofocus/> 
			</form>
		</td> -->
	<tr> 

	</tr>
</table> 		 
<table class="table table-bordered table-striped"> 
	<tr> 
		<th width="30" align="center"><strong>No</strong></th> 
		<th><strong><?php echo $isian[11]; ?></strong></th> 
		<th><strong><?php echo $isian[17]; ?></strong></th> 
		<th><strong>Status	</strong></th> 
		<th width="10"><strong>Option</strong></td> 
	</tr> 
<?php 
tampilTabelPresensiKK($koneksidb,$pageSql,$field,$formName,$hal,$row,$Kode); 
?> 
</table> 
<?php tabelFooter($jml,$row,$max,$formName,$hal) ?> 
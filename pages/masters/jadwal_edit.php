<?php 
include_once "library/seslogin.php"; 
include_once "jadwal_config.php"; 
if($_GET) { 
	if(isset($_POST['btnSave'])){ 
 
		$txt[0] = $_POST['txt0']; 
		$txt[2] = date("Y-m-d h:i:sa"); 
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
 
		//$ada = cekAda($koneksidb,$tableName,$field[3],$isian[3],$txt[3]); 
		//if($ada)        {  
		//	$pesanError[] = "Maaf, ".$isian[3]." <b> ".$txt[3]." </b> Sudah Ada.";	 
		//} 
 
		if (count($pesanError)>=1 ){  
			echo "<div class='mssgBox'>";  
			$noPesan=0; 
			foreach ($pesanError as $indeks=>$pesan_tampil) {  
				$noPesan++;  
				echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a> 
				<h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$pesan_tampil.'</div><br>';	 
			}  
			echo "</div> <br>";  
			buatLog($_SESSION['USERMRZ'],"UPDATE FAIL",getStringArray($pesanError)); 
		} 
		else { 
			$mySql	= "UPDATE ".$tableName." SET ".getUpdate($jmlField,$field,$txt); 
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query update :".$mySql); 
			if($myQry){ 
			buatLog($_SESSION['USERMRZ'],"UPDATE SUCCESS",$mySql); 
				echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-Data'>"; 
			} 
			exit; 
		} 
 
	} 
 
$Kode	 = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txt0']; 
$sqlShow = "SELECT * FROM ".$tableName." WHERE ".$field[0]."='$Kode'";
$qryShow = mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data salah : ".mysql_error());
$dataShow = mysqli_fetch_array($qryShow);

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
 
for($i=0;$i<=$jmlField;$i++){
	$data[$i] = $dataShow[$field[$i]];
}
} // Penutup GET
?>
<form  class="form-horizontal" action="?page=<?php echo $formName;?>-Edit" method="post" name="form1" target="_self" id="form1">  
<fieldset> 
	<legend>Ubah <?php echo $formName?></legend> 
		<div class="form-group"> 
			<label for="input00"><?php echo $isian[0]; ?></label>  
			<input name="txt0" type="text" class="form-control" id="input00" value="<?php echo $Kode; ?>"  size="60" maxlength="50" readonly />  
		</div> 
		<?php 
							buatInputHidden($isian[1],1,$kode_pt); 
							buatInputHidden($isian[2],2,$kode_fak); 
							buatInputHidden($isian[3],3,$kode_jenjang); 
							buatInputHidden($isian[4],4,$kode_jurusan); 
							buatInputHidden($isian[5],5,$kode_prodi); 
							buatInputHidden($isian[6],6,$tahun_id); 
							buatInputTextBS($isian[7],7,$data[7]); 
							buatInputSelectKelas($isian[8],8,$data[8],$koneksidb,'kode_prodi',$kode_prodi,'kelas');
							buatInputSelectMatakuliah($isian[9],9,$data[9],$koneksidb,$kode_prodi,$tahun_id,'nama_mk');
							buatInputSelectHari($isian[10],10,$data[10]); 
							buatInputTextBS($isian[11],11,$data[11]); 
							buatInputTextBS($isian[12],12,$data[12]); 
							buatInputSelectDosen($isian[13],13,$data[13],$koneksidb,$kode_fak,$tahun_id,'nama_dosen'); 
							buatInputHidden($isian[14],14,$data[14]); 
							buatInputHidden($isian[15],15,$data[15]); 
							buatInputHidden($isian[16],16,$data[16]); 
							buatInputHidden($isian[17],17,$data[17]); 
							buatInputHidden($isian[18],18,$data[18]); 
							buatInputHidden($isian[19],19,$data[19]); 
							buatInputSelectKK($isian[20],20,$data[20],$koneksidb,'nama'); 
		?> 
<div class="form-actions"> 
							<button type="submit"  name="btnSave" class="btn btn-primary">Simpan</button> 
							<button type="reset" class="btn " name="reset" id="reset" onclick="return confirm('hapus data yang telah anda ketik?')"/>Reset</button> 
	  <button type="button" class="btn " name=" KEMBALI " id="cancel" value=" BATAL " onclick="history.back();" />Batal </button> 
						</div>											 
</form> 

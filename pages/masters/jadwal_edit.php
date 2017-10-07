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
 
for($i=0;$i<=$jmlField;$i++){
	$data[$i] = $dataShow[$field[$i]];
}
} // Penutup GET
?>
<form  class="form-horizontal" action="?page=<?php echo $formName;?>-Edit" method="post" name="form1" target="_self" id="form1">  
<fieldset> 
	<legend>Ubah <?php echo $formName?></legend> 
		<div class="control-group"> 
			<label class="control-label" for="input00"><?php echo $isian[0]; ?></label>  
			<div class="controls">  
				<input name="txt0" type="text" class="input-xlarge" id="input00" value="<?php echo $Kode; ?>"  size="60" maxlength="50" readonly />  
			</div> 
		</div> 
		<?php 
		buatEditText($isian[3],3,$data[3]); 
		buatEditText($isian[4],4,$data[4]); 
		buatEditText($isian[5],5,$data[5]); 
		buatEditText($isian[6],6,$data[6]); 
		buatEditText($isian[7],7,$data[7]); 
		buatEditText($isian[8],8,$data[8]); 
		buatEditText($isian[9],9,$data[9]); 
		buatEditText($isian[10],10,$data[10]); 
		buatEditText($isian[11],11,$data[11]); 
		buatEditText($isian[12],12,$data[12]); 
		buatEditText($isian[13],13,$data[13]); 
		buatEditText($isian[14],14,$data[14]); 
		buatEditText($isian[15],15,$data[15]); 
		buatEditText($isian[16],16,$data[16]); 
		buatEditText($isian[17],17,$data[17]); 
		buatEditText($isian[18],18,$data[18]); 
		buatEditText($isian[19],19,$data[19]); 
		buatEditText($isian[20],20,$data[20]); 
		?> 
<div class="form-actions"> 
							<button type="submit"  name="btnSave" class="btn btn-primary">Simpan</button> 
							<button type="reset" class="btn " name="reset" id="reset" onclick="return confirm('hapus data yang telah anda ketik?')"/>Reset</button> 
	  <button type="button" class="btn " name=" KEMBALI " id="cancel" value=" BATAL " onclick="history.back();" />Batal </button> 
						</div>											 
</form> 

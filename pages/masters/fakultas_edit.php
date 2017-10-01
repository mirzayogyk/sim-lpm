<?php 
include_once "library/seslogin.php"; 
include_once "fakultas_config.php"; 
if($_GET) { 
	if(isset($_POST['btnSave'])){ 
 
		$txt[0] = $_POST['txt0']; 
		$txt[2] = date("Y-m-d h:i:sa"); 
		$txt[3] = $_POST['txt3']; 
		$txt[4] = $_POST['txt4']; 
		$txt[5] = $_POST['txt5']; 
		$txt[6] = $_POST['txt6']; 
 
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
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query insert :".getInsert($jmlField,$field,$txt)); 
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
		<div class="control-group"> 
			<label class="control-label" for="input03"><?php echo $isian[3]; ?></label>  
			<div class="controls">  
				<input name="txt3" type="text" class="input-xlarge" id="input03" value="<?php echo $data[3]; ?>"  size="60" maxlength="50" />  
			</div> 
		</div> 
		<div class="control-group"> 
			<label class="control-label" for="input04"><?php echo $isian[4]; ?></label>  
			<div class="controls">  
				<input name="txt4" type="text" class="input-xlarge" id="input04" value="<?php echo $data[4]; ?>"  size="60" maxlength="50" />  
			</div> 
		</div> 
		<div class="control-group"> 
			<label class="control-label" for="input05"><?php echo $isian[5]; ?></label>  
			<div class="controls">  
				<input name="txt5" type="text" class="input-xlarge" id="input05" value="<?php echo $data[5]; ?>"  size="60" maxlength="50" />  
			</div> 
		</div> 
		<div class="control-group"> 
			<label class="control-label" for="input06"><?php echo $isian[6]; ?></label>  
			<div class="controls">  
				<input name="txt6" type="text" class="input-xlarge" id="input06" value="<?php echo $data[6]; ?>"  size="60" maxlength="50" />  
			</div> 
		</div> 
<div class="form-actions"> 
							<button type="submit"  name="btnSave" class="btn btn-primary">Simpan</button> 
							<button type="reset" class="btn " name="reset" id="reset" onclick="return confirm('hapus data yang telah anda ketik?')"/>Reset</button> 
	  <button type="button" class="btn " name=" KEMBALI " id="cancel" value=" BATAL " onclick="history.back();" />Batal </button> 
						</div>											 
</form> 

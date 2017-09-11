<?php
// include_once "lib/seslogin.php";
include_once "page/lib/dtdataormas.php";
$eno ="2018-09-25";
if($_GET) {
	if(isset($_POST['btnSave'])){
		$pesanError = array();
		if (trim($_POST['txt1'])=="") {
			$pesanError[] = "Data <b>".$field1."</b> tidak boleh kosong !";		
		} 
		$txt1= $_POST['txt1'];
		$txt2= $_POST['txt2'];
		$txt3= $_POST['txt3'];  
		$txt4= $_POST['txt4'];
		$txt5= $_POST['txt5']; 
		$txt6= $_POST['txt6']; 
		$txt7= $_POST['txt7'];
		$txt8= $_POST['txt8'];
		$txt9= $_POST['txt9'];
		// $txt10= $_POST['txt10'];  
		
		if(!isset($_SESSION['captchakuis'])){
		// die("isi form komentar dulu");
		$pesanError[] = "Mohon isi Captcha untuk verifikasi Anti Spam!";
		
		}
		if($_POST['jawaban'] != $_SESSION['captchakuis']){
			unset($_SESSION['captchakuis']);
			// die("Salah");
		$pesanError[] = "Kode Matematika yang anda masukkan salah";
			
		}
		unset($_SESSION['captchakuis']);

		$cekSql="SELECT * FROM ".$tableName." WHERE ".$field1."='$txt1'";
		$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, ".$isian1." <b> $txt1 </b> sudah ada, ganti dengan yang lain";
		}		
		$cekSql="SELECT * FROM ".$tableName." WHERE ".$field3."='$txt3'";
		$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, ".$isian3." <b> $txt3 </b> sudah ada pada database kami,silakan ganti dengan yang lain";
		}	 

		if (count($pesanError)>=1 ){
            echo "<div class='mssgBox'>"; 
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++; 
			echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$pesan_tampil.'</div><br>';	
				} 
			echo "</div> <br>"; 
		}
		else {
			$kodeBaru	= buatKode($tableName, $huruf);
			$mySql	= "INSERT INTO  ".$tableName." (".$field1.",".$field2.",".$field3.",".$field4.",".$field5.",".$field6.",".$field7.",".$field8.",".$field9.") VALUES ('$txt1','$txt2','$txt3','$txt4','$txt5','$txt6','$txt7','$txt8','$txt9')";
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query ".mysqli_error($koneksidb));
			if($myQry){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendataan Ormas Baru Telah Berhasil Disimpan, Sebentar lagi Anda akan diarahkan form Data Pengurus Organisasi.</div>';
				echo "<meta http-equiv='refresh' content='3; url=?page=Pengurus-Baru&Kode=".$txt1."'>";	
				}
			else {
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendataan Ormas Baru Gagal! Hubungi Administrator.</div>';
			}	
			exit;
		}
	} // Penutup POST
	$data0	= buatKode($tableName, $huruftgl);
	$data1	= isset($_POST['txt1']) ? $_POST['txt1'] : '';
	$data2	= isset($_POST['txt2']) ? $_POST['txt2'] : date("Y-m-d");
	$data3	= isset($_POST['txt3']) ? $_POST['txt3'] : '';
	$data4	= isset($_POST['txt4']) ? $_POST['txt4'] : '';
	$data5	= isset($_POST['txt5']) ? $_POST['txt5'] : '';
	$data6	= isset($_POST['txt6']) ? $_POST['txt6'] : '';
	$data7	= isset($_POST['txt7']) ? $_POST['txt7'] : '';
	$data8	= isset($_POST['txt8']) ? $_POST['txt8'] : '';
	$data9	= isset($_POST['txt9']) ? $_POST['txt9'] : '';
	// $data10	= isset($_POST['txt10']) ? $_POST['txt10'] : '';
	// $data11	= isset($_POST['txt11']) ? $_POST['txt11'] : '';
	// $data12	= isset($_POST['txt12']) ? $_POST['txt12'] : '';
	// $data13	= isset($_POST['txt13']) ? $_POST['txt13'] : 'Komet';
	// $data14	= isset($_POST['txt14']) ? $_POST['txt14'] : 'Banjarbaru Utara';
	// $data15	= isset($_POST['txt15']) ? $_POST['txt15'] : 'Banjarbaru';
	// $data16	= isset($_POST['txt16']) ? $_POST['txt16'] : '';
	// $data17	= isset($_POST['txt17']) ? $_POST['txt17'] : '';
	// $data18	= isset($_POST['txt18']) ? $_POST['txt18'] : '';
} // Penutup GET 
$_SESSION['JAHRAKAL']=$data0;
	getAde($tableName,$eno);
	// $now = strtotime(date("Y-m-d"));
	// $maxage = date('Y-m-d', strtotime('- 17 year', $now));
	// $minage = date('Y-m-d', strtotime('- 70 year', $now));
?>


  <form id="new-project" class="form-horizontal" action="?page=<?php echo $formName;?>-Baru" method="post" name="form1" target="_self">
						<fieldset>
						<table class="table  table-striped">
							<tr>
      <th colspan="3" scope="col"><h1>Form Registrasi <?php  echo $formName ?> Baru</h1></th>
    </tr> 
    <tr>
      <td width="24%"><b><?php echo $isian1; ?></b></td>
      <td width="2%"><b>:</b></td>
      <td width="74%"><input name="txt1" class="span2"  type="text" value="<?php echo $data0; ?>" size="60"  readonly required/></td>
    </tr>
	
	<input name="txt2" class="span6"  type="hidden" value="<?php echo $data2; ?>" size="60" maxlength="100" required/>
   <!-- <tr>
      <td><b><?php echo $isian2; ?></b></td>
      <td><b>:</b></td>
      <td> <input type="text" name="txt2"  data-date-format="yyyy-mm-dd" value="<?php echo $data2; ?>" class="datepicker" /> 
	    </td>
    </tr> -->
	<tr>
      <td><b><?php echo $isian3; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt3" class="span6"  type="text" value="<?php echo $data3; ?>" size="60" maxlength="164" required/></td>		
    </tr>
     <tr>
      <td><b><?php echo $isian4; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt4" class="span6"  type="text" value="<?php echo $data4; ?>" size="60" maxlength="24"  /></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian5; ?></b></td>
      <td><b>:</b></td>
      <td>  <select name="txt5" class="span6"> 
		<?php
		$mySql2 = "SELECT * FROM tbentukormas";
		$myQry = mysqli_query($koneksidb, $mySql2) or die ("Gagal Query bentukormas  ".mysqli_error($koneksidb));
		while ($kolomData1 = mysqli_fetch_array($myQry)) {
			if ($data1 == $kolomData1['id_bentukormas']) {
				$cek = "selected";
			} else { $cek=""; }
			
			echo "<option value='$kolomData1[id_bentukormas]' $cek> $kolomData1[bentuk_ormas] </option>";
		}
		$mySql ="";
		?>
		</select>
		</td>
    </tr> 
    <tr>
      <td><b><?php echo $isian6; ?></b></td>
      <td><b>:</b></td>
      <td>  	 
										<select name="txt6" class="span6">
		 
		<?php
		$mySql2 = "SELECT * FROM tsifatormas";
		$myQry = mysqli_query($koneksidb, $mySql2) or die ("Gagal Query bentukormas  ".mysqli_error($koneksidb));
		while ($kolomData1 = mysqli_fetch_array($myQry)) {
			if ($data1 == $kolomData1['id_sifatormas']) {
				$cek = "selected";
			} else { $cek=""; }
			
			echo "<option value='$kolomData1[id_sifatormas]' $cek> $kolomData1[sifat_ormas] </option>";
		}
		$mySql ="";
		?>
		</select></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian7; ?></b></td>
      <td><b>:</b></td>
      <td>	<textarea name="txt7" class="span6" required></textarea></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian8; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt8" class="span6" type="text" value="<?php echo $data8; ?>" size="60" onkeyup="validAngka(this)"  pattern="[0-9]{9,12}"  maxlength="12" required/></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian9; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt9" class="span6" type="email" value="<?php echo $data9; ?>" size="60" maxlength="64" required/></td>
    </tr>  
    
    <tr>
      <td><b><?php
//meng-generate angka random integer antara 20 - 50
$jx = rand(30,70);
//meregisterkan angka tersebut ke session
$_SESSION['captchakuis'] = $jx;
$kx = rand(1,15);
$yx = $jx - $kx;
//mencetak ke halaman
echo "<b> ".$yx." + ".$kx." = ? </b>";;
?></b></td>
      <td><b>:</b></td>
      <td><input type="text" class="span1" name="jawaban" id="jawaban" maxlength="5"></td>
    </tr>  
     
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><button type="submit"  name="btnSave" class="btn btn-primary">Kirim</button>
								<button type="reset" class="btn " name="reset" id="reset" onclick="return confirm('hapus data yang telah anda ketik?')"/>Reset</button>
		   <button type="button" class="btn " name=" KEMBALI " id="cancel" value=" BATAL "  onclick="history.back();"/> Batal </button></td>
    </tr>
	</table>
						</fieldset>
			</form>
 
  </td>
  
  </tr> 
</table>

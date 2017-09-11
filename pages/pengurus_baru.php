<?php
// include_once "lib/seslogin.php";
include_once "page/lib/dtpengurus2.php";
$eno ="2018-09-25";
// $Kode=$_GET['Kode'];
$Kode	 = isset($_GET['Kode']) ?  $_GET['Kode'] : $_SESSION['JAHRAKAL']; 
if($_GET) {
	if(isset($_POST['btnSave'])){
		$pesanError = array();
		if (trim($_POST['txt1'])=="") {
			$pesanError[] = "Data <b>".$field1."</b> tidak boleh kosong !";		
		} 
		$txt1= $_POST['txt1'];
		$txt2= $_POST['txt2'];
		$txt3= $_POST['txt3'];
		$txt3a= strtotime($txt3);
		$txt4= $_POST['txt4']; 
		$txt4a= strtotime($txt4);
		$txt5= $_POST['txt5']; 
		$txt6= $_POST['txt6']; 
		$txt7= $_POST['txt7'];
		$txt8= $_POST['txt8'];
		$txt9= $_POST['txt9'];
		$txt10= $_POST['txt10']; 
		$txt11= $_POST['txt11']; 
		$txt12= $_POST['txt12']; 
		$txt13= $_POST['txt13'];  
		
		$cekSql="SELECT * FROM ".$tableName." WHERE ".$field1."='$txt1' AND  ".$field2."='$txt2'";
		$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, ".$isian1." <b> $txt1 </b> sudah ada, ganti dengan yang lain";
		}		
		  
		if($txt3a>=$txt4a){
			$pesanError[] = "Maaf, ".$isian3." <b> $txt3 </b> lebih akhir dari pada  ".$isian4." <b> $txt4 </b> ";
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
			$mySql	= "INSERT INTO  ".$tableName." (".$field1.",".$field2.",".$field3.",".$field4.",".$field5.",".$field6.",".$field7.",".$field8.",".$field9.",".$field10.",".$field11.",".$field12.",".$field13.") VALUES ('$txt1','$txt2','$txt3','$txt4','$txt5','$txt6','$txt7','$txt8','$txt9','$txt10','$txt11','$txt12','$txt13')";
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query ".mysqli_error($koneksidb));
			if($myQry){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendaftaran Pengurus Organisasi Baru Telah Berhasil Disimpan, sebentar lagi Anda akan diarahkan untuk pendaftaran Akun baru.</div>';
				echo "<meta http-equiv='refresh' content='3; url=?page=Akun-Baru&Kode=".$txt1."'>";	 
				} 
			exit;
		}
	} // Penutup POST
	$data0	= buatKode($tableName, $huruftgl);
	$data1	= isset($_POST['txt1']) ? $_POST['txt1'] : '';
	$data2	= isset($_POST['txt2']) ? $_POST['txt2'] : '';
	$data3	= isset($_POST['txt3']) ? $_POST['txt3'] : '';
	$data4	= isset($_POST['txt4']) ? $_POST['txt4'] : '';
	$data5	= isset($_POST['txt5']) ? $_POST['txt5'] : '';
	$data6	= isset($_POST['txt6']) ? $_POST['txt6'] : '';
	$data7	= isset($_POST['txt7']) ? $_POST['txt7'] : '';
	$data8	= isset($_POST['txt8']) ? $_POST['txt8'] : '';
	$data9	= isset($_POST['txt9']) ? $_POST['txt9'] : '';
	$data10	= isset($_POST['txt10']) ? $_POST['txt10'] : '';
	$data11	= isset($_POST['txt11']) ? $_POST['txt11'] : '';
	$data12	= isset($_POST['txt12']) ? $_POST['txt12'] : '';
	$data13	= isset($_POST['txt13']) ? $_POST['txt13'] : '';
	// $data14	= isset($_POST['txt14']) ? $_POST['txt14'] : 'Banjarbaru Utara';
	// $data15	= isset($_POST['txt15']) ? $_POST['txt15'] : 'Banjarbaru';
	// $data16	= isset($_POST['txt16']) ? $_POST['txt16'] : '';
	// $data17	= isset($_POST['txt17']) ? $_POST['txt17'] : '';
	// $data18	= isset($_POST['txt18']) ? $_POST['txt18'] : '';
} // Penutup GET

	getAde($tableName,$eno);
	$now = strtotime(date("Y-m-d"));
	$maxage = date('Y-m-d', strtotime('- 0 year', $now));
	$minage = date('Y-m-d', strtotime('+ 0 year', $now));
?>


  <form id="new-project" class="form-horizontal" action="?page=<?php echo $formName;?>-Baru" method="post" name="form1" target="_self">
						<fieldset>
						<table class="table table-striped">
							<tr>
      <th colspan="3" scope="col"><h2>Form Registrasi <?php  echo $formName ?> Organisasi</h2></th>
    </tr> 
    <tr>
      <td width="24%"><b><?php echo $isian1; ?></b></td>
      <td width="2%"><b>:</b></td>
      <td width="74%"><input name="txt1" class="span4"  type="text" value="<?php echo $Kode; ?>" size="60" readonly required/></td>
    </tr>
    <tr>
      <td><b><?php echo $isian2; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt2" class="span4"  type="text" value="<?php echo $data2; ?>" size="60" maxlength="100"  required/></td>
    </tr>
	<tr>
      <td><b><?php echo $isian3; ?></b></td>
      <td><b>:</b></td>
      <td>Dari <input name="txt3" type="text"   data-date-format="yyyy-mm-dd" value="<?php echo $data3; ?>" class="datepicker span2" required/> 
	 Hingga <input name="txt4"   type="text" data-date-format="yyyy-mm-dd" value="<?php echo $data4; ?>" class="datepicker span2" required/> 
	  </td>		
    </tr>
     
    <tr>
      <td><b><?php echo $isian5; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt5" class="span6"  type="text" value="<?php echo $data5; ?>" size="60" maxlength="150"  required/></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian6; ?></b></td>
      <td><b>:</b></td>
      <td>  <input name="txt6" class="span6"  type="text" value="<?php echo $data6; ?>" size="60" maxlength="150"  required/></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian7; ?></b></td>
      <td><b>:</b></td>
      <td> <input name="txt7" class="span6"  type="text" value="<?php echo $data7; ?>" size="60"  onkeyup="validAngka(this)"  pattern="[0-9]{9,12}"  maxlength="12"   required/></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian8; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt8" class="span6" type="text" value="<?php echo $data8; ?>" size="60" maxlength="150" required/></td>
    </tr> 
    <tr>
      <td><b><?php echo $isian9; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt9" class="span6" type="text" value="<?php echo $data9; ?>" size="60" maxlength="150" required/></td>
    </tr>
    <tr>
      <td><b><?php echo $isian10; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt10" class="span6" type="text" value="<?php echo $data10; ?>" size="60"  onkeyup="validAngka(this)"  pattern="[0-9]{9,12}"  maxlength="12"  required/></td>
    </tr>  
    <tr>
      <td><b><?php echo $isian11; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt11" class="span6" type="text" value="<?php echo $data11; ?>" size="60" maxlength="150"  /></td>
    </tr>  
    <tr>
      <td><b><?php echo $isian12; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt12" class="span6" type="text" value="<?php echo $data12; ?>" size="60" maxlength="150"  /></td>
    </tr>  
    <tr>
      <td><b><?php echo $isian13; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt13" class="span6" type="text" value="<?php echo $data13; ?>" size="60"  onkeyup="validAngka(this)"  pattern="[0-9]{9,12}"  maxlength="12" /></td>
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

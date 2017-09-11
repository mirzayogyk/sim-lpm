<?php
// include_once "lib/seslogin.php";
include_once "page/lib/dtakun3.php";
$eno ="2018-09-25";
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
		$txt4= $_POST['txt4']; 
		$txt4a= $_POST['txt4a']; 
		
		$cekSql="SELECT * FROM ".$tableName." WHERE ".$field2."='$txt2'";
		$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, ".$isian2." <b> $txt2 </b> sudah ada, ganti dengan yang lain";
		}		
		$cekSql="SELECT * FROM ".$tableName." WHERE ".$field3."='$txt3'";
		$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, ".$isian3." <b> $txt3 </b> sudah ada pada database kami,silakan ganti dengan yang lain";
		}	 	 
		if($txt4!=$txt4a){
			$pesanError[] = "Maaf, ".$isian4." dan Ulangi Passsword tidak sesuai, silakan ulang kembali";
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
			$txt4b = hash_pass5($txt4);
			$kodeBaru	= buatKode($tableName, $huruf);
			$mySql	= "INSERT INTO ".$tableName." (".$field1.",".$field2.",".$field3.",".$field4.") VALUES ('$txt1','$txt2','$txt3','$txt4b')";
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query ".mysqli_error($koneksidb));
			// $mySql	= "INSERT INTO `tpengurus`(`no_register`, `no_sk`, `masa_pengurus_awal`, `masa_pengurus_akhir`, `nama_ketua`, `alamat_ketua`, `telepon_ketua`, `nama_sekretaris`, `alamat_sekretaris`, `telepon_sekretaris`, `nama_bendahara`, `alamat_bendahara`, `telepon_bendahara`) SELECT `no_register`, `no_sk`, `masa_pengurus_awal`, `masa_pengurus_akhir`, `nama_ketua`, `alamat_ketua`, `telepon_ketua`, `nama_sekretaris`, `alamat_sekretaris`, `telepon_sekretaris`, `nama_bendahara`, `alamat_bendahara`, `telepon_bendahara` FROM `tpengurus_temp` WHERE no_register='$txt1'";
			// $myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query 2 ".mysqli_error($koneksidb));
			// $mySql	= "INSERT INTO `tdataormas`(`no_register`, `tanggal_register`, `nama_ormas`, `nama_singkat`, `id_bentukormas`, `id_sifatormas`, `alamat`, `telepon`, `email`, `status`) SELECT `no_register`, `tanggal_register`, `nama_ormas`, `nama_singkat`, `id_bentukormas`, `id_sifatormas`, `alamat`, `telepon`, `email`, `status` FROM `tdataormas_temp` WHERE no_register='$txt1'";
			// $myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query 3 ".mysqli_error($koneksidb)); 	
			// $mySql = "DELETE FROM tpengurus_temp  WHERE no_register='$txt1'";
			// $myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysql_error());		
			// $mySql = "DELETE FROM tdataormas_temp  WHERE no_register='$txt1'";
			// $myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysql_error());			
			if($myQry){  
				$subject= "Notifikasi Pendataan Baru"; 
 

				$messages="<h4>Notifikasi Pendataan Baru!</h4><br /> No Registrasi: ".$txt1." <br />  Email: ".$txt2." <br /> Username: ".$txt3." <br /> Harap Segera Verifikasi Data baru yang telah masuk. 
				<br/> Silakan Login menuju web <a href='http://sinormas-tapin.com/mimin'>SINORMAS</a>, Terima Kasih";
 
				$headers .= 'From: SINORMAS TAPIN <admin@sinormas-tapin.com>'."\r\n" ;
				$headers .= 'Reply-To: Admin SINORMAS <kesbangpol.tapin@gmail.com> '."\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$mail_sent = @mail("kesbangpol.tapin@gmail.com", $subject, $messages, $headers);
				 
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendataan Akun Baru Telah Berhasil Disimpan.</div>';
				echo "<meta http-equiv='refresh' content='1; url=?page=Terima-Kasih'>";	
				}
			else {
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendataan Ormas Baru Gagal! Hubungi Administrator.</div>';
			}	
			exit;
		}
	} // Penutup POST
	$data0	= buatKode($tableName, $huruftgl);
	$data1	= isset($_POST['txt1']) ? $_POST['txt1'] : '';
	$data2	= isset($_POST['txt2']) ? $_POST['txt2'] : '';
	$data3	= isset($_POST['txt3']) ? $_POST['txt3'] : '';
	$data4	= isset($_POST['txt4']) ? $_POST['txt4'] : '';
	// $data5	= isset($_POST['txt5']) ? $_POST['txt5'] : '';
	// $data6	= isset($_POST['txt6']) ? $_POST['txt6'] : '';
	// $data7	= isset($_POST['txt7']) ? $_POST['txt7'] : '';
	// $data8	= isset($_POST['txt8']) ? $_POST['txt8'] : '';
	// $data9	= isset($_POST['txt9']) ? $_POST['txt9'] : '';
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

	getAde($tableName,$eno);
	// $now = strtotime(date("Y-m-d"));
	// $maxage = date('Y-m-d', strtotime('- 17 year', $now));
	// $minage = date('Y-m-d', strtotime('- 70 year', $now));
?>


  <form id="new-project" class="form-horizontal" action="?page=<?php echo $formName;?>-Baru" method="post" name="form1" target="_self">
						<fieldset>
						<table class="table  table-striped">
							<tr>
      <th colspan="3" scope="col"><h2>Form Registrasi <?php  echo $formName ?> Baru</h2></th>
    </tr> 
    <tr>
      <td width="24%"><b><?php echo $isian1; ?></b></td>
      <td width="2%"><b>:</b></td>
      <td width="74%"><input name="txt1" class="span2"  type="text" value="<?php echo $Kode; ?>" size="60"  readonly required/></td>
    </tr>
    <tr>
      <td><b><?php echo $isian2; ?></b></td>
      <td><b>:</b></td>
      <td>  
	   <input name="txt2" class="span6"  type="email" value="<?php echo $data2; ?>" size="60" maxlength="100" required/>  </td>
    </tr>
	<tr>
      <td><b><?php echo $isian3; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt3" class="span6"  type="text" value="<?php echo $data3; ?>" size="60" maxlength="16" onkeyup="validHuruf(this)" pattern="[A-Z a-z.0-9]{3,16}"  required/></td>		
    </tr>
     <tr>
      <td><b><?php echo $isian4; ?></b></td>
      <td><b>:</b></td>
      <td><input name="txt4" class="span6"  type="password" value="<?php echo $data4; ?>" size="60" maxlength="64"required/></td>
    </tr> 
     <tr>
      <td><b>Ulangi Password</b></td>
      <td><b>:</b></td>
      <td><input name="txt4a" class="span6"  type="password" value="<?php echo $data4; ?>" size="60" maxlength="64"required/></td>
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

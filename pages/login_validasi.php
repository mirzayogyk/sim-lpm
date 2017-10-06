<?php 
include ('library\connection.php'); 
if($_GET) { 
	if(isset($_POST['btnLogin'])){
		$pesanError = array();
		if ( trim($_POST['txtUser'])=="") {
			$pesanError[] = "Data <b> User ID </b>  tidak boleh kosong !";		
		}
		if (trim($_POST['txtPassword'])=="") {
			$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";		
		}
		
		if(!isset($_SESSION['captchakuis'])){
		// die("isi form komentar dulu");
		$pesanError[] = "Mohon isi Captcha untuk verifikasi Anti Spam!";
		
		}
		if($_POST['jawaban'] != $_SESSION['captchakuis']){
			unset($_SESSION['captchakuis']);
			// die("Salah");
		$pesanError[] = "Kode Matematika yang anda masukkan salah";
			
		}
		#if (trim($_POST['cmbLevel'])=="BLANK") {
		#	$pesanError[] = "Data <b>Level</b> belum dipilih !";		
		#}
		
		# Baca variabel form
		$txtUser 	= $_POST['txtUser'];
		$txtUser 	= str_replace("'","&acute;",$txtUser);
		
		$txtPassword=$_POST['txtPassword'];
		$txtPassword= str_replace("'","&acute;",$txtPassword);
		
		$txtProdi	=$_POST['txtProdi'];
		
		unset($_SESSION['captchakuis']);
		# JIKA ADA PESAN ERROR DARI VALIDASI	

		if (count($pesanError)>=1 ){
            echo "<div class='mssgBox'>"; 
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++; 
			echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$pesan_tampil.'</div><br>';	
				} 
			echo "</div> <br>";  
			
			// Tampilkan lagi form login
			echo "<meta http-equiv='refresh' content='5; url=?page=Halaman-Utama'>";
		}
		else {
			# LOGIN CEK KE TABEL USER LOGIN
			$loginSql = "SELECT * FROM user WHERE username='".$txtUser.
						#"' AND password='".md5($txtPassword)."' AND level='$cmbLevel'";
						"' AND password='".md5($txtPassword)."'";
			$loginQry = mysqli_query($koneksidb, $loginSql)  
						or die ("Query Salah : ".mysql_error());

			if($loginQry){
				if (mysqli_num_rows($loginQry) >=1) {
					$loginData = mysqli_fetch_array($loginQry);
					$_SESSION['USERMRZ'] = $loginData['username']; 
					$_SESSION['NAMEMRZ'] = $loginData['password']; 
					$_SESSION['PRODIMRZA'] = $txtProdi;
					if($loginData['level']=="DOSEN") {
						$_SESSION['dosen'] = $loginData['level'];
					}
					if($loginData['level']=="KETUA KELAS") {
						$_SESSION['ketuakelas'] = $loginData['level'];
					}
					buatLog($loginData['username'],"LOGGED IN","NULL");
					echo "<meta http-equiv='refresh' content='0; url=?page=Halaman-Utama'>";
				}
				else {
					echo "<div class='mssgBox'>";
					echo "<img src='images/attention.png'> <br><hr>";
					 echo "Username atau Password Salah  ";
					 echo "</hr></div>  ";
				}
			}
		}
	} // End POST
	else
	{
		session_unset();
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=?page'>";
		exit;
	}
} // End GET
?>
 

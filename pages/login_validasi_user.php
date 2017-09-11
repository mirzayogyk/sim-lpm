<?php 
include ('lib\connection.php');
if($_GET) { 
	
	if(isset($_POST['btnLogin'])){
		$pesanError = array();
		if ( trim($_POST['txtUser'])=="") {
			$pesanError[] = "Data <b> User ID </b>  tidak boleh kosong !";		
		}
		if (trim($_POST['txtPassword'])=="") {
			$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";		
		}
		#if (trim($_POST['cmbLevel'])=="BLANK") {
		#	$pesanError[] = "Data <b>Level</b> belum dipilih !";		
		#}
		
		# Baca variabel form
		$txtUser 	= $_POST['txtUser'];
		$txtUser 	= str_replace("'","&acute;",$txtUser);
		
		$txtPassword=$_POST['txtPassword'];
		$txtPassword= str_replace("'","&acute;",$txtPassword);
		
		#$cmbLevel	=$_POST['cmbLevel'];
		
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
			echo "<meta http-equiv='refresh' content='3; url=?page=Halaman-Utama'>";
		}
		else {
			# LOGIN CEK KE TABEL USER LOGIN
			$loginSql = "SELECT * FROM takun WHERE username='".$txtUser.
						"' AND password='".hash_pass5($txtPassword)."' AND status='1'";
						#"' AND password='".$txtPassword."' AND status='1' ";
			$loginQry = mysqli_query($koneksidb, $loginSql)  
						or die ("Query Salah : ".mysqli_error());

			if($loginQry){
				if (mysqli_num_rows($loginQry) >=1) {
					$loginData = mysqli_fetch_array($loginQry);
					$_SESSION['BONCLINK_M4SUK'] = $loginData['no_register']; 
					$_SESSION['NGARAN_SHARPSHOOT3R'] = $loginData['username'];  
					$_SESSION['NGINX_NYA'] = $loginData['email_akun']; 
					$_SESSION['MAIN_DOTA_KAH']  = $loginData['no_register'];
					 
					// Refresh
					echo "<meta http-equiv='refresh' content='0; url=?page=Halaman-Utama'>";
				}
				else {
					echo "<div class='mssgBox'>";
					// echo "<img src='img/attention.png'> <br><hr>";
					 echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>Username atau Password salah</div><br> ';
					 echo "</hr></div>  ";
					 echo "<meta http-equiv='refresh' content='3; url=?page=Halaman-Utama'>";
				}
			}
		}
	} // End POST
	else
	{
		session_unset();
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=?page=Ormas-Baru'>";
		exit;
	}
} // End GET
?>
 

<?php
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
if (count($pesanError)>=1 ){
            echo "<div class='mssgBox'>"; 
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++; 
			echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$pesan_tampil.'</div><br>';	
				} 
			echo '</div><button type="button" class="btn  btn-warning" name=" KEMBALI " id="back" value=" Kembali " onclick="history.back();" />Kembali</button>  <br> '; 
		}
		else {
			
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$no_register=$_POST['no_register'];
// $to=$email;

$messages="Pesan Baru dari Website SIMBa (Sistem Informasi Manajemen Barang) </br> dengan No Registrasi ".$no_register." <br> Nama User :".$name." <br />  Pesan : ".$message;

 
 
$headers .= 'From: Kontak User Ormas <admin@sinormas-tapin.com>'."\r\n" ;
$headers .= 'Reply-To: '.$name.' <'.$email.'>'."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$mail_sent = @mail("havid.aide@gmail.com", $subject, $messages, $headers);
echo $mail_sent ? '<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Terkirim</h4> Terima kasih telah menggunakan jasa layanan kontak kami. Silakan tunggu pada email Anda, kami akan segera merespon pesan Anda.</div><br>' : '
Gagal';

		}
		
?> 
 
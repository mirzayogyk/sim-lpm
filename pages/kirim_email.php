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
		
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];

// $to=$email;

$messages="Dari:".$name." <br /> Pesan: ".$message;

 
 
$headers .= 'From: Kontak Pengunjung <admin@sinormas-tapin.com>'."\r\n" ;
$headers .= 'Reply-To: '.$name.' <'.$email.'>'."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$mail_sent = @mail("havid.aide@gmail.com", $subject, $messages, $headers);
echo $mail_sent ? "Terkirim" : "
Gagal";
?> 
 
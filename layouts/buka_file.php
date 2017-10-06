<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch ($_GET['page']){				
		case '' :				
			if(!file_exists ("pages/home.php")) include "pages/404.php"; 
			include "pages/home.php";	break;
		
		case 'Error' :				
			if(!file_exists ("page/404.php")) die ("Halaman Rusak!"); 
			include "page/404.php";	break;
			
		case 'Home' :				
			if(!file_exists ("pages/home.php")) die ("Sorry Empty Page!"); 
			include "pages/home.php";	break;		

		case 'Terima-Kasih' :				
			if(!file_exists ("page/terima_kasih.php")) die ("Sorry Empty Page!"); 
			include "page/terima_kasih.php";	break;
		
		case 'Login' :				
			if(!file_exists ("superadmin/index.php")) die ("Sorry Empty Page!"); 
			include "superadmin/index.php";	break;
			
		case 'Generator' :				
			if(!file_exists ("pages/generator.php")) die ("Sorry Empty Page!"); 
			include "pages/generator.php";	break;	 
	

		# LOGIN USER
		case 'Login' :				
			if(!file_exists ("pages/login.php")) die ("Sorry Empty Page!"); 
			include "pages/login.php"; break;
		case 'Login-Admin' :				
			if(!file_exists ("pages/login.php")) die ("Sorry Empty Page!"); 
			include "pages/login.php"; break;
		case 'Login-Ormas' :				
			if(!file_exists ("pages/login_user.php")) die ("Sorry Empty Page!"); 
			include "pages/login_user.php"; break;
			
		case 'Login-Validasi' :				
			if(!file_exists ("pages/login_validasi.php")) die ("Sorry Empty Page!"); 
			include "pages/login_validasi.php"; break;
			
		case 'Login-Validasi-User' :				
			if(!file_exists ("pages/login_validasi_user.php")) die ("Sorry Empty Page!"); 
			include "pages/login_validasi_user.php"; break;
			
		case 'Logout' :				
			if(!file_exists ("pages/login_out.php")) die ("Sorry Empty Page!"); 
			include "pages/login_out.php"; break;		
  						
 
			case 'Fakultas-Data' :			
			if(!file_exists ('pages/masters/fakultas_data.php')) include "pages/404.php"; 
			include 'pages/masters/fakultas_data.php'; break;
  
			case 'Fakultas-Edit' :		
			if(!file_exists ('pages/masters/fakultas_edit.php')) include "pages/404.php"; 
			include 'pages/masters/fakultas_edit.php'; break;
  
			case 'Fakultas-Delete' :			
			if(!file_exists ('pages/masters/fakultas_delete.php')) include "pages/404.php"; 
			include 'pages/masters/fakultas_delete.php'; break;
  						
 
			case 'Prodi-Data' :			
			if(!file_exists ('pages/masters/prodi_data.php')) include "pages/404.php"; 
			include 'pages/masters/prodi_data.php'; break;
  
			case 'Prodi-Edit' :		
			if(!file_exists ('pages/masters/prodi_edit.php')) include "pages/404.php"; 
			include 'pages/masters/prodi_edit.php'; break;
  
			case 'Prodi-Delete' :			
			if(!file_exists ('pages/masters/prodi_delete.php')) include "pages/404.php"; 
			include 'pages/masters/prodi_delete.php'; break;
  						
 
			case 'Tahun-Data' :			
			if(!file_exists ('pages/masters/tahun_data.php')) include "pages/404.php"; 
			include 'pages/masters/tahun_data.php'; break;
  
			case 'Tahun-Edit' :		
			if(!file_exists ('pages/masters/tahun_edit.php')) include "pages/404.php"; 
			include 'pages/masters/tahun_edit.php'; break;
  
			case 'Tahun-Delete' :			
			if(!file_exists ('pages/masters/tahun_delete.php')) include "pages/404.php"; 
			include 'pages/masters/tahun_delete.php'; break;
  						
 
			case 'Presensi-Data' :			
			if(!file_exists ('pages/masters/presensi_data.php')) include "pages/404.php"; 
			include 'pages/masters/presensi_data.php'; break;
  
			case 'Presensi-Edit' :		
			if(!file_exists ('pages/masters/presensi_edit.php')) include "pages/404.php"; 
			include 'pages/masters/presensi_edit.php'; break;
  
			case 'Presensi-Delete' :			
			if(!file_exists ('pages/masters/presensi_delete.php')) include "pages/404.php"; 
			include 'pages/masters/presensi_delete.php'; break;
  						
			#MARKER 

			

			

			

			

			

			

			

			

			

			

			

			
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("pages/home.php")) include "pages/404.php"; 
	include "pages/home.php";	
}
?>
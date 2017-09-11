<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch ($_GET['page']){				
		case '' :				
			if(!file_exists ("page/home.php")) die ("page/404.php"); 
			include "page/home.php";	break;
		
		case 'Error' :				
			if(!file_exists ("page/404.php")) die ("Halaman Rusak!"); 
			include "page/404.php";	break;
			
		case 'Halaman-Utama' :				
			if(!file_exists ("page/home.php")) die ("Sorry Empty Page!"); 
			include "page/home.php";	break;		

		case 'Terima-Kasih' :				
			if(!file_exists ("page/terima_kasih.php")) die ("Sorry Empty Page!"); 
			include "page/terima_kasih.php";	break;	
			
		case 'Kirim' :				
			if(!file_exists ("page/kirim_email_user.php")) die ("Sorry Empty Page!"); 
			include "page/kirim_email_user.php";	break;	 
	

		# LOGIN USER
		case 'Login' :				
			if(!file_exists ("cont/login.php")) die ("Sorry Empty Page!"); 
			include "cont/login.php"; break;
		case 'Login-Admin' :				
			if(!file_exists ("cont/login.php")) die ("Sorry Empty Page!"); 
			include "cont/login.php"; break;
		case 'Login-Ormas' :				
			if(!file_exists ("cont/login_user.php")) die ("Sorry Empty Page!"); 
			include "cont/login_user.php"; break;
			
		case 'Login-Validasi' :				
			if(!file_exists ("cont/login_validasi.php")) die ("Sorry Empty Page!"); 
			include "cont/login_validasi.php"; break;
			
		case 'Login-Validasi-User' :				
			if(!file_exists ("cont/login_validasi_user.php")) die ("Sorry Empty Page!"); 
			include "cont/login_validasi_user.php"; break;
			
		case 'Logout' :				
			if(!file_exists ("cont/login_out.php")) die ("Sorry Empty Page!"); 
			include "cont/login_out.php"; break;		
		
		#DEFAULT PAGE
		case 'Setting' :				
			if(!file_exists ("page/settings.php")) die ("Sorry Empty Page!"); 
			include "page/settings.php"; break;
		case 'Home' :				
			if(!file_exists ("page/home.php")) die ("Sorry Empty Page!"); 
			include "page/home.php"; break;
		case 'Bantuan' :				
			if(!file_exists ("page/help.php")) die ("Sorry Empty Page!"); 
			include "page/help.php"; break;
		case 'Profil' :				
			if(!file_exists ("page/profil.php")) die ("Sorry Empty Page!"); 
			include "page/profil.php"; break;
		case 'Project' :				
			if(!file_exists ("page/projects.php")) die ("Sorry Empty Page!"); 
			include "page/projects.php"; break;
		case 'Jadwal' :				
			if(!file_exists ("page/tasks.php")) die ("Sorry Empty Page!"); 
			include "page/tasks.php"; break;
		case 'Pesan' :				
			if(!file_exists ("page/messages.php")) die ("Sorry Empty Page!"); 
			include "page/messages.php"; break;
		case 'Berkas' :				
			if(!file_exists ("page/files.php")) die ("Sorry Empty Page!"); 
			include "page/files.php"; break;
		case 'Kegiatan' :				
			if(!file_exists ("page/activity.php")) die ("Sorry Empty Page!"); 
			include "page/activity.php"; break;
		case 'Gallery' :				
			if(!file_exists ("page/gallery.php")) die ("Sorry Empty Page!"); 
			include "page/gallery.php"; break;
		case 'Kosong' :				
			if(!file_exists ("page/blank.php")) die ("Sorry Empty Page!"); 
			include "page/blank.php"; break;
		case 'Tata-Cara' :				
			if(!file_exists ("page/tatacara.php")) die ("Sorry Empty Page!"); 
			include "page/tatacara.php"; break;
		case 'Dasar-Hukum' :				
			if(!file_exists ("page/hukum.php")) die ("Sorry Empty Page!"); 
			include "page/hukum.php"; break;
		case 'Kontak' :				
			if(!file_exists ("page/kontak.php")) die ("Sorry Empty Page!"); 
			include "page/kontak.php"; break; 
		case 'Barang' :				
			if(!file_exists ("page/barang_data.php")) die ("Sorry Empty Page!"); 
			include "page/barang_data.php"; break;
		case 'Barang-Aset' :				
			if(!file_exists ("page/barang_data_aset.php")) die ("Sorry Empty Page!"); 
			include "page/barang_data_aset.php"; break;
		case 'Barang-Non-Aset' :				
			if(!file_exists ("page/barang_data_nonaset.php")) die ("Sorry Empty Page!"); 
			include "page/barang_data_nonaset.php"; break;  
			
	# MAIN #SUPER ADMIN
		case 'Master' :				
			if(!file_exists ("su/master.php")) die ("Sorry Empty Page!"); 
			include "su/master.php";	break;
	# MAIN #SUPER ADMIN
		case 'Backup-Data' :				
			if(!file_exists ("page/mast/backup-new.php")) die ("Sorry Empty Page!"); 
			include "page/mast/backup-new.php";	break; 
			
	# USER DATA  #SUPER ADMIN		
		case 'Pengguna-Data' :				
			if(!file_exists ("page/mast/user_data.php")) die ("Sorry Empty Page!"); 
			include "page/mast/user_data.php";	break;
		case 'Pengguna-Delete' :
			if(!file_exists ("page/mast/user_delete.php")) die ("Sorry Empty Page!"); 
			include "page/mast/user_delete.php"; break;		
		case 'Pengguna-Edit' :				
			if(!file_exists ("page/mast/user_edit.php")) die ("Sorry Empty Page!"); 
			include "page/mast/user_edit.php"; break;			
		case 'Pengguna-Add' :				
			if(!file_exists ("page/mast/user_add.php")) die ("Sorry Empty Page!"); 
			include "page/mast/user_add.php"; break;			
				
	# TETIMONI DATA  #SUPER ADMIN		
		case 'Testimonial' :				
			if(!file_exists ("page/pesan.php")) die ("Sorry Empty Page!"); 
			include "page/pesan.php";	break;
		case 'Testimonial-User' :				
			if(!file_exists ("page/pesan_user.php")) die ("Sorry Empty Page!"); 
			include "page/pesan_user.php";	break;
		case 'Testimonial-Data' :				
			if(!file_exists ("page/mast/pesan_data.php")) die ("Sorry Empty Page!"); 
			include "page/mast/pesan_data.php";	break;
		case 'Testimonial-Delete' :
			if(!file_exists ("page/mast/pesan_delete.php")) die ("Sorry Empty Page!"); 
			include "page/mast/pesan_delete.php"; break;		
		case 'Testimonial-Edit' :				
			if(!file_exists ("page/mast/pesan_edit.php")) die ("Sorry Empty Page!"); 
			include "page/mast/pesan_edit.php"; break;			
		case 'Testimonial-Terima' :				
			if(!file_exists ("page/mast/pesan_terima.php")) die ("Sorry Empty Page!"); 
			include "page/mast/pesan_terima.php"; break;			
		case 'Testimonial-Tolak' :				
			if(!file_exists ("page/mast/pesan_tolak.php")) die ("Sorry Empty Page!"); 
			include "page/mast/pesan_tolak.php"; break;		
			
	# RUANGAN DATA  #SUPER ADMIN		
		case 'Ruangan-Data' :				
			if(!file_exists ("page/mast/ruangan_data.php")) die ("Sorry Empty Page!"); 
			include "page/mast/ruangan_data.php";	break;
		case 'Ruangan-Delete' :
			if(!file_exists ("page/mast/ruangan_delete.php")) die ("Sorry Empty Page!"); 
			include "page/mast/ruangan_delete.php"; break;		
		case 'Ruangan-Edit' :				
			if(!file_exists ("page/mast/ruangan_edit.php")) die ("Sorry Empty Page!"); 
			include "page/mast/ruangan_edit.php"; break;			
		case 'Ruangan-Add' :				
			if(!file_exists ("page/mast/ruangan_add.php")) die ("Sorry Empty Page!"); 
			include "page/mast/ruangan_add.php"; break;			
		case 'Ruangan-Detail' :				
			if(!file_exists ("page/mast/ruangan_detail.php")) die ("Sorry Empty Page!"); 
			include "page/mast/ruangan_detail.php"; break;	
			
	# KONDISI DATA  #SUPER ADMIN		
		case 'Kondisi-Data' :				
			if(!file_exists ("page/mast/kondisi_data.php")) die ("Sorry Empty Page!"); 
			include "page/mast/kondisi_data.php";	break;
		case 'Kondisi-Delete' :
			if(!file_exists ("page/mast/kondisi_delete.php")) die ("Sorry Empty Page!"); 
			include "page/mast/kondisi_delete.php"; break;		
		case 'Kondisi-Edit' :				
			if(!file_exists ("page/mast/kondisi_edit.php")) die ("Sorry Empty Page!"); 
			include "page/mast/kondisi_edit.php"; break;			
		case 'Kondisi-Add' :				
			if(!file_exists ("page/mast/kondisi_add.php")) die ("Sorry Empty Page!"); 
			include "page/mast/kondisi_add.php"; break;			
		case 'Kondisi-Detail' :				
			if(!file_exists ("page/mast/kondisi_detail.php")) die ("Sorry Empty Page!"); 
			include "page/mast/kondisi_detail.php"; break;	
		
	# BARANG DATA  #SUPER ADMIN		
		case 'Barang-Data' :				
			if(!file_exists ("page/mast/barang_data.php")) die ("Sorry Empty Page!"); 
			include "page/mast/barang_data.php";	break;
		case 'Barang-Delete' :
			if(!file_exists ("page/mast/barang_delete.php")) die ("Sorry Empty Page!"); 
			include "page/mast/barang_delete.php"; break;		
		case 'Barang-Edit' :				
			if(!file_exists ("page/mast/barang_edit.php")) die ("Sorry Empty Page!"); 
			include "page/mast/barang_edit.php"; break;			
		case 'Barang-Add' :				
			if(!file_exists ("page/mast/barang_add.php")) die ("Sorry Empty Page!"); 
			include "page/mast/barang_add.php"; break;			
		case 'Barang-Detail' :				
			if(!file_exists ("page/mast/barang_detail.php")) die ("Sorry Empty Page!"); 
			include "page/mast/barang_detail.php"; break;	
	
	#LAPORAN
	case 'Laporan-Detail' :				
			if(!file_exists ("page/laporan/laporan_modif.php")) die ("Sorry Empty Page!"); 
			include "page/laporan/laporan_modif.php"; break;
	case 'Laporan-Detail-Aset' :				
			if(!file_exists ("page/laporan/laporan_modif_aset.php")) die ("Sorry Empty Page!"); 
			include "page/laporan/laporan_modif_aset.php"; break;
	case 'Laporan-Detail-Non-Aset' :				
			if(!file_exists ("page/laporan/laporan_modif_nonaset.php")) die ("Sorry Empty Page!"); 
			include "page/laporan/laporan_modif_nonaset.php"; break;	
	  
	 #LAPORAN
	case 'Tertanda-Data' :				
			if(!file_exists ("page/mast/tertanda_data.php")) die ("Sorry Empty Page!"); 
			include "page/mast/tertanda_data.php"; break;	
	  
	case 'Tertanda-Edit' :				
			if(!file_exists ("page/mast/tertanda_edit.php")) die ("Sorry Empty Page!"); 
			include "page/mast/tertanda_edit.php"; break;	
	  
	 
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("page/home.php")) die ("page/404.php"); 
	include "page/home.php";	
}
?>
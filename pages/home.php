<h1 align="center">BERITA ACARA</h1>
<?php
	if(isset($_SESSION['dosen'])) {?>
		
		<table class="table table-bordered table-striped"> 
			<tr> 
				<th width="30" align="center"><strong>No</strong></th> 
				<th><strong>Mata Kuliah - Kelas</strong></th>
				<th width="10"><strong>Option</strong></td> 
			</tr> 
				<?php 
				$NIDN = $_SESSION['USERMRZ'];
				$kode_prodi = $_SESSION['PRODIMRZ'];
				$row = 20; 
				$hal = 0;
				
				$cariSql = "SELECT * FROM m_tahun WHERE buka='Y'"; 
				$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
				while ($hasilCari = mysqli_fetch_array($cariQry)) {
				$tahun_id_aktif = $hasilCari['tahun_id'];
				}

				$pageSql = "SELECT t_jadwal.*, m_mata_kuliah.nama_mk, m_mata_kuliah.kode_mk, m_kelas.idk, m_kelas.kelas FROM t_jadwal 
								INNER JOIN m_mata_kuliah ON m_mata_kuliah.kode_mk = t_jadwal.kode_mk
								INNER JOIN m_kelas ON t_jadwal.kelas = m_kelas.idk 
								GROUP BY idj 
								HAVING t_jadwal.kode_prodi='$kode_prodi' 
									AND t_jadwal.tahun_id = '$tahun_id_aktif' 
									AND t_jadwal.NIDN = '$NIDN' 
								";
				$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".$pageSql); 
				$jml	 = mysqli_num_rows($pageQry); 
				$max	 = ceil($jml/$row); 
				$field[4]='nama_mk';
				tampilTabel1($koneksidb,$pageSql,$field,'Presensi',$hal,$row); 
				?> 
		</table> 
				<?php tabelFooter($jml,$row,$max,'Presensi',$hal) ?> 

	<?php }
	else if (isset($_SESSION['ketuakelas'])) {?>
			<table class="table table-bordered table-striped"> 
			<tr> 
				<th width="30" align="center"><strong>No</strong></th> 
				<th><strong>Mata Kuliah - Kelas</strong></th>
				<th width="10"><strong>Option</strong></td> 
			</tr> 
				<?php 
				$NPM = $_SESSION['USERMRZ'];
				$cariSql = "SELECT * FROM m_mahasiswa WHERE NIM='$NPM'"; 
				$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
				while ($hasilCari = mysqli_fetch_array($cariQry)) {
				$kode_prodi = $hasilCari['kode_prodi'];
				}
				$row = 20; 
				$hal = 0;
				
				$cariSql = "SELECT * FROM m_tahun WHERE buka='Y'"; 
				$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
				while ($hasilCari = mysqli_fetch_array($cariQry)) {
				$tahun_id_aktif = $hasilCari['tahun_id'];
				}

				$pageSql = "SELECT t_jadwal.*, m_mata_kuliah.nama_mk, m_mata_kuliah.kode_mk, m_kelas.idk, m_kelas.kelas FROM t_jadwal 
								INNER JOIN m_mata_kuliah ON m_mata_kuliah.kode_mk = t_jadwal.kode_mk
								INNER JOIN m_kelas ON t_jadwal.kelas = m_kelas.idk 
								GROUP BY idj 
								HAVING t_jadwal.kode_prodi='$kode_prodi' 
									AND t_jadwal.tahun_id = '$tahun_id_aktif' 
									AND t_jadwal.NIDN = '$NIDN' 
								";
				$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".$pageSql); 
				$jml	 = mysqli_num_rows($pageQry); 
				$max	 = ceil($jml/$row); 
				$field[4]='nama_mk';
				tampilTabel1($koneksidb,$pageSql,$field,'Presensi',$hal,$row); 
				?> 
		</table> 
				<?php tabelFooter($jml,$row,$max,'Presensi',$hal) ?> 
	<?php }
	else  {?>
		<div class="hero-unit">
			<legend align="center">LOGIN</legend>	 
			<div class="well"> 
				<!-- <p>Sistem Informasi Manajemen Barang merupakan perwujudan transparansi dari DPRD Kota Banjarbaru khususnya dan pemerintahan Indonesia pada umumnya. Sistem informasi ini memberikan informasi mengenai berbagai Aset yang ada pada Kantor Dewan Perwakilan Rakyat Daerah Kota Banjarbaru </p>  -->
				<form action="superadmin/index.php">
    					<input type="submit" class="btn btn-primary btn-block" value="LOGIN" />
				</form>
			</div>

	<?php }?>

			
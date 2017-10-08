<table class="table table-bordered table-striped"> 
			<tr> 
				<th width="30" align="center"><strong>No</strong></th> 
				<th><strong>Mata Kuliah - Kelas</strong></th>
				<th width="10"><strong>Option</strong></td> 
			</tr> 
                <?php 
                if($_GET) { 
                    $Kode	 = $_GET['Kode'];
                }
				$NIDN = $Kode;
				$kode_prodi = $_SESSION['PRODIMRZ'];
				$row = 20; 
				$hal = 0;
				
				$cariSql = "SELECT * FROM m_tahun WHERE buka='Y'"; 
				$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
				while ($hasilCari = mysqli_fetch_array($cariQry)) {
				$tahun_id_aktif = $hasilCari['tahun_id'];
				}

				$pageSql = "SELECT t_jadwal.*, m_mata_kuliah.nama_mk, m_mata_kuliah.kode_mk, m_kelas.idk, m_kelas.kelas, m_dosen.nama_dosen FROM t_jadwal 
								INNER JOIN m_mata_kuliah ON m_mata_kuliah.kode_mk = t_jadwal.kode_mk
								INNER JOIN m_kelas ON t_jadwal.kelas = m_kelas.idk 
								INNER JOIN m_dosen ON t_jadwal.nidn = m_dosen.nidn
								GROUP BY idj 
								HAVING t_jadwal.kode_prodi='$kode_prodi' 
									AND t_jadwal.tahun_id = '$tahun_id_aktif' 
									AND t_jadwal.userid = '$_SESSION[userid]' 
								";
				$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".$pageSql); 
				$jml	 = mysqli_num_rows($pageQry); 
				$max	 = ceil($jml/$row); 
				$field[4]='nama_mk';
				tampilTabelKK($koneksidb,$pageSql,$field,'Presensi',$hal,$row); 
				?> 
		</table> 
				<?php tabelFooter($jml,$row,$max,'Presensi',$hal) ?> 
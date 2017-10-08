<?php 
include_once "library/seslogin.php"; 
include_once "jadwal_config.php"; 
if($_GET) { 
	if(isset($_POST['btnSave'])){ 
 
		$txt[1] = date("Y-m-d h:i:sa"); 
		$txt[2] = NULL; 
		$txt[3] = $_POST['txt3']; 
		$txt[4] = $_POST['txt4']; 
		$txt[5] = $_POST['txt5']; 
		$txt[6] = $_POST['txt6']; 
		$txt[7] = $_POST['txt7']; 
		$txt[8] = $_POST['txt8']; 
		$txt[9] = $_POST['txt9']; 
		$txt[10] = $_POST['txt10']; 
		$txt[11] = $_POST['txt11']; 
		$txt[12] = $_POST['txt12']; 
		$txt[13] = $_POST['txt13']; 
		$txt[14] = $_POST['txt14']; 
		$txt[15] = $_POST['txt15']; 
		$txt[16] = $_POST['txt16']; 
		$txt[17] = $_POST['txt17']; 
		$txt[18] = $_POST['txt18']; 
		$txt[19] = $_POST['txt19']; 
		$txt[20] = $_POST['txt20']; 
 
		$pesanError = array(); 
		for($i=3;$i<=$jmlField;$i++){ 
			if (trim($txt[$i])=="") { 
				$pesanError[] = "Data <b>".$isian[$i]."</b> tidak boleh kosong !"; 
			} 
		} 
 
		// $ada = cekAda($koneksidb,$tableName,$field[3],$isian[3],$txt[3]); 
		// if($ada)        {  
		// 	$pesanError[] = "Maaf, ".$isian[3]." <b> ".$txt[3]." </b> Sudah Ada.";	 
		// } 
 
		if (count($pesanError)>=1 ){  
			echo "<div class='mssgBox'>";  
			$noPesan=0; 
			foreach ($pesanError as $indeks=>$pesan_tampil) {  
				$noPesan++;  
				echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a> 
				<h4 class="alert-heading">Error!</h4>'.$noPesan.'. '.$pesan_tampil.'</div><br>';	 
			}  
			echo "</div> <br>";  
			buatLog($_SESSION['USERMRZ'],"INSERT FAIL",getStringArray($pesanError)); 
		} 
		else { 
			$mySql	= "INSERT INTO ".$tableName." ".getInsert($jmlField,$field,$txt); 
			$myQry	= mysqli_query($koneksidb, $mySql) or die ("Gagal query insert :".getInsert($jmlField,$field,$txt)); 
			if($myQry){ 
			buatLog($_SESSION['USERMRZ'],"INSERT SUCCESS",$mySql); 
				echo "<meta http-equiv='refresh' content='0; url=?page=".$formName."-Data'>"; 
			} 
			exit; 
		} 
 
	} 

	$kode_prodi = $_SESSION['PRODIMRZ'];
	$cariSql = "SELECT m_program_studi.* FROM m_program_studi WHERE kode_prodi=$kode_prodi"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$kode_pt = $hasilCari['kode_pt'];
		$kode_fak = $hasilCari['kode_fak'];
		$kode_jenjang = $hasilCari['kode_jenjang'];
		$kode_jurusan = $hasilCari['kode_jurusan'];
	};
 
	$cariSql = "SELECT m_tahun.* FROM m_tahun WHERE buka='Y'"; 
	$cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
	while ($hasilCari = mysqli_fetch_array($cariQry)) {
		$tahun_id = $hasilCari['tahun_id'];
	}


	$data[1]	= isset($_POST['txt1']) ? $_POST['txt1'] : ''; 
	$data[2]	= isset($_POST['txt2']) ? $_POST['txt2'] : ''; 
	$data[3]	= isset($_POST['txt3']) ? $_POST['txt3'] : ''; 
	$data[4]	= isset($_POST['txt4']) ? $_POST['txt4'] : ''; 
	$data[5]	= isset($_POST['txt5']) ? $_POST['txt5'] : ''; 
	$data[6]	= isset($_POST['txt6']) ? $_POST['txt6'] : ''; 
	$data[7]	= isset($_POST['txt7']) ? $_POST['txt7'] : ''; 
	$data[8]	= isset($_POST['txt8']) ? $_POST['txt8'] : ''; 
	$data[9]	= isset($_POST['txt9']) ? $_POST['txt9'] : ''; 
	$data[10]	= isset($_POST['txt10']) ? $_POST['txt10'] : ''; 
	$data[11]	= isset($_POST['txt11']) ? $_POST['txt11'] : '0'; 
	$data[12]	= isset($_POST['txt12']) ? $_POST['txt12'] : '-'; 
	$data[13]	= isset($_POST['txt13']) ? $_POST['txt13'] : ''; 
	$data[14]	= isset($_POST['txt14']) ? $_POST['txt14'] : '-'; 
	$data[15]	= isset($_POST['txt15']) ? $_POST['txt15'] : '-'; 
	$data[16]	= isset($_POST['txt16']) ? $_POST['txt16'] : '-'; 
	$data[17]	= isset($_POST['txt17']) ? $_POST['txt17'] : '-'; 
	$data[18]	= isset($_POST['txt18']) ? $_POST['txt18'] : '0'; 
	$data[19]	= isset($_POST['txt19']) ? $_POST['txt19'] : '-'; 
	$data[20]	= isset($_POST['txt20']) ? $_POST['txt20'] : ''; 
} 
$row = 20; 
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0; 
$pageSql = "SELECT $tableName.*, m_kelas.kelas, m_dosen.nama_dosen, m_mata_kuliah.nama_mk FROM ".$tableName." 
				INNER JOIN m_kelas ON t_jadwal.kelas = m_kelas.idk 
				INNER JOIN m_dosen ON t_jadwal.nidn = m_dosen.nidn
				INNER JOIN m_mata_kuliah ON t_jadwal.kode_mk = m_mata_kuliah.kode_mk
				GROUP BY idj
				HAVING kode_prodi = $kode_prodi
				"; 
 
if(isset($_POST['qcari'])){ 
  $qcari=$_POST['qcari']; 
  $pageSql="SELECT $tableName.* FROM ".$tableName." WHERE  (".$field[4]." like '%$qcari%')"; 
} 
 
$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".$pageSql); 
$jml	 = mysqli_num_rows($pageQry); 
$max	 = ceil($jml/$row); 
 
?> 
 
<table class="table table-striped"> 
	<tr> 
	  <td colspan="2"><h1><b> <?php echo $formName;?> </b>  
	  <!-- <form class="navbar-search pull-right"  method="POST" action="?page=<?php echo $formName?>-Data">  
		  <input type="text" name="qcari" placeholder="Cari..." autofocus/> 
	  </form></h1> </td>  -->
	</tr> 
</table> 
<div class="accordion" id="collapse-group">         
  <div class="accordion-group widget-box"> 
	  <div class="accordion-heading"> 
		  <div class="widget-title"> 
			  <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse"> 
				  <span class="icon"><i class="icon-circle-arrow-right"></i></span><h5>Tambah Data <?php  echo $formName ?></h5> 
			  </a> 
		  </div> 
	  </div> 
	  <div class="collapse accordion-body" id="collapseGTwo"> 
		  <div class="widget-content">      
			  <form id="new-project" class="form-horizontal " action="?page=<?php echo $formName;?>-Data" method="post" name="form1" target="_self"> 
				  <fieldset> 
					<table class="table table-striped"> 
						<?php 
							buatInputHidden($isian[1],1,$kode_pt); 
							buatInputHidden($isian[2],2,$kode_fak); 
							buatInputHidden($isian[3],3,$kode_jenjang); 
							buatInputHidden($isian[4],4,$kode_jurusan); 
							buatInputHidden($isian[5],5,$kode_prodi); 
							buatInputHidden($isian[6],6,$tahun_id); 
							buatInputTextBS($isian[7],7,$data[7]); 
							buatInputSelectKelas($isian[8],8,$data[8],$koneksidb,'kode_prodi',$kode_prodi,'kelas');
							buatInputSelectMatakuliah($isian[9],9,$data[9],$koneksidb,$kode_prodi,$tahun_id,'nama_mk');
							buatInputSelectHari($isian[10],10,$data[10]); 
							buatInputTextBS($isian[11],11,$data[11]); 
							buatInputTextBS($isian[12],12,$data[12]); 
							buatInputSelectDosen($isian[13],13,$data[13],$koneksidb,$kode_fak,$tahun_id,'nama_dosen'); 
							buatInputHidden($isian[14],14,$data[14]); 
							buatInputHidden($isian[15],15,$data[15]); 
							buatInputHidden($isian[16],16,$data[16]); 
							buatInputHidden($isian[17],17,$data[17]); 
							buatInputHidden($isian[18],18,$data[18]); 
							buatInputHidden($isian[19],19,$data[19]); 
							buatInputSelectKK($isian[20],20,$data[20],$koneksidb,'nama'); 
							//buatInputSelect($isian[7],7,$data[7],"tFakultas",$koneksidb,"Fakultas"); 
						?> 
						<tr> 
							 <td>&nbsp;</td> 
							 <td>&nbsp;</td> 
							 <td><button type="submit"  name="btnSave" class="btn btn-primary">Simpan</button> 
								<button type="reset" class="btn " name="reset" id="reset" onclick="return confirm('Reset data yang telah anda ketik?')"/>Reset</button> 
							  	<a class="toggle-link" href="#new-project"><button type="button" class="btn " name=" KEMBALI " id="cancel" value=" BATAL " /><!-- onclick="history.back();" --> Batal </button></a> 
							 </td> 
						</tr> 
					 </table> 
				 </fieldset> 
			 </form> 
		 </div> 
	 </div> 
  </div> 
</div>		 
<table class="table table-bordered table-striped"> 
	<tr> 
		<th width="60" align="center"><strong>No</strong></th> 
		<th><strong>Kelas</strong></th> 
		<th><strong>Semester</strong></th> 
		<th><strong>Mata Kuliah</strong></th> 
		<th><strong>Nama Dosen</strong></th> 
		<th width="10" colspan="2"><strong>Option</strong></td> 
	</tr> 
<?php 
tampilTabelJadwal($koneksidb,$pageSql,$field,$formName,$hal,$row); 
?> 
</table> 
<?php tabelFooter($jml,$row,$max,$formName,$hal) ?> 

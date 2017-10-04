<?php 
include_once "library/seslogin.php"; 
include_once "prodi_config.php"; 
if($_GET) { 
	if(isset($_POST['btnSave'])){ 
 
		$txt[1] = date("Y-m-d h:i:sa"); 
		$txt[2] = NULL; 
		$txt[3] = $_POST['txt3']; 
		$txt[4] = $_POST['txt4']; 
		$txt[5] = $_POST['txt5']; 
		$txt[6] = $_POST['txt6']; 
		$txt[7] = $_POST['txt7']; 
 
		$pesanError = array(); 
		for($i=3;$i<=$jmlField;$i++){ 
			if (trim($txt[$i])=="") { 
				$pesanError[] = "Data <b>".$isian[$i]."</b> tidak boleh kosong !"; 
			} 
		} 
 
		$ada = cekAda($koneksidb,$tableName,$field[3],$isian[3],$txt[3]); 
		if($ada)        {  
			$pesanError[] = "Maaf, ".$isian[3]." <b> ".$txt[3]." </b> Sudah Ada.";	 
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
 
	$data[1]	= isset($_POST['txt1']) ? $_POST['txt1'] : ''; 
	$data[2]	= isset($_POST['txt2']) ? $_POST['txt2'] : ''; 
	$data[3]	= isset($_POST['txt3']) ? $_POST['txt3'] : ''; 
	$data[4]	= isset($_POST['txt4']) ? $_POST['txt4'] : ''; 
	$data[5]	= isset($_POST['txt5']) ? $_POST['txt5'] : ''; 
	$data[6]	= isset($_POST['txt6']) ? $_POST['txt6'] : ''; 
	$data[7]	= isset($_POST['txt7']) ? $_POST['txt7'] : ''; 
} 
$row = 20; 
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0; 
$pageSql = "SELECT $tableName.* FROM ".$tableName; 
$pageSql2 = "SELECT $tableName.id,
					$tableName.created_at,
					$tableName.updated_at,
					$tableName.kode_prodi,
					$tableName.program_studi,
					$tableName.id_kaprodi,
					$tableName.ketua_prodi,
					$tableName.id_fakultas,					
					 tfakultas.id,tfakultas.fakultas FROM ".$tableName.", tfakultas WHERE $tableName.id_fakultas = tfakultas.id"; 
 
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
	  <form class="navbar-search pull-right"  method="POST" action="?page=<?php echo $formName?>-Data">  
		  <input type="text" name="qcari" placeholder="Cari..." autofocus/> 
	  </form></h1> </td> 
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
							buatInputText($isian[3],3,$data[3]); 
							buatInputText($isian[4],4,$data[4]); 
							buatInputText($isian[5],5,$data[5]); 
							buatInputText($isian[6],6,$data[6]); 
							//buatInputText($isian[7],7,$data[7]); 
							buatInputSelect($isian[7],7,$data[7],"tFakultas",$koneksidb,"Fakultas"); 
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
		<th><strong><?php echo $isian[3]; ?></strong></th> 
		<th><strong><?php echo $isian[4]; ?></strong></th> 
		<th><strong><?php echo $isian[5]; ?></strong></th> 
		<th><strong><?php echo $isian[6]; ?></strong></th> 
		<th><strong><?php echo $isian[7]; ?></strong></th> 
		<th width="10" colspan="2"><strong>Option</strong></td> 
	</tr> 
<?php 
tampilTabel($koneksidb,$pageSql,$field,$formName,$hal,$row); 
?> 
</table> 
<?php tabelFooter($jml,$row,$max,$formName,$hal) ?> 

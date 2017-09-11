<?php
session_start();
include_once "../../lib/connection.php";
include_once "../../lib/library.php";
include_once "../lib/dtbarang.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 520;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : ''; 
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : ''; 
if($jenis==1) { $jenis='Aset';} else {$jenis='Non-Aset';}
$ruangan = isset($_GET['ruangan']) ? $_GET['ruangan'] : ''; 
$kondisi = isset($_GET['kondisi']) ? $_GET['kondisi'] : ''; 
if(($jenis=='')&&($ruangan=='')&&($kondisi=='')) { 
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun'";
	
} else  if(($jenis=='')&&($ruangan=='')){
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun' AND $tableName.id_kondisi=$kondisi  ";
	
} else  if(($jenis=='')&&($kondisi=='')){
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun' AND $tableName.id_ruangan=$ruangan  ";
	
}else if(($ruangan=='')&&($kondisi=='')){
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun' AND $tableName.jenis_aset='$jenis'  ";
	
} else if($jenis==''){
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun' AND $tableName.id_kondisi=$kondisi AND $tableName.id_ruangan=$ruangan  ";
 
}  else if($kondisi==''){
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun'   AND $tableName.jenis_aset='$jenis' ";
 
}  else if($ruangan==''){
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun' AND $tableName.id_kondisi=$kondisi AND $tableName.jenis_aset='$jenis'  ";
 
} else  {
 $pageSql = "SELECT $tableName.id_barang,$tableName.kode_barang,$tableName.nama_barang,$tableName.tahun_pengadaan, $tableName.jenis_aset,$tableName.id_ruangan,$tableName.id_kondisi,truangan.nama_ruangan,tkondisi.kondisi,tkondisi.keterangan FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE $tableName.tahun_pengadaan='$tahun' ";
	
}
 
$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".mysql_error());
$jml	 = mysqli_num_rows($pageQry);
$max	 = ceil($jml/$row);


?>
<?php include('head.php');
?>

<table width="100%" class="table table-bordered table-striped">
  <tr>
    <th width="910"><h1><b>Laporan Data Barang</b>  </h1></th>
     
  </tr>
  <tr>
    <td width="910"> </td>
     
  </tr>

</table>
<?php if ($jml==0) { echo " <br/> Data tidak ditemukan
";} 
else { 
?>

	<table class="table table-bordered table-striped">
      <tr>
        <th width="20" align="center"><strong><?php echo $isian0; ?></strong></th>
        <th width="130"><strong><?php echo $isian1; ?></strong></th>
        <th width="220"><strong><?php echo $isian2; ?></strong></th>
        <th width="100"><strong><?php echo $isian3; ?></strong></th>
        <th width="100"><strong><?php echo $isian4; ?></strong></th> 
        <th width="100"><strong><?php echo $isian5; ?></strong></th> 
        <th width="120"><strong><?php echo $isian6; ?></strong></th> 
      </tr>
		<?php
		$mySql = $pageSql." ORDER BY ".$field0." ASC LIMIT $hal, $row";
		$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysql_error());
		$nomor  = 1; 
		while ($kolomData = mysqli_fetch_array($myQry)) {
			
			$Kode = $kolomData[$field0];
			// $sub2 = substr($kolomData[$field2],0,245);
			// if($kolomData[$field5]=='1'){$id5='Ya';}
			// elseif($kolomData[$field5]=='0'){$id5='Tidak';}
			// else{$id5='Unknown';}
		?>
      <tr>
        <td align="center"> <?php echo $nomor++; ?> </td>
        <td> <?php echo $kolomData[$field1]; ?> </td>
        <td> <?php echo $kolomData[$field2]; ?> </td>
        <td> <?php echo $kolomData[$field3]; ?> </td>
        <td> <?php echo $kolomData[$field4]; ?> </td>  
        <td> <?php echo $kolomData['nama_ruangan']; ?> </td>  
        <td> <?php echo $kolomData['kondisi']; ?> </td>  
		
        </tr>
      <?php } ?>
    </table>
	  <?php } ?>
<?php include('footer.php');
?>
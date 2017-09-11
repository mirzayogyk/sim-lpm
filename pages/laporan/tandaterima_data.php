<?php
session_start();
include_once "../../lib/connection.php";
include_once "../../lib/library.php";
include_once "../lib/dtdataormas.php";  

# UNTUK PAGING (PEMBAGIAN HALAMAN) 
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : 0;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : 0;
$bentuk = isset($_GET['bentuk']) ? $_GET['bentuk'] : 0;
$sifat = isset($_GET['sifat']) ? $_GET['sifat'] : 0;

$row = 20; 
if(($bulan==0)&&($bentuk==0)&&($sifat==0)) {
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun'"; 
}
elseif (($bentuk==0)&&($sifat==0))  {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND MONTH(tanggal_register)='$bulan' ";
}
elseif (($bulan==0)&&($sifat==0))  {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND $tableName.id_bentukormas='$bentuk' ";
}
elseif (($bulan==0)&&($bentuk==0))  {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND $tableName.id_sifatormas='$sifat' ";
}
elseif ($bulan==0) {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND $tableName.id_sifatormas='$sifat'  AND $tableName.id_bentukormas='$bentuk' ";
}
elseif ($bentuk==0) {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND $tableName.id_sifatormas='$sifat' AND MONTH(tanggal_register)='$bulan' ";
}
elseif ($sifat==0) {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas  FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND $tableName.id_bentukormas='$bentuk' AND MONTH(tanggal_register)='$bulan' ";
}
else {	
$pageSql = "SELECT $tableName.*,nama_ketua,nama_sekretaris,username,bentuk_ormas,sifat_ormas FROM ".$tableName." LEFT JOIN tpengurus ON tpengurus.no_register=$tableName.no_register LEFT JOIN takun ON takun.no_register=$tableName.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=$tableName.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=$tableName.id_sifatormas WHERE YEAR(tanggal_register)='$tahun' AND MONTH(tanggal_register)='$bulan' AND $tableName.id_sifatormas='$sifat'  AND $tableName.id_bentukormas='$bentuk' ";
}
$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".mysqli_error($koneksidb));
$jml	 = mysqli_num_rows($pageQry);
$max	 = ceil($jml/$row);
 
?>

<?php include('head3.php');
?>
  
 
	<table class="table table-bordered table-striped"  align="center" >
	<tr>
	<td colspan="10"> Laporan Data <?php echo $formName;?> 
	</td>
	</tr>
      <tr>
        <th width="30" align="center"><strong><?php echo $isian0; ?></strong></th>  
        <th width="200"><strong>NAMA ORGANISAS/SINGKATAN</strong></th> 
        <th width="50"><strong>BENTUK</strong></th> 
        <th width="70"><strong>SIFAT</strong></th> 
        <th width="70"><strong>KETUA</strong></th> 
        <th width="70"><strong>SEKRETARIS</strong></th> 
        <th width="200"><strong>ALAMAT/TELPON/EMAIL SEKRETARIAT</strong></th> 
        <th width="40"><strong>STATUS</strong></th> 
        <th width="70"><strong>KETERANGAN</strong></th> 
      </tr>
		<?php
		$mySql = $pageSql." ORDER BY ".$field1." ASC ";
		$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysql_error());
		$nomor  = 1; 
		while ($kolomData = mysqli_fetch_array($myQry)) {
			
			$Kode = $kolomData[$field0];
			if($kolomData[$field11]=='1'){$id11='<span class="badge badge-success">Aktif</span>';}
			elseif($kolomData[$field11]=='0'){$id11='<span class="badge badge-info">Pending</span>';}
			elseif($kolomData[$field11]=='2'){$id11='<span class="badge badge-warning">Suspend</span>';}
			else{$id11='<span class="badge badge-important">Unknown</span>';}
			
			if($kolomData[$field11]=='2'){$id10='Dibekukan';}
			elseif($kolomData[$field11]=='0'){$id10='Tunggu Moderasi';}
			elseif(empty($kolomData[$field10])){$id10='Terdata';}
			else{$id10='SKT';}
		?>
      <tr>
        <td align="center"> <?php echo $nomor++; ?> </td> 
        <td> <?php echo $kolomData[$field3]; ?> <?php if (!empty($kolomData[$field4])) { echo '('.$kolomData[$field4].')';} ?> </td> 
         
        <td><?php echo $kolomData['bentuk_ormas']; ?></td> 
        <td><?php echo $kolomData['sifat_ormas']; ?></td> 
        <td><?php echo $kolomData['nama_ketua']; ?></td> 
        <td> <?php echo $kolomData['nama_sekretaris']; ?> </td> 
        <td> <?php echo substr($kolomData[$field7],0,10); ?> <?php if (!empty($kolomData[$field8])) { echo '/'.$kolomData[$field8];} ?>  <?php if (!empty($kolomData[$field9])) { echo '/'.$kolomData[$field9];} ?>  </td> 
        <td> <?php echo $id10; ?> </td> 
        <td> <?php echo $id11; ?> </td> 
		 
      </tr>
      <?php } ?>
    </table>
	 
<?php include('footer.php');
?>

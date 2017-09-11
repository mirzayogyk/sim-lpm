<?php 

session_start();
include_once "../../lib/connection.php";
include_once "../../lib/library.php";
include_once "../lib/dtdataormas.php";  

# UNTUK PAGING (PEMBAGIAN HALAMAN) 
$Kode = isset($_GET['Kode']) ? $_GET['Kode'] : $_SESSION['MAIN_DOTA_KAH']; 
// if (!empty($kode)) {
	 // header('Location:/?page=Login-Ormas');
	 // // echo "<meta http-equiv='refresh' content='2; url=?page=Kosong'>";
// }
$row = 20; 
$pageSql = "SELECT tdataormas.*,nama_ketua,nama_sekretaris,username,password,bentuk_ormas,sifat_ormas FROM tdataormas LEFT JOIN tpengurus ON tpengurus.no_register=tdataormas.no_register LEFT JOIN takun ON takun.no_register=tdataormas.no_register LEFT JOIN tbentukormas ON tbentukormas.id_bentukormas=tdataormas.id_bentukormas LEFT JOIN tsifatormas ON tsifatormas.id_sifatormas=tdataormas.id_sifatormas WHERE  tdataormas.no_register='".$Kode."'";

$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".mysqli_error($koneksidb));
$jml	 = mysqli_num_rows($pageQry);
$max	 = ceil($jml/$row);
$kolomData = mysqli_fetch_array($pageQry)
?>
<link href="style-pdf.css" rel="stylesheet" type="text/css" />
  

	<table class="zebra-table"  align="center" >
  <tr>
    <td align="center" colspan="3"><strong><img src="../../img/kop-xsmall.png" width="500"></strong></td> 
  </tr> 
	 <tr>
		<td align="center" colspan="3"> <h4>TANDA TERIMA PENDATAAN ORMAS KABUPATEN TAPIN</h4></td>
	 </tr> 
	 <tr>
		<td colspan="3"> <hr/></td>
	 </tr>
      <tr>
          <td width="100" > NO REGISTRASI</td>
          <td > :</td>
          <td > <?php echo $kolomData['no_register']; ?></td>
      </tr>  
      <tr>
          <td > TANGGAL PENDATAAN</td>
          <td > :</td>
          <td > <?php echo indonesia2Tgl($kolomData['tanggal_register']); ?></td>
      </tr>  
      <tr>
          <td > NAMA ORMAS</td>
          <td > :</td>
          <td > <?php echo $kolomData['nama_ormas']; ?></td>
      </tr>  
      <tr>
          <td > ALAMAT</td>
          <td > :</td>
          <td > <?php 
				// $kata=explode(" ",$kolomData['alamat']);
				 // if (strlen($kolomData['alamat'])>40) { echo $kata[00021]; }; 
				 echo $kolomData['alamat']; ?></td>
      </tr>   
	 <tr>
		<td colspan="3"> <hr/></td>
	 </tr>
      <tr>
          <td > USERNAME</td>
          <td > :</td>
          <td > <?php echo $kolomData['username']; ?></td>
      </tr>  
      <tr>
          <td > PASSWORD</td>
          <td > :</td>
          <td > <?php echo de_hash_pass5($kolomData['password']); ?></td>
      </tr>    
	 <tr>
		<td colspan="3"> <hr/></td>
	 </tr> 
	 <tr>
		<td colspan="3">Selamat Ormas Anda telah terdata pada Kantor Kesatuan Bangsa dan Politik </td>
	 </tr>
	 <tr>
		<td colspan="3">Kabupaten Tapin. </td>
	 </tr>
		
	</table>	
   

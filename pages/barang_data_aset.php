<?php 
include_once "page/lib/dtbarang.php";
  

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM ".$tableName." LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi WHERE jenis_aset='Aset'";

if(isset($_POST['qcari'])){
  $qcari=$_POST['qcari'];
  $pageSql="SELECT $tableName.*, tkondisi.kondisi,truangan.nama_ruangan,tkondisi.keterangan FROM  $tableName  LEFT JOIN truangan ON truangan.id_ruangan=$tableName.id_ruangan LEFT JOIN tkondisi ON tkondisi.id_kondisi=$tableName.id_kondisi
  where jenis_aset='Aset' AND ($field1 like '%$qcari%' or $field2 like '%$qcari%' or $field3 like '%$qcari%' or nama_ruangan like '%$qcari%' or kondisi like '%$qcari%') ";
}
$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error paging: ".mysqli_error($koneksidb));
$jml	 = mysqli_num_rows($pageQry);
$max	 = ceil($jml/$row);


?>

<table class="table table-bordered table-striped">
  <tr>
    <td><h1><b>Data <?php echo $formName;?></b> <form class="navbar-search pull-right"  method="POST" action="?page=<?php echo $formName?>-Aset">
								<input type="text" name="qcari" placeholder="Cari..." autofocus/>
  </form></h1></td>
     
  </tr>
   
  <!-- <tr> 
  <td > &nbsp;
  </td>
  </tr> 
-->

  
	<table class="table table-bordered table-striped">
      <tr>
        <th width="30" align="center"><strong><?php echo $isian0; ?></strong></th> 
        <th width="200"><strong><?php echo $isian1	; ?></strong></th>
        <th width="600"><strong><?php echo $isian2; ?></strong></th> 
        <th width="200"><strong><?php echo $isian3; ?></strong></th> 
        <th width="200"><strong><?php echo $isian4; ?></strong></th> 
        <th width="300"><strong><?php echo $isian5; ?></strong></th> 
        <th width="100"><strong><?php echo $isian6; ?></strong></th>  
      </tr>
		<?php
		$mySql = $pageSql." ORDER BY ".$field1." ASC LIMIT $hal, $row";
		$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysql_error());
		$nomor  = 1; 
		while ($kolomData = mysqli_fetch_array($myQry)) {
			
			$Kode = $kolomData[$field0]; 
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
	<table class="table table-bordered table-striped"> 
  <tr>
  	
	<td>
	 <div class="pagination">
 
              <ul>
			  <li><a href="?page=<?php  $g = $hal-1;
				if ($g<=0)
				{$g=0;}	
			  echo $formName;?>-Aset&hal=<?php echo $g?>">Prev</a></li>
				<?php
				for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $row * $h - $row;
					echo " <li><a href='?page=".$formName."-Aset&hal=$list[$h]'>$h</a></li> ";
				}
				?>	
			 
              </ul>
            </div>
	</td>
	
	<td align="center"> <div class="pagination2"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </div></td> 
  </tr>
</table>

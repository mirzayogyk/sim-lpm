<?php
	$now = date("Y-m-d"); 
	$tahun = date("Y"); 
	$bulan = date("m");  
	$kondisi	= isset($_POST['k']) ? $_POST['kondisi'] : '';
	$ruangan	= isset($_POST['r']) ? $_POST['ruangan'] : '';
?>
	<form class="form-horizontal"  method="GET" action="page/laporan/laporancustom_aset1-pdf.php?tahun=['tahun']&k=['k']&r=['r']" target="_blank">
		<fieldset>
<table class="table table-bordered table-striped">
							<tr>
      <th colspan="2" ><h2>Pilih Detail Laporan Barang </h2></th>
    </tr>
<tr>
<td>Tahun Pengadaan</td>
<td><input type="text" class="span20" name="tahun" value="<?php echo $tahun; ?>" /></td>
</tr>   
<tr>
<td>Lokasi</td>
<td> <select name="r" class="span20" >
		<option value="" selected>Semua Ruangan</option>
		<?php
		$mySql2 = "SELECT * FROM truangan ";
		$myQry = mysqli_query($koneksidb, $mySql2) or die ("Gagal Query absen ".mysql_error());
		while ($kolomData1 = mysqli_fetch_array($myQry)) {
			if ($ruangan == $kolomData1['id_ruangan']) {
				$cek = "selected";
			} else { $cek=""; }
			
			echo "<option value='$kolomData1[id_ruangan]'  > $kolomData1[nama_ruangan] </option>";
		}
		$mySql ="";
		?>
		</select></td>
</tr>  
   
<tr>
<td>Kondisi</td>
<td> <select name="k" class="span20" >
		<option value="" selected>Semua Kondisi</option>
		<?php
		$mySql2 = "SELECT * FROM tkondisi ";
		$myQry = mysqli_query($koneksidb, $mySql2) or die ("Gagal Query absen ".mysql_error());
		while ($kolomData1 = mysqli_fetch_array($myQry)) {
			if ($Kondisi == $kolomData1['id_Kondisi']) {
				$cek = "selected";
			} else { $cek=""; }
			
			echo "<option value='$kolomData1[id_Kondisi]'  > $kolomData1[kondisi] ($kolomData1[keterangan]) </option>";
		}
		$mySql ="";
		?>
		</select></td>
</tr>  

 <tr>
<td colspan="2"> <button type="submit" class="btn btn-primary">Proses</button>
								<button type="reset" class="btn " name="reset" id="reset" onclick="return confirm('hapus data yang telah anda ketik?')"/>Reset</button>
		   <button type="button" class="btn " name=" KEMBALI " id="cancel" value=" BATAL "  onclick="history.back();"/> Batal </button></td>
 
</tr>
</table>
</fieldset>
</form>
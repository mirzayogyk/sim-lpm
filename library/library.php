<?php
include ("connection.php");
# Pengaturan tanggal komputer
date_default_timezone_set("Asia/Jakarta");

# Fungsi mysqli_field_name dan len
function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

function mysqli_field_len($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->length : null;
}


# Fungsi untuk membuat kode automatis
function buatKode($tabel, $inisial){
	$koneksidb	= mysqli_connect("localhost", "root", "", "nkit_template");
	$struktur	= mysqli_query($koneksidb,"SELECT * FROM $tabel");
	$field		= mysqli_field_name($struktur,0);
	$panjang	= mysqli_field_len($struktur,0);

 	$qry	= mysqli_query($koneksidb,"SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysqli_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	$today=date("Ymd");
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}
function buatKode2($tabel,$inisial) {
	$struktur	= mysqli_query("SELECT * FROM $tabel");
	$field		= mysqli_field_name($struktur,0);
	$panjang	= mysqli_field_len($struktur,0);
	
	$today=date("Ymd");
	$qry	= mysqli_query("SELECT MAX(".$field.") AS last FROM ".$tabel." WHERE ".$field." LIKE '$today%'");
 	$row	= mysqli_fetch_array($qry); 
	
	$lastNoTransaksi = $row['last'];
	$lastNoUrut = substr($lastNoTransaksi, 8, 4);
	$nextNoUrut = $lastNoUrut + 1;
	$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
	$inisial.$nextNoTransaksi;

}

# Fungsi untuk membalik tanggal dari format Indo (d-m-Y) -> English (Y-m-d)
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$tanggal="$thn-$bln-$tgl";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia2Tgl($tanggal){
	$namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
					 "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
					 
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal ="$tgl ".$namaBln[$bln]." $thn";
	return $tanggal;
}

function hitungHari($myDate1, $myDate2){
        $myDate1 = strtotime($myDate1);
        $myDate2 = strtotime($myDate2);
 
        return ($myDate2 - $myDate1)/ (24 *3600);
}

# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

# Fungsi untuk format tanggal, dipakai plugins Callendar
function form_tanggal($nama,$value=''){
	echo" <input type='text' name='$nama' id='$nama' size='11' maxlength='20' value='$value'/>&nbsp;
	<img src='images/calendar-add-icon.png' align='top' style='cursor:pointer; margin-top:7px;' alt='kalender'onclick=\"displayCalendar(document.getElementById('$nama'),'dd-mm-yyyy',this)\"/>			
	";
}

function angkaTerbilang($x){
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return angkaTerbilang($x - 10) . " belas";
  elseif ($x < 100)
    return angkaTerbilang($x / 10) . " puluh" . angkaTerbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . angkaTerbilang($x - 100);
  elseif ($x < 1000)
    return angkaTerbilang($x / 100) . " ratus" . angkaTerbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . angkaTerbilang($x - 1000);
  elseif ($x < 1000000)
    return angkaTerbilang($x / 1000) . " ribu" . angkaTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return angkaTerbilang($x / 1000000) . " juta" . angkaTerbilang($x % 1000000);
}

function getNamaField($qry){

		$i=0;
  	while ($fieldinfo=mysqli_fetch_field($qry))
    {
			$out[$i] = $fieldinfo->name;
			$i++;
    }
		mysqli_free_result($qry);
		return $out;
}

function getIsian($qry){
	
			$i=0;
		  while ($fieldinfo=mysqli_fetch_field($qry))
		{
				$out[$i] = $fieldinfo->name;
				$out[$i] = strtolower($out[$i]);
				if(strpos($out[$i],"_")!=0){
				$out[$i] = substr_replace($fieldinfo->name," ",strpos($fieldinfo->name,"_"),1);
				}
				
				$out[$i]=ucwords($out[$i]);
				$i++;
		}
			mysqli_free_result($qry);
			return $out;
}

function isiTabel($nomor,$kolom,$field){
		echo("<tr>");
		echo("<td aligh=\"center\">".$nomor++."</td>");
		$i=1;
		while($i<=count($field)-1){
			echo("<td> ".$kolom[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
}

function buatTombol($formName,$Kode,$kolom){
	echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$formName."-Edit&Kode=".$Kode." \" target=\"_self\"><i class=\"icon-edit\"></i></a></td>");
	echo("<td class=\"cc\" align=\"center\"><a href=\"?page=". $formName."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ".$formName." dengan Nama ".$kolom."? ')\"><i class=\"icon-trash\"></i></a></td>");
}

function tampilTabel($koneksidb,$pageSql,$field,$formName,$hal,$row){
	$mySql = $pageSql." ORDER BY ".$field[4]." ASC LIMIT $hal, $row";
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".$mySql);
	$nomor  = 1+$hal; 
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData[$field[0]];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
		$i=3;
		while($i<=count($field)-1){
			echo("<td> ".$kolomData[$field[$i]]." </td>");
			$i++;
		}
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$formName."-Edit&Kode=".$Kode." \" target=\"_self\"><i class=\"icon-edit\"></i></a></td>");
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=". $formName."-Delete&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ".$formName." dengan ".$field[3]." ".$kolomData[3]."? ')\"><i class=\"icon-trash\"></i></a></td>");
		echo("</tr>");	
	}
}


function tabelFooter($jml,$row,$max,$formName,$hal){
	$max=ceil($jml/$row);
	echo("<table class=\"table table-bordered table-striped\">");
	echo("<tr><td><div class =\"pagination\"><ul><li>");
	echo("	<a href=\"?page=");
			$g = $hal-20;
			if ($g<=0)
				{$g=0;}	
	echo ($formName."-Data&hal=$g\">Prev</a>");
	echo("</li>");

	  for ($h = 1; $h <= $max;$h++) {
		  $list[$h] = $row * $h - $row;
		  echo " <li><a href='?page=".$formName."-Data&hal=".$list[$h]."'>$h</a></li> ";
	  }
	echo("</ul></div>");
	echo "	</td> </tr> 	</table>";
}

function getInsert($jml,$field,$txt){
	$s="(".$field[1];
	for($i=2;$i<=$jml;$i++){
		$s = $s.", ".$field[$i];
	}
	
	$s = $s." ) VALUES ('".$txt[1]."'";
	
	for($i=2;$i<=$jml;$i++){
		$s = $s.", '".$txt[$i]."'";
	}
	$s = $s.")";
	return $s;
}
function getUpdate($jml,$field,$txt){
	$s = $field[2]."='".$txt[2]."'";

	for($i=3;$i<=$jml;$i++){
		$s = $s.", ".$field[$i]."='".$txt[$i]."'";
	}
	
	$s = $s." WHERE ".$field[0]."='".$txt[0]."'";
	
	return $s;
}

function getStringArray($pesanError){
	$jml = count($pesanError)-1;
	$s="(".$pesanError[0];
	for($i=1;$i<=$jml;$i++){
		$s = $s.", ".$pesanError[$i];
	}
	
	$s = $s." )";
	return $s;
}

function cekAda($koneksidb,$tableName,$field,$isian,$txt){
	$cekSql="SELECT * FROM ".$tableName." WHERE ".$field."='".$txt."'";
	$cekQry=mysqli_query($koneksidb, $cekSql) or die ("Eror Query".mysqli_error()); 
	if(mysqli_num_rows($cekQry)>=1){
		return true;
	}		
	else{
		return false;
	}
}

function buatConfig1($folderOutput, $namaForm, $namaTable){
	$namaFile = strtolower($namaForm);
	$myfile = fopen($folderOutput."/".$namaFile."_config.php", "w") or die("Unable to open file!");
	fwrite($myfile, "<?php \n");
	fwrite($myfile, "\$tableName = \"".$namaTable."\"; \n");
	fwrite($myfile, "\$formName = \"".$namaForm."\"; \n");
	fwrite($myfile, "\n");
	fwrite($myfile, "\$pageSql=\"SELECT \$tableName.* FROM \".\$tableName; \n");
	fwrite($myfile, "\$pageQry = mysqli_query(\$koneksidb, \$pageSql) or die (\"error handak getNameField: \".\$pageSql); \n");
	fwrite($myfile, "\$field = getNamaField(\$pageQry); \n");
	fwrite($myfile, "\$pageQry = mysqli_query(\$koneksidb, \$pageSql) or die (\"error handak getIsian: \".\$pageSql); \n");
	fwrite($myfile, "\$isian = getIsian(\$pageQry);    \n");
	fwrite($myfile, "\$pageQry = mysqli_query(\$koneksidb, \$pageSql) or die (\"error handak jumlahField: \".\$pageSql); \n");
	fwrite($myfile, "\$jmlField = mysqli_num_fields(\$pageQry)-1;   \n");

	fwrite($myfile, "?>");
	fclose($myfile);
}

function buatConfig($folderOutput, $namaForm, $koneksidb, $namaTable){
	$namaFile = strtolower($namaForm);
	$myfile = fopen($folderOutput."/".$namaFile."_config.php", "w") or die("Unable to open file!");
	$pageSql="SELECT $namaTable.* FROM ".$namaTable; 
	$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error handak getNameField: ".$pageSql); 
	$field = getNamaField($pageQry); 
	$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error handak getIsian: ".$pageSql); 
	$isian = getIsian($pageQry);    
	$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error handak jumlahField: ".$pageSql); 
	$jmlField = mysqli_num_fields($pageQry)-1;  

	fwrite($myfile, "<?php \n");
	fwrite($myfile, "\$tableName = \"".$namaTable."\"; \n");
	fwrite($myfile, "\$formName = \"".$namaForm."\"; \n");
	fwrite($myfile, "\$jmlField = \"".$jmlField."\"; \n");
	fwrite($myfile, "\n");
for($i=0;$i<=$jmlField;$i++){
	fwrite($myfile, "\$field[".$i."]=\"".$field[$i]."\"; \n");
	fwrite($myfile, "\$isian[".$i."]=\"".$isian[$i]."\"; \n");
}

	fwrite($myfile, "?>");
	fclose($myfile);
}

function buatDelete($folderOutput, $namaForm, $namaTable){
	$namaFile = strtolower($namaForm);
	$myfile = fopen($folderOutput."/".$namaFile."_delete.php", "w") or die("Unable to open file!");
	fwrite($myfile, "<?php \n");
	fwrite($myfile, "include_once \"library/seslogin.php\"; \n");
	fwrite($myfile, "include_once \"".$namaFile."_config.php\"; \n");
	fwrite($myfile, "\n");
	fwrite($myfile, "if(\$_GET) { \n");
	fwrite($myfile, "	if(empty(\$_GET['Kode'])){ \n");
	fwrite($myfile, "		buatLog(\$_SESSION['USERMRZ'],\"DELETE FAIL\",\"NULL\"); \n");
	fwrite($myfile, "		echo \"<b>Data yang dihapus tidak ada</b>\"; \n");
	fwrite($myfile, "	} \n");
	fwrite($myfile, "	else { \n");
	fwrite($myfile, "		\$mySql = \"DELETE FROM \".\$tableName.\" WHERE \".\$field[0].\"='\".\$_GET['Kode'].\"'\"; \n");
	fwrite($myfile, "		\$myQry = mysqli_query(\$koneksidb,\$mySql) or die (\"Eror hapus data\".mysql_error());  \n");
	fwrite($myfile, "		if(\$myQry){  \n");
	fwrite($myfile, "		buatLog(\$_SESSION['USERMRZ'],\"DELETE SUCCESS\",\$mySql); \n");
	fwrite($myfile, "			echo \"<meta http-equiv='refresh' content='0; url=?page=\".\$formName.\"-Data'>\";  \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, "	} \n");
	fwrite($myfile, "} \n");		
	fwrite($myfile, "?>");
	fclose($myfile);
}

function buatBtnSave($myfile,$namaFile,$jmlField,$mode){
	fwrite($myfile, "<?php \n");
	fwrite($myfile, "include_once \"library/seslogin.php\"; \n");
	fwrite($myfile, "include_once \"".$namaFile."_config.php\"; \n");
	fwrite($myfile, "if(\$_GET) { \n");
	fwrite($myfile, "	if(isset(\$_POST['btnSave'])){ \n");
	fwrite($myfile, " \n");
	
if($mode=="INSERT"){
	fwrite($myfile, "		\$txt[1] = date(\"Y-m-d h:i:sa\"); \n");
	fwrite($myfile, "		\$txt[2] = NULL; \n");
}else{
    fwrite($myfile, "		\$txt[0] = \$_POST['txt0']; \n");
	fwrite($myfile, "		\$txt[2] = date(\"Y-m-d h:i:sa\"); \n");
}
for($i=3;$i<=$jmlField;$i++){
	fwrite($myfile, "		\$txt[".$i."] = \$_POST['txt".$i."']; \n");		
}
	fwrite($myfile, " \n");
	fwrite($myfile, "		\$pesanError = array(); \n");
	fwrite($myfile, "		for(\$i=3;\$i<=\$jmlField;\$i++){ \n");
	fwrite($myfile, "			if (trim(\$txt[\$i])==\"\") { \n");
	fwrite($myfile, "				\$pesanError[] = \"Data <b>\".\$isian[\$i].\"</b> tidak boleh kosong !\"; \n"); 		
	fwrite($myfile, "			} \n");
	fwrite($myfile, "		} \n");	
	fwrite($myfile, " \n");
if($mode=="INSERT"){
	fwrite($myfile, "		\$ada = cekAda(\$koneksidb,\$tableName,\$field[3],\$isian[3],\$txt[3]); \n");
	fwrite($myfile, "		if(\$ada)        {  \n");
	fwrite($myfile, "			\$pesanError[] = \"Maaf, \".\$isian[3].\" <b> \".\$txt[3].\" </b> Sudah Ada.\";	 \n");
	fwrite($myfile, "		} \n");
}else{
	fwrite($myfile, "		//\$ada = cekAda(\$koneksidb,\$tableName,\$field[3],\$isian[3],\$txt[3]); \n");
	fwrite($myfile, "		//if(\$ada)        {  \n");
	fwrite($myfile, "		//	\$pesanError[] = \"Maaf, \".\$isian[3].\" <b> \".\$txt[3].\" </b> Sudah Ada.\";	 \n");
	fwrite($myfile, "		//} \n");
}
	fwrite($myfile, " \n");
	fwrite($myfile, "		if (count(\$pesanError)>=1 ){  \n");
	fwrite($myfile, "			echo \"<div class='mssgBox'>\";  \n");
	fwrite($myfile, "			\$noPesan=0; \n");
	fwrite($myfile, "			foreach (\$pesanError as \$indeks=>\$pesan_tampil) {  \n");
	fwrite($myfile, "				\$noPesan++;  \n");
	fwrite($myfile, "				echo '<div class=\"alert alert-error alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a> \n");
	fwrite($myfile, "				<h4 class=\"alert-heading\">Error!</h4>'.\$noPesan.'. '.\$pesan_tampil.'</div><br>';	 \n");
	fwrite($myfile, "			}  \n");
	fwrite($myfile, "			echo \"</div> <br>\";  \n");
if($mode=="INSERT"){
	fwrite($myfile, "			buatLog(\$_SESSION['USERMRZ'],\"INSERT FAIL\",getStringArray(\$pesanError)); \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, "		else { \n");
	fwrite($myfile, "			\$mySql	= \"INSERT INTO \".\$tableName.\" \".getInsert(\$jmlField,\$field,\$txt); \n");
	fwrite($myfile, "			\$myQry	= mysqli_query(\$koneksidb, \$mySql) or die (\"Gagal query insert :\".getInsert(\$jmlField,\$field,\$txt)); \n");
	fwrite($myfile, "			if(\$myQry){ \n");
	fwrite($myfile, "			buatLog(\$_SESSION['USERMRZ'],\"INSERT SUCCESS\",\$mySql); \n");
}else{
	fwrite($myfile, "			buatLog(\$_SESSION['USERMRZ'],\"UPDATE FAIL\",getStringArray(\$pesanError)); \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, "		else { \n");
	fwrite($myfile, "			\$mySql	= \"UPDATE \".\$tableName.\" SET \".getUpdate(\$jmlField,\$field,\$txt); \n");
	fwrite($myfile, "			\$myQry	= mysqli_query(\$koneksidb, \$mySql) or die (\"Gagal query update :\".\$mySql); \n");
	fwrite($myfile, "			if(\$myQry){ \n");
	fwrite($myfile, "			buatLog(\$_SESSION['USERMRZ'],\"UPDATE SUCCESS\",\$mySql); \n");
}	
	fwrite($myfile, "				echo \"<meta http-equiv='refresh' content='0; url=?page=\".\$formName.\"-Data'>\"; \n");

	fwrite($myfile, "			} \n");
	fwrite($myfile, "			exit; \n");
	fwrite($myfile, "		} \n");
	fwrite($myfile, " \n");
	
}

function buatEdit($folderOutput, $namaForm, $namaTable,$jmlField){
	$namaFile = strtolower($namaForm);
	$myfile = fopen($folderOutput."/".$namaFile."_edit.php", "w") or die("Unable to open file!");
	buatBtnSave($myfile,$namaFile,$jmlField,"UPDATE");
	fwrite($myfile, "	} \n");
	fwrite($myfile, " \n");

	fwrite($myfile, "\$Kode	 = isset(\$_GET['Kode']) ?  \$_GET['Kode'] : \$_POST['txt0']; \n");
	fwrite($myfile, "\$sqlShow = \"SELECT * FROM \".\$tableName.\" WHERE \".\$field[0].\"='\$Kode'\";\n");
	fwrite($myfile, "\$qryShow = mysqli_query(\$koneksidb, \$sqlShow)  or die (\"Query ambil data salah : \".mysql_error());\n");
	fwrite($myfile, "\$dataShow = mysqli_fetch_array(\$qryShow);\n");
	fwrite($myfile, " \n");
	fwrite($myfile, "for(\$i=0;\$i<=\$jmlField;\$i++){\n");
	fwrite($myfile, "	\$data[\$i] = \$dataShow[\$field[\$i]];\n");
	fwrite($myfile, "}\n");
	fwrite($myfile, "} // Penutup GET\n");
	fwrite($myfile, "?>\n");

	fwrite($myfile, "<form  class=\"form-horizontal\" action=\"?page=<?php echo \$formName;?>-Edit\" method=\"post\" name=\"form1\" target=\"_self\" id=\"form1\">  \n");
	fwrite($myfile, "<fieldset> \n");
	fwrite($myfile, "	<legend>Ubah <?php echo \$formName?></legend> \n");

	fwrite($myfile, "		<div class=\"control-group\"> \n");
	fwrite($myfile, "			<label class=\"control-label\" for=\"input00\"><?php echo \$isian[0]; ?></label>  \n");
	fwrite($myfile, "			<div class=\"controls\">  \n");
	fwrite($myfile, "				<input name=\"txt0\" type=\"text\" class=\"input-xlarge\" id=\"input00\" value=\"<?php echo \$Kode; ?>\"  size=\"60\" maxlength=\"50\" readonly />  \n");
	fwrite($myfile, "			</div> \n");
	fwrite($myfile, "		</div> \n");
	fwrite($myfile, "		<?php \n");	
for($i=1;$i<=$jmlField;$i++){
	if(($i!=1) && ($i!=2)){
	fwrite($myfile, "		buatEditText(\$isian[$i],$i,\$data[$i]); \n");
	}
}
	fwrite($myfile, "		?> \n");	
	fwrite($myfile, "<div class=\"form-actions\"> \n");
	fwrite($myfile, "							<button type=\"submit\"  name=\"btnSave\" class=\"btn btn-primary\">Simpan</button> \n");
	fwrite($myfile, "							<button type=\"reset\" class=\"btn \" name=\"reset\" id=\"reset\" onclick=\"return confirm('hapus data yang telah anda ketik?')\"/>Reset</button> \n");
	fwrite($myfile, "	  <button type=\"button\" class=\"btn \" name=\" KEMBALI \" id=\"cancel\" value=\" BATAL \" onclick=\"history.back();\" />Batal </button> \n");
	fwrite($myfile, "						</div>											 \n");
	fwrite($myfile, "</form> \n");


}

function buatData($folderOutput, $namaForm, $namaTable,$jmlField){
	$namaFile = strtolower($namaForm);
	$myfile = fopen($folderOutput."/".$namaFile."_data.php", "w") or die("Unable to open file!");
	buatBtnSave($myfile,$namaFile,$jmlField,"INSERT");
	fwrite($myfile, "	} \n");
	fwrite($myfile, " \n");
	
for($i=1;$i<=$jmlField;$i++){
	fwrite($myfile, "	\$data[".$i."]	= isset(\$_POST['txt".$i."']) ? \$_POST['txt".$i."'] : ''; \n");		
}
	fwrite($myfile, "} \n");

	fwrite($myfile, "\$row = 20; \n");
	fwrite($myfile, "\$hal = isset(\$_GET['hal']) ? \$_GET['hal'] : 0; \n");
	fwrite($myfile, "\$pageSql = \"SELECT \$tableName.* FROM \".\$tableName; \n");
	fwrite($myfile, " \n");
	fwrite($myfile, "if(isset(\$_POST['qcari'])){ \n");
	fwrite($myfile, "  \$qcari=\$_POST['qcari']; \n");
	fwrite($myfile, "  \$pageSql=\"SELECT \$tableName.* FROM \".\$tableName.\" WHERE  (\".\$field[4].\" like '%\$qcari%')\"; \n");
	fwrite($myfile, "} \n");
	fwrite($myfile, " \n");
	fwrite($myfile, "\$pageQry = mysqli_query(\$koneksidb, \$pageSql) or die (\"error paging: \".\$pageSql); \n");
	fwrite($myfile, "\$jml	 = mysqli_num_rows(\$pageQry); \n");
	fwrite($myfile, "\$max	 = ceil(\$jml/\$row); \n");
	fwrite($myfile, " \n");
	fwrite($myfile, "?> \n");
	fwrite($myfile, " \n");
	
	fwrite($myfile, "<table class=\"table table-striped\"> \n");
	fwrite($myfile, "	<tr> \n");
	fwrite($myfile, "	  <td colspan=\"2\"><h1><b> <?php echo \$formName;?> </b>  \n");
	fwrite($myfile, "	  <form class=\"navbar-search pull-right\"  method=\"POST\" action=\"?page=<?php echo \$formName?>-Data\">  \n");
	fwrite($myfile, "		  <input type=\"text\" name=\"qcari\" placeholder=\"Cari...\" autofocus/> \n");
	fwrite($myfile, "	  </form></h1> </td> \n");
	fwrite($myfile, "	</tr> \n");
	fwrite($myfile, "</table> \n");
  
	fwrite($myfile, "<div class=\"accordion\" id=\"collapse-group\">         \n");              
	fwrite($myfile, "  <div class=\"accordion-group widget-box\"> \n");
	fwrite($myfile, "	  <div class=\"accordion-heading\"> \n");
	fwrite($myfile, "		  <div class=\"widget-title\"> \n");
	fwrite($myfile, "			  <a data-parent=\"#collapse-group\" href=\"#collapseGTwo\" data-toggle=\"collapse\"> \n");
	fwrite($myfile, "				  <span class=\"icon\"><i class=\"icon-circle-arrow-right\"></i></span><h5>Tambah Data <?php  echo \$formName ?></h5> \n");
	fwrite($myfile, "			  </a> \n");
	fwrite($myfile, "		  </div> \n");
	fwrite($myfile, "	  </div> \n");
	fwrite($myfile, "	  <div class=\"collapse accordion-body\" id=\"collapseGTwo\"> \n");
	fwrite($myfile, "		  <div class=\"widget-content\">      \n");
	fwrite($myfile, "			  <form id=\"new-project\" class=\"form-horizontal \" action=\"?page=<?php echo \$formName;?>-Data\" method=\"post\" name=\"form1\" target=\"_self\"> \n");
	fwrite($myfile, "				  <fieldset> \n");
	fwrite($myfile, "					<table class=\"table table-striped\"> \n");
	fwrite($myfile, "						<?php \n");
for($i=3;$i<=$jmlField;$i++){
	fwrite($myfile, "							buatInputText(\$isian[$i],$i,\$data[$i]); \n");	
}
	fwrite($myfile, "							//buatInputSelect(\$isian[7],7,\$data[7],\"tFakultas\",\$koneksidb,\"Fakultas\"); \n");
	fwrite($myfile, "						?> \n");
	fwrite($myfile, "						<tr> \n");
	fwrite($myfile, "							 <td>&nbsp;</td> \n");
	fwrite($myfile, "							 <td>&nbsp;</td> \n");
	fwrite($myfile, "							 <td><button type=\"submit\"  name=\"btnSave\" class=\"btn btn-primary\">Simpan</button> \n");
	fwrite($myfile, "								<button type=\"reset\" class=\"btn \" name=\"reset\" id=\"reset\" onclick=\"return confirm('Reset data yang telah anda ketik?')\"/>Reset</button> \n");
	fwrite($myfile, "							  	<a class=\"toggle-link\" href=\"#new-project\"><button type=\"button\" class=\"btn \" name=\" KEMBALI \" id=\"cancel\" value=\" BATAL \" /><!-- onclick=\"history.back();\" --> Batal </button></a> \n");
	fwrite($myfile, "							 </td> \n");
	fwrite($myfile, "						</tr> \n");
	fwrite($myfile, "					 </table> \n");
	fwrite($myfile, "				 </fieldset> \n");
	fwrite($myfile, "			 </form> \n");
	fwrite($myfile, "		 </div> \n");
	fwrite($myfile, "	 </div> \n");
	fwrite($myfile, "  </div> \n");
	fwrite($myfile, "</div>		 \n");			

	fwrite($myfile, "<table class=\"table table-bordered table-striped\"> \n");
	fwrite($myfile, "	<tr> \n");
	fwrite($myfile, "		<th width=\"60\" align=\"center\"><strong>No</strong></th> \n");
for($i=3;$i<=$jmlField;$i++){
	fwrite($myfile, "		<th><strong><?php echo \$isian[".$i."]; ?></strong></th> \n");
}
	fwrite($myfile, "		<th width=\"10\" colspan=\"2\"><strong>Option</strong></td> \n");

	fwrite($myfile, "	</tr> \n");
	fwrite($myfile, "<?php \n");
	fwrite($myfile, "tampilTabel(\$koneksidb,\$pageSql,\$field,\$formName,\$hal,\$row); \n");
	fwrite($myfile, "?> \n");
	fwrite($myfile, "</table> \n");
  	fwrite($myfile, "<?php tabelFooter(\$jml,\$row,\$max,\$formName,\$hal) ?> \n");
}

function editBukafile($folderOutput, $namaForm){
	$source="layouts/buka_file.php";
	$target="layouts/buka_file_backup.php";
	// copy operation
	$namaFile = strtolower($namaForm);
	$sh=fopen($source, "r");
	$th=fopen($target, "w");
	while (!feof($sh)) {
		$line=fgets($sh);
		if (strpos($line, '#MARKER')!==false) {
			$line=" 
			case '".$namaForm."-Data' :			
			if(!file_exists ('".$folderOutput."/".$namaFile."_data.php')) include \"pages/404.php\"; 
			include '".$folderOutput."/".$namaFile."_data.php'; break;\n  
			case '".$namaForm."-Edit' :		
			if(!file_exists ('".$folderOutput."/".$namaFile."_edit.php')) include \"pages/404.php\"; 
			include '".$folderOutput."/".$namaFile."_edit.php'; break;\n  
			case '".$namaForm."-Delete' :			
			if(!file_exists ('".$folderOutput."/".$namaFile."_delete.php')) include \"pages/404.php\"; 
			include '".$folderOutput."/".$namaFile."_delete.php'; break;\n  						
			#MARKER \n
			" . PHP_EOL;
					}
		fwrite($th, $line);
	}
	fclose($sh);
	fclose($th);
	// delete old source file
	unlink($source);
	// rename target file to source file
	rename($target, $source);
}

function buatLog($user, $activity, $data){
	$source="logs/logs.txt";
	$target="logs/logs_backup.txt";
	$sh=fopen($source, "r");
	$th=fopen($target, "w");
	$ippengguna=$_SERVER['REMOTE_ADDR'];
	while (!feof($sh)) {
		$line=fgets($sh);
		if (strpos($line, '#MARKER')!==false) {
		 $line="[".date("Y-m-d h:i:sa")."][".$user."][".$ippengguna."][".$activity."][".$data."]
#MARKER". PHP_EOL;
		}
		fwrite($th, $line);
	}

	fclose($sh);
	fclose($th);
	// delete old source file
	unlink($source);
	// rename target file to source file
	rename($target, $source);
}

function buatMenu($namaForm){
	$source="layouts/partials/navlist.php";
	$target="layouts/partials/navlist_backup.php";
	$sh=fopen($source, "r");
	$th=fopen($target, "w");
	$ippengguna=$_SERVER['REMOTE_ADDR'];
	while (!feof($sh)) {
		$line=fgets($sh);
		if (strpos($line, '<!-- MARKER -->')!==false) {
		 $line="<li><a href=\"?page=".$namaForm."-Data\">Data ".$namaForm."</a> </li>
<!-- MARKER -->". PHP_EOL;
		}
		fwrite($th, $line);
	}

	fclose($sh);
	fclose($th);
	// delete old source file
	unlink($source);
	// rename target file to source file
	rename($target, $source);
}

function buatInput($jmlField,$isian,$data){
	for($i=1;$i<=$jmlField-1;$i++){
		echo "<tr>";
		echo "<td width=\"24%\"><b>".$isian[$i]."</b></td> ";
		echo "<td width=\"2%\"><b>:</b></td> ";
		echo "<td width=\"74%\"><input name=\"txt1\" type=\"text\" class=\"input-xxlarge\" value=\"".$data[$i]."\" size=\"60\" maxlength=\"60\"  /></td> ";
		echo "</tr>";
	}
}

function buatInputText($text,$i,$data){
	echo("						<tr> \n");
	echo("							<td width=\"24%\"><b>".$text."</b></td>  \n");
	echo("							<td width=\"2%\"><b>:</b></td>  \n");
	echo("							<td width=\"74%\"><input name=\"txt".$i."\" type=\"text\" class=\"input-xxlarge\" value=\"".$data."\" size=\"60\" maxlength=\"60\"  /></td>  \n");
	echo("						</tr> \n");
}

function buatInputTextBS($text,$i,$data){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$text</label>  \n");
	echo("							<input name=\"txt".$i."\" id=\"txt".$i."\" type=\"text\" class=\"form-control\" value=\"".$data."\"   />  \n");
	echo("						</div> \n");
} 

function buatInputTextAreaBS($text,$i,$data){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$text</label>  \n");
	echo("							<textarea class=\"form-control\"  name=\"txt".$i."\" id=\"txt".$i."\" rows=\"5\" >$data</textarea>  \n");
	echo("						</div> \n");
} 

function buatInputHidden($text,$i,$data){
	echo("							<input name=\"txt".$i."\" type=\"hidden\" class=\"input-xxlarge\" value=\"".$data."\" size=\"60\" maxlength=\"60\"  />  \n");
}

function buatInputTanggal($text,$i,$data){
	echo("						<tr> \n");
	echo("							<td width=\"24%\"><b>".$text."</b></td>  \n");
	echo("							<td width=\"2%\"><b>:</b></td>  \n");
	echo("							<td width=\"74%\"><input name=\"txt".$i."\" type=\"date\" class=\"input-xxlarge\" value=\"".$data."\" size=\"60\" maxlength=\"60\"  /></td>  \n");
	echo("						</tr> \n");
}

function buatInputSelect($isian,$i,$data,$namaTable,$koneksidb,$orderby){
	echo("						<tr> \n");
	echo("							<td width=\"24%\"><b>".$isian."</b></td>  \n");
	echo("							<td width=\"2%\"><b>:</b></td>  \n");
	echo("							<td width=\"74%\">
										<select name=\"txt".$i."\" class=\"span4\">");	
	$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['id']) {
			$cek = "selected";
		} else { $cek=""; }											
		echo "<option value='$kolomData1[id]' $cek>$kolomData1[4] </option>";
	}
	echo("								</select>
									</td>  \n");
	echo("						</tr> \n");
}
function buatInputSelectBS($isian,$i,$data,$namaTable,$koneksidb,$orderby){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n");
	echo("							<select name=\"txt".$i."\" id=\"txt".$i."\" class=\"span4\">");	
									$mySql = "SELECT * FROM ".$namaTable." ORDER BY ".$orderby." ASC";										
									$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
									while ($kolomData1 = mysqli_fetch_array($myQry)) {
										if ($data == $kolomData1['id']) {
											$cek = "selected";
										} else { $cek=""; }											
										echo "<option value='$kolomData1[id]' $cek>$kolomData1[4] </option>";
	}
	echo("								</select>
									</div>  \n");
}



function buatEditText($text,$i,$data){
	echo "	<div class=\"control-group\"> \n";
	echo "	<label class=\"control-label\" for=\"input0".$i."\">".$text."</label> \n";  
	echo "	<div class=\"controls\"> \n";  
	echo "		<input name=\"txt$i\" type=\"text\" class=\"input-xlarge\" id=\"input00\" value=\"$data\"  size=\"60\" maxlength=\"50\"  /> \n";  
	echo "	</div> \n"; 
	echo "	</div>  \n";
}

function buatEditTanggal($text,$i,$data){
	echo "	<div class=\"control-group\"> \n";
	echo "	<label class=\"control-label\" for=\"input0".$i."\">".$text."</label> \n";  
	echo "	<div class=\"controls\"> \n";  
	echo "		<input name=\"txt$i\" type=\"date\" class=\"input-xlarge\" id=\"input00\" value=\"$data\"  size=\"60\" maxlength=\"50\"  /> \n";  
	echo "	</div> \n"; 
	echo "	</div>  \n";
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function buatInputSelectHadir($isian,$i){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");											
	echo "									<option value='HADIR' selected>HADIR</option>";
	echo "									<option value='IJIN' >IJIN</option>";
	echo "									<option value='SAKIT' >SAKIT</option>";
	echo "									<option value='ALPA' >ALPA</option>";
	echo("								</select>\n
								</div>  \n");
}

function buatInputSelectHari($isian,$i){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");											
	echo "									<option value='SENIN' selected>SENIN</option>";
	echo "									<option value='SELASA' >SELASA</option>";
	echo "									<option value='RABU' >RABU</option>";
	echo "									<option value='KAMIS' >KAMIS</option>";
	echo "									<option value='JUMAT' >JUMAT</option>";
	echo "									<option value='SABTU' >SABTU</option>";	
	echo("								</select>\n
								</div>  \n");
}

function buatInputSelectJam($isian,$i,$data,$namaTable,$koneksidb,$field,$kondisi,$orderby){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");	
	$mySql = "SELECT * FROM ".$namaTable." WHERE $field = '$kondisi' ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['idj']) {
			$cek = "selected";
		} else { $cek=""; }											
		echo "<option value='$kolomData1[idj]' $cek>$kolomData1[mulai] - $kolomData1[sampai] </option>";
	}
	echo("								</select>
									</div>  \n");
}

function buatInputSelectMatakuliah($isian,$i,$data,$koneksidb,$kode_prodi,$tahun_id,$orderby){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");	
	$mySql = "SELECT m_mata_kuliah.*, m_program_studi.* FROM m_mata_kuliah INNER JOIN m_program_studi ON m_mata_kuliah.kode_prodi = m_program_studi.kode_prodi
					 GROUP BY kode_mk  HAVING m_mata_kuliah.kode_prodi='$kode_prodi'  ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['kode_mk']) {
			$cek = "selected";
		} else { $cek=""; }											
		echo "<option value='$kolomData1[kode_mk]' $cek>$kolomData1[kode_mk] \n $kolomData1[nama_mk] \n SMT$kolomData1[semester] </option>";
	}
	echo("								</select>
									</div>  \n");
}

function buatInputSelectDosen($isian,$i,$data,$koneksidb,$kode_prodi,$tahun_id,$orderby){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");	
	$mySql = "SELECT * FROM m_dosen WHERE m_dosen.kode_fak='$kode_prodi' AND status_aktif='A'  ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['idd']) {
			$cek = "selected";
		} else { $cek=""; }											
		echo "<option value='$kolomData1[idd]' $cek>$kolomData1[NIDN]  $kolomData1[nama_dosen] </option>";
	}
	echo("								</select>
									</div>  \n");
}

function buatInputSelectKK($isian,$i,$data,$koneksidb,$orderby){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");	
	$mySql = "SELECT * FROM user WHERE level='KETUA KELAS'  ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['userid']) {
			$cek = "selected";
		} else { $cek=""; }											
		echo "<option value='$kolomData1[userid]' $cek>$kolomData1[username] - $kolomData1[nama] </option>";
	}
	echo("								</select>
									</div>  \n");
}

function buatInputSelectKelas($isian,$i,$data,$koneksidb,$field,$kondisi,$orderby){
	echo("						<div class=\"form-group\"> \n");
	echo("							<label for=\"txt".$i."\">$isian</label>  \n
										<select name=\"txt".$i."\" >");	
	$mySql = "SELECT * FROM m_kelas WHERE $field = '$kondisi'  ORDER BY ".$orderby." ASC";										
	$myQry = mysqli_query($koneksidb, $mySql) or die ("Gagal Query ruangan  ".$mySql);										
	while ($kolomData1 = mysqli_fetch_array($myQry)) {
		if ($data == $kolomData1['idk']) {
			$cek = "selected";
		} else { $cek=""; }											
		echo "<option value='$kolomData1[idk]' $cek>$kolomData1[kelas] </option>";
	}
	echo("								</select>
									</div>  \n");
}

function tampilTabel1($koneksidb,$pageSql,$field,$formName,$hal,$row){
	$mySql = $pageSql." ORDER BY ".$field[4]." ASC LIMIT $hal, $row";
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".$mySql);
	$nomor  = 1+$hal; 
	$i=0;
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData['idj'];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
			echo("<td> ".$kolomData[$field[4]]." -  <b>".$kolomData['kelas']."</b> </td>");
			$i++;
		
		echo("</td>");	
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$formName."-Data&Kode=".$Kode." \" target=\"_self\"><i class=\"icon-edit\"></i></a></td>");
		echo("</tr>");	
	}
}
function tampilTabelPresensi($koneksidb,$pageSql,$field,$formName,$hal,$row,$id){
	$mySql = $pageSql." ORDER BY tanggal ASC LIMIT $hal, $row";
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".$mySql);
	$nomor  = 1+$hal; 
	$i=0;
	while ($kolomData = mysqli_fetch_array($myQry)) {
		$Kode = $kolomData['iddm'];
		echo("<tr>");
		echo("<td align=\"center\">".$nomor++."</td>");
			echo("<td> ".$kolomData['tanggal']."</b> </td>");
			echo("<td> ".$kolomData['bahasan']."</b> </td>");
			$i++;
		
		echo("</td>");	
		//echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$formName."-Data&Kode=".$Kode." \" target=\"_self\"><i class=\"icon-eye-open\"></i></a></td>");
		echo("<td class=\"cc\" align=\"center\"><a href=\"# \" target=\"_self\"><i class=\"icon-eye-open\"></i></a></td>");
		echo("<td class=\"cc\" align=\"center\"><a href=\"?page=".$formName."-Delete&id=".$id."&Kode=".$Kode." \" onclick=\"return confirm('Anda Yakin menghapus Data ? ')\"><i class=\"icon-trash\"></i></a></td>");
		echo("</tr>");	
	}
}


?>
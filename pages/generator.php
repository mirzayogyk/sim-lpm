<?php 
	if($_GET) {
		if(isset($_POST['btnSave'])){
			$pesanError = array();
			$pesanSuccess = array();
			$namaTable = $_POST['txt5'];
			$namaForm = $_POST['txt6'];
			$folderOutput = "pages/masters";	
			if (!file_exists("pages/masters") )
			mkdir("pages/masters");				

			$pageSql="SELECT $namaTable.* FROM ".$namaTable;
			$pageQry = mysqli_query($koneksidb, $pageSql) or die ("error handak jumlahField: ".$pageSql);
			$jmlField = mysqli_num_fields($pageQry)-1;  

			if (trim($_POST['txt6'])=="") {
				$pesanError[] = "Data <b>Nama Form</b> tidak boleh kosong !";		
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
			}else{
				$pesanSuccess[]="File ".$namaForm." Berhasil Dibuat !! ";
				echo "<div class='mssgBox'>"; 
				$noPesan=0;
				foreach ($pesanSuccess as $indeks=>$pesan_tampil) { 
					$noPesan++; 
					echo '<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
					<h4 class="alert-heading">Sukses !!</h4>'.$pesan_tampil.'</div><br>';	
				} 
				echo "</div> <br>"; 

				buatConfig($folderOutput, $namaForm, $koneksidb, $namaTable);
				buatDelete($folderOutput, $namaForm, $namaTable);
				buatData($folderOutput, $namaForm, $namaTable,$jmlField);
				buatEdit($folderOutput, $namaForm, $namaTable,$jmlField);
			
			//test tambahan editing buka file
			// $data_to_write = "Testing \n Test2 \n ".$namaForm;
			// $file_path = "cont/buka_je.php";
			// $file_handle = fopen($file_path, 'w');
			// fwrite($file_handle, $data_to_write);
			// fclose($file_handle);
			
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
					if(!file_exists ('".$folderOutput."/".$namaFile."_data.php')) include pages/404/php; 
					include '".$folderOutput."/".$namaFile."_data.php'; break;\n  
					case '".$namaForm."-Edit' :		
					if(!file_exists ('".$folderOutput."/".$namaFile."_edit.php')) die (\$nopage); 
					include '".$folderOutput."/".$namaFile."_edit.php'; break;\n  
					case '".$namaForm."-Delete' :			
					if(!file_exists ('".$folderOutput."/".$namaFile."_delete.php')) die (\$nopage); 
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
		}
	}	
?>
<form  class="form-horizontal" action="?page=Generator" method="post" name="form1" target="_self" id="form1">  
<fieldset> 
	<legend>Generate Form</legend> 
		<div class="control-group"> 
			<label class="control-label" for="input00">Pilih Tabel</label>  
			<div class="controls">  
				<select name="txt5" class="span4"> 
				<?php
					$result = mysqli_query($koneksidb,"show tables"); // run the query and assign the result to $result
					while($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result
						echo "<option value='$table[0]'> table $table[0] </option>";
					}

					// $mySql2 = "SELECT * FROM tfakultas ORDER BY fakultas ASC";
					// $myQry = mysqli_query($koneksidb, $mySql2) or die ("Gagal Query fakultas  ".mysqli_error($koneksidb));
					// while ($kolomData1 = mysqli_fetch_array($myQry)) {
						
					// }
					// $mySql ="";
				?>
				</select>
			</div> 
		</div> 
		<div class="control-group"> 
			<label class="control-label" for="input01">Nama Form</label>  
			<div class="controls">  
				<input name="txt6" type="text" class="input-xlarge" id="input01" value=""  size="60" maxlength="50" />  
			</div> 
		</div> 
<div class="form-actions"> 
							<button type="submit"  name="btnSave" class="btn btn-primary">Generate</button> 
						
		</div> 
 
<?php 
//buka file rtf
$template = "template/format_laporan.rtf";
$handle = fopen($template, "r+");
$hasilbaca = fread($handle, filesize($template));
fclose($handle);
 
//nilai yang akan dituliskan dalam template
//pada praktek sebenarnya anda bisa mengambil data dari database
$data_nama = 'Hari Prasetyo';
$data_dob = '12-12-2012';
$data_alamat = 'Jakarta, Indonesia';
// $data_tgl_cetak = date('d-m-Y H:i:s');
$data_tgl_cetak = date('Y-m-d');
 
//tuliskan data dalam template
$hasilbaca = str_replace('data_nama', $data_nama, $hasilbaca);
$hasilbaca = str_replace('data_dob', $data_dob, $hasilbaca);
$hasilbaca = str_replace('data_alamat', $data_alamat, $hasilbaca);
// $hasilbaca = str_replace('data_tgl_cetak', $data_tgl_cetak, $hasilbaca);
$hasilbaca = str_replace('data_tgl_cetak', indonesia2Tgl($data_tgl_cetak), $hasilbaca);
 
//membuat file baru dari hasil baca
$hasil = "hasil/hasil_laporan.rtf";
$handle = fopen($hasil, "w+");
fwrite($handle, $hasilbaca);
fclose($handle);
 
//membuka file hasil secara langsung
//header('Location:'.$hasil); 
 
//atau membuka file melalui link
echo '<a href="'.$hasil.'">Hasil</a>';
$dd ='123'; 
$ee = hash_pass5($dd);
?>
<br>
<?php echo hash_pass5($dd); ?><br>
<?php echo de_hash_pass5($ee); ?>
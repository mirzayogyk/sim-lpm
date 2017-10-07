<div id="sidebar">
  <a href="?page=Home" class="visible-phone">
    <i class="icon icon-home"></i> Prodi: <?php 
      $kode_prodi = $_SESSION['PRODIMRZ'];
      $cariSql = "SELECT m_program_studi.* FROM m_program_studi WHERE kode_prodi='$kode_prodi'"; 
      $cariQry = mysqli_query($koneksidb, $cariSql) or die ("error cari: ".$cariSql); 
      while ($hasilCari = mysqli_fetch_array($cariQry)) {
        $nama_prodi = $hasilCari['nama_prodi'];
      }
      echo $kode_prodi." - ".$nama_prodi;
    ?>
  </a>
      <ul>
        <li class="active"><a href="?page=Home"><i class="icon icon-home"></i> <span>Beranda</span></a></li>
        <li class="active"><a href="?page=Presensi-Data"><i class="icon icon-list"></i><span>Data Jadwal</span></a> </li>
        <li class="active"><a href="?page=Presensi-Data"><i class="icon icon-list"></i><span>Data Presensi</span></a> </li>
<!-- MARKER -->
        <li> <a href="?page=Generator"><i class="icon icon-tasks"></i> <span>Generator</span> </a>  </li>
        <li class=""><a title="" href="?page=Logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>


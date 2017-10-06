<?php
// Variabel koneksi
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "";
$myDbs	= "uniska_sia";

// Konek ke MySQL Server 
$koneksidb	= mysqli_connect($myHost, $myUser, $myPass, $myDbs);
if (! $koneksidb) {
  echo "Failed Connection !";
}

//mysqli model 
// $db = new mysqli($myHost, $myUser, $myPass, $myDbs);
 
// if($db->connect_errno > 0){
    // die('Failed Connection! Unable to connect to database [' . $db->connect_error . ']');
// }  

// Memilih database pd MySQL Server
// mysql_select_db($myDbs) or die ("Database not Found !");
?>
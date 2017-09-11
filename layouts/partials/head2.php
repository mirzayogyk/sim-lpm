<!DOCTYPE html>
<html lang="en">

<head>
<title>Aplikasi Pendataan dan Pendaftaran Ormas Berbasis Web Kabupaten Tapin</title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<?php
if(isset($_SESSION['MAIN_FROZEN_THRON3']))
{
	 ?>
	 	
<link rel="stylesheet" href="css/maruti-style-dongker.css" />
<link rel="stylesheet" href="css/maruti-media-dongker.css" class="skin-color" />
<?php
}
elseif(isset($_SESSION['MAIN_DAS_L4H']))
{
?>		
<link rel="stylesheet" href="css/maruti-style-hijau.css" />
<link rel="stylesheet" href="css/maruti-media-hijau.css" class="skin-color" /> 
<?php
}
elseif(isset($_SESSION['MAIN_DOTA_KAH']))
{
	 ?>	
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
<?php
}
else {
	?>
	
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
<?php
}
?>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="http://teknobara.co.id">TEKNOBARA</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">15</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<?php
if(isset($_SESSION['MAIN_FROZEN_THRON3']))
{
	include("cont/nav.php");
	include("cont/navlist.php");
}
elseif(isset($_SESSION['MAIN_DAS_L4H']))
{
	include("cont/nav.php");
	include("cont/navlist_kec.php");
}
elseif(isset($_SESSION['MAIN_DOTA_KAH']))
{
	include("cont/nav_log.php");
	include("cont/navlist_log.php");
}
else {
	include("cont/nav-user.php");
	include("cont/navlist-user.php");
}	?>
<!--close-top-Header-menu-->


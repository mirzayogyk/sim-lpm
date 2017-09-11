<?php
	session_start();
	include_once "library/connection.php";
	include_once "library/library.php";
	include ("layouts/partials/head.php") 
?>

<div id="content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<?php include "layouts/buka_file.php";?>
			</div>
		</div>
	</div>
</div>

<?php include ("layouts/partials/footer.php") ?>
</body>
</html>
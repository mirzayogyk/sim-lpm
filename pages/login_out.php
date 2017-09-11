<?php
$username = $_SESSION['NGARAN_SHARPSHOOT3R'];
buatLog($username,"LOGGED OUT","NULL");
session_unset();
session_destroy();
echo "<meta http-equiv='refresh' content='0; url=?page'>";
exit;
?>
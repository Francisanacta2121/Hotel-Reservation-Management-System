<?php
session_start();
session_unset();
session_destroy();
header("Location:..index.php"); // o login.php kung meron ka
exit;
?>

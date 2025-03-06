<?php
session_start();
session_destroy();
header("Location: ../includes/loggedout.php"); 
exit();
?>

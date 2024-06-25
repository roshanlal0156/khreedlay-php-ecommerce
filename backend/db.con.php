<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli('localhost', 'root', '', 'khreedlay_php_ecommerce', 3306);
$mysqli->set_charset('utf8mb4');
?>
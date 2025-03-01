<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "sipcot_clones"; 
$conn = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
  
} catch (mysqli_sql_exception $e) {
    echo "You're not connected with SQL: " . $e->getMessage();
}
?>

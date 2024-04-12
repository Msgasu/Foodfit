<?php include '../settings/connection.php';

$status = "SELECT * FROM status"; 
    $s_result = $mysqli->query($status); 
    return mysqli_fetch_all($s_result, MYSQLI_ASSOC);
    $mysqli->close(); 

?> 


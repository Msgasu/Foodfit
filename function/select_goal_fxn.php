<?php include '../settings/connection.php';

$type = "SELECT * FROM goal_types"; 
    $g_result = $mysqli->query($type); 
    return mysqli_fetch_all($g_result, MYSQLI_ASSOC);
    $mysqli->close(); 

?> 


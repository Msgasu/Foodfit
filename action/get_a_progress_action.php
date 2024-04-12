<?php

function gettrack($puid){
    include("../settings/connection.php");

    $query = "SELECT * FROM progress_tracking WHERE tracking_id = '$puid'";
    $result = $mysqli->query($query); 

    if (!$result) {
        die("Error executing query: " . $mysqli->error);
    }

    $prog = mysqli_fetch_assoc($result);

    $mysqli->close();

    return $prog;
}


?>

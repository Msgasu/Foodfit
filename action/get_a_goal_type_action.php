<?php

function getgoal($gid){
    include("../settings/connection.php");

    $query = "SELECT * FROM goal_types WHERE goalid = '$gid'";
    $result = $mysqli->query($query); 

    if (!$result) {
        die("Error executing query: " . $mysqli->error);
    }

    $goal = mysqli_fetch_assoc($result);

   
    $mysqli->close();

    return $goal;
}


?>

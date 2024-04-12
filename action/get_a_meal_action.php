<?php

function getmeal($mid){
    include("../settings/connection.php");

    $query = "SELECT * FROM meal_plans WHERE planid = '$mid'";
    $result = $mysqli->query($query); 

    if (!$result) {
        die("Error executing query: " . $mysqli->error);
    }

    $mealplan = mysqli_fetch_assoc($result);

    $mysqli->close();

    return $mealplan;
}

?>

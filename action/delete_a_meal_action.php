<?php
include_once "../settings/connection.php";

if (isset($_POST['mealId'])) {
    $mid = $_POST['mealId'];
    $query = "DELETE FROM meal_plans WHERE planid = '$mid'";
    if (mysqli_query($mysqli,$query)) {
        header ('Location:../vieww/plan_meal.php');
    } else {
        echo "Error deleting meal: " . $mysqli->error;
    }
   
} else {

    // header ('Location:../vieww/plan_meal.php');
    exit();
}


<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve meal data from the POST request
    $meal_id = $_POST['mealId']; 
    $meal_name = $_POST['mealName'];
    $meal_time = $_POST['mealTime'];
    $meal_date = $_POST['mealDate'];

    // Prepare and execute the SQL query to update the meal
    $query = "UPDATE meal_plans SET plan_name = '$meal_name', meal_time = '$meal_time', date_created = '$meal_date' WHERE planid = $meal_id";
    
    if (mysqli_query($mysqli, $query)) {
        
        //header('Location:../vieww/plan_meal.php'); 
        exit();
    } else {
        
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>

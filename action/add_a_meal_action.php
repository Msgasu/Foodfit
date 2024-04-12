<?php
include "../settings/connection.php";
include "../settings/core.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $mealName = $_POST['mealName'];
    $mealTime = $_POST['mealTime'];
    $mealDate = $_POST['mealDate'];
    $pid = $_SESSION['user_id'];
    

    $stmt = $mysqli->prepare("INSERT INTO meal_plans (pid, plan_name, meal_time, date_created) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $pid, $mealName, $mealTime, $mealDate);

    // Execute the statement
    if ($stmt->execute()) {
     
        //header("Location: ../vieww/plan_meal.php");
        exit(); 
    } else {
     
        echo "Error: " . $mysqli->error;
    }

   
    $stmt->close();
}


$mysqli->close();
?>

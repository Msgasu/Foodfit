<?php
include "../settings/connection.php";
include_once "../settings/core.php";

function get_total_meals_planned($userId, $mysqli) {
    $query = "SELECT COUNT(*) AS total_meals FROM meal_plans WHERE pid = '$userId'";
    $result = $mysqli->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_meals'];
    } else {
        return 0;
    }
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $totalMeals = get_total_meals_planned($userId, $mysqli);
    $_SESSION['total_meals_planned'] = $totalMeals;
} else {
    echo "User is not logged in.";
}
?>

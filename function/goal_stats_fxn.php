<?php
include "../settings/connection.php";
include_once "../settings/core.php";

// Function to get the total number of goals for a specific user
function get_total_goals($userId, $mysqli) {
    $query = "SELECT COUNT(*) AS total_goals FROM goals WHERE pid = '$userId'";
    $result = $mysqli->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_goals'];
    } else {
        return 0;
    }
}

// Function to get the count of goals for each status based on user ID
function get_goal_count_by_status($userId, $statusId, $mysqli) {
    $query = "SELECT COUNT(*) AS total_goals FROM goals WHERE pid = '$userId' AND status_id = '$statusId'";
    $result = $mysqli->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_goals'];
    } else {
        return 0;
    }
}


$userId = $_SESSION['user_id'];

// Fetch the total number of goals for the user
$totalGoals = get_total_goals($userId, $mysqli);

// Fetch the count of goals for each status
$completedGoals = get_goal_count_by_status($userId, 1, $mysqli); 
$inProgressGoals = get_goal_count_by_status($userId, 2, $mysqli); 
$canceledGoals = get_goal_count_by_status($userId, 3, $mysqli); 


$completedPercentage = number_format(($completedGoals / max(1, $totalGoals)) * 100, 2);
$inProgressPercentage = number_format(($inProgressGoals / max(1, $totalGoals)) * 100, 2);
$canceledPercentage = number_format(($canceledGoals / max(1, $totalGoals)) * 100, 2);


// Store values in session variables
$_SESSION['total_goals'] = $totalGoals;
$_SESSION['completed_goals'] = $completedGoals;
$_SESSION['in_progress_goals'] = $inProgressGoals;
$_SESSION['canceled_goals'] = $canceledGoals;
$_SESSION['completed_percentage'] = $completedPercentage;
$_SESSION['in_progress_percentage'] = $inProgressPercentage;
$_SESSION['canceled_percentage'] = $canceledPercentage;





//Tests
// echo "Total Goals: " . $totalGoals . "<br>";
// echo "Completed Goals: " . $completedGoals . "<br>";
// echo "In Progress Goals: " . $inProgressGoals . "<br>";
// echo "Canceled Goals: " . $canceledGoals . "<br>";
// echo "Completed Percentage: " . $completedPercentage . "%<br>";
// echo "In Progress Percentage: " . $inProgressPercentage . "%<br>";
// echo "Canceled Percentage: " . $canceledPercentage . "%<br>";


// echo "<br>After updating session variables:<br>";
// echo "Total Goals: " . $_SESSION['total_goals'] . "<br>";
// echo "Completed Goals: " . $_SESSION['completed_goals'] . "<br>";
// echo "In Progress Goals: " . $_SESSION['in_progress_goals'] . "<br>";
// echo "Canceled Goals: " . $_SESSION['canceled_goals'] . "<br>";
// echo "Completed Percentage: " . $_SESSION['completed_percentage'] . "%<br>";
// echo "In Progress Percentage: " . $_SESSION['in_progress_percentage'] . "%<br>";
// echo "Canceled Percentage: " . $_SESSION['canceled_percentage'] . "%<br>";
?>

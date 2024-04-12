<?php
include_once '../action/get_all_meals_action.php';

function display_meals_table(){
    $meal_data = fetch_meals();
    foreach ($meal_data as $row) {
        echo '<tr>';
        echo '<td>' . $row['plan_name'] . '</td>';
        echo '<td>' . $row['meal_time'] . '</td>';
        echo '<td>' . $row['date_created'] . '</td>';
        echo '<td class="action-buttons">';
        echo '<a class="edit-meal-button" data-meal-id="' . $row['planid'] . '"><i class="material-icons-sharp">edit</i></a>';
        echo '<a class="delete-meal-button" data-meal-id="' . $row['planid'] . '"><i class="material-icons-sharp">delete</i></a>';
        echo '</td>';
        echo '</tr>';
    }
}

?>





<?php
include_once '../action/get_all_goals_action.php';

function display_goals_table(){
    $goal_data = fetch_goals();
    $total_rows = count($goal_data);


    
    // Start looping from the end of the array
    for ($index = $total_rows - 1; $index >= 0; $index--) {
        $row = $goal_data[$index];
        
        // Table row for Goal Type
        echo '<tr>';
        echo '<th>Goal Type:</th><td>' . $row['goal_type'] . '</td>';
        echo '</tr>';
        
      
        echo '<tr>';
        echo '<th>Goal Description:</th><td>' . $row['goal_description'] . '</td>';
        echo '</tr>';
        
        
        echo '<tr>';
        echo '<th>Target Period:</th><td>' . $row['targetperiod'] . '</td>';
        echo '</tr>';
        
        
        echo '<tr>';
        echo '<td colspan="2" class="action-buttons">';
        echo '<a class="edit-goal-button" data-meal-id="' . $row['goalid'] . '"><i class="material-icons-sharp">edit</i></a>';
        echo '<a class="delete-goal-button" data-meal-id="' . $row['goalid'] . '"><i class="material-icons-sharp">delete</i></a>';
        echo '</td>';
        echo '</tr>';

        // Break the loop after displaying the most recent two entries
        if ($total_rows - $index == 2) {
            break;
        }
    }
    

}
?>

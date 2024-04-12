<?php
include_once '../action/get_all_users_action.php';

function display_users_table(){
    $meal_data = getusers();
    foreach ($meal_data as $row) {
        echo '<tr>';
        echo '<td>' .$row['f_name'] . ' ' . $row['l_name']; '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['tel'] . '</td>';
        echo '<td class="action-buttons">';
       
       
        echo '</td>';
        echo '</tr>';
    }
}

?>





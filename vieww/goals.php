<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goals Tracker</title>


  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/goal.css">

  <?php include "../function/meal_fxn.php"?>
  <?php include "../function/get_username_fxn.php" ?>
  <?php include "../function/select_status_fxn.php"?>
  <?php include "../function/select_goal_fxn.php"?>
  <?php include "../function/goal_fxn.php"?>
  <?php include "../action/get_all_progress_action.php"?>
  <?php include_once "../settings/core.php"?>  
  <?php include "../function/get_goal_fxn.php"?>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"/>

  <link href="https://fonts.googleapis.com/css2?family=Aptos&display=swap" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<style>
 


 .action-buttons {
    text-align: center;
}

.action-buttons a {
    margin-right: 10px;
}

.add-progress-button {
    display: block;
    margin-top: 10px; 
    padding: 8px 16px; 
    background-color: #4CAF50; 
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.add-progress-button:hover {
    background-color: #45a049; 
}

</style>
<body>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
  <ul>
    <li><a href="dashboard.php"><i class="material-icons dashboard-icon">dashboard</i> Dashboard</a></li>
    <li><a href="plan_meal.php"><i class="material-icons meal-icon">fastfood</i> Plan a meal</a></li>
    <li><a href="goals.php"><i class="material-icons goals-icon">flag</i> Goals</a></li>
    <li><a href="search_website.php"><i class="material-icons website-icon">web</i> Look for a meal</a></li>
    <li class="logout"><a href="../login/logout_view.php"><i class="material-icons">exit_to_app</i> Logout</a></li>
  </ul>
</div>

    <!-- Content -->
    <div class="content">
      <header class="topbar">
        <div class="page-title">
          <h4>Goal Creation & Tracking</h4>
      
        </div>
       
        <div class="user-info">
        <?php
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $userName = getUserName($userId, $mysqli);
            // $role = getRole($userId, $mysqli);
            echo '<div class="user-icon"><i class="material-icons">account_circle</i></div>';
            echo '<div class="user-name">' . $userName . '</div>';
        } else {
            echo "Error: User ID not set in session";
        }
        ?>
    </div>
      </header>

      <!-- Widgets for each goal type -->
      <div class="goal-widget-container">
        <div class="goal-container" id="weightLossContainer">
          <div class="goal-widget" id="weightLossWidget" style="background-image: url('../images/lose-weight.jpg')"></div>
          <div class="goal-text">Weight Loss</div>
        </div>
        <div class="goal-container" id="muscleGainContainer">
          <div class="goal-widget" id="muscleGainWidget" style="background-image: url('../images/muscle.jpg')"></div>
          <div class="goal-text">Muscle Gain</div>
        </div>
        <div class="goal-container" id="energyLevelsContainer">
          <div class="goal-widget" id="energyLevelsWidget" style="background-image: url('../images/energy.jpg')"></div>
          <div class="goal-text">Improved Energy Levels</div>
        </div>
        <div class="goal-container" id="overallHealthContainer">
          <div class="goal-widget" id="overallHealthWidget" style="background-image: url('../images/healthy.jpg')"></div>
          <div class="goal-text">Better Overall Health</div>
        </div>
      </div>




   
<!-- Tables for displaying goals -->
<h2 style="margin-top: 50px; text-align: center;">Goals Overview</h2>
<div class="table-container">
    <table class="goal-table">
        <thead>
            <tr>
                <th>Goal Type</th>
                <th>Goal Description</th>
                <th>Target Period</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch goals data
            $goal_data = fetch_goals();

         
            if (!empty($goal_data)) {
              
                foreach ($goal_data as $index => $goal) {
                    ?>
                    <tr>
                        <td><?= $goal['goal_type'] ?></td>
                        <td><?= $goal['goal_description'] ?></td>
                        <td><?= $goal['targetperiod'] ?></td>
                        <td class="status-icon"  style="text-align: center;">
                        <?php
                       
                        $status_id = $goal['status_id'];
                        
                
                        if ($status_id == 1) {
                            echo "<i class='far fa-check-circle' style='color: green; font-size: 24px;'></i>"; // Completed
                        } elseif ($status_id == 2) {
                            echo "<i class='fas fa-spinner' style='color: blue; font-size: 24px;'></i>"; // In Progress
                        } elseif ($status_id == 3) {
                            echo "<i class='far fa-times-circle' style='color: red; font-size: 24px;'></i>"; // Not Started
                        } else {
                            echo "Unknown Status"; 
                        }
                        ?>                 </td>
                                            <td class="action-buttons">
                            <a class="edit-goal-button" data-selected-goal-id="<?= $goal['goalid'] ?>"><i class="material-icons-sharp">edit</i></a>
                            <a class="delete-goal-button" data-selected-goal-id="<?= $goal['goalid'] ?>"><i class="material-icons-sharp">delete</i></a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
               
                <tr>
                    <td colspan="5">No goals set yet.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>





<!-- Table for Progress Table 1 -->
<h2 style="margin-top: 70px; text-align: center;">Progress Updates</h2>


<div class="progress-table-container">
    <div class="progress-table">
        <table>
            <thead>
                <tr>
                    <th>Goal Type</th>
                    <th>Entry Date</th>
                    <th>Progress Update</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 
                    $progress_data_1 = fetch_progress();

                    if (!empty($progress_data_1)) {
                       
                        foreach ($progress_data_1 as $progress) {
                            echo "<tr>";
                           
                            $goal_type = fetch_goal_type($progress['goal_type_id']); 
                            echo "<td>" . $goal_type['goal_type_name'] . "</td>"; 
                            echo "<td>" . $progress['entry_date'] . "</td>";
                            echo "<td>" . $progress['progress_update'] . "</td>";
                            echo '<td class="action-buttons">';
                            echo '<a class="edit-tracking-button" data-tracking-id="' . $progress['tracking_id'] . '"><i class="material-icons-sharp">edit</i></a>';
                            echo '<a class="delete-tracking-button" data-tracking-id="' . $progress['tracking_id'] . '"><i class="material-icons-sharp">delete</i></a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='4'>No progress update available.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <button class="add-progress-button" onclick="openProgressModal(1)" data-goal-id="<?= $last_row['goalid'] ?>">Add Progress</button>
    </div>
</div>



</div>






  <!-- Modal for adding progress update -->

      <div id="progressModal" class="modal">
      <div class="modal-content">
        <span class="close" data-modal-id="progressModal">&times;</span>
        <h2><i class="material-icons" style="vertical-align: middle;">add_circle</i> Add Progress Update</h2>
        <form id="progressForm" method="POST">
          <input type="hidden" name="updateid" value="">
          <label for="progressUpdate"><i class="material-icons">description</i> Progress Update:</label>
          <textarea type= "text" id="progressUpdate" name="progressUpdate" required></textarea>
          <select name="goal_type" required>
                <option value="" disabled selected>Select goal type</option>
              <?php
              foreach ($g_result as $t_value) {  
                echo "<option value=".$t_value['goal_type_id'].">".$t_value['goal_type_name']."</option>"; 
              }
              ?>
              </select>
        
          <button type="button" id="saveProgress"><i class="material-icons" style="vertical-align: middle;">save</i> Save</button>
        </form>
      </div>
    </div>





      <!-- Modal -->
      <div id="goalModal" class="modal">
   
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Set Your Goal</h2>
          <form id="goalForm">
            <input type="hidden" id="selectedGoalInput" name="selectedGoal" value=""required>
            <input type="text" id="customGoal" name="customGoal" placeholder="Enter your custom goal"required>
            <input type="number" id="duration" name="duration" placeholder="Enter duration in weeks" min="1" required>
            <button type="button" id="saveGoalBtn" class="modal-buttons">Set Goal</button>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editGoalModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Goal</h2>
        <form id="editGoalForm">
            <input type=hidden id="selectedGoalId" name="selectedGoalId" value="">
            <div class="form-group">
                <label for="editCustomGoal">Custom Goal:</label>
                <input type="text" id="editCustomGoal" name="editCustomGoal" placeholder="Enter your custom goal">
            </div>
            <div class="form-group">
                <label for="editWeek">Week:</label>
                <input type="number" id="editWeek" name="editWeek" placeholder="Enter week" min="1">
            </div>
            <select name="status" required>
                <option value="" disabled selected>Select current goal status</option>
              <?php
              foreach ($s_result as $value) {  
                echo "<option value=".$value['status_id'].">".$value['status_name']."</option>"; 
              }
              ?>
              </select>
            <button type="button" id="saveEditBtn"  class="button">Save Changes</button>
        </form>
    </div>
</div>


  <!-- Modal for confirming goal deletion -->
  <div id="deleteModal" class="modal" style="display: none;">
      <div class="modal-content">
          <input type="hidden" id="deleteGoalId" name="deletegoal"> <!-- Set the ID of the goal to be deleted -->
          <h2>Confirm Deletion</h2>
          <p>Are you sure you want to delete this goal?</p>
          <div class="modal-buttons">
              <button id="confirmDeleteButton" class="delete-button" class="modal-buttons">Delete</button>
              <button id="cancelDeleteButton" class="cancel-button" class="modal-buttons">Cancel</button>
          </div>
      </div>
</div>



<!-- Modal for editing progress update -->
<div id="editProgressModal" class="modal">
    <div class="modal-content">
        <span class="close" data-modal-id="editProgressModal">&times;</span>
        <h2><i class="material-icons">edit</i> Edit Progress Update</h2>
        <form id="editProgressForm" method="POST">
            <input type=hidden id="editProgressId" name="progressId">
            <label for="editProgressUpdate"><i class="material-icons">description</i> Progress Update:</label>
            <textarea id="editProgressUpdate"  name="progressUpdate" required></textarea>
            <button type="button" id="saveEditProgress"><i class="material-icons">save</i> Save Changes</button>


        </form>
    </div>
</div>

<!-- Modal for confirming progress tracking deletion -->
<div id="deleteProgressModal" class="modal" style="display: none;">
    <div class="modal-content">
        <input type="hidden" id="deleteProgressId" name="deleteProgressId"> 
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this progress tracking entry?</p>
        <div class="modal-buttons">
            <button id="confirmDeleteProgressButton" class="delete-button">Delete</button>
            <button id="cancelDeleteProgressButton" class="cancel-button">Cancel</button>
        </div>
    </div>
</div>

<script>

</script>




<script src="../js/track.js"></script>
<script src="../js/goal.js"></script>

</body>
</html>

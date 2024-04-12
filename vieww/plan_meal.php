<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plan meal</title>
 
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/meal.css">

  <?php include "../function/get_username_fxn.php"?>
  <?php include "../function/meal_fxn.php"?>

  <link href="https://fonts.googleapis.com/css2?family=Aptos&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>



  <style>
.edit-meal-button {
  background-color: transparent;
  color: blue;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  cursor: pointer;
}


.edit-meal-button:hover {
  color: gray ;
}


  .delete-meal-button {
    background-color: transparent;
    color: red;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    cursor: pointer;
  }

.delete-meal-button:hover {
  color: gray ;
}


.delete-button,
.cancel-button {
    padding: 6px 10px;
    font-size: 12px;
}


.modal-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }


.question {
  font-family: "Indie Flower", cursive;
    font-size: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    font-weight:bold;
}

.question img {
    margin-right: -12px;
    width: 50px; 
    height: auto; 
}

.question-link {
    font-family: "Indie Flower", cursive;
    font-size: 25px;
    text-decoration: none; 
    color: inherit; 
}
</style>


</head>
<body>
<div class="sidebar">
  <ul>
    <li><a href="dashboard.php"><i class="material-icons dashboard-icon">dashboard</i> Dashboard</a></li>
    <li><a href="plan_meal.php"><i class="material-icons meal-icon">fastfood</i> Plan a meal</a></li>
    <li><a href="goals.php"><i class="material-icons goals-icon">flag</i> Goals</a></li>
    <li><a href="search_website.php"><i class="material-icons website-icon">web</i> Look for a meal</a></li>
    <li class="logout"><a href="../login/logout_view.php"><i class="material-icons">exit_to_app</i> Logout</a></li>
  </ul>
</div>


    <div class="content">
      <header class="topbar">
        <div class="page-title">Plan Your Meals</div>
        <div class="user-info">
          <?php
          if (isset($_SESSION['user_id'])) {
              $userId = $_SESSION['user_id'];
              $userName = getUserName($userId, $mysqli);
              echo '<div class="user-icon"><i class="material-icons">account_circle</i></div>';
              echo '<div class="user-name">' . $userName . '</div>';
          } else {
              echo "Error: User ID not set in session";
          }
          ?>
        </div>
      </header>
      <main>


      <!--Link to site -->
        <section id="mealPlanningSection">
          <div class="question">
          <a href="../vieww/search_website.php" class="question-link">
              <img src="../images/bulb.jpg" alt="Question Icon" class="question-image">
              Looking for new meals to try out?
          </a>
      </div>

      <!-- Meal table-->
          <table class="meal-table">
            <thead>
              <tr>
                <th>Meal</th>
                <th>Time</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              display_meals_table();
              ?>
            </tbody>
          </table>
          <button id="addMealButton" class="add-meal-button"><i class="material-icons" style="vertical-align: middle;">add</i> Add Meal</button>
        </section>
      </main>

    </div>
  </div>



<!-- Modal for adding meals -->
<div id="mealModal" class="modal" style="display: none;">
  <div class="modal-content">
  <span class="modal-close" data-modal-id="mealModal">&times;</span>
    <h2><i class="material-icons" style="vertical-align: middle;">add_circle</i> Add Meal</h2>
    <form id="mealForm" action="../action/add_a_meal_action.php" method="POST"> 
      <label for="mealName"><i class="material-icons">restaurant_menu</i> Meal:</label>
      <input type="text" id="mealName" name="mealName" required>
      <label for="mealTime"><i class="material-icons">access_time</i> Time:</label>
      <input type="time" id="mealTime" name="mealTime" required >
      <label for="mealDate"><i class="material-icons">calendar_today</i> Date:</label>
      <input type="date" id="mealDate" name="mealDate" required>
      <button type="submit" id="saveMeal"><i class="material-icons" style="vertical-align: middle;">save</i> Save</button> 
    </form>
  </div>
</div>


  <!-- Modal for editing meals -->
  <div id="editMealModal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="modal-close" data-modal-id="editMealModal">&times;</span>
      <h2><i class="material-icons" style="vertical-align: middle;">edit</i> Edit Meal</h2>
      <form id="editMealForm" action="../action/edit_a_meal_action.php" method="POST">
        <input type=hidden id="editMealId" name="mealId">
        <label for="editMealName"><i class="material-icons">restaurant_menu</i> Meal:</label>
        <input type="text" id="editMealName" name="mealName" required>
        <label for="editMealTime"><i class="material-icons">access_time</i> Time:</label>
        <input type="time" id="editMealTime" name="mealTime" required step="300">
        <label for="editMealDate"><i class="material-icons">calendar_today</i> Date:</label>
        <input type="date" id="editMealDate" name="mealDate" required>
        <button type="submit" id="updateMeal"><i class="material-icons" style="vertical-align: middle;">save</i> Save</button>
      </form>
    </div>
  </div>



<!-- Modal for confirming meal deletion -->
<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
    <input type=hidden id="deleteMealId" name="mealId"> 
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this meal?</p>
        <div class="modal-buttons">
            <button id="confirmDeleteButton" class="delete-button">Delete</button>
            <button id="cancelDeleteButton" class="cancel-button">Cancel</button>
        </div>
    </div>
</div>



<script  src="../js/meal.js"> </script>

</body>
</html>

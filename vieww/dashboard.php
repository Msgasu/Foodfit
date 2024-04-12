<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foodfit</title>

  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/website.css">

  <?php include "../function/get_username_fxn.php"; ?>
  <?php include "../function/goal_stats_fxn.php"?>
  <?php include "../function/get_total_meals_fxn.php"?>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Aptos&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<style>


</style>
<body>
  <div class="container">

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
        <div class="page-title">Dashboard</div>
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
        <section>
          <div class="summary-widgets">

            <!-- Widget for total meals planned -->
            <div class="widget">
              <i class="material-icons widget-icon dashboard-icon">restaurant_menu</i>
              <h3>Total Meals Planned</h3>
              <p><?php echo $_SESSION['total_meals_planned']; ?></p>
            </div>

            <!-- Updated widget for total goals -->
            <div class="widget">
              <i class="material-icons widget-icon dashboard-icon">flag</i>
              <h3>Total Goals Set</h3>
              <p><?php echo $_SESSION['total_goals']; ?></p>
            </div>

            <!-- Widget for completed goals -->
            <div class="widget">
              <i class="material-icons widget-icon meal-icon">check_circle</i>
              <h3>Completed Goals</h3>
              <p><?php echo $_SESSION['completed_percentage']." %"; ?></p>
            </div>

            <!-- Widget for in-progress goals -->
            <div class="widget">
              <i class="material-icons widget-icon goals-icon">hourglass_top</i>
              <h3>Goals In Progress</h3>
              <p><?php echo $_SESSION['in_progress_percentage']." %";?></p>
            </div>

            <!-- Widget for canceled goals -->
            <div class="widget">
              <i class="material-icons widget-icon goals-icon">cancel</i>
              <h3>Canceled Goals</h3>
              <p><?php echo $_SESSION['canceled_percentage']." %"; ?></p>
            </div>
          </div>
          
          <div class="chart-container">
            <canvas id="myChart"></canvas>
          </div>
        </section>
      </main>
      <section class="healthy-recipes">
      <h2 style="text-align: center; font-weight: bold;">Looking for Websites with Healthy Food Recipes?</h2>
      <p  style="text-align: center; font-weight: bold;">Check out these websites for delicious and nutritious recipes:</p>



  
  <div class="websites">
        <div class="website">
          <h2><a href="https://www.allrecipes.com/"  class="website-link">Allrecipes</a></h2>
          <p>A website offering a variety of recipes for every occasion.</p>
          <div class="website-preview">
            <img src="../images/allrecipies.jpg" alt="Allrecipes Preview">
          </div>
        </div>

        <div class="website">
          <h2><a href="https://www.foodnetwork.com/"  class="website-link">Food Network</a></h2>
          <p>Discover thousands of recipes from top chefs, shows, and experts.</p>
          <div class="website-preview">
            <img src="../images/food1.jpg" alt="Food Network Preview">
          </div>
        </div>

        <div class="website">
          <h2><a href="https://minimalistbaker.com/"  class="website-link">Minimalist Baker</a></h2>
          <p>Simplify your cooking routine with delicious, plant-based recipes.</p>
          <div class="website-preview">
            <img src="../images/minamalist.jpg" alt="Minimalist Baker Preview">
          </div>
        </div>

        <div class="website">
          <h2><a href="https://www.skinnytaste.com/"  class="website-link">Skinnytaste</a></h2>
          <p>Get inspired with healthy recipes that are low in calories but full of flavor.</p>
          <div class="website-preview">
            <img src="../images/food2.jpg" alt="Skinnytaste Preview">
          </div>
        </div>


        
        <div class="website">
          <h2><a href="https://www.tasteofhome.com/" class="website-link">Taste of Home</a></h2>
          <p>Get cooking inspiration and recipes from home cooks like you at Taste of Home.</p>
          <div class="website-preview">
            <img src="../images/food3.jpg" alt="Taste of Home Preview">
          </div>
        </div>


   
    </div>
  </div>



</body>
</html>

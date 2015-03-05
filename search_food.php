<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <title>Wine Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="jumbotron">
      <h1>Wine Database</h1>
      <p>Many things to know about wine.</p> 
    </div>
    <nav class="navbar navbar-inverse">
        <div>
          <ul class="nav navbar-nav">
            <li class=><a href="wine_main.php">Main</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="wine_add.php">Add</a></li> 
            <li><a href="#">Change/Delete</a></li> 
          </ul>
        </div>
      </nav>
    <div class="row">
      <div class="col-sm-2">
        <?php
          include 'grape_list_menu.php'
        ?>
      </div>
      <div class = "col-sm-10">


        <?php

        // *********************************** grape / origin **************************************************
          if (!($stmt = $mysqli->prepare("SELECT grape.grape_name, food.food_item FROM food 
			INNER JOIN grape_food
			ON food.id=grape_food.food_id
			INNER JOIN grape
			ON grape_food.grape_id=grape.id
			WHERE food.food_item LIKE ?
			ORDER BY grape.grape_name ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $food = $_GET['food'];
          $food = '%' . $food . '%';
          if (!$stmt->bind_param("s", $food)) {
            echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $wine_grape = NULL;
          $food_item = NULL;

          if (!$stmt->bind_result($wine_grape, $food_item)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          // $stmt->fetch();
          // echo '<h4>' . $grape_name . ' Information:</h4>';
          


          while ($stmt->fetch()) {
            echo '<p>Wine:' . $wine_grape . '</p>';
            echo '<p>Food:' . $food_item . '</p>';
           } 

           

        ?>
      </div>
    </div>
  </div>
</body>
</html>

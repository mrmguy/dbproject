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
    <div class="row">
      <div class="col-sm-2">
        <p>test</p>
      </div>
      <div class = "col-sm-10">


        <?php

          if (!($stmt = $mysqli->prepare("SELECT grape.grape_name, food.food_item FROM `grape` INNER JOIN grape_food ON grape.id=grape_food.grape_id
        INNER JOIN food ON grape_food.food_id=food.id WHERE grape.grape_name = ?"))) {
          	echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $grape_name = NULL;
          $food_item = NULL;

          $grape = $_GET['wine_type'];
          if (!$stmt->bind_param("s", $grape)) {
          	echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
          	echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->bind_result($grape_name, $food_item)) {
          	echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          echo '<p>' . $grape . ' goes with:</p>';
          while ($stmt->fetch()) {
           	//echo '<p>' . $grape_name . '</p>';
           	echo '<p>' . $food_item . '</p>';
           } 

        ?>
      </div>
    </div>
  </div>
</body>
</html>

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
          if (!($stmt = $mysqli->prepare("SELECT grape.grape_name, region.region, region.climate, region.production, region.origin_date FROM `grape` 
            INNER JOIN region ON grape.id=region.grape_id WHERE grape.id = ?"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $grape = $_GET['grape_id'];
          if (!$stmt->bind_param("i", $grape)) {
            echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $region = NULL;
          $climate = NULL;
          $production = NULL;
          $origin_date = NULL;

          if (!$stmt->bind_result($grape_name, $region, $climate, $production, $origin_date)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $stmt->fetch();
          echo '<h4>' . $grape_name . ' Information:</h4>';
          echo '<p>Region: ' . $region . '</p>';
          echo '<p>Climate: ' . $climate . '</p>';
          echo '<p>Production: ' . $production . '</p>';
          echo '<p>Origin Date:' . $origin_date . '</p>';


          while ($stmt->fetch()) {
            //echo '<p>' . $grape_name . '</p>';
            echo '<p>Region: ' . $region . '</p>';
            echo '<p>Climate: ' . $climate . '</p>';
            echo '<p>Production: ' . $production . '</p>';
            echo '<p>Origin Date:' . $origin_date . '</p>';
           } 

           // ******************************* grape / flavor ***************************************************
           if (!($stmt = $mysqli->prepare("SELECT grape.grape_name, flavors.flavor, flavors.description FROM `grape` INNER JOIN grape_flavor 
            ON grape.id=grape_flavor.grape_id INNER JOIN flavors ON grape_flavor.flavor_id=flavors.id WHERE grape.id = ?"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          
          $grape = $_GET['grape_id'];
          if (!$stmt->bind_param("s", $grape)) {
            echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $flavor = NULL;
          $description = NULL;

          if (!$stmt->bind_result($grape_name, $flavor, $description)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $stmt->fetch();
          echo '<h4>' . $grape_name . ' Flavors:</h4>';
          echo '<p>' . $flavor . ' - '. $description . '</p>';
          while ($stmt->fetch()) {
            //echo '<p>' . $grape_name . '</p>';
            echo '<p>' . $flavor . '</p>';
           } 



        // ********************************** grape / food **********************************************
          if (!($stmt = $mysqli->prepare("SELECT grape.grape_name, food.food_item FROM `grape` INNER JOIN grape_food ON grape.id=grape_food.grape_id
        INNER JOIN food ON grape_food.food_id=food.id WHERE grape.id = ?"))) {
          	echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          
          $grape = $_GET['grape_id'];
          if (!$stmt->bind_param("s", $grape)) {
          	echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
          	echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $food_item = NULL;

          if (!$stmt->bind_result($grape_name, $food_item)) {
          	echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $stmt->fetch();
          echo '<h4>' . $grape_name . ' goes with:</h4>';
          echo '<p>' . $food_item . '</p>';
          while ($stmt->fetch()) {
           	//echo '<p>' . $grape_name . '</p>';
           	echo '<p>' . $food_item . '</p>';
           } 


           // ********************************** genetic - listing descendents ************************************************

            if (!($stmt = $mysqli->prepare("SELECT grape.grape_name FROM grape 
              INNER JOIN genetic ON
              grape.id = genetic.child_id
              WHERE genetic.parent_id = ?;"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          
          $grape = $_GET['grape_id'];
          if (!$stmt->bind_param("s", $grape)) {
            echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;

          if (!$stmt->bind_result($grape_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $stmt->fetch();
          echo '<h4>Desendent Grapes:</h4>';
          echo '<p>' . $grape_name . '</p>';
          while ($stmt->fetch()) {
            //echo '<p>' . $grape_name . '</p>';
            echo '<p>' . $grape_name . '</p>';
           } 

           // ********************************** genetic - listing ancestors ************************************************

            if (!($stmt = $mysqli->prepare("SELECT grape.grape_name FROM grape 
              INNER JOIN genetic ON
              grape.id = genetic.parent_id
              WHERE genetic.child_id = ?;"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          
          $grape = $_GET['grape_id'];
          if (!$stmt->bind_param("s", $grape)) {
            echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;

          if (!$stmt->bind_result($grape_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $stmt->fetch();
          echo '<h4>Ancestor Grapes:</h4>';
          echo '<p>' . $grape_name . '</p>';
          while ($stmt->fetch()) {
            //echo '<p>' . $grape_name . '</p>';
            echo '<p>' . $grape_name . '</p>';
           } 

        ?>
      </div>
    </div>
  </div>
</body>
</html>

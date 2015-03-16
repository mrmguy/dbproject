<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

// *********************************** search food **************************************************
  if (!($stmt = $mysqli->prepare("DELETE FROM grape_food WHERE grape_id = ? AND food_id = ?"))) {
    echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  $grape = $_GET['grape'];
  //$food_delete = $_GET['food_delete'];
  $food=NULL;
  //echo $food_delete;
  //$food = $_GET['']
  if (!$stmt->bind_param("ii", $grape, $food)) {
    echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  foreach ($_GET['food_delete'] as $food) {
    if (!$stmt->execute()) {
      echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
    }
  }
  header('Location: wine_delete.php')
?>
<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  if (!($stmt = $mysqli->prepare("INSERT INTO grape_food (grape_id, food_id) VALUES (?, ?)"))) {
    echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }

  $grape_id = $_GET['grape_type'];
  $food_id = $_GET['food_type'];

  
  if (!$stmt->bind_param("ii", $grape_id, $food_id)) {
    echo "Binding parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  if (!$stmt->execute()) {
    echo "Binding parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  $mysqli->close();
  header('Location: wine_add.php')
?>
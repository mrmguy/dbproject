<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  if (!($stmt = $mysqli->prepare("INSERT INTO region (region, climate, production, origin_date, grape_id) VALUES (?, ?, ?, ?, ?)"))) {
    echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  $region = $_GET['region'];
  $climate = $_GET['climate'];
  $production = $_GET['production'];
  $origin_date = $_GET['origin_date'];
  $grape_type = $_GET['grape_type'];
  echo $region, $climate, $production, $origin_date, $grape_type;
  
  if (!$stmt->bind_param("ssiii", $region, $climate, $production, $origin_date, $grape_type)) {
    echo "Binding parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  if (!$stmt->execute()) {
    echo "Binding parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  $mysqli->close();
  header('Location: wine_add.php')
?>
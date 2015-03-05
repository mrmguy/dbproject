<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  if (!($stmt = $mysqli->prepare("INSERT INTO flavors (flavor, description) VALUES (?, ?)"))) {
    echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }

  $flavor = $_GET['flavor'];
  $description = $_GET['description'];
  
  if (!$stmt->bind_param("ss", $flavor, $description)) {
    echo "Binding parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  if (!$stmt->execute()) {
    echo "Binding parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  $mysqli->close();
  header('Location: wine_add.php')
?>
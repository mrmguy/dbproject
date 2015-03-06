<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
       
  if (!($stmt = $mysqli->prepare("UPDATE flavors SET description = ? WHERE id = ?"))) {
    echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }

  $id = $_GET['flavor_id'];
  $description = $_GET['new_description'];

  if (!$stmt->bind_param("si", $description, $id)) {
    echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
  }
        
  $mysqli->close();
  header('Location: flavor_list.php')
?>

<?php
  error_reporting(E_ALL);
  ini_set('display-errors', 'On');
  require 'dbentry.php'; //contains db variable informatoin
  $mysqli = new mysqli($site, $user, $pw, $db); //connect to database
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  if (!($stmt = $mysqli->prepare("SELECT id, grape_name FROM grape ORDER BY grape_name ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $grape_id = NULL;
          if (!$stmt->bind_result($grape_id, $grape_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          echo '<form action= "grape_list.php">';
          echo '<ul class="list-group">';
          echo '<h4 class = "list-group-item-heading">Menu</h4>';
          while ($stmt->fetch()) {
          	echo '<button name = "grape_id" type = "submit" value =' . $grape_id . '>' . $grape_name . '</button></br>';
            // echo '<input type = "submit" Value=' . $grape_name . ' class="btn btn-default"></br>';
            // echo '<input type = "hidden" Name = "grape_id" value ='. $grape_id . '>';
          }
          
         echo '</ul>';
         echo '</form>';
//$mysqli->close();
?>
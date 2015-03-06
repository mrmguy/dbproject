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
  <link rel="stylesheet" type="text/css" href="custom.css">
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
            <li><a href="wine_main.php">Main</a></li>
            <li><a href="wine_search.php">Search</a></li>
            <li><a href="wine_add.php">Add</a></li>
             <li><a href="wine_update.php">Update</a></li>
            <li><a href="wine_delete.php">Delete</a></li>
          </ul>
        </div>
      </nav>


    <div class="row">
      <div class="col-sm-2">
        <?php
          include 'grape_list_menu.php'
        ?>
      </div>

      <div class="col-sm-10">
        <h2>Change Flavor Description</h2>
        <p>Select the description you would like to change.</p>
        <hr>
        <?php

        

           // ******************************* grape / flavor ***************************************************
           if (!($stmt = $mysqli->prepare("SELECT flavor, description FROM flavors WHERE id = ?"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $id = $_GET['flavor_id'];
          
          if (!$stmt->bind_param("s", $id)) {
            echo "Binding Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $flavor = NULL;
          $description = NULL;

          if (!$stmt->bind_result($flavor, $description)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          echo '<h3>Flavor / Description</h3>';
          
          while ($stmt->fetch()) {
            echo '<h4>' . $flavor . '</h4>';
            echo '<p>' . $description . '</p>';
           } 
           echo '<form action = "wine_update3.php" method= "get">';
           echo '<textarea name ="new_description" rows = "5" cols = "60">'. $description;
           echo '</textarea></br>';
           echo '<input type = "hidden" name = "flavor_id" value =' . $id . '>';
           echo '<input type = "submit" value = "Update">';
           echo '</form>';

        ?>
        <hr>
  
      </div>
    </div>
  </div>
<?php
  $mysqli->close();
?>
</body>
</html>
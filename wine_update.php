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
           if (!($stmt = $mysqli->prepare("SELECT id, flavor, description FROM flavors ORDER BY flavor ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $flavor = NULL;
          $description = NULL;
          $id = NULL;

          if (!$stmt->bind_result($id, $flavor, $description)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          echo '<h3>Flavor / Description</h3>';
          echo '<form action = "wine_update2.php" method= "get">';
          $stmt->fetch();
          while ($stmt->fetch()) {
            echo '<h4>' . $flavor . '</h4>';
            echo '<p>' . $description . '</p>';
            echo '<button name = "flavor_id" type = "submit" value =' . $id . '>Change</button></br>';
           } 
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
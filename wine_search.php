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
      <h1>Wine Database</a></h1>
      <p>Many things to know about wine.</p> 
    </div>
    <nav class="navbar navbar-inverse">
        <div>
          <ul class="nav navbar-nav">
            <li><a href="wine_main.php">Main</a></li>
            <li class = "active"><a href="#">Search</a></li>
            <li><a href="wine_add.php">Add</a></li>
            <li><a href="wine_update.php">Update</a></li>
            <li><a href="wine_delete.php">Delete</a></li>
          </ul>
        </div>
      </nav>
    <div class="row">
      <div class="col-sm-2">
        <?php
          include 'grape_list_menu.php';
        ?>
      </div>
      <div class = "col-sm-10">
        <h2>Search for a Food or Flavor</h2>
        <p>Here you can search for a particular food or flavor and find what wine it relates to.</p><hr>
        <p>Find a wine to pair with a food.</p>
        <form role="form" action = "search_food.php" method = "get">
          <div class="form-group">
            <label>Food:</label>
            <input type="text" name="food">
          </div>
          <button type="submit" class="btn btn-default">Search Food</button>
        </form>
        </br><hr>
        <p>Find a wine that has a certain flavor.</p>
        <form role="form" action = "search_flavor.php" method = "get">
          <div class="form-group">
            <label>Flavor:</label>
            <input type="text" name="flavor">
          </div>
          <button type="submit" class="btn btn-default">Search Flavor</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

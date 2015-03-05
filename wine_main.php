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
            <li class="active"><a href="#">Main</a></li>
            <li><a href="wine_search.php">Search</a></li>
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
        <!-- <ul class="list-group">
          <h4 class = "list-group-item-heading">Menu</h4>
          <li class="list-group-item active">Main</li>
          <li class="list-group-item">Search</li>
          <li class="list-group-item">Add</li>
          <li class="list-group-item">Change/Delete</li>
        </ul> -->
      </div>

      <div class="col-sm-10">
        <h2>How to use this site</h2>
        <hr>
        <p>This site provides information on wine grapes. The information includes food pairings, flavor charateristics, and information about different grapes</p>
        <p>There are several ways to use this site. If you would like to search for information such as what wine will go best with certain foods
        or what food will go best with certain wines, go to the search page.</p>
        <p>To enter additional grapes, foods, flavor charateristics or wine information or to associate wine, food, and flavors go to Add.</p>
        <p>Finally any item can be deleted or changed on the change/delete link.</p>
        
        



      </div>
    </div>
  </div>
<?php
  $mysqli->close();
?>
</body>
</html>
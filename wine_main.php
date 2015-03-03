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
      <h1>Wine Database</h1>
      <p>Many things to know about wine.</p> 
    </div>
      <nav class="navbar navbar-inverse">
        <div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Main</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">Add</a></li> 
            <li><a href="#">Delete</a></li> 
          </ul>
        </div>
      </nav>


    <div class="row">
      <div class="col-sm-2">
        <ul class="list-group">
          <h4 class = "list-group-item-heading">Menu</h4>
          <li class="list-group-item active">Main</li>
          <li class="list-group-item">Second item</li>
          <li class="list-group-item">Third item</li>
        </ul>
      </div>

      <div class="col-sm-10">
        <p>This site displays wine grape information.</p>
        <p>You can view, edit, and add information.</p>
        <p>Select a grape varietal or all grapes to display everything</p>
        <?php
          // ************************************* grape_list ****************************************
          if (!($stmt = $mysqli->prepare("SELECT grape_name FROM grape ORDER BY grape_name ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $wine_list = NULL;
          if (!$stmt->bind_result($wine_list)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          // ************************************** form to select grape to view **********************
          echo '<form action = "grape_list.php" method="get">';
          echo '<select name = "wine_type">';
          while ($stmt->fetch()) {
            echo '<option value = "' . $wine_list . '">' . $wine_list . '</option>';
          }
          if ($wine_list) {
            echo '<option value = "All">ALL Grapes</option>';
          }
          echo '<input type = "submit" class="btn btn-default">';
          echo '</form>';
        ?>
        <!-- ******************************************************* add_grape *************** -->
        <form role="form" action = "add_grape.php" method = "get">
          <div class="form-group">
            <label>Wine Grape:</label>
            <input type="text" name="grape">
          </div>
          <div class="form-group">
            <label>Color</label>
            <input type="text" name="color">
          </div>
          <button type="submit" class="btn btn-default">Add Grape</button>
        </form>



      </div>
    </div>
  </div>
<?php
  $mysqli->close();
?>
</body>
</html>
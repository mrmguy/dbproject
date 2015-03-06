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
            <li class = "active"><a href="#">Add</a></li>
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
        <h2>Add Items</h2>
        <p>You add items and associate items. If you want associate grape with a food or a flavor you first have to add the items.</p>
        <p>You can check whether a food or flavor has been added using the menu to the left. Also you check information on a particular grape
        by selecting the grape in the menu</p>
        <hr>
        <div class="row">
          <div class="col-sm-4">
            <h4>Add Grape</h4>
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
          <div class="col-sm-4">
            <h4>Add Food</h4>
            <!-- ******************************************************* add_food *************** -->
            <form role="form" action = "add_food.php" method = "get">
              <div class="form-group">
                <label>Food:</label>
                <input type="text" name="food">
              </div>
              <button type="submit" class="btn btn-default">Add Food</button>
            </form>
          </div>
          <div class="col-sm-4">
            <h4>Add Flavor</h4>
            <!-- ******************************************************* add_flaovr *************** -->
            <form role="form" action = "add_flavor.php" method = "get">
              <div class="form-group">
                <label>Flavor:</label>
                <input type="text" name="flavor">
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description">
              </div>
              <button type="submit" class="btn btn-default">Add Flavor</button>
            </form>
          </div>
        </div>
        <hr>

        <div class = "row">
          <div class = "col-sm-5">
            <h4>Add wine history information</h4>

        <?php
          // ************************************* ADD ORIGIN ***************************************
          echo '<form action = "add_origin.php" method="get">';
          // ************************************* grape_list 
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
          // ************************************** select box for grape
          
          echo '<select name = "grape_type">';
          while ($stmt->fetch()) {
            echo '<option value = "' . $grape_id . '">' . $grape_name . '</option>';
          }
          echo '</select></br>';
          echo 'Region <input type= "text" name="region"></br>';
          echo 'Climate <input type= "text" name ="climate"></br>';
          echo 'production <input type = "number" name="production"></br>';
          echo 'Origin Year: <input type = "number" name ="origin_date"></br>';
          echo '<input type = "submit" class="btn btn-default" value="Add Region" >';
          echo '</form>'
        ?>

          </div>
          <div class = "col-sm-5">
            <h2>Associate Items</h2>
        <p>Associate an item by selecting from the drop down list and clicking associate</p>
        <?php

          // ************************************* FORM: ASSOICATE Food ****************************************
          echo '<form action = "associate_food.php" method="get">';
          // ************************************* grape_list 
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
          // ************************************** select box for grape for food add 
          
          echo '<select name = "grape_type">';
          while ($stmt->fetch()) {
            echo '<option value = "' . $grape_id . '">' . $grape_name . '</option>';
          }
          echo '</select>';


          // ************************************ food list 
          if (!($stmt2 = $mysqli->prepare("SELECT id, food_item FROM food ORDER BY food_item ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          if (!$stmt2->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $food_id = NULL;
          $food_item = NULL;
          if (!$stmt2->bind_result($food_id, $food_item)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          // ************************************** select box for food 
          
          echo '<select name = "food_type">';
          while ($stmt2->fetch()) {
            echo '<option value = "' . $food_id . '">' . $food_item . '</option>';
          }
          echo '</select>';
          echo '<input type = "submit" class="btn btn-default" value="Associate Food" >';
          echo '</form>';



          //  ***************************************  Form: ASSOCIATE Flavor ******************************

          echo '<form action = "associate_flavor.php" method="get">';
          // if (!($stmt3 = $mysqli->prepare("SELECT id, grape_name FROM grape ORDER BY grape_name ASC"))) {
          //   echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          // }
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $grape_id = NULL;
          if (!$stmt->bind_result($grape_id, $grape_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }



          echo '<select name = "grape_type">';
          while ($stmt->fetch()) {
            echo '<option value = "' . $grape_id . '">' . $grape_name . '</option>';
          }
          echo '</select>';

          // **************************** flavor list 
          if (!($stmt4 = $mysqli->prepare("SELECT id, flavor FROM flavors ORDER BY flavor ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          if (!$stmt4->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $flavor_name = NULL;
          $flavor_id = NULL;
          if (!$stmt4->bind_result($flavor_id, $flavor_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          echo '<select name = "flavor_type">';
          while ($stmt4->fetch()) {
            echo '<option value = "' . $flavor_id . '">' . $flavor_name . '</option>';
          }
          echo '</select>';

          

          // if ($wine_list) {
          //   echo '<option value = "All">ALL Grapes</option>';
          // }
          echo '<input type = "submit" Value= "Associate Flavor" class="btn btn-default">';
          echo '</form>';

          echo '<p>Parent        Child</p>';

          // ************************************* Parent / Child ************************************************

          echo '<form action = "parent_child.php" method="get">';
          // if (!($stmt3 = $mysqli->prepare("SELECT id, grape_name FROM grape ORDER BY grape_name ASC"))) {
          //   echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          // }
          /// ********************** Parent
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $grape_id = NULL;
          if (!$stmt->bind_result($grape_id, $grape_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }

          echo '<select name = "parent_type">';
          while ($stmt->fetch()) {
            echo '<option value = "' . $grape_id . '">' . $grape_name . '</option>';
          }
          echo '</select>';

          // ************************* Child
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $grape_id = NULL;
          if (!$stmt->bind_result($grape_id, $grape_name)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          echo '<select name = "child_type">';
          while ($stmt->fetch()) {
            echo '<option value = "' . $grape_id . '">' . $grape_name . '</option>';
          }
          echo '</select>';
          echo '<input type = "submit" Value= "Create Relationship" class="btn btn-default">';
          echo '</form>';

        ?>

          </div>
          <div class = "col-sm-2"></div>

        </div>



        

        
      </div>
    </div>
  </div>
<?php
  $mysqli->close();
?>
</body>
</html>
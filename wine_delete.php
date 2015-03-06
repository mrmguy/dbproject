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
            <li class = "active"><a href="#">Delete</a></li>
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
        <h2>Delete a Wine / Food association</h2>
        <p>Below is a list of wines and foods that they pair with. To remove a food from being associated with a wine, check the food or
        foods you would like to unassociate with a particular wine and click Delete.</p>
        <p>The foods will remain in the database but no longer be assoicated with that wine.</p>
        <hr>
        <?php
        // ********************************** grape / food **********************************************
          if (!($stmt = $mysqli->prepare("SELECT grape.grape_name, food.food_item, grape_food.grape_id, grape_food.food_id FROM `grape` INNER JOIN grape_food ON grape.id=grape_food.grape_id
        INNER JOIN food ON grape_food.food_id=food.id ORDER BY grape.grape_name ASC"))) {
            echo "Prepare failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          if (!$stmt->execute()) {
            echo "Execute failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          $grape_name = NULL;
          $food_item = NULL;
          $grape_id = NULL;
          $food_id = NULL;

          if (!$stmt->bind_result($grape_name, $food_item, $grape_id, $food_id)) {
            echo "Binding Output Parameters failed: (" . $mysqli->erro . ") " . $mysqli->error;
          }
          
          $stmt->fetch();
          echo '<form action="delete_food.php" method="get"><table class = "table-bordered"><tr><td>';
          echo '<h4>' . $grape_name . '</h4></td><td><input type = "checkbox" name="food_delete[]" value=' . $food_id . '>' . $food_item . '</br>';
          $grape_name_holder=$grape_name;
          $grape_id_holder=$grape_id;
          while ($stmt->fetch()) {
            if ($grape_name_holder != $grape_name) {
              echo '</td><td><button name="grape" type="submit" value='. $grape_id_holder . '>Delete</button></td></tr>
              <tr><td><h4>' . $grape_name . '</h4></td><td>';
            }
            
            echo '<input type = "checkbox" name="food_delete[]" value=' . $food_id . '>' . $food_item . '</br>';
            $grape_name_holder=$grape_name;
            $grape_id_holder=$grape_id;
           } 

           echo '<td><button name="grape" type="submit" value='. $grape_id_holder . '>Delete</button></td></tr></table></form>';
           
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
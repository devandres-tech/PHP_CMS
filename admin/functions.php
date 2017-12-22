
<?php

  function confirm_query($result) {

    global $connection; 

    if(!$result) {
      die("QUERY FAILED" . mysqli_error($connection));
    }

  } // end confirm_query function




  function insert_categories() {

    global $connection;

    //getting the post superglobal from the form
      if(isset($_POST["submit"])) {
        //grab user input from add categories
        $cat_title = $_POST["cat_title"];
        //catch error when field is left empty
        if($cat_title == "" || empty($cat_title)) {
          echo "This field should not be empty!";
        } else {
          //if everything is good sumbit data into our table(mysql)
          $query = "INSERT INTO categories(cat_title) ";
          $query .= "VALUE('{$cat_title}') ";

          //send it
          $create_category_query = mysqli_query($connection, $query);
            //error handling
            if(!$create_category_query) { //if the query is not true
              //kill all processes if query failed
              die("Query Failed" . mysqli_error($connection));
            }
        }
      }
  } // end insert_categories function


  function find_all_categories() {
    global $connection;

    //select all the data from the categories table
      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection, $query);

      //to display all the values we use a while while loop
      while($row = mysqli_fetch_assoc($select_categories)) {
      //finding the name of the rows and displaying them
      $cat_id = $row["cat_id"];
      $cat_title = $row["cat_title"];

      //displaying them on the page
      echo "<tr>";
      echo "<td>{$cat_id}</td>";
      echo "<td>{$cat_title}</td>";
      //we create a link and get the id
      echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
      echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
      echo "</tr>";
    }

  }// end find_all_categories function


  function delete_categories() {

    global $connection;

    //we catch the id, Delete Query
     if(isset($_GET['delete'])) {
       $catch_cat_id = $_GET['delete'];
       $query = "DELETE FROM categories WHERE cat_id = {$catch_cat_id} ";
       //deletes the data from the database
       $deleteQuery = mysqli_query($connection, $query);
       //we then refresh the page to delete data instantly
       header("Location: categories.php"); //this basically refreshes the page
     }
  }// end delete_categories function







?>
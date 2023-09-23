<?php 

require_once "./_includes/db_connect.php";


$statement = mysqli_prepare($link, "SELECT id, username, admin FROM users");

//execute the query statement
  mysqli_stmt_execute($statement);

//get the result
  $result = mysqli_stmt_get_result($statement);

//loop through the row and give back the result as a json format
  
  while($row = mysqli_fetch_assoc($result)){

    $results[] = $row;
  }

  echo json_encode($results);

  mysqli_close($link);




?>
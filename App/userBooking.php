<?php 
session_start();
//require db connection from db_connect
require_once "./_includes/db_connect.php";

$userId = $_SESSION["userId"];
$username = $_SESSION["username"];

$query =  "SELECT DISTINCT users.username, audiences.ticket_id, audiences.adult, audiences.kids_under_4, audiences.kids_4_to_18, audiences.senior_over60, audiences.date FROM users, audiences, bookingLists WHERE bookingLists.ticket_id = audiences.ticket_id AND bookingLists.userId = '$userId' AND users.username = '$username'";
$statement = mysqli_prepare($link, $query);

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
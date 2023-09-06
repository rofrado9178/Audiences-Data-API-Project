<?php 

//require db connection from db_connect
require_once "./_includes/db_connect.php";

//(`ticket_id`, `adult`, `kids_under_4`, `kids_4_to_18`, `senior_over60`, `date`)


if(isset($_REQUEST["date"])){
  $selectedDate = $_REQUEST["date"];

  //statement to display only total of each audience to that day.
  // $statement = mysqli_prepare($link, "SELECT ticket_id, SUM(adult), SUM(kids_under_4), SUM(kids_4_to_18), SUM(senior_over60) FROM audiences WHERE date='$selectedDate'");

  //statement to display all data
  // $statement = mysqli_prepare($link, "SELECT ticket_id, adult, kids_under_4, kids_4_to_18, senior_over60, date FROM audiences WHERE date='$selectedDate'");
  // echo $selectedDate;

$statement = mysqli_prepare($link, "SELECT * FROM audiences ORDER BY date DESC");

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

  

}












?>
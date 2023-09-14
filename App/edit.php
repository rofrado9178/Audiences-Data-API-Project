
<?php 

//require db connection from db_connect
require_once "./_includes/db_connect.php";

if(isset($_REQUEST["ticket_id"])){
  // echo $selectedDate;
  $ticketId = trim(strip_tags($_REQUEST["ticket_id"]));

  $statement = mysqli_prepare($link, "SELECT * FROM audiences WHERE ticket_id = $ticketId");

//execute the query statement
  mysqli_stmt_execute($statement);

//get the result
  $result = mysqli_stmt_get_result($statement);

//loop through the row and give back the result as a json format

  while($row = mysqli_fetch_assoc($result)){
    $results[] = $row;
  }

  //add the result into variable;
  echo json_encode($results);
  mysqli_close($link);

}

?>
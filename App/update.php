<?php 
//require db connection from db_connect
require_once "./_includes/db_connect.php";

function returnUpdateData($link , $id){

  $statement = mysqli_prepare($link, "SELECT * FROM audiences WHERE ticket_id = $id");

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

function updateData($link){
  // $query = "UPDATE demo SET tvshow = ? WHERE demoID = ?";
  $query = "UPDATE audiences SET ticket_id = ?,adult = ?,kids_under_4 = ? ,kids_4_to_18 = ?,senior_over60 = ?,date = ? WHERE ticket_id = ?";
  $ticketId = trim(strip_tags($_REQUEST["ticket_id"]));
  if($statement = mysqli_prepare($link, $query)){
      mysqli_stmt_bind_param($statement,"sssssss",$_REQUEST["ticket_id"], $_REQUEST["adult"],$_REQUEST["kids0to4"],$_REQUEST["kids4to18"], $_REQUEST["senior"],$_REQUEST["date"], $_REQUEST["ticket_id"]);

    // mysqli_stmt_bind_param($stmt, "ss", $_REQUEST["tvshow"], $_REQUEST["demoID"]);
    mysqli_stmt_execute($statement);

    $insertData = mysqli_stmt_affected_rows($statement);
    if ( $insertData <= 0) {
      throw new Exception("Error updating data: " . mysqli_stmt_error($statement));
    }
    $message = "Update Success";
    // return mysqli_stmt_affected_rows($statement);
    $results = returnUpdateData($link, $ticketId);
    return $results;
  }

}
//main logic of the application is in this try{} block of code.
try{
  //see if user has entered data **removed full_name & email
  if(!isset($_REQUEST["adult"]) || !isset($_REQUEST["kids0to4"]) || !isset($_REQUEST["kids4to18"]) || !isset($_REQUEST["senior"])){
    throw new Exception('Required data is missing data');
  }else{
    //might as well just go ahead and update
    $results = updateData($link);

  }
}catch(Exception $error){
  //add to results array rather than echoing out errors
  $results[] = ["error"=>$error->getMessage()];
}

?>
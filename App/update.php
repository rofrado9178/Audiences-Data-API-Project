<?php 
//require db connection from db_connect
require_once "./_includes/db_connect.php";

function updateData($link){
  // $query = "UPDATE demo SET tvshow = ? WHERE demoID = ?";
  $query = "UPDATE audiences SET ticket_id = ?,adult = ?,kids_under_4 = ? ,kids_4_to_18 = ?,senior_over60 = ?,date = ? WHERE ticket_id = ?";

  if($statement = mysqli_prepare($link, $query)){
      mysqli_stmt_bind_param($statement,"sssssss",$_REQUEST["ticket_id"], $_REQUEST["adult"],$_REQUEST["kids0to4"],$_REQUEST["kids4to18"], $_REQUEST["senior"],$_REQUEST["date"], $_REQUEST["ticket_id"]);

    // mysqli_stmt_bind_param($stmt, "ss", $_REQUEST["tvshow"], $_REQUEST["demoID"]);
    mysqli_stmt_execute($statement);
    
    if (mysqli_stmt_affected_rows($statement) <= 0) {
      throw new Exception("Error updating data: " . mysqli_stmt_error($statement));
    }
    $results[] = ["updatedData() affected_rows man" => mysqli_stmt_affected_rows($statement)];
    return mysqli_stmt_affected_rows($statement);
  }
}
//main logic of the application is in this try{} block of code.
try{
  //see if user has entered data **removed full_name & email
  if(!isset($_REQUEST["adult"]) || !isset($_REQUEST["kids0to4"]) || !isset($_REQUEST["kids4to18"]) || !isset($_REQUEST["senior"])){
    throw new Exception('Required data is missing data');
  }else{
    //might as well just go ahead and update
    $newResults[] = ["updateData() affected_rows " => updateData($link)];
  }
}catch(Exception $error){
  //add to results array rather than echoing out errors
  $newResults[] = ["error"=>$error->getMessage()];
}finally{
  //echo out results
  echo json_encode($newResults);
}

?>
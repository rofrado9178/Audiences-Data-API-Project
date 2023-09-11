

<?php 

require_once "./_includes/db_connect.php";

//insert query INSERT INTO `audiences`(`ticket_id`, `adult`, `kids_under_4`, `kids_4_to_18`, `senior_over60`, `date`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')


$query = "INSERT INTO audiences(adult, kids_under_4, kids_4_to_18, senior_over60, date) VALUES (?, ?, ?, ?, ?)";

$insertData = 0;
$results = [];
// $ticket_id = null;
// $adult = $_REQUEST["adult"];
// $kidsUnder4 = $_REQUEST["kids0to4"];
// $kids4to18 = $_REQUEST["kids4to18"];
// $senior = $_REQUEST["senior"];
// $addDate = $_REQUEST["date"];


if($statement = mysqli_prepare($link, $query)){
  mysqli_stmt_bind_param($statement,"sssss", $_REQUEST["adult"],$_REQUEST["kids0to4"],$_REQUEST["kids4to18"], $_REQUEST["senior"],$_REQUEST["date"]);

  mysqli_stmt_execute($statement);

  $insertData = mysqli_stmt_affected_rows($statement);

  if($insertData > 0){
    echo  json_encode("Your Ticket Has Been Booked");
  }
  else{
    throw new Exception("Failed to book the ticket");
  }

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Audicence Page</title>
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>
    <h1>welcome to admin panel</h1>
    <section>
      <h2>insert audience info</h2>
      <form id="form-submit" action="form.php" method="POST">
        <label for="date">insert date</label>
        <input type="date" name="date" />

        <label for="">Adult</label>
        <input type="number" name="adult" />

        <label for="">Kids Between 0 to 4</label>
        <input type="number" name="kids0to4" />

        <label for="">Kids Between 4 to 18</label>
        <input type="number" name="kids4to18" />

        <label for="">Senior over 60</label>
        <input type="number" name="senior" />

        <input type="submit" value="Submit" />
      </form>
    </section>
  </body>
</html>

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
    // $results[] = [
    //   "InsertData" => $insertData,
    //   "TicketId" => $link->insert_id, 
    //   "Date" => $addDate,
    //   "Adult" => $adult,
    //   "Kids Under 4" => $kidsUnder4,
    //   "Kids 4 to 18" => $kids4to18,
    //   "Senior" => $senior
    // ];

    $_REQUEST = array();

    echo '<script src="js/main.js">',
       'addSuccess();',
       '</script>';
  }

}

?>
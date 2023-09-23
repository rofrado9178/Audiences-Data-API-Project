<?php 

require_once "./_includes/db_connect.php";




if(isset($_REQUEST["username"]) && isset($_REQUEST["password_1"]) && isset($_REQUEST["password_2"])){
  $query = "INSERT INTO users(username, password) VALUES (?, ?)";

  $insertData = 0;
  $results = [];

  $password1 = $_REQUEST["password_1"];
  $password2 = $_REQUEST["password_2"];
  if($password1 != $password2){
    $results = [
      "error" => "Password does not match"
    ];
    echo json_encode($results);
    return;
  }
  $encryptedPassword = password_hash($password1, PASSWORD_DEFAULT);

  if($statement = mysqli_prepare($link, $query)){
    mysqli_stmt_bind_param($statement,"ss", $_REQUEST["username"], $encryptedPassword);
  
    mysqli_stmt_execute($statement);
  
    $insertData = mysqli_stmt_affected_rows($statement);
  
    if($insertData > 0){
      $results = [
        "Success" => "Registration Succesful"
      ];
      echo  json_encode($results);
    }
    else{
      throw new Exception("Failed to register");
    }
  
  }
}







?>
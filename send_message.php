<?php

include("config.php");

//validate the input data

if($_SERVER["REQUEST_METHOD"] === "GET"){
  $err = true;
}else{

  //validate the name
  if(empty($_POST["nume"])){
    $errNume = "Name is necessary";
    $err = true;
  }elseif(strlen($_POST["nume"]) < 3){
    $errNume = "Invalid name";
    $err = true;
  }else{
    $err = false;
    $name = trim($_POST["nume"]);
    $name = htmlspecialchars($name);
  }

//validate the number of persons
  if(empty($_POST["number_people"])){
    $errNumber = "Insert the numbers of persons";
    $err = true;
  }elseif(is_numeric($_POST["number_people"])) { //check if it is a number
    $err = false;
    $nr = trim($_POST["number_people"]);
    $nr = htmlspecialchars($nr);
  }else{
    $errNumber = "Insert a number";
    $err = true;
  }

//validate the date of the reservation
  if(!isset($_POST["reserve"])){
    $errReserve = "Select a date";
    $err = true;
  }elseif (!in_array(substr($_POST["reserve"],11,2), $ore)) {//check to be in the working hours
    $err = true;
    error_log("Not in the working hours", 3, "my-errors.log");
    die("Not in the working hours");
    echo $errReserve;
  }elseif (substr($_POST["reserve"],5,5) < date("m-d")) { //check not to be on a previous date
    $err = true;
    die("Not valid day. Day in the past");
  } else {
    $err = false;
    $data = trim($_POST["reserve"]);
  }

  if(empty($_POST["message"])){
    $errMessage = "Introdu mesajul";
    $err = true;
  }else{
    $err = false;
    $message = trim($_POST["message"]);
    $message = htmlspecialchars($message);
  }
}

if($err === false){
  $filename = 'test.xlsx';
  if(file_exists($filename)){ //check if file exists
    unset($_POST);
    $_POST = array();
    $user = new Rezervare($name, $nr, $data);
    echo json_encode($user, JSON_PRETTY_PRINT);
    $user->update(); //if exists update and populate
    $user->populate();
    //header("Location: index.php");
  }else{
    unset($_POST);
    $user = new Rezervare($name, $nr, $data);
    $user->create(); //if not exists create new file
    $user->populate();
    exit();
  }
}else{
  die();
}

?>

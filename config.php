<?php

require_once("Classes/PHPExcel.php");
require_once("Classes/PHPExcel/IOFactory.php");
error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', 'my-errors.log'); // Logging file path
$ore = array("06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16"); //working hours

class Rezervare{
  protected $nume;
  protected $nr;
  protected $data;
  protected $mesaj;
  protected $regex;
  protected $matches;
  protected $max_number;
  protected $total_number;

  function __construct($n, $nb, $d){
    $this->nume = $n;
    $this->nr = $nb;
    $this->data = $d;
    $this->hours = array("","time", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00");
    $this->columns = array('B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1');
    $this->zi = date("m-d"); //extract today date
    $this->regex = '/\d/';
    $this->matches = array();
    $this->max_number = 12;
    $this->total_number = 0;


    $this->excel = new PHPExcel();
  }

  //create the excel file
    function create(){

      //populate with the opening hours interval 06-16
      foreach($this->hours as $this->key=>$this->value){
        $this->excel->setActiveSheetIndex(0)
          ->setCellValue("A{$this->key}", $this->value);
        }

      //populate with the dates for one week starting from today
      $i = 0;
        foreach($this->columns as $this->date){
          $calendar = date("m-d", strtotime("+$i day"));
          $this->excel->setActiveSheetIndex(0)
            ->setCellValue($this->date, $calendar);
            $i++;
        }

      $file = PHPExcel_IOFactory::createWriter($this->excel, "Excel2007");
      $file->save('test.xlsx');

      return $this->excel;
    }


//update the file with the current date and eliminate the previous ones
    function update(){

      $phpExcel = PHPExcel_IOFactory::load("test.xlsx"); //load the existing file

      $day = $this->zi;
      foreach($this->columns as $zi){
  		  $value = $phpExcel->getActiveSheet()->getCell($zi)->getValue();
  		  if($day > $value){
    			$z = substr($zi,0,1);

          for($i=2; $i<13;$i++){
    				$cell = $z.$i;
    				$cell_value = $phpExcel->getActiveSheet()->getCell($cell)->getValue();

    				if($cell_value !== null){
    					$phpExcel->setActiveSheetIndex(0)
    					->setCellValue($cell, null);
    				}
    			}

    			$phpExcel->getActiveSheet()->removeColumn($z);
  		  }
	  }

      //populate the remanins cells with the next days
      $i = 0;
      foreach($this->columns as $this->date){
        $calendar = date("m-d", strtotime("+$i day"));
        $phpExcel->setActiveSheetIndex(0)
          ->setCellValue($this->date, $calendar);
          $i++;
      }

     if($this->readyToRead(__FILE__)){
        $file = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
        $file->save('test.xlsx');
      }else{
        $message = "Failed to send the message! Check again later!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        error_log("File is open, unable to update!", 3, "my-errors.log");
        die();
      }
    }

//add new reservations in the excel according to the day and hour
  function populate(){

    $phpExcel = PHPExcel_IOFactory::load("test.xlsx");

    $reserved_day = substr($this->data, 5, 5); //set the day for reservation
    $reserved_hour = substr($this->data,11,2); //set the hour for reservation

    //check the available hours
    foreach($this->hours as $cell_number => $value){ //extract the cell number
      $working_hours = substr($value,0,2); // extract only the hour without the minutes
      if($reserved_hour == $working_hours){ //check if the requested hour is in the working hours,
        //and extract the key=cell number, the row number
        $row =  $cell_number;
        settype($row, "string");
       }
     }

     //check the date
     foreach($this->columns as $zi){
      $value =  $phpExcel->getActiveSheet()->getCell($zi)->getValue(); //get the value of the working days
      if($reserved_day == $value){ //if work day is the same with the selected day
         $cell = substr($zi,0,1); //get the column id
         $cell .= $row; //create the cell number, concat the row with column,
         //to fill the apropiate day and hour selected


         //check if the cell is empty
         $cell_value = $phpExcel->getActiveSheet()->getCell($cell)->getValue();
         if(empty($cell_value)){ //if cell is empty, add the name and number of persons
           $phpExcel->setActiveSheetIndex(0)
             ->setCellValue($cell, "{$this->nume}, {$this->nr}\n");
             $message = "Message received! Thank you!";
             echo "<script type='text/javascript'>alert('$message');</script>";
         }else{

           //check the total available numbers
           preg_match_all($this->regex, $cell_value, $this->matches, PREG_PATTERN_ORDER);
           foreach($this->matches[0] as $val){
             $this->total_number += $val; //sum all the previous reservations numbers of people
           }

           $this->total_number += $this->nr;

           if($this->total_number < $this->max_number){ //check the current sum number
             //with the max available number

             //add the name and number in the proper cell
             $phpExcel->setActiveSheetIndex(0)
               ->setCellValue($cell, "$cell_value {$this->nume}, {$this->nr}");
             //reservation completed
             $message = "Message received! Thank you!";
             echo "<script type='text/javascript'>alert('$message');</script>";
           }else{
             //error, not any available tables
             $message = "Maximum number of 12 people, reached for this hour! Please check another hour!";
            echo "<script type='text/javascript'>alert('$message');</script>";
           }
         }
       }
     }

     if($this->readyToRead(__FILE__)){
       $file = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
       $file->save('test.xlsx');
     }else{
       $message = "Failed to send the message! Check again later!";
       echo "<script type='text/javascript'>alert('$message');</script>";
       error_log("File is open, unable to update!", 3, "my-errors.log");
       die();
     }
  }

  //check if the file is open
  function readyToRead($file){
    return ((time() - filemtime($file)) > 5) ? true : false;
  }


}

?>

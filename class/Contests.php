<?php
/**
 * Class: Contest
 * This is for all Contest functions
 */
 
class Contest
{
  //user for connection
  protected $conn; 

  //Contest's Variable:
  
   // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

}
 ?>
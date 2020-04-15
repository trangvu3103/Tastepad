<?php
/**
 * Class: Category
 * This is for all Category functions
 */
 
class Category
{
  //user for connection
  protected $conn; 

  //Category's Variable:
  
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
<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
class Recipe
{
  //connection for Recipe
  protected $conn; 

  //Recipe's Variable:
  
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
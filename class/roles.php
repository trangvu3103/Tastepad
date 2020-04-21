<?php
/**
 * Class: Role
 * This is for all Role functions
 */

class Role
{
  //connection for Role
  protected $conn; 

  //Role's Variable:
  
  // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

  public function getRoleByID($roleID = null)
  {
    if($roleID != null){
      $sql = "SELECT userRole FROM roles where roleID = '$roleID'";
      $result = $this->conn->query($sql);
      $this->user_info = $result->fetch_assoc();
      return $result->num_rows;
    }
  }
  
}
 ?>
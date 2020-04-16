<?php
/**
 * Class: Member
 * This is for all Member functions
 */
 
class Member extends user
{
  //use for connection
  // protected $conn; 

  //Member's Variable:
  public $userID;
  public $userName;
  public $userEmail;
  public $userAvatar;
  public $userRole;
  // public $user_info; // an array use for collect database
  // public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    parent::__construct();
  }

  // public function checkRole($role=null)
  // {
  //   if($role == null && $this->userRole == null){
  //     return 1;
  //   }

  //   if($role != null){

  //   }
  // }
}
 ?>
<?php 
/**
 * Class: Admin
 * This is for all Admin functions
 */

require_once 'Member.php';

class Admin extends Member
{
  //use for connection
  // protected $conn; 

  //Admin's Variable:
  // public $UID;
  // public $UName;
  // public $URole;
  // public $UAvatar;
  // public $URecipe;
  // public $userEmail;
  // public $userAvatar;
  // public $user_info; // an array use for collect database
  // public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    parent::__construct();
  }

  public function AddContest()
  {
    
  }

}
?>

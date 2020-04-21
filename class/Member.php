<?php
/**
 * Class: Member
 * This is for all Member functions
 */

require_once 'Users.php';

class Member extends User
{
  //use for connection
  // protected $conn; 

  //Member's Variable:
  public $userID;
  public $userName;
  // public $userEmail;
  // public $userAvatar;
  public $userRole;
  // public $user_info; // an array use for collect database
  // public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    parent::__construct();
    //get USER INFO FROM SESSION
    $this->userID = $_SESSION['user_ID'];
    $this->userName = $_SESSION['user_name'];
    $this->userRole = $_SESSION['role'];
  }


  //USER PROFILE FUNCTIONS
  public function updateUserProfile($userID, $userName, $userEmail, $userAvatar)
  {
    
  }

  public function updateUserName($userName)
  {
    
  }

  public function updateUserEmail($userEmail)
  {
    
  }

  public function updateUserAvatar($userAvatar)
  {
    
  }

  public function updateUserBG($userBG)
  {
    
  }

  public function updatePassword($oldpw,$newpw,$repw)
  {
    
  }

  //RECIPE FUNCTIONS
  //Adding recipe
  public function addRecipe($Rname, $RBio, $ingredients, $steps, $imgs)
  {
    
  }

  //Update Recipe
  public function updateRecipe($RID, $Rname = null, $RBio = null, $ingredients = null, $steps = null, $imgs = null)
  {
    
  }

  //Delete Recipe
  public function deleteRecipe($RID)
  {
    
  }

  //CONTEST FUNCTIONS
  //Member Join the contest with recipe
  public function joinContest($ContestID, $RID = null, $Rname = null, $RBio = null, $ingredients = null, $steps = null, $imgs = null)
  {
    
  }

  public function vote($contestID, $RID)
  {
    
  }

  //SAVED AND LKE FOR RECIPE FUNCTION
  //User like recipe
  public function likeRecipe($RID)
  {
    
  }

  public function saveRecipe($RID)
  {
    
  }

  public function unsavedRecipe($RID)
  {
    
  }

  public function getRecipeByID($RID)
  {
    
  }

}
 ?>
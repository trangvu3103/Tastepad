<?php
/**
 * Class: Member
 * This is for all Member functions
 */

require_once 'Users.php';
require_once 'Recipes.php';

class Member extends User
{
  //use for connection
  // protected $conn; 

  //Member's Variable:
  public $UID;
  public $UName;
  public $URole;
  public $UAvatar;
  public $URecipe;
  // public $userEmail;
  // public $userAvatar;
  // public $user_info; // an array use for collect database
  // public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    parent::__construct();
    //get USER INFO FROM SESSION
    if (isset($_SESSION)&&!empty($_SESSION)) {
      $this->UID = $_SESSION['uid'];
      $this->UName = $_SESSION['name'];
      $this->UAvatar = $_SESSION['avartar'];
      $this->URole = $_SESSION['role'];
      
    }
    $this->URecipe = new Recipe;
  }


  //USER PROFILE FUNCTIONS
  public function updateUserProfile($userID, $userName, $userEmail, $userAvatar)
  {
    
  }

  public function updateUserName($userID, $userName)
  {
    
  }

  public function updateUserEmail($userEmail)
  {
    
  }

  public function updateUserAvatar($userID, $userAvatar)
  {
    
  }

  public function updateUserBG($userID, $userBG)
  {
    
  }

  public function updatePassword($oldpw,$newpw,$repw)
  {
    
  }

  //RECIPE FUNCTIONS
  //Adding recipe
  public function addRecipe($RName,$RBio,$RImgs,$author,$RIngredients,$RSteps)
  {
    if (!$author || !$this->findUserByID($author)) {
      header("Location:home-page.php");
      return 1;
    }
    $this->URecipe->addRecipe($RName,$RBio,$RImgs,$author,$RIngredients,$RSteps);
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
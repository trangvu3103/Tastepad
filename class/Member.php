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
  protected $UID;
  protected $UName;
  protected $URole;
  protected $UAvatar;
  protected $URecipe;
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
    if($this->URecipe->addRecipe($RName,$RBio,$RImgs,$author,$RIngredients,$RSteps)){
      $this->err = $this->URecipe->err;
      return 1; 
    }
    return 0;
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

  public function comment($RID, $UID, $comment)
  {
    if (!$UID||!$this->findUserByID($UID)) {
      $this->err = "Error! No User found";
      return 1;
    }

    if (!$RID||!$this->URecipe->findRecipeByID($RID)) {
      $this->err = "Error! No Recipe found";
      return 1;
    }

    if (!$comment) {
      return 1;
    }

    $sql="INSERT INTO comments VALUES (DEFAULT,'$UID','$RID','$comment',DEFAULT,DEFAULT)";
    $result = $this->conn->query($sql);

    return ($result)?0:1;
  }

  public function getCommentByRIDUID($RID, $UID)
  {
    if (!$UID||!$this->findUserByID($UID)) {
      $this->err = "Error! No User found";
      return 1;
    }

    if (!$RID||!$this->URecipe->findRecipeByID($RID)) {
      $this->err = "Error! No Recipe found";
      return 1;
    }

    // $sql="INSERT INTO comments VALUES (DEFAULT,'$UID','$RID','$comment',DEFAULT,DEFAULT)";
    $result = $this->conn->query($sql);

    return ($result)?0:1;
  }

  public function getCommentsByRID($RID)
  {
    if (!$RID||!$this->URecipe->findRecipeByID($RID)) {
      $this->err = "Error! No Recipe found";
      return 1;
    }

    $sql="INSERT INTO comments VALUES ('$UID','$RID','$comment',DEFAULT,DEFAULT)";
    $result = $this->conn->query($sql);

    return ($result)?0:1;
  }

  //SAVED AND LKE FOR RECIPE FUNCTION
  //User like recipe
  public function likeRecipe($RID, $UID)
  {
    $this->URecipe->likeRecipe($RID, $UID);
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
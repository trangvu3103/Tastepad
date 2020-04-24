<?php
/**
 * Class: Member
 * This is for all Member functions
 */

require_once 'Users.php';
require_once 'Recipes.php';
require_once 'Contest.php';

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
  protected $UContest;
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
    $this->UContest = new Contest;
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
      var_dump('expression');
      // header("Location:home-page.php");
      return 1;
    }
    if($this->URecipe->addRecipe($RName,$RBio,$RImgs,$author,$RIngredients,$RSteps)){
      $this->err = $this->URecipe->err;
      var_dump($this->err);
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
  // public function joinContest($ContestID, $RID = null, $Rname = null, $RBio = null, $ingredients = null, $steps = null, $imgs = null)
  // {
    
  // }

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
    var_dump($result);
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
    $count = $this->URecipe->likeRecipe($RID, $UID);
    if ($this->URecipe->err) {
      $this->err = $this->URecipe->err;
      return -1;
    }
    return $count ;
  }

  public function dislikeRecipe($RID, $UID)
  {
    $count = $this->URecipe->dislikeRecipe($RID, $UID);
    if ($this->URecipe->err) {
      $this->err = $this->URecipe->err;
      return -1;
    }
    return $count;
  }

  // public function saveRecipe($RID)
  // {
    
  // }

  // public function unsavedRecipe($RID)
  // {
    
  // }

  public function joinContest($RID,$CID,$UID)
  {
    if ($this->getStatus($UID)) {
      $this->err = "Your account has been locked!";
      return -1; 
    }
    
    if($this->UContest->addParticipant($RID,$CID,$UID)==-1){
      $this->err = $this->UContest->err;
      return -1;
    }
    return 0;
  }

  public function getRecipesByUIDForCID($UID)
  {
    if (!$UID||!$this->findUserByID($UID)) {
      return -1;
    }

    if ($this->getStatus($UID)) {
      $this->err = "Your account has been locked!";
      return -1; 
    }

    return $this->URecipe->getRecipesByUID($UID);
  }

  public function getStatus($UID)
  {
    if (!$UID||!$this->findUserByID($UID)) {
      return -1;
    }

    $sql = "SELECT lockStatus FROM users WHERE userID = '$UID'";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->user_info = $result->fetch_assoc();
      return $this->user_info['lockStatus'];
    }
    return false;
  }
}
 ?>
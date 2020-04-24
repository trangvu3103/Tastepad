<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
// require_once 'Users.php';
require_once 'RecipeSteps.php';
require_once 'Ingredients.php';
require_once 'Comments.php';
require_once 'FileImg.php';

class Recipe
{
  //connection for Recipe
  protected $conn; 

  //Recipe's Variable:
  protected $RID; 
  protected $RName; 
  protected $RAuthorID; 
  protected $RSteps; 
  protected $RIngredients; 
  protected $Rcmts; 
  protected $Rinfo; 
  protected $RIinfo; 
  protected $RimgFile;
  // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
    $this->RAuthorID = new user;
    $this->RSteps = new Step;
    $this->RIngredients = new Ingredient;
    $this->Rcmts = new Comment;
    $this->RimgFile = new FileImages;
  }

  public function getAllRecipes()
  {
    $sql = "SELECT * FROM recipes, users WHERE recipes.userID = users.userID";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Rinfo = $result->fetch_all(MYSQLI_ASSOC);
    }
    return ($result && $result->num_rows)?$this->Rinfo:false;
  }

  public function getAllRecipesFromNRows($offset=0, $no_of_recipe_per_page=10)
  {
    $sql = "SELECT recipeimages.recipeImageDestination, recipes.*, users.userName, users.userAvatar FROM recipes, users, recipeimages WHERE recipes.userID = users.userID and recipeimages.recipeID = recipes.recipeID ORDER BY recipes.recipeID ASC LIMIT $offset, $no_of_recipe_per_page";
    $result = $this->conn->query($sql);
    if ($result) {
      $result1=[];
      $this->Rinfo = $result->fetch_all(MYSQLI_ASSOC);
      for ($i = 0; $i < count($this->Rinfo) ; $i++) {
        if (!$i) {
          $recipeID = $this->Rinfo[$i]['recipeID'];
        }
        if($i && $this->Rinfo[$i-1]['recipeID'] == $this->Rinfo[$i]['recipeID']){
          $result1[$recipeID]['recipeImageDestination'][] = $this->Rinfo[$i]['recipeImageDestination'];
        }else {
          $like = intval($this->showLikedNumOfRID($this->Rinfo[$i]['recipeID']));
          $checkUIDLike = $this->checkLikedOfRIDUID($this->Rinfo[$i]['recipeID'],$this->Rinfo[$i]['userID']);
          $recipeID = $this->Rinfo[$i]['recipeID'];
          $result1[$recipeID] = ['recipeID' => $this->Rinfo[$i]['recipeID'], 'recipeName' => $this->Rinfo[$i]['recipeName'], 'recipeDes' => $this->Rinfo[$i]['recipeDes'], 'recipeLiked' => $like, 'checkUserLiked' => $checkUIDLike, 'userID' => $this->Rinfo[$i]['userID'], 'userName' => $this->Rinfo[$i]['userName'], 'userAvatar' => $this->Rinfo[$i]['userAvatar']];
          $result1[$recipeID]['recipeImageDestination'][] = $this->Rinfo[$i]['recipeImageDestination'];        
        }
      };
      $this->Rinfo = $result1;      
    };
    return ($result && $result->num_rows)?$this->Rinfo:false;
  }

  public function countRecipes()
  {
    $sql = "SELECT COUNT(*) FROM recipes, users WHERE recipes.userID = users.userID";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Rinfo = $result->fetch_all(MYSQLI_ASSOC);
    }
    return ($result && $result->num_rows)?$this->Rinfo:false;
  }

  public function getRecipeByID($RID)
  {
    $sql = "SELECT users.userAvatar, users.userName, recipes.*  FROM recipes, users WHERE recipes.recipeID = '$RID' and recipes.userID = users.userID ";
    $result = $this->conn->query($sql);
    $sql = "SELECT  recipeImageDestination FROM recipeimages WHERE recipeID = '$RID'";
    $result1 = $this->conn->query($sql);
    if ($result) {
      $this->Rinfo = $result->fetch_assoc();
      $this->Rinfo += ["imgs" => $result1->fetch_all(MYSQLI_ASSOC)];

      $this->Rinfo += ["steps" => $this->RSteps->getStepsOfRecipeID($RID)];
      $this->Rinfo += ["ingredients" => $this->RIngredients->getIngredientsByRID($RID)];
      $this->Rinfo += ["comments" => $this->Rcmts->getCommentsByRID($RID)];
      $this->Rinfo = ["Name" => $this->Rinfo["recipeName"], "Des" => $this->Rinfo["recipeDes"], "author" => $this->Rinfo["userName"], "AID" => $this->Rinfo["userID"], "avatar" => $this->Rinfo["userAvatar"], "recipeLiked" => intval($this->showLikedNumOfRID($RID)), "checkUserLiked" => $this->checkLikedOfRIDUID($RID,$this->Rinfo['userID']), "imgs" => $this->Rinfo["imgs"], "steps" => $this->Rinfo["steps"], "ingredients" => $this->Rinfo["ingredients"], "comments" => $this->Rinfo["comments"]];
      //return $result->fetch_assoc();
    }
    return ($result && $result->num_rows)?$this->Rinfo:false;
  }

  public function addRecipe($RName,$RBio,$RImgs,$author,$RIngredients,$RSteps)
  {
    if (!$RName) {
      $this->err = "Người dùng chưa nhập tên món";
      return 1;
    }
    if ($this->findRecipeByName($RName)) {
      $this->err = "This dish name has been used. Please choose another name";
      return 1;
    }
    if (!$RImgs) {
      $this->err = "Food today or need to take a selfie. Please enter the image of the dish";
      return 1;
    }
    if (!$RIngredients) {
      $this->err = "How to cook without ingredients. Please enter cooking ingredients";
      return 1;
    }
    if (!$RSteps) {
      $this->err = "Just by looking, can you turn ingredients into dishes? Please enter the recipe section";
      return 1;
    }

    //GET ID OF RECIPE
    $sql="SELECT recipeID FROM recipes ORDER BY recipeID DESC";
    $result = $this->conn->query($sql);
    $RID = intval($result->fetch_assoc()['recipeID'])+1;

    

    //ADD RECIPE
    $sql="INSERT INTO recipes VALUES('$RID','$RName','$RBio',0,'$author',null, null, 0, DEFAULT, DEFAULT)";
    $result = $this->conn->query($sql);

    // SET FILE IMG AND FILE LOCATION FOR ADDING
    $this->RimgFile->setFile($RImgs);
    if(empty($this->RimgFile->move(realpath('img/test')))){
      $RimgDest = $this->RimgFile->getFileDestination();
      // GET IMG ID
      $ID = $this->getRIIDByRID($RID)?(intval($this->RIinfo['recipeImageID'])+1):1;
      // ADDING IMG
      foreach ($RimgDest as $k => $v) {
        $sql="INSERT INTO recipeimages VALUES ('$ID','$RID','$v',DEFAULT,DEFAULT)";
        $result = $this->conn->query($sql);
        $ID += 1;
      }

    }else{
      $this->err = $this->RimgFile->err;
        $sql="DELETE FROM recipeimages WHERE recipeImageID IN (SELECT TOP 1 recipeImageID FROM recipeimages ORDER BY id DESC)";
        $result = $this->conn->query($sql);
      return 1;
    }

    $this->addIngredients($RID, $RIngredients);
    if ($this->addSteps($RID, $RSteps)){
      return 1;
    }

    return 0;

  }

  public function updateRecipe($RID, $RName = null, $RBio = null, $RImgs = null, $RIngredients = null, $RSteps = null)
  {
    
  }

  public function deleteRecipe($RID)
  {
    
  }

  public function addSteps($RID, $RSteps)
  {
    foreach ($RSteps as $k => $v) {
      if($this->RSteps->addStep($RID,$v,$k+1)){
        $this->err = $this->RSteps->err;
        return 1;
      }
    }
    
  }

  public function addIngredients($RID, $RIngredients)
  {
    foreach ($RIngredients as $v) {
      $this->RIngredients->addIngredients($RID,$v);
    }
    
  }

  public function findRecipeByName($RName)
  {
    if (!$RName) {
      return null;
    }
    $sql = "SELECT * FROM recipes WHERE recipeName = '$RName'";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Rinfo = $result->fetch_assoc();
      //return $result->fetch_assoc();
    }
    return ($result->num_rows)?$result->num_rows:false;
  }

  public function findRecipeByID($RID)
  {
    if (!$RID) {
      return null;
    }
    $sql = "SELECT * FROM recipes WHERE recipeID = '$RID'";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Rinfo = $result->fetch_assoc();
      //return $result->fetch_assoc();
    }
    return ($result->num_rows)?$result->num_rows:false;
  }

  public function likeRecipe($RID, $UID)
  {
    if (!$RID||!$this->findRecipeByID($RID)) {
      $this->err = "Error! Recipe not found";
      return 1;
    }
    
    // $sql="SELECT * FROM likedrecipes WHERE RecipeID = '$RID' and userID = '$UID'";
    // $result = $this->conn->query($sql);
    // if ($result->num_rows) {
    //   return 1;
    // }
    if ($this->checkLikedOfRIDUID($RID, $UID)) {
      $this->err = "Error!";
      return 1;
    }

    $sql="INSERT INTO likedrecipes VALUES ('$RID','$UID',DEFAULT,DEFAULT)";
    $result = $this->conn->query($sql);
    return $this->showLikedNumOfRID($RID);
    // return 0;
  }

  public function showLikedNumOfRID($RID)
  {
    $sql="SELECT count(userID) AS liked FROM likedrecipes WHERE RecipeID = '$RID'";
    $result = $this->conn->query($sql);
    if ($result) {
      $result = $result->fetch_assoc();
    }

    return $result['liked']?$result['liked']:0;
    
  }

  public function checkLikedOfRIDUID($RID,$UID)
  {
    $sql="SELECT * FROM likedrecipes WHERE RecipeID = '$RID' and userID = '$UID'";
    $result = $this->conn->query($sql);
    $result1 = $result->fetch_assoc();
    if ($result1) {
      return true;
    }

    return false;    
  }

  public function saveRecipe($RID)
  {
    
  }

  public function dislikeRecipe($RID, $UID)
  {
    if (!$RID||!$this->findRecipeByID($RID)) {
      $this->err = "Error! Recipe not found";
      return 1;
    }
    
    // $sql="SELECT * FROM likedrecipes WHERE RecipeID = '$RID' and userID = '$UID'";
    // $result = $this->conn->query($sql);
    // var_dump($result);
    // if (!$result->num_rows) {
    //   return 1;
    // }
    if (!$this->checkLikedOfRIDUID($RID, $UID)) {
      $this->err = "Error!";
      return 1;
    }

    $sql="DELETE FROM likedrecipes WHERE RecipeID = '$RID' and userID = '$UID'";
    $result = $this->conn->query($sql);
     return $this->showLikedNumOfRID($RID);
    // return 0;
  }

  public function unsaveRecipe($RID)
  {
    
  }

  public function getRinfo()
  {
    return $this->Rinfo;
  }

  public function getRIIDByRID($RID)
  {
    $sql = "SELECT  recipeImageID FROM recipeimages WHERE recipeID = '$RID' ORDER BY recipeImageID DESC";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->RIinfo = $result->fetch_assoc();
      //return $result->fetch_assoc();
    }
    return ($result->num_rows)?$result->num_rows:false;
  }
}
 ?>
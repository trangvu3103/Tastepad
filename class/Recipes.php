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
    $sql = "SELECT * FROM recipes, users WHERE recipes.userID = users.userID LIMIT $offset, $no_of_recipe_per_page";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Rinfo = $result->fetch_all(MYSQLI_ASSOC);
    }
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
    if ($result) {
      $this->Rinfo = $result->fetch_assoc();
      $this->Rinfo += ["steps" => $this->RSteps->getStepsOfRecipeID($RID)];
      $this->Rinfo += ["ingredients" => $this->RIngredients->getIngredientsByRID($RID)];
      $this->Rinfo += ["comments" => $this->Rcmts->getCommentsByRID($RID)];
      $this->Rinfo = ["Name" => $this->Rinfo["recipeName"], "Des" => $this->Rinfo["recipeDes"], "author" => $this->Rinfo["userName"], "AID" => $this->Rinfo["userID"], "avatar" => $this->Rinfo["userAvatar"], "liked" => $this->Rinfo["recipeLiked"], "steps" => $this->Rinfo["steps"], "ingredients" => $this->Rinfo["ingredients"], "comments" => $this->Rinfo["comments"]];
      //return $result->fetch_assoc();
    }
    return ($result && $result->num_rows)?$this->Rinfo:false;
  }

  public function addRecipe($RName,$RBio,$RImgs,$author,$RIngredients,$RSteps)
  {

    if (!$RName) {
      $this->err[] = "Người dùng chưa nhập tên món";
      return 1;
    }
    if ($this->findRecipeByName($RName)) {
      $this->err[] = "This dish name has been used. Please choose another name";
      return 1;
    }
    if (!$RImgs) {
      $this->err[] = "Food today or need to take a selfie. Please enter the image of the dish";
      return 1;
    }
    if (!$RIngredients) {
      $this->err[] = "How to cook without ingredients. Please enter cooking ingredients";
      return 1;
    }
    if (!$RSteps) {
      $this->err[] = "Just by looking, can you turn ingredients into dishes? Please enter the recipe section";
      return 1;
    }

    //GET ID OF RECIPE
    $sql="SELECT recipeID FROM recipes ORDER BY recipeID DESC";
    $result = $this->conn->query($sql);
    $RID = intval($result->fetch_assoc()['recipeID'])+1;

    

    //ADD RECIPE
    $sql="INSERT INTO recipes VALUES('$RID','$RName','$RBio',0,'$author',null, DEFAULT, DEFAULT)";
    $result = $this->conn->query($sql);

    // SET FILE IMG AND FILE LOCATION FOR ADDING
    $this->RimgFile->setFile($RImgs);

    if(empty($this->RimgFile->move(realpath('../img/test/')))){
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
      $result = $this->conn->rollback($sql);
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

  public function likeRecipe($RID)
  {
    
  }

  public function saveRecipe($RID)
  {
    
  }

  public function unlikeRecipe($RID)
  {
    
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
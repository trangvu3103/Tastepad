<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
require_once 'RecipeSteps.php';
require_once 'Ingredients.php';
require_once 'Comments.php';

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
  
  // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
    $this->RSteps = new Step;
    $this->RIngredients = new Ingredient;
    $this->Rcmts = new Comment;
  }

  public function getAllRecipes()
  {
    $sql = "SELECT * FROM recipes JOIN users ON recipes.userID = users.userID";
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
      //return $result->fetch_assoc();
    }
    return ($result && $result->num_rows)?$this->Rinfo:false;
  }

  public function addRecipe($RName,$RBio,$RImgs,$RIngredients,$RSteps)
  {
    $this->verifyAddRecipe($RName,$RBio,$RImgs,$RIngredients,$RSteps);
  }

  public function updateRecipe($RID, $RName = null, $RBio = null, $RImgs = null, $RIngredients = null, $RSteps = null)
  {
    
  }

  public function deleteRecipe($RID)
  {
    
  }

  public function verifyAddRecipe($RName, $RImgs, $RIngredients, $RSteps)
  {
    if (!$RName) {
      $this->err[] = "Người dùng chưa nhập tên món";
      return 1;
    }
    if (findRecipeByName($RName)) {
      $this->err[] = "Tên món ăn này đã được sử dụng. Xin chọn tên khác";
      return 1;
    }
    if (!$RImgs) {
      $this->err[] = "Món ăn thời nay hay cần được tự sướng. Xin nhập hình ảnh món ăn";
      return 1;
    }
    if (!$RIngredients) {
      $this->err[] = "How to nấu khi thiếu nguyên liệu. Xin nhập nguyên liệu nấu ăn";
      return 1;
    }
    if (!$RSteps) {
      $this->err[] = "Chỉ cần nhìn bạn có thể biến nguyên liệu thành món ăn, thần thánh dữ? Xin hãy nhập phần công thức nấu ăn";
      return 1;
    }
  }

  public function addSteps($RSteps)
  {
    
  }

  public function addIngredients($RIngredients)
  {
    
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

  public function getRDetails($RID)
  {
    $this->getRecipeByID($RID);
    return ["Name" => $this->Rinfo["recipeName"], "Des" => $this->Rinfo["recipeDes"], "author" => $this->Rinfo["userName"], "AID" => $this->Rinfo["userID"], "avatar" => $this->Rinfo["userAvatar"], "liked" => $this->Rinfo["recipeLiked"], "steps" => $this->Rinfo["steps"], "ingredients" => $this->Rinfo["ingredients"], "comments" => $this->Rinfo["comments"]];
  }


}
 ?>
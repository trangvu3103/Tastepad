<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
require_once 'RecipeSteps.php';
require_once 'Ingredients.php';

class Recipe
{
  //connection for Recipe
  protected $conn; 

  //Recipe's Variable:
  
  // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

  public function getAllRecipes()
  {
    $sql = "SELECT * FROM users u, recipes r, recipeimages ri WHERE 'u.userID' = 'r.userID' and 'r.recipeID' = 'ri.recipeID'";
    $result = $this->conn->query($sql);

  }

  public function getRecipeByID($RID)
  {
    $sql = "SELECT * FROM users u, recipes r, recipeimages ri WHERE 'u.userID' = 'r.userID' and 'r.recipeID' = 'ri.recipeID' and 'r.recipeID' = '$RID'";
    $result = $this->conn->query($sql);
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
    $this->user_info = $result->fetch_assoc();
    return $result->num_rows;
  }

  public function findRecipeByID($RID)
  {
    if (!$RID) {
      return null;
    }
    $sql = "SELECT * FROM recipes WHERE recipeID = '$RID'";
    $result = $this->conn->query($sql);
    $this->user_info = $result->fetch_assoc();
    return $result->num_rows;
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
}
 ?>
<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
class RecipeStep
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

  public function deleteRecipe($RID)
  {
    
  }

  public function verifyAddRecipe($RName,$RBio,$RImgs,$RIngredients,$RSteps)
  {
    
  }

  public function addSteps()
  {
    
  }

  public function addIngredients()
  {
    
  }

}
 ?>
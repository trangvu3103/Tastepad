<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
class Ingredients
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

  public function getIngredientsByRID($RID)
  {
    $sql = "SELECT * FROM users u, recipes r, recipeimages ri WHERE 'u.userID' = 'r.userID' and 'r.recipeID' = 'ri.recipeID'";
    $result = $this->conn->query($sql);

  }

  public function addIngredients($IName,$RID)
  {

  }

  public function deleteIngredients($RID)
  {
    
  }
  public function updateSteps($RID,$IID)
  {
    
  }

}
 ?>
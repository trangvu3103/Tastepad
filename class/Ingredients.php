<?php
/**
 * Class: Ingredients
 * This is for all Ingredients functions
 */
 
class Ingredient
{
  //connection for Ingredients
  protected $conn; 

  //Ingredients's Variable:
  protected $IID;
  protected $IRID;
  protected $Iinfo;
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
    $sql = "SELECT ingredientNameAndAmoount FROM ingredients WHERE recipeID = '$RID'";
    $result = $this->conn->query($sql);
    if ($result) {
      $fetch = $result->fetch_all();
      foreach ($fetch as $info) {
        $this->Iinfo[] = $info[0];
      }

    }
    return ($result && $result->num_rows)?$this->Iinfo:false;
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
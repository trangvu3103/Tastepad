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
      $fetch = $result->fetch_all(MYSQLI_ASSOC);
      foreach ($fetch as $info) {
        $this->Iinfo[] = $info[0];
      }

    }
    return ($result && $result->num_rows)?$this->Iinfo:false;
  }

  public function addIngredients($RID, $INameNAmount)
  {
    $IID = $this->getLastIIDByRID($RID)?intval($this->Iinfo['ingredientID']):1;
    $sql="INSERT INTO ingredients VALUES ('$IID','$RID','$INameNAmount',DEFAULT,DEFAULT)";
    $result = $this->conn->query($sql);
    return ($result && $result->num_rows)?$result:false;
  }

  public function deleteIngredient($RID,$IID)
  {
    
  }
  public function updateIngredient($RID,$IID)
  {
    
  }
  public function getLastIIDByRID($RID)
  {
    $sql = "SELECT ingredientID FROM ingredients WHERE recipeID = '$RID' ORDER BY ingredientID DESC";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Iinfo = $result->fetch_assoc();

    }
    return ($result && $result->num_rows)?$result:false;
    
  }

}
 ?>
<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
class Step
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

  public function getStepsOfRecipeID($RID)
  {
    $sql = "SELECT * FROM steps WHERE recipeID = '$RID' ORDER BY stepNumber";
    $result = $this->conn->query($sql);

  }

  public function addStep($RID, $RStep)
  {
    
  }

  public function deleteStep($RID,$RStep)
  {
    
  }

  public function updateStep($RID, $RStep)
  {
    
  }

}
 ?>
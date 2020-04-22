<?php
/**
 * Class: RecipeStep
 * This is for all RecipeStep functions
 */

class Step
{
  //connection for RecipeStep
  protected $conn; 

  //RecipeStep's Variable:
  protected $SID;
  protected $SRecipeID;
  protected $Sinfo;
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
    $sql = "SELECT stepID, stepDes FROM steps WHERE steps.recipeID = '$RID' ORDER BY stepID";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Sinfo = $result->fetch_all(MYSQLI_ASSOC);
    }
    return ($result && $result->num_rows)?$this->Sinfo:false;
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
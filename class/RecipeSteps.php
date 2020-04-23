<?php
/**
 * Class: RecipeStep
 * This is for all RecipeStep functions
 */
require_once 'FileImg.php';

class Step
{
  //connection for RecipeStep
  protected $conn; 

  //RecipeStep's Variable:
  protected $SID;
  protected $SRecipeID;
  protected $SImgs;
  protected $Sinfo;
  // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->SImgs = new FileImages;
    $this->err=[];
  }

  public function getStepsOfRecipeID($RID)
  {
    $sql = "SELECT steps.stepID, steps.stepDes, stepimages.stepImageDestination FROM steps, stepimages WHERE steps.recipeID = '$RID' and steps.stepID = stepimages.stepID ORDER BY stepID ASC";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Sinfo = $result->fetch_all(MYSQLI_ASSOC);
      foreach ($this->Sinfo as $k => $v) {
        if (!$k) {
          $stepID = $v['stepID'];
        }
        if($k!=0 && $this->Sinfo[$k-1]['stepID'] == $v['stepID']){
          $result1[$stepID]['stepImageDestination'][] = $v['stepImageDestination'];
        }else {
          $stepID = $v['stepID'];
          $result1[$stepID] = ['stepID' => $v['stepID'], 'stepDes' => $v['stepDes']];
          $result1[$stepID]['stepImageDestination'][] = $v['stepImageDestination'];        
        }
      }
      $this->Sinfo = $result1;

    }
    return ($result && $result->num_rows)?$this->Sinfo:false;
  }

  public function addStep($RID, $RStep, $SID)
  {
    //ADD STEP
    $des = $RStep['step'];
    $sql="INSERT INTO steps VALUES ('$SID','$RID','$des',DEFAULT,DEFAULT)";
    $result = $this->conn->query($sql);


    //ADD STEP IMG
    $SIID = $this->getLastSIIDByRID($SID)?intval($this->Sinfo['stepImageID']):1;

    // SET FILE IMG AND FILE LOCATION FOR ADDING
    $this->SImgs->setFile($RStep['stepImgs']);

    if(empty($this->SImgs->move(realpath('img/test/')))){
      $SImgDest = $this->SImgs->getFileDestination();
      // ADDING IMG
      foreach ($SImgDest as $k => $v) {
        $sql="INSERT INTO stepimages VALUES ('$SIID','$SID','$v',DEFAULT,DEFAULT)";
        $result = $this->conn->query($sql);
        $SIID += 1;
      }

    }else{
      $this->err = $this->SImgs->err;
      return 1;
    }
    return 0;
  }

  public function deleteStep($RID,$RStep)
  {
    $sql="DELETE FROM steps, stepimages WHERE recipeImageID IN (SELECT TOP 1 recipeImageID FROM recipeimages ORDER BY id DESC)";
    $result = $this->conn->query($sql);

  }

  public function updateStep($RID, $RStep)
  {
    
  }

  public function getLastSIDByRID($RID)
  {
    $sql = "SELECT stepID FROM steps WHERE recipeID = '$RID' ORDER BY stepID DESC";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Sinfo = $result->fetch_assoc();

    }
    return ($result && $result->num_rows)?$result:false;
    
  }

  public function getLastSIIDByRID($SID)
  {
    $sql = "SELECT stepImageID FROM stepimages WHERE stepID = '$SID' ORDER BY stepImageID DESC";
    $result = $this->conn->query($sql);
    if ($result) {
      $this->Sinfo = $result->fetch_assoc();

    }
    return ($result && $result->num_rows)?$result:false;
    
  }

}
 ?>
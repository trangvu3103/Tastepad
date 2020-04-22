<?php
/**
 * Class: Comment
 * This is for all Comment functions
 */
 
class Comment
{
  //connection for Comment
  protected $conn; 

  //Comment's Variable:
  protected $CUID;
  protected $CRID;
  protected $Iinfo;
  // an array use for collect database
  public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    $this->conn = new DB;
    $this->err=[];
  }

  public function getCommentsByRID($RID)
  {
    $sql = "SELECT users.userID, users.userName AS `name`, users.userAvatar,comments.userComment FROM comments, users WHERE comments.recipeID = '$RID' and comments.userID = users.userID ORDER BY comments.dateModified DESC ";
    $result = $this->conn->query($sql);
    if ($result) {
      $fetch = $result->fetch_all(MYSQLI_ASSOC);
      foreach ($fetch as $info) {
        $this->Iinfo[] = $info;
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
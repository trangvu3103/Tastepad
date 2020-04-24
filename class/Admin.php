<?php 
/**
 * Class: Admin
 * This is for all Admin functions
 */

require_once 'Member.php';

class Admin extends Member
{
  //use for connection
  // protected $conn; 

  //Admin's Variable:
  // public $UID;
  // public $UName;
  // public $URole;
  // public $UAvatar;
  // public $URecipe;
  // public $userEmail;
  // public $userAvatar;

  protected $AContest;

  // public $user_info; // an array use for collect database
  // public $err; //check for error before run the improtant code

  //Function
  public function __construct()
  {
    parent::__construct();
    $this->AContest = new Contest;
  }

  public function openContest($CName,$CDes,$Cimgs,$CSDate,$CEDate,$CRule,$Author,$CPar)
  {
    // if (intval($this->countUsers())<10) {
    //   $this->err = "not enough users to open contest";
    //   return -1;
    // }
    if (!$CName) {
      $this->err = "Please enter the contest name";
      return -1;
    }
    if (!$Cimgs) {
      $this->err = "To Show our beauty please choose some images to represent us to everyone";
      return -1;
    }
    if (!$CSDate) {
      $this->err = "There is a start for everything. Please enter the Start date.";
      return -1;
    }
    if (!$CEDate) {
      $this->err = "Every new beginning comes from some other beginning's end. Please enter the End date";
      return -1;
    }
    if (date($CSDate)>date($CEDate)) {
      $this->err = "Error! Pleaser re-enter the Start date or End date";
      return -1;
    }
    if (!$CRule) {
      $this->err = "Contest - rule = Chaos. Please Enter the rule for the contest.";
      return -1;
    }
    if (!$Author) {
      $this->err = "Error";
      return -1;
    }

    if (!$CPar) {
      $CPar = (int)(intval($this->countUsers())/2);
    }
    
    $this->AContest->AddContest($CName,$CDes,$Cimgs,$CSDate,$CEDate,$CRule,$Author,$CPar?$CPar:2);
    if ($this->AContest->err) {
      $this->err = $this->AContest->err;
      return -1;
    }
    return 0;

  }

}
?>

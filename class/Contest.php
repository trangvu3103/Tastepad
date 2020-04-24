<?php
/**
 * Class: Recipe
 * This is for all Recipe functions
 */
 
// require_once 'Users.php';
require_once 'Recipes.php';

class Contest{
	//use for connection
	protected $conn; 

	//Contest's Variables:
	protected $CID;
	protected $AdID;
	protected $Cinfo;
	protected $CIinfo;
	protected $CimgFile;
	protected $CRecipe;

	public $err; //check for error before run the improtant code

	//FUNCTIONS:

	public function __construct($param = null)
	{
		$this->conn = new DB;
		$this->err='';
		$this->AdID = $_SESSION['role']==2?$_SESSION['uid']:'';
		$this->CimgFile = new FileImages;
		$this->CRecipe = new Recipe;
	}

	public function AddContest($CName,$CDes,$Cimgs,$CSDate,$CEDate,$CRule,$CAID,$CPar=2)
	{
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
		
		if (strtotime($CSDate)>strtotime($CEDate)) {
		  $this->err = "Error! Pleaser re-enter the Start date or End date";
		  return -1;
		}

		$CSDate = date('Y-m-d H:i:s', strtotime($CSDate));
		$CEDate = date('Y-m-d H:i:s', strtotime($CEDate));
		if (!$CRule) {
			$this->err = "Contest - rule = Chaos. Please Enter the rule for the contest.";
			return -1;
		}
		if (!$CAID) {
			$this->err = "Error";
			return -1;
		}

		$CPar = intval($CPar);

		//GET ID OF CONTEST
		$sql="SELECT contestID FROM contests ORDER BY contestID DESC";
		$result = $this->conn->query($sql);
		$CID = intval($result->fetch_assoc()['contestID'])+1;
		//ADD CONTEST
		$sql="INSERT INTO contests VALUES ('$CID','$CName','$CDes','$CPar','$CRule','$CSDate','$CEDate','$CAID',DEFAULT,DEFAULT)";
		$result = $this->conn->query($sql);

		// SET FILE IMG AND FILE LOCATION FOR ADDING
		$this->CimgFile->setFile($Cimgs);
		if(empty($this->CimgFile->move(realpath('img/test')))){
		  $CimgDest = $this->CimgFile->getFileDestination();
		  // GET IMG ID
		  $ID = $this->getCIIDByRID($CID)?(intval($this->CIinfo['contestID'])+1):1;
		  // ADDING IMG
		  foreach ($CimgDest as $k => $v) {
		    $sql="INSERT INTO contestimages VALUES ('$CID','$ID','$v',DEFAULT,DEFAULT)";
		    $result = $this->conn->query($sql);
		    $ID += 1;
		  }

		}else{
		  $this->err = $this->CimgFile->err;
		    $sql="DELETE FROM contests WHERE contestID IN (SELECT TOP 1 contestID FROM contest ORDER BY contestID DESC)";
		    $result = $this->conn->query($sql);
		  return 1;
		}
	}

	public function getCIIDByRID($CID)
	{
	  $sql = "SELECT contestImagesID FROM contestimages WHERE contestID = '$CID' ORDER BY contestImagesID DESC";
	  $result = $this->conn->query($sql);
	  if ($result) {
	    $this->CIinfo = $result->fetch_assoc();
	  }
	  return ($result->num_rows)?$result->num_rows:false;
	}

	public function findContestByID($CID)
	{
	  if (!$CID) {
	    return null;
	  }
	  $sql = "SELECT * FROM contests WHERE contestID = '$CID'";
	  $result = $this->conn->query($sql);
	  if ($result) {
	    $this->Rinfo = $result->fetch_assoc();
	  }
	  return ($result->num_rows)?$result->num_rows:false;
	}

	public function getContestByCID($CID)
	{
	  $sql = "SELECT * FROM contests WHERE contests.contestID = '$CID'";
	  $result = $this->conn->query($sql);
	  if ($result) {
	    $this->Cinfo = $result->fetch_assoc();
	    $sql = "SELECT contestimages.imgDes FROM contestimages WHERE contestimages.contestID = '$CID' ORDER BY contestimages.contestID DESC";
	    $result1 = $this->conn->query($sql);
	    $this->Cinfo["contestImages"] = $result1->fetch_all(MYSQLI_ASSOC);
		$this->Cinfo['Recipes'] = $this->getContestRecipe($CID);
	  }
	  return ($result && $result->num_rows)?$this->Cinfo:false;
	}

	public function addParticipant($RID,$CID,$UID)
	{
		var_dump($RID,$CID,$UID);
		if (!$this->findParticipantInContest($CID,$UID)) {
			if ($this->checkSDate($CID,date('j M Y'))) {
				if ($this->checkEDate($CID,date('j M Y'))) {
					$sql="INSERT INTO participants VALUES ('$UID','$CID','$RID',DEFAULT,DEFAULT)";
					$result = $this->conn->query($sql);

					return 0;
					
				}
				$this->err = "The contest is ended";
				return -1;
			}
			$this->err = "The contest is not started";
			return -1;
		}
		$this->err="Error!";
		return -1;

	}

	public function findParticipantInContest($CID,$UID)
	{
		$sql="SELECT * FROM participants WHERE userID = '$UID' and contestID = 'CID'";
		$result = $this->conn->query($sql);
		return $result->num_rows;
	}

	public function checkSDate($CID,$sDate)
	{
		$sql="SELECT startDate FROM contests WHERE contestID = '$CID'";
		$query = $this->conn->query($sql);
		$result = $query->fetch_assoc()['startDate'];
		return (strtotime($result)<=strtotime($sDate)) ? true : false;
		
	}

	public function checkEDate($CID,$eDate)
	{
		$sql="SELECT endDate FROM contests WHERE contestID = '$CID'";
		$query = $this->conn->query($sql);
		$result = $query->fetch_assoc()['endDate'];
		return (strtotime($result)>strtotime($eDate)) ? true : false;
	}

	public function getContestRecipe($CID,$limit=12)
	{
		$sql="SELECT recipes.*, users.userID, users.userName, users.userAvatar FROM recipes, users WHERE recipes.userID = users.userID and recipes.recipeID IN (SELECT participants.recipeID FROM participants WHERE participants.contestID = '$CID') LIMIT 0, $limit";
		$query = $this->conn->query($sql);
		// var_dump($query);
		if ($query) {
			$result = $query->fetch_all(MYSQLI_ASSOC);
			foreach ($result as $k => $v) {
			  $rid = intval($v['recipeID']);
			  $sql = "SELECT  recipeImageDestination FROM recipeimages WHERE recipeID = '$rid'";
			  $result1 = $this->conn->query($sql);
			  $result[$k]['recipeImageDestination'] = $result1->fetch_assoc()['recipeImageDestination'];
			  $like = $this->getVote($CID,$v['recipeID']);
			  $result[$k]['recipeVote'] = $like;
			  $result[$k]['rank'] = $this->getFirst3Ranks($CID,$like);
			}
			shuffle($result);
			return $result;
			// return shuffle($result);
		}
		return false;
	}
	
	public function getVote($CID,$RID)
	{
		$sql="SELECT COUNT(voterecipe.userID) as vote FROM voterecipe WHERE voterecipe.contestID = '$CID' AND voterecipe.recipeID = '$RID'";
		$query = $this->conn->query($sql);
		$result = $query->fetch_assoc()['vote'];
		return $result;
	}

	public function getFirst3Ranks($CID,$vote)
	{
		$sql="SELECT COUNT(voterecipe.userID) AS ranks FROM voterecipe WHERE voterecipe.contestID = '$CID' GROUP BY voterecipe.recipeID ORDER BY COUNT(*) DESC LIMIT 3";
		$query = $this->conn->query($sql);
		$result = $query->fetch_all(MYSQLI_ASSOC);
		foreach ($result as $key => $value) {
			if ($vote == $value['ranks']) {
				return $key+1;
			}
		}
		return 0;
	}

	public function checkVote($CID, $UID)
	{
		$sql="SELECT count(*) AS ranks FROM voterecipe WHERE voterecipe.contestID = '$CID' AND voterecipe.userID = '$UID'";
		$query = $this->conn->query($sql);
		return $query->num_rows;
	}

	public function getAllContestFromNRows($offset=0, $no_of_recipe_per_page=10)
  	{
	    $sql = "SELECT * FROM contests ORDER BY contests.endDate ASC LIMIT $offset, $no_of_recipe_per_page";
	    $result = $this->conn->query($sql);
	    $Cinfo;
	    if ($result) {
	    	$Cinfo = $result->fetch_all(MYSQLI_ASSOC);
	    	foreach ($Cinfo as $k => $v) {
	    		$cid = $v['contestID'];
	    		$sql = "SELECT * FROM contestimages WHERE contestimages.contestID = '$cid'";
	    		$result1 = $this->conn->query($sql);
	    		$Cinfo[$k]['banner'] = $result1->fetch_assoc()['imgDes'];
	    	}
	    	return $Cinfo;
	    }
	}

	public function getTotalNumPages($no_of_records_per_page)
	{
	  $total_pages_sql = "SELECT COUNT(*) as total FROM contests";
	  $result = $this->conn->query($total_pages_sql);
	  $fetch = $result->fetch_array();
	  $total_count = $fetch['total'];
	  return $total_count;
	}

}
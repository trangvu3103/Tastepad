<?php 
    include_once 'include/config.php';
foreach (glob(dirname(dirname(__FILE__))."/class/*.php") as $filename)
{
    include_once $filename;
}


$member = new Member;
if(isset($_POST['rid']) && !empty($_POST['rid'])){
	if (isset($_POST['like']) && $_POST['like']) {
		$member->likeRecipe($_POST['rid'],$_SESSION['uid']);
		if ($member->err) {
			echo json_encode(array('err' => 1, 'mess' => $member->err));
		}else{
			echo json_encode(array('err' => 0, 'mess' => $member->err));
		}
		exit();
	}
	if (isset($_POST['like']) && !$_POST['like']) {
		$member->dislikeRecipe($_POST['rid'],$_SESSION['uid']);
		if ($member->err) {
			echo json_encode(array('err' => 1, 'mess' => $member->err));
		}else{
			echo json_encode(array('err' => 0, 'mess' => $member->err));
		}
		exit();
	}
}


	// echo json_encode(array('success' => 0));
	// exit();
 ?>

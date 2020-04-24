<?php 
include_once 'include/config.php';
foreach (glob(dirname(dirname(__FILE__))."/class/*.php") as $filename)
{
    include_once $filename;
}


$member = new Member;
// var_dump($member);
// var_dump($_POST);
if(isset($_POST['rid']) && !empty($_POST['rid'])){
// var_dump("expression");

	if (isset($_POST['like']) && $_POST['like']==1) {
		// var_dump("expression0");
		$count = $member->likeRecipe($_POST['rid'],$_SESSION['uid']);
		if ($count == -1) {
			$data["err"] = 1;
			$data["mess"] = $member->err; 
		}else{
			$data["err"] = 0;
			$data["mess"] = $count;
		}
		echo json_encode($data);
	}
	if (isset($_POST['like']) && $_POST['like']==0) {
	// var_dump("expression1");
		$count = $member->dislikeRecipe($_POST['rid'],$_SESSION['uid']);
		if ($count == -1) {
			$data["err"] = 1;
			$data["mess"] = $member->err; 
		}else{
			$data["err"] = 0;
			$data["mess"] = $count;
		}
		echo json_encode($data);
	}
// 		var_dump("hey");
// // 		// $count = $member->likeRecipe($_POST['rid'],$_SESSION['uid']);
// // 		var_dump($member->likeRecipe($_POST['rid'],$_SESSION['uid']));
// // 		// if ($member->err) {
// // 		// 	$data["err"] = 1;
// // 		// 	$data["mess"] = $member->err; 
// // 		// 	// echo json_encode(['err' => 1, 'mess' => $member->err]);
// // 		// }else{
// // 		// 	$data["err"] = 0;
// // 		// 	$data["mess"] = $count;
// // 		// 	// echo json_encode(['err' => 0, 'mess' => $count]);
// // 		// }
// // 		// exit();
// 	};
// 	if (isset($_POST['like']) && !$_POST['like']==0) {
// 		var_dump("dis");
// // 		var_dump($member->dislikeRecipe($_POST['rid'],$_SESSION['uid']));
// // 		// $count = $member->dislikeRecipe($_POST['rid'],$_SESSION['uid']);
// // 		// if ($member->err) {
// // 		// 	$data["err"] = 1;
// // 		// 	$data["mess"] = $member->err; 
// // 		// 	// echo json_encode(['err' => 1, 'mess' => $member->err]);
// // 		// }else{
// // 		// 	$data["err"] = 0;
// // 		// 	$data["mess"] = $count;
// // 		// 	// echo json_encode(['err' => 0, 'mess' => $count]);
// // 		// }
// // 		// echo json_encode($data);
// // 		// exit();
// 	};
};


// 	// echo json_encode(['success' => 0));
// 	// exit();
 ?>

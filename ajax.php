<?php 
    include_once 'include/config.php';
foreach (glob(dirname(dirname(__FILE__))."/class/*.php") as $filename)
{
    include_once $filename;
}


var_dump($_SESSION);
$member = new Member;
if(!isset($_POST['rid'])||empty($_POST['rid'])){
	echo json_encode(array('success' => 0));
	exit();
}

$member->likeRecipe($_POST['rid'],$_SESSION['uid']);

 ?>

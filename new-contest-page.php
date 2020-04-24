<?php include 'include/header.php'; ?>
<?php 
$arr = [];
$err;

if (empty($member)) {
	$member = new Member;
}

if (isset($_POST['openContest'])/*&& isset($_SESSION['role'])&&$_SESSION['role']==2*/) {
	// var_dump($_POST);
	// var_dump($_FILES);
	$member = new Admin;

	$member->openContest($_POST['name'],$_POST['description'],$_FILES['contest-img'],$_POST['start-date'],$_POST['end-date'],$_POST['rule'],$_SESSION['uid'],$_POST['paricipance'],);
}
 ?>

<?php include 'include/form/new-contest-form.php' ?>

<?php include 'include/footer.php'; ?>

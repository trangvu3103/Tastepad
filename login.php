<?php include 'include/header.php'; ?>
<?php 
$user = new User;
if (isset($_POST['login'])) {
	var_dump($user->login($_POST['email'],$_POST['password']));
  	var_dump($_POST['email']);
  	var_dump($_POST['password']);
  	var_dump($user->err);

}
if (isset($_POST['signup'])) {
  	var_dump($_POST['email']);
  	var_dump($_POST['full-name']);
  	var_dump($_POST['pass']);
  	var_dump($_POST['re-pass']);
	$errCheck = $user->register($_POST['email'],$_POST['full-name'], $_POST['pass'], $_POST['re-pass']);
  	if ($errCheck) {
  	var_dump($user->err);
  		
  	}
}
 ?>

 <?php include 'include/footer.php'; ?>

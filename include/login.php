<?php 
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$user = new User;
if (isset($_POST['login'])) {
	$err = $user->login($_POST['email'], $_POST['password']);
	echo json_encode(array('err' => $err, 'mess' => $user->err)); 
}
if (isset($_POST['signup'])) {
	$err = $user->register($_POST['email'], $_POST['fullName'], $_POST['password'], $_POST['rePassword']);
	echo json_encode(array('err' => $err, 'mess' => $user->err)); 
}
 ?>

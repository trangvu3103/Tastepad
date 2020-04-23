<?php 
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$user = new User;
if (isset($_POST['login'])) {
	if ($user->login($_POST['email'], $_POST['password'])){
		$_SESSION['err'] = $user->err;
	}
	// echo json_encode(array('err' => $err, 'mess' => $user->err, 'sess' => (isset($_SESSION)&&!empty($_SESSION))?$_SESSION:'')); 
	// exit();
}
if (isset($_POST['signup'])) {
	if ($user->register($_POST['email'], $_POST['fullName'], $_POST['password'], $_POST['rePassword'])){
		$_SESSION['err'] = $user->err;
	};
	// echo json_encode(array('err' => $err, 'mess' => $user->err, 'sess' => (isset($_SESSION)&&!empty($_SESSION))?$_SESSION:'')); 
	// exit();
}
 ?>

<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/Tastepad/include/config.php';

foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$user = new User;
if (isset($_POST['login'])) {
	if ($user->login($_POST['email'], $_POST['password'])){
		$data['err'] = 1;
		$data['mess'] = $user->err;
		$data['sess'] = '';
	}else {
		$data['err'] = 0;
		$data['mess'] = '';
		$data['sess'] = $_SESSION;
		
	}
	echo json_encode($data); 
	// echo json_encode(array('err' => $err, 'mess' => $user->err, 'sess' => (isset($_SESSION)&&!empty($_SESSION))?$_SESSION:'')); 
	// exit();
}
if (isset($_POST['signup'])) {
	if ($user->register($_POST['email'], $_POST['fullName'], $_POST['password'], $_POST['rePassword'])){
		$data['err'] = 1;
		$data['mess'] = $user->err;
		$data['sess'] = '';
	}else{
		$data['err'] = 0;
		$data['mess'] = '';
		$data['sess'] = $_SESSION;

	}
	echo json_encode($data); 
	// exit();
}
 ?>
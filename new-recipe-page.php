
<?php include 'include/header.php'; ?>

<?php 
if (!(isset($_SESSION['isLoggin']) && $_SESSION['isLoggin'])):
	header('Location: javascript://history.go(-1)');
else:

$arr = [];
$err;

if (empty($member)) {
	$member = new Member;
}
if (isset($_POST['add_recipe'])) {
	// for ($i = 0; $i < count($_FILES); $i++) {
	// 	if (stripos($i, 'recipestepimg')===0) {
	//   	$substr = ((int)substr($i, stripos($i, '_')+1));
	//   	$arr[] = ["step" => $_POST['step'][$i], "stepImgs" => $_FILES[$i]];
	//   };
	//   var_dump($arr);
	// };
	foreach($_FILES as $k => $v){
	  if (stripos($k, 'recipestepimg')===0) {
	  	$substr = ((int)substr($k, stripos($k, '_')+1));
	  	$arr[] = ["step" => $_POST['step'][($substr-1)], "stepImgs" => $v];
	  }
	};

	$recipe = new Recipe;
	if($member->addRecipe($_POST['recipe-name'], $_POST['short-description'], $_FILES["recipeimg"], $_POST['uid'], $_POST['ingre'], $arr)):
		$err = $member->err;

	else:
		// header("location: home-page.php");?>
		<script>
			var path = location.pathname.split('/');
			if (path[path.length-1].indexOf('.html')>-1) {
			  path.length = path.length - 1;
			}
			var app = path[path.length-2]; // if you just want 'three'

			console.log(response.sess);
			window.location.href = "../home-page";
		</script>
	<?php endif;
}
	
?>
<?php include 'include/form/new-recipe-form.php' ?>

<?php endif ?>

<?php include 'include/footer.php'; ?>

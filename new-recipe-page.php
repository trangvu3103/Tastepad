
<?php include 'include/header.php'; ?>

<?php 
if (!(isset($_SESSION['isLoggin']) && $_SESSION['isLoggin'])):
	header('Location: javascript://history.go(-1)');
else:

$arr = [];

if (isset($_POST['add_recipe'])) {
	foreach($_FILES as $k => $v){
	  if (stripos($k, 'recipestepimg')===0) {
	  	$substr = ((int)substr($k, stripos($k, '_')+1));
	  	$arr[] = ["step" => $_POST['step'][($substr-1)], "stepImgs" => $v];
	  }
	};

	$recipe = new Recipe;
	$member->addRecipe($_POST['recipe-name'], $_POST['short-description'], $_FILES["recipeimg"], $_POST['uid'], $_POST['ingre'], $arr); 
	
}
	
?>
<?php include 'include/form/new-recipe-form.php' ?>

<?php endif ?>

<?php include 'include/footer.php'; ?>

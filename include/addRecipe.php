<?php 
// var_dump($_POST); 
// var_dump($_FILES); 
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$arr = [];


foreach($_FILES as $k => $v){
  if (stripos($k, 'recipestepimg')===0) {
  	// var_dump(stripos($k, '_'));
  	$substr = ((int)substr($k, stripos($k, '_')+1));
  	// var_dump($substr);
  	$arr[] = ["step" => $_POST['step'][($substr-1)], "stepImgs" => $v];
  }
};
var_dump($arr);
$recipe = new Recipe;
$recipe->addRecipe($_POST['recipe-name'], $_POST['short-description'], $_FILES["recipeimg"], $_POST['uid'], $_POST['ingre'], $arr); 


?>
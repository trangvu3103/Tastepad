<?php 

foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}
$member = new Member;
$arr = [];


foreach($_FILES as $k => $v){
  if (stripos($k, 'recipestepimg')===0) {
  	$substr = ((int)substr($k, stripos($k, '_')+1));
  	$arr[] = ["step" => $_POST['step'][($substr-1)], "stepImgs" => $v];
  }
};

var_dump($member);
$recipe = new Recipe;
$recipe->addRecipe($_POST['recipe-name'], $_POST['short-description'], $_FILES["recipeimg"], $_POST['uid'], $_POST['ingre'], $arr); 
	

?>
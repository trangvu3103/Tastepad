<?php
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$recipe = new Recipe;
$no_of_recipe_per_page = 12;

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$offset = ($pageno-1) * $no_of_recipe_per_page;

if (isset($_GET['total_pages'])) {
    $total_rows = $_GET['total_pages'];
} else {
	$recipes = $recipe->getAllRecipes();
	$total_rows = count($recipes);
	$total_pages = ceil($total_rows / $no_of_recipe_per_page);
}



for ($i=1; $i<=$total_pages; $i++) {  
	$pageNum.='<li class="page-item"><a class="page-link" href="?page='..'">'.$i.'</a></li>'
};

echo '<div class="page">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="?page='.$page-1.'">Previous</a></li>
          '.$pageNum.'
          <li class="page-item"><a class="page-link" href="?page='.$page+1.'">Next</a></li>
        </ul>
      </nav>
    </div>';

 ?>
<?php
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

// if (isset($_GET['pageno'])) {
//     $pageno = $_GET['pageno'];
// } else {
//     $pageno = 1;
// } 

// $no_of_records_per_page = 12;
// $offset = ($pageno-1) * $no_of_records_per_page; 
$recipe = new Recipe;

//Display post
$rowperpage = 12;

$row = 0;
 if(isset($_GET['pageno'])){
  $row = $_GET['pageno']-1;
  if($row < 0){
   $row = 0;
  }
 }

$total_count = $recipe->getTotalNumPages($rowperpage);
// selecting rows
$offset = $row*$rowperpage;


$recipes = $recipe->getAllRecipesFromNRows($offset, $rowperpage);

if ($recipes):
 $Rs_length = count($recipes);
  ?>
<div class="col-lg-9 recipe-ls ls">
  <?php foreach ($recipes as $key =>$v):?>
    <?php if ($key%3 == 1): ?>
      <div class="row">
    <?php endif ?>
    <div class="col-md-4 recipe-card" data-href="recipe/<?= $v['recipeID'] ?>">
      <div class="descrip">
        <?php if ($v['recipeImageDestination']): ?>
          <img src="<?= getImgHP($v['recipeImageDestination'][0]) ?>" alt="recipe-thumbnail">
        <?php else: ?>
          <img src="<?= root ?>img\food\f7a6771a03e0dfff2fa2c82c95dd9baf.jpg" alt="">
        <?php endif ?>
        <div class="descrip-txt">
          <div><?= readmore($v['recipeDes']) ?></div>
        </div>
      </div>
      <h2><?= readmore($v['recipeName'],50) ?></h2>
      <div class="info">
        <div class="author">
          <?php if ($v['userAvatar']): ?>
            <img src="<?= getImgHP($v['userAvatar']) ?>" alt="recipe-thumbnail">
          <?php else: ?>
            <img src="<?= base_url() ?>\img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
          <?php endif ?>
          <div><?= $v['userName'] ?></div>
        </div>
        <div class="like">
          <div class="likeNum"><?php echo restyle_text($v['recipeLiked']); ?></div>
          <?php if ($v['recipeLiked']!=0 && $recipe->checkLikedOfRIDUID($v['recipeID'],$v['userID'])): ?>
            <img src="img\icon\closer.png" alt="" class="dislike-btn" data-rid="<?= $v['recipeID'] ?>">
          <?php else: ?>
            <img src="img\icon\icons8-heart-96.png" alt="" class="like-btn" data-rid="<?= $v['recipeID'] ?>">
          <?php endif ?>
        </div>
      </div>
    </div>
  <?php if ($key%3 == 0 || $key == $Rs_length): ?>
    </div>
  <?php endif ?>
    <?php endforeach ?>
</div>
<?php endif ?>
<script>
  
  
</script>
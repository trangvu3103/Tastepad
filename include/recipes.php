<?php
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$recipe = new Recipe;
$recipes = $recipe->getAllRecipesFromNRows();
if ($recipes):
 $Rs_length = count($recipes);
  ?>
<div class="col-lg-9 recipe-ls ls">
  <?php foreach ($recipes as $key =>$recipe):?>
    <?php if ($key%3 == 1): ?>
      <div class="row">
    <?php endif ?>
    <div class="col-md-4 recipe-card" data-href="<?= $recipe['recipeID'] ?>">
      <div class="descrip">
        <?php if ($recipe['recipeImageDestination']): ?>
          <img src="<?= getImgHP($recipe['recipeImageDestination'][0]) ?>" alt="recipe-thumbnail">
        <?php else: ?>
          <img src="<?= root ?>img\food\f7a6771a03e0dfff2fa2c82c95dd9baf.jpg" alt="">
        <?php endif ?>
        <div class="descrip-txt">
          <div><?= readmore($recipe['recipeDes']) ?></div>
        </div>
      </div>
      <h2><?= readmore($recipe['recipeName'],50) ?></h2>
      <div class="info">
        <div class="author">
          <?php if ($recipe['userAvatar']): ?>
            <img src="#" alt="recipe-thumbnail">
          <?php else: ?>
            <img src="<?= root ?>img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
          <?php endif ?>
          <div><?= $recipe['userName'] ?></div>
        </div>
        <div class="like">
          <div class="likeNum"><?php echo restyle_text($recipe['recipeLiked']); ?></div>
          <?php if ($recipe['recipeLiked']!=0 && $recipe['checkUserLiked']): ?>
            <img src="img\icon\closer.png" alt="" class="dislike-btn" data-rid="<?= $recipe['recipeID'] ?>">
          <?php else: ?>
            <img src="img\icon\icons8-heart-96.png" alt="" class="like-btn" data-rid="<?= $recipe['recipeID'] ?>">
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
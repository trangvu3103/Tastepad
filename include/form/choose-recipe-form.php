<?php 

foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$recipe = new Recipe;
$contest = new Contest;
$member = new Member;

if (isset($_SESSION['isLoggin'])&& $_SESSION['isLoggin']) {
  $recipes = $member->getRecipesByUIDForCID($_SESSION['uid']);
}

 ?>

<section id="choose-recipe-form">
  <div class="wrapper">
    <div class="choose-header">
      <div class="">
        Chose your recipe
      </div>
      <img src="img\icon\closer.png" alt="" id="choose-recipe-closer">
    </div>
    <div class="choose-new">
      <div class="">
        Or create a new one here
      </div>
      <button type="button" name="new-recipe">New recipe</button>
    </div>
    <div class="choose-recipe-ls">
      <div class="header-tag">
        Your recipe
      </div>
      <div class="choose-recipe-wrapper">
        <?php 
        if ($recipes!=-1):
          foreach ($recipes as $k => $v):
        ?>
        <?php if($k%2==0): ?>
        <div class="row">
        <?php endif; ?>
          <div class="col-sm-6 recipe-card recipe-card-btn" data-rid="<?= $v['recipeID'] ?>">
            <div class="descrip">
              <?php if ($v['recipeImageDestination']): ?>
                <img src="<?= '../'.getImgHP($v['recipeImageDestination']) ?>" alt="recipe-thumbnail">
              <?php else: ?>
                <img src="<?= base_url() ?>\img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
              <?php endif;?>
              <div class="descrip-txt">
                <div><?= readmore($v['recipeDes']) ?></div>
              </div>
            </div>
            <h2><?= readmore($v['recipeName'],50) ?></h2>
            <div class="info">
              <div class="author">
                <img src="img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
                <div>Emmily</div>
              </div>
              <div class="like">
                <div class="likeNum"><?php echo restyle_text($v['recipeLiked']); ?></div>
                <?php if ($v['recipeLiked']!=0 && $v['checkUserLiked']): ?>
                  <img src="<?= base_url() ?>\img\icon\closer.png" alt="" class="dislike-btn" data-rid="<?= $v['recipeID'] ?>">
                <?php else: ?>
                  <img src="<?= base_url() ?>\img\icon\icons8-heart-96.png" alt="" class="like-btn" data-rid="<?= $v['recipeID'] ?>">
                <?php endif ?>
              </div>
            </div>
          </div>
        <?php if($k%2==1||$k==(count($recipes)-1)): ?>
        </div>
        <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
      </div>
    </div>
  </div>
  <form action="" method="POST" id="choose-rid-form" class="d-none">
    <div class="form-group">
      <input name="rid" type="hidden" class="form-control" id="rid" value=0>
      <button type="submit" name="choose-rid"></button>
    </div>
  </form>
</section>

<?php include 'include/header.php'; ?>
<?php 
if (isset($_GET['rid'])):
  $rid = $_GET['rid'];
  $recipe = new Recipe;

  if (isset($_POST['cmt'])) {
    if (empty($member)) {
      $member = new Member;
      $member->comment($rid, $_POST['uid'], $_POST['comment']);
    }

  }

  //GET RECIPE BY RECIPE ID
  $recipes = $recipe->findRecipeByID($rid);
  //CHEFCK FOR AVAIlABLE RECIPE DETAILS
  if($recipes):
    $Rinfo = $recipe->getRecipeByID($rid);
 ?>
<section id="detail-sec">
  <div class="row">
    <div class="col-lg-5">
      <h1><?php echo $Rinfo["Name"]; ?></h1>
      <div class="author">
        <?php if (isset($Rinfo["avatar"]) && $Rinfo["avatar"]):?>
          <img src="<?php echo '../'.getImgHP($Rinfo["avatar"]); ?>" alt="">
        <?php else:?>
          <img src="<?php echo root; ?>img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
        <?php endif; ?>
        <div><a href="./user/<?php echo $Rinfo['AID']; ?>"> <?= $Rinfo["author"] ?></a></div>
      </div>
      <div class="short-des">
        <?php echo $Rinfo['Des']; ?>
      </div>
      <div class="like">
        <div><?php echo restyle_text($Rinfo['liked']); ?></div>
          <img src="<?php echo root; ?>img\icon\icons8-heart-96.png" alt="">
      </div>
    </div>
    <div class="col-lg-7 recipe-img">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <?php if ($Rinfo['imgs']): ?>
            <?php foreach ($Rinfo['imgs'] as $k => $v):?>
              <div class="carousel-item <?php echo ($k==0)?'active':'' ?>">
                <img src="<?= '../'.getImgHP($v['recipeImageDestination']) ?>" alt="First slide">
              </div>
            <?php endforeach ?>
          <?php else: ?>
            <div class="carousel-item active">
              <img src="img\food\magical-green-falafels-15.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img src="img\food\magical-green-falafels-15.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img src="img\food\magical-green-falafels-15.jpg" alt="Third slide">
            </div>
          <?php endif ?>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 ingre">
      <div>Ingredients</div>
      <?php if(isset($Rinfo["ingredients"]) && $Rinfo["ingredients"]): ?>
        <ul>
          <?php foreach ($Rinfo["ingredients"] as $ingredients): ?>
            <li><?php echo $ingredients; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>404 No Ingredient found!</p>
      <?php endif; ?>
    </div>
    <div class="col-lg-9 cook ls">
      <div>Cooking</div>
      <?php if(isset($Rinfo["steps"]) && $Rinfo["steps"]): ?>
          <?php 
          // $stepID =0;
          foreach ($Rinfo["steps"] as $key => $steps):?>
            <div class="step">
              <div class="step-img">
                <div>Step <?php echo $steps['stepID']; ?></div>
                <div><?php echo $steps['stepDes']; ?></div>
                <?php if ($steps['stepImageDestination']): ?>
                  <?php foreach ($steps['stepImageDestination'] as $v): ?>
                    <img src="<?= '../'.getImgHP($v) ?>" alt="">
                    
                  <?php endforeach ?>
                <?php endif ?>
              </div>
            </div>
          <?php endforeach; ?>
      <?php else: ?>
        <p>404 No Steps-by-steps found!</p>
      <?php endif; ?>
      <!-- <div class="step">
        <div>Step 1</div>
        <div>Place the chickpeas and broad beans in a large bowl with the baking soda. Cover with water and let soak overnight.</div>
        <div class="step-img">
          <img src="img\food\magical-green-falafels-7.jpg" alt="">
          <img src="img\food\magical-green-falafels-7.jpg" alt="">
        </div>
      </div>
      <div class="step">
        <div>Step 2</div>
        <div>Place the chickpeas and broad beans in a large bowl with the baking soda. Cover with water and let soak overnight.</div>
        <div class="step-img">
          <img src="img\food\magical-green-falafels-7.jpg" alt="">
          <img src="img\food\magical-green-falafels-7.jpg" alt="">
        </div>
      </div>
      <div class="step">
        <div>Step 3</div>
        <div>Place the chickpeas and broad beans in a large bowl with the baking soda. Cover with water and let soak overnight.</div>
        <div class="step-img">
          <img src="img\food\magical-green-falafels-7.jpg" alt="">
          <img src="img\food\magical-green-falafels-7.jpg" alt="">
        </div>
      </div> -->
    </div>
  </div>
</section>

<section id="comment-sec">
  <div class="cmt-head">
    Comments
  </div>
  <!-- comment form -->
  <div class="comment-form">
    <div class="author">
      <?php if (isset($Rinfo["avatar"]) && $Rinfo["avatar"]):?>
          <img src="<?php echo $Rinfo["avatar"]; ?>" alt="">
        <?php else:?>
          <img src="<?php echo root; ?>img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
        <?php endif; ?>
      <div><?= $Rinfo["author"]; ?></div>
    </div>
    <form action="" method="POST">
      <div class="form-group">
        <input type="text" class="d-none" value="<?php echo $_SESSION['uid'] ?>" name="uid">
      </div>
      <div class="form-group">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Let's share your thought!" name="comment"></textarea>
      </div>
      <button type="submit" name="cmt">Comment now</button>
    </form>
  </div>
  <!-- /comment form -->
  
  <div class="comments">
    <?php if(isset($Rinfo["comments"]) && $Rinfo["comments"]): ?>
        <?php foreach ($Rinfo["comments"] as $comment): ?>
          <div class="cmt">
            <div class="author">
              <?php if ($comment["userAvatar"]):?>
                <img src="<?= $comment["userAvatar"]; ?>" alt="">
              <?php else: ?>
                <img src="<?= root ?>img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
              <?php endif; ?>
              <div><a href="./user/<?= $comment['userID']; ?>"><?= $comment['name'] ?></a></div>
            </div>
            <div class="comment-txt">
              <?= $comment['userComment'] ?>
            </div>
          </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
    <div class="btn-show-more">
      <button type="button" name="button" id="show-more">Show more</button>
    </div>
  </div>

</section>
<?php 
  else:
    echo '404 not found';
  endif;
else:
  echo '404 not found';
endif;
 ?>
<?php include 'include/footer.php'; ?>

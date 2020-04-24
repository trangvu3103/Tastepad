<?php include 'include/header.php'; ?>
<?php 
if (isset($_SESSION)&&!empty($_SESSION)&&isset($_GET['cid'])):
  $cid = $_GET['cid'];
  $recipe = new Recipe;
  $contest = new Contest;

  $rowperpage = 12;
  $total_count = $recipe->getTotalNumPagesInCID($cid,$rowperpage);

  if (isset($_POST['rid'])&&$_POST['rid']) {
    if (!isset($member)) {
      $member = new Member;
    }
    $join = $member->joinContest($_POST['rid'],$_GET['cid'],$_SESSION['uid']);
  }
  //GET RECIPE BY RECIPE ID
  $contests = $contest->findContestByID($cid);
  //CHEFCK FOR AVAIlABLE RECIPE DETAILS
  if($contests):
    $Cinfo = $contest->getContestByCID($cid,$rowperpage);
 ?>
<?php include 'include/form/choose-recipe-form.php'; ?>
<section id="contest-details-sec">
  <div class="row">
    <div class="col-lg-7 contest-banner">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <?php if ($Cinfo['contestImages']): ?>
          <?php foreach ($Cinfo['contestImages'] as $k => $v): ?>
            <div class="carousel-item  <?php echo ($k==0)?'active':'' ?>">
              <img src="<?= '../'.getImgHP($v['imgDes']) ?>" alt="First slide">
            </div>
          <?php endforeach ?>
          <?php else: ?>
            <div class="carousel-item active">
              <img src="img\restaurant\Hyatt-hotels_-_Andaz-amsterdam-prinsengracht_-_10_web.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img src="img\restaurant\Hyatt-hotels_-_Andaz-amsterdam-prinsengracht_-_10_web.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img src="img\restaurant\Hyatt-hotels_-_Andaz-amsterdam-prinsengracht_-_10_web.jpg" alt="Third slide">
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
    <div class="col-lg-5 contest-des">
      <h1><?php echo $Cinfo["contestName"]; ?></h1>
      <div class="short-des">
        <?php echo $Cinfo["contestDes"]; ?>
      </div>
      <div class="info">
        <div class="date-part">
          <div>From: <?= date('j M Y',strtotime($Cinfo["startDate"]))?> - <?= date('j M Y',strtotime($Cinfo["endDate"]))?></div>
          <div>Place left for participants: <?php echo $Cinfo["contestMaxParticipants"]; ?></div>
        </div>
        <div class="sent">
          <button type="button" name="button" id="sent-recipe">Sent your recipe now</button>
        </div>
      </div>
    </div>
  </div>
  <div class="contest-rules">
    <div>Contest's rules</div>
    <div>
      <?php echo $Cinfo["contestRule"]; ?>
    </div>
  </div>
</section>

<section id="contest-recipe-sec">
  <div class="head-tag">
    Participate recipes
  </div>
  <?php if ($Cinfo['Recipes']):?>
    <?php foreach ($Cinfo['Recipes'] as $k => $v): ?>
      <?php if ($k%4==0): ?>
        <div class="row">
      <?php endif ?>
      <?php 
      $rank ='';
      if ($v['rank']==1) {
        $rank = 'top-1';
      }elseif ($v['rank']==2) {
        $rank = 'top-2';
      }elseif ($v['rank']==3) {
        $rank = 'top-3';
      } ?>
        <div class="col-lg-3 recipe-card <?php echo $rank; ?>" data-href="recipe\<?= $v['recipeID'] ?>">
          <div class="descrip">
            <?php if ($v['recipeImageDestination']): ?>
              <img src="<?= '../'.getImgHP($v['recipeImageDestination']) ?>" alt="First slide">
            <?php else: ?>
              <img src="..\img\food\f7a6771a03e0dfff2fa2c82c95dd9baf.jpg" alt="">
            <?php endif ?>
            <div class="descrip-txt">
              <div><?= readmore($v['recipeDes']) ?></div>
            </div>
          </div>
          <h2><?= readmore($v['recipeName'],50) ?></h2>
          <div class="info">
            <div class="author">
              <?php if ($v['userAvatar']): ?>
                <img src="<?= '../'.getImgHP($v['userAvatar']) ?>" alt="First slide">
              <?php else: ?>
                <img src="..\img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
              <?php endif ?>
              <div><?= $v['userName'] ?></div>
            </div>
            <div class="like">
              <div><?php echo restyle_text($v['recipeVote']); ?></div>
              <img src="..\img\icon\icons8-heart-96.png" alt="">
            </div>
          </div>
        </div>
      <?php if ($k%4==3||$k==count($Cinfo['Recipes'])-1): ?>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  <?php else: ?>
    
  <?php endif ?>
  <div class="btn-show-more">
    <button type="button" name="button" id="show-more" data-val="0">Show more</button>
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

<?php
foreach (glob($_SERVER['DOCUMENT_ROOT']."/Tastepad/class/*.php") as $filename)
{
    include_once $filename;
}

$contest = new contest;

//Display post
$rowperpage = 12;

$row = 0;
 if(isset($_GET['pageno'])){
  $row = $_GET['pageno']-1;
  if($row < 0){
   $row = 0;
  }
 }

$total_count = $contest->getTotalNumPages($rowperpage);
// selecting rows
$offset = $row*$rowperpage;

$contests = $contest->getAllContestFromNRows();
if ($contests):
 $Cs_length = count($contests);
  ?>
<div class="col-lg-9 recipe-ls ls">
  <?php foreach ($contests as $k => $v): ?>
    <?php if ($k%2==0): ?>
      <div class="row">
    <?php endif ?>
      <div class="col-md-6 contest-card" data-href="contest\<?= $v['contestID'] ?>">
        <div class="descrip">
          <?php if ($v['banner']): ?>
            <img src="<?= getImgHP($v['banner']) ?>" alt="">
          <?php else: ?>
            <img src="img\restaurant\Hyatt-hotels_-_Andaz-amsterdam-prinsengracht_-_10_web.jpg" alt="">
          <?php endif ?>
          <div class="descrip-txt">
            <div><?= readmore($v['contestDes']) ?></div>
          </div>
        </div>
        <h2><?= readmore($v['contestName']) ?></h2>
        <div class="date">
          From: <?= date('j M Y',strtotime($v["startDate"]))?> - <?= date('j M Y',strtotime($v["endDate"]))?>
        </div>
      </div>
    <?php if ($k%2==1||$k == $Cs_length-1): ?>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>
<?php endif ?>
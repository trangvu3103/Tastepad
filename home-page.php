<?php include 'include/header.php'; ?>

<section id="banner-sec">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img src="img/restaurant/Hyatt-hotels_-_Andaz-amsterdam-prinsengracht_-_10_web.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img src="img/restaurant/philadelphia-restaurants_walnut-street-cafe.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img src="img/restaurant/TodaysBrew-conservatorium_lounge0139-Advanced-v3-1024x768.jpg" alt="Third slide">
      </div>
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
</section>

<section id="ls-sec">
  <div class="header-ls">
    <div class="cate-tag">
      Categories
    </div>
    <div class="sort">
      <div class="">
        Sort by:
      </div>
      <div class="dropdown">
        <button class="btn-secondary dropdown-toggle" type="button" id="sort-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Most popular
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item sort-option" href="#">Newest</a>
          <a class="dropdown-item sort-option" href="#">Oldest</a>
          <a class="dropdown-item sort-option" href="#">Most popular</a>
        </div>
      </div>
    </div>
  </div>
  <div class="list">
    <div class="row">
      <div class="col-lg-3">
        <div class="categories">
          <div class="head-cate">
            <a href="home-page">Recipe</a>
            <ul>
              <li><a href="breakfast">Breakfast</a></li>
              <li><a href="brunch">Brunch</a></li>
              <li><a href="lunch">Lunch</a></li>
              <li><a href="dinner">Dinner</a></li>
            </ul>
          </div>
          <div class="head-cate">
            <a href="contest">Contest</a>
          </div>
          <div class="head-cate">
            <a href="news">News</a>
          </div>
        </div>
      </div>
      <!-- recipe list, contest list -->
      <?php //include 'include\contests.php';
      ?>
      
      <?php 
      if (isset($_GET['page'])&&$_GET['page']=='contest') {
        include 'include\contests.php';
        
      }else{
        include 'include\recipes.php';

      }
       ?>

    </div>
    <div class="page">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php 
              // calculate total pages
              $total_pages = ceil($total_count / $rowperpage);
              $i = 1;$prev = 0;

              // Total number list show
              $numpages = 5;
              if ($total_pages>1) {
                
              // Set previous page number and start page 
               if(isset($_GET['next'])){
                $i = $_GET['next']+1;
                $prev = $_GET['next'] - ($numpages);
               }

               if($prev <= 0) $prev = 1;
               if($i == 0) $i=1;

               // Previous button next page number
                
                $prevnext = 0;
                if(isset($_GET['next'])){
                 $prevnext = ($_GET['next'])-($numpages+1);
                 if($prevnext < 0){
                  $prevnext = 0;
                 }
                }

               // Previous Button
                //<li class="page-item"><a class="page-link" href="#">Previous</a></li>
               echo '<li class="page-item"><a class="page-link" href="?pageno='.$prev.'&next='.$prevnext.'">Previous</a></li>';

               if($i != 1){
                echo '<li class="page-item"><a href="?pageno='.($i-1).'&next='.$_GET['next'].'"  class="page-link'; 
                if( ($i-1) == $_GET['pageno'] ){
                 echo " active";
                }
                echo '">'.($i-1).'</a></li>';
               }

               // Number List
               for ($shownum = 0; $i<=$total_pages; $i++,$shownum++) {
                if($i%($numpages+1) == 0){
                 break;
                }
               
                if(isset($_GET['next'])){ 
                 echo "<li class='page-item'><a class='page-link' href='?pageno=".$i."&next=".$_GET['next']."'";
                }else{
                 echo "<li class='page-item'><a href='?pageno=".$i."' class='page-link";
                }

                // Active
                if(isset($_GET['pageno'])){
                 if ($i==$_GET['pageno']) 
                  echo " active";
                 }
                 echo "'>".$i."</a></li> ";
                }

                // Set next button
                $next = $i+$rowperpage;
                if(($next*$rowperpage) > $total_count){
                 $next = ($next-$rowperpage)*$rowperpage;
                }

                // Next Button
                if( ($next-$rowperpage) < $total_count ){ 
                 if($shownum == ($numpages)){
                  echo '<li class="page-item"><a class="page-link" href="?pageno='.$i.'&next='.$i.'">Next</a></li>';
                 }
                }
              }
            ?>

          </ul>
        </nav>
    </div>
  </div>
</section>

<?php include 'include/footer.php'; ?>

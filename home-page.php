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

<section id="recipe-ls-sec">
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
</section>

<?php include 'include/footer.php'; ?>

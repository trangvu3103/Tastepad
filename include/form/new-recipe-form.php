<section id="recipe-form-sec">
  <form class="" action="index.html" method="post">
    <div class="row">
      <div class="col-lg-5">
        <div class="form-group">
          <input name="recipe-name" type="text" class="form-control" id="recipe-name" placeholder="Your recipe name here">
        </div>
        <div class="author"> <!-- change to current user -->
          <img src="img\user\4fefdd485947492156682910a86c385a.jpg" alt="">
          <div>Emmily</div>
        </div>
        <div class="form-group">
          <textarea class="form-control" id="short-description" rows="4" placeholder="Your short description"></textarea>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="form-group add-img"> <!-- add mutiple img -->
          <input name="recipe-img" type="file" class="form-control" id="" placeholder="Please choose your file" multiple>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 ingre">
        <div>Ingredients</div>
        <div class="form-group add-ingre"> <!-- add mutiple img -->
          <input name="ingre" type="text" class="form-control" id="" placeholder="What are the ingredients?">
          <button type="button" class="btn btn-remove-ingre">-</button>
        </div>
        <button type="button" class="btn btn-add-ingre">+</button>
      </div>
      <div class="col-lg-9 cook ls">
        <div>Cooking</div>
        <div class="step">
          <div>Step 1</div> <!-- auto load -->
          <div class="form-group"> <!-- add step -->
            <input name="step" type="text" class="form-control" id="" placeholder="What are the steps?">
          </div>
          <div class="step-img">
            <div class="form-group add-img"> <!-- add mutiple img -->
              <input name="recipe-img" type="file" class="form-control" id="" placeholder="Please choose your file" multiple>
            </div>
          </div>
          <button type="button" name="button" class="btn btn-remove-step">-</button>
        </div>
        <button type="button" name="button" class="btn btn-more-step">More step</button>
      </div>
    </div>
    <div class="post-btn">
      <button type="button" name="button">Post now!</button>
    </div>
  </form>
</section>

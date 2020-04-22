<section id="new-contest-form">
  <form class="" action="index.html" method="post">
    <div class="row">
      <div class="col-lg-7">
        <div class="form-group">
          <label for="">Contest images</label>
          <input name="contest-img" type="file" class="form-control" id="contest-img" multiple>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="form-group">
          <label for="">Contest name</label>
          <input name="contest-name" type="text" class="form-control" id="contest-name" placeholder="Your contest name here">
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <textarea class="form-control" id="short-description" rows="4" placeholder="Your short description"></textarea>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="start-date">Start date</label>
              <input name="start-date" type="date" class="form-control" id="start-date">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="end-date">End date</label>
              <input name="end-date" type="date" class="form-control" id="end-date">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="contest-rules">
      <div class="form-group">
        <label for="">Contest's rules</label>
        <textarea class="form-control" id="Contest-rules" rows="4" placeholder="Contest's rules"></textarea>
      </div>
    </div>
    <div class="open-btn">
      <button type="button" name="button">Open now!</button>
    </div>
  </form>
</section>

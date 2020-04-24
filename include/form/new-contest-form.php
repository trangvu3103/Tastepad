<section id="new-contest-form">
  <form class="" action="" method="post" enctype="multipart/form-data" >
    <div class="row">
      <div class="col-lg-7">
        <div class="form-group">
          <label for="">Contest images</label>
          <input name="contest-img[]" type="file" class="form-control" id="contest-img" multiple>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="form-group">
          <label for="">Contest name</label>
          <input name="name" type="text" class="form-control" id="contest-name" placeholder="Your contest name here">
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" class="form-control" id="short-description" rows="4" placeholder="Your short description"></textarea>
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
        <div class="form-group">
          <label for="">Participance:</label>
          <input name="paricipance" type="text" class="form-control" id="contest-participant" placeholder="Paricipant number limited">
        </div>
      </div>
    </div>
    <div class="contest-rules">
      <div class="form-group">
        <label for="">Contest's rules</label>
        <textarea name="rule" class="form-control" id="Contest-rules" rows="4" placeholder="Contest's rules"></textarea>
      </div>
    </div>
    <div class="open-btn">
      <button type="submit" name="openContest">Open now!</button>
    </div>
  </form>
</section>

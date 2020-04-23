$(document).ready(function() {
  $(".btn-add-ingre").click(function () {
    let ingre = '<div class="form-group add-ingre">';
    ingre += '<input name="ingre" type="text" class="form-control" id="" placeholder="What are the ingredients?">';
    ingre += '<button type="button" class="btn btn-remove-ingre">-</button>';
    ingre += '</div>';
    $(this).before(ingre);
  });
  $(document).on('click', '.btn-remove-ingre', function () {
      $(this).closest('.add-ingre').remove();
  });

  $(".btn-more-step").click(function () {
    var stepNo = $('.step').length;
    console.log(stepNo);
    let step = '<div class="step">';
    step += '<div>Step '+ (stepNo + 1) +'</div>';
    step += '<div class="form-group">';
    step += '<input name="step" type="text" class="form-control" id="" placeholder="What are the steps?">';
    step += '</div>';
    step += '<div class="step-img">';
    step += '<div class="form-group add-img">';
    step += '<input name="recipe-img" type="file" class="form-control" id="" placeholder="Please choose your file" multiple>';
    step += '</div>';
    step += '</div>';
    step += '<button type="button" name="button" class="btn btn-remove-step">-</button>';
    step += '</div>';
    $(this).before(step);
  });

  $(document).on('click', '.btn-remove-step', function () {
      $(this).closest('.step').remove();
  });

  $('#choose-recipe-form').hide();
  $('#choose-recipe-closer').click(function () {
    $("#choose-recipe-form").fadeOut();
  });
  $('#sent-recipe').click(function () {
    $("#choose-recipe-form").fadeIn();
  });
  $('.choose-recipe-wrapper').find('.recipe-card').click(function () {
    $("#choose-recipe-form").fadeOut();
  });

  $('.like').find('img').click(function () {
    var src = $(this).attr("src");
    if (src == "img\\icon\\closer.png") {
      $(this).attr('src', "img\\icon\\icons8-heart-96.png");
    } else {
      $(this).attr('src', "img\\icon\\closer.png");
    }
  });

})

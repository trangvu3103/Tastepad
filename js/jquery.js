$(document).ready(function() {
  $(".btn-add-ingre").click(function () {
    let ingre = '<div class="form-group add-ingre">';
    ingre += '<input name="ingre[]" type="text" class="form-control" id="" placeholder="What are the ingredients?">';
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
    step += '<input name="step[]" type="text" class="form-control" id="" placeholder="What are the steps?">';
    step += '</div>';
    step += '<div class="step-img">';
    step += '<div class="form-group add-img">';
    step += '<input name="recipestepimg_'+ (stepNo + 1) +'[]" type="file" class="form-control" id="" placeholder="Please choose your file" multiple>';
    step += '</div>';
    step += '</div>';
    step += '<button type="button" name="button" class="btn btn-remove-step">-</button>';
    step += '</div>';
    $(this).before(step);
  });
  $(document).on('click', '.btn-remove-step', function () {
      $(this).closest('.step').remove();
      var stepNo = $('.step').length;
      $('.step').each(function(index, el) {
        $('.step [name^=recipestepimg').attr('name','recipestepimg'+(index+1)+'[]');
      });
  });
})

$(document).ready(function() {
//add more ingredients to recipe
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

//add more step to recipe
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

//toggle choose recipe form
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

//like and unlike
  $('.like').find('img').click(function () {
    var src = $(this).attr("src");
    var prefix = '';
    if (hasInHrefArr()) {
      prefix = '..\\';
    }
    console.log(src);
    var text = $(this).parent().find('.likeNum');
    var button = $(this);
    if (src == "img\\icon\\closer.png" || src == prefix+"img\\icon\\closer.png" ) {
      console.log(text);
      $.ajax({
          url: prefix+'ajax.php',
          type: 'POST',
          dataType:"JSON",
          data: {
           like:0,
           rid: $(this).data('rid'),
          },
       // async: false,
       success: function(data){
           console.log(data);
           if (data.err==0){
           // console.log($(this);
              text.text(data.mess);
             button.attr('src', prefix+"img\\icon\\icons8-heart-96.png");
           }
       }
      });
    } else {
      $.ajax({
          url: prefix+'ajax.php',
          type: 'POST',
          dataType:"JSON",
          data: {
           like:1,
           rid: $(this).data('rid'),
          },
       // async: false,
       success: function(data){
           console.log(data);
           if (data.err==0){
           console.log($(this).parent().find('.likeNum'));
           // console.log(data);
              text.text(data.mess);
              button.attr('src', prefix+"img\\icon\\closer.png");
           }
       },
       error: function(err) {
         console.log(err);
       }
      });
    }
  });

})

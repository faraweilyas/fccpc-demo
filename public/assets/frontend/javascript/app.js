$(document).ready(function () {
  $('#open_fee_calculator').click(function () {
    $('#fee__calculator').toggleClass('fee__calculator--active ')
    console.log('clicked')
  })

  $('#fee__calculator-btn').click(function () {
    $('#fee__calculator').toggleClass('fee__calculator--active ')
    console.log('clicked')
  })

  $(".like-article-section").on('click', function () {
     $("#feedback").val('yes');
     $("#feedback-form").submit();
  });

  $(".unlike-article-section").on('click', function () {
     $("#feedback").val('no');
     $("#feedback-form").submit();
  });

  $('[id^=control]').each(function (index, el) {
    $(this).click(function () {
      $('#control-1').removeClass('card__box-stack-active')
      $('#control-2').removeClass('card__box-stack-active')
      $('#control-3').removeClass('card__box-stack-active')
      $('#control-4').removeClass('card__box-stack-active')

      if ($(this).attr('id') === 'control-1') {
        $('#contact').hide()
        $('#documents').hide()
        $(this).addClass('card__box-stack-active')
        $('#applications').toggle('fast')
      }
      if ($(this).attr('id') === 'control-2') {
        $('#applications').hide()
        $('#documents').hide()
        $(this).addClass('card__box-stack-active')
        $('#contact').toggle('fast')
      }
      if ($(this).attr('id') === 'control-3') {
        $('#applications').hide()
        $('#documents').hide()
        $(this).addClass('card__box-stack-active')
        $('#contact').toggle('fast')
      }
      if ($(this).attr('id') === 'control-4') {
        $('#applications').hide()
        $('#documents').hide()
        $(this).addClass('card__box-stack-active')
        $('#contact').toggle('fast')
      }
    })
  })
});
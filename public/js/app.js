import $ from 'jquery';
window.jQuery = $;
window.$ = $;
import slick_carousel from 'slick-carousel';
require('../libs/fancybox-master/dist/jquery.fancybox.min.js');
require('../libs/selectize.js-master/dist/js/standalone/selectize.min.js');
require('../libs/drag-drop-upload/dist/jquery-simple-upload.js');
import moment from 'moment';

require('../libs/daterangepicker-master/daterangepicker.js');








document.addEventListener('DOMContentLoaded', () => {

  $('.header__location__current, .select_city-js').on('click', function(event) {
    event.preventDefault();
    $('.location_popup').slideToggle()
  });

  $('.location_popup__close').on('click', function(event) {
    event.preventDefault();
    $('.location_popup').slideUp()
  });

  $('.select').selectize({
    create: false,
    placeholder: $(this).data('placeholder')
  })


  $('.header__nav_catalog>ul>li>ul>li').on('mouseenter', function(event) {
    let mh = $(this).find('ul').height();
    $(this).closest('ul').css('min-height', mh + 25)
  });

  $('.home_catalog__nav__btn').on('click', function(event) {
    event.preventDefault();
    if ($(this).hasClass('active')) { return; }
    let tab = $(this).data('tab');
    $('.home_catalog__nav__btn').removeClass('active');
    $(this).addClass('active');
    $('.home_catalog__list').hide();
    $('.home_catalog__list[data-tab="' + tab + '"]').fadeIn();
  });

  $('.header__bars').on('click', function(event) {
    $(this).toggleClass('active');
    $('.header__nav').slideToggle();
    $('body').toggleClass('is-modal');
  });

  $('.catalog-itm>a').on('click', function(event) {
    if ($(window).innerWidth() < 992) {
      event.preventDefault();
      $('.header__nav_catalog').slideToggle();
    }
  });

  $('.header__nav_catalog>ul>li>a, .header__nav_catalog>ul>li>ul>li>a').on('click', function(event) {
    if ($(window).innerWidth() < 992) {
      event.preventDefault();
      $(this).siblings('ul').slideToggle();
      $(this).closest('li').siblings('li').find('ul').slideUp();
    }
  });


  $('.catalog__filter .toggle_filter_btn').on('click', function(event) {
    event.preventDefault();
    let $this = $(this),
      activetext = $this.attr('toggle-text'),
      text = $this.text();
    $this.attr("toggle-text", text);
    $this.text(activetext);
    $this.closest('.catalog__filter').toggleClass('active');
  });

  $('.catalog__header .sort_price__btn').on('click', function(event) {
    $(this).siblings('.sort_price__btn').removeClass('active')
    $(this).addClass('active');
  });

  $('.catalog__header .btn_catalog_display').on('click', function(event) {
    $(this).siblings('.btn_catalog_display').removeClass('active')
    $(this).addClass('active');
    $('.catalog__list').toggleClass('catalog__list-grid');
    $('.catalog__list .shortcard').toggleClass('shortcard-short');
  });

  $('.catalog__filter_toggle_btn').on('click', function(event) {
    event.preventDefault();
    $('.catalog__filter').slideToggle()
  });





  $('.docs__slider').slick({
    slidesToShow: 4,
    infinite: false,
    nextArrow: '<button type="button" class="slick-arrow slick-next"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"><path fill="currentColor" d="M13.835,11.258 C14.236,10.878 14.869,10.894 15.249,11.295 C15.629,11.695 15.613,12.328 15.213,12.708 C15.197,12.724 15.180,12.738 15.163,12.752 L10.663,16.752 C10.263,17.133 9.630,17.116 9.249,16.716 C8.869,16.316 8.885,15.683 9.286,15.302 C9.302,15.287 9.318,15.273 9.335,15.258 L13.835,11.258 ZM14.585,7.993 L9.292,2.700 C8.895,2.316 8.884,1.683 9.268,1.286 C9.651,0.889 10.284,0.878 10.682,1.262 C10.690,1.270 10.698,1.278 10.706,1.286 L17.706,8.286 C18.336,8.916 17.890,9.993 16.999,9.993 L0.999,9.993 C0.447,9.993 -0.001,9.545 -0.001,8.993 C-0.001,8.441 0.447,7.993 0.999,7.993 L14.585,7.993 Z"/></svg></button>',
    prevArrow: '<button type="button" class="slick-arrow slick-prev"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="17px"><path  fill="currentColor" d="M8.336,0.315 C8.736,-0.066 9.369,-0.049 9.750,0.351 C10.130,0.751 10.114,1.384 9.713,1.765 C9.697,1.780 9.681,1.795 9.664,1.809 L5.164,5.809 C4.739,6.162 4.109,6.104 3.756,5.679 C3.419,5.274 3.454,4.677 3.836,4.315 L8.336,0.315 ZM4.414,9.040 L9.707,14.333 C10.091,14.730 10.080,15.363 9.682,15.747 C9.295,16.121 8.680,16.121 8.293,15.747 L1.293,8.747 C0.663,8.117 1.109,7.040 2.000,7.040 L18.000,7.040 C18.552,7.040 19.000,7.487 19.000,8.040 C19.000,8.592 18.552,9.040 18.000,9.040 L4.414,9.040 Z"/></svg></button>',
    responsive: [{
      breakpoint: 992,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '60px',
      }
    }]
  })

  $('.slick-slide:not(.slick-cloned) [data-fancybox]').fancybox({
    animationEffect: "fade",
    loop: true
  })

  // $('#basic').simpleUpload({
  //   dropZone: '#basic_drop_zone',
  //   progress: '#basic_progress',
    // url: 'uploadfile.php',
    // method: 'post',
    // ajax: {
    //   dataType: 'application/json',
    //   timeout: 0,
    //   async: true
    // }
  // })



  $('.card__preview__slider').slick({
    fade: true,
    draggable: false,
    arrows: false
  })

  $('.card__preview__nav').each(function(index, el) {
    $(el).find('.card__preview__nav__slide').first().addClass('active');
  });

  $('.card__preview__nav').slick({
    slidesToShow: 3,
    vertical: true,
    arrows: false,
    draggable: false,
    infinite: false,
    selectOnFocus: true,
    responsive: [{
      breakpoint: 992,
      settings: {
        vertical: false
      }
    }]
  })


  $('.card__preview__nav__slide').on('click', function(event) {
    let $currenrSlickSlide = $(this).closest('.slick-slide'),
      $parent = $(this).closest('.card__preview__nav');
    $parent.find('.card__preview__nav__slide.active').removeClass('active')
    $(this).addClass('active');
    $parent.closest('.card__preview').find('.card__preview__slider').slick('slickGoTo', $currenrSlickSlide.data('slick-index'))
    if ($parent.find('.slick-slide.slick-active').first().is($currenrSlickSlide)) {
      $parent.slick('slickPrev')
    }
    if ($parent.find('.slick-slide.slick-active').last().is($currenrSlickSlide)) {
      $parent.slick('slickNext')
    }
  });





  $('.rated_products__slider').slick({
    slidesToShow: 2,
    nextArrow: '<button type="button" class="slick-arrow slick-next"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"><path fill="currentColor" d="M13.835,11.258 C14.236,10.878 14.869,10.894 15.249,11.295 C15.629,11.695 15.613,12.328 15.213,12.708 C15.197,12.724 15.180,12.738 15.163,12.752 L10.663,16.752 C10.263,17.133 9.630,17.116 9.249,16.716 C8.869,16.316 8.885,15.683 9.286,15.302 C9.302,15.287 9.318,15.273 9.335,15.258 L13.835,11.258 ZM14.585,7.993 L9.292,2.700 C8.895,2.316 8.884,1.683 9.268,1.286 C9.651,0.889 10.284,0.878 10.682,1.262 C10.690,1.270 10.698,1.278 10.706,1.286 L17.706,8.286 C18.336,8.916 17.890,9.993 16.999,9.993 L0.999,9.993 C0.447,9.993 -0.001,9.545 -0.001,8.993 C-0.001,8.441 0.447,7.993 0.999,7.993 L14.585,7.993 Z"/></svg></button>',
    prevArrow: '<button type="button" class="slick-arrow slick-prev"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="17px"><path  fill="currentColor" d="M8.336,0.315 C8.736,-0.066 9.369,-0.049 9.750,0.351 C10.130,0.751 10.114,1.384 9.713,1.765 C9.697,1.780 9.681,1.795 9.664,1.809 L5.164,5.809 C4.739,6.162 4.109,6.104 3.756,5.679 C3.419,5.274 3.454,4.677 3.836,4.315 L8.336,0.315 ZM4.414,9.040 L9.707,14.333 C10.091,14.730 10.080,15.363 9.682,15.747 C9.295,16.121 8.680,16.121 8.293,15.747 L1.293,8.747 C0.663,8.117 1.109,7.040 2.000,7.040 L18.000,7.040 C18.552,7.040 19.000,7.487 19.000,8.040 C19.000,8.592 18.552,9.040 18.000,9.040 L4.414,9.040 Z"/></svg></button>',
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }]
  })



  $('#datepicker_from').length && $('#datepicker_from').daterangepicker({
    "singleDatePicker": true,
    "autoApply": true,
    "locale": {
      "format": "от MM/DD/YYYY",
      "separator": " - ",
      "applyLabel": "Apply",
      "cancelLabel": "Cancel",
      "fromLabel": "From",
      "toLabel": "To",
      "customRangeLabel": "Custom",
      "weekLabel": "W",
      "daysOfWeek": ["ВС","ПН","ВТ","СР","ЧЕ","ПТ","СБ"],
      "monthNames": ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
      "firstDay": 1
    },
  });



  $('#datepicker_to').length && $('#datepicker_to').daterangepicker({
    "singleDatePicker": true,
    "autoApply": true,
    "locale": {
      "format": "до MM/DD/YYYY",
      "separator": " - ",
      "applyLabel": "Apply",
      "cancelLabel": "Cancel",
      "fromLabel": "From",
      "toLabel": "To",
      "customRangeLabel": "Custom",
      "weekLabel": "W",
      "daysOfWeek": ["ВС","ПН","ВТ","СР","ЧЕ","ПТ","СБ"],
      "monthNames": ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
      "firstDay": 1
    },
  });



  $('.personal_data .person_type input[type="radio"]').on('change', function(event) {
    event.preventDefault();
    setTimeout(function() {
      let tab = $('.personal_data .person_type input[type="radio"]:checked').data('tab');
      if (tab == "2") {
        $('.personal_data [data-tab="2"]').show();
      }else{
        $('.personal_data [data-tab="2"]').hide();
      }
    }, 100)
  });


  $.fancybox.defaults.closeExisting = true;
  $.fancybox.defaults.autoFocus = false;


  function gen_password(len){
    var password = "";
    var symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < len; i++){
        password += symbols.charAt(Math.floor(Math.random() * symbols.length));     
    }
    return password;
  }


  $('.generate_pass_btn-js').on('click', function(event) {
    event.preventDefault();
    $('.generate_pass_input-js').val(gen_password(6))
  });




  $('.cnt_block__input').on('blur', function(event) {
    let val = parseInt($(this).val());
    if (val < 1 || isNaN(val)) {
      $(this).val(1)
    } else {
      $(this).val(val)
    }
  });

  $('.cnt_block__btn').on('click', function(event) {
    let $parent = $(this).closest('.cnt_block'),
      $input = $parent.find('.cnt_block__input'),
      val = parseInt($input.val());

    if ($(this).hasClass('plus')) {
      $input.val(val + 1);
    } else {
      if (val != 1) {
        $input.val(val - 1);
      }
    }
    let ev = new Event('change');
    $parent[0].querySelector('.cnt_block__input').dispatchEvent(ev);
  });


  $('.cart__itm__remove_btn').on('click', function(event) {
    event.preventDefault();
    $(this).closest('.cart__itm').remove();
  });

})
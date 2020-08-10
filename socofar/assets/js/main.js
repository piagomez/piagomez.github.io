!(function($) {
  "use strict";

      AOS.init();

      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip()
        $('.collapse').collapse()
      });


      $('#datepicker').datepicker({
         uiLibrary: 'bootstrap4',
         iconsLibrary: 'fontawesome'
      });
      $('#datepicker2').datepicker({
         uiLibrary: 'bootstrap4',
         iconsLibrary: 'fontawesome'
      });

      var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#startDate').datepicker({
          uiLibrary: 'bootstrap4',
          iconsLibrary: 'fontawesome',
          minDate: today,
          maxDate: function () {
              return $('#endDate').val();
          }
      });
      $('#endDate').datepicker({
          uiLibrary: 'bootstrap4',
          iconsLibrary: 'fontawesome',
          minDate: function () {
              return $('#startDate').val();
          }
      });
      // Mobile Navigation
      if ($('.nav-menu').length) {
        var $mobile_nav = $('.nav-menu').clone().prop({
          class: 'mobile-nav d-md-none'
        });
        $('body').append($mobile_nav);
        $('body').prepend('<button type="button" class="mobile-nav-toggle d-md-none"><i class="fa fa-bars"></i></button>');
        $('body').append('<div class="mobile-nav-overly"></div>');

        $(document).on('click', '.mobile-nav-toggle', function(e) {
          $('body').toggleClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').toggle();
        });

        $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
          e.preventDefault();
          $(this).next().slideToggle(300);
          $(this).parent().toggleClass('active');
        });

        $(document).click(function(e) {
          var container = $(".mobile-nav, .mobile-nav-toggle");
          if (!container.is(e.target) && container.has(e.target).length === 0) {
            if ($('body').hasClass('mobile-nav-active')) {
              $('body').removeClass('mobile-nav-active');
              $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
              $('.mobile-nav-overly').fadeOut();
            }
          }
        });
      } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
        $(".mobile-nav, .mobile-nav-toggle").hide();
      }
})(jQuery);
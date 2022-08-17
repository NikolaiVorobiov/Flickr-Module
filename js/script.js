(function ($, Drupal) {
  "use strict";

  Drupal.behaviors.slick = {
    attach: function (context, settings) {

      $('.single-item').slick();

      $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
      });

    }
  };
})(jQuery, Drupal);

(function ($, Drupal) {
  "use strict";

  Drupal.behaviors.slick = {
    attach: function (context, settings) {

      $('.single-item').slick();

    }
  };

})(jQuery, Drupal);

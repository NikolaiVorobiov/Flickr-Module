<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\field\formatter\FlickrGalleryDefaultFormatter.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'gallery_default' formatter.
 *
 * @FieldFormatter(
 *   id = "gallery_slick",
 *   label = @Translation("Gallery Slick formatter"),
 *   field_types = {
 *     "gallery_id"
 *   }
 * )
 */
class FlickrGallerySlickFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $api_key = \Drupal::configFactory()->get('mp_flickr.adminsettings')->get('api_key');

    foreach ($items as $delta => $item) {

      $gallery_id = $item->gallery_id;
      $gallery = \Drupal::service('mp_flickr.custom_services')->getGallery($api_key, $gallery_id);

      // Render output using gallery-field-slick theme.
      $source = [
        '#theme' => 'gallery_field_slick',
        '#gallery_id' => $gallery_id,
        '#gallery' => $gallery,
      ];

      $elements[$delta] = [
        '#markup' => \Drupal::service('renderer')->render($source)
      ];
    }

    return $elements;
  }
}

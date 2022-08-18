<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\field\formatter\FlickrPhotoSlickFormatter.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'photo_slick' formatter.
 *
 * @FieldFormatter(
 *   id = "photo_slick",
 *   label = @Translation("Photo Slick formatter"),
 *   field_types = {
 *     "photo_id"
 *   }
 * )
 */
class FlickrPhotoSlickFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $api_key = \Drupal::configFactory()->get('mp_flickr.adminsettings')->get('api_key');

    foreach ($items as $delta => $item) {

      $photo_id = $item->photo_id;
      $photo = \Drupal::service('mp_flickr.custom_services')->getPhoto($api_key, $photo_id);

      // Render output using photo-field-slick theme.
      $source = [
        '#theme' => 'photo_field_slick',
        '#photo_id' => $photo_id,
        '#photo' => $photo,
      ];

      $elements[$delta] = [
        '#markup' => \Drupal::service('renderer')->render($source)
      ];
    }

    return $elements;
  }
}

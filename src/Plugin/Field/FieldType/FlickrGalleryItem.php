<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\Field\FieldType\FlickrGalleryItem.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'mp_flickr' field type.
 *
 * @FieldType(
 *   id = "gallery_id",
 *   label = @Translation("Flickr Gallery id Item"),
 *   description = @Translation("This field stores gallery id."),
 *   default_widget = "gallery_default",
 *   default_formatter = "gallery_default",
 *   slick_formatter = "gallery_slick"
 * )
 */
class FlickrGalleryItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field) {
    return [
      'columns' => [
        'gallery_id' => [
          'type' => 'text',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('gallery_id')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['gallery_id'] = DataDefinition::create('string')
      ->setLabel(t('Gallery_ID'));

    return $properties;
  }
}

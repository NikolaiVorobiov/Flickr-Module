<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\Field\FieldType\FlickrPhotoItem.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'mp_flickr' field type.
 *
 * @FieldType(
 *   id = "photo_id",
 *   label = @Translation("Flickr Photo id Item"),
 *   description = @Translation("This field stores photo id."),
 *   default_widget = "photo_default",
 *   default_formatter = "photo_default",
 *   slick_formatter = "photo_slick"
 * )
 */
class FlickrPhotoItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field) {
    return [
      'columns' => [
        'photo_id' => [
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
    $value = $this->get('photo_id')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['photo_id'] = DataDefinition::create('string')
      ->setLabel(t('Photo_ID'));

    return $properties;
  }
}

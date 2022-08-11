<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\Field\FieldWidget\FlickrPhotoDefaultWidget.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'photo_default' widget.
 *
 * @FieldWidget(
 *   id = "photo_default",
 *   label = @Translation("Photo default Widget"),
 *   field_types = {
 *     "photo_id"
 *   }
 * )
 */
class FlickrPhotoDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['photo_id'] = [
      '#title' => $this->t('Flickr Photo ID widget'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->photo_id) ? $items[$delta]->photo_id : NULL,
    ];

    return $element;
  }
}

<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\Field\FieldWidget\FlickrGalleryDefaultWidget.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'gallery_default' widget.
 *
 * @FieldWidget(
 *   id = "gallery_default",
 *   label = @Translation("Gallery default Widget"),
 *   field_types = {
 *     "gallery_id"
 *   }
 * )
 */
class FlickrGalleryDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['gallery_id'] = [
      '#title' => $this->t('Flickr Gallery ID widget'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->gallery_id) ? $items[$delta]->gallery_id : NULL,
    ];

    return $element;
  }
}

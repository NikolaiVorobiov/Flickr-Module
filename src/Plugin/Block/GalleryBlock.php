<?php

namespace Drupal\mp_flickr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Gallery' block.
 *
 * @Block(
 *   id = "mp_flickr_gallery_block",
 *   admin_label = @Translation("Gallery Block"),
 *   category = @Translation("MP Flickr Blocks"),
 * )
 */
class GalleryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $api_key = \Drupal::configFactory()->get('mp_flickr.adminsettings')->get('api_key');
    $gallery_id = $config['gallery_id'];
    $gallery = \Drupal::service('mp_flickr.custom_services')->getGallery($api_key, $gallery_id);

    $slick_check = $config['slick_check'];

    if ( $slick_check ) {
      $theme = 'gallery_slick';
    } else {
      $theme = 'gallery';
    }

    return [
      [
        '#theme' => $theme,
        '#gallery_id' =>  $gallery_id ?? '' ,
        '#api_key' =>  $api_key ?? '',
        '#gallery' => $gallery ?? '',
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state)  {
    $config = $this->getConfiguration();

    $form['gallery_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Insert gallery_id'),
      '#default_value' => $config['gallery_id'] ?? '',
      '#description' => $this->t('Description: Insert gallery_id'),
      '#required' => true,
    ];

    $form['slick_check'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Slick display '),
      '#default_value' => $config['slick_check'] ?? '',
      '#description' => $this->t('Description: Сheck this box for slick display'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->setConfigurationValue('gallery_id', $form_state->getValue('gallery_id'));
    $this->setConfigurationValue('slick_check', $form_state->getValue('slick_check'));
  }
}

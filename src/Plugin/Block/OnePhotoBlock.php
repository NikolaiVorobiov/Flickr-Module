<?php

namespace Drupal\mp_flickr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'one photo' block.
 *
 * @Block(
 *   id = "mp_flickr_one_photo_block",
 *   admin_label = @Translation("One Photo Block"),
 *   category = @Translation("MP Flickr Blocks"),
 * )
 */
class OnePhotoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $api_key = \Drupal::configFactory()->get('mp_flickr.adminsettings')->get('api_key');
    $photo_id = $config['photo_id'];
    $photo = \Drupal::service('mp_flickr.custom_services')->getPhoto($api_key, $photo_id);

    $slick_check = $config['slick_check'];

    if ( $slick_check ) {
      $theme = 'photo_slick';
    } else {
      $theme = 'photo';
    }

    return [
      [
        '#theme' => $theme,
        '#photo_id' =>  $photo_id ?? '' ,
        '#api_key' =>  $api_key ?? '',
        '#photo' => $photo ?? '',
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state)  {
    $config = $this->getConfiguration();

    $form['photo_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Insert photo_id'),
      '#default_value' => $config['photo_id'] ?? '',
      '#description' => $this->t('Description: Insert photo_id'),
      '#required' => true,
    ];

    $form['slick_check'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use slick display '),
      '#default_value' => $config['slick_check'] ?? '',
      '#description' => $this->t('Description: Сheck this box for slick display'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->setConfigurationValue('photo_id', $form_state->getValue('photo_id'));
    $this->setConfigurationValue('slick_check', $form_state->getValue('slick_check'));
  }
}

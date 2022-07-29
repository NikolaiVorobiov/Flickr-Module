<?php

namespace Drupal\mp_flickr\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines MP Flickr Photo Form.
 */
class FlickrPhotoForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mp_flickr_photo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Insert api_key'),
      '#description' => $this->t('Description: Insert api_key'),
      '#required' => true,
    ];

    $form['photo_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Insert photo_id'),
      '#description' => $this->t('Description: Insert photo_id'),
      '#required' => true,
    ];

//    $form['secret'] = [
//      '#type' => 'textfield',
//      '#title' => $this->t('Insert secret'),
//      '#description' => $this->t('Description: Insert secret'),
//    ];

//    $form['page'] = [
//      '#type' => 'textfield',
//      '#title' => $this->t('Insert page'),
//      '#description' => $this->t('Description: Insert page'),
//    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this
        ->t('Send form'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $api_key = $form_state->getValue('api_key');
    $photo_id = $form_state->getValue('photo_id');

    \Drupal::service('mp_flickr.custom_services')->getPhoto($api_key, $photo_id);

  }
}

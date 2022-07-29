<?php

namespace Drupal\mp_flickr\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines MP Flickr Gallery Form.
 */
class FlickrGalleryForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mp_flickr_gallery_form';
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

    $form['gallery_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Insert gallery_id'),
      '#description' => $this->t('Description: Insert gallery_id'),
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
    $gallery_id = $form_state->getValue('gallery_id');

    \Drupal::service('mp_flickr.custom_services')->getGallery($api_key, $gallery_id);

  }
}

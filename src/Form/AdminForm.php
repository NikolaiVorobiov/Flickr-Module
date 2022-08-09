<?php

/**
 * @file
 * Contains Drupal\mp_flickr\Form\AdminForm.
 */
namespace Drupal\mp_flickr\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AdminForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'mp_flickr.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mp_flickr_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mp_flickr.adminsettings');

    $form['api_key'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Input api_key'),
      '#description' => $this->t('Description: Input api_key'),
      '#default_value' => $config->get('api_key'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('mp_flickr.adminsettings')
      ->set('api_key', $form_state->getValue('api_key'))
      ->save();
  }
}

<?php

/**
 * @file
 * Contains \Drupal\mp_flickr\Plugin\field\formatter\FlickrPhotoSlickFormatter.
 */

namespace Drupal\mp_flickr\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\mp_flickr\CustomServices;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Field\FieldDefinitionInterface;

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
   * The Custom Services.
   *
   * @var \Drupal\mp_flickr\CustomServices
   */
  protected $customServices;

  /**
   * Config Factory Service Object.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a OnePhotoBlock object.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, CustomServices $customServices, ConfigFactoryInterface $configFactory) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);

    $this->customServices = $customServices;
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('mp_flickr.custom_services'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $api_key = $this->configFactory->get('mp_flickr.adminsettings')->get('api_key');

    foreach ($items as $delta => $item) {

      $photo_id = $item->photo_id;
      $photo = $this->customServices->getPhoto($api_key, $photo_id);

      // Render output using photo-field-slick theme.
      $source = [
        '#theme' => 'photo_slick',
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

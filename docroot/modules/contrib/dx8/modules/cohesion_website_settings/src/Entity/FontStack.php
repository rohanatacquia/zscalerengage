<?php

namespace Drupal\cohesion_website_settings\Entity;

use Drupal\cohesion\Entity\CohesionConfigEntityBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Cache\Cache;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\cohesion\Entity\CohesionSettingsInterface;
use Drupal\cohesion_website_settings\Plugin\Api\WebsiteSettingsApi;

/**
 * Defines the Cohesion website settings entity.
 *
 * @ConfigEntityType(
 *   id = "cohesion_font_stack",
 *   label = @Translation("Font stack"),
 *   label_singular = @Translation("Font stack"),
 *   label_plural = @Translation("Font stacks"),
 *   label_collection = @Translation("Font stacks"),
 *   label_count = @PluralTranslation(
 *     singular = "@count font stack",
 *     plural = "@count font stacks",
 *   ),
 *   fieldable = TRUE,
 *   handlers = {
 *     "route_provider" = {
 *       "html" = "Drupal\cohesion\CohesionHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "cohesion_font_stack",
 *   admin_permission = "administer website settings",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "in-use" = "/admin/cohesion/cohesion_font_stack/{cohesion_font_stack}/in_use",
 *     "collection" = "/admin/cohesion/cohesion_website_settings"
 *   }
 * )
 */
class FontStack extends WebsiteSettingsEntityBase implements CohesionSettingsInterface {

  use WebsiteSettingsSourceTrait;

  const ASSET_GROUP_ID = 'website_settings';

  /**
   * The human-readable label for a collection of entities of the type.
   *
   * @var string
   *
   * @see \Drupal\Core\Entity\EntityTypeInterface::getCollectionLabel()
   */
  protected $label_collection = '';

  /**
   * Return all the icons combined for the form[]
   *
   * @return array|\stdClass|string
   */
  public function getResourceObject() {
    /** @var WebsiteSettingsApi $send_to_api */
    $send_to_api = \Drupal::service('plugin.manager.api.processor')->createInstance('website_settings_api');

    return $send_to_api->getFontGroup();
  }

  /**
   * {@inheritdoc}
   */
  public function process() {
    /** @var WebsiteSettingsApi $send_to_api */
    $send_to_api = \Drupal::service('plugin.manager.api.processor')->createInstance('website_settings_api');
    $send_to_api->setEntity($this);
    $send_to_api->send();
    $send_to_api->getData();
  }


  /**
   * {@inheritdoc}
   */
  public function jsonValuesErrors() {
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);

    // Send settings to API if enabled and modified!.
    if ($this->status()) {
      $this->process();
    }
  }

  /**
   * Return a description.
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * {@inheritdoc}
   */
  public function getCollectionLabel() {
    if (empty($this->label_collection)) {
      $label = $this->getLabel();
      $this->label_collection = new TranslatableMarkup('@label', ['@label' => $label], [], $this->getStringTranslation());
    }
    return $this->label_collection;
  }

  /**
   * {@inheritdoc}
   */
  public function getInUseMessage() {
    return [
      'message' => [
        '#markup' => t('This font stack has been tracked as in use in the places listed below. You should not delete it until you have removed its use.'),
      ],
    ];
  }

  public function clearData() {
  }

  /**
   * @inheritdoc
   */
  public function isLayoutCanvas() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function setDefaultValues() {
    parent::setDefaultValues();

    $this->modified = TRUE;
    $this->status = TRUE;
  }
}

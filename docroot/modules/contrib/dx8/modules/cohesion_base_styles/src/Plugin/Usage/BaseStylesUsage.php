<?php

namespace Drupal\cohesion_base_styles\Plugin\Usage;

use Drupal\cohesion\UsagePluginBase;
use Drupal\Core\Entity\EntityInterface;

/**
 * Class BaseStylesUsage
 *
 * @package Drupal\cohesion_base_styles\Plugin\Usage
 *
 * @Usage(
 *   id = "base_styles_usage",
 *   name = @Translation("Base styles usage"),
 *   entity_type = "cohesion_base_styles",
 *   scannable = TRUE,
 *   scan_same_type = FALSE,
 *   group_key = FALSE,
 *   group_key_entity_type = FALSE,
 *   exclude_from_package_requirements = FALSE,
 *   exportable = TRUE
 * )
 */
class BaseStylesUsage extends UsagePluginBase {

  /**
   * {@inheritdoc}
   */
  public function getScannableData(EntityInterface $entity) {
    // Always add the JSON model and form blobs.
    $scanable_data = [
      [
        'type' => 'json_string',
        'value' => $entity->getJsonValues(),
        'decoded' => $entity->getDecodedJsonValues(),
      ],
    ];

    return $scanable_data;
  }

  /**
   * {@inheritdoc}
   */
  public function scanForInstancesOfThisType($data, EntityInterface $entity) {
    // Base styles are not defined on any entity; they are set implicitly.
    return parent::scanForInstancesOfThisType($data, $entity);
  }

}

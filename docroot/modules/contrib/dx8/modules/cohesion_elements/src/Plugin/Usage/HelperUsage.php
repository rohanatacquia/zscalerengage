<?php

namespace Drupal\cohesion_elements\Plugin\Usage;

use Drupal\Core\Entity\EntityInterface;
use Drupal\cohesion\UsagePluginBase;

/**
 * Class HelperUsage
 *
 * @package Drupal\cohesion_elements\Plugin\Usage
 *
 * @Usage(
 *   id = "cohesion_helper_usage",
 *   name = @Translation("Helper usage"),
 *   entity_type = "cohesion_helper",
 *   scannable = TRUE,
 *   scan_same_type = TRUE,
 *   group_key = "category",
 *   group_key_entity_type = "cohesion_helper_category",
 *   exclude_from_package_requirements = FALSE,
 *   exportable = TRUE
 * )
 */
class HelperUsage extends ElementUsageBase {

}

<?php

namespace Drupal\cohesion_elements\Entity;


use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\cohesion\CohesionHtmlRouteProvider;

/**
 * Provides routes for Cohesion base styles entities.
 *
 * @see Drupal\Core\Entity\Routing\AdminHtmlRouteProvider
 * @see Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider
 */
class ComponentContentRouteProvider extends CohesionHtmlRouteProvider {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $collection = parent::getRoutes($entity_type);
    $entity_type_id = $entity_type->id();
    // Remove canonical route and reimplement to poitn to the edit route
    $collection->remove("entity.{$entity_type_id}.canonical");
    if ($edit_route = $this->getEditFormRoute($entity_type)) {
      $collection->add("entity.{$entity_type_id}.canonical", $edit_route);
    }

    return $collection;
  }
}
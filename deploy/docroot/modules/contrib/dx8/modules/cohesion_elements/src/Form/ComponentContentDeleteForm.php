<?php

namespace Drupal\cohesion_elements\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Builds the form to delete Cohesion custom styles entities.
 */
class ComponentContentDeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  protected function logDeletionMessage() {
    /** @var \Drupal\cohesion_elements\ComponentContentInterface $entity */
    $entity = $this->getEntity();
    $this->logger('content')->notice('@type: deleted %title.', ['@type' => $entity->getEntityType()->getLabel(), '%title' => $entity->label()]);
  }
}

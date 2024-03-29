<?php

namespace Drupal\Tests\cohesion\Unit\Plugin\EntityUpdate;

use Drupal\Tests\UnitTestCase;
use Drupal\cohesion\Entity\EntityJsonValuesInterface;
use Drupal\cohesion\Plugin\EntityUpdate\_0004EntityUpdate;

/**
 * Class MockUpdateEntity
 *
 * @package Drupal\Tests\cohesion\Unit
 */
class MockUpdateEntity implements EntityJsonValuesInterface {
  protected $jsonValues;

  public function __construct($json_values) {
    $this->jsonValues = $json_values;
  }

  public function getJsonValues() {
    return $this->jsonValues;
  }

  public function setJsonValue($json_values) {
    $this->jsonValues = $json_values;
    return $this;
  }

  public function process() {
  }

  public function jsonValuesErrors() {
  }

  public function getDecodedJsonValues($bool = FALSE) {

  }

  public function isLayoutCanvas(){

  }

  public function getLayoutCanvasInstance(){

  }
}

/**
 * @group Cohesion
 */
class _0004EntityUpdateUnitTest extends UnitTestCase {

  protected $unit;

  public function setUp() {
    // Create a mock of the Php uuid generator service.
    //$prophecy = $this->prophesize(Php::CLASS);
    //$prophecy->generate()->willReturn('0000-0000-0000-0000');
    //$uuid_service_mock = $prophecy->reveal();

    $this->unit = new _0004EntityUpdate([], null, null);
  }

  /**
   * @covers \Drupal\cohesion\Plugin\EntityUpdate\_0004EntityUpdate::runUpdate
   */
  public function testRunUpdate() {
    $start_json_values = '{\/settings-endpoint\/}';
    $expected_json_values = '{\/cohesionapi\/}';
    $entity = new MockUpdateEntity($start_json_values);

    $this->unit->runUpdate($entity);

    $this->assertEquals($entity->getJsonValues(), $expected_json_values);
  }
}
<?php

namespace Drupal\Tests\cohesion\Unit\Plugin\EntityUpdate;

use Drupal\cohesion\Entity\EntityJsonValuesInterface;
use Drupal\cohesion\EntityJsonValuesTrait;
use Drupal\cohesion\Plugin\EntityUpdate\_0011EntityUpdate;
use Drupal\Tests\UnitTestCase;


/**
 * Class MockUpdateEntity
 *
 * @package Drupal\Tests\cohesion\Unit
 */
class _0011MockUpdateEntity implements EntityJsonValuesInterface {

  use EntityJsonValuesTrait;

  protected $jsonValues;
  protected $isLayoutCanvas;

  public function __construct($json_values, $isLayoutCanvas) {
    $this->jsonValues = $json_values;
    $this->isLayoutCanvas = $isLayoutCanvas;
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

  public function isLayoutCanvas(){
    return $this->isLayoutCanvas;
  }
}

/**
 * @group Cohesion
 */
class _0011EntityUpdateUnitTest extends UnitTestCase {

  /** @var $unit _0011MockUpdateEntity  */
  protected $unit;

  private $fixture_layout = '{"model":{"a7110a38-5abe-4096-8c67-e41eab35eadb":{"settings":{"type":"cohSelect","isStyle":true,"nullOption":false,"defaultValue":false,"options":[{"label":"All closed","value":true},{"label":"First open","value":false}],"schema":["string","number","boolean"],"selectType":"existing","selectModel":["settings","accordion_tabs_container","accordion-tabs-container-start-state","startCollapsed"],"title":"Select"},"contextVisibility":{"condition":"ALL"},"model":{}}},"mapper":{},"previewModel":{"a7110a38-5abe-4096-8c67-e41eab35eadb":{}},"canvas":[],"componentForm":[{"type":"form-field","uid":"form-select","title":"Select","parentIndex":"form-fields","status":{"collapsed":false},"uuid":"a7110a38-5abe-4096-8c67-e41eab35eadb","parentUid":"root","humanId":"Field 1","isContainer":false}]}';

  public function setUp() {
    $this->unit = new _0011EntityUpdate([], null, null);
  }

  /**
   * @covers \Drupal\cohesion\Plugin\EntityUpdate\_0005EntityUpdate::runUpdate
   */
  public function testRunUpdate() {

    // WYSIWYG in layout canvas
    $layout = new _0011MockUpdateEntity($this->fixture_layout, TRUE);
    $this->assertionsLayoutCanvasBefore($layout->getDecodedJsonValues());
    $this->unit->runUpdate($layout);
    $this->assertionsLayoutCanvasAfter($layout->getDecodedJsonValues());
    $this->unit->runUpdate($layout);
    $this->assertionsLayoutCanvasAfter($layout->getDecodedJsonValues());
  }

  private function assertionsLayoutCanvasBefore($layout_array_before){
    $this->assertEquals(["string","number","boolean"], $layout_array_before['model']['a7110a38-5abe-4096-8c67-e41eab35eadb']['settings']['schema'], 'schema' );
  }

  private function assertionsLayoutCanvasAfter($layout_array_after){
    $this->assertEquals(['type' => ["string","number","boolean"]], $layout_array_after['model']['a7110a38-5abe-4096-8c67-e41eab35eadb']['settings']['schema'], 'schema' );
  }
}
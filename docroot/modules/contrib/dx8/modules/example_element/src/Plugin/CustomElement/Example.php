<?php

namespace Drupal\example_element\Plugin\CustomElement;

use Drupal\cohesion_elements\CustomElementPluginBase;

/**
 * Generic HTML element plugin for DX8.
 *
 * @package Drupal\cohesion\Plugin\CustomElement
 *
 * @CustomElement(
 *   id = "example_element",
 *   label = @Translation("Example element")
 * )
 */
class Example extends CustomElementPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getFields()
  {
    return [
      'mytextfield' => [
        // This is the bootstrap class name that will be applied to the wrapping column.
        'htmlClass' => 'col-xs-12',
        // All form elements require a title.
        'title' => 'Title of my text field.',
        // The field type.
        'type' => 'textfield',
        // These fields are specific to this form field type.
        'placeholder' => 'Placeholder text.',
      ],
      'myselectfield' => [
        'htmlClass' => 'col-xs-12',
        'type' => 'select',
        'title' => 'Title of my select field',
        // These fields are specific to this form field type.
        'nullOption' => true,
        'options' => [
          'option1' => 'Option 1',
          'option2' => 'Option 2',
          'option3' => 'Option 3',
        ],
        'defaultValue' => 'option1'
      ],
      'mycheckboxfield' => [
        'htmlClass' => 'col-xs-6',
        'type' => 'checkbox',
        'title' => 'Title of my checkbox field',
        // These fields are specific to this form field type.
        'notitle' => false,
        'defaultValue' => true,
      ],
      'myothercheckboxfield' => [
        'htmlClass' => 'col-xs-6',
        'type' => 'checkbox',
        'title' => 'Title of my other checkbox field',
        // These fields are specific to this form field type.
        'notitle' => false,
        'defaultValue' => false,
      ],
      'myimagefield' => [
        'htmlClass' => 'col-xs-12',
        'type' => 'image',
        'title' => 'Title of my image field',
        // These fields are specific to this form field type.
        'buttonText' => 'Some button',
      ],
      'mytextareafield' => [
        'htmlClass' => 'col-xs-12',
        'type' => 'textarea',
        'title' => 'Title of my text area field.',
      ],
      'mywysiwygfield' => [
        'htmlClass' => 'col-xs-12',
        'type' => 'wysiwyg',
        'title' => 'Title of my WYSIWYG field.',
        'defaultValue' => [
          'text' => '<p>This is some default content.</p>',
          'textFormat' => 'cohesion'
        ]
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render($element_settings, $element_markup, $element_class, $element_context = [])
  {
    // Render the element.
    return [
      '#theme' => 'example_element',
      '#template' => 'example-element-template',
      '#elementSettings' => $element_settings,
      '#elementMarkup' => $element_markup,
      '#elementContext' => $element_context,
      '#elementClass' => $element_class,
    ];
  }

}

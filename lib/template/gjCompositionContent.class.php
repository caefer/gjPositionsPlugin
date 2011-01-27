<?php

class gjCompositionContent extends Doctrine_Template
{
  public function setUp()
  {
    parent::setUp();

    $looselycoupled = new LooselyCoupled(array('ContentElement' => 'gjContentElement'));
    $this->getInvoker()->actAs($looselycoupled);
  }

  public function getOverrideFields()
  {
    $overrideFields = array();
    $fieldNames = isset($this->_options['override']) ? $this->_options['override'] : array();
    foreach($fieldNames as $fieldName)
    {
      $fieldDefinition = $this->getInvoker()->getTable()->getColumnDefinition($fieldName);
      switch($fieldDefinition['type'])
      {
        case 'string':
          $overrideFields[$fieldName] = array('type' => 'text', 'default' => '');
          break;
        default:
          throw new sfException('Overriding of columns of type "'.$fieldDefinition['type'].'" are not implemented!');
      }
    }
    return $overrideFields;
  }
}

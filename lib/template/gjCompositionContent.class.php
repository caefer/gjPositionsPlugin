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
      if(is_array($fieldName))
      {
        $type = current($fieldName);
        $fieldName = key($fieldName);
      }

      $fieldDefinition = $this->getInvoker()->getTable()->getColumnDefinition($fieldName);

      switch($fieldDefinition['type'])
      {
        case 'decimal':
        case 'float':
        case 'integer':
        case 'string':
          $overrideFields[$fieldName] = array('type' => (isset($type) ? $type : 'text'), 'default' => '');
          break;
        default:
          throw new sfException('Overriding of columns of type "'.$fieldDefinition['type'].'" are not implemented!');
      }
    }
    return $overrideFields;
  }
}

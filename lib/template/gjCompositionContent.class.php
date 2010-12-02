<?php

class gjCompositionContent extends Doctrine_Template
{
  public function setUp()
  {
    parent::setUp();

    $looselycoupled = new LooselyCoupled(array('ContentElement' => 'gjContentElement'));
    $this->getInvoker()->actAs($looselycoupled);
  }
}

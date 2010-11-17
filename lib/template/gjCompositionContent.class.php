<?php

class gjCompositionContent extends LooselyCoupled
{
  public function __construct($options = array())
  {
    parent::__construct(array('ContentElement' => 'gjContentElement'));
  }
}

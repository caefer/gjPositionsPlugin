<?php

class gjContentElementable extends LooselyCoupled
{
  public function __construct($options = array())
  {
    parent::__construct(array('ContentElement' => 'gjContentElement'));
  }
}

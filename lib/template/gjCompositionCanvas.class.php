<?php

class gjCompositionCanvas extends LooselyCoupled
{
  public function __construct($options = array())
  {
    parent::__construct(array('DesignElements' => 'gjDesignElement'));
  }
}

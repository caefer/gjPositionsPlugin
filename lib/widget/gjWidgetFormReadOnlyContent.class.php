<?php

class gjWidgetFormReadOnlyContent extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('subject');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $this->getOption('subject')->__toString();
  }
}

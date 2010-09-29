<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormInputHidden represents a hidden HTML input tag.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputHidden.class.php 30762 2010-08-25 12:33:33Z fabien $
 */
class gjWidgetFormInputHiddenWithPartial extends sfWidgetFormInputHidden
{
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $html = parent::render($name, $value, $attributes, $errors);
    sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
    $elements = sfConfig::get('app_gjPositionsPlugin_partials', array());
    $html .= get_partial('gjPageAdmin/designElement', array('name' => $value, 'partial' => $elements[$value]));
    return $html;
  }
}

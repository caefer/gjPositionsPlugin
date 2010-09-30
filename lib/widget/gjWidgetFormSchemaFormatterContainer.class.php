<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * 
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormSchemaFormatterList.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
class gjWidgetFormSchemaFormatterContainer extends sfWidgetFormSchemaFormatterList
{
  protected
    $rowFormat       = "<li>\n  %error%\n  %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = '<div id="design_element_target_list"><ol>%content%</ol></div>';

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    preg_match('/\[name\].*value="([\w_]+)"/m', $field, $matches);
    if(2 == count($matches))
    {
      sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
      $elements = sfConfig::get('app_gjPositionsPlugin_partials', array());
      $field = get_partial('gjDesignElements/show', array('name' => $matches[1], 'partial' => $elements[$matches[1]])) . $field;
    }
    return parent::formatRow($label, $field, $errors, $help, $hiddenFields);
  }
}

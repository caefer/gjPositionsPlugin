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
    $partial         = null,
    $listId          = '',
    $objectFormat    = "<em>\n%object%</em>\n",
    $rowFormat       = "<li>\n  %error%\n  %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = '<div id="%listid%"><ol>%content%</ol></div>';

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    preg_match('/\[name\].*value="([\w_]+)"/m', $field, $matches);
    if($this->partial && 2 == count($matches))
    {
      sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
      $elements = sfConfig::get('app_gjPositionsPlugin_partials', array());
      $field = get_partial($this->partial, array('name' => $matches[1], 'partial' => $elements[$matches[1]], 'collapsed' => false)) . $field;
    }
    else
    {
      preg_match('/\[obj_type\].*value="([\w_]+)"/m', $field, $matches);
      list(,$obj_type) = $matches;
      preg_match('/\[obj_pk\].*value="([\w_]+)"/m', $field, $matches);
      list(,$obj_pk) = $matches;

      $object = Doctrine_Core::getTable($obj_type)->find($obj_pk);
      $field = str_replace('%object%', $object->__toString(), $this->objectFormat);
    }
    return parent::formatRow($label, $field, $errors, $help, $hiddenFields);
  }

  public function getDecoratorFormat()
  {
    return str_replace('%listid%', $this->listId, $this->decoratorFormat);
  }

  public function setPartial($name)
  {
    $this->partial = $name;
  }

  public function setListId($id)
  {
    $this->listId = $id;
  }
}

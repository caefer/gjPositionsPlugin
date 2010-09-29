<?php

/**
 * PlugingjDesignElement form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PlugingjDesignElementForm extends BasegjDesignElementForm
{
  public function setup()
  {
    parent::setup();

    $this->widgetSchema['position'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
    //$this->widgetSchema['name'] = new gjWidgetFormInputHiddenWithPartial();
    /*
    sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
    $elements = sfConfig::get('app_gjPositionsPlugin_partials', array());
    return $html . get_partial('gjPageAdmin/designElement', array('name' => $value, 'partial' => $elements[$value]));
    */

    $this->disableCSRFProtection();
    unset($this['gj_page_id']);
  }
}

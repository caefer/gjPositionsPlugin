<?php

/**
 * PlugingjContentElement form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PlugingjContentElementForm extends BasegjContentElementForm
{
  public function setup()
  {
    parent::setup();

    //$this->widgetSchema['position'] = new sfWidgetFormInputHidden();
    //$this->widgetSchema['obj_type'] = new sfWidgetFormInputHidden();
    //$this->widgetSchema['obj_pk']   = new sfWidgetFormInputHidden();

    $this->disableCSRFProtection();

    unset($this['gj_design_element_id']);
  }
}

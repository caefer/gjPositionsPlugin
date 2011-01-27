<?php

/**
 * PlugingjContentElement form.
 *
 * @package     gjPositionsPlugin
 * @subpackage form
 * @author      Christian Schaefer <caefer@ical.ly>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gjContentElementPositionsForm extends PlugingjContentElementForm
{
  public function configure()
  {
    $this->widgetSchema[$this->getObject()->obj_type]  = new gjWidgetFormReadOnlyContent(array('subject' => $this->getObject()->getObject()));

    $this->widgetSchema['position'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['obj_type'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['obj_pk']   = new sfWidgetFormInputHidden();

    if(($config = $this->getConfigForOverrideFields()))
    {
      $this->validatorSchema->setOption('allow_extra_fields', true);
      $this->widgetSchema['override'] = new sfWidgetFormInputArray(array('config' => $config));
      $this->widgetSchema['override']->setLabel(false);
      $this->useFields(array($this->getObject()->obj_type, 'override', 'position', 'obj_type', 'obj_pk'));
    }
    else
    {
      $this->useFields(array($this->getObject()->obj_type, 'position', 'obj_type', 'obj_pk'));
    }

  }

  protected function getConfigForOverrideFields()
  {
    $overrideFields = $this->getObject()->getObject()->getOverrideFields();
    return $overrideFields;
  }
}

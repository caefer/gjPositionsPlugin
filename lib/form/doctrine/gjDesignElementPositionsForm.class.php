<?php

/**
 * PlugingjDesignElement form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gjDesignElementPositionsForm extends PlugingjDesignElementForm
{
  public function configure()
  {
    $this->widgetSchema['position'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['name']     = new sfWidgetFormInputHidden();

    $this->useFields(array('position', 'name'));

    $this->embedDynamicRelation('Contents', 'gjContentElementPositionsForm');
    $this->widgetSchema['contents']->addFormFormatter('container', new gjWidgetFormSchemaFormatterContentElementContainer($this->widgetSchema));
    $this->widgetSchema['contents']->setFormFormatterName('container');
    //$this->widgetSchema['contents']->setFormFormatterName('positions');

    $this->getWidgetSchema()->addFormFormatter('design_element', new gjWidgetFormSchemaFormatterDesignElement($this->getWidgetSchema()));
    $this->widgetSchema->setFormFormatterName('design_element');
  }
}

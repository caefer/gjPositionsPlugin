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
    $this->widgetSchema['obj_type'] = new sfWidgetFormInputHidden();

    $this->useFields(array('position', 'name', 'params', 'obj_type'));

    $this->embedDynamicRelation('Contents', 'gjContentElementPositionsForm');

    $this->widgetSchema['contents']->addFormFormatter('container', new gjWidgetFormSchemaFormatterContentElementContainer($this->widgetSchema));
    $this->widgetSchema['contents']->setFormFormatterName('container');
    $this->validatorSchema['contents']->setOption('allow_extra_fields', true);

    $this->getWidgetSchema()->addFormFormatter('design_element', new gjWidgetFormSchemaFormatterDesignElement($this->getWidgetSchema()));
    $this->widgetSchema->setFormFormatterName('design_element');

    $this->widgetSchema['params'] = new sfWidgetFormInputArray(array('config' => $this->getConfigForParams()));

    $this->widgetSchema->setLabel('params', false);
    $this->widgetSchema->setLabel('contents', false);
  }

  protected function getConfigForParams()
  {
    $name = $this->getObject()->name;
    $config = sfConfig::get('app_gjPositionsPlugin_design_elements', array());

    if(empty($name) || !array_key_exists($name, $config) || empty($config[$name]['params']))
    {
      return array();
    }
    else
    {
      return $config[$name]['params'];
    }
  }
}

<?php

/**
 * PlugingjPage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PlugingjPageForm extends BasegjPageForm
{
  public function setup()
  {
    parent::setup();

    $this->setOption('dynamic_relations', array('design_elements' => array(
      'formatter_class'  => 'gjWidgetFormSchemaFormatterDesignElement',
    )));

    $this->embedDynamicRelation('DesignElements');
  }
}

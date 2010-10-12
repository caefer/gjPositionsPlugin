<?php

/**
 * PlugingjPage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gjPagePositionsForm extends PlugingjPageForm
{
  public function configure()
  {
    sfWidgetFormSchema::setDefaultFormFormatterName('positions');
    $this->embedDynamicRelation('DesignElements', 'gjDesignElementPositionsForm');
    $this->widgetSchema['design_elements']->setFormFormatterName('positions');
  }
}

<?php

/**
 * PlugingjContentElement form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
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

    $this->useFields(array($this->getObject()->obj_type, 'position', 'obj_type', 'obj_pk'));

    // use a custom formatter
    $this->getWidgetSchema()->addFormFormatter('content_element', new gjWidgetFormSchemaFormatterContentElement($this->getWidgetSchema()));
    $this->widgetSchema->setFormFormatterName('content_element');
  }
}

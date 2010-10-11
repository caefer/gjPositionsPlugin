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
    $this->widgetSchema['name']     = new sfWidgetFormInputHidden();

    $this->disableCSRFProtection();

    unset($this['gj_page_id']);

    $contentElements = $this->getObject()->Contents;
    if(empty($contentElements))
    {
      $contentElement = new gjContentElement();
      $contentElement->Page = $this->getObject();
      $contentElements = array($contentElement);
    }

    $contentElementFormHolder = new sfForm();
    $decorator = new gjWidgetFormSchemaFormatterContainer($contentElementFormHolder->getWidgetSchema());
    $decorator->setListId('content_element_target_list');
    $contentElementFormHolder->getWidgetSchema()->addFormFormatter('container', $decorator);
    $contentElementFormHolder->getWidgetSchema()->setFormFormatterName('container');
    $this->embedForm('contentElements', $contentElementFormHolder);

    foreach($contentElements as $num => $contentElement)
    {
      $this->addContentElement($num, $contentElement);
    }

    $this->widgetSchema['contentElements']->setLabel('Contents');
  }

  public function addContentElement($num, $contentElement = false)
  {
    if(false === $contentElement)
    {
      $contentElement = new gjContentElement();
      $contentElement->Page = $this->getObject();
    }

    $contentElementForm = $this->getContentElementForm($contentElement);

    $this->embeddedForms['contentElements']->embedForm($num, $contentElementForm);
    $this->embedForm('contentElements', $this->embeddedForms['contentElements']);
  }

  protected function getContentElementForm($contentElement)
  {
    $contentElementForm = new gjContentElementForm($contentElement);
    $decorator = new gjWidgetFormSchemaFormatterPartial($contentElementForm->getWidgetSchema());
    $contentElementForm->getWidgetSchema()->addFormFormatter('partial', $decorator);
    $contentElementForm->getWidgetSchema()->setFormFormatterName('partial');

    return $contentElementForm;
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    foreach($taintedValues['contentElements'] as $key => $newContentElement)
    {
      if(!isset($this['contentElements'][$key]))
      {
        $this->addContentElement($key);
      }
    }

    parent::bind($taintedValues, $taintedFiles);
  }
}

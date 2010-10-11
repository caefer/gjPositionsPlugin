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
  /**
   * @see http://www.nacho-martin.com/dynamic-embedded-forms-in-symfony
   */
  public function setup()
  {
    parent::setup();

    $designElements = $this->getObject()->DesignElements;
    if(empty($designElements))
    {
      $designElement = new gjDesignElement();
      $designElement->Page = $this->getObject();
      $designElements = array($designElement);
    }

    $designElementFormHolder = new sfForm();
    $decorator = new gjWidgetFormSchemaFormatterContainer($designElementFormHolder->getWidgetSchema());
    $decorator->setPartial('gjDesignElements/show');
    $decorator->setListId('design_element_target_list');
    $designElementFormHolder->getWidgetSchema()->addFormFormatter('container', $decorator);
    $designElementFormHolder->getWidgetSchema()->setFormFormatterName('container');
    $this->embedForm('designElements', $designElementFormHolder);

    foreach($designElements as $num => $designElement)
    {
      $this->addDesignElement($num, $designElement);
    }
  }

  public function addDesignElement($num, $designElement = false)
  {
    if(false === $designElement)
    {
      $designElement = new gjDesignElement();
      $designElement->Page = $this->getObject();
    }

    $designElementForm = $this->getDesignElementForm($designElement);

    $this->embeddedForms['designElements']->embedForm($num, $designElementForm);
    $this->embedForm('designElements', $this->embeddedForms['designElements']);
  }

  protected function getDesignElementForm($designElement)
  {
    $designElementForm = new gjDesignElementForm($designElement);
    $decorator = new gjWidgetFormSchemaFormatterPartial($designElementForm->getWidgetSchema());
    $designElementForm->getWidgetSchema()->addFormFormatter('partial', $decorator);
    $designElementForm->getWidgetSchema()->setFormFormatterName('partial');

    return $designElementForm;
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    foreach($taintedValues['designElements'] as $key => $newDesignElement)
    {
      if(!isset($this['designElements'][$key]))
      {
        $this->addDesignElement($key);
      }
    }

    parent::bind($taintedValues, $taintedFiles);
  }

  public function getJavascripts()
  {
    $javascripts = parent::getJavascripts();
    $javascripts[] = '/gjPositionsPlugin/js/jquery-ui-1.8.5.custom.min.js';
    $javascripts[] = '/gjPositionsPlugin/js/page.js';
    return $javascripts;
  }

  public function getStylesheets()
  {
    $stylesheets = parent::getStylesheets();
    $stylesheets['/gjPositionsPlugin/css/page.css'] = 'all';
    return $stylesheets;
  }
}

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

    $designElementForms = new sfForm();
    foreach($designElements as $i => $designElement)
    {
      $designElementForm = new gjDesignElementForm($designElement);
      $designElementForms->embedForm($i, $designElementForm);
    }
    $this->embedForm('designElements', $designElementForms);
  }

  public function addDesignElement($num)
  {
    $designElement = new gjDesignElement();
    $designElement->Page = $this->getObject();
    $designElementForm = new gjDesignElementForm($designElement);

    $this->embeddedForms['designElements']->embedForm($num, $designElementForm);
    $this->embedForm('designElements', $this->embeddedForms['designElements']);
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    foreach($taintedValues['designElements'] as $key => $newDesignElement)
    {
      if(!isset($this['designElements'][$key]))
      {
        sfContext::getInstance()->getLogger()->info('Add designElement gj_design_element '.$key);
        $this->addDesignElement($key);
      }
    }

    parent::bind($taintedValues, $taintedFiles);
  }

  public function getJavascripts()
  {
    $javascripts = parent::getJavascripts();
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

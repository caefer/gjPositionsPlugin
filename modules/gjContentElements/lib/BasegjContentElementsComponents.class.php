<?php

/**
 * Base components for the gjPositionsPlugin gjContentElements module.
 * 
 * @package     gjPositionsPlugin
 * @subpackage  gjContentElements
 * @author      Christian Schaefer <caefer@ical.ly>
 * @version     SVN: $Id: BaseComponents.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BasegjContentElementsComponents extends sfComponents
{
  public function executeList(sfWebRequest $request)
  {
    $this->models = array('Article', 'Gallery', 'Glossary');
  }

  public function executeInnerList(sfWebRequest $request)
  {
    $this->records = Doctrine_Core::getTable($this->model)->findAll();
  }
}

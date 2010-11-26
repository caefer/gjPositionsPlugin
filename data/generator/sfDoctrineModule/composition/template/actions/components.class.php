[?php


/**
 * <?php echo $this->getModuleName() ?> components.
 *
 * @package     gjPositionsPlugin
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author      Christian Schaefer <caefer@ical.ly>
 * @version    SVN: $Id: actions.class.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class <?php echo $this->getGeneratedModuleName() ?>Components extends sfComponents
{
  protected $modelClasses = array();

  public function executeComposition_designelements(sfWebRequest $request)
  {
    $elements = sfConfig::get('app_gjPositionsPlugin_design_elements', array());
    $this->elements = array_filter($elements, array($this, 'filterAppropriate'));
  }

  public function executeComposition_designelement(sfWebRequest $request)
  {
    $this->is_real = true;

    if(!$this->designElement instanceof gjDesignElement)
    {
      $this->is_real = false;

      $designElement = Doctrine_Core::getTable('gjDesignElement')->create($this->designElement);
      if(!empty($this->config['params']))
      {
        $params = array();
        foreach($this->config['params'] as $key => $value)
        {
          $params[$key] = $value['default'];
        }
        $designElement['params'] = $params;
      }
      $this->designElement = $designElement;

      $this->form = new gjDesignElementPositionsForm($this->designElement, array(), false);
      $this->form->getWidgetSchema()->setNameFormat('<?php echo $this->getSingularName(); ?>[design_elements][x][%s]');
    }
  }

  public function executeComposition_contentelements(sfWebRequest $request)
  {
    $elements = sfConfig::get('app_gjPositionsPlugin_design_elements', array());
    $this->elements = array_filter($elements, array($this, 'filterAppropriate'));
    $this->allRecords = array();
    foreach($this->modelClasses as $modelClass)
    {
      $this->allRecords[$modelClass] = Doctrine_Core::getTable($modelClass)->findAll();
    }
  }

  protected function filterAppropriate($designElement)
  {
    if(in_array('<?php echo $this->getModelClass() ?>', $designElement['applies_to']))
    {
      if(is_array($designElement['accept']))
      {
        $this->modelClasses = array_unique(array_merge($this->modelClasses, $designElement['accept']));
      }
      return true;
    }

    return false;
  }
}

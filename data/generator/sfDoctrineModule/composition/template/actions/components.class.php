[?php


/**
 * <?php echo $this->getModuleName() ?> components.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class <?php echo $this->getGeneratedModuleName() ?>Components extends sfComponents
{
  protected $modelClasses = array();

  public function executeDesignelements_list(sfWebRequest $request)
  {
    $elements = sfConfig::get('app_gjPositionsPlugin_design_elements', array());
    $this->elements = array_filter($elements, array($this, 'filterAppropriate'));
  }

  public function executeDesignelements_show(sfWebRequest $request)
  {
    $designElement = new gjDesignElement();
    $designElement->name = $this->name;

    $this->form = new gjDesignElementPositionsForm($designElement);
    $this->form->getWidgetSchema()->setNameFormat('<?php echo $this->getSingularName(); ?>[designElements][x][%s]');
  }

  public function executeContentelements_list(sfWebRequest $request)
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

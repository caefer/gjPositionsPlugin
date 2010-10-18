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
  public function executeDesignelements_list(sfWebRequest $request)
  {
    $this->elements = sfConfig::get('app_gjPositionsPlugin_partials', array());
  }

  public function executeDesignelements_show(sfWebRequest $request)
  {
    $designElement = new gjDesignElement();
    $designElement->name = $this->name;
    //$designElement->setObject($this->canvas);

    $this->form = new gjDesignElementPositionsForm($designElement);
    $this->form->getWidgetSchema()->setNameFormat('<?php echo $this->getSingularName(); ?>[designElements][x][%s]');
  }
}

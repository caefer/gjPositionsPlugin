[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package     gjPositionsPlugin
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author      Christian Schaefer <caefer@ical.ly>
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }

  public function linkToPreview($object, $params)
  {
    return '<li class="sf_admin_action_preview"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_preview" /></li>';
  }
}

<?php

abstract class BasehomepageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partials = sfConfig::get('app_gjPositionsPlugin_partials', array());
    $this->page = Doctrine_Core::getTable('Page')->createQuery('p')
      ->leftJoin('p.DesignElements d')
      ->leftJoin('d.Contents c')
      ->orderBy('d.position')
      ->where('id = 1')
      ->fetchOne(array(), gjPositionsPluginConfiguration::HYDRATE_ARRAY_COUPLED);
  }
}

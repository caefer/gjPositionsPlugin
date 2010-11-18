<?php

/**
 * gjPositionsPlugin configuration.
 * 
 * @package     gjPositionsPlugin
 * @subpackage  config
 * @author      Christian Schaefer <caefer@ical.ly>
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class gjPositionsPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';
  const HYDRATE_ARRAY_COUPLED = 'gjPositionsPlugin_hydrate_array_coupled';
  const HYDRATE_RECORD_COUPLED = 'gjPositionsPlugin_hydrate_record_coupled';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    // register a listener on the doctrine.configure event
    $this->dispatcher->connect('doctrine.configure_connection', array($this, 'configureDoctrine'));
  }

  /**
   * Listens to the doctrine.configure event
   *
   * @param sfEvent $event
   * @return void
   */
  public function configureDoctrine(sfEvent $event)
  {
    $manager = $event->getSubject();

    $manager->registerHydrator(gjPositionsPluginConfiguration::HYDRATE_ARRAY_COUPLED, 'Doctrine_Hydrator_ArrayCoupledDriver');
    $manager->registerHydrator(gjPositionsPluginConfiguration::HYDRATE_RECORD_COUPLED, 'Doctrine_Hydrator_RecordCoupledDriver');
  }
}

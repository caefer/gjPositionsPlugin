<?php

class gjCompositionCanvas extends Doctrine_Template
{
  public function setUp()
  {
    parent::setUp();

    $looselycoupled = new LooselyCoupled(array('DesignElements' => 'gjDesignElement'));
    $this->getInvoker()->actAs($looselycoupled);
  }

  public function getObjectTableProxy(array $params)
  {
    return $this->getInvoker()->getTable()->createQuery('c')
      ->where('c.id = ?', $params['id'])
      ->leftJoin('c.DesignElements de')
      ->leftJoin('de.Contents ce')
      ->execute(array(), gjPositionsPluginConfiguration::HYDRATE_RECORD_COUPLED);
  }
}

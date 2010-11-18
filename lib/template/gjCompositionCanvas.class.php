<?php

class gjCompositionCanvas extends LooselyCoupled
{
  public function __construct($options = array())
  {
    parent::__construct(array('DesignElements' => 'gjDesignElement'));
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

<?php

class gjDesignElementConfigFilter extends Doctrine_Record_Filter
{
  public function filterSet(Doctrine_Record $record, $name, $value)
  {
    throw new Doctrine_Record_UnknownPropertyException(sprintf('Unknown record property / related component "%s" on "%s"', $name, get_class($record)));
  }

  public function filterGet(Doctrine_Record $record, $name)
  {
    if('config' == strtolower($name))
    {
      if($record->hasMappedValue('config'))
      {
        return $record->get('config');
      }
      else if($record['name'])
      {
        $config = sfConfig::get('app_gjPositionsPlugin_design_elements', array());
        $record->mapValue('config', $config[$record['name']]);
        return $record->get('config');
      }
    }

    throw new Doctrine_Record_UnknownPropertyException(sprintf('Unknown record property / related component "%s" on "%s"', $name, get_class($record)));
  }
}

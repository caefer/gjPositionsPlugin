<?php

function include_design_element($designElement)
{
  echo get_design_element($designElement);
}

function get_design_element($designElement)
{
   $configs = sfConfig::get('app_gjPositionsPlugin_design_elements', array());

   if(is_string($include = $configs[$designElement['name']]['include']))
   {
     return get_partial($include, array('params' => $designElement['params']));
   }

   return get_component($include[0], $include[1], array('params' => $designElement['params']));
}

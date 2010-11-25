<?php

function include_design_element($designElement)
{
  echo get_design_element($designElement);
}

function get_design_element($designElement)
{
  $options = array(
    'params'   => $designElement['params'],
    'subject'  => $designElement->getObject(),
    'contents' => $designElement['Contents']
  );

  if(is_string($designElement['config']['include']))
  {
    return get_partial($designElement['config']['include'], $options);
  }

  return get_component($designElement['config']['include'][0], $designElement['config']['include'][1], $options);
}

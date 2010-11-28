  <ul id="design_element_source_list" class="interaction">
[?php foreach($elements as $name => $config): ?]
    <li class="design-element">
[?php include_component('<?php echo $this->getModuleName() ?>', 'composition_designelement',  array('designElement' => array('name' => $name, 'Object' => $subject), 'config' => $config)); ?]
    </li>
[?php endforeach; ?]
  </ul>

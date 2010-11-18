  <ul id="design_element_source_list" class="interaction">
[?php foreach($elements as $name => $config): ?]
    <li id="[?php echo $name; ?]">
[?php include_component('<?php echo $this->getModuleName() ?>', 'designelements_show',  array('designElement' => array('name' => $name, 'Object' => $subject), 'config' => $config)); ?]
    </li>
[?php endforeach; ?]
  </ul>

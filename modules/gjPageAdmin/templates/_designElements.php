  <ul id="design_element_source_list" class="interaction">
<?php foreach($elements as $name => $partial): ?>
    <li id="<?php echo $name; ?>">
<?php include_component('gjPageAdmin', 'designElement', array('name' => $name, 'partial' => $partial)); ?>
    </li>
<?php endforeach; ?>
  </ul>

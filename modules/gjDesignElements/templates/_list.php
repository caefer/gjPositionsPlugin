  <ol id="design_element_source_list" class="interaction">
<?php foreach($elements as $name => $partial): ?>
    <li id="<?php echo $name; ?>">
<?php include_component('gjDesignElements', 'show', array('name' => $name, 'partial' => $partial, 'collapsed' => true)); ?>
    </li>
<?php endforeach; ?>
  </ol>

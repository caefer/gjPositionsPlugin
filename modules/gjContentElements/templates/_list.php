<ul>
<?php foreach($models as $model): ?>
  <li>
    <strong><?php echo $model; ?></strong>
    <?php include_component('gjContentElements', 'innerList', array('model' => $model)); ?>
  </li>
<?php endforeach; ?>
</ul>

<ul id="content_element_source_list">
[?php foreach($allRecords as $model => $records): ?]
  <li>
    <strong>[?php echo $model; ?]</strong>
    <ol class="content-elements">
[?php foreach($records as $i => $record): ?]
      <li class="[?php echo $model; ?]">
        <label>[?php echo $model; ?]</label>
        [?php echo $record; ?]
        [?php if(($config = $record->getOverrideFields())): ?]</pre>
        <div class="content-element-override" style="display:none">
        [?php  $widget = new sfWidgetFormInputArray(array('config' => $config)); ?]
        [?php   echo $widget->render('<?php echo $this->getSingularName(); ?>[design_elements][x][contents][y][override]'); ?]
        </div>
        [?php endif; ?]
        <input type="hidden" value="" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][y][id]" />
        <input type="hidden" value="0" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][y][position]" />
        <input type="hidden" value="[?php echo $model; ?>" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][y][obj_type]" />
        <input type="hidden" value="[?php echo $record->id; ?>" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][y][obj_pk]" />
      </li>
[?php endforeach; ?]
    </ol>
  </li>
[?php endforeach; ?]
</ul>

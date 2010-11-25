<ul id="content_element_source_list">
[?php foreach($allRecords as $model => $records): ?]
  <li>
    <strong>[?php echo $model; ?]</strong>
    <ol class="contents [?php echo $model; ?]">
[?php foreach($records as $i => $record): ?]
      <li class="[?php echo $i%2 ? 'even' : 'odd' ?]">
        <em>[?php echo $record; ?]</em>
        <input type="hidden" id="<?php echo $this->getSingularName(); ?>_design_elements_x_contents_x_id" value="" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][id]" />
        <input type="hidden" id="<?php echo $this->getSingularName(); ?>_design_elements_x_contents_x_position" value="0" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][position]" />
        <input type="hidden" id="<?php echo $this->getSingularName(); ?>_design_elements_x_contents_x_obj_type" value="[?php echo $model; ?>" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][obj_type]" />
        <input type="hidden" id="<?php echo $this->getSingularName(); ?>_design_elements_x_contents_x_obj_pk" value="[?php echo $record->id; ?>" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][obj_pk]" />
      </li>
[?php endforeach; ?]
    </ol>
  </li>
[?php endforeach; ?]
</ul>

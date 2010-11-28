<ul id="content_element_source_list">
[?php foreach($allRecords as $model => $records): ?]
  <li>
    <strong>[?php echo $model; ?]</strong>
    <ol class="content-elements">
[?php foreach($records as $i => $record): ?]
      <li class="[?php echo $model; ?]">
        <label>[?php echo $model; ?]</label>
        [?php echo $record; ?]
        <input type="hidden" value="" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][id]" />
        <input type="hidden" value="0" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][position]" />
        <input type="hidden" value="[?php echo $model; ?>" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][obj_type]" />
        <input type="hidden" value="[?php echo $record->id; ?>" name="<?php echo $this->getSingularName(); ?>[design_elements][x][contents][x][obj_pk]" />
      </li>
[?php endforeach; ?]
    </ol>
  </li>
[?php endforeach; ?]
</ul>

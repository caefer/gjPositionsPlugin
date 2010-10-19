<ul>
[?php foreach($allRecords as $model => $records): ?]
  <li>
    <strong>[?php echo $model; ?></strong>
    <ul>
[?php foreach($records as $record): ?]
      <li>
        <em>[?php echo $record; ?></em>
        <input type="hidden" id="gj_page_designElements_%de%_Contents_%ce%_id" value="" name="gj_page[designElements][%de%][Contents][%ce%][id]" />
        <input type="hidden" id="gj_page_designElements_%de%_Contents_%ce%_position" value="%POSITION%" name="gj_page[designElements][%de%][Contents][%ce%][position]" />
        <input type="hidden" id="gj_page_designElements_%de%_Contents_%ce%_obj_type" value="[?php echo get_class($record); ?>" name="gj_page[designElements][%de%][Contents][%ce%][obj_type]" />
        <input type="hidden" id="gj_page_designElements_%de%_Contents_%ce%_obj_pk" value="[?php echo $record->id; ?>" name="gj_page[designElements][%de%][Contents][%ce%][obj_pk]" />
      </li>
[?php endforeach; ?]
    </ul>
  </li>
[?php endforeach; ?]
</ul>

      <div class="design-elements-head">
        <?php echo $name; ?>
      </div>
      <div class="design-element-include">
        <?php is_string($partial) ? include_partial($partial) : include_component($partial[0], $partial[1]); ?>
      </div>
<?php if(isset($form)): ?>
      <?php echo $form; ?>
<?php endif; ?>

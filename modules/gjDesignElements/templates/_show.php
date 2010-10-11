      <div class="design-elements-head">
        <a href="#inc_<?php echo $name; ?>"><img src="/gjPositionsPlugin/images/more.png" /></a>
        <strong><?php echo $name; ?></strong>
      </div>
      <div class="design-element-include" id="inc_<?php echo $name; ?>" style="display:<?php echo $collapsed ? 'none' : 'block'; ?>">
        <?php is_string($partial) ? include_partial($partial) : include_component($partial[0], $partial[1]); ?>
      </div>
<?php if(isset($form)) echo $form; ?>

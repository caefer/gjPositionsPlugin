      <div class="design-elements-head">
        <strong>[?php echo sfInflector::humanize($name); ?]</strong>
      </div>
      <div class="design-element-include" id="inc_[?php echo $name; ?]">
        <div>
          [?php is_string($config['include']) ? include_partial($config['include'], array('params' => $params)) : include_component($config['include'][0], $config['include'][1], array('params' => $params)); ?]
        </div>
      </div>
      <div class="design-element-form" id="form_[?php echo $name; ?]">
        [?php if(isset($form)) echo $form; ?]
      </div>

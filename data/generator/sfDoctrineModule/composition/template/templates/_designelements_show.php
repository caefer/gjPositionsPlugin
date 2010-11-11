      <div class="design-elements-head"[?php if($is_real): ?] style="display:none;"[?php endif;?]>
        <strong>[?php echo sfInflector::humanize($name); ?]</strong><br />
        <p>[?php echo $config['description'] ?]</p>
      </div>
      <div class="design-element-include" id="inc_[?php echo $name; ?]"[?php if(!$is_real): ?] style="display:none;"[?php endif;?]>
        <div>
          [?php is_string($config['include']) ? include_partial($config['include'], array('params' => $params)) : include_component($config['include'][0], $config['include'][1], array('params' => $params)); ?]
        </div>
      </div>
      <div class="design-element-form" id="form_[?php echo $name; ?]"[?php if(!$is_real): ?] style="display:none;"[?php endif;?]>
        [?php if(isset($form)) echo $form; ?]
      </div>

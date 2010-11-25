[?php use_helper('gjPositions') ?]
      <div class="design-elements-head"[?php if($is_real): ?] style="display:none;"[?php endif;?]>
        <strong>[?php echo sfInflector::humanize($designElement['name']); ?]</strong><br />
        <p>[?php echo $config['description'] ?]</p>
      </div>
      <div class="design-element-include" id="inc_[?php echo $designElement['name']; ?]"[?php if(!$is_real): ?] style="display:none;"[?php endif;?]>
        <div>
          [?php include_design_element($designElement); ?]
        </div>
      </div>
      <div class="design-element-form" id="form_[?php echo $designElement['name']; ?]"[?php if(!$is_real): ?] style="display:none;"[?php endif;?]>
        [?php if($accept = $designElement['config']['accept']): ?]
        <ol class="design-element-canvas [?php echo implode(' ', $accept->getRawValue()) ?]">
          [?php echo $form['contents']->render(); ?]
        </ol>
        [?php endif; ?]
        [?php echo $form->renderHiddenFields(); ?]
      </div>

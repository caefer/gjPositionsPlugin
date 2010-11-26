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
          [?php foreach($form['contents'] as $content): ?]
          <li class="content-element">
            [?php foreach($form['contents'] as $content): ?]
              [?php foreach($content as $field): ?]
                [?php if(!$field->isHidden()): ?]
                  [?php echo $field->renderLabel(); ?]
                  [?php echo $field->render(); ?]
                [?php endif; ?]
              [?php endforeach; ?]
              [?php echo $content->renderHiddenFields(); ?]
            [?php endforeach; ?]
          </li>
          [?php endforeach; ?]
        </ol>
        [?php endif; ?]
        [?php echo $form->renderHiddenFields(); ?]
      </div>

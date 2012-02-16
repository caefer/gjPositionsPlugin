[?php use_helper('gjPositions') ?]
      <div class="design-element-head"[?php if($is_real): ?] style="display:none;"[?php endif;?]>
        <strong>[?php echo sfInflector::humanize($designElement['name']); ?]</strong><br />
        <p>[?php echo $config['description'] ?]</p>
      </div>
      <div class="design-element-include" [?php if(!$is_real): ?] style="display:none;"[?php endif;?]>
        <a href="#" class="button remove" rel="remove-design-element" />Remove</a>
        <div>
          [?php include_design_element($designElement); ?]
        </div>
      </div>
      <div class="design-element-form" [?php if(!$is_real): ?] style="display:none;"[?php endif;?]>
        [?php if($accept = $designElement['config']['accept']): ?]
        <ol class="design-element-canvas [?php echo implode(' ', $accept->getRawValue()) ?]">[?php foreach($form['contents'] as $content): ?]
            [?php foreach($form['contents'] as $content): ?]
          <li class="content-element">
              [?php foreach($content as $field): ?]
                [?php if(!$field->isHidden()): ?]
                  [?php echo $field->renderLabel(); ?]
                  [?php echo $field->render(); ?]
                  <br />
                [?php endif; ?]
              [?php endforeach; ?]
              [?php echo $content->renderHiddenFields(); ?]
          </li>
            [?php endforeach; ?]
          [?php endforeach; ?]</ol>
        [?php endif; ?]
        [?php echo $form['params']->render(); ?]
        [?php echo $form->renderHiddenFields(false); ?]
      </div>

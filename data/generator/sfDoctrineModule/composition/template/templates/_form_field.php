[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  <div class="[?php echo $class ?][?php $form[$name]->hasError() and print ' errors' ?]">
    [?php echo $form[$name]->renderError() ?]
    <div>
      [?php echo $form[$name]->renderLabel($label) ?]

      <div class="content">
      [?php if('design_elements' == $name && 'sfFormFieldSchema' == get_class($form[$name])): ?]
        <ol class="positions_container">
        [?php foreach ($form[$name] as $embeddedName => $embeddedField): ?]
          <li>
            [?php $elementName = $embeddedField['name']->getValue() ?]
            [?php $config = sfConfig::get('app_gjPositionsPlugin_design_elements', array()) ?]
            [?php include_partial('<?php echo $this->getModuleName() ?>/designelements_show', array('name' => $elementName, 'config' => $config[$elementName], 'form' => $embeddedField, 'params' => $embeddedField['params']->getValue(), 'is_real' => true)); ?]
          </li>
        [?php endforeach ?]
        </ol>
      [?php else: ?]
        [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
      [?php endif; ?]
      </div>

      [?php if ($help): ?]
        <div class="help">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
      [?php elseif ($help = $form[$name]->renderHelp()): ?]
        <div class="help">[?php echo $help ?]</div>
      [?php endif; ?]
    </div>
  </div>
[?php endif; ?]

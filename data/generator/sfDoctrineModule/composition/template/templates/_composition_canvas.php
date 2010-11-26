        <ol class="composition-canvas">
        [?php foreach ($form[$name] as $embeddedName => $embeddedField): ?]
          <li class="design-element">
            [?php include_component('<?php echo $this->getModuleName() ?>', 'composition_designelement', array('designElement' => $form->getObject()->get('DesignElements')->get($embeddedName), 'form' => $embeddedField)); ?]
          </li>
        [?php endforeach ?]
        </ol>

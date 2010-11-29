[?php use_javascript('/gjPositionsPlugin/js/jquery.compositionCanvas.js') ?]
[?php use_javascript('/gjPositionsPlugin/js/jquery.compositionDesignElement.js') ?]
[?php use_javascript('/gjPositionsPlugin/js/positions.js') ?]
        <ol class="composition-canvas">[?php foreach ($form[$name] as $embeddedName => $embeddedField): ?]
          <li class="design-element">
            [?php include_component('<?php echo $this->getModuleName() ?>', 'composition_designelement', array('designElement' => $form->getObject()->get('DesignElements')->get($embeddedName), 'form' => $embeddedField)); ?]
          </li>
        [?php endforeach ?]</ol>

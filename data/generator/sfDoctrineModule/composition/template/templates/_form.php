[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<table style="width:100%;table-layout:fixed">
  <tr>
    <td style="width:50%">
      <h3><?php echo $this->params['model_class']; ?></h3>
      <div class="sf_admin_form">
        [?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>') ?]
          [?php echo $form->renderHiddenFields(false) ?]

          [?php if ($form->hasGlobalErrors()): ?]
            [?php echo $form->renderGlobalErrors() ?]
          [?php endif; ?]

          [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
            [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
          [?php endforeach; ?]

          [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
        </form>
      </div>
    </td>
    <td style="width:25%">
      <h3>Design Elements</h3>
      <div class="sf_admin_form" id="gj_page_admin_design_elements">
        [?php include_component('gjDesignElements', 'list', array('page' => $gj_page)); ?]
      </div>
    </td>
    <td style="width:25%">
      <h3>Contents</h3>
      <div class="sf_admin_form" id="gj_page_admin_content_elements">
        [?php include_component('gjContentElements', 'list', array('page' => $gj_page)); ?]
      </div>
    </td>
  </td>
</table>

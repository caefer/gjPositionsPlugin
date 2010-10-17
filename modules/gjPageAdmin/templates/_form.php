<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<table style="width:100%;table-layout:fixed">
  <tr>
    <td style="width:50%">
      <h3>Page</h3>
<div class="sf_admin_form" id="gj_page_admin_page">
  <?php echo form_tag_for($form, '@gj_page') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('gjPageAdmin/form_fieldset', array('gj_page' => $gj_page, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('gjPageAdmin/form_actions', array('gj_page' => $gj_page, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
    </td>
    <td style="width:25%">
      <h3>Design Elements</h3>
<div class="sf_admin_form" id="gj_page_admin_design_elements">
  <?php include_component('gjDesignElements', 'list', array('page' => $gj_page)); ?>
</div>
    </td>
    <td style="width:25%">
      <h3>Contents</h3>
<div class="sf_admin_form" id="gj_page_admin_content_elements">
  <?php include_component('gjContentElements', 'list', array('page' => $gj_page)); ?>
</div>
    </td>
  </td>
</table>

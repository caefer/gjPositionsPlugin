<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

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
<div class="sf_admin_form" id="gj_page_admin_design_elements">
  <?php include_component('gjDesignElements', 'list', array('page' => $gj_page)); ?>
</div>
<div class="sf_admin_form" id="gj_page_admin_content_elements">
contents
</div>
<div style="clear:both;"></div>

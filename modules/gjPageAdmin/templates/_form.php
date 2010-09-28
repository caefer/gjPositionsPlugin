<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<table style="width:100%;">
  <tr>
    <td>
<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@gj_page') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('gjPageAdmin/form_fieldset', array('gj_page' => $gj_page, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('gjPageAdmin/form_actions', array('gj_page' => $gj_page, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    <button id="add_design_element" type="button">Add Design Element</button>
  </form>
<script type="text/javascript">
var gjPageFormConfig = {
  url:'<?php echo url_for('@gj_page_add_design_element?id=0&num=0'); ?>'
}
</script>
</div>
    </td>
    <td>
<div class="sf_admin_form">
  <ul>
<?php foreach(sfConfig::get('app_gjPositionsPlugin_partials', array()) as $name => $partial): ?>
    <li><?php include_partial('gjDesignElements/'.$name); ?></li>
<?php endforeach; ?>
  </ul>
</div>
    </td>
  </tr>
</table>

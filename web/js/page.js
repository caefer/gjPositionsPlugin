gjPageForm = {
  _selectors:{
    page_id:'input#gj_page_id',
    count:'.sf_admin_form_field_designElements table table',
    button_add:'button#add_design_element',
    hook:'.sf_admin_form_field_designElements div div.content > table > tbody',
    bhook:'#extradesignElements'
  },
  addDesignElement:function()
  {
    id = jQuery(gjPageForm._selectors.page_id).val() || '0';
    num = jQuery(gjPageForm._selectors.count).length;
    url = gjPageFormConfig.url.replace('/0/0', '/'+id+'/'+num);
    jQuery.get(url, gjPageForm.appendDesignElement);
  },
  appendDesignElement:function(data)
  {
    jQuery(gjPageForm._selectors.hook).append(data);
  },
  init:function()
  {
    jQuery(gjPageForm._selectors.button_add).click(gjPageForm.addDesignElement);
  }
}

jQuery(document).ready(gjPageForm.init);

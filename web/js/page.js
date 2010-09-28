gjPageForm = {
  count:0,
  _selectors:{
    page_id:'input#gj_page_id',
    count:'ul#design_element_container > li',
    button_add:'button#add_design_element',
    source_list:'ul#design_element_source_list',
    target_list:'ul#design_element_target_list'
  },
  addDesignElement:function()
  {
    id = jQuery(gjPageForm._selectors.page_id).val() || '0';
    url = gjPageFormConfig.url.replace('/0/0', '/'+id+'/'+gjPageForm.count);
    gjPageForm.count++;
    jQuery.get(url, gjPageForm.appendDesignElement);
  },
  appendDesignElement:function(data)
  {
    jQuery(gjPageForm._selectors.hook).append(data);
  },
  initDragnDrop:function()
  {
    jQuery(gjPageForm._selectors.target_list).sortable({
      connectWith: gjPageForm._selectors.target_list,
      helper: 'clone',
      receive:function(event,ui){/* create hidden form */},
      update:function(event,ui){/* update positions */}
    });
    jQuery(gjPageForm._selectors.source_list).sortable({
      connectWith: gjPageForm._selectors.target_list,
      helper: 'clone',
      revert: true
    });
    jQuery(gjPageForm._selectors.target_list+','+gjPageForm._selectors.source_list).disableSelection();
  },
  init:function()
  {
    jQuery(gjPageForm._selectors.button_add).click(gjPageForm.addDesignElement);
    gjPageForm.count = jQuery(gjPageForm._selectors.count).length;
    gjPageForm.initDragnDrop();
  }
}

jQuery(document).ready(gjPageForm.init);

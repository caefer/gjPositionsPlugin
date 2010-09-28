gjPageForm = {
  count:0,
  _selectors:{
    page_id:'input#gj_page_id',
    button_add:'button#add_design_element',
    source_list:'ul#design_element_source_list',
    target_list:'ul#design_element_target_list'
  },
  addDesignElement:function(listItem)
  {
    name = listItem.children('div')[0].className;
    id = jQuery(gjPageForm._selectors.page_id).val() || '0';
    url = gjPageFormConfig.url.replace('/0/xxx/0', '/'+id+'/'+name+'/'+gjPageForm.count);
    gjPageForm.count++;
    jQuery.get(url, function(data){gjPageForm.appendDesignElement(data, listItem)});
  },
  appendDesignElement:function(data, listItem)
  {
    listItem.replaceWith(data);
    gjPageForm.updatePositions();
  },
  updatePositions:function()
  {
    jQuery(gjPageForm._selectors.target_list+' input[type=hidden][name$=[position]]')
      .each(function(i,element){element.value = i})
  },
  initDragnDrop:function()
  {
    jQuery(gjPageForm._selectors.target_list).sortable({
      connectWith: gjPageForm._selectors.target_list,
      helper: 'clone',
      receive:function(event,ui){gjPageForm.addDesignElement(ui.item);},
      update:gjPageForm.updatePositions
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
    gjPageForm.count = jQuery(gjPageForm._selectors.target_list+' > li').length;
    gjPageForm.initDragnDrop();
  }
}

jQuery(document).ready(gjPageForm.init);

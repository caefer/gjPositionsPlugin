gjPageForm = {
  count:0,
  _selectors:{
    page_id:'input#gj_page_id',
    button_add:'button#add_design_element',
    source_list:'ul#design_element_source_list',
    target_list:'#design_element_target_list ol'
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
    // slightly modified version of the shopping cart demo
    // @see http://jqueryui.com/demos/droppable/#shopping-cart
    jQuery(gjPageForm._selectors.source_list+" li").draggable({
      connectToSortable: gjPageForm._selectors.target_list,
      helper: "clone"
    });

    jQuery(gjPageForm._selectors.target_list).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        jQuery( this ).find( ".placeholder" ).remove();
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        jQuery( this ).removeClass( "ui-state-default" );
      },
      receive:function(event,ui){gjPageForm.addDesignElement(jQuery(this).find('li.ui-draggable'));},
      update:gjPageForm.updatePositions
    });
  },
  init:function()
  {
    jQuery(gjPageForm._selectors.button_add).click(gjPageForm.addDesignElement);
    gjPageForm.count = jQuery(gjPageForm._selectors.target_list+' > li').length;
    gjPageForm.initDragnDrop();
  }
}

jQuery(document).ready(gjPageForm.init);

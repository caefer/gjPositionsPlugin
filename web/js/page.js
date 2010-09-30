gjPageForm = {
  count:0,
  _selectors:{
    page_id:'input#gj_page_id',
    source_list:'#design_element_source_list',
    target_list:'#design_element_target_list ol',
    elementTogglers:'.design-elements-head a'
  },
  receiveElement:function(event, ui)
  {
    jQuery( this ).find( ".placeholder" ).remove();
    ui.draggable.children('.design-element-include').slideDown();
  },
  updatePositions:function()
  {
    jQuery(gjPageForm._selectors.target_list+' input[type=hidden][name$=[position]]')
      .each(function(i,element){
        element.value = i;
      });
    count = gjPageForm.count++;
    jQuery(gjPageForm._selectors.target_list+' input[type=hidden][name^=gj_page[designElements][x]]')
      .each(function(i,element){
        jQuery(element).attr('name', jQuery(element).attr('name').replace(/\[x\]/, '['+count+']'));
      });
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
      drop: gjPageForm.receiveElement
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        jQuery( this ).removeClass( "ui-state-default" );
      },
      update:gjPageForm.updatePositions
    });
  },
  initDesignElements:function()
  {
    jQuery(gjPageForm._selectors.elementTogglers).click(gjPageForm.toggleDesignElement);
  },
  toggleDesignElement:function()
  {
    src = jQuery(this).children('img').attr('src');
    src = src.match(/more/) ? src.replace(/more/, 'less') : src.replace(/less/, 'more');
    jQuery(this).children('img').attr('src', src);
    jQuery(this).parent().next('.design-element-include').slideToggle();
  },
  init:function()
  {
    gjPageForm.count = jQuery(gjPageForm._selectors.target_list+' > li').length;
    gjPageForm.initDragnDrop();
    gjPageForm.initDesignElements();
  }
}

jQuery(document).ready(gjPageForm.init);

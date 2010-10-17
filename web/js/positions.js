gjDesignElements = {
  init:function()
  {
    $('.content > .positions_container')
      .sortable(
      {
        items:'li:not(.placeholder,.content_element_item)',
        axis:'y',
        sort:function(){$(this).removeClass('ui-state-default');},
        update:function(){$(this).find('input[name$=\[position\]]').not('input[name*=\[contents\]]').each(function(i,element){$(element).val(i);});}
      });
  }
}

gjContentElements = {
  init:function()
  {
    $('#design_element_items .positions_container')
      .sortable(
      {
        items:'li:.content_element_item',
        axis:'y',
        sort:function(){$(this).removeClass('ui-state-default');},
        update:function(){$(this).find('input[name$=\[position\]][name*=\[contents\]]').each(function(i,element){$(element).val(i);});}
      });
  }
}

jQuery(document).ready(gjDesignElements.init);
jQuery(document).ready(gjContentElements.init);

$.composition = {
  defaults: {
    sortableOptions:{
      axis:                 'y', 
      placeholder:          'ui-state-highlight',
      forcePlaceholderSize: true,
      over:                 function(event, ui){rm=false},
      out:                  function(event, ui){rm=true},
      beforeStop:           function(event, ui){if(true==rm) ui.item.remove()}
    },
    draggableOptions:{
      helper: 'clone',
      cursor: 'move'
    }
  }
};

(function($)
{
  $.fn.extend({
    compositionCanvas: function(options)
    {
      var options = $.extend({}, $.composition.defaults, options);

      $(this).sortable($.extend({ receive: designElementify }, options.sortableOptions));
      designElementify();

      $('#design_element_source_list > li').draggable($.extend({connectToSortable:'.composition-canvas'}, options.draggableOptions));

      return this;
    }
  });

  function designElementify(event, ui)
  {
    $('.content .design-element-head').hide();
    $('.content .design-element-include, .content .design-element-form').show();

    $('.design-element-canvas:not(.ui-sortable)').compositionDesignElement();
  }
})(jQuery);

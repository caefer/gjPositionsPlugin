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

      $('#design_element_source_list > li').draggable($.extend({
        connectToSortable:'.composition-canvas',
        start: showContainer,
        stop: hideContainer
      }, options.draggableOptions));

      $('.composition-canvas:empty').addClass('open');

      return this;
    }
  });

  function designElementify(event, ui)
  {
    if(event)
    {
      var canvas = $(event.target);
      canvas.find('.design-element-head').hide();
      canvas.find('.design-element-include').show();
      canvas.find('.design-element-form').show();
    }

    $('.design-element-canvas').compositionDesignElement();
  }

  function showContainer(event, ui)
  {
    $('.composition-canvas').addClass('open');
  }

  function hideContainer(event, ui)
  {
    $('.composition-canvas').removeClass('open');
  }
})(jQuery);

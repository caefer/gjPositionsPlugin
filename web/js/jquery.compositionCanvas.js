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
  var design_element_count = 0;

  $.fn.extend({
    compositionCanvas: function(options)
    {
      var options = $.extend({}, $.composition.defaults, options);

      $(this).sortable($.extend({ receive: updateDesignElement, update: updatePositions }, options.sortableOptions));

      designElementify();

      $('#design_element_source_list > li').draggable($.extend({
        connectToSortable:'.composition-canvas',
        start: showContainer,
        stop: hideContainer
      }, options.draggableOptions));

      $('.composition-canvas:empty').addClass('open');
      design_element_count = $('.composition-canvas > li').length;

      return this;
    }
  });

  function updateDesignElement(event, ui)
  {
    if(event)
    {
      var canvas = $(event.target);
      var current = canvas.children('.ui-draggable');
      canvas.find('.design-element-head').hide();
      canvas.find('.design-element-include').show();
      canvas.find('.design-element-form').show();
    }

    designElementify();
    updatePositions();
  }

  function updatePositions()
  {
    $('.composition-canvas .design-element').each(function(i, element){
      $(element).find('.design-element-form').children('input[id$=position]').val(i);
      $(element).find('input,select,textarea').each(function(j, _element){
        _element = $(_element);
        if(/_x_/.test(_element.attr('id')))
        {
          var index = nextAvailableIndex();
          _element.attr('id', _element.attr('id').replace(/_x_/, '_'+index+'_'));
          _element.attr('name', _element.attr('name').replace(/\[x\]/, '['+index+']'));
        }
      });
    });
  }

  var design_element_index = 0;
  function nextAvailableIndex()
  {
    var selector = 'input[id$=design_elements_'+design_element_index+'_id]';
    while($(selector).length)
    {
      design_element_index++;
       selector = 'input[id$=design_elements_'+design_element_index+'_id]';
       console.log(selector);
    }
    return design_element_index;
  }

  function designElementify()
  {
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

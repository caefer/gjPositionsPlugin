(function($)
{
  $.fn.extend({
    compositionDesignElement: function(options)
    {
      var options = $.extend({}, $.composition.defaults, options);

      $(this).sortable($.extend({ receive: updateContentElement, update: updatePositions }, options.sortableOptions));

      $('.content-elements > li').draggable($.extend({
        connectToSortable:'.design-element-canvas',
        start: showContainer,
        stop: hideContainer
      }, options.draggableOptions));

      return this;
    }
  });

  function updateContentElement(event, ui)
  {
    if(event)
    {
      var design_element_number = $(event.target).parents('.design-element').find('.design-element-form > input[id$=_id]').attr('id').replace(/^.*_(\d*)_.*$/, '$1');
      var content_element_number = $(event.target).find('.content-element').length;

      $(event.target).find('input,select,textarea').each(function(i, element){
        element = $(element);
        element.attr('name', element.attr('name').replace(/\[x\]/, '['+design_element_number+']').replace(/\[y\]/, '['+content_element_number+']'));
      });
    }

    $('.composition-canvas .content-element-override').show();
    $(event.target).children('li:not(content-element)').addClass('content-element');
  }

  function updatePositions(event, ui)
  {
    $(event.target).find('.content-element input[name$=position]]').each(function(i, element){
      $(element).val(i);
    });
  }

  function showContainer(event, ui)
  {
    var type = ui.helper.attr('class').split(' ')[0];
    $('.composition-canvas .design-element-canvas.'+type+':not(open)').each(function(i, element){
      $(element).addClass('open');
    });
  }

  function hideContainer(event, ui)
  {
    var type = ui.helper.attr('class').split(' ')[0];
    $('.composition-canvas .design-element-canvas').each(function(i, element){
      $(element).removeClass('open');
    });
  }
})(jQuery);

(function($)
{
  $.fn.extend({
    compositionDesignElement: function(options)
    {
      var options = $.extend({}, $.composition.defaults, options);

      $(this).sortable($.extend({}, options.sortableOptions, {receive: addContent}));

      $('.content-elements > li').draggable($.extend({
        connectToSortable:'.design-element-canvas',
        start: showContainer,
        stop: hideContainer
      }, options.draggableOptions));

      return this;
    }
  });

  function addContent(event, ui)
  {
    $(event.target).children('li:not(content-element)').addClass('content-element');
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

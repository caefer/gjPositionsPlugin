(function($)
{
  $.fn.extend({
    compositionDesignElement: function(options)
    {
      var options = $.extend({}, $.composition.defaults, options);

      $(this).sortable(options.sortableOptions);

      $('.content-elements > li').draggable($.extend({
        connectToSortable:'.design-element-canvas',
        start: showContainer,
        stop: hideContainer
      }, options.draggableOptions));

      return this;
    }
  });

  function showContainer(event, ui)
  {
    var type = ui.helper.attr('class').split(' ')[0];
    $('.composition-canvas .design-element-canvas.'+type+':empty:not(open)').each(function(i, element){
      $(element).addClass('open');
      $(element).append('<li class="design-element-canvas-signal">Drop it here</li>');
    });
  }

  function hideContainer(event, ui)
  {
    var type = ui.helper.attr('class').split(' ')[0];
    $('.composition-canvas .design-element-canvas').each(function(i, element){
      $(element).removeClass('open');
      $(element).children('.design-element-canvas-signal').remove();
    });
  }
})(jQuery);

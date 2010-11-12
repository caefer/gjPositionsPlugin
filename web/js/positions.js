gjCompositionCanvas = function(form)
{
  this.form = form;

  /**
   * updates all positions of embedded design and content elements
   */
  this.updatePositions = function(event)
  {
    form = $(event.currentTarget);
    form.find('.content > .positions_container > li').each(function(i, designelement)
    {
      $(designelement).find('input, select, textarea').each(function(j, field)
      {
        // update name
        field.name = field.name.replace(/\[design_elements\]\[(?:\d|x)\]/, '[design_elements]['+i+']')
        // update id
        field.id = field.id.replace(/design_elements_(?:\d|x)_/, 'design_elements_'+i+'_')
        // update position
        if(-1 != field.name.search(/\[design_elements\]\[(?:\d|x)\]\[position\]/))
        {
          field.value = i;
        }
      });
      $(designelement).find('.positions_container > li').each(function(j, contentelement)
      {
        $(contentelement).find('input, select, textarea').each(function(k, field)
        {
          // update name
          field.name = field.name.replace(/\[contents\]\[(?:\d|x)\]/, '[contents]['+j+']');
          // update id
          field.id = field.id.replace(/contents_(?:\d|x)_/, 'contents_'+j+'_');
          // update position
          if(-1 != field.name.search(/\[contents\]\[(?:\d|x)\]\[position\]/))
          {
            field.value = j;
          }
        //console.log(field.name+' => '+field.value);
        });
      });
    });
    //form.unbind();
    //return false;
  };

  this.turnCanvasToSortables = function()
  {
    design_element_container = this.form.find('.content > .positions_container');
    design_element_container.sortable({
      axis:'y',
      placeholder: 'ui-state-highlight',
      forcePlaceholderSize: true,
      receive: function(event, ui)
      {
        $(event.target).find('li:.ui-draggable').removeClass('ui-draggable').children('div').toggle();
        canvas.turnDesignElementsToSortables();
      },
      over: function(event, ui){removeMe = 0},
      out: function(event, ui){removeMe = 1},
      beforeStop: function(event, ui){if(1 == removeMe) ui.item.remove()}
    }).effect('highlight');

    $('#design_element_source_list > li').draggable({
      connectToSortable:design_element_container,
      helper:'clone'
    })
  }

  this.turnDesignElementsToSortables = function()
  {
    content_element_containers = this.form.find('.content .design-element-form .positions_container');
    content_element_containers.sortable({
      axis:'y',
      placeholder: 'ui-state-highlight',
      forcePlaceholderSize: true,
      receive: function(event, ui){$(event.target).find('li:.ui-draggable').removeClass('ui-draggable').children('div').toggle();},
      over: function(event, ui){removeMe = 0},
      out: function(event, ui){removeMe = 1},
      beforeStop: function(event, ui){if(1 == removeMe) ui.item.remove()}
    }).effect('highlight');

    $('#content_element_source_list .contents > li').draggable({
      connectToSortable:content_element_containers,
      helper:'clone'
    })
  }


  // initialisation
  this.form.submit(this.updatePositions);
  this.turnCanvasToSortables();
}
jQuery(document).ready(function(){canvas = new gjCompositionCanvas($('.sf_admin_form > form'))});

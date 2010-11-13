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
        // update name and id
        field.name = field.name.replace(/\[design_elements\]\[(?:\d|x)\]/, '[design_elements]['+i+']')
        field.id = field.id.replace(/design_elements_(?:\d|x)_/, 'design_elements_'+i+'_')
        // update position
        if(-1 != field.name.search(/\[design_elements\]\[(?:\d|x)\]\[position\]/))
        {
          field.value = i;
        }
      });
      total_content_elements = $(designelement).find('.positions_container > li').length;
      $(designelement).find('.positions_container > li').each(function(j, contentelement)
      {
        $(contentelement).find('input, select, textarea').each(function(k, field)
        {
          // update name and id
          field.name = field.name.replace(/\[contents\]\[(?:\d|x)\]/, '[contents]['+total_content_elements+']');
          field.id = field.id.replace(/contents_(?:\d|x)_/, 'contents_'+total_content_elements+'_');
          // update position
          if(-1 != field.name.search(/\[contents\]\[(?:\d|x)\]\[position\]/))
          {
            field.value = j;
          }
          //console.log(field.name+' => '+field.value);
        });
        total_content_elements++;
      });
    });
    //form.unbind();
    //return false;
  };

  this._sortableDefaultOptions = {
    axis:'y',
    placeholder: 'ui-state-highlight',
    forcePlaceholderSize: true,
    over: function(event, ui){removeMe = 0},
    out: function(event, ui){removeMe = 1},
    beforeStop: function(event, ui){if(1 == removeMe) ui.item.remove()}
  };

  this.receiveDesignElement = function(event, ui)
  {
    $(event.target).find('li:.ui-draggable').removeClass('ui-draggable').children('div').toggle();
    canvas.turnDesignElementsToSortables();
  }

  this.turnCanvasToSortables = function()
  {
    design_element_container = this.form.find('.content > .positions_container');
    design_element_container.sortable($.extend({receive: this.receiveDesignElement}, this._sortableDefaultOptions)).effect('highlight');

    $('#design_element_source_list > li').draggable({connectToSortable: design_element_container, helper: 'clone'})
  }

  this.turnDesignElementsToSortables = function()
  {
    content_element_containers = this.form.find('.content .design-element-form .positions_container');
    content_element_containers.sortable(this._sortableDefaultOptions).effect('highlight');

    $('#content_element_source_list .contents > li').draggable({connectToSortable: content_element_containers, helper: 'clone'})
  }


  // initialisation
  this.form.submit(this.updatePositions);
  this.turnCanvasToSortables();
}

jQuery(document).ready(function(){canvas = new gjCompositionCanvas($('.sf_admin_form > form'))});

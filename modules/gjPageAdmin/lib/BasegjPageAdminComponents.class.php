<?php

class BasegjPageAdminComponents extends sfComponents
{
  public function executeDesignElements(sfWebRequest $request)
  {
    $this->elements = sfConfig::get('app_gjPositionsPlugin_partials', array());

    $designElement = new gjDesignElement();
    $designElement->name = 'topTeaser';
    $designElement->Page = $this->page;
  }

  public function executeDesignElement(sfWebRequest $request)
  {
    $designElement = new gjDesignElement();
    $designElement->name = $this->name;
    $designElement->Page = $this->page;

    $this->form = new gjDesignElementForm($designElement);
    $this->form->getWidgetSchema()->setNameFormat('gj_page[designElements][x][%s]');
  }
}

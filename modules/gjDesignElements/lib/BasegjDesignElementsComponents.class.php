<?php

abstract class BasegjDesignElementsComponents extends sfComponents
{
  public function executeList(sfWebRequest $request)
  {
    $this->elements = sfConfig::get('app_gjPositionsPlugin_partials', array());
  }

  public function executeShow(sfWebRequest $request)
  {
    $designElement = new gjDesignElement();
    $designElement->name = $this->name;
    $designElement->Page = $this->page;

    $this->form = new gjDesignElementForm($designElement);
    $this->form->getWidgetSchema()->setNameFormat('gj_page[designElements][x][%s]');
  }
}

<?php

require_once dirname(__FILE__).'/gjPageAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/gjPageAdminGeneratorHelper.class.php';

/**
 * gjPageAdmin actions.
 *
 * @package    positions
 * @subpackage gjPageAdmin
 * @author     Christian Schaefer <caefer@ical.ly>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BasegjPageAdminActions extends autoGjPageAdminActions
{
  public function executeAddDesignElement(sfWebRequest $request)
  {
    //$this->forward404unless($request->isXmlHttpRequest());

    $number = intval($request->getParameter("num"));
    $page   = Doctrine_Core::getTable('gjPage')->find($request->getParameter('id'));

    $form = new gjPageForm($page);
    $form->addDesignElement($number);

    return $this->renderPartial('addDesignElement', array('form' => $form, 'num' => $number));
  }
}

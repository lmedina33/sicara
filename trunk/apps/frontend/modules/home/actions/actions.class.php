<?php

/**
 * home actions.
 *
 * @package    sicara2
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
//    $this->forward('default', 'module');
      $this->usuario = Doctrine_Core::getTable("Usuario")->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();
  }
}
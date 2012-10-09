<?php

/**
 * curInscrito actions.
 *
 * @package    sicara2
 * @subpackage curInscrito
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class curInscritoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cur_inscritos = Doctrine_Core::getTable('CurInscrito')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CurInscritoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CurInscritoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cur_inscrito = Doctrine_Core::getTable('CurInscrito')->find(array($request->getParameter('id_cur_inscrito'))), sprintf('Object cur_inscrito does not exist (%s).', $request->getParameter('id_cur_inscrito')));
    $this->form = new CurInscritoForm($cur_inscrito);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cur_inscrito = Doctrine_Core::getTable('CurInscrito')->find(array($request->getParameter('id_cur_inscrito'))), sprintf('Object cur_inscrito does not exist (%s).', $request->getParameter('id_cur_inscrito')));
    $this->form = new CurInscritoForm($cur_inscrito);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cur_inscrito = Doctrine_Core::getTable('CurInscrito')->find(array($request->getParameter('id_cur_inscrito'))), sprintf('Object cur_inscrito does not exist (%s).', $request->getParameter('id_cur_inscrito')));
    $cur_inscrito->delete();

    $this->redirect('curInscrito/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cur_inscrito = $form->save();

      $this->redirect('curInscrito/edit?id_cur_inscrito='.$cur_inscrito->getIdCurInscrito());
    }
  }
}

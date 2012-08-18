<?php

/**
 * inscrito actions.
 *
 * @package    sicara2
 * @subpackage inscrito
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inscritoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->inscritos = Doctrine_Core::getTable('inscrito')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new inscritoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new inscritoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($inscrito = Doctrine_Core::getTable('Inscrito')->find(array($request->getParameter('numero_formulario'))), sprintf('Object inscrito does not exist (%s).', $request->getParameter('numero_formulario')));
    $this->form = new inscritoForm($inscrito);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($inscrito = Doctrine_Core::getTable('inscrito')->find(array($request->getParameter('id_inscrito'))), sprintf('Object inscrito does not exist (%s).', $request->getParameter('id_inscrito')));
    $this->form = new inscritoForm($inscrito);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($inscrito = Doctrine_Core::getTable('inscrito')->find(array($request->getParameter('id_inscrito'))), sprintf('Object inscrito does not exist (%s).', $request->getParameter('id_inscrito')));
    $inscrito->delete();

    $this->redirect('inscrito/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $inscrito = $form->save();

      $this->redirect('inscrito/edit?id_inscrito='.$inscrito->getIdInscrito());
    }
  }
}

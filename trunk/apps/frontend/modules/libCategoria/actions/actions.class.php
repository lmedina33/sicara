<?php

/**
 * libCategoria actions.
 *
 * @package    sicara2
 * @subpackage libCategoria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libCategoriaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lib_categorias = Doctrine_Core::getTable('LibCategoria')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LibCategoriaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LibCategoriaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lib_categoria = Doctrine_Core::getTable('LibCategoria')->find(array($request->getParameter('codigo_lib_categoria'))), sprintf('Object lib_categoria does not exist (%s).', $request->getParameter('codigo_lib_categoria')));
    $this->form = new LibCategoriaForm($lib_categoria);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lib_categoria = Doctrine_Core::getTable('LibCategoria')->find(array($request->getParameter('codigo_lib_categoria'))), sprintf('Object lib_categoria does not exist (%s).', $request->getParameter('codigo_lib_categoria')));
    $this->form = new LibCategoriaForm($lib_categoria);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lib_categoria = Doctrine_Core::getTable('LibCategoria')->find(array($request->getParameter('codigo_lib_categoria'))), sprintf('Object lib_categoria does not exist (%s).', $request->getParameter('codigo_lib_categoria')));
    $lib_categoria->delete();

    $this->redirect('libCategoria/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $lib_categoria = $form->save();

      $this->redirect('libCategoria/edit?codigo_lib_categoria='.$lib_categoria->getCodigoLibCategoria());
    }
  }
}

<?php

/**
 * libMaterial actions.
 *
 * @package    sicara2
 * @subpackage libMaterial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libMaterialActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lib_materials = Doctrine_Core::getTable('LibMaterial')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LibMaterialForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LibMaterialForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
    $this->form = new LibMaterialForm($lib_material);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
    $this->form = new LibMaterialForm($lib_material);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
    $lib_material->delete();

    $this->redirect('libMaterial/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $lib_material = $form->save();

      $this->redirect('libMaterial/edit?codigo_lib_material='.$lib_material->getCodigoLibMaterial());
    }
  }
}

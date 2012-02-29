<?php

/**
 * libTipoMaterial actions.
 *
 * @package    sicara2
 * @subpackage libTipoMaterial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libTipoMaterialActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lib_tipo_materials = Doctrine_Core::getTable('LibTipoMaterial')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LibTipoMaterialForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LibTipoMaterialForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lib_tipo_material = Doctrine_Core::getTable('LibTipoMaterial')->find(array($request->getParameter('id_lib_tipo_material'))), sprintf('Object lib_tipo_material does not exist (%s).', $request->getParameter('id_lib_tipo_material')));
    $this->form = new LibTipoMaterialForm($lib_tipo_material);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lib_tipo_material = Doctrine_Core::getTable('LibTipoMaterial')->find(array($request->getParameter('id_lib_tipo_material'))), sprintf('Object lib_tipo_material does not exist (%s).', $request->getParameter('id_lib_tipo_material')));
    $this->form = new LibTipoMaterialForm($lib_tipo_material);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lib_tipo_material = Doctrine_Core::getTable('LibTipoMaterial')->find(array($request->getParameter('id_lib_tipo_material'))), sprintf('Object lib_tipo_material does not exist (%s).', $request->getParameter('id_lib_tipo_material')));
    $lib_tipo_material->delete();

    $this->redirect('libTipoMaterial/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $lib_tipo_material = $form->save();

      $this->redirect('libTipoMaterial/edit?id_lib_tipo_material='.$lib_tipo_material->getIdLibTipoMaterial());
    }
  }
}

<?php

/**
 * libTipoMaterial actions.
 *
 * @package    sicara2
 * @subpackage libTipoMaterial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libTipoMaterialActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->lib_tipo_materials = Doctrine_Core::getTable('LibTipoMaterial')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new LibTipoMaterialForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LibTipoMaterialForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($this->lib_tipo_material = Doctrine_Core::getTable('LibTipoMaterial')->find(array($request->getParameter('id_lib_tipo_material'))), sprintf('Object lib_tipo_material does not exist (%s).', $request->getParameter('id_lib_tipo_material')));
        $this->form = new LibTipoMaterialForm($this->lib_tipo_material);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($lib_tipo_material = Doctrine_Core::getTable('LibTipoMaterial')->find(array($request->getParameter('id_lib_tipo_material'))), sprintf('Object lib_tipo_material does not exist (%s).', $request->getParameter('id_lib_tipo_material')));
        $this->form = new LibTipoMaterialForm($lib_tipo_material);

        $this->processForm($request, $this->form, true);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($lib_tipo_material = Doctrine_Core::getTable('LibTipoMaterial')->find(array($request->getParameter('id_lib_tipo_material'))), sprintf('Object lib_tipo_material does not exist (%s).', $request->getParameter('id_lib_tipo_material')));
        $lib_tipo_material->delete();
        
        $this->getUser()->setAttribute('notice', 'El tipo de material dado ha sido completamente eliminado del sistema.');

        $this->redirect('libTipoMaterial/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $editado = false) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $lib_tipo_material = $form->save();
            if ($editado)
                $this->getUser()->setAttribute('notice', 'El tipo de material ' . $lib_tipo_material->getNombre() . ' ha sido editado exitosamente.');
            else
                $this->getUser()->setAttribute('notice', 'El nuevo tipo de material ' . $lib_tipo_material->getNombre() . ' ha sido creado exitosamente.');
        } else {
            if ($editado)
                $this->getUser()->setAttribute('error', 'El tipo de material no ha podido ser editado.');
            else
                $this->getUser()->setAttribute('error', 'El nuevo tipo de material no ha podido ser creado.');
        }

        $this->redirect('libTipoMaterial/index');
    }

}

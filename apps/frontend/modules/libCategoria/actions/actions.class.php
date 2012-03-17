<?php

/**
 * libCategoria actions.
 *
 * @package    sicara2
 * @subpackage libCategoria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libCategoriaActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->lib_categorias = Doctrine_Core::getTable('LibCategoria')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new LibCategoriaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LibCategoriaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($lib_categoria = Doctrine_Core::getTable('LibCategoria')->find(array($request->getParameter('codigo_lib_categoria'))), sprintf('Object lib_categoria does not exist (%s).', $request->getParameter('codigo_lib_categoria')));
        $this->form = new LibCategoriaForm($lib_categoria);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($lib_categoria = Doctrine_Core::getTable('LibCategoria')->find(array($request->getParameter('codigo_lib_categoria'))), sprintf('Object lib_categoria does not exist (%s).', $request->getParameter('codigo_lib_categoria')));
        $this->form = new LibCategoriaForm($lib_categoria);

        $this->processForm($request, $this->form, true);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($lib_categoria = Doctrine_Core::getTable('LibCategoria')->find(array($request->getParameter('codigo_lib_categoria'))), sprintf('Object lib_categoria does not exist (%s).', $request->getParameter('codigo_lib_categoria')));
        $lib_categoria->delete();
        
        $this->getUser()->setAttribute('notice', 'La categoria dada ha sido completamente eliminada del sistema.');

        $this->redirect('libCategoria/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $editado=false) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $lib_categoria = $form->save();
            if ($editado)
                $this->getUser()->setAttribute('notice', 'La categoría ' . $lib_categoria . ' ha sido editada exitosamente.');
            else
                $this->getUser()->setAttribute('notice', 'La nueva categoria ' . $lib_categoria . ' ha sido creada exitosamente.');
        }else{
            if ($editado)
                $this->getUser()->setAttribute('error', 'La categoria no ha podido ser editada.');
            else
                $this->getUser()->setAttribute('error', 'La nueva categoria no ha podido ser creada.');
        }
        $this->redirect('libCategoria/index');
    }

    public function executeValidarCodigo(sfWebRequest $request) {
        $value = $request->getParameter('fieldValue');
        $id = $request->getParameter('fieldId');
        $categoria = Doctrine_Core::getTable('LibCategoria')->find($value);
        $data = array();
        $data[0] = $id;
        if ($categoria == null) {
            $data[1] = true;
        } else {
            $data[1] = false;
        }

        return $this->renderText(json_encode($data));
    }

}

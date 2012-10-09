<?php

/**
 * curEmpresa actions.
 *
 * @package    sicara2
 * @subpackage curEmpresa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class curEmpresaActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->cur_empresas = Doctrine_Core::getTable('CurEmpresa')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new CurEmpresaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CurEmpresaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($cur_empresa = Doctrine_Core::getTable('CurEmpresa')->find(array($request->getParameter('id_cur_empresa'))), sprintf('Object cur_empresa does not exist (%s).', $request->getParameter('id_cur_empresa')));
        $this->form = new CurEmpresaForm($cur_empresa);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cur_empresa = Doctrine_Core::getTable('CurEmpresa')->find(array($request->getParameter('id_cur_empresa'))), sprintf('Object cur_empresa does not exist (%s).', $request->getParameter('id_cur_empresa')));
        $this->form = new CurEmpresaForm($cur_empresa);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($cur_empresa = Doctrine_Core::getTable('CurEmpresa')->find(array($request->getParameter('id_cur_empresa'))), sprintf('Object cur_empresa does not exist (%s).', $request->getParameter('id_cur_empresa')));
        $cur_empresa->delete();

        $this->redirect('curEmpresa/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $cur_empresa = $form->save();
            $this->getUser()->setAttribute('notice', 'La empresa ha sido creada con éxito.');
//      $this->redirect('curEmpresa/edit?id_cur_empresa='.$cur_empresa->getIdCurEmpresa());
        }else{
            $this->getUser()->setAttribute('error', 'La empresa no ha podido ser creada con éxito.');
        }
        $this->redirect('curCurso/index');
    }

}

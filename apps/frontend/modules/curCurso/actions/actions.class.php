<?php

/**
 * curCurso actions.
 *
 * @package    sicara2
 * @subpackage curCurso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class curCursoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cur_cursos = Doctrine_Core::getTable('CurCurso')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CurCursoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CurCursoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cur_curso = Doctrine_Core::getTable('CurCurso')->find(array($request->getParameter('id_cur_curso'))), sprintf('Object cur_curso does not exist (%s).', $request->getParameter('id_cur_curso')));
    $this->form = new CurCursoForm($cur_curso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cur_curso = Doctrine_Core::getTable('CurCurso')->find(array($request->getParameter('id_cur_curso'))), sprintf('Object cur_curso does not exist (%s).', $request->getParameter('id_cur_curso')));
    $this->form = new CurCursoForm($cur_curso);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cur_curso = Doctrine_Core::getTable('CurCurso')->find(array($request->getParameter('id_cur_curso'))), sprintf('Object cur_curso does not exist (%s).', $request->getParameter('id_cur_curso')));
    $cur_curso->delete();

    $this->redirect('curCurso/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cur_curso = $form->save();

      $this->redirect('curCurso/edit?id_cur_curso='.$cur_curso->getIdCurCurso());
    }
  }
}

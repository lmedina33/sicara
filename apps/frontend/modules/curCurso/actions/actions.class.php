<?php

/**
 * curCurso actions.
 *
 * @package    sicara2
 * @subpackage curCurso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class curCursoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->cur_cursos = Doctrine_Core::getTable('CurCurso')
                ->createQuery('a')
                ->execute();

        $this->empresas = Doctrine_Core::getTable('CurEmpresa')
                ->createQuery('e')
                ->orderBy('nombre ASC')
                ->execute();
        $this->cursos = array();

        foreach ($this->empresas as $empresa) {
            $this->cursos[] = Doctrine_Core::getTable('CurCurso')
                    ->createQuery()
                    ->orderBy('fecha_inicio ASC')
                    ->where('id_cur_empresa = ?', $empresa->getIdCurEmpresa())
                    ->execute();
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new CurCursoForm();
        $this->form->setDefault('is_inscribible', '');
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CurCursoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($cur_curso = Doctrine_Core::getTable('CurCurso')->find(array($request->getParameter('id_cur_curso'))), sprintf('Object cur_curso does not exist (%s).', $request->getParameter('id_cur_curso')));
        $this->form = new CurCursoForm($cur_curso);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cur_curso = Doctrine_Core::getTable('CurCurso')->find(array($request->getParameter('id_cur_curso'))), sprintf('Object cur_curso does not exist (%s).', $request->getParameter('id_cur_curso')));
        $this->form = new CurCursoForm($cur_curso);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($cur_curso = Doctrine_Core::getTable('CurCurso')->find(array($request->getParameter('id_cur_curso'))), sprintf('Object cur_curso does not exist (%s).', $request->getParameter('id_cur_curso')));
        $cur_curso->delete();

        $this->redirect('curCurso/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $cur_curso = $form->save();

            $this->redirect('curCurso/edit?id_cur_curso=' . $cur_curso->getIdCurCurso());
        }
    }

    public function executeShowCursos(sfWebRequest $request) {
        $this->cur_cursos = Doctrine_Core::getTable('CurCurso')
                ->createQuery('c')
                ->leftJoin('c.CurEmpresa e')
                ->where('c.is_inscribible = 1')
                ->andWhere('c.fecha_fin > ?', date('Y-m-d'))
                ->orderBy('e.nombre ASC')
                ->execute();
    }

    public function executeVerInscritos(sfWebRequest $request) {
        $this->curso = Doctrine_Core::getTable('CurCurso')->find($request->getParameter('id'));
        $this->formularios = Doctrine_Core::getTable('CurFormulario')->findBy('id_cur_curso', $this->curso->getIdCurCurso());
    }

    public function executeBorrarInscrito(sfWebRequest $request) {
        $formulario = Doctrine_Core::getTable('CurFormulario')->find($request->getParameter("id"));

        if ($formulario != null) {
            $formulario->delete();
            $this->getUser()->setAttribute('notice', 'El inscrito ha sido eliminado con éxito.');
        } else {
            $this->getUser()->setAttribute('notice', 'El inscrito no pudo ser eliminado exitosamente.');
        }

        $this->redirect("curCurso/verInscritos?id=" . $request->getParameter("idCur"));
    }

    public function executeShowCalCursos(sfWebRequest $request) {
        $this->cursos = Doctrine_Core::getTable('CurCurso')
                ->createQuery('c')
                ->leftJoin('c.CurEmpresa e')
                ->where('c.is_inscribible = 1')
                ->andWhere('c.fecha_inicio > ?', date('Y-m-d', strtotime('-1 year')))
                ->orderBy('e.nombre ASC')
                ->execute();
    }

    public function executeGetCursos(sfWebRequest $request) {
        $fecha = $request->getParameter("fecha");

        if ($fecha == "" || $fecha == null) {
            $cursos = Doctrine_Core::getTable("CurCurso")
                    ->createQuery('c')
                    ->leftJoin('c.CurEmpresa e')
                    ->where('c.is_inscribible = 1')
                    ->andWhere('c.fecha_inicio > ?', date('Y-m-d'))
                    ->orderBy('c.fecha_inicio ASC')
                    ->limit(5)
                    ->execute();

            if ($cursos != null) {
                $data = array();
                
                foreach ($cursos as $curso){
                    $row = array();
                    $row['id']=$curso->getIdCurCurso();
                    $row['nombre']=$curso->getNombre();
                    $row['empresa']=$curso->getCurEmpresa()->getNombre();
                    $row['fecha']=$curso->getFechaInicio();
                    $row['duracion']=$curso->getDuracion();
                    
                    $data[]=$row;
                }

                return $this->renderText(json_encode($data));
            }
        }else{
            $cursos = Doctrine_Core::getTable("CurCurso")
                    ->createQuery('c')
                    ->leftJoin('c.CurEmpresa e')
                    ->where('c.is_inscribible = 1')
                    ->andWhere('c.fecha_inicio = ?', $fecha)
                    ->orderBy('e.nombre ASC')
                    ->limit(5)
                    ->execute();

            if ($cursos != null) {
                $data = array();
                
                foreach ($cursos as $curso){
                    $row = array();
                    $row['id']=$curso;
                    $row['nombre']=$curso->getNombre();
                    $row['empresa']=$curso->getCurEmpresa()->getNombre();
                    $row['fecha']=$curso->getFechaInicio();
                    $row['duracion']=$curso->getDuracion();
                    
                    $data[]=$row;
                }

                return $this->renderText(json_encode($data));
            }
        }

        return $this->renderText(json_encode(false));
    }

}

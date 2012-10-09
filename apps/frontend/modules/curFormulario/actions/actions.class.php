<?php

/**
 * curFormulario actions.
 *
 * @package    sicara2
 * @subpackage curFormulario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class curFormularioActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->cur_formularios = Doctrine_Core::getTable('CurFormulario')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $formInscrito = new CurInscritoDocForm();
        $formInscrito->bind($request->getParameter($formInscrito->getName()));

        $this->inscrito = Doctrine_Core::getTable('CurInscrito')->findBySql('documento = ? AND id_tipo_documento = ?', array($formInscrito->getValue('documento'), $formInscrito->getValue('id_tipo_documento')))->getFirst();

        if ($this->inscrito == null) {
            $this->redirect('curFormulario/newFull?curso=' . $formInscrito->getValue('curso') . '&doc=' . $formInscrito->getValue('documento') . '&tip=' . $formInscrito->getValue('id_tipo_documento'));
        } else {
            $formulario = Doctrine_Core::getTable('CurFormulario')->findBySql('id_cur_inscrito = ' . $this->inscrito->getIdCurInscrito() . ' AND id_cur_curso = ' . $formInscrito->getValue('curso'))->getFirst();
            $this->form = new CurFormularioForm($formulario);
            $this->form->setDefault('id_cur_curso', $formInscrito->getValue('curso'));
            $this->form->setDefault('id_cur_inscrito', $this->inscrito->getIdCurInscrito());

            $this->curso = Doctrine_Core::getTable('CurCurso')->find($formInscrito->getValue('curso'));
        }
    }

    public function executeNewFull(sfWebRequest $request) {
        $this->curso = Doctrine_Core::getTable('CurCurso')->find($request->getParameter('curso'));
        $this->formInscrito = new CurInscritoForm();

        $this->form = new CurFormularioForm();
        $this->form->setDefault('id_cur_curso', $request->getParameter('curso'));

        $this->formInscrito->setDefault('documento', $request->getParameter('doc'));
        $this->formInscrito->setDefault('id_tipo_documento', $request->getParameter('tip'));

        $tipoDoc = Doctrine_Core::getTable('TipoDocumento')->find($request->getParameter('tip'));
        $this->tipo = $tipoDoc->getNombre();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CurFormularioForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeCreateFull(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CurFormularioForm();
        $this->formInscrito = new CurInscritoForm();

        $this->processForm($request, $this->form, $this->formInscrito);

        $this->setTemplate('new');
    }

    public function executeEditFull(sfWebRequest $request) {
        $formulario = Doctrine_Core::getTable('CurFormulario')->find($request->getParameter('id'));

        $this->curso = $formulario->getCurCurso();
        $this->formInscrito = new CurInscritoForm($formulario->getCurInscrito());

        $this->form = new CurFormularioForm($formulario);
        $this->form->setDefault('id_cur_curso', $formulario->getIdCurCurso());

        $this->formInscrito->setDefault('documento', $formulario->getCurInscrito()->getDocumento());
        $this->formInscrito->setDefault('id_tipo_documento', $formulario->getCurInscrito()->getIdTipoDocumento());

        $this->tipo = $formulario->getCurInscrito()->getTipoDocumento();
    }

    public function executeUpdateFull(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $formInscrito = new CurInscritoForm();
        
        $dataIns = $request->getParameter($formInscrito->getName());

        $inscrito = Doctrine_Core::getTable('CurInscrito')->find($dataIns['id_cur_inscrito']);

        if ($inscrito == null) {
            $inscrito = new CurInscrito();
        }

        $inscrito->setPrimerNombre($dataIns['primer_nombre']);
        $inscrito->setSegundoNombre($dataIns['segundo_nombre']);
        $inscrito->setPrimerApellido($dataIns['primer_apellido']);
        $inscrito->setSegundoApellido($dataIns['segundo_apellido']);
        $inscrito->setDocumento($dataIns['documento']);
        $inscrito->setIdTipoDocumento($dataIns['id_tipo_documento']);
        $inscrito->setLugarExpedicion($dataIns['lugar_expedicion']);
        $inscrito->setTelefono1($dataIns['telefono1']);
        $inscrito->setTelefono2($dataIns['telefono2']);
        $inscrito->setCorreo($dataIns['correo']);
        $inscrito->save();
        
        $form = new CurFormularioForm();

        $data = $request->getParameter($form->getName());

        $formulario = Doctrine_Core::getTable('CurFormulario')->find($data['id_cur_formulario']);

        if ($formulario == null) {
            $formulario = new CurFormulario();
        }

        $formulario->setDireccion($data['direccion']);
        $formulario->setDependencia($data['dependencia']);
        $formulario->setCargo($data['cargo']);
        $formulario->setTelefono($data['telefono']);
        $formulario->setHorario($data['horario']);
        $formulario->setLicenciaBasica1($data['licencia_basica1']);
        $formulario->setNumeroLicencia1($data['numero_licencia1']);
        $formulario->setHabilitacion1($data['habilitacion1']);
        $formulario->setFechaExpedicion1(($data['fecha_expedicion1'] =="" ? null:$data['fecha_expedicion1']));
        $formulario->setFechaRepaso1(($data['fecha_repaso1'] =="" ? null:$data['fecha_repaso1']));
        $formulario->setLicenciaBasica2($data['licencia_basica2']);
        $formulario->setNumeroLicencia2($data['numero_licencia2']);
        $formulario->setHabilitacion2($data['habilitacion2']);
        $formulario->setFechaExpedicion2(($data['fecha_expedicion2'] =="" ? null:$data['fecha_expedicion2']));
        $formulario->setFechaRepaso2(($data['fecha_repaso2'] =="" ? null:$data['fecha_repaso2']));
        $formulario->setLicenciaBasica3($data['licencia_basica3']);
        $formulario->setNumeroLicencia3($data['numero_licencia3']);
        $formulario->setHabilitacion3($data['habilitacion3']);
        $formulario->setFechaExpedicion3(($data['fecha_expedicion3'] =="" ? null:$data['fecha_expedicion3']));
        $formulario->setFechaRepaso3(($data['fecha_repaso3'] =="" ? null:$data['fecha_repaso3']));
        $formulario->setLicenciaBasica4($data['licencia_basica4']);
        $formulario->setNumeroLicencia4($data['numero_licencia4']);
        $formulario->setHabilitacion4($data['habilitacion4']);
        $formulario->setFechaExpedicion4(($data['fecha_expedicion4'] =="" ? null:$data['fecha_expedicion4']));
        $formulario->setFechaRepaso4(($data['fecha_repaso4'] =="" ? null:$data['fecha_repaso4']));
        $formulario->setIdCurInscrito($data['id_cur_inscrito']);
        $formulario->setIdCurCurso($data['id_cur_curso']);
        $formulario->save();

        $this->getUser()->setAttribute('notice', 'El inscrito se ha modificado con éxito.');
        
        $this->redirect('curFormulario/verInscrito?id='.$formulario->getIdCurFormulario());

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($cur_formulario = Doctrine_Core::getTable('CurFormulario')->find(array($request->getParameter('id_cur_formulario'),
            $request->getParameter('id_cur_inscrito'),
            $request->getParameter('id_cur_curso'))), sprintf('Object cur_formulario does not exist (%s).', $request->getParameter('id_cur_formulario'), $request->getParameter('id_cur_inscrito'), $request->getParameter('id_cur_curso')));
        $this->form = new CurFormularioForm($cur_formulario);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cur_formulario = Doctrine_Core::getTable('CurFormulario')->find(array($request->getParameter('id_cur_formulario'),
            $request->getParameter('id_cur_inscrito'),
            $request->getParameter('id_cur_curso'))), sprintf('Object cur_formulario does not exist (%s).', $request->getParameter('id_cur_formulario'), $request->getParameter('id_cur_inscrito'), $request->getParameter('id_cur_curso')));
        $this->form = new CurFormularioForm($cur_formulario);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($cur_formulario = Doctrine_Core::getTable('CurFormulario')->find(array($request->getParameter('id_cur_formulario'),
            $request->getParameter('id_cur_inscrito'),
            $request->getParameter('id_cur_curso'))), sprintf('Object cur_formulario does not exist (%s).', $request->getParameter('id_cur_formulario'), $request->getParameter('id_cur_inscrito'), $request->getParameter('id_cur_curso')));
        $cur_formulario->delete();

        $this->redirect('curFormulario/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, sfForm $formInscrito = null) {
        if ($formInscrito == null) {

            $data = $request->getParameter($form->getName());

            $formulario = Doctrine_Core::getTable('CurFormulario')->find($data['id_cur_formulario']);

            if ($formulario == null) {
                $formulario = new CurFormulario();
            }

            $formulario->setDireccion($data['direccion']);
            $formulario->setDependencia($data['dependencia']);
            $formulario->setCargo($data['cargo']);
            $formulario->setTelefono($data['telefono']);
            $formulario->setHorario($data['horario']);
            $formulario->setLicenciaBasica1($data['licencia_basica1']);
            $formulario->setNumeroLicencia1($data['numero_licencia1']);
            $formulario->setHabilitacion1($data['habilitacion1']);
            $formulario->setFechaExpedicion1($data['fecha_expedicion1']);
            $formulario->setFechaRepaso1($data['fecha_repaso1']);
            $formulario->setLicenciaBasica2($data['licencia_basica2']);
            $formulario->setNumeroLicencia2($data['numero_licencia2']);
            $formulario->setHabilitacion2($data['habilitacion2']);
            $formulario->setFechaExpedicion2($data['fecha_expedicion2']);
            $formulario->setFechaRepaso2($data['fecha_repaso2']);
            $formulario->setLicenciaBasica3($data['licencia_basica3']);
            $formulario->setNumeroLicencia3($data['numero_licencia3']);
            $formulario->setHabilitacion3($data['habilitacion3']);
            $formulario->setFechaExpedicion3($data['fecha_expedicion3']);
            $formulario->setFechaRepaso3($data['fecha_repaso3']);
            $formulario->setLicenciaBasica4($data['licencia_basica4']);
            $formulario->setNumeroLicencia4($data['numero_licencia4']);
            $formulario->setHabilitacion4($data['habilitacion4']);
            $formulario->setFechaExpedicion4($data['fecha_expedicion4']);
            $formulario->setFechaRepaso4($data['fecha_repaso4']);
            $formulario->setIdCurInscrito($data['id_cur_inscrito']);
            $formulario->setIdCurCurso($data['id_cur_curso']);
            $formulario->save();

            $this->redirect('curFormulario/showConfirm');
        } else {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
            $formInscrito->bind($request->getParameter($formInscrito->getName()), $request->getFiles($formInscrito->getName()));

            if ($form->isValid() && $formInscrito->isValid()) {
                $inscrito = $formInscrito->save();

                $data = $request->getParameter($form->getName());
                $data['id_cur_inscrito'] = $inscrito->getIdCurInscrito();
                print_r($data);
                $formulario = new CurFormulario();
                $formulario->setDireccion($data['direccion']);
                $formulario->setDependencia($data['dependencia']);
                $formulario->setCargo($data['cargo']);
                $formulario->setTelefono($data['telefono']);
                $formulario->setHorario($data['horario']);
                $formulario->setLicenciaBasica1($data['licencia_basica1']);
                $formulario->setNumeroLicencia1($data['numero_licencia1']);
                $formulario->setHabilitacion1($data['habilitacion1']);
                $formulario->setFechaExpedicion1($data['fecha_expedicion1']);
                $formulario->setFechaRepaso1($data['fecha_repaso1']);
                $formulario->setLicenciaBasica2($data['licencia_basica2']);
                $formulario->setNumeroLicencia2($data['numero_licencia2']);
                $formulario->setHabilitacion2($data['habilitacion2']);
                $formulario->setFechaExpedicion2($data['fecha_expedicion2']);
                $formulario->setFechaRepaso2($data['fecha_repaso2']);
                $formulario->setLicenciaBasica3($data['licencia_basica3']);
                $formulario->setNumeroLicencia3($data['numero_licencia3']);
                $formulario->setHabilitacion3($data['habilitacion3']);
                $formulario->setFechaExpedicion3($data['fecha_expedicion3']);
                $formulario->setFechaRepaso3($data['fecha_repaso3']);
                $formulario->setLicenciaBasica4($data['licencia_basica4']);
                $formulario->setNumeroLicencia4($data['numero_licencia4']);
                $formulario->setHabilitacion4($data['habilitacion4']);
                $formulario->setFechaExpedicion4($data['fecha_expedicion4']);
                $formulario->setFechaRepaso4($data['fecha_repaso4']);
                $formulario->setIdCurInscrito($inscrito->getIdCurInscrito());
                $formulario->setIdCurCurso($data['id_cur_curso']);
                $formulario->save();

                $this->redirect('curFormulario/showConfirm');
            }
            $this->getUser()->setAttribute('error', 'No se pudo registrar sus datos.');
            $this->setTemplate('newFull');
        }
    }

    public function executeRegistrar(sfWebRequest $request) {

        $this->curso = Doctrine_Core::getTable('CurCurso')->find($request->getParameter('curso'));

        if ($this->curso == null || $this->curso->getIsInscribible() == 0 || $this->curso->getFechaFin() < date('Y-m-d')) {
            $this->getUser()->setAttribute('error', 'El curso al que intenta inscribirse no se encuentra disponible.');
            $this->redirect('curCurso/showCursos');
        }

        $this->form = new CurInscritoDocForm();
        $this->form->setDefault('curso', $request->getParameter('curso'));
    }

    public function executeShowConfirm(sfWebRequest $request) {
        
    }
    
    public function executeVerInscrito(sfWebRequest $request) {
        $formulario = Doctrine_Core::getTable('CurFormulario')->find($request->getParameter('id'));

        $this->curso = $formulario->getCurCurso();
        $this->formInscrito = new CurInscritoForm($formulario->getCurInscrito());

        $this->form = new CurFormularioForm($formulario);
        $this->form->setDefault('id_cur_curso', $formulario->getIdCurCurso());

        $this->formInscrito->setDefault('documento', $formulario->getCurInscrito()->getDocumento());
        $this->formInscrito->setDefault('id_tipo_documento', $formulario->getCurInscrito()->getIdTipoDocumento());

        $this->tipo = $formulario->getCurInscrito()->getTipoDocumento();
    }
    
    public function executeGenerarFormulario(sfWebRequest $request) {
        $elemento = Doctrine_Core::getTable('CurFormulario')->find($request->getParameter('id'));

        sfConfig::set('sf_web_debug', false);

        $pdf = new FormularioInscripcionCurPdf('P', 'mm', 'letter');

        $pdf->setElemento($elemento);
        $pdf->generar();
//        $pdf->Output('FormularioInscripcionEAC.pdf', 'D');
        $pdf->Output();

        throw new sfStopException();
    }

}

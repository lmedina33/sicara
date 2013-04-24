<?php

/**
 * refHojaVida actions.
 *
 * @package    sicara2
 * @subpackage refHojaVida
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class refHojaVidaActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->ref_hoja_vidas = Doctrine_Core::getTable('RefHojaVida')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new RefHojaVidaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new RefHojaVidaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('verByElemento');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($ref_hoja_vida = Doctrine_Core::getTable('RefHojaVida')->find(array($request->getParameter('id_ref_hoja_vida'))), sprintf('Object ref_hoja_vida does not exist (%s).', $request->getParameter('id_ref_hoja_vida')));
        $this->form = new RefHojaVidaForm($ref_hoja_vida);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($ref_hoja_vida = Doctrine_Core::getTable('RefHojaVida')->find(array($request->getParameter('id_ref_hoja_vida'))), sprintf('Object ref_hoja_vida does not exist (%s).', $request->getParameter('id_ref_hoja_vida')));
        $this->form = new RefHojaVidaForm($ref_hoja_vida);

        $this->processForm($request, $this->form);

        $this->setTemplate('verByElemento');
    }

//    public function executeDelete(sfWebRequest $request) {
//        $request->checkCSRFProtection();
//
//        $this->forward404Unless($ref_hoja_vida = Doctrine_Core::getTable('RefHojaVida')->find(array($request->getParameter('id_ref_hoja_vida'))), sprintf('Object ref_hoja_vida does not exist (%s).', $request->getParameter('id_ref_hoja_vida')));
//        $ref_hoja_vida->delete();
//
//        $this->redirect('refHojaVida/index');
//    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid() && $form->getValue('descripcion') != "") {
            $ref_hoja_vida = $form->save();

            $this->redirect('refHojaVida/verByElemento?idEle=' . $ref_hoja_vida->getIdRefElemento());
        }
    }

    public function executeVerByElemento(sfWebRequest $request) {
        $usuario = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user', $this->getUser()->getGuardUser()->getId())->getFirst();

        $this->elemento = Doctrine_Core::getTable('RefElemento')->find($request->getParameter('idEle'));

        $this->form = new RefHojaVidaForm();
        $this->form->setDefault('id_ref_elemento', $request->getParameter('idEle'));
        $this->form->setDefault('id_usuario_creador', $usuario->getIdUsuario());

        $this->page = 1;
        $this->limit = 5;

        if ($request->getParameter('page') != null)
            $this->page = $request->getParameter('page');

        $q = Doctrine_Core::getTable('RefHojaVida')
                ->createQuery('hv')
                ->select('descripcion')
                ->where('id_ref_elemento = ?', $request->getParameter('idEle'))
                ->orderBy('updated_at DESC');

        $pager = new Doctrine_Pager($q, $this->page, $this->limit);

        $this->registros = $pager->execute();

        $this->lastPage = $pager->getLastPage();

        $this->materialsShowed = $pager->getResultsInPage();

        $this->total = $pager->getNumResults();

        $this->indicePrimero = $pager->getFirstIndice();

        $this->indiceUltimo = $pager->getLastIndice();

        //Se carga la foto del elemento si existe
        $foto = Doctrine_Core::getTable('RefFotoElemento')->findBy('id_ref_elemento', $this->elemento->getIdRefElemento())->getFirst();

        $this->id_foto = "";

        if ($foto != null) {
            $this->id_foto = $foto->getIdRefFotoElemento();
        }

        date_default_timezone_set("America/Bogota");

        $this->mantenimientosProx = Doctrine_Core::getTable("RefMantenimiento")
                ->createQuery('m')
                ->where('m.id_ref_elemento = ?', $this->elemento->getIdRefElemento())
                ->andWhere('DATEDIFF(m.fecha_programada, ?) >= 0 ', date('Y-m-d'))
                ->andWhere('is_ejecutado = 0')
                ->execute();

        $this->mantenimientosPas = Doctrine_Core::getTable("RefMantenimiento")
                ->createQuery('m')
                ->where('m.id_ref_elemento = ?', $this->elemento->getIdRefElemento())
                ->andWhere('DATEDIFF(m.fecha_programada, ?) < 0 ', date('Y-m-d'))
                ->andWhere('is_ejecutado = 0')
                ->execute();

        $this->mantenimientosEje = Doctrine_Core::getTable("RefMantenimiento")
                ->createQuery('m')
                ->where('m.id_ref_elemento = ?', $this->elemento->getIdRefElemento())
                ->andWhere('is_ejecutado = 1')
                ->execute();
    }

    public function executeGenerarHojaVida(sfWebRequest $request) {

        $elemento = Doctrine_Core::getTable('RefElemento')->find($request->getParameter('idElem'));


        sfConfig::set('sf_web_debug', false);

        $pdf = new HojaVidaPdf();

        $pdf->setElemento($elemento);
        $pdf->generar();
        $pdf->Output();


        throw new sfStopException();
    }

    public function executeGetMantenimiento(sfWebRequest $request) {
        $fecha = $request->getParameter("fecha");
        $id = $request->getParameter("id");

        $mantenimiento = Doctrine_Core::getTable("RefMantenimiento")
                ->createQuery('m')
                ->where('id_ref_elemento = ?', $id)
                ->andWhere('fecha_programada = ?', $fecha)
                ->execute()
                ->getFirst();

        if ($mantenimiento != null) {
            $data = array();
            $data["nombre"] = $mantenimiento->getNombre();
            $data["descripcion"] = $mantenimiento->getDescripcion();
            $data["asignador"] = $mantenimiento->getAsignador()->getPrimerNombre() . " " . $mantenimiento->getAsignador()->getSegundoNombre() . " " . $mantenimiento->getAsignador()->getPrimerApellido() . " " . $mantenimiento->getAsignador()->getSegundoApellido();
            $data["ejecutado"] = $mantenimiento->getIsEjecutado();
            if ($mantenimiento->getIsEjecutado() == 1) {
                $data["ejecutor"] = $mantenimiento->getEjecutor()->getPrimerNombre() . " " . $mantenimiento->getEjecutor()->getSegundoNombre() . " " . $mantenimiento->getEjecutor()->getPrimerApellido() . " " . $mantenimiento->getEjecutor()->getSegundoApellido();
                $data["fecha"] = date('Y-m-d', strtotime($mantenimiento->getUpdatedAt()));
            }

            return $this->renderText(json_encode($data));
        }

        return $this->renderText(json_encode(false));
    }

    public function executeAddMantenimiento(sfWebRequest $request) {
        date_default_timezone_set("America/Bogota");

        $idProducto = $request->getParameter("producto");
        $idAsignador = $request->getParameter("usuario");
        $nombre = $request->getParameter("nombre");
        $descripcion = $request->getParameter("descripcion");
        $fecha = $request->getParameter("fecha");

        try {
            $mantenimiento = new RefMantenimiento();
            $mantenimiento->setIdRefElemento($idProducto);
            $mantenimiento->setIdAsignador($idAsignador);
            $mantenimiento->setNombre($nombre);
            $mantenimiento->setDescripcion($descripcion);
            $mantenimiento->setFechaProgramada($fecha);
            $mantenimiento->save();
            
            $elemento= Doctrine_Core::getTable('RefElemento')->find($idProducto);
            
            sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
            
            $notificacion = new Notificacion();
            $notificacion->setTitulo('Mantenimiento programado');
            $notificacion->setContenido('Existe un mantenimiento programado para <a href="'.  url_for("refHojaVida/verByElemento?idEle=".$idProducto) .'">'.$elemento->getNombre().' <small>['.$elemento->getSerialInterno().']</small></a>, el día '.$fecha.' .');
            $notificacion->setFechaNotificacion($fecha);
            $notificacion->setPermiso('recursosFisicos');
            $notificacion->save();
            
        } catch (Exception $e) {
            $this->getUser()->setAttribute('error', 'El mantenimiento no se ha podido crear.');
        }

        $this->getUser()->setAttribute('notice', 'El mantenimiento se ha creado exitosamente para la fecha ' . $fecha . ' .');

        return $this->renderText("");
    }

    public function executeAddEjecucion(sfWebRequest $request) {
        date_default_timezone_set("America/Bogota");

        $actividad = $request->getParameter("actividades");
        $idEjecutor = $request->getParameter("usuario");
        $idProducto = $request->getParameter("producto");
        $fecha = $request->getParameter("fecha");

        try {
            $mantenimiento = Doctrine_Core::getTable("RefMantenimiento")
                ->createQuery('m')
                ->where('id_ref_elemento = ?', $idProducto)
                ->andWhere('fecha_programada = ?', $fecha)
                ->execute()
                ->getFirst();
            
            $mantenimiento->setIdEjecutor($idEjecutor);
            $mantenimiento->setIsEjecutado(1);
            $mantenimiento->save();
            
            $hojaVida = new RefHojaVida();
            $hojaVida->setDescripcion("Se ejecutó un mantenimiento que se programó para el día ".$fecha.", donde se realizaron las siguientes actividades:<br />".$actividad);
            $hojaVida->setIdRefElemento($idProducto);
            $hojaVida->setIdUsuarioCreador($idEjecutor);
            $hojaVida->save();
        } catch (Exception $e) {
            $this->getUser()->setAttribute('error', 'La ejecución no se ha podido crear.');
        }

        $this->getUser()->setAttribute('notice', 'La ejecución se ha registrado exitosamente para la fecha ' . $fecha . ' .');

        return $this->renderText("");
    }
    
}

<?php

/**
 * homologacion actions.
 *
 * @package    sicara2
 * @subpackage homologacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homologacionActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->homologacions = Doctrine_Core::getTable('Homologacion')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        if (!$request->hasParameter('id') || !$request->hasParameter('tipo')) {
            $this->redirect('home/index');
        }
        $this->isInterna = false;

        $this->form = new HomologacionForm();

        $this->usuario = null;

        if ($request->getParameter('tipo') == "int") {
            $this->isInterna = true;

            $this->estudiante = Doctrine_Core::getTable('Estudiante')->find($request->getParameter('id'));

            if ($this->estudiante != null) {
                $this->usuario = $this->estudiante->getUsuario();

                $this->form->setDefault('id_usuario', $this->estudiante->getIdUsuario());
                $this->form->setDefault('codigo_pensum_origen', $this->estudiante->getCodigoPensum());
                $this->form->setDefault('institucion_origen', 'Escuela Aeronáutica de Colombia');
                $this->form->setDefault('programa_origen', $this->estudiante->getPensum()->getNombre());
                $this->form->setDefault('is_interna', 1);
                $this->form->setDefault('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId());
            } else {
                $this->redirect('estudiante/index');
            }
        } else {
            $this->inscrito = Doctrine_Core::getTable('Inscrito')->find($request->getParameter('id'));

            if ($this->inscrito != null) {
                $this->usuario = $this->inscrito->getUsuario();

                $this->form->setDefault('id_usuario', $this->inscrito->getIdUsuario());
                $this->form->setDefault('codigo_pensum_destino', $this->inscrito->getPeriodoAcademico()->getCodigoPensum());
                $this->form->setDefault('is_interna', 0);
                $this->form->setDefault('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId());
            } else {
                $this->redirect('inscrito/index');
            }
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new HomologacionForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($homologacion = Doctrine_Core::getTable('Homologacion')->find(array($request->getParameter('id_homologacion'))), sprintf('Object homologacion does not exist (%s).', $request->getParameter('id_homologacion')));
        $this->form = new HomologacionForm($homologacion);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($homologacion = Doctrine_Core::getTable('Homologacion')->find(array($request->getParameter('id_homologacion'))), sprintf('Object homologacion does not exist (%s).', $request->getParameter('id_homologacion')));
        $this->form = new HomologacionForm($homologacion);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($homologacion = Doctrine_Core::getTable('Homologacion')->find(array($request->getParameter('id_homologacion'))), sprintf('Object homologacion does not exist (%s).', $request->getParameter('id_homologacion')));
        $homologacion->delete();

        $this->redirect('homologacion/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $homologacion = $form->save();

            $this->getUser()->setAttribute('notice', 'El proceso de homologación ha sido registrado exitosamente.');

            $this->redirect('homologacion/homologar?id=' . $homologacion->getIdHomologacion());
        } else {
            $this->getUser()->setAttribute('error', 'El proceso de homologación no pudo ser registrado.');

            $this->redirect('home/index');
        }
    }

    public function executeHomologar(sfWebRequest $request) {
        $this->homologacion = Doctrine_Core::getTable('Homologacion')->find($request->getParameter('id'));

        $this->semestres = Doctrine_Core::getTable('Semestre')
                ->createQuery('s')
                ->where('s.codigo_pensum = ? ', $this->homologacion->getCodigoPensumDestino())
                ->orderBy('numero ASC')
                ->execute();

        $this->asignaturasHomologables = array();
        $this->asignaturasCursadas = array();
        $this->asignaturasHomologadas = array();

        $idsCur = "'0'";
        $idsHom = "'0'";

        foreach ($this->semestres as $semestre) {

            $asignaturasCur = Doctrine_Core::getTable('AsignaturaCursada')
                    ->createQuery('asc')
                    ->leftJoin('asc.Asignatura as')
                    ->leftJoin('as.Semestre sem')
                    ->leftJoin('sem.Pensum pen')
                    ->leftJoin('asc.Estudiante es')
                    ->where('es.id_usuario = ?', $this->homologacion->getIdUsuario())
                    ->andWhere('pen.codigo_pensum = ?', $this->homologacion->getCodigoPensumDestino())
                    ->andWhere('asc.is_homologacion = 0')
                    ->andWhere('sem.id_semestre = ' . $semestre->getIdSemestre())
                    ->execute();

            $this->asignaturasCursadas[$semestre->getNumero()] = $asignaturasCur;


            $asignaturasHom = Doctrine_Core::getTable('AsignaturaCursada')
                    ->createQuery('asc')
                    ->leftJoin('asc.Asignatura as')
                    ->leftJoin('as.Semestre sem')
                    ->leftJoin('sem.Pensum pen')
                    ->leftJoin('asc.Estudiante es')
                    ->where('es.id_usuario = ?', $this->homologacion->getIdUsuario())
                    ->andWhere('pen.codigo_pensum = ?', $this->homologacion->getCodigoPensumDestino())
                    ->andWhere('asc.is_homologacion = 1')
                    ->andWhere('sem.id_semestre = ' . $semestre->getIdSemestre())
                    ->execute();

            if ($asignaturasHom != null)
                $this->asignaturasHomologadas[$semestre->getNumero()] = $asignaturasHom;

            foreach ($asignaturasCur as $asignaturaCur) {
                $idsCur.=",'" . $asignaturaCur->getCodigoAsignatura() . "'";
            }

            foreach ($asignaturasHom as $asignaturaHom) {
                $idsHom.=",'" . $asignaturaHom->getCodigoAsignatura() . "'";
            }

            $asignaturasHomolog = Doctrine_Core::getTable('Asignatura')
                    ->createQuery('as')
                    ->leftJoin('as.Semestre sem')
                    ->where('as.is_practica = 0')
                    ->andWhere('codigo_asignatura NOT IN (' . $idsCur . ',' . $idsHom . ')')
                    ->andWhere('sem.id_semestre = ' . $semestre->getIdSemestre())
                    ->execute();

            if ($this->homologacion->getIsOficializado() != 1) {
                $dataAsignaturas = array();

                foreach ($asignaturasHomolog as $asignatura) {
                    $asigHomo = Doctrine_Core::getTable('AsignaturaHomologada')->findBySql('codigo_asignatura = "' . $asignatura->getCodigoAsignatura() . '" AND id_homologacion = ' . $this->homologacion->getIdHomologacion())->getFirst();
                    if ($asigHomo != null) {
                        $dataAsignaturas[] = array(
                            'codigoOr' => $asignatura->getCodigoAsignatura(),
                            'nombreOr' => $asignatura->getNombre(),
                            'homologada' => 1,
                            'nombre' => $asigHomo->getNombre(),
                            'calificacion' => $asigHomo->getCalificacion(),
                            'notaAprob' => $asigHomo->getNotaAprobatoria(),
                            'observaciones' => $asigHomo->getObservaciones()
                        );
                    } else {
                        $dataAsignaturas[] = array(
                            'codigoOr' => $asignatura->getCodigoAsignatura(),
                            'nombreOr' => $asignatura->getNombre(),
                            'homologada' => 0,
                            'nombre' => '',
                            'calificacion' => '',
                            'notaAprob' => '',
                            'observaciones' => ''
                        );
                    }
                }
                $this->asignaturasHomologables[$semestre->getNumero()] = $dataAsignaturas;
            }
        }

        if ($this->homologacion->getIsInterna() == 1) {
            $asignaturasSelectables = Doctrine_Core::getTable('AsignaturaCursada')
                    ->createQuery('asc')
                    ->leftJoin('asc.Asignatura as')
                    ->leftJoin('as.Semestre sem')
                    ->where('as.is_practica = 0')
                    ->andWhere('sem.codigo_pensum = ?', $this->homologacion->getCodigoPensumOrigen())
                    ->andWhere('as.is_practica = 0')
                    ->andWhere('asc.is_aprobada = 1')
                    ->execute();
            $this->options = array();
            foreach ($asignaturasSelectables as $asignaturaSel) {
                $this->options[] = array('codigo' => $asignaturaSel->getAsignatura()->getCodigoAsignatura(), 'nombre' => $asignaturaSel->getAsignatura()->getNombre());
            }
        }
    }

    public function executeGuardarHomo(sfWebRequest $request) {
        $homologacion = Doctrine_Core::getTable('Homologacion')->find($request->getParameter('id_homologacion'));

        $asignaturas = Doctrine_Core::getTable('Asignatura')
                ->createQuery('a')
                ->leftJoin('a.Semestre s')
                ->where('s.codigo_pensum = ?', $homologacion->getCodigoPensumDestino())
                ->execute();

        $asignaturasHomo = Doctrine_Core::getTable('AsignaturaHomologada')->findBy('id_homologacion', $homologacion->getIdHomologacion());

        foreach ($asignaturasHomo as $asig) {
            $asig->delete();
        }

        foreach ($asignaturas as $asignatura) {
            if ($request->hasParameter('nota_' . $asignatura->getCodigoAsignatura())) {
                $nota = $request->getParameter('nota_' . $asignatura->getCodigoAsignatura());
                $notaAprob = $request->getParameter('nota_aprob_' . $asignatura->getCodigoAsignatura());
                $obs = $request->getParameter('observaciones_' . $asignatura->getCodigoAsignatura());
                $nombre = $request->getParameter('nombre_' . $asignatura->getCodigoAsignatura());

                $asignatura_hom = new AsignaturaHomologada();
                $asignatura_hom->setNombre($nombre);
                $asignatura_hom->setCalificacion($nota);
                $asignatura_hom->setNotaAprobatoria($notaAprob);
                $asignatura_hom->setObservaciones($obs);
                $asignatura_hom->setCodigoAsignatura($asignatura->getCodigoAsignatura());
                $asignatura_hom->setIdHomologacion($homologacion->getIdHomologacion());
                $asignatura_hom->setIdSfGuardUser();
                $asignatura_hom->setIdSfGuardUser(sfContext::getInstance()->getUser()->getGuardUser()->getId());
                $asignatura_hom->save();
            }
        }

        $this->getUser()->setAttribute('notice', 'El proceso de homologación se ha guardado exitosamente.');

        $this->redirect('homologacion/homologar?id=' . $homologacion->getIdHomologacion());
    }

    public function executeGetNota(sfWebRequest $request) {
        $asignatura = Doctrine_Core::getTable('AsignaturaCursada')
                ->createQuery('asc')
                ->leftJoin('asc.Estudiante es')
                ->where('asc.codigo_asignatura = ?', $request->getParameter('codigo'))
                ->andWhere('es.id_usuario = ?', $request->getParameter('id_usu'))
                ->execute()
                ->getFirst();
        if ($asignatura != null)
            return $this->renderText($asignatura->getNotaAsignaturaCursada());
        else
            return $this->renderText("");
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array(
            'id_homologacion',
            'institucion_origen',
            'programa_origen',
            'codigo_pensum_destino',
            'CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre)',
            'is_interna',
            'is_oficializado',
            'created_at');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('
                    h.id_homologacion,
                    h.institucion_origen,
                    h.programa_origen,
                    CONCAT(pd.codigo_pensum," :: ",pd.nombre) as penDest,
                    CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) AS nombre,
                    h.codigo_pensum_destino,
                    h.is_interna,
                    h.is_oficializado,
                    h.created_at,
                    u.id_usuario AS id_usu')
                ->from('Homologacion h')
                ->leftJoin('h.PensumDestino pd')
                ->leftJoin('h.Usuario u');

        //Se obtienen los datos necesarios para ejecutar el LIMIT:
        //SELECT ... LIMIT $limit OFFSET $offset
        $offset = $request->getParameter('iDisplayStart');
        $limit = $request->getParameter('iDisplayLength');

        //Se establece el limite, siempre que existan los datos necesarios para datatable:
        if ($request->getParameter('iDisplayStart') != null && $request->getParameter('iDisplayLength') != '-1') {
            $q->limit($limit)->offset($offset);
        }

        //Se ordenan los datos de acuerdo a la información suministrada por datatables:
        if ($request->getParameter('iSortCol_0') != null) {
            for ($i = 0; $i < intval($request->getParameter('iSortingCols')); $i++) {
                if ($request->getParameter('bSortable_' . intval($request->getParameter('iSortCol_' . $i))) == "true") {
                    $q->orderBy($aColumns[intval($request->getParameter('iSortCol_' . $i))] . "	" . strtoupper($request->getParameter('sSortDir_' . $i)));
                }
            }
        }

        //Se obtiene la palabra objetivo para realizar la busqueda:
        $sSearch = $request->getParameter('sSearch');
        //Se usa para saber si se usó un where, de forma que se use en [ Busqueda individual en columnas ]
        $bWhere = false;
        if ($sSearch != null && $sSearch != "") {
            $bWhere = true;
            for ($i = 0; $i < count($aColumns); $i++) {

                if ($i == 0) {
                    $q->where($aColumns[$i] . " LIKE '%" . $sSearch . "%'");
                } else {
                    $q->orWhere($aColumns[$i] . " LIKE '%" . $sSearch . "%'");
                }
            }
        }

        //Se realiza la busqueda individual en columnas, en los casos donde aplique, según la configuración de datatables
        for ($i = 0; $i < count($aColumns); $i++) {
            if ($request->getParameter('bSearchable_' . $i) != null && $request->getParameter('bSearchable_' . $i) == "true" && $request->getParameter('sSearch_' . $i) != '') {
                if (!$bWhere) {
                    $q->where($aColumns[$i] . " LIKE '%" . $request->getParameter('sSearch_' . $i) . "%' ");
                } else {
                    $q->andWhere($aColumns[$i] . " LIKE '%" . $request->getParameter('sSearch_' . $i) . "%' ");
                }
            }
        }

        //Construccion de la paginación:
        //Se calcula la página actual en la que se encuentra el datatables, a partir de un simple calculo matemático
        $paginaActual = (intval($offset / $limit)) + 1;
        $pager = new Doctrine_Pager($q, $paginaActual, $limit);

        //Obtención de los resultados de la consulta dada:
        $rows = $pager->execute();

        //Obtención del número de filas encontradas, si no se usara el LIMIT, pero usando los filtros de busqueda
        $iFilteredTotal = $pager->getNumResults();

        //Construcción llenado de la matriz de datos:
        $data = array();

        //*Llenado de la matriz de datos:
        for ($i = 0; $i < count($rows); $i++) {
            $id = "";
            $instOrigen = "";
            $progOrigen = "";
            $progDestino = "";
            $progDestinoCode = "";
            $homologante = "";
            $interna = "";
            $oficial = "";
            $fecha = "";
            $idUsuario = "";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['id_homologacion']))
                $id = $rows[$i]['id_homologacion'];

            if (isset($rows[$i]['institucion_origen']))
                $instOrigen = $rows[$i]['institucion_origen'];

            if (isset($rows[$i]['programa_origen']))
                $progOrigen = $rows[$i]['programa_origen'];

            if (isset($rows[$i]['penDest']))
                $progDestino = $rows[$i]['penDest'];

            if (isset($rows[$i]['nombre']))
                $homologante = $rows[$i]['nombre'];

            if (isset($rows[$i]['is_interna']))
                $interna = $rows[$i]['is_interna'];

            if (isset($rows[$i]['is_oficializado']))
                $oficial = $rows[$i]['is_oficializado'];

            if (isset($rows[$i]['created_at']))
                $fecha = $rows[$i]['created_at'];

            if (isset($rows[$i]['id_usu']))
                $idUsuario = $rows[$i]['id_usu'];

            if (isset($rows[$i]['codigo_pensum_destino']))
                $progDestinoCode = $rows[$i]['codigo_pensum_destino'];

            $oficializable = 0;

            $matricula = Doctrine_Core::getTable('Matricula')
                    ->createQuery('m')
                    ->leftJoin('m.PeriodoAcademico per')
                    ->leftJoin('m.Estudiante es')
                    ->where('es.id_usuario = ? AND per.codigo_pensum = ?', array($idUsuario, $progDestinoCode))
                    ->execute()
                    ->getFirst();
            
            $estudiante = Doctrine_Core::getTable('Estudiante')
                ->findBySql('id_usuario = ' . $idUsuario . ' AND codigo_pensum ="' . $progDestinoCode . '"')
                ->getFirst();
            
            if ($matricula != null && $estudiante != null)
                $oficializable = 1;

            //*Se agregan los datos en la matriz
            $data[$i] = array('Id' => $id, 'IstitucionOr' => $instOrigen, 'ProgramaOr' => $progOrigen, 'ProgramaDes' => $progDestino, 'Homologante' => $homologante, 'Interna' => $interna, 'Oficial' => $oficial, 'Fecha' => $fecha, 'Oficializable' => $oficializable);
        }

        //*Calculo del total de registros en la BD si no se usaran los filtros de busqueda
        $q = Doctrine_Query::create()
                ->select('COUNT(id_homologacion) AS total')
                ->from('Homologacion h');

        $totales = $q->fetchArray();
        $iTotal = $totales[0]['total'];

        //Construcción del mensaje en JSON
        $output = array(
            "sEcho" => intval($request->getParameter('sEcho')),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => '' . $iFilteredTotal,
            "aaData" => $data
        );

        //Envío del mensaje JSON
        return $this->renderText(json_encode($output));
    }

    public function executeOficializar(sfWebRequest $request) {
        $homologacion = Doctrine_Core::getTable('Homologacion')->find($request->getParameter('id'));

        $estudiante = Doctrine_Core::getTable('Estudiante')
                ->findBySql('id_usuario = ' . $homologacion->getIdUsuario() . ' AND codigo_pensum ="' . $homologacion->getCodigoPensumDestino() . '"')
                ->getFirst();
        
        if($estudiante == null){
            $this->getUser()->setAttribute('error', 'No se encontró al estudiante para oficializar esta homologación.');
            $this->redirect('homologacion/index');
        }

        $asignador = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();

        if ($homologacion != null && $homologacion->getIsOficializado() != 1 && $homologacion->getIsOficializado() != "1") {

            $asignaturasHomo = Doctrine_Core::getTable('AsignaturaHomologada')->findBy('id_homologacion', $homologacion->getIdHomologacion());

            foreach ($asignaturasHomo as $asignaturaHomo) {
                $asignaturaCursada = Doctrine_Core::getTable('AsignaturaCursada')
                        ->findBySql('codigo_estudiante = "' . $estudiante->getCodigoEstudiante() . '" AND codigo_asignatura = "' . $asignaturaHomo->getCodigoAsignatura() . '"')
                        ->getFirst();

                if ($asignaturaCursada == null) {
                    $asignaturaCursadaHom = new AsignaturaCursada();
                    $asignaturaCursadaHom->setNotaAsignaturaCursada($asignaturaHomo->getCalificacion());
                    $asignaturaCursadaHom->setIsHomologacion(1);
                    $asignaturaCursadaHom->setObservaciones($asignaturaHomo->getObservaciones());
                    $asignaturaCursadaHom->setCodigoAsignatura($asignaturaHomo->getCodigoAsignatura());
                    $asignaturaCursadaHom->setCodigoEstudiante($estudiante->getCodigoEstudiante());
                    $asignaturaCursadaHom->setNotaAprobatoria($asignaturaHomo->getNotaAprobatoria());
                    $asignaturaCursadaHom->setIsAprobada(1);
                    $asignaturaCursadaHom->setIdAsignador($asignador->getIdUsuario());
                    $asignaturaCursadaHom->setAsignaturaHomologada($asignaturaHomo);
                    $asignaturaCursadaHom->save();
                }
            }
            
            $homologacion->setIsOficializado(1);
            $homologacion->save();
            
            $this->getUser()->setAttribute('notice', 'El proceso de homologación ha sido oficializado exitosamente.');
            $this->redirect('homologacion/homologar?id=' . $homologacion->getIdHomologacion());
        } else {
            $this->getUser()->setAttribute('error', 'Esta homologación no pudo ser oficializada.');
            $this->redirect('homologacion/index');
        }
    }

}

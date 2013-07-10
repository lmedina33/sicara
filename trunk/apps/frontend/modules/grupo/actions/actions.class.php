<?php

/**
 * grupo actions.
 *
 * @package    sicara2
 * @subpackage grupo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class grupoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->grupos = Doctrine_Core::getTable('Grupo')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new GrupoForm();
        $this->pensums = Doctrine_Core::getTable('Pensum')->findAll();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new GrupoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id_grupo'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id_grupo')));
        $this->form = new GrupoForm($grupo);

        $this->pensums = Doctrine_Core::getTable('Pensum')->findAll();
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id_grupo'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id_grupo')));
        $this->form = new GrupoForm($grupo);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id_grupo'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id_grupo')));
        $grupo->delete();

        $this->redirect('grupo/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $grupo = $form->save();

            $this->redirect('grupo/edit?id_grupo=' . $grupo->getIdGrupo());
        }
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array(
            'id_grupo',
            'CONCAT(pen.codigo_pensum," :: ",pen.nombre," - ",p.periodo)',
            'CONCAT(as.codigo_asignatura," :: ",as.nombre)',
            'nombre',
            'CONCAT(pro.codigo_profesor," :: ",up.primer_apellido," ",up.segundo_apellido," ",up.primer_nombre," ",up.segundo_nombre)',
            'fecha_inicio',
            'fecha_fin',
            'inicio_calificacion',
            'fin_calificacion');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('
                    g.id_grupo,
                    g.nombre,
                    g.fecha_inicio,
                    g.fecha_fin,
                    g.inicio_calificacion,
                    g.fin_calificacion,
                    p.id_periodo_academico,
                    pen.codigo_pensum,
                    as.codigo_asignatura,
                    pro.codigo_profesor,
                    up.id_usuario,
                    CONCAT(pen.codigo_pensum," :: ",pen.nombre," - ",p.periodo) as periodo,
                    CONCAT(as.codigo_asignatura," :: ",as.nombre) as asignatura,
                    CONCAT(pro.codigo_profesor," :: ",up.primer_apellido," ",up.segundo_apellido," ",up.primer_nombre," ",up.segundo_nombre) as profesor
                    ')
                ->from('Grupo g')
                ->leftJoin('g.PeriodoAcademico p')
                ->leftJoin('p.Pensum pen')
                ->leftJoin('g.Asignatura as')
                ->leftJoin('g.Profesor pro')
                ->leftJoin('pro.Usuario up');

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
            $periodo = "";
            $asignatura = "";
            $nombre = "";
            $profesor = "";
            $fechaInicio = "";
            $fechaFin = "";
            $inicioCalificacion = "";
            $finCalificacion = "";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['id_grupo']))
                $id = $rows[$i]['id_grupo'];

            if (isset($rows[$i]['periodo']))
                $periodo = $rows[$i]['periodo'];

            if (isset($rows[$i]['asignatura']))
                $asignatura = $rows[$i]['asignatura'];

            if (isset($rows[$i]['nombre']))
                $nombre = $rows[$i]['nombre'];

            if (isset($rows[$i]['profesor']))
                $profesor = $rows[$i]['profesor'];

            if (isset($rows[$i]['fecha_inicio']))
                $fechaInicio = $rows[$i]['fecha_inicio'];

            if (isset($rows[$i]['fecha_fin']))
                $fechaFin = $rows[$i]['fecha_fin'];

            if (isset($rows[$i]['inicio_calificacion']))
                $inicioCalificacion = $rows[$i]['inicio_calificacion'];

            if (isset($rows[$i]['fin_calificacion']))
                $finCalificacion = $rows[$i]['fin_calificacion'];

            //*Se agregan los datos en la matriz
            $data[$i] = array('Id' => $id, 'Periodo' => $periodo, 'Asignatura' => $asignatura, 'Nombre' => $nombre, 'Profesor' => $profesor, 'FechaIni' => $fechaInicio, 'FechaFin' => $fechaFin, 'IniCal' => $inicioCalificacion, 'FinCal' => $finCalificacion);
        }

        //*Calculo del total de registros en la BD si no se usaran los filtros de busqueda
        $q = Doctrine_Query::create()
                ->select('COUNT(id_formulario_inscripcion) AS total')
                ->from('FormularioInscripcion f');

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

    public function executeVer(sfWebRequest $request) {
        $this->grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $this->estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')->findBy('id_grupo', $this->grupo->getIdGrupo());

        $cods = "'0'";

        foreach ($this->estudiantes as $has) {
            $cods.=",'" . $has->getCodigoEstudiante() . "'";
        }

        $estudiantesAprob = Doctrine_Core::getTable('AsignaturaCursada')
                ->createQuery('ac')
                ->where('ac.codigo_asignatura = ?', $this->grupo->getCodigoAsignatura())
                ->andWhere('ac.is_aprobada = 1')
                ->execute();

        foreach ($estudiantesAprob as $repro) {
            $cods.=",'" . $repro->getCodigoEstudiante() . "'";
        }

        $this->disponibles = Doctrine_Core::getTable('Matricula')
                ->createQuery('m')
                ->leftJoin('m.PeriodoAcademico p')
                ->where('p.codigo_pensum = ?', $this->grupo->getAsignatura()->getSemestre()->getCodigoPensum())
                ->andWhere('m.codigo_estudiante NOT IN (' . $cods . ')')
                ->execute();
    }

    public function executeAddEstudiante(sfWebRequest $request) {
        $grupo = $request->getParameter('grupo');
        $estudiante = $request->getParameter('estudiante');

        $hasOld = Doctrine_Core::getTable('GrupoHasEstudiante')->findBySql('id_grupo =' . $grupo . ' AND codigo_estudiante =' . $estudiante)->getFirst();
        if ($hasOld == null) {
            $has = new GrupoHasEstudiante();
            $has->setIdGrupo($grupo);
            $has->setCodigoEstudiante($estudiante);
            $has->save();

            return $this->renderText('added');
        }

        return $this->renderText('fail');
    }

    public function executeDeleteEstudiante(sfWebRequest $request) {
        $grupo = $request->getParameter('grupo');
        $estudiante = $request->getParameter('estudiante');

        $hasOld = Doctrine_Core::getTable('GrupoHasEstudiante')->findBySql('id_grupo =' . $grupo . ' AND codigo_estudiante =' . $estudiante)->getFirst();
        if ($hasOld != null) {
            $hasOld->delete();

            return $this->renderText('removed');
        }

        return $this->renderText('fail');
    }

    public function executeGetPeriodos(sfWebRequest $request) {
        $periodos = Doctrine_Core::getTable('PeriodoAcademico')
                ->findBy('codigo_pensum', $request->getParameter('idPensum'));

        $data = array();

        foreach ($periodos as $periodo) {
            $data[] = array('id' => $periodo->getIdPeriodoAcademico(), 'periodo' => $periodo->getPeriodo());
        }

        return $this->renderText(json_encode($data));
    }

    public function executeGetAsignaturas(sfWebRequest $request) {
        $asignaturas = Doctrine_Core::getTable('Asignatura')
                ->createQuery('a')
                ->leftJoin('a.Semestre s')
                ->where('s.codigo_pensum = ?', $request->getParameter('idPensum'))
                ->execute();

        $data = array();

        foreach ($asignaturas as $asignatura) {
            $data[] = array('id' => $asignatura->getCodigoAsignatura(), 'nombre' => strval($asignatura));
        }

        return $this->renderText(json_encode($data));
    }

    public function executeListarGrupos(sfWebRequest $request) {
        $this->gruposVigentes = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->leftJoin('g.Profesor p')
                ->leftJoin('p.Usuario u')
                ->where('u.id_sf_guard_user = ?', sfContext::getInstance()->getUser()->getGuardUser()->getId())
                ->andWhere('? BETWEEN g.inicio_calificacion AND g.fin_calificacion', date('Y-m-d H:i:s'))
                ->orderBy('g.fin_calificacion ASC')
                ->execute();

        $this->gruposAnteriores = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->leftJoin('g.Profesor p')
                ->leftJoin('p.Usuario u')
                ->where('u.id_sf_guard_user = ?', sfContext::getInstance()->getUser()->getGuardUser()->getId())
                ->andWhere('? > g.fin_calificacion', date('Y-m-d H:i:s'))
                ->orderBy('g.fin_calificacion ASC')
                ->execute();

        $this->gruposFuturos = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->leftJoin('g.Profesor p')
                ->leftJoin('p.Usuario u')
                ->where('u.id_sf_guard_user = ?', sfContext::getInstance()->getUser()->getGuardUser()->getId())
                ->andWhere('? < g.inicio_calificacion', date('Y-m-d H:i:s'))
                ->orderBy('g.fin_calificacion ASC')
                ->execute();
    }

    public function executeVerGrupo(sfWebRequest $request) {
        $this->grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $this->estudiantesHas = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $this->grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();

        $grupoAct = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->where('g.id_grupo = ?', $request->getParameter('id'))
                ->andWhere('? BETWEEN g.inicio_calificacion AND g.fin_calificacion', date('Y-m-d H:i:s'))
                ->execute()
                ->getFirst();

        if ($grupoAct == null) {
            $this->isActivo = false;
        } else {
            $this->isActivo = true;
        }

        $this->notas = array();

        foreach ($this->estudiantesHas as $has) {
            $data = array();

            $definitiva = Doctrine_Core::getTable('AsignaturaCursada')
                    ->findBySql("codigo_estudiante = '" . $has->getCodigoEstudiante() . "' AND codigo_asignatura = '" . $this->grupo->getCodigoAsignatura() . "' AND id_periodo = " . $this->grupo->getIdPeriodo())
                    ->getFirst();

            $data['definitiva'] = '';
            $data['nivelacion'] = '';
            $data['asistencia'] = '';
            $data['is_homologacion'] = '';
            $data['parcial1'] = '';
            $data['parcial2'] = '';
            $data['parcial3'] = '';

            if ($definitiva != null) {
                $data['definitiva'] = $definitiva->getNotaAsignaturaCursada();
                $data['nivelacion'] = $definitiva->getNotaNivelacionAsignaturaCursada();
                $data['asistencia'] = $definitiva->getAsistencia();
                $data['is_homologacion'] = $definitiva->getIsHomologacion();

                $parciales = Doctrine_Core::getTable('Parcial')
                        ->createQuery('p')
                        ->where('id_asignatura_cursada = ?', $definitiva->getIdAsignaturaCursada())
                        ->orderBy('orden ASC')
                        ->execute();

                foreach ($parciales as $parcial) {
                    switch ($parcial->getOrden()) {
                        case 1: {
                                $data['parcial1'] = $parcial->getCalificacion();
                            }break;
                        case 2: {
                                $data['parcial2'] = $parcial->getCalificacion();
                            }break;
                        case 3: {
                                $data['parcial3'] = $parcial->getCalificacion();
                            }break;
                    }
                }

                $this->notas[$has->getCodigoEstudiante()] = $data;
            }
        }
    }

    public function executeCalificarGrupo(sfWebRequest $request) {
        $grupoAct = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->where('g.id_grupo = ?', $request->getParameter('id'))
                ->andWhere('? BETWEEN g.inicio_calificacion AND g.fin_calificacion', date('Y-m-d H:i:s'))
                ->execute()
                ->getFirst();

        if ($grupoAct == null) {
            $this->redirect('grupo/listarGrupos');
        }

        $this->grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $this->estudiantesHas = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $this->grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();

        $this->notas = array();

        foreach ($this->estudiantesHas as $estudianteH) {

            $asignaturaCur = Doctrine_Core::getTable('AsignaturaCursada')
                    ->findBySql("codigo_estudiante = '" . $estudianteH->getCodigoEstudiante() . "' AND codigo_asignatura = '" . $this->grupo->getCodigoAsignatura() . "' AND id_periodo = " . $this->grupo->getIdPeriodo())
                    ->getFirst();

            $notas = null;

            if ($asignaturaCur != null) {
                $notas = array();
                $notas['nota'] = $asignaturaCur;

                $parcial1 = Doctrine_Core::getTable('Parcial')
                        ->createQuery('p')
                        ->where('p.id_asignatura_cursada = ?', $asignaturaCur->getIdAsignaturaCursada())
                        ->andWhere('p.orden = 1')
                        ->execute()
                        ->getFirst();

                if ($parcial1 != null)
                    $notas['parcial1'] = $parcial1;
                else
                    $notas['parcial1'] = null;

                $parcial2 = Doctrine_Core::getTable('Parcial')
                        ->createQuery('p')
                        ->where('p.id_asignatura_cursada = ?', $asignaturaCur->getIdAsignaturaCursada())
                        ->andWhere('p.orden = 2')
                        ->execute()
                        ->getFirst();

                if ($parcial2 != null)
                    $notas['parcial2'] = $parcial2;
                else
                    $notas['parcial2'] = null;

                $parcial3 = Doctrine_Core::getTable('Parcial')
                        ->createQuery('p')
                        ->where('p.id_asignatura_cursada = ?', $asignaturaCur->getIdAsignaturaCursada())
                        ->andWhere('p.orden = 3')
                        ->execute()
                        ->getFirst();

                if ($parcial3 != null)
                    $notas['parcial3'] = $parcial3;
                else
                    $notas['parcial3'] = null;
            }

            $this->notas[$estudianteH->getCodigoEstudiante()] = $notas;
        }
    }

    public function executeGuardarNota(sfWebRequest $request) {
        $grupoAct = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->where('g.id_grupo = ?', $request->getParameter('idGrupo'))
                ->andWhere('? BETWEEN g.inicio_calificacion AND g.fin_calificacion', date('Y-m-d H:i:s'))
                ->execute()
                ->getFirst();

        if ($grupoAct == null) {
            $this->renderText('fail');
        }

        $parcial1 = $request->getParameter('parcial1');
        $parcial2 = $request->getParameter('parcial2');
        $parcial3 = $request->getParameter('parcial3');
        $nota = $request->getParameter('nota');
        $asistencia = $request->getParameter('asistencia');
        $nivelacion = $request->getParameter('nivelacion');
        $codEstudiante = $request->getParameter('codEstudiante');
        $codAsignatura = $request->getParameter('codAsignatura');
        $idPeriodo = $request->getParameter('idPeriodo');

        $asCur = Doctrine_Core::getTable('AsignaturaCursada')
                ->findBySql("codigo_estudiante = '" . $codEstudiante . "' AND codigo_asignatura = '" . $codAsignatura . "'")
                ->getFirst();

        if ($asCur == null) {
            $asCur = new AsignaturaCursada();
            if ($nota != "")
                $asCur->setNotaAsignaturaCursada($nota);

            $asCur->setAsistencia($asistencia);
            $asCur->setCodigoAsignatura($codAsignatura);
            $asCur->setCodigoEstudiante($codEstudiante);
            $asCur->setNotaNivelacionAsignaturaCursada($nivelacion);
            $asCur->setIdPeriodo($idPeriodo);
            $asCur->save();
        }else {
            if ($nota != "")
                $asCur->setNotaAsignaturaCursada($nota);

            $asCur->setAsistencia($asistencia);
            $asCur->setNotaNivelacionAsignaturaCursada($nivelacion);
            $asCur->save();
        }

        $par1 = Doctrine_Core::getTable('Parcial')
                ->findBySql("id_asignatura_cursada = " . $asCur->getIdAsignaturaCursada() . " AND orden = 1")
                ->getFirst();

        if ($par1 == null) {
            $par1 = new Parcial();
        }
        $par1->setCalificacion($parcial1);
        $par1->setPorcentaje(0.3);
        $par1->setIdAsignaturaCursada($asCur->getIdAsignaturaCursada());
        $par1->setIdCalificador(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $par1->setOrden(1);
        $par1->save();

        $par2 = Doctrine_Core::getTable('Parcial')
                ->findBySql("id_asignatura_cursada = " . $asCur->getIdAsignaturaCursada() . " AND orden = 2")
                ->getFirst();

        if ($par2 == null) {
            $par2 = new Parcial();
        }
        $par2->setCalificacion($parcial2);
        $par2->setPorcentaje(0.3);
        $par2->setIdAsignaturaCursada($asCur->getIdAsignaturaCursada());
        $par2->setIdCalificador(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $par2->setOrden(2);
        $par2->save();

        $par3 = Doctrine_Core::getTable('Parcial')
                ->findBySql("id_asignatura_cursada = " . $asCur->getIdAsignaturaCursada() . " AND orden = 3")
                ->getFirst();

        if ($par3 == null) {
            $par3 = new Parcial();
        }
        $par3->setCalificacion($parcial3);
        $par3->setPorcentaje(0.4);
        $par3->setIdAsignaturaCursada($asCur->getIdAsignaturaCursada());
        $par3->setIdCalificador(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $par3->setOrden(3);
        $par3->save();

        return $this->renderText('ok');
    }

    //ASISTENCIA
    public function executeGenerarFormatoRC003(sfWebRequest $request) {
        $grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();

        sfConfig::set('sf_web_debug', false);

        $pdf = new FormatoRC003Pdf('L', 'mm', 'letter');

        $pdf->numReg($estudiantes->count());
        $pdf->setEstudiantes($estudiantes);
        $pdf->setGrupo($grupo);
        $pdf->generar();

        $pdf->Output();

        throw new sfStopException();
    }

    //CALIFICACIONES
    public function executeGenerarFormatoRC005(sfWebRequest $request) {
        $grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();

        sfConfig::set('sf_web_debug', false);

        $pdf = new FormatoRC005Pdf('L', 'mm', 'letter');

        $pdf->numReg($estudiantes->count());
        $pdf->setEstudiantes($estudiantes);
        $pdf->setGrupo($grupo);
        $pdf->generar();

        $pdf->Output();

        throw new sfStopException();
    }

    //CALIFICACIONES DILIGENCIADA
    public function executeGenerarFormatoRC005Dil(sfWebRequest $request) {
        $grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();
        
        ////
        $notas = array();

        foreach ($estudiantes as $has) {
            $data = array();

            $definitiva = Doctrine_Core::getTable('AsignaturaCursada')
                    ->findBySql("codigo_estudiante = '" . $has->getCodigoEstudiante() . "' AND codigo_asignatura = '" . $grupo->getCodigoAsignatura() . "' AND id_periodo = " . $grupo->getIdPeriodo())
                    ->getFirst();

            $data['definitiva'] = '';
            $data['nivelacion'] = '';
            $data['asistencia'] = '';
            $data['is_homologacion'] = '';
            $data['parcial1'] = '';
            $data['parcial2'] = '';
            $data['parcial3'] = '';

            if ($definitiva != null) {
                $data['definitiva'] = $definitiva->getNotaAsignaturaCursada();
                $data['nivelacion'] = $definitiva->getNotaNivelacionAsignaturaCursada();
                $data['asistencia'] = $definitiva->getAsistencia();
                $data['is_homologacion'] = $definitiva->getIsHomologacion();

//                $parciales = Doctrine_Core::getTable('Parcial')
//                        ->createQuery('p')
//                        ->where('id_asignatura_cursada = ?', $definitiva->getIdAsignaturaCursada())
//                        ->orderBy('orden ASC')
//                        ->execute();
//
//                foreach ($parciales as $parcial) {
//                    switch ($parcial->getOrden()) {
//                        case 1: {
//                                $data['parcial1'] = $parcial->getCalificacion();
//                            }break;
//                        case 2: {
//                                $data['parcial2'] = $parcial->getCalificacion();
//                            }break;
//                        case 3: {
//                                $data['parcial3'] = $parcial->getCalificacion();
//                            }break;
//                    }
//                }

                $notas[$has->getCodigoEstudiante()] = $data;
            }
        }
        ////

        sfConfig::set('sf_web_debug', false);

        $pdf = new FormatoRC005DilPdf('L', 'mm', 'letter');

        $pdf->numReg($estudiantes->count());
        $pdf->setEstudiantes($estudiantes);
        $pdf->setGrupo($grupo);
        $pdf->setNotas($notas);
        $pdf->generar();

        $pdf->Output();

        throw new sfStopException();
    }

    //CALIFICACIONES PARCIALES
    public function executeGenerarFormatoRC011(sfWebRequest $request) {
        $grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();

        sfConfig::set('sf_web_debug', false);

        $pdf = new FormatoRC011Pdf('L', 'mm', 'letter');

        $pdf->numReg($estudiantes->count());
        $pdf->setEstudiantes($estudiantes);
        $pdf->setGrupo($grupo);
        $pdf->generar();

        $pdf->Output();

        throw new sfStopException();
    }

    //CALIFICACIONES PARCIALES
    public function executeGenerarFormatoRC011Dil(sfWebRequest $request) {
        $grupo = Doctrine_Core::getTable('Grupo')->find($request->getParameter('id'));
        $estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')
                ->createQuery('h')
                ->leftJoin('h.Estudiante e')
                ->leftJoin('e.Usuario u')
                ->where('h.id_grupo = ?', $grupo->getIdGrupo())
                ->orderBy('CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) ASC')
                ->execute();

        ////
        $notas = array();

        foreach ($estudiantes as $has) {
            $data = array();

            $definitiva = Doctrine_Core::getTable('AsignaturaCursada')
                    ->findBySql("codigo_estudiante = '" . $has->getCodigoEstudiante() . "' AND codigo_asignatura = '" . $grupo->getCodigoAsignatura() . "' AND id_periodo = " . $grupo->getIdPeriodo())
                    ->getFirst();

            $data['definitiva'] = '';
            $data['nivelacion'] = '';
            $data['asistencia'] = '';
            $data['is_homologacion'] = '';
            $data['parcial1'] = '';
            $data['parcial2'] = '';
            $data['parcial3'] = '';

            if ($definitiva != null) {
                $data['definitiva'] = $definitiva->getNotaAsignaturaCursada();
                $data['nivelacion'] = $definitiva->getNotaNivelacionAsignaturaCursada();
                $data['asistencia'] = $definitiva->getAsistencia();
                $data['is_homologacion'] = $definitiva->getIsHomologacion();

                $parciales = Doctrine_Core::getTable('Parcial')
                        ->createQuery('p')
                        ->where('id_asignatura_cursada = ?', $definitiva->getIdAsignaturaCursada())
                        ->orderBy('orden ASC')
                        ->execute();

                foreach ($parciales as $parcial) {
                    switch ($parcial->getOrden()) {
                        case 1: {
                                $data['parcial1'] = $parcial->getCalificacion();
                            }break;
                        case 2: {
                                $data['parcial2'] = $parcial->getCalificacion();
                            }break;
                        case 3: {
                                $data['parcial3'] = $parcial->getCalificacion();
                            }break;
                    }
                }

                $notas[$has->getCodigoEstudiante()] = $data;
            }
        }
        ////
        
        sfConfig::set('sf_web_debug', false);

        $pdf = new FormatoRC011DilPdf('L', 'mm', 'letter');

        $pdf->numReg($estudiantes->count());
        $pdf->setEstudiantes($estudiantes);
        $pdf->setGrupo($grupo);
        $pdf->setNotas($notas);
        $pdf->generar();

        $pdf->Output();

        throw new sfStopException();
    }

}


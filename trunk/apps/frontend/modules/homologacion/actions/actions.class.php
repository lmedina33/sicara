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

        $this->especificacionesHomologacion=array();
        
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
            
            foreach($asignaturasHom as $asignaHomolog){
                $asignaturasHomologadas=Doctrine_Core::getTable('AsignaturaHomologada')
                        ->createQuery('ah')
                        ->where('ah.id_homologacion = ?',$this->homologacion->getIdHomologacion())
                        ->andWhere('ah.codigo_asignatura = ?',$asignaHomolog->getCodigoAsignatura())
                        ->execute();
                
                $cod=$asignaHomolog->getCodigoAsignatura();
                
                $this->especificacionesHomologacion[$cod]=$asignaturasHomologadas;
            }

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

//            if ($this->homologacion->getIsOficializado() != 1) {
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
//            }
        }

        

        $this->asignaturasHomolog = array();
        $asignaturas = Doctrine_Core::getTable('Asignatura')
                ->createQuery('a')
                ->leftJoin('a.Semestre s')
                ->where('s.codigo_pensum = ?', $this->homologacion->getCodigoPensumDestino())
                ->orderBy('s.numero')
                ->addOrderBy('a.codigo_asignatura')
                ->execute();

        foreach ($asignaturas as $asignatura) {
            $asignaturaCur = Doctrine_Core::getTable('AsignaturaCursada')
                    ->createQuery('asc')
                    ->leftJoin('asc.Estudiante es')
                    ->where('asc.codigo_asignatura = ?', $asignatura->getCodigoAsignatura())
                    ->andWhere('es.id_usuario = ?', $this->homologacion->getIdUsuario())
                    ->execute()
                    ->getFirst();
            if ($asignatura->getIsPractica() != 1 && $asignaturaCur == null) {
                $this->asignaturasHomolog[] = array(
                    'codigo' => $asignatura->getCodigoAsignatura(),
                    'nombre' => $asignatura->getNombre(),
                    'semestre' => $asignatura->getSemestre()->getNumero(),
                );
            }
        }

        $this->origenesHomologacion = array();

        foreach ($this->asignaturasHomolog as $asigHom) {
            $origenes = Doctrine_Core::getTable('AsignaturaHomologada')
                    ->createQuery('a')
                    ->where('codigo_asignatura = ?', $asigHom['codigo'])
                    ->andWhere('id_homologacion = ?',$this->homologacion->getIdHomologacion())
                    ->execute();
            
            $arrayOrigen = array();

            foreach ($origenes as $origen) {
                $arrayOrigen[] = array(
                    'id' => $origen->getIdAsignaturaHomologada(),
                    'ins_origen' => $origen->getInstitucionOrigen(),
                    'prog_origen' => $origen->getProgramaOrigen(),
                    'origen' => $origen->getNombre(),
                    'calificacion' => $origen->getCalificacion(),
                    'aprobatoria' => $origen->getNotaAprobatoria(),
                    'porcentaje' => $origen->getPorcentaje(),
                    'observaciones' => $origen->getObservaciones(),
                );
            }

            $this->origenesHomologacion[$asigHom['codigo']] = $arrayOrigen;
        }
        
        $matriculas = Doctrine_Core::getTable('Matricula')
                ->createQuery('m')
                ->leftJoin('m.Estudiante e')
                ->where('e.id_usuario = ?',$this->homologacion->getIdUsuario())
                ->execute();
        
        $idsPensums = "0";
        
        foreach($matriculas as $matricula){
            $idsPensums.=",".$matricula->getPeriodoAcademico()->getCodigoPensum();
        }
        
        $this->pensums=  Doctrine_Core::getTable('Pensum')
                ->createQuery('p')
                ->where('p.codigo_pensum IN ('.$idsPensums.')')
                ->execute();
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
            return $this->renderText($asignatura->getNotaAsignaturaCursada()."-".$asignatura->getNotaAprobatoria());
        else
            return $this->renderText("");
    }

    public function executeGetAsignatura(sfWebRequest $request) {
        $asignaturas = Doctrine_Core::getTable('Asignatura')
                ->createQuery('a')
                ->leftJoin('a.Semestre s')
                ->where('s.codigo_pensum = ?', $request->getParameter('pensum'))
                ->execute();
        
        $data=array();
        
        foreach($asignaturas as $asignatura){
            $data[]=array('codigo'=>$asignatura->getCodigoAsignatura(),'value'=>$asignatura->getNombre(),'label' => $asignatura->getCodigoAsignatura()." :: ".$asignatura->getNombre());
        }
        
        return $this->renderText(json_encode($data));
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array(
            'id_homologacion',
            'codigo_pensum_destino',
            'CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre)',
            'is_interna',
            'created_at');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('
                    h.id_homologacion,
                    CONCAT(pd.codigo_pensum," :: ",pd.nombre) as penDest,
                    CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) AS nombre,
                    h.codigo_pensum_destino,
                    h.is_interna,
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
            $progDestino = "";
            $progDestinoCode = "";
            $homologante = "";
            $interna = "";
            $fecha = "";
            $idUsuario = "";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['id_homologacion']))
                $id = $rows[$i]['id_homologacion'];

            if (isset($rows[$i]['penDest']))
                $progDestino = $rows[$i]['penDest'];

            if (isset($rows[$i]['nombre']))
                $homologante = $rows[$i]['nombre'];

            if (isset($rows[$i]['is_interna']))
                $interna = $rows[$i]['is_interna'];

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
            $data[$i] = array('Id' => $id, 'ProgramaDes' => $progDestino, 'Homologante' => $homologante, 'Interna' => $interna, 'Fecha' => $fecha, 'Oficializable' => $oficializable);
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

        if ($estudiante == null) {
            $this->getUser()->setAttribute('error', 'No se encontró al estudiante para oficializar esta homologación.');
            $this->redirect('homologacion/index');
        }

        $asignador = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();

        if ($homologacion != null) {

//            $asignaturasHomo = Doctrine_Core::getTable('AsignaturaHomologada')->findBy('id_homologacion', $homologacion->getIdHomologacion());
            $asignaturasHomo = Doctrine_Core::getTable('AsignaturaHomologada')
                    ->createQuery('a')
                    ->select('a.id_asignatura_homologada ,a.codigo_asignatura, a.id_homologacion, 
                        ROUND((SUM(a.calificacion*a.porcentaje/100)*'.$homologacion->getPensumDestino()->getNotaAprobatoria().' / SUM(a.nota_aprobatoria*a.porcentaje/100)),2) as nota_final,
                        ROUND(SUM(a.nota_aprobatoria*a.porcentaje/100),2) as nota_aprobatoria_final')
                    ->where('a.id_homologacion = ?',$homologacion->getIdHomologacion())
                    ->andWhere('a.is_oficializado != 1')
                    ->groupBy('a.codigo_asignatura')
                    ->fetchArray();
//                    ->;
            // SELECT ROUND(SUM(`calificacion`*`porcentaje`/100),2) as Nota_final FROM `asignatura_homologada` GROUP BY `id_homologacion`,`codigo_asignatura`
            
            foreach ($asignaturasHomo as $asignaturaHomo) {
                $asignaturaCursada = Doctrine_Core::getTable('AsignaturaCursada')
                        ->findBySql('codigo_estudiante = "' . $estudiante->getCodigoEstudiante() . '" AND codigo_asignatura = "' . $asignaturaHomo['codigo_asignatura'] . '"')
                        ->getFirst();

                if ($asignaturaCursada == null) {
                    $asignaturaCursadaHom = new AsignaturaCursada();
                    $asignaturaCursadaHom->setNotaAsignaturaCursada($asignaturaHomo['nota_final']);
                    $asignaturaCursadaHom->setIsHomologacion(1);
//                    $asignaturaCursadaHom->setObservaciones($asignaturaHomo->getObservaciones());
                    $asignaturaCursadaHom->setCodigoAsignatura($asignaturaHomo['codigo_asignatura']);
                    $asignaturaCursadaHom->setCodigoEstudiante($estudiante->getCodigoEstudiante());
                    $asignaturaCursadaHom->setNotaAprobatoria($homologacion->getPensumDestino()->getNotaAprobatoria());
                    $asignaturaCursadaHom->setIsAprobada(1);
                    $asignaturaCursadaHom->setIdAsignador($asignador->getIdUsuario());
                    $asignaturaCursadaHom->setHomologacion($homologacion);
                    $asignaturaCursadaHom->save();
                    
                    $asignaturaHomolog=  Doctrine_Core::getTable('AsignaturaHomologada')->find($asignaturaHomo['id_asignatura_homologada']);
                    $asignaturaHomolog->setIsOficializado(1);
                    $asignaturaHomolog->save();
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

    public function executeGuardarAsignatura(sfWebRequest $request) {
        $idHomologacion = $request->getParameter('id_hom');
        $codAsignatura = $request->getParameter('codigo_as');
        $insOrigen = $request->getParameter('ins_origen');
        $progOrigen = $request->getParameter('prog_origen');
        $asOrigen = $request->getParameter('as_origen');
        $nota = $request->getParameter('nota');
        $nota_aprob = $request->getParameter('nota_aprob');
        $obs = $request->getParameter('obs');
        $porcentaje = $request->getParameter('porcentaje');
        
        $asignaturaHom= new AsignaturaHomologada();
        $asignaturaHom->setIdHomologacion($idHomologacion);
        $asignaturaHom->setCodigoAsignatura($codAsignatura);
        $asignaturaHom->setInstitucionOrigen($insOrigen);
        $asignaturaHom->setProgramaOrigen($progOrigen);
        $asignaturaHom->setNombre($asOrigen);
        $asignaturaHom->setCalificacion($nota);
        $asignaturaHom->setNotaAprobatoria($nota_aprob);
        $asignaturaHom->setObservaciones($obs);
        $asignaturaHom->setPorcentaje($porcentaje);
        $asignaturaHom->setIdSfGuardUser(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $asignaturaHom->save();
        
        $data=array('id'=>$asignaturaHom->getIdAsignaturaHomologada(),'nombre'=>$asOrigen);
//        $data['id']=$asignaturaHom->getIdAsignaturaHomologada();
//        $data['nombre']=$nombre;
        return $this->renderText(json_encode($data));
    }
    
    public function executeBorrarAsignatura(sfWebRequest $request) {
        $asignatura = Doctrine_Core::getTable('AsignaturaHomologada')->find($request->getParameter('id'));
        
        if($asignatura != null){
            $asignatura->delete();
            return $this->renderText('borrado');
        }else{
            return $this->renderText('fail');
        }
    }
}

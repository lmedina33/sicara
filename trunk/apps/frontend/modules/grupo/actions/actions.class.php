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
        $this->pensums=  Doctrine_Core::getTable('Pensum')->findAll();
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
        
        $this->pensums=  Doctrine_Core::getTable('Pensum')->findAll();
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
        $this->estudiantes = Doctrine_Core::getTable('GrupoHasEstudiante')->findBy('id_grupo',$this->grupo->getIdGrupo());
        
        $cods="'0'";
        
        foreach($this->estudiantes as $has){
            $cods.=",'".$has->getCodigoEstudiante()."'";
        }
        
        $estudiantesAprob=  Doctrine_Core::getTable('AsignaturaCursada')
                ->createQuery('ac')
                ->where('ac.codigo_asignatura = ?',$this->grupo->getCodigoAsignatura())
                ->andWhere('ac.is_aprobada = 1')
                ->execute();
        
        foreach($estudiantesAprob as $repro){
            $cods.=",'".$repro->getCodigoEstudiante()."'";
        }
        
        $this->disponibles = Doctrine_Core::getTable('Matricula')
                ->createQuery('m')
                ->leftJoin('m.PeriodoAcademico p')
                ->where('p.codigo_pensum = ?',$this->grupo->getAsignatura()->getSemestre()->getCodigoPensum())
                ->andWhere('m.codigo_estudiante NOT IN ('.$cods.')')
                ->execute();
    }
    
    public function executeAddEstudiante(sfWebRequest $request){
        $grupo= $request->getParameter('grupo');
        $estudiante = $request->getParameter('estudiante');
        
        $hasOld=  Doctrine_Core::getTable('GrupoHasEstudiante')->findBySql('id_grupo ='.$grupo.' AND codigo_estudiante ='.$estudiante)->getFirst();
        if($hasOld == null){
            $has = new GrupoHasEstudiante();
            $has->setIdGrupo($grupo);
            $has->setCodigoEstudiante($estudiante);
            $has->save();
            
            return $this->renderText('added');
        }
        
        return $this->renderText('fail');
    }
    
    public function executeDeleteEstudiante(sfWebRequest $request){
        $grupo= $request->getParameter('grupo');
        $estudiante = $request->getParameter('estudiante');
        
        $hasOld=  Doctrine_Core::getTable('GrupoHasEstudiante')->findBySql('id_grupo ='.$grupo.' AND codigo_estudiante ='.$estudiante)->getFirst();
        if($hasOld != null){
            $hasOld->delete();
            
            return $this->renderText('removed');
        }
        
        return $this->renderText('fail');
    }
    
    public function executeGetPeriodos(sfWebRequest $request){
        $periodos=  Doctrine_Core::getTable('PeriodoAcademico')
                ->findBy('codigo_pensum', $request->getParameter('idPensum'));
        
        $data=array();
        
        foreach($periodos as $periodo){
            $data[]=array('id'=>$periodo->getIdPeriodoAcademico(),'periodo'=>$periodo->getPeriodo());
        }
        
        return $this->renderText(json_encode($data));
    }
    
    public function executeGetAsignaturas(sfWebRequest $request){
        $asignaturas=  Doctrine_Core::getTable('Asignatura')
                ->createQuery('a')
                ->leftJoin('a.Semestre s')
                ->where('s.codigo_pensum = ?', $request->getParameter('idPensum'))
                ->execute();
        
        $data=array();
        
        foreach($asignaturas as $asignatura){
            $data[]=array('id'=>$asignatura->getCodigoAsignatura(),'nombre'=>  strval($asignatura));
        }
        
        return $this->renderText(json_encode($data));
    }

}


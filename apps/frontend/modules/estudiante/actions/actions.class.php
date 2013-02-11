<?php

/**
 * estudiante actions.
 *
 * @package    sicara2
 * @subpackage estudiante
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estudianteActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->estudiantes = Doctrine_Core::getTable('Estudiante')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new EstudianteForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EstudianteForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($this->estudiante = Doctrine_Core::getTable('Estudiante')->find(array($request->getParameter('cod'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('cod')));

        $this->form = new UsuarioForm($this->estudiante->getUsuario());
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($estudiante = Doctrine_Core::getTable('Estudiante')->find(array($request->getParameter('cod'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('cod')));
        $this->form = new UsuarioForm($estudiante->getUsuario());

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($estudiante = Doctrine_Core::getTable('Estudiante')->find(array($request->getParameter('codigo_estudiante'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('codigo_estudiante')));
        $estudiante->delete();

        $this->redirect('estudiante/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $usuario = $form->save();

            $file = $form->getValue('foto_path');

            if ($file != null && $file->getOriginalName() != "") {

                $filename = $usuario->getDocumento() . '-' . $usuario->getIdTipoDocumento();
                $extension = $file->getOriginalExtension();

                $file->save(sfConfig::get('sf_app_dir') . '/private_uploads/fotoUsuario/' . $filename . $extension);

                $usuario->setFotoPath(sfConfig::get('sf_app_dir') . '/private_uploads/fotoUsuario/' . $filename . $extension);
                $usuario->save();
            }

            $this->getUser()->setAttribute('notice', 'El estudiante ha sido actualizado con éxito.');
        } else {
            $this->getUser()->setAttribute('error', 'El estudiante no pudo ser actualizado con éxito.<br />Si intenta actualizar una fotografía, intente con un archivo diferente de acuerdo a las especificaciones.');
        }

        $this->redirect('estudiante/index');
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array(
            'u.id_usuario',
            'codigo_estudiante',
            'CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre)',
            't.nombre',
            'u.documento',
            'u.telefono1',
            'u.correo',
            'pen.nombre');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('
                    e.codigo_estudiante,
                    CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) AS nombre,
                    t.nombre AS tipo_doc,
                    u.documento as doc,
                    u.telefono1 as tel,
                    u.correo as mail,
                    pen.nombre AS pensum,
                    u.id_usuario AS id_usuario')
                ->from('Estudiante e')
                ->leftJoin('e.Usuario u')
                ->leftJoin('u.TipoDocumento t')
                ->leftJoin('e.Pensum pen');

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
            $nombre = "";
            $codigo = "";
            $tipoDoc = "";
            $documento = "";
            $telefono = "";
            $correo = "";
            $pensum = "";
            $idUsuario = "";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['codigo_estudiante']))
                $codigo = $rows[$i]['codigo_estudiante'];

            if (isset($rows[$i]['nombre']))
                $nombre = $rows[$i]['nombre'];

            if (isset($rows[$i]['tipo_doc']))
                $tipoDoc = $rows[$i]['tipo_doc'];

            if (isset($rows[$i]['doc']))
                $documento = $rows[$i]['doc'];

            if (isset($rows[$i]['tel']))
                $telefono = $rows[$i]['tel'];

            if (isset($rows[$i]['mail']))
                $correo = $rows[$i]['mail'];

            if (isset($rows[$i]['pensum']))
                $pensum = $rows[$i]['pensum'];

            if (isset($rows[$i]['id_usuario']))
                $idUsuario = $rows[$i]['id_usuario'];

            //*Se agregan los datos en la matriz
            $data[$i] = array('Codigo' => $codigo, 'Nombre' => $nombre, 'TipoDoc' => $tipoDoc, 'Documento' => $documento, 'Telefono' => $telefono, 'Correo' => $correo, 'Pensum' => $pensum, 'IdUsuario' => $idUsuario);
        }

        //*Calculo del total de registros en la BD si no se usaran los filtros de busqueda
        $q = Doctrine_Query::create()
                ->select('COUNT(codigo_estudiante) AS total')
                ->from('Estudiante e');

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
        $this->forward404Unless($this->estudiante = Doctrine_Core::getTable('Estudiante')->find($request->getParameter('cod')), sprintf('Object inscrito does not exist (%s).', $request->getParameter('cod')));

        $this->codigo = $request->getParameter('cod');

        $this->formUser = new UsuarioForm($this->estudiante->getUsuario());
        
        $this->matriculas= Doctrine_Core::getTable('Matricula')
                ->createQuery()
                ->where('codigo_estudiante = ?',$this->estudiante->getCodigoEstudiante())
                ->orderBy('fecha DESC')
                ->execute();
    }

    public function executeMatricularNuevoPensum(sfWebRequest $request) {
        $this->forward404Unless($this->estudiante = Doctrine_Core::getTable('Estudiante')->find($request->getParameter('cod')), sprintf('Object inscrito does not exist (%s).', $request->getParameter('cod')));

        $matriculas = Doctrine_Core::getTable('Matricula')
                ->createQuery('m')
                ->leftJoin('m.PeriodoAcademico p')
                ->leftJoin('m.Estudiante e')
                ->select('m.id_matricula, p.codigo_pensum AS codPensum')
                ->where('e.id_usuario = ?', $this->estudiante->getIdUsuario())
                ->fetchArray();

        $idsMat = "0";
        foreach ($matriculas as $matricula) {
            $idsMat.=$idsMat . ',' . $matricula['codPensum'];
        }

        $this->periodos = Doctrine_Core::getTable('PeriodoAcademico')
                ->createQuery('p')
                ->where('codigo_pensum NOT IN (' . $idsMat . ')')
                ->execute();

        $this->jornadas = Doctrine_Core::getTable('Jornada')->findAll();
        $this->tipoPagos = Doctrine_Core::getTable('TipoPago')->findAll();
    }

    public function executeMatricular(sfWebRequest $request) {

        $periodoId = $request->getParameter('periodo');        
        $jornadaId = $request->getParameter('jornada');
        $pagoId = $request->getParameter('pago');
        $usuarioId = $request->getParameter('usuario');
        
        $periodo= Doctrine_Core::getTable('PeriodoAcademico')->find($periodoId);

        $estudiante = new Estudiante();

        $subCod = substr($periodo->getCodigoPensum(), 0, 2) . str_replace('-', '', $periodo->getPeriodo());
        $estudianteOld = Doctrine_Core::getTable('Estudiante')->createQuery()
                ->where("codigo_estudiante LIKE '" . $subCod . "%'")
                ->andWhere('codigo_pensum = ?', $periodo->getCodigoPensum())
                ->orderBy('codigo_estudiante DESC')
                ->execute()
                ->getFirst();

        $lastCod = null;

        if ($estudianteOld != null)
            $lastCod = $estudianteOld->getCodigoEstudiante();
        else
            $lastCod = $subCod . "000";

        $codigo = "" . (doubleval($lastCod) + 1);

        $estudiante->setCodigoEstudiante($codigo);
        $estudiante->setFechaIngreso(date('Y-m-d'));

        if ($periodo->getEstado() == 1) {
            $estudiante->setIdEstado(1);
        } else {
            $estudiante->setIdEstado(2);
        }

        $estudiante->setIdUsuario($usuarioId);
        $estudiante->setCodigoPensum($periodo->getCodigoPensum());
        $estudiante->save();


        $matricula = new Matricula();
        $matricula->setFecha(date('Y-m-d'));
        $matricula->setIdPeriodo($periodoId);
        $matricula->setIdJornada($jornadaId);
        $matricula->setIdTipoPago($pagoId);
        $matricula->setEstudiante($estudiante);
        $matricula->save();

        $this->getUser()->setAttribute('notice', 'El estudiante ha sido matriculado con éxito.');
        
        $this->redirect('estudiante/index');
    }

}

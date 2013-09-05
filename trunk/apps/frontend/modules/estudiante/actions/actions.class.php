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

        $this->pensums = Doctrine_Core::getTable('Pensum')->findAll();

        $this->codPen = $request->getParameter('prog');
        $this->idPer = $request->getParameter('per');
    }

//    public function executeNew(sfWebRequest $request) {
//        $this->form = new EstudianteForm();
//    }
//
//    public function executeCreate(sfWebRequest $request) {
//        $this->forward404Unless($request->isMethod(sfRequest::POST));
//
//        $this->form = new EstudianteForm();
//
//        $this->processForm($request, $this->form);
//
//        $this->setTemplate('new');
//    }

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

//    public function executeDelete(sfWebRequest $request) {
//        $request->checkCSRFProtection();
//
//        $this->forward404Unless($estudiante = Doctrine_Core::getTable('Estudiante')->find(array($request->getParameter('codigo_estudiante'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('codigo_estudiante')));
//        $estudiante->delete();
//
//        $this->redirect('estudiante/index');
//    }

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
            'pen.nombre',
            'estado');

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
                    u.id_usuario AS id_usuario,
                    es.nombre as estado')
                ->from('Estudiante e')
                ->innerJoin('e.Matricula m')
                ->leftJoin('e.Usuario u')
                ->leftJoin('u.TipoDocumento t')
                ->leftJoin('e.EstadoEstudiante es')
                ->leftJoin('e.Pensum pen');

        if ($request->getParameter('periodo')) {
            $q->where('m.id_periodo = ?', $request->getParameter('periodo'));
            $bWhere = true;
        }

        if ($request->getParameter('pensum')) {
            $q->leftJoin('m.PeriodoAcademico per')->where('per.codigo_pensum = ?', $request->getParameter('pensum'));
            $bWhere = true;
        }

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
            $estado = "";

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

            if (isset($rows[$i]['estado']))
                $estado = $rows[$i]['estado'];

            //*Se agregan los datos en la matriz
            $data[$i] = array('Codigo' => $codigo, 'Nombre' => $nombre, 'TipoDoc' => $tipoDoc, 'Documento' => $documento, 'Telefono' => $telefono, 'Correo' => $correo, 'Pensum' => $pensum, 'IdUsuario' => $idUsuario, 'Estado' => $estado);
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

        $this->matriculas = Doctrine_Core::getTable('Matricula')
                ->createQuery()
                ->where('codigo_estudiante = ?', $this->estudiante->getCodigoEstudiante())
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

        $periodo = Doctrine_Core::getTable('PeriodoAcademico')->find($periodoId);

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

    public function executeGetPeriodosByPensum(sfWebRequest $request) {
        $periodos = Doctrine_Core::getTable('PeriodoAcademico')
                ->findBy('codigo_pensum', $request->getParameter('codigo'));

        $data = array();

        foreach ($periodos as $periodo) {
            $data[] = array("id" => $periodo->getIdPeriodoAcademico(), "label" => $periodo->getPeriodo());
        }

        return $this->renderText(json_encode($data));
    }

    public function executeGenerarInformes(sfWebRequest $request) {
        $this->programas = Doctrine_Core::getTable('Pensum')->findAll();
        $this->estados = Doctrine_Core::getTable('EstadoEstudiante')->findAll();
        $this->periodos = Doctrine_Core::getTable('PeriodoAcademico')->findAll();
        $this->grupos = Doctrine_Core::getTable('Grupo')->findAll();
    }

    public function executeGenerarInforme(sfWebRequest $request) {

        $programa = null;
        $estado = null;
        $periodo = null;
        $grupo = null;

        $codigo = null;
        $estadoEs = null;
        $nombre = null;
        $documento = null;
        $tipoDocumento = null;
        $expedicion = null;
        $nacimiento = null;
        $genero = null;
        $sangre = null;
        $telefono1 = null;
        $telefono2 = null;
        $direccion = null;
        $mail = null;
        $acudiente1 = null;
        $telefonoAcudiente1 = null;
        $acudiente2 = null;
        $telefonoAcudiente2 = null;
        $medicas = null;
        $observaciones = null;
        $beneficiarioNom = null;
        $beneficiarioDoc = null;
        $beneficiarioTel = null;

        if ($request->hasParameter('programa'))
            $programa = $request->getParameter('programa');

        if ($request->hasParameter('estado'))
            $estado = $request->getParameter('estado');

        if ($request->hasParameter('periodo'))
            $periodo = $request->getParameter('periodo');

        if ($request->hasParameter('grupo'))
            $grupo = $request->getParameter('grupo');

        ////

        if ($request->hasParameter('codigo'))
            $codigo = $request->getParameter('codigo');
        
        if ($request->hasParameter('estadoEs'))
            $estadoEs = $request->getParameter('estadoEs');

        if ($request->hasParameter('nombre'))
            $nombre = $request->getParameter('nombre');

        if ($request->hasParameter('documento'))
            $documento = $request->getParameter('documento');

        if ($request->hasParameter('tipoDocumento'))
            $tipoDocumento = $request->getParameter('tipoDocumento');

        if ($request->hasParameter('expedicion'))
            $expedicion = $request->getParameter('expedicion');

        if ($request->hasParameter('nacimiento'))
            $nacimiento = $request->getParameter('nacimiento');

        if ($request->hasParameter('genero'))
            $genero = $request->getParameter('genero');

        if ($request->hasParameter('tipo_sangre'))
            $sangre = $request->getParameter('tipo_sangre');

        if ($request->hasParameter('telefono1'))
            $telefono1 = $request->getParameter('telefono1');

        if ($request->hasParameter('telefono2'))
            $telefono2 = $request->getParameter('telefono2');

        if ($request->hasParameter('direccion'))
            $direccion = $request->getParameter('direccion');

        if ($request->hasParameter('correo'))
            $mail = $request->getParameter('correo');

        if ($request->hasParameter('acudiente1'))
            $acudiente1 = $request->getParameter('acudiente1');

        if ($request->hasParameter('telefono_acudiente1'))
            $telefonoAcudiente1 = $request->getParameter('telefono_acudiente1');

        if ($request->hasParameter('acudiente2'))
            $acudiente2 = $request->getParameter('acudiente2');

        if ($request->hasParameter('telefono_acudiente2'))
            $telefonoAcudiente2 = $request->getParameter('telefono_acudiente2');

        if ($request->hasParameter('medicas'))
            $medicas = $request->getParameter('medicas');

        if ($request->hasParameter('observaciones'))
            $observaciones = $request->getParameter('observaciones');

        if ($request->hasParameter('beneficiario_nom'))
            $beneficiarioNom = $request->getParameter('beneficiario_nom');

        if ($request->hasParameter('beneficiario_doc'))
            $beneficiarioDoc = $request->getParameter('beneficiario_doc');

        if ($request->hasParameter('beneficiario_tel'))
            $beneficiarioTel = $request->getParameter('beneficiario_tel');

        $query = Doctrine_Core::getTable('estudiante')
                ->createQuery('e')
                ->leftJoin('e.Usuario u')
                ->leftJoin('e.Matricula m')
                ->leftJoin('e.GrupoHasEstudiante h')
                ->where('codigo_estudiante IS NOT NULL');

//        echo $programa . "<br />";
//        echo $estado . "<br />";
//        echo $periodo . "<br />";
//        echo $grupo . "<br />";

        if ($programa != null) {
            $query->andWhere('e.codigo_pensum = ?', $programa);
        }

        if ($estado != null) {
            $query->andWhere('e.id_estado = ?', $estado);
        }

        if ($periodo != null) {
            $query->andWhere('m.id_periodo = ?', $periodo);
        }

        if ($grupo != null) {
            $query->andWhere('h.id_grupo = ?', $grupo);
        }

        $estudiantes = $query->execute();

//        $estudiantes = Doctrine_Core::getTable('RefElemento')->createQuery('e')->orderBy('id_ref_lugar')->execute();
//
        $this->getContext()->getResponse()->setHttpHeader('Content-Disposition', 'inline;filename=NDEP_DB_Export_' . date("Y-m-d_Hi") . '.csv;');
//
        sfConfig::set('sf_web_debug', false);
//
        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Content-Type', 'application/vnd.ms-excel');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=listadoEstudiantes.csv');

//        echo '"Serial","Serial Interno","Nombre","Marca","Modelo","' . utf8_decode('Descripción') . '","Tipo","Lugar","' . utf8_decode('Ubicación') . '","Prestable?","' . utf8_decode('Sanción') . '","Cantidad ' . utf8_decode('Sanción') . '","Estado","Responsable"';
//
        echo "\n";

        if ($codigo != null)
            echo '"' . utf8_decode(str_replace('"', '""', "CODIGO")) . '",';

        if ($estadoEs != null)
            echo '"' . utf8_decode(str_replace('"', '""', "ESTADO")) . '",';

        if ($nombre != null)
            echo '"' . utf8_decode(str_replace('"', '""', "NOMBRE")) . '",';

        if ($documento != null)
            echo '"' . utf8_decode(str_replace('"', '""', "DOCUMENTO")) . '",';

        if ($tipoDocumento != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TIPO DE DOCUMENTO")) . '",';

        if ($expedicion != null)
            echo '"' . utf8_decode(str_replace('"', '""', "LUGAR DE EXPEDICIÓN")) . '",';

        if ($nacimiento != null)
            echo '"' . utf8_decode(str_replace('"', '""', "FECHA DE NACIMIENTO")) . '",';

        if ($genero != null)
            echo '"' . utf8_decode(str_replace('"', '""', "GÉNERO")) . '",';

        if ($sangre != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TIPO DE SANGRE")) . '",';

        if ($telefono1 != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TELÉFONO 1")) . '",';

        if ($telefono2 != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TELÉFONO 2")) . '",';

        if ($direccion != null)
            echo '"' . utf8_decode(str_replace('"', '""', "DIRECCIÓN")) . '",';

        if ($mail != null)
            echo '"' . utf8_decode(str_replace('"', '""', "E-MAIL")) . '",';

        if ($acudiente1 != null)
            echo '"' . utf8_decode(str_replace('"', '""', "ACUDIENTE 1")) . '",';

        if ($telefonoAcudiente1 != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TELÉFONO ACUDIENTE 1")) . '",';

        if ($acudiente2 != null)
            echo '"' . utf8_decode(str_replace('"', '""', "ACUDIENTE 2")) . '",';

        if ($telefonoAcudiente2 != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TELÉFONO ACUDIENTE 2")) . '",';

        if ($medicas != null)
            echo '"' . utf8_decode(str_replace('"', '""', "OBSERVACIONES MÉDICAS")) . '",';

        if ($observaciones != null)
            echo '"' . utf8_decode(str_replace('"', '""', "OBSERVACIONES")) . '",';

        if ($beneficiarioNom != null)
            echo '"' . utf8_decode(str_replace('"', '""', "BENEFICIARIO")) . '",';

        if ($beneficiarioDoc != null)
            echo '"' . utf8_decode(str_replace('"', '""', "DOCUMENTO BENEFICIARIO")) . '",';

        if ($beneficiarioTel != null)
            echo '"' . utf8_decode(str_replace('"', '""', "TELÉFONO BENEFICIARIO")) . '",';

//
        echo '"' . utf8_decode(str_replace('"', '""', "")) . '"';
        
        echo "\n";

        foreach ($estudiantes as $estudiante) {
            if ($codigo != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getCodigoEstudiante())) . '",';
            
            if ($estadoEs != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getEstadoEstudiante()->getNombre())) . '",';

            if ($nombre != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getPrimerApellido() . " " . $estudiante->getUsuario()->getSegundoApellido() . " " . $estudiante->getUsuario()->getPrimerNombre() . " " . $estudiante->getUsuario()->getSegundoNombre())) . '",';

            if ($documento != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getDocumento())) . '",';

            if ($tipoDocumento != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getTipoDocumento())) . '",';

            if ($expedicion != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getLugarExpedicion())) . '",';

            if ($nacimiento != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getFechaNacimiento())) . '",';

            if ($genero != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getGenero() == 1 ? "Masculino" : "Femenino")) . '",';

            if ($sangre != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getTipoSangre()->getNOmbre())) . '",';

            if ($telefono1 != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getTelefono1())) . '",';

            if ($telefono2 != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getTelefono2())) . '",';

            if ($direccion != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getDireccion())) . '",';

            if ($mail != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getCorreo())) . '",';

            if ($acudiente1 != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getAcudiente1())) . '",';

            if ($telefonoAcudiente1 != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getTelefonoAcudiente1())) . '",';

            if ($acudiente2 != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getAcudiente2())) . '",';

            if ($telefonoAcudiente2 != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getTelefonoAcudiente2())) . '",';

            if ($medicas != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getEspecificacionesMedicas())) . '",';

            if ($observaciones != null)
                echo '"' . utf8_decode(str_replace('"', '""', $estudiante->getUsuario()->getObservaciones())) . '",';

            if ($beneficiarioNom != null || $beneficiarioDoc != null || $beneficiarioTel != null){
                $matricula = Doctrine_Core::getTable('Matricula')
                        ->createQuery('m')
                        ->where('m.codigo_estudiante = ?',$estudiante->getCodigoEstudiante())
                        ->orderBy('m.fecha DESC')
                        ->execute()
                        ->getFirst();
            
                if($matricula != null){
                    if ($beneficiarioNom != null)
                        echo '"' . utf8_decode(str_replace('"', '""', $matricula->getNombreBeneficiario())) . '",';
                    
                    if ($beneficiarioDoc != null)
                        echo '"' . utf8_decode(str_replace('"', '""', $matricula->getDocumento())) . '",';
                    
                    if ($beneficiarioTel != null)
                        echo '"' . utf8_decode(str_replace('"', '""', $matricula->getTelefono())) . '",';
                    
                }
            }
            
            echo '"' . utf8_decode(str_replace('"', '""', "")) . '"';
//
            echo "\n";
        }

        return sfView::NONE;
    }

    public function executeGetPeriodos(sfWebRequest $request) {
        $periodos = null;

        if ($request->hasParameter('id') && $request->getParameter('id') != '')
            $periodos = Doctrine_Core::getTable('PeriodoAcademico')->findBy('codigo_pensum', $request->getParameter('id'));
        else
            $periodos = Doctrine_Core::getTable('PeriodoAcademico')->findAll();

        $data = array();

        foreach ($periodos as $periodo) {
            $data[] = array("id" => $periodo->getIdPeriodoAcademico(), "nombre" => $periodo->getPeriodo() . " - " . $periodo->getPensum()->getNombre());
        }

        return $this->renderText(json_encode($data));
    }

    public function executeGetGrupos(sfWebRequest $request) {
        $grupos = null;

        if ($request->hasParameter('id') && $request->getParameter('id') != '')
            $grupos = Doctrine_Core::getTable('Grupo')->findBy('id_periodo', $request->getParameter('id'));
        else
            $grupos = Doctrine_Core::getTable('Grupo')->findAll();

        $data = array();

        foreach ($grupos as $grupo) {
            $data[] = array("id" => $grupo->getIdGrupo(), "nombre" => $grupo->getPeriodoAcademico()->getPeriodo() . " - " . $grupo->getPeriodoAcademico()->getPensum()->getCodigoPensum() . " :: " . $grupo->nombre);
        }

        return $this->renderText(json_encode($data));
    }

}

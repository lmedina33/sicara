<?php

/**
 * formularioInscripcion actions.
 *
 * @package    sicara2
 * @subpackage formularioInscripcion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class formularioInscripcionActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->formulario_inscripcions = Doctrine_Core::getTable('FormularioInscripcion')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new FormularioInscripcionForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new FormularioInscripcionForm();

        $query = Doctrine_Core::getTable('FormularioInscripcion')
                ->createQuery('f')
                ->select('COUNT(f.id_formulario_inscripcion) as numero')
                ->fetchArray();

        $numero = $query[0]['numero'];

        switch (count($numero)) {
            case 1: {
                    $numero = 'E' . '000' . $numero;
                }break;
            case 2: {
                    $numero = 'E' . '00' . $numero;
                }break;
            case 3: {
                    $numero = 'E' . '0' . $numero;
                }break;
            case 4: {
                    $numero = 'E' . '0' . $numero;
                }break;
            default: {
                    $numero = 'E' . $numero;
                }
        }

        $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        $codigo = "";

        for ($i = 0; $i < 10; $i++) {
            $codigo.=$chars[intval(rand(0, 36))];
        }

        $this->processForm($request, $this->form, $numero, $codigo);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->find(array($request->getParameter('id_formulario_inscripcion'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('id_formulario_inscripcion')));

        if ($formulario_inscripcion->getIsCerrado() == "1") {
            $this->getUser()->setAttribute('warning', 'El formulario solicitado se encuentra cerrado y por lo tanto no puede ser editado.');
            $this->redirect('formularioInscripcion/index');
        }

        $this->form = new FormularioInscripcionForm($formulario_inscripcion, array(), null, false);
        $this->numero = $formulario_inscripcion->getNumero();
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->find(array($request->getParameter('id_formulario_inscripcion'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('id_formulario_inscripcion')));
        $this->form = new FormularioInscripcionForm($formulario_inscripcion, array(), null, false);

        $this->processForm($request, $this->form, null, null, false);

        $this->setTemplate('edit');
    }

//    public function executeDelete(sfWebRequest $request) {
//        $request->checkCSRFProtection();
//
//        $this->forward404Unless($formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->find(array($request->getParameter('id_formulario_inscripcion'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('id_formulario_inscripcion')));
//        $formulario_inscripcion->delete();
//
//        $this->redirect('formularioInscripcion/index');
//    }

    protected function processForm(sfWebRequest $request, sfForm $form, $numero = null, $codigo = null, $isUpdate = true) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $formulario_inscripcion = $form->save();

            if ($numero != null && $codigo != null) {
                $formulario_inscripcion->setNumero($numero);
                $formulario_inscripcion->setCodigo($codigo);
                $formulario_inscripcion->save();
            }

            $file = $form->getValue('foto_path');

            if ($file != null && $file->getOriginalName() != "") {

                $filename = $formulario_inscripcion->getNumero();
                $extension = $file->getOriginalExtension();

                $file->save(sfConfig::get('sf_app_dir') . '/private_uploads/fotoFormularioIns/' . $filename . $extension);

                $formulario_inscripcion->setFotoPath(sfConfig::get('sf_app_dir') . '/private_uploads/fotoFormularioIns/' . $filename . $extension);
                $formulario_inscripcion->save();
            }

            $this->getUser()->setAttribute('notice', 'El formulario ha sido almacenado con éxito.');

            if ($isUpdate) {
                $this->redirect('formularioInscripcion/showConfirm?cod=' . $formulario_inscripcion->getCodigo() . '&id=' . $formulario_inscripcion->getIdFormularioInscripcion());
            } else {
                $this->redirect('formularioInscripcion/ver?id=' . $formulario_inscripcion->getIdFormularioInscripcion());
            }
        } else {
            $this->getUser()->setAttribute('error', 'El formulario no pudo ser grabado con éxito.');
        }
    }

    public function executeGetPensum(sfWebRequest $request) {
        $periodo = Doctrine_Core::getTable('PeriodoAcademico')->find($request->getParameter('id'));
        return $this->renderText(json_encode($periodo->getPensum()->getCodigoPensum()));
    }

    public function executeShowConfirm(sfWebRequest $request) {
        $this->codigo = $request->getParameter('cod');

        $this->id = $request->getParameter('id');
    }

    public function executeGenerarFormulario(sfWebRequest $request) {
        $elemento = Doctrine_Core::getTable('FormularioInscripcion')->find($request->getParameter('id'));

        sfConfig::set('sf_web_debug', false);

        $pdf = new FormularioInscripcionPdf('P', 'mm', 'letter');

        $pdf->setElemento($elemento);
        $pdf->generar();
//        $pdf->Output('FormularioInscripcionEAC.pdf', 'D');
        $pdf->Output();

        throw new sfStopException();
    }

    public function executeActualizarFormulario(sfWebRequest $request) {
        $this->form = new CargarFormularioInscripcionForm();
    }

    public function executeEditFormulario(sfWebRequest $request) {
        $data = new CargarFormularioInscripcionForm();
        $data->bind($request->getParameter($data->getName()));

        $formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->createQuery('f')->where('f.documento = ? AND f.codigo = ?', array($data->getValue('documento'), $data->getValue('codigo')))->execute()->getFirst();

        if ($formulario_inscripcion == null) {
            $this->getUser()->setAttribute('error', 'No se encuentra el formulario indicado. Verifique los datos e intente de nuevo.');
            $this->redirect('formularioInscripcion/actualizarFormulario');
        } else {
            if ($formulario_inscripcion->getIsCerrado() == '1') {
                $this->getUser()->setAttribute('warning', 'El formulario indicado ya ha sido cerrado. Su proceso de inscripción ya ha sido oficializado, por lo tanto no puede modificar su formulario.');
                $this->redirect('formularioInscripcion/actualizarFormulario');
            }
            $this->getUser()->setAttribute('notice', 'El formulario solicitado ha sido cargado exitósamente.');
            $this->form = new FormularioInscripcionForm($formulario_inscripcion);
        }
    }

    public function executeUpdateFormulario(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->find(array($request->getParameter('id_formulario_inscripcion'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('id_formulario_inscripcion')));
        $this->form = new FormularioInscripcionForm($formulario_inscripcion);

        $this->processForm($request, $this->form);

        $this->setTemplate('editFormulario');
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array(
            'id_formulario_inscripcion',
            'numero',
            'CONCAT(primer_apellido," ",segundo_apellido," ",primer_nombre," ",segundo_nombre)',
            't.nombre',
            'documento',
            'telefono1',
            'correo',
            'pen.nombre',
            'per.periodo',
            'j.nombre',
            'is_inscrito',
            'is_cerrado');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('
                    f.id_formulario_inscripcion,
                    f.numero,
                    CONCAT(primer_apellido," ",segundo_apellido," ",primer_nombre," ",segundo_nombre) AS nombre,
                    f.primer_apellido,
                    f.segundo_apellido,
                    f.primer_nombre,
                    f.segundo_nombre,
                    t.nombre AS tipo_doc,
                    f.documento,
                    f.telefono1,
                    f.correo,
                    f.is_cerrado,
                    f.is_inscrito,
                    pen.nombre AS pensum,
                    per.periodo AS periodo,
                    j.nombre AS jornada')
                ->from('FormularioInscripcion f')
                ->leftJoin('f.TipoDocumento t')
                ->leftJoin('f.PeriodoAcademico per')
                ->leftJoin('per.Pensum pen')
                ->leftJoin('f.Jornada j');

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
            $nombre = "";
            $numero = "";
            $apellido1 = "";
            $apellido2 = "";
            $nombre1 = "";
            $nombre2 = "";
            $tipoDoc = "";
            $documento = "";
            $telefono = "";
            $correo = "";
            $pensum = "";
            $periodo = "";
            $jornada = "";
            $cerrado = "0";
            $inscrito = "0";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['id_formulario_inscripcion']))
                $id = $rows[$i]['id_formulario_inscripcion'];

            if (isset($rows[$i]['numero']))
                $numero = $rows[$i]['numero'];

            if (isset($rows[$i]['nombre']))
                $nombre = $rows[$i]['nombre'];

            if (isset($rows[$i]['tipo_doc']))
                $tipoDoc = $rows[$i]['tipo_doc'];

            if (isset($rows[$i]['documento']))
                $documento = $rows[$i]['documento'];

            if (isset($rows[$i]['telefono1']))
                $telefono = $rows[$i]['telefono1'];

            if (isset($rows[$i]['correo']))
                $correo = $rows[$i]['correo'];

            if (isset($rows[$i]['pensum']))
                $pensum = $rows[$i]['pensum'];

            if (isset($rows[$i]['periodo']))
                $periodo = $rows[$i]['periodo'];

            if (isset($rows[$i]['jornada']))
                $jornada = $rows[$i]['jornada'];

            if (isset($rows[$i]['is_cerrado']))
                $cerrado = $rows[$i]['is_cerrado'];

            if (isset($rows[$i]['is_inscrito']))
                $inscrito = $rows[$i]['is_inscrito'];

            //*Se agregan los datos en la matriz
            $data[$i] = array('Id' => $id, 'Numero' => $numero, 'Nombre' => $nombre, 'TipoDoc' => $tipoDoc, 'Documento' => $documento, 'Telefono' => $telefono, 'Correo' => $correo, 'Pensum' => $pensum, 'Periodo' => $periodo, 'Jornada' => $jornada, 'Formalizado' => $cerrado, 'Inscrito' => $inscrito);
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
        $this->forward404Unless($formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->find(array($request->getParameter('id'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('id')));
        $this->form = new FormularioInscripcionForm($formulario_inscripcion);
        $this->numero = $formulario_inscripcion->getNumero();
        $this->cerrado = $formulario_inscripcion->getIsCerrado();
    }

    public function executeFormalizar(sfWebRequest $request) {
        $this->forward404Unless($formulario_inscripcion = Doctrine_Core::getTable('FormularioInscripcion')->find(array($request->getParameter('id'))), sprintf('Object formulario_inscripcion does not exist (%s).', $request->getParameter('id')));
        $formulario_inscripcion->setIsCerrado(1);
        $formulario_inscripcion->save();

        $this->redirect('formularioInscripcion/index');
    }

    public function executeRenderFoto(sfWebRequest $request) {
        $foto = Doctrine_Core::getTable('FormularioInscripcion')->find($request->getParameter('id'));

        if ($foto != null) {

            $image_creators = array(
                1 => "imagecreatefromgif",
                2 => "imagecreatefromjpeg",
                3 => "imagecreatefrompng",
                6 => "imagecreatefromwbmp",
                16 => "imagecreatefromxbm"
            );

            $image_size = getimagesize($foto->getFotoPath());
            if (is_array($image_size)) {
                $file_type = $image_size[2];
                switch ($file_type) {
                    case 1: {
                            $im = imagecreatefromgif($foto->getFotoPath());
                            // Aquí mostramos la imagen en nuestro navegador
                            @ImageGIF($im);
                            // Destruimos la imagen para liberar espacio
                            @ImageDestroy($im);
                        }break;
                    case 2: {
                            $im = imagecreatefromjpeg($foto->getFotoPath());
                            @ImageJPEG($im);
                            @ImageDestroy($im);
                        }break;
                    case 3: {
                            $im = imagecreatefrompng($foto->getFotoPath());
                            @ImagePNG($im);
                            @ImageDestroy($im);
                        }break;
                    case 6: {
                            $im = imagecreatefromwbmp($foto->getFotoPath());
                            @ImageWBMP($im);
                            @ImageDestroy($im);
                        }break;
                    default: {
                            $im = imagecreate('256', '192');
                            // Aquí mostramos la imagen en nuestro navegador
                            @ImageJPEG($im);
                            // Destruimos la imagen para liberar espacio
                            @ImageDestroy($im);
                        }
                }
            } else {
                die("imagecreatefrom: Not an array while calling getimagesize()!");
            }
        } else {
            $im = imagecreate('256', '192');
            // Aquí mostramos la imagen en nuestro navegador
            @ImageJPEG($im);
            // Destruimos la imagen para liberar espacio
            @ImageDestroy($im);
        }

        return sfView::NONE;
    }

    public function executeRemoveFoto(sfWebRequest $request) {

        $foto = Doctrine_Core::getTable('FormularioInscripcion')->find($request->getParameter('id'));

        if ($foto != null) {
            $path = $foto->getFotoPath();

            if (file_exists($path)) {
                unlink($path);
            }
            
            $foto->setFotoPath(null);
            $foto->save();

            return $this->renderText(json_encode(true));
        } else {
            return $this->renderText(json_encode(false));
        }
    }
    
    public function executeInscribir(sfWebRequest $request) {
        $this->idForm = $request->getParameter('id');
        
        $formulario = new FormularioInscripcion();
        $formulario = Doctrine_Core::getTable('FormularioInscripcion')->find($this->idForm);
        
        $bUpdate=false;
        
        $usuario = Doctrine_Core::getTable('Usuario')->findBySql('documento = ? AND id_tipo_documento = ?',array($formulario->getDocumento(),$formulario->getIdTipoDocumento()))->getFirst();
        
        if($usuario == null){
            $usuario = new Usuario();
        }else{
            $bUpdate=true;
        }
        
        $aux=explode('.',$formulario->getFotoPath());
        $extension = $aux[1];
        
        $pathOrigen = $formulario->getFotoPath();
        
        $usuario->setPrimerNombre($formulario->getPrimerNombre());
        $usuario->setSegundoNombre($formulario->getSegundoNombre());
        $usuario->setPrimerApellido($formulario->getPrimerApellido());
        $usuario->setSegundoApellido($formulario->getSegundoApellido());
        $usuario->setDocumento($formulario->getDocumento());
        $usuario->setIdTipoDocumento($formulario->getIdTipoDocumento());
        $usuario->setGenero($formulario->getGenero());
        $usuario->setTipoSangre($formulario->getTipoSangre());
        $usuario->setFechaNacimiento($formulario->getFechaNacimiento());
        $usuario->setLugarExpedicion($formulario->getLugarExpedicion());
        $usuario->setTelefono1($formulario->getTelefono1());
        $usuario->setTelefono2($formulario->getTelefono2());
        $usuario->setDireccion($formulario->getDireccion());
        $usuario->setCorreo($formulario->getCorreo());
        $pathDestino = sfConfig::get('sf_app_dir') . '/private_uploads/fotoUsuario/' . $usuario->getDocumento().'-'.$usuario->getIdTipoDocumento() . '.' . $extension;
        $usuario->setFotoPath($pathDestino);
        $usuario->save();
        
        $inscrito = new Inscrito();
        $inscrito->setNumeroFormulario($formulario->getNumero());
        $inscrito->setJornada($formulario->getJornada());
        $inscrito->setTipoPago($formulario->getTipoPago());
        $inscrito->setPeriodoAcademico($formulario->getPeriodoAcademico());
        $inscrito->setUsuario($usuario);
        $inscrito->setIsMatriculado(0);
        $inscrito->setFechaInscripcion(date('Y-m-d'));
        $inscrito->save();
        
        $formulario->setIsInscrito(1);
        $formulario->save();
        
        copy($pathOrigen, $pathDestino);

        if($bUpdate){
            $this->getUser()->setAttribute('notice', 'El aspirante ha sido inscrito exitosamente.');
            $this->getUser()->setAttribute('warning', 'El usuario ya existía y por lo tanto los datos han sido actualizados.');
        }else{
        $this->getUser()->setAttribute('notice', 'El aspirante ha sido inscrito exitosamente.');
        }
        
        $this->redirect('inscrito/edit?id='.$inscrito->getNumeroFormulario());
    }

}

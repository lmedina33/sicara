<?php

/**
 * inscrito actions.
 *
 * @package    sicara2
 * @subpackage inscrito
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inscritoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->inscritos = Doctrine_Core::getTable('inscrito')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new inscritoForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new inscritoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
//        $this->forward404Unless($inscrito = Doctrine_Core::getTable('Inscrito')->find(array($request->getParameter('numero_formulario'))), sprintf('Object inscrito does not exist (%s).', $request->getParameter('numero_formulario')));
//        $this->form = new inscritoForm($inscrito);

        $this->forward404Unless($inscrito = Doctrine_Core::getTable('Inscrito')->find($request->getParameter('id')), sprintf('Object inscrito does not exist (%s).', $request->getParameter('id')));
        $this->form = new InscritoForm($inscrito);

        $this->formUser = new UsuarioForm($inscrito->getUsuario());
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($inscrito = Doctrine_Core::getTable('inscrito')->find(array($request->getParameter('numero_formulario'))), sprintf('Object inscrito does not exist (%s).', $request->getParameter('id_inscrito')));
        $this->form = new inscritoForm($inscrito);
        $this->formUser = new UsuarioForm($inscrito->getUsuario());

        $this->processForm($request, $this->form, $this->formUser);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($inscrito = Doctrine_Core::getTable('inscrito')->find(array($request->getParameter('id_inscrito'))), sprintf('Object inscrito does not exist (%s).', $request->getParameter('id_inscrito')));
        $inscrito->delete();

        $this->redirect('inscrito/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, UsuarioForm $formUser) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $formUser->bind($request->getParameter($formUser->getName()), $request->getFiles($formUser->getName()));
        if ($form->isValid() && $formUser->isValid()) {
            $inscrito = $form->save();

            $file = $formUser->getValue('foto_path');
            echo $file->getOriginalExtension();
            if ($file != null && $file->getOriginalName() != "") {

                $filename = $formUser->getObject()->getDocumento() . '-' . $formUser->getObject()->getIdTipoDocumento();
                $extension = $file->getOriginalExtension();

                $file->save(sfConfig::get('sf_app_dir') . '/private_uploads/fotoUsuario/' . $filename . $extension);

                $formUser->getObject()->setFotoPath(sfConfig::get('sf_app_dir') . '/private_uploads/fotoUsuario/' . $filename . $extension);
            }

            $formUser->save();

            $this->getUser()->setAttribute('notice', 'El inscrito ha sido actualizado con éxito.');
            
            $this->redirect('inscrito/ver?id=' . $inscrito->getNumeroFormulario());
        } else {
            $this->getUser()->setAttribute('error', 'El inscrito no ha podido ser actualizado con éxito.');
        }

        $this->setTemplate('edit');
        
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array(
            'numero_formulario',
            'CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre)',
            't.nombre',
            'u.documento',
            'u.telefono1',
            'u.correo',
            'pen.nombre',
            'per.periodo',
            'j.nombre',
            'is_matriculado');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('
                    i.numero_formulario,
                    CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) AS nombre,
                    t.nombre AS tipo_doc,
                    u.documento as doc,
                    u.telefono1 as tel,
                    u.correo as mail,
                    is_matriculado,
                    pen.nombre AS pensum,
                    per.periodo AS periodo,
                    j.nombre AS jornada')
                ->from('Inscrito i')
                ->leftJoin('i.Usuario u')
                ->leftJoin('u.TipoDocumento t')
                ->leftJoin('i.PeriodoAcademico per')
                ->leftJoin('per.Pensum pen')
                ->leftJoin('i.Jornada j');

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
            $numero = "";
            $tipoDoc = "";
            $documento = "";
            $telefono = "";
            $correo = "";
            $pensum = "";
            $periodo = "";
            $jornada = "";
            $matriculado = "0";
            $idForm = "";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['numero_formulario']))
                $numero = $rows[$i]['numero_formulario'];

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

            if (isset($rows[$i]['periodo']))
                $periodo = $rows[$i]['periodo'];

            if (isset($rows[$i]['jornada']))
                $jornada = $rows[$i]['jornada'];

            if (isset($rows[$i]['is_matriculado']))
                $matriculado = $rows[$i]['is_matriculado'];

            $form = Doctrine_Core::getTable('FormularioInscripcion')->findBy('numero', $numero)->getFirst();
            if ($form != null)
                $idForm = $form->getIdFormularioInscripcion();

            //*Se agregan los datos en la matriz
            $data[$i] = array('Numero' => $numero, 'Nombre' => $nombre, 'TipoDoc' => $tipoDoc, 'Documento' => $documento, 'Telefono' => $telefono, 'Correo' => $correo, 'Pensum' => $pensum, 'Periodo' => $periodo, 'Jornada' => $jornada, 'Matriculado' => $matriculado, 'IdForm' => $idForm);
        }

        //*Calculo del total de registros en la BD si no se usaran los filtros de busqueda
        $q = Doctrine_Query::create()
                ->select('COUNT(numero_formulario) AS total')
                ->from('Inscrito i');

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
        $this->forward404Unless($inscrito = Doctrine_Core::getTable('Inscrito')->find($request->getParameter('id')), sprintf('Object inscrito does not exist (%s).', $request->getParameter('id')));
        $this->form = new InscritoForm($inscrito);

        $this->formUser = new UsuarioForm($inscrito->getUsuario());
    }
    
    public function executeRenderFoto(sfWebRequest $request) {
        $usuario = Doctrine_Core::getTable('Usuario')->find($request->getParameter('id'));

        if ($usuario != null && $usuario->getFotoPath() != null && $usuario->getFotoPath() != "") {

            $image_creators = array(
                1 => "imagecreatefromgif",
                2 => "imagecreatefromjpeg",
                3 => "imagecreatefrompng",
                6 => "imagecreatefromwbmp",
                16 => "imagecreatefromxbm"
            );

            $image_size = getimagesize($usuario->getFotoPath());
            if (is_array($image_size)) {
                $file_type = $image_size[2];
                switch ($file_type) {
                    case 1: {
                            $im = imagecreatefromgif($usuario->getFotoPath());
                            // Aquí mostramos la imagen en nuestro navegador
                            @ImageGIF($im);
                            // Destruimos la imagen para liberar espacio
                            @ImageDestroy($im);
                        }break;
                    case 2: {
                            $im = imagecreatefromjpeg($usuario->getFotoPath());
                            @ImageJPEG($im);
                            @ImageDestroy($im);
                        }break;
                    case 3: {
                            $im = imagecreatefrompng($usuario->getFotoPath());
                            @ImagePNG($im);
                            @ImageDestroy($im);
                        }break;
                    case 6: {
                            $im = imagecreatefromwbmp($usuario->getFotoPath());
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
    
    public function executeValidarDocumento(sfWebRequest $request) {
        $value = $request->getParameter('fieldValue');
        $id = $request->getParameter('fieldId');
        $idUs = $request->getParameter('usuario_id_usuario');
        $idUsTip = $request->getParameter('usuario_id_tipo_documento');
        $usuario = Doctrine_Core::getTable('Usuario')->findBySql('documento = "'.$value.'" AND id_tipo_documento = '.$idUsTip.' AND id_usuario != '.$idUs)->getFirst();
        $data = array();
        $data[0] = $id;
        if ($usuario == null) {
            $data[1] = true;
        } else {
            $data[1] = false;
        }

        return $this->renderText(json_encode($data));
    }
    
    public function executeValidarTipoDocumento(sfWebRequest $request) {
        $value = $request->getParameter('fieldValue');
        $id = $request->getParameter('fieldId');
        $idUs = $request->getParameter('usuario_id_usuario');
        $doc = $request->getParameter('usuario_documento');
        $usuario = Doctrine_Core::getTable('Usuario')->findBySql('id_tipo_documento = '.$value.' AND documento = "'.$doc.'" AND id_usuario != '.$idUs)->getFirst();
        $data = array();
        $data[0] = $id;
        if ($usuario == null) {
            $data[1] = true;
        } else {
            $data[1] = false;
        }

        return $this->renderText(json_encode($data));
    }

}

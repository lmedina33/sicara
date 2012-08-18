<?php

/**
 * refElemento actions.
 *
 * @package    sicara2
 * @subpackage refElemento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class refElementoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        /* $this->ref_elementos = Doctrine_Core::getTable('RefElemento')
          ->createQuery('a')
          ->execute(); */

        $this->filtroTipo = "0";
        $this->filtroEstado = "0";
        $this->filtroUsuario = "0";

        $this->form = new FiltroRefElementoForm();
        $this->form->bind($request->getParameter($this->form->getName()));
        $data = $request->getParameter($this->form->getName());

        if ($data['id_ref_tipo_elemento'] != "")
            $this->filtroTipo = $data['id_ref_tipo_elemento'];

        if ($data['id_ref_estado_elemento'])
            $this->filtroEstado = $data['id_ref_estado_elemento'];

        if ($data['id_usuario_responsable'])
            $this->filtroUsuario = $data['id_usuario_responsable'];
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new RefElementoForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new RefElementoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($ref_elemento = Doctrine_Core::getTable('RefElemento')->find(array($request->getParameter('id_ref_elemento'))), sprintf('Object ref_elemento does not exist (%s).', $request->getParameter('id_ref_elemento')));
        $this->form = new RefElementoForm($ref_elemento);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($ref_elemento = Doctrine_Core::getTable('RefElemento')->find(array($request->getParameter('id_ref_elemento'))), sprintf('Object ref_elemento does not exist (%s).', $request->getParameter('id_ref_elemento')));
        $this->form = new RefElementoForm($ref_elemento);

        $this->processForm($request, $this->form, true);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($ref_elemento = Doctrine_Core::getTable('RefElemento')->find(array($request->getParameter('id_ref_elemento'))), sprintf('Object ref_elemento does not exist (%s).', $request->getParameter('id_ref_elemento')));
        $ref_elemento->delete();

        $this->redirect('refElemento/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $registar = false) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {

            if ($registar) {
                $informe = "";
                $elemento = Doctrine_Core::getTable('RefElemento')->find($form->getValue('id_ref_elemento'));

                if ($elemento != null) {
                    $tipo = Doctrine_Core::getTable('RefTipoElemento')->find($form->getValue('id_ref_tipo_elemento'));
                    if ($elemento->getIdRefTipoElemento() != $form->getValue('id_ref_tipo_elemento')) {
                        $informe = $informe . "<li>Se cambió el tipo de elemento: de '" . $elemento->getRefTipoElemento() . "' a '" . $tipo->getNombre() . "'</li>";
                    }

                    if ($elemento->getSerial() != $form->getValue('serial')) {
                        $informe = $informe . "<li>Se cambió el serial: de '" . $elemento->getSerial() . "' a '" . $form->getValue('serial') . "'</li>";
                    }
                    if ($elemento->getSerialInterno() != $form->getValue('serial_interno')) {
                        $informe = $informe . "<li>Se cambió el serial interno: de '" . $elemento->getSerialInterno() . "' a '" . $form->getValue('serial_interno') . "'</li>";
                    }
                    if ($elemento->getNombre() != $form->getValue('nombre')) {
                        $informe = $informe . "<li>Se cambió el nombre: de '" . $elemento->getNombre() . "' a '" . $form->getValue('nombre') . "'</li>";
                    }
                    if ($elemento->getMarca() != $form->getValue('marca')) {
                        $informe = $informe . "<li>Se cambió la marca: de '" . $elemento->getMarca() . "' a '" . $form->getValue('marca') . "'</li>";
                    }
                    if ($elemento->getModelo() != $form->getValue('modelo')) {
                        $informe = $informe . "<li>Se cambió el modelo: de '" . $elemento->getModelo() . "' a '" . $form->getValue('modelo') . "'</li>";
                    }

                    $usuario = Doctrine_Core::getTable('Usuario')->find($form->getValue('id_usuario_responsable'));
                    if ($elemento->getIdUsuarioResponsable() != $form->getValue('id_usuario_responsable')) {
                        $informe = $informe . "<li>Se cambió el usuario responsable: de '" . $elemento->getUsuarioResponsable() . "' a '" . $usuario . "'</li>";
                    }

                    $estado = Doctrine_Core::getTable('RefEstadoElemento')->find($form->getValue('id_ref_estado_elemento'));
                    if ($elemento->getIdRefEstadoElemento() != $form->getValue('id_ref_estado_elemento')) {
                        $informe = $informe . "<li>Se cambió el estado del elemento: de '" . $elemento->getRefEstadoElemento() . "' a '" . $estado . "'</li>";
                    }

                    if ($elemento->getDescripcion() != $form->getValue('descripcion')) {
                        $informe = $informe . "<li>Se cambió la descripcion: de '" . $elemento->getDescripcion() . "' a '" . $form->getValue('descripcion') . "'</li>";
                    }
                    if ($elemento->getIsPrestable() != $form->getValue('is_prestable')) {
                        $informe = $informe . "<li>Se cambió la posibilidad de ser prestable: de '" . ($elemento->getIsPrestable() == 1 ? "Si" : "No") . "' a '" . ($form->getValue('is_prestable') == 1 ? "Si" : "No") . "'</li>";
                    }

                    $tipoSancion = Doctrine_Core::getTable('RefTipoSancion')->find($form->getValue('id_ref_tipo_sancion'));
                    if ($elemento->getIdRefTipoSancion() != $form->getValue('id_ref_tipo_sancion')) {
                        $informe = $informe . "<li>Se cambió el tipo de sanción: de '" . ($elemento->getRefTipoSancion() == null ? "" : $elemento->getRefTipoSancion()->getNombre()) . "' a '" . ($tipoSancion == null ? "" : $tipoSancion) . "'</li>";
                    }
                    if ($elemento->getCantidadSancion() != $form->getValue('cantidad_sancion')) {
                        $informe = $informe . "<li>Se cambió la cantidad de la sancion: de '" . $elemento->getCantidadSancion() . "' a '" . $form->getValue('cantidad_sancion') . "'</li>";
                    }

                    $lugar = Doctrine_Core::getTable('RefLugar')->find($form->getValue('id_ref_lugar'));
                    if ($elemento->getIdRefLugar() != $form->getValue('id_ref_lugar')) {
                        $informe = $informe . "<li>Se cambió el lugar: de '" . $elemento->getRefLugar()->getPath() . "' a '" . $lugar->getPath() . "'</li>";
                    }

                    if (strlen($informe) != 0) {

                        $informe = "Se realizaron los siguientes cambios sobre los datos propios del elemento: <br /><ul>" . $informe . "</ul>";

                        $registro = new RefHojaVida();
                        $registro->setDescripcion($informe);
                        $registro->setIdRefElemento($elemento->getIdRefElemento());
                        $registro->setIdUsuarioCreador($usuario = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user', $this->getUser()->getGuardUser()->getId())->getFirst()->getIdUsuario());
                        $registro->save();
                    }
                }
            }

            $form->save();

            $this->redirect('refElemento/index');
        }
    }

    public function executeAddFoto(sfWebRequest $request) {
        $formFoto = new RefFotoElementoForm();

        $formFoto->bind($request->getParameter($formFoto->getName()), $request->getFiles($formFoto->getName()));

        if ($formFoto->isValid()) {

            $file = $formFoto->getValue('file');

            $filename = sha1(date('Y-m-d H:i:s'));
            $originalName = $file->getOriginalName() . $file->getOriginalExtension();
            $extension = $file->getOriginalExtension();

            $file->save(sfConfig::get('sf_app_dir') . '/private_uploads/RefFotoElemento/' . $filename . $extension);

            $foto = $formFoto->getObject();
            $foto->setNombre($originalName);
            $foto->setPath(sfConfig::get('sf_app_dir') . '/private_uploads/RefFotoElemento/' . $filename . $extension);
            $foto->setIdRefElemento($request->getParameter('idEle'));

            $foto->save();

            $this->getUser()->setAttribute('notice', 'La fotografía ha sido cargada con éxito.');
        } else {
            $this->getUser()->setAttribute('error', 'La fotografía no pudo ser guardada.');
            $this->setTemplate('ver');
        }

        $this->redirect('refElemento/ver?id_ref_elemento=' . $request->getParameter('idEle'));
    }

    public function executeGetDataPaging(sfWebRequest $request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array('id_ref_elemento', 't.nombre', 'serial', 'serial_interno', 'nombre', 'marca', 'modelo', 'is_prestable', 'l.nombre', 'CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre)', 'es.nombre');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('e.id_ref_elemento,
                    t.nombre AS tipo,
                    e.serial,
                    e.serial_interno,
                    e.nombre,
                    e.marca,
                    e.modelo,
                    e.is_prestable,
                    e.id_ref_tipo_elemento,
                    es.nombre AS estado,
                    l.nombre AS lugar,
                    CONCAT(u.primer_apellido," ",u.segundo_apellido," ",u.primer_nombre," ",u.segundo_nombre) AS usuario')
                ->from('RefElemento e')
                ->leftJoin('e.RefLugar l')
                ->leftJoin('e.RefTipoElemento t')
                ->leftJoin('e.RefEstadoElemento es')
                ->leftJoin('e.UsuarioResponsable u');

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

        if ($request->hasParameter('fTip') && $request->getParameter('fTip') != "0") {
            if ($bWhere)
                $q->andWhere('e.id_ref_tipo_elemento = ?', $request->getParameter('fTip'));
            else {
                $q->where('e.id_ref_tipo_elemento = ?', $request->getParameter('fTip'));
                $bWhere = true;
            }
        }
        if ($request->hasParameter('fEst') && $request->getParameter('fEst') != "0") {
            if ($bWhere)
                $q->andWhere('e.id_ref_estado_elemento = ?', $request->getParameter('fEst'));
            else {
                $q->where('e.id_ref_estado_elemento = ?', $request->getParameter('fEst'));
                $bWhere = true;
            }
        }
        if ($request->hasParameter('fUsu') && $request->getParameter('fUsu') != "0") {
            if ($bWhere)
                $q->andWhere('e.id_usuario_responsable = ?', $request->getParameter('fUsu'));
            else {
                $q->where('e.id_usuario_responsable = ?', $request->getParameter('fUsu'));
                $bWhere = true;
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
            $tipo = "";
            $serial = "";
            $serial_interno = "";
            $nombre = "";
            $marca = "";
            $modelo = "";
            $lugar = "";
            $usuario = "";
            $prestable = "";
            $id_foto = "";
            $estado = "";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['id_ref_elemento']))
                $id = $rows[$i]['id_ref_elemento'];

            if (isset($rows[$i]['tipo']))
                $tipo = $rows[$i]['tipo'];

            if (isset($rows[$i]['serial']))
                $serial = $rows[$i]['serial'];

            if (isset($rows[$i]['serial_interno']))
                $serial_interno = $rows[$i]['serial_interno'];

            if (isset($rows[$i]['nombre']))
                $nombre = $rows[$i]['nombre'];

            if (isset($rows[$i]['marca']))
                $marca = $rows[$i]['marca'];

            if (isset($rows[$i]['modelo']))
                $modelo = $rows[$i]['modelo'];

            if (isset($rows[$i]['lugar']))
                $lugar = $rows[$i]['lugar'];

            if (isset($rows[$i]['usuario']))
                $usuario = $rows[$i]['usuario'];

            if (isset($rows[$i]['is_prestable']))
                $prestable = $rows[$i]['is_prestable'];

            $rows2 = Doctrine_Core::getTable('RefFotoElemento')
                    ->createQuery('f')
                    ->select('id_ref_foto_elemento')
                    ->where('f.id_ref_elemento = ?', $id)
                    ->execute()
                    ->getFirst();
            if ($rows2 != null) {
                $id_foto = $rows2['id_ref_foto_elemento'];
            }

            if (isset($rows[$i]['estado']))
                $estado = $rows[$i]['estado'];

            //*Se agregan los datos en la matriz
            $data[$i] = array('Id' => $id, 'Tipo' => $tipo, 'Serial' => $serial, 'SerialInterno' => $serial_interno, 'Nombre' => $nombre, 'Marca' => $marca, 'Modelo' => $modelo, 'Lugar' => $lugar, 'Usuario' => $usuario, 'Prestable' => $prestable, 'IdFoto' => $id_foto, 'Estado' => $estado);
        }

        //*Calculo del total de registros en la BD si no se usaran los filtros de busqueda
        $q = Doctrine_Query::create()
                ->select('COUNT(id_ref_elemento) AS total')
                ->from('RefElemento e');

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
        $this->isSearch = $request->getParameter('search');

        $this->formFoto = new RefFotoElementoForm();

        $this->elemento = Doctrine_Core::getTable('RefElemento')->find($request->getParameter('id_ref_elemento'));

        $foto = Doctrine_Core::getTable('RefFotoElemento')->findBy('id_ref_elemento', $this->elemento->getIdRefElemento())->getFirst();

        $this->id_foto = "";

        if ($foto != null) {
            $this->id_foto = $foto->getIdRefFotoElemento();
        }

        if ($this->isSearch == "1") {
            $this->setLayout('vacio');
        }
    }

    public function executeFindUsuarios(sfWebRequest $request) {
        $result = Doctrine_Core::getTable('Usuario')
                ->createQuery('u')
                ->select("u.id_usuario, CONCAT(u.primer_nombre,' ',u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) AS nombre")
                ->where("CONCAT(u.primer_nombre,' ',u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) LIKE '%" . $request->getParameter('q') . "%'")
                ->limit(10)
                ->fetchArray();

        $data = array();
        foreach ($result as $usuario) {
            $data[$usuario['id_usuario']] = $usuario['nombre'];
        }

        return $this->renderText(json_encode($data));
    }

    public function executeGetArbol(sfWebRequest $request) {

        $sedes = Doctrine_Core::getTable('RefLugar')->findBy('id_ref_tipo_lugar', 1);

        $arbol = "";
        foreach ($sedes as $sede) {
            $arbol = $arbol . '<li><img src="/images/iconos/sede.png" /> <a href="javascript:selectLugar(' . $sede->getIdRefLugar() . ')">' . $sede->getNombre() . '</a>';

            $edificios = Doctrine_Core::getTable('RefLugar')
                    ->createQuery('l')
                    ->where('id_ref_tipo_lugar = 2')
                    ->andWhere('id_ref_lugar_contenedor = ?', $sede->getIdRefLugar())
                    ->execute();

            if ($edificios->count() > 0) {
                $arbol = $arbol . '<ul>';

                foreach ($edificios as $edificio) {
                    $arbol = $arbol . '<li><img src="/images/iconos/edificio.png" /> <a href="javascript:selectLugar(' . $edificio->getIdRefLugar() . ')">' . $edificio->getNombre() . '</a>';

                    $lugares = Doctrine_Core::getTable('RefLugar')->findBy('id_ref_lugar_contenedor', $edificio->getIdRefLugar());

                    if ($lugares->count() > 0) {
                        $arbol = $arbol . '<ul>';
                        foreach ($lugares AS $lugar) {
                            $arbol = $arbol . '<li>';

                            switch ($lugar->getIdRefTipoLugar()) {
                                case '3': $arbol = $arbol . '<img src="/images/iconos/oficina.png" />';
                                    break;
                                case '4': $arbol = $arbol . '<img src="/images/iconos/auditorio.png" />';
                                    break;
                                case '5': $arbol = $arbol . '<img src="/images/iconos/salon.png" />';
                                    break;
                                case '6': $arbol = $arbol . '<img src="/images/iconos/laboratorio.png" />';
                                    break;
                                default: $arbol = $arbol . '<img src="/images/iconos/lugar.png" />';
                            }

                            $arbol = $arbol . ' <a href="javascript:selectLugar(' . $lugar->getIdRefLugar() . ')">' . $lugar->getNombre() . '</a></li>';
                        }
                        $arbol = $arbol . '</ul>';
                    }

                    $arbol = $arbol . '</li>';
                }

                $arbol = $arbol . '</ul>';
            }
            $arbol = $arbol . '</li>';
        }

        return $this->renderText($arbol);
    }

    public function executeRenderFoto(sfWebRequest $request) {
        $foto = Doctrine_Core::getTable('RefFotoElemento')->find($request->getParameter('id'));

        if ($foto != null) {

            $image_creators = array(
                1 => "imagecreatefromgif",
                2 => "imagecreatefromjpeg",
                3 => "imagecreatefrompng",
                6 => "imagecreatefromwbmp",
                16 => "imagecreatefromxbm"
            );

            $image_size = getimagesize($foto->getPath());
            if (is_array($image_size)) {
                $file_type = $image_size[2];
                switch ($file_type) {
                    case 1: {
                            $im = imagecreatefromgif($foto->getPath());
                            // Aquí mostramos la imagen en nuestro navegador
                            @ImageGIF($im);
                            // Destruimos la imagen para liberar espacio
                            @ImageDestroy($im);
                        }break;
                    case 2: {
                            $im = imagecreatefromjpeg($foto->getPath());
                            @ImageJPEG($im);
                            @ImageDestroy($im);
                        }break;
                    case 3: {
                            $im = imagecreatefrompng($foto->getPath());
                            @ImagePNG($im);
                            @ImageDestroy($im);
                        }break;
                    case 6: {
                            $im = imagecreatefromwbmp($foto->getPath());
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

    public function executeShowFoto(sfWebRequest $request) {
        $this->id = $request->getParameter('id');

        sfConfig::set('sf_web_debug', false);

        return $this->setLayout(false);
    }

    public function executeRemoveFoto(sfWebRequest $request) {

        $foto = Doctrine_Core::getTable('RefFotoElemento')->find($request->getParameter('id'));

        if ($foto != null) {
            $path = $foto->getPath();
            $foto->delete();
            if (file_exists($path)) {
                unlink($path);
            }

            $this->getUser()->setAttribute('notice', 'La fotografía ha sido eliminada con éxito.');
        } else {
            $this->getUser()->setAttribute('error', 'La fotografía no pudo ser eliminada.');
        }

        $this->redirect('refElemento/ver?id_ref_elemento=' . $request->getParameter('idEle'));
    }

    public function executeVerListado(sfWebRequest $request) {

        $this->elementos = Doctrine_Core::getTable('RefElemento')->createQuery('e')->orderBy('id_ref_lugar')->execute();

        $this->getContext()->getResponse()->setHttpHeader('Content-Disposition', 'inline;filename=NDEP_DB_Export_' . date("Y-m-d_Hi") . '.csv;');

        sfConfig::set('sf_web_debug', false);

        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Content-Type', 'application/vnd.ms-excel');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=listadoElementos.csv');

        echo '"Serial","Serial Interno","Nombre","Marca","Modelo","'.utf8_decode('Descripción').'","Tipo","Lugar","'.utf8_decode('Ubicación').'","Prestable?","'.utf8_decode('Sanción').'","Cantidad '.utf8_decode('Sanción').'","Estado","Responsable"';

        echo "\n";

        foreach ($this->elementos as $elemento) {
            echo '"' . utf8_decode(str_replace('"', '""', $elemento->getSerial())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getSerialInterno())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getNombre())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getMarca())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getModelo())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getDescripcion())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getRefTipoElemento())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getRefLugar()->getPath())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getUbicacion())) . '","';
            echo ($elemento->getIsPrestable() == 1 ? "Si" : "No") . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getRefTipoSancion()->getNombre())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getCantidadSancion())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getRefEstadoElemento())) . '","';
            echo utf8_decode(str_replace('"', '""', $elemento->getUsuarioResponsable())) . '"';

            echo "\n";
        }

        return sfView::NONE;
    }

}

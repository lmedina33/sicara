<?php

/**
 * libMaterial actions.
 *
 * @package    sicara2
 * @subpackage libMaterial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libMaterialActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->lib_materials = Doctrine_Core::getTable('LibMaterial')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new LibMaterialForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LibMaterialForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('id_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('id_lib_material')));
        $this->form = new LibMaterialForm($lib_material);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('id_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('id_lib_material')));
        $this->form = new LibMaterialForm($lib_material);

        $this->processForm($request, $this->form, true);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('id_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('id_lib_material')));
        $lib_material->delete();

        $this->getUser()->setAttribute('notice', 'El material dado ha sido completamente eliminado del sistema.');

        $this->redirect('libMaterial/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $editado = false) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $lib_material = $form->save();
            if ($editado)
                $this->getUser()->setAttribute('notice', 'El material con código ' . $lib_material->getCodigoLibMaterial() . ' ha sido editado exitosamente.');
            else
                $this->getUser()->setAttribute('notice', 'El nuevo material con código ' . $lib_material->getCodigoLibMaterial() . ' ha sido creado exitosamente.');
        } else {
            if ($editado)
                $this->getUser()->setAttribute('error', 'El material no ha podido ser editado.');
            else
                $this->getUser()->setAttribute('error', 'El nuevo material no ha podido ser creado.');
        }

        $this->redirect('libMaterial/ver?id_lib_material='.$lib_material->getIdLibMaterial());
    }

    public function executeValidarCodigo(sfWebRequest $request) {
        $value = $request->getParameter('fieldValue');
        $id = $request->getParameter('fieldId');
        $material=null;
        
        $data = array();
        $data[0] = $id;
        
        if($request->getParameter('lib_material_id_lib_material')!=""){
            $material = Doctrine_Core::getTable('LibMaterial')
                    ->createQuery('m')
                    ->where('id_lib_material != ?',$request->getParameter('lib_material_id_lib_material'))
                    ->andWhere('codigo_lib_material = ?',$value)
                    ->execute();
        }else{
            $material = Doctrine_Core::getTable('LibMaterial')
                ->createQuery('m')
                ->where('codigo_lib_material = ?',$value)
                ->execute();
        }
        
        if ($material->count() == 0) {
            $data[1] = true;
        } else {
            $data[1] = false;
        }

        return $this->renderText(json_encode($data));
    }

    public function executeVer(sfWebRequest $request) {
        $this->isSearch=$request->getParameter('search');
        
        $this->material = Doctrine_Core::getTable('LibMaterial')->find($request->getParameter('id_lib_material'));

        $this->items = $this->material->getLibItem();

        if (count($this->items) == 0)
            $this->getUser()->setAttribute('warning', 'Este material no tiene copias asignadas.');


        $this->autores = $this->autores . "<ul class=verMasAutores>";
        $aux = explode("\n", $this->material->getAutores());
        foreach ($aux as $autor) {
            $this->autores = $this->autores . "<li>" . $autor . "</li>";
        }
        $this->autores = $this->autores . "</ul>";


        $this->descripciones = $this->descripciones . "<ul class=verMasDescripciones>";
        $aux = explode("\n", $this->material->getDescripcion());
        foreach ($aux as $descripcion) {
            $this->descripciones = $this->descripciones . "<li>" . $descripcion . "</li>";
        }
        $this->descripciones = $this->descripciones . "</ul>";


        $this->temas = $this->temas . "<ul class=verMasTemas>";
        $aux = explode("\n", $this->material->getTemas());
        foreach ($aux as $tema) {
            $this->temas = $this->temas . "<li>" . $tema . "</li>";
        }
        $this->temas = $this->temas . "</ul>";
        
        if($this->isSearch=="1"){
            $this->setLayout('vacio');
        }
    }

    public function executeAddItem(sfWebRequest $request) {
        $this->material = Doctrine_Core::getTable('LibMaterial')->find($request->getParameter('id_lib_material'));

        $this->items = $this->material->getLibItem();

        $this->autores = $this->autores . "<ul class=verMasAutores>";
        $aux = explode("\n", $this->material->getAutores());
        foreach ($aux as $autor) {
            $this->autores = $this->autores . "<li>" . $autor . "</li>";
        }
        $this->autores = $this->autores . "</ul>";


        $this->descripciones = $this->descripciones . "<ul class=verMasDescripciones>";
        $aux = explode("\n", $this->material->getDescripcion());
        foreach ($aux as $descripcion) {
            $this->descripciones = $this->descripciones . "<li>" . $descripcion . "</li>";
        }
        $this->descripciones = $this->descripciones . "</ul>";


        $this->temas = $this->temas . "<ul class=verMasTemas>";
        $aux = explode("\n", $this->material->getTemas());
        foreach ($aux as $tema) {
            $this->temas = $this->temas . "<li>" . $tema . "</li>";
        }
        $this->temas = $this->temas . "</ul>";

        $this->formItem = new LibItemForm();
        $this->formItem->setDefault('fecha_actualizacion', date('Y-m-d'));
        $this->formItem->setDefault('id_lib_material', $this->material->getIdLibMaterial());
    }

    public function executeCreateItem(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LibItemForm();

        $this->processFormItem($request, $this->form);
    }

    public function executeEditItem(sfWebRequest $request) {
        $this->forward404Unless($lib_item = Doctrine_Core::getTable('LibItem')->find(array($request->getParameter('serial_lib_item'))), sprintf('Object lib_item does not exist (%s).', $request->getParameter('serial_lib_item')));

        $this->material = Doctrine_Core::getTable('LibMaterial')->find($lib_item->getIdLibMaterial());

        $this->items = $this->material->getLibItem();

        $this->autores = $this->autores . "<ul class=verMasAutores>";
        $aux = explode("\n", $this->material->getAutores());
        foreach ($aux as $autor) {
            $this->autores = $this->autores . "<li>" . $autor . "</li>";
        }
        $this->autores = $this->autores . "</ul>";


        $this->descripciones = $this->descripciones . "<ul class=verMasDescripciones>";
        $aux = explode("\n", $this->material->getDescripcion());
        foreach ($aux as $descripcion) {
            $this->descripciones = $this->descripciones . "<li>" . $descripcion . "</li>";
        }
        $this->descripciones = $this->descripciones . "</ul>";


        $this->temas = $this->temas . "<ul class=verMasTemas>";
        $aux = explode("\n", $this->material->getTemas());
        foreach ($aux as $tema) {
            $this->temas = $this->temas . "<li>" . $tema . "</li>";
        }
        $this->temas = $this->temas . "</ul>";

        $this->formItem = new LibItemForm($lib_item);
    }

    public function executeUpdateItem(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($lib_item = Doctrine_Core::getTable('LibItem')->find(array($request->getParameter('serial_lib_item'))), sprintf('Object lib_item does not exist (%s).', $request->getParameter('serial_lib_item')));
        $this->form = new LibItemForm($lib_item);

        $this->processFormItem($request, $this->form, true);
    }

    protected function processFormItem(sfWebRequest $request, sfForm $form, $editado = false) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            if ($editado){
                $lib_item = $form->save();
                $this->getUser()->setAttribute('notice', 'La copia con serial ' . $lib_item->getSerialLibItem() . ' ha sido editada exitosamente.');
            }else{
                if(Doctrine_Core::getTable('LibItem')->find($form->getValue('serial_lib_item'))==null){
                    $lib_item = $form->save();
                    $this->getUser()->setAttribute('notice', 'La nueva copia con serial ' . $lib_item->getSerialLibItem() . ' ha sido creada exitosamente.');
                }else{
                    $this->getUser()->setAttribute('error', 'La nueva copia no ha podido ser creada. Ya existe una copia con el serial '.$form->getValue('serial_lib_item').'.');
                }
            }
        } else {
            if ($editado)
                $this->getUser()->setAttribute('error', 'La copia no ha podido ser editada.');
            else
                $this->getUser()->setAttribute('error', 'La nueva copia no ha podido ser creada.');
        }

        $this->redirect('libMaterial/ver?id_lib_material=' . $form->getValue('id_lib_material'));
    }

    public function executeDeleteItem(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($lib_item = Doctrine_Core::getTable('LibItem')->find(array($request->getParameter('serial_lib_item'))), sprintf('Object lib_item does not exist (%s).', $request->getParameter('serial_lib_item')));

        $codMaterial = $lib_item->getIdLibMaterial();

        $lib_item->delete();

        $this->getUser()->setAttribute('notice', 'La copia dada ha sido completamente eliminada del sistema.');

        $this->redirect('libMaterial/ver?id_lib_material=' . $codMaterial);
    }

    public function executeValidarSerialItem(sfWebRequest $request) {
        $value = $request->getParameter('fieldValue');
        $id = $request->getParameter('fieldId');
        $item = Doctrine_Core::getTable('LibItem')->find($value);
        $data = array();
        $data[0] = $id;
        if ($item == null) {
            $data[1] = true;
        } else {
            $data[1] = false;
        }

        return $this->renderText(json_encode($data));
    }

    public function executeGetDataPaging($request) {
        //*Se construye el arreglo que contiene los campos a mostrarse con este datatable
        $aColumns = array('id_lib_material','codigo_lib_material', 'titulo', 'sub_titulo', 'autores', 'c.nombre', 't.nombre');

        //*Se seleeciona la tabla y los campos que se van a mostrar en este datatables
        $q = Doctrine_Query::create()
                ->select('m.id_lib_material,
                    m.codigo_lib_material,
                    m.titulo,
                    m.sub_titulo,
                    m.autores,
                    c.nombre AS categoria,
                    t.nombre AS tipo')
                ->from('LibMaterial m')
                ->leftJoin('m.LibCategoria c')
                ->leftJoin('m.LibTipoMaterial t');

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
            $codigo = "";
            $titulo = "";
            $subTitulo = "";
            $autor = "";
            $categoria = "";
            $tipo = "";
            $items = "0";

            //*Se evalúa si el dato a insertar existe
            if (isset($rows[$i]['id_lib_material']))
                $id = $rows[$i]['id_lib_material'];
            
            if (isset($rows[$i]['codigo_lib_material']))
                $codigo = $rows[$i]['codigo_lib_material'];

            if (isset($rows[$i]['titulo']))
                $titulo = $rows[$i]['titulo'];

            if (isset($rows[$i]['sub_titulo']))
                $subTitulo = $rows[$i]['sub_titulo'];

            if (isset($rows[$i]['autores']))
                $autor = $rows[$i]['autores'];

            if (isset($rows[$i]['categoria']))
                $categoria = $rows[$i]['categoria'];

            if (isset($rows[$i]['tipo']))
                $tipo = $rows[$i]['tipo'];

            $rows2 = Doctrine_Core::getTable('LibItem')
                    ->createQuery('i')
                    ->select('COUNT(i.serial_lib_item) AS nitems')
                    ->groupBy('i.id_lib_material')
                    ->having('i.id_lib_material = ?', array($id))
                    ->fetchArray();

            if (isset($rows2[0]['nitems']))
                $items = $rows2[0]['nitems'];

            //*Se agregan los datos en la matriz
            $data[$i] = array('Id' => $id,'Codigo' => $codigo, 'Titulo' => $titulo, 'SubTitulo' => $subTitulo, 'Autor' => $autor, 'Categoria' => $categoria, 'Tipo' => $tipo, 'NItems' => $items);
        }

        //*Calculo del total de registros en la BD si no se usaran los filtros de busqueda
        $q = Doctrine_Query::create()
                ->select('COUNT(codigo_lib_material) AS total')
                ->from('LibMaterial m');

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

    public function executeBuscar(sfWebRequest $request) {

        $this->form = new SelectorFiltroForm();

        $this->lib_materials = null;

        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()));


            $idsTipos = $this->form->getValue('tipo_material');

            $this->sIdsTipos = "";

            for ($i = 0; $i < count($idsTipos); $i++) {
                if ($i == 0)
                    $this->sIdsTipos = "" . $idsTipos[$i];
                else
                    $this->sIdsTipos = $this->sIdsTipos . "," . $idsTipos[$i];
            }

            $this->filtro = $this->form->getValue('filtro');
            $this->parametro = $this->form->getValue('tipo_filtro');
            $this->page = 1;
            $this->limit = 10;

            $q = Doctrine_Core::getTable('LibMaterial')
                    ->createQuery('m')
                    ->where('m.id_lib_tipo_material IN (' . $this->sIdsTipos . ')');

            $filters = explode(' ', $this->filtro);

            $sql = "";

            switch ($this->parametro) {
                case 'codigo': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.codigo_lib_material LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.codigo_lib_material LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'titulos': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.titulo LIKE '%" . $filters[$i] . "%'";
                                    $sql = $sql . " OR m.sub_titulo LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.titulo LIKE '%" . $filters[$i] . "%'";
                                    $sql = $sql . " OR m.sub_titulo LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'autores': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.autores LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.autores LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'editorial': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.editorial LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.editorial LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'temas': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.temas LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.temas LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
            }
            ;

            $q->andWhere($sql);

            $pager = new Doctrine_Pager($q, $this->page, $this->limit);

            $this->lib_materials = $pager->execute();

            $this->lastPage = $pager->getLastPage();
            
            $this->materialsShowed = $pager->getResultsInPage();
            
            $this->total = $pager->getNumResults();
            
            $this->indicePrimero=$pager->getFirstIndice();
            
            $this->indiceUltimo=$pager->getLastIndice();
        }

        if ($request->isMethod(sfRequest::GET) && $request->getParameter('filtro') != null) {
            $this->filtro = $request->getParameter('filtro');
            $this->parametro = $request->getParameter('parametro');
            $this->sIdsTipos = $request->getParameter('tipos');
            $this->page = $request->getParameter('page');
            $this->limit = $request->getParameter('limit');

            $this->form->setDefaults(array(
                'filtro' => $this->filtro,
                'tipo_filtro' => $this->parametro,
                'tipo_material' => explode(',', $this->sIdsTipos)
            ));

            $q = Doctrine_Core::getTable('LibMaterial')
                    ->createQuery('m')
                    ->where('m.id_lib_tipo_material IN (' . $this->sIdsTipos . ')');
            
            $filters = explode(' ', $this->filtro);

            $sql = "";

            switch ($this->parametro) {
                case 'codigo': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.codigo_lib_material LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.codigo_lib_material LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'titulos': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.titulo LIKE '%" . $filters[$i] . "%'";
                                    $sql = $sql . " OR m.sub_titulo LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.titulo LIKE '%" . $filters[$i] . "%'";
                                    $sql = $sql . " OR m.sub_titulo LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'autores': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.autores LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.autores LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'editorial': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.editorial LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.editorial LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
                case 'temas': {
                        for ($i = 0; $i < count($filters); $i++) {
                            if ($filters[$i] != "") {
                                if ($i == 0) {
                                    $sql = $sql . "m.temas LIKE '%" . $filters[$i] . "%'";
                                } else {
                                    $sql = $sql . " OR m.temas LIKE '%" . $filters[$i] . "%'";
                                }
                            }
                        }
                    }
                    break;
            }
            ;

            $q->andWhere($sql);

            $pager = new Doctrine_Pager($q, $this->page, $this->limit);

            $this->lib_materials = $pager->execute();

            $this->lastPage = $pager->getLastPage();
            
            $this->materialsShowed = $pager->getResultsInPage();
            
            $this->total = $pager->getNumResults();
            
            $this->indicePrimero=$pager->getFirstIndice();
            
            $this->indiceUltimo=$pager->getLastIndice();
        }
    }

}

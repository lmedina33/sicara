
<?php $root = new pmSuperfishMenu() ?>
<?php $root->setSuperfishJS('
    $(document).ready(function(){
        $("ul.sf-menu").superfish({ 
            animation: {height:"show"},
            delay:     300
        });

        $("ul.sf-menu").addClass("sf-vertical");
        $("ul.sf-menu").addClass("sf-js-enabled");
        $("ul.sf-menu").addClass("sf-shadow");
        
        });') ?>
<?php

$root->setRoot();

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Inicio")->setUrl("home/index");
$root->addChild("inicio", $menu_item);


//ADMIN: Usuario
$menu = new pmSuperfishMenu();
$menu->setName("Usuarios")->setCredentials(array("admin"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Usuarios")->setUrl("sf_guard_user/index");
$menu->addChild("Usuarios_Usuarios", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Permisos")->setUrl("sf_guard_permission/index");
$menu->addChild("Usuarios_Permisos", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Grupos")->setUrl("sf_guard_group/index");
$menu->addChild("Usuarios_Grupos", $menu_item);

$root->addChild("Usuarios", $menu);



//ESTUDIANTES

$menu = new pmSuperfishMenu();
$menu->setName("Estudiantes")->setCredentials(array("admin"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("estudiante/index");
$menu->addChild("Estudiantes_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Informes")->setUrl("estudiante/generarInformes");
$menu->addChild("Estudiantes_Informes", $menu_item);

$root->addChild("Estudiantes",$menu);

//ADMISIONES: Inscrito

$menu = new pmSuperfishMenu();
$menu->setName("Inscritos")->setCredentials(array("admisiones"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("inscrito/index");
$menu->addChild("Inscritos_Lista", $menu_item);

//$menu_item = new pmSuperfishMenuItem();
//$menu_item->setName("Registrar")->setUrl("inscrito/new");
//$menu->addChild("Inscritos_Registrar", $menu_item);

$root->addChild("Inscritos",$menu);

//ADMISIONES: Formulario Inscripcion

$menu = new pmSuperfishMenu();
$menu->setName("Formularios de Inscripción")->setCredentials(array("admisiones"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("formularioInscripcion/index");
$menu->addChild("FormularioInscripcion_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar")->setUrl("formularioInscripcion/new");
$menu->addChild("FormularioInscripcion_Registrar", $menu_item);

$root->addChild("FormularioInscripcion",$menu);


//HOMOLOGACIONES
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Homologaciones")->setUrl("homologacion/index")->setCredentials('homologacion');

$root->addChild("Homologacion",$menu_item);

//GRUPOS DE ESTUDIANTES
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Grupos")->setUrl("grupo/index")->setCredentials('grupos');

$root->addChild("Grupos",$menu_item);

//BIBLIOTECA:
//Material:
$menu = new pmSuperfishMenu();
$menu->setName("Material Bibliográfico")->setCredentials(array("libMaterial"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar Material")->setUrl("libMaterial/index")->setCredentials('libMaterial_listar');
$menu->addChild("LibMaterial_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar Material")->setUrl("libMaterial/new")->setCredentials('libMaterial_new');
$menu->addChild("LibMaterial_Registrar", $menu_item);

//Categoria:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Administrar Categorías")->setUrl("libCategoria/index")->setCredentials('libCategoria');
$menu->addChild("LibCategoria_Lista", $menu_item);

//Tipo Material:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Administrar Tipos de Material")->setUrl("libTipoMaterial/index")->setCredentials('libTipoMaterial');
$menu->addChild("LibTipoMaterial_Lista", $menu_item);

$root->addChild("LibMaterial",$menu);

//Buscar Material:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Buscar Material Bibliográfico")->setUrl("libMaterial/buscar")->setCredentials(array('libMaterial_buscar'));
$root->addChild("LibCategoria_Buscar_Bibliotecario", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Buscar Material Bibliográfico")->setUrl("libMaterial/buscar")->setCredentials(array('libMaterial_buscar_es'));
$root->addChild("LibCategoria_Buscar_Estudiante", $menu_item);

//RECURSOS FISICOS

$menu = new pmSuperfishMenu();
$menu->setName("Recursos Físicos")->setCredentials(array("refElemento"));

//Listar
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar Recursos Físicos")->setUrl("refElemento/index")->setCredentials(array('refElemento_listar'));

$menu->addChild("RefElemento_Listar", $menu_item);

//Crear
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar Recurso Físico")->setUrl("refElemento/new")->setCredentials(array('refElemento_new'));

$menu->addChild("RefElemento_Nuevo", $menu_item);

$root->addChild("RecursosFisicos", $menu);

//Lugares
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Gestión de Lugares")->setUrl("refLugar/index")->setCredentials(array('refLugar'));


$root->addChild("Lugares", $menu_item);


//CURSOS EMPRESARIALES

//Listar
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Cursos Empresariales")->setUrl("curCurso/index")->setCredentials(array('curCurso'));


$root->addChild("CursosEmpresariales", $menu_item);

//RENOVAR PASS:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Cambiar Contraseña")->setUrl(url_for("home/renovarPass"));
$root->addChild("cambiar_pass", $menu_item);

//SALIR:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Salir")->setUrl(url_for("sf_guard_signout"));
$root->addChild("Salir", $menu_item);


echo $root->render();
?>


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

$root->addChild("Usuarios", $menu);



//ADMISIONES: Inscrito

$menu = new pmSuperfishMenu();
$menu->setName("Inscritos")->setCredentials(array("admisiones"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("inscrito/index");
$menu->addChild("Inscritos_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar")->setUrl("inscrito/new");
$menu->addChild("Inscritos_Registrar", $menu_item);

$root->addChild("Inscritos",$menu);

//BIBLIOTECA:
//Material:
$menu = new pmSuperfishMenu();
$menu->setName("Administrar Material")->setCredentials(array("bibliotecario"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar Material")->setUrl("libMaterial/index");
$menu->addChild("LibMaterial_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar Material")->setUrl("libMaterial/new");
$menu->addChild("LibMaterial_Registrar", $menu_item);

//Categoria:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Administrar Categorías")->setUrl("libCategoria/index");
$menu->addChild("LibCategoria_Lista", $menu_item);

//Tipo Material:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Administrar Tipos de Material")->setUrl("libTipoMaterial/index");
$menu->addChild("LibTipoMaterial_Lista", $menu_item);

$root->addChild("LibMaterial",$menu);

//Buscar Material:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Buscar Material Bibliográfico")->setUrl("libMaterial/buscar")->setCredentials(array('bibliotecario'));
$root->addChild("LibCategoria_Buscar_Bibliotecario", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Buscar Material Bibliográfico")->setUrl("libMaterial/buscar")->setCredentials(array('estudiante'));
$root->addChild("LibCategoria_Buscar_Estudiante", $menu_item);

//SALIR:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Salir")->setUrl(url_for("sf_guard_signout"));
$root->addChild("Salir", $menu_item);


echo $root->render();
?>

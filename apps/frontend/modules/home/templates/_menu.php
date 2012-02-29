
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
$menu->setName("Material")->setCredentials(array("bibliotecario"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("libMaterial/index");
$menu->addChild("LibMaterial_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar")->setUrl("libMaterial/new");
$menu->addChild("LibMaterial_Registrar", $menu_item);

$root->addChild("LibMaterial",$menu);

//Tipo Material:
$sub_menu = new pmSuperfishMenu();
$sub_menu->setName("Tipo de Material")->setCredentials(array("bibliotecario"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("libTipoMaterial/index");
$sub_menu->addChild("LibTipoMaterial_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar")->setUrl("libTipoMaterial/new");
$sub_menu->addChild("LibTipoMaterial_Registrar", $menu_item);

$menu->addChild("LibTipoMaterial",$sub_menu);


//Categoria:
$menu = new pmSuperfishMenu();
$menu->setName("Categoria")->setCredentials(array("bibliotecario"));

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Listar")->setUrl("libCategoria/index");
$menu->addChild("LibCategoria_Lista", $menu_item);

$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Registrar")->setUrl("libCategoria/new");
$menu->addChild("LibCategoria_Registrar", $menu_item);

$root->addChild("LibCategoria",$menu);


//SALIR:
$menu_item = new pmSuperfishMenuItem();
$menu_item->setName("Salir")->setUrl(url_for("sf_guard_signout"));
$root->addChild("Salir", $menu_item);


echo $root->render();
?>

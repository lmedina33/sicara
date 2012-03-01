<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php use_helper("DataFormat") ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php //include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>

        <script>
            var tMes;
            var tErr;
            var tWar;
            var tNot;
            
            $(function() {
                $('.flash_message').show( "slide", { direction: "up" } ,2000, callbackMes  );
                $('.flash_error').show( "slide", { direction: "up" } ,2000, callbackErr  );
                $('.flash_warning').show( "slide", { direction: "up" } ,2000, callbackWar  );
                $('.flash_notice').show( "slide", { direction: "up" } ,2000, callbackNot  );
                
                $('div.tip[title]').qtip({
                    style: {
                        name: 'cream',
                        tip: false
                    },
                    position: {
                        corner: {
                            target: 'topRight',
                            tooltip: 'leftBottom'
                        }
                    }
                })
            });
            
            function callbackMes(){
                tMes=setTimeout(function() {
                    $('.flash_error').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            function callbackErr(){
                tErr=setTimeout(function() {
                    $('.flash_error').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            function callbackWar(){
                tWar=setTimeout(function() {
                    $('.flash_error').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            function callbackNot(){
                tNot=setTimeout(function() {
                    $('.flash_error').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            
            function closeMessage(){
                clearTimeout(tMes);
                $('.flash_message').hide( "slide", { direction: "up" } ,2000 );
            }
            
            function closeError(){
                clearTimeout(tErr);
                $('.flash_error').hide( "slide", { direction: "up" } ,2000 );
            }
            
            function closeWarning(){
                clearTimeout(tWar);
                $('.flash_warning').hide( "slide", { direction: "up" } ,2000 );
            }
            
            function closeNotice(){
                clearTimeout(tNot);
                $('.flash_notice').hide( "slide", { direction: "up" } ,2000 );
            }    
        </script>

        <title>
            <?php if (!include_slot('title')) { ?>
                SiCaRa
            <?php } ?>
        </title>
    </head>
    <body>
        <div class="super-head">
            <a href="http://www.escuelaaeronautica.edu.co" target="_blank">Página Principal</a>
            <a href="http://www.aerocivil.gov.co" target="_blank">Aeronáutica Civil</a>
            <a href="http://code.google.com/p/sicara/" target="_blank">Acerca de SiCaRa</a>
            <p>
                SiCaRa - Versión 2.0
            </p>
        </div>
        <div class="head">
            <img src="/images/logoEacSmall.png" /> 
            <h1>ESCUELA AERONÁUTICA DE COLOMBIA
                <br/>
                SiCaRa: Sistema para la gestión de calificaciones</h1>
        </div>
        <div class="top">
            <div class="user">
                <?php if ($sf_user->isAuthenticated()) { ?>
                    Usted se ha autenticado como <?php
                echo Doctrine_Core::getTable("Usuario")->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();
                    ?>.
                <?php } ?>
            </div>
            <div class="date">
                <?php echo getMyDate("Hoy es %D% %d% de %M% de %a%") ?>
            </div>
        </div>

        <?php
        if ($sf_user->isAuthenticated()) {
            ?>
            <div class="left">
                <?php
                include_partial('home/menu');
                ?>
            </div>
        <?php } ?>

        <div class="flash">

            <?php if ($sf_user->hasFlash('message')): ?>
                <div class="flash_message">
                    <a href="javascript:closeMessage()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/message.png" />
                    <strong>Mensaje:</strong>
                    <?php echo $sf_user->getFlash('message') ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('notice')): ?>
                <div class="flash_notice">
                    <a href="javascript:closeNotice()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/ok.png" />
                    <strong>Confirmación</strong>
                    <?php echo $sf_user->getFlash('notice') ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('warning')): ?>
                <div class="flash_warning">
                    <a href="javascript:closeWarning()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/warning.png" />
                    <strong>Advertencia</strong>
                    <?php echo $sf_user->getFlash('warning') ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('error')): ?>
                <div class="flash_error">
                    <a href="javascript:closeError()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/error.png" />
                    <strong>Error</strong>
                    <?php echo $sf_user->getFlash('error') ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="content">
            <?php echo $sf_content ?>
        </div>
        <br />
    </body>
</html>

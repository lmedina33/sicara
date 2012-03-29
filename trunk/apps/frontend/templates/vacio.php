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
                $('a.button').button();
                
                $('.flash_message').show( "slide", { direction: "up" } ,2000, callbackMes  );
                $('.flash_error').show( "slide", { direction: "up" } ,2000, callbackErr  );
                $('.flash_warning').show( "slide", { direction: "up" } ,2000, callbackWar  );
                $('.flash_notice').show( "slide", { direction: "up" } ,2000, callbackNot  );
                
                $('.tip[title]').qtip({
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
                    $('.flash_message').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            function callbackErr(){
                tErr=setTimeout(function() {
                    $('.flash_error').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            function callbackWar(){
                tWar=setTimeout(function() {
                    $('.flash_warning').hide( "slide", { direction: "up" } ,2000 );
                }, 5000 );
            }
            function callbackNot(){
                tNot=setTimeout(function() {
                    $('.flash_notice').hide( "slide", { direction: "up" } ,2000 );
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
            <?php if (get_slot('title')=="") { ?>
                SiCaRa
            <?php }else{ ?>
                SiCaRa: <?php echo get_slot('title'); ?>
            <?php } ?>
        </title>
    </head>
    <body>

        <div class="flash">

            <?php if ($sf_user->hasFlash('message')): ?>
                <div class="flash_message" style="margin-left: 20px;">
                    <a href="javascript:closeMessage()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/message.png" />
                    <strong>Mensaje:</strong>
                    <?php echo $sf_user->getFlash('message') ?>
                </div>
            <?php endif; ?>
            
            <?php if ($sf_user->hasAttribute('message')): ?>
                <div class="flash_message" style="margin-left: 20px;">
                    <a href="javascript:closeMessage()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/message.png" />
                    <strong>Mensaje:</strong>
                    <?php
                    echo $sf_user->getAttribute('message');
                    $sf_user->getAttributeHolder()->remove('message');
                     ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('notice')): ?>
                <div class="flash_notice" style="margin-left: 20px;">
                    <a href="javascript:closeNotice()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/ok.png" />
                    <strong>Confirmación</strong>
                    <?php echo $sf_user->getFlash('notice') ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasAttribute('notice')): ?>
                <div class="flash_notice" style="margin-left: 20px;">
                    <a href="javascript:closeNotice()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/ok.png" />
                    <strong>Confirmación</strong>
                    <?php
                    echo $sf_user->getAttribute('notice');
                    $sf_user->getAttributeHolder()->remove('notice');
                    ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('warning')): ?>
                <div class="flash_warning" style="margin-left: 20px;">
                    <a href="javascript:closeWarning()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/warning.png" />
                    <strong>Advertencia</strong>
                    <?php echo $sf_user->getFlash('warning') ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasAttribute('warning')): ?>
                <div class="flash_warning" style="margin-left: 20px;">
                    <a href="javascript:closeWarning()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/warning.png" />
                    <strong>Advertencia</strong>
                    <?php 
                    echo $sf_user->getAttribute('warning');
                    $sf_user->getAttributeHolder()->remove('warning');
                    ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('error')): ?>
                <div class="flash_error" style="margin-left: 20px;">
                    <a href="javascript:closeError()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/error.png" />
                    <strong>Error</strong>
                    <?php echo $sf_user->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <?php if ($sf_user->hasAttribute('error')): ?>
                <div class="flash_error" style="margin-left: 20px;">
                    <a href="javascript:closeError()"><span class="ui-icon ui-icon-circle-close" style="float: right; margin-right: 15px"></span></a>
                    <img src="/images/iconos/error.png" />
                    <strong>Error</strong>
                    <?php
                    echo $sf_user->getAttribute('error');
                    $sf_user->getAttributeHolder()->remove('error');
                    ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="content" style="padding-left: 30px;">
            <?php echo $sf_content ?>
        </div>
        <br />
    </body>
</html>

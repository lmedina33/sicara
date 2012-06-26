<?php
slot('title', 'Ver Material Bibliográfico')
?>
<script>
    
    <?php if($sf_user->hasCredential('recursosFisicos')){ ?>
    jQuery(document).ready(function(){
        $( "#addFoto" ).dialog({
            modal: true,
            autoOpen: false,
            width: 450
        });
        
        jQuery("#form").validationEngine();
        
        $('#ref_foto_elemento_file').attr('accept','image/*');
    });
    
    function administrarShow(){
        $('.administracion').show('normal');
        //        $('.administracion').css('display', 'inline');
        $('#botonAdmin').attr('href', 'javascript:administrarHide()');
        $('#botonAdmin span').html('Desactivar Administración');
    }
    
    function administrarHide(){
        $('.administracion').hide('normal');
        //        $('.administracion').css('display', 'none');
        $('#botonAdmin').attr('href', 'javascript:administrarShow()');
        $('#botonAdmin span').html('Activar Administración');
    }
    
    function deleteFoto(){
        return confirm('Esta seguro de querer eliminar esta foto?\n\nEste proceso es irreversible.');
    }
    <?php } ?>
</script>

<h1>Ver Recurso Físico</h1>
<?php if ($isSearch != "1") { ?>
    <a href="<?php echo url_for('refElemento/index') ?>" class="button back">Volver</a>
<?php } ?>

<?php if ($sf_user->hasCredential('bibliotecario')) { ?>
    <a id="botonAdmin" href="javascript:administrarShow()" class="button tool">Activar Administración</a>
<?php } ?>
<br />
<br />
<table class="ver" style="float:left">
    <tbody>
        <tr>
            <th><label>Serial:</label></th>
            <td><?php echo $elemento->getSerial() ?></td>
        </tr>
        <tr>
            <th><label>Serial Interno:</label></th>
            <td><?php echo $elemento->getSerialInterno() ?></td>
        </tr>
        <tr>
            <th><label>Nombre:</label></th>
            <td><?php echo $elemento->getNombre() ?></td>
        </tr>
        <tr>
            <th><label>Marca:</label></th>
            <td>
                <?php echo $elemento->getMarca() ?>
            </td>
        </tr>
        <tr>
            <th><label>Modelo:</label></th>
            <td>
                <?php echo $elemento->getModelo() ?>
            </td>
        </tr>
        <tr>
            <th><label>Descripción:</label></th>
            <td><?php echo str_replace("\n", "<br />", $elemento->getDescripcion()) ?></td>
        </tr>
        <tr>
            <th><label>Ubicación:</label></th>
            <td>
                <?php echo str_replace("\n", "<br />", $elemento->getUbicacion()) ?>
            </td>
        </tr>
        <tr>
            <th><label>Tipo de Elemento:</label></th>
            <td>
                <?php echo $elemento->getRefTipoElemento() ?>
            </td>
        </tr>
        <tr>
            <th><label>Lugar:</label></th>
            <td>
                <?php echo $elemento->getRefLugar()->getPath() ?>
            </td>
        </tr>
        <tr>
            <th><label>Estado:</label></th>
            <td>
                <?php echo $elemento->getRefEstadoElemento() ?>
            </td>
        </tr>
        <tr>
            <th><label>Prestable:</label></th>
            <td>
                <?php echo ($elemento->getIsPrestable()=="1") ? "Si":"No" ?>
            </td>
        </tr>
        <?php if($elemento->getIsPrestable()=="1" && $elemento->getIdRefTipoSancion()!=null){ ?>
        <tr>
            <th><label>Tipo de Sanción:</label></th>
            <td>
                <?php echo $elemento->getRefTipoSancion() ?>
            </td>
        </tr>
        <tr>
            <th><label>Cantidad de Sanción:</label></th>
            <td><?php echo $elemento->getCantidadSancion() ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th><label>Responsable:</label></th>
            <td>
                <?php echo $elemento->getUsuarioResponsable() ?>
            </td>
        </tr>
    </tbody>
</table>
<?php if($id_foto!=""){ ?>
<div style="float:left; margin-left: 20px; border: 1px dashed #ccc; padding: 5px;">
    <a href="#" onClick="window.open('<?php echo url_for('refElemento/showFoto?id='.$id_foto) ?>','Foto de recurso','toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1,width=700,height=600')"><img src="<?php echo url_for('refElemento/renderFoto?id='.$id_foto) ?>" width="256px" height="192px"/>
</div>
<div class="administracion" style="position: relative; top:-8px"><a onClick="javascript: return deleteFoto()" href="<?php echo url_for('refElemento/removeFoto?idEle='.$elemento->getIdRefElemento().'&id=').$id_foto ?>"><img src="/images/iconos/removeSmall.png" /></a></div>
<?php }else{ ?>
<div style="float:left; margin-left: 20px; border: 1px dashed #ccc; padding: 5px; width:256px; height:192px; color: #ccc;" >
    <small>No hay foto disponible</small>
</div>
<div class="administracion" style="position: relative; top:-8px"><a href="#" onClick="javascript: $( '#addFoto' ).dialog('open');"><img src="/images/iconos/addSmall.png" /></a></div>
<div id="addFoto" title="Cargar Foto...">
    <form id="form" action="<?php echo url_for('refElemento/addFoto?idEle='.$elemento->getIdRefElemento()) ?>" method="post" <?php $formFoto->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <table width="100%">
            <tfoot>
            <tr>
                <td></td>
                <td>
                <?php echo $formFoto->renderHiddenFields(false) ?>
                <input type="submit" value="Guardar" />
                </td>
            </tr>
            </tfoot>
            <tbody>
            <?php echo $formFoto->renderGlobalErrors() ?>
            <tr id="new_foto">
                <th>
                    <div class="tip" title="Esta debe ser una fotografía del elemento a registrar que <b>no ocupe más de 1.5 Mb</b>.<br />Solo puede existir <b>una imágen por elemento</b>."></div>
                    <?php echo $formFoto['file']->renderError() ?>
                    <?php echo $formFoto['file']->renderLabel() ?>
                </th>
                <td>
                <?php echo $formFoto['file'] ?>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<?php } ?>
<br />
<div class="administracion" style="clear: both">
    <br />
    <a class="button edit" href="<?php echo url_for('refElemento/edit?id_ref_elemento=' . $elemento->getIdRefElemento()) ?>">Editar Recurso</a>
</div>
<br />
<br />
<?php
slot('title', 'Ver Material Bibliográfico')
?>
<script>
    
    $(function() {
        
        jQuery("#formItem").validationEngine();
        
        var i=0;
        if($('.ver tbody tr td ul.verMasAutores li').length>1){
        
            $('.ver tbody tr td ul.verMasAutores li').each(function(){
                if(i!=0)
                    $(this).css('display', 'none');
                i++;
            });
        }else{
            $('#verAutores').css('display', 'none');
        }
        
        i=0;
        
        if($('.ver tbody tr td ul.verMasDescripciones li').length>1){
        
            $('.ver tbody tr td ul.verMasDescripciones li').each(function(){
                if(i!=0)
                    $(this).css('display', 'none');
                i++;
            });
        }else{
            $('#verDescripciones').css('display', 'none');
        }
        
        i=0;
        
        if($('.ver tbody tr td ul.verMasTemas li').length>1){
        
            $('.ver tbody tr td ul.verMasTemas li').each(function(){
                if(i!=0)
                    $(this).css('display', 'none');
                i++;
            });
        }else{
            $('#verTemas').css('display', 'none');
        }
    });
    
    function verMasAutores(){
        var i=0;
        $('.ver tbody tr td ul.verMasAutores li').each(function(){
            if(i!=0)
                $(this).show('normal');
            i++;
        });
        
        $('#verAutores').attr('href','javascript:verMenosAutores()');
        $('#verAutores img').attr('src','/images/iconos/seeMinus.png');
    }
    
    function verMenosAutores(){
        var i=0;
        $('.ver tbody tr td ul.verMasAutores li').each(function(){
            if(i!=0)
                $(this).hide('normal');
            i++;
        });
        
        
        $('#verAutores').attr('href','javascript:verMasAutores()');
        $('#verAutores img').attr('src','/images/iconos/seePlus.png');
    }
    
    function verMasDescripciones(){
        var i=0;
        $('.ver tbody tr td ul.verMasDescripciones li').each(function(){
            if(i!=0)
                $(this).show('normal');
            i++;
        });
        
        $('#verDescripciones').attr('href','javascript:verMenosDescripciones()');
        $('#verDescripciones img').attr('src','/images/iconos/seeMinus.png');
    }
    
    function verMenosDescripciones(){
        var i=0;
        $('.ver tbody tr td ul.verMasDescripciones li').each(function(){
            if(i!=0)
                $(this).hide('normal');
            i++;
        });
        
        
        $('#verDescripciones').attr('href','javascript:verMasDescripciones()');
        $('#verDescripciones img').attr('src','/images/iconos/seePlus.png');
    }
    
    function verMasTemas(){
        var i=0;
        $('.ver tbody tr td ul.verMasTemas li').each(function(){
            if(i!=0)
                $(this).show('normal');
            i++;
        });
        
        $('#verTemas').attr('href','javascript:verMenosTemas()');
        $('#verTemas img').attr('src','/images/iconos/seeMinus.png');
    }
    
    function verMenosTemas(){
        var i=0;
        $('.ver tbody tr td ul.verMasTemas li').each(function(){
            if(i!=0)
                $(this).hide('normal');
            i++;
        });
        
        $('#verTemas').attr('href','javascript:verMasTemas()');
        $('#verTemas img').attr('src','/images/iconos/seePlus.png');
    }
    
    function detallarShow(){
        $('.detalle').show('normal');
        //        $('.detalle').css('display', 'inline');
        $('#botonDet').attr('href', 'javascript:detallarHide()');
        $('#botonDet span').html('Ocultar Detalles del Material');
    }
    
    function detallarHide(){
        $('.detalle').hide('normal');
        //        $('.detalle').css('display', 'none');
        $('#botonDet').attr('href', 'javascript:detallarShow()');
        $('#botonDet span').html('Ver Detalles del Material');
    }
</script>

<h1>
    Editar Copia de Material Bibliográfico
    <br />
    <small>[<?php echo $material->getCodigoLibMaterial() ?>]</small> <?php echo $material->getTitulo() ?>
</h1>
<a href="<?php echo url_for('libMaterial/ver?codigo_lib_material=' . $material->getCodigoLibMaterial()) ?>" class="button back">Volver</a>
<br />
<br />
<form id="formItem" action="<?php echo url_for('libMaterial/updateItem?serial_lib_item=' . $formItem->getObject()->getSerialLibItem()) ?>" method="post" <?php $formItem->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <table width="100%">
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <?php echo $formItem->renderHiddenFields(false) ?>
                    <br />
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $formItem->renderGlobalErrors() ?>
            <tr>
                <th>
        <div class="tip" title="<?php echo ($formItem->getObject()->isNew() ? 'Este serial debe ser un identificador <b>único</b> en el sistema y <b>no podrá ser modificado</b>.' : 'Este serial es un identificador <b>único</b> en el sistema y por tanto <b>no puede ser editado</b>.') ?>"></div>
        <?php echo $formItem['serial_lib_item']->renderLabel() ?>
        <?php echo $formItem['serial_lib_item']->renderError() ?>
        </th>
        <td>
            <?php echo $formItem['serial_lib_item'] ?>
        </td>
        </tr>
        <tr>
            <th>
                <?php echo $formItem['descripcion']->renderLabel() ?>
                <?php echo $formItem['descripcion']->renderError() ?>
            </th>
            <td>
                <?php echo $formItem['descripcion'] ?>
            </td>
        </tr>
        <tr>
            <th>
        <div class="tip" title="Esta es la fecha donde esta copia fué <b>creada</b> o recibió su <b>última actualización</b>."></div>
        <?php echo $formItem['fecha_actualizacion']->renderLabel() ?>
        <?php echo $formItem['fecha_actualizacion']->renderError() ?>
        </th>
        <td>
            <?php echo $formItem['fecha_actualizacion'] ?>
        </td>
        </tr>
        <tr>
            <th>
                <?php echo $formItem['id_lib_estado']->renderLabel() ?>
                <?php echo $formItem['id_lib_estado']->renderError() ?>
            </th>
            <td>
                <?php echo $formItem['id_lib_estado'] ?>
            </td>
        </tr>
        </tbody>
    </table>
</form>
<br />
<a id="botonDet" href="javascript:detallarShow()" class="button detail">Ver Detalles del Material</a>
<div class="detalle">
    <h2>Material Bibliográfico</h2>
    <table class="ver">
        <tbody>
            <tr>
                <th><label>Código:</label></th>
                <td><?php echo $material->getCodigoLibMaterial() ?></td>
            </tr>
            <tr>
                <th><label>Título:</label></th>
                <td><?php echo $material->getTitulo() ?></td>
            </tr>
            <tr>
                <th><label>Subtítulo:</label></th>
                <td><?php echo $material->getSubTitulo() ?></td>
            </tr>
            <tr>
                <th><label>Autores:</label></th>
                <td>
                    <?php echo html_entity_decode($autores) ?>
                    <a id="verAutores" class="tip" title="Ver +/- Autores" href="javascript:verMasAutores()" style="float: right"><img src="/images/iconos/seePlus.png" /></a>
                </td>
            </tr>
            <tr>
                <th><label>Editorial:</label></th>
                <td>
                    <?php echo $material->getEditorial() ?>
                </td>
            </tr>
            <tr>
                <th><label>Categoría:</label></th>
                <td><?php echo $material->getLibCategoria() ?></td>
            </tr>
            <tr>
                <th><label>Tipo de Material:</label></th>
                <td><?php echo $material->getLibTipoMaterial() ?></td>
            </tr>
            <tr>
                <th><label>Descripción:</label></th>
                <td>
                    <?php echo html_entity_decode($descripciones) ?>
                    <a id="verDescripciones" class="tip" title="Ver +/- Descripciones" href="javascript:verMasDescripciones()" style="float: right"><img src="/images/iconos/seePlus.png" /></a>
                </td>
            </tr>
            <tr>
                <th><label>Temas:</label></th>
                <td>
                    <?php echo html_entity_decode($temas) ?>
                    <a id="verTemas" class="tip" title="Ver +/- Temas" href="javascript:verMasTemas()" style="float: right"><img src="/images/iconos/seePlus.png" /></a>
                </td>
            </tr>
            <?php if ($material->getIsReferencia() == 1) { ?>
                <tr>
                    <th colspan="2"><label>Material solo de referencia</label></th>
                </tr>
            <?php } ?>
            <?php if ($material->getIsSoloProfesor() == 1) { ?>
                <tr>
                    <th colspan="2"><label>Material solo para profesores</label></th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br />
    <?php
    if (count($material->getLibItem()) == 0) {
        ?>
        <br />
        <br />
        <div class="warningInfo">No hay copias disponibles</div>
        <?php
    } else {
        ?>
        <h2>Copias de este Material</h2>
        <table class="verHorizontal">
            <tbody>
                <tr>
                    <th>Serial</th>
                    <th>Descripción</th>
                    <th>Fecha de Actualización</th>
                    <th>Estado</th>
                </tr>
                <?php foreach ($material->getLibItem() as $item): ?>
                    <tr>
                        <td>
                            <?php echo $item->getSerialLibItem() ?>
                        </td>
                        <td>
                            <?php echo $item->getDescripcion() ?>
                        </td>
                        <td>
                            <?php echo $item->getFechaActualizacion() ?>
                        </td>
                        <td>
                            <?php echo $item->getLibEstado() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
    <br />
    <br />
</div>
<br />
<br />

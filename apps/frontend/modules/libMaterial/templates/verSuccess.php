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
</script>

<h1>Ver Material Bibliográfico</h1>
<a href="<?php echo url_for('libMaterial/index') ?>" class="button back">Volver</a>
<a id="botonAdmin" href="javascript:administrarShow()" class="button tool"></img>Activar Administración</a>
<br />
<br />
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
        <?php if($material->getIsReferencia()==1){ ?>
        <tr>
            <th colspan="2"><label>Material solo de referencia</label></th>
        </tr>
        <?php } ?>
        <?php if($material->getIsSoloProfesor()==1){ ?>
        <tr>
            <th colspan="2"><label>Material solo para profesores</label></th>
        </tr>
        <?php } ?>
    </tbody>
</table>
<br />
<div class="administracion ">
    <a class="button edit" href="<?php echo url_for('libMaterial/edit?codigo_lib_material=' . $material->getCodigoLibMaterial()) ?>">Editar Material</a>
    <?php
    if (count($material->getLibItem()) == 0) {
        ?>
    <?php echo link_to('Eliminar Material',url_for('libMaterial/delete?codigo_lib_material=' . $material->getCodigoLibMaterial()),array('class'=>'button delete','confirm'=>'Esta seguro de querer eliminar el siguiente material?\n\n ['.$material->getCodigoLibMaterial().'] '.$material->getTitulo().'\n\nEste proceso es irreversible.','method' => 'delete')) ?>
    </div>
    <br />
    <br />
    <div class="warningInfo">No hay copias disponibles</div>
    <br />
    <br />
    <?php
} else {
    ?>
    </div>
    <h2>Copias de este Material</h2>
    <table class="verHorizontal">
        <tbody>
            <tr>
                <th>Serial</th>
                <th>Descripción</th>
                <th>Fecha de Actualización</th>
                <th>Estado</th>
                <th class="administracion"></th>
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
                    <td class="administracion">
                        <a class="administracion tip" title="Editar Copia <?php echo $item->getSerialLibItem() ?>" href="<?php echo url_for('libMaterial/editItem?serial_lib_item=' . $item->getSerialLibItem()) ?>"><img src="/images/iconos/editSmall.png"></img></a>
                        <?php echo link_to('<img src="/images/iconos/removeSmall.png"></img>',url_for('libMaterial/deleteItem?serial_lib_item=' . $item->getSerialLibItem()),array('title'=>'Eliminar Copia '. $item->getSerialLibItem(),'class'=>'tip','confirm'=>'Esta seguro de querer eliminar la siguiente copia?\n\n '.$item->getSerialLibItem().'\n\nEste proceso es irreversible.','method' => 'delete')) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>
<br />
<div class="administracion">
<a class="button add" href="<?php echo url_for('libMaterial/addItem?codigo_lib_material=' . $material->getCodigoLibMaterial()) ?>">Agregar Copia</a>
</div>
<br />
<br />

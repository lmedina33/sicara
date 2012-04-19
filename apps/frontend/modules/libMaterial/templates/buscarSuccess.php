<?php
slot('title', 'Buscar Material Bibliográfico')
?>
<script>
    $(function() {
        jQuery("#form").validationEngine();
    });
    
    function administrarShow(){
        $('.administracion').show('normal');
        
        $('#filtrarTipo').attr('onClick', 'javascript:administrarHide()');
        $('#filtrarTipo').attr('src', '/images/iconos/types.png');
    }
    
    function administrarHide(){
        $('.administracion').hide('normal');
        
        $('#filtrarTipo').attr('onClick', 'javascript:administrarShow()');
        $('#filtrarTipo').attr('src', '/images/iconos/typesGray.png');
        
        $('.tipo_material').attr('checked', 'checked');
    }
    
    function verMasTemas(id){
        $('#verTemas_'+id+' img').attr('src','/images/iconos/seeMinus.png');
        $('#verTemas_'+id).attr('href','javascript:verMenosTemas("'+id+'")');
        $('#temas_'+id+' div').each(function(){
            $(this).css('display','inline');
        });
    }
    
    function verMenosTemas(id){
        $('#verTemas_'+id+' img').attr('src','/images/iconos/seePlus.png');
        $('#verTemas_'+id).attr('href','javascript:verMasTemas("'+id+'")');
        $('#temas_'+id+' div').each(function(){
            $(this).css('display','none');
        });
    }
</script>
<h1>Buscar Material Bibliográfico</h1>
<form id="form" action="<?php echo url_for('libMaterial/buscar') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <table width="100%">
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <br />
                    <input type="submit" value="Buscar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th style="width: 200px">
        <div class="tip" title="Utilice una o varias palabras de búsqueda, separadas por espacios.<br /><b>Evite</b> el uso de palabras como <i>La, El, Los, Y, O.</i><br /><br />Ej. <i>calculo matemáticas ecuaciones</i>"></div>
        <?php echo $form['filtro']->renderLabel() ?>
        <?php echo $form['filtro']->renderError() ?>
        </th>
        <td>
            <?php echo $form['filtro'] ?>
        </td>
        </tr>
        <tr>
            <th style="width: 200px">
                <?php echo $form['tipo_filtro']->renderLabel() ?>
                <?php echo $form['tipo_filtro']->renderError() ?>
            </th>
            <td>
                <?php echo $form['tipo_filtro'] ?>
            </td>
        </tr>
        <tr class="administracion">
            <th style="width: 200px">
                <?php echo $form['tipo_material']->renderLabel() ?>
                <?php echo $form['tipo_material']->renderError() ?>
            </th>
            <td>
                <?php echo $form['tipo_material'] ?>
            </td>
        </tr>
        <tr>
            <th style="width: 200px">
                <img id="filtrarTipo" onClick="javascript:administrarShow()" class="tip" title="Activar/Desactivar filtro por tipo de material" src="/images/iconos/typesGray.png"></img>
            </th>
            <td>
            </td>
        </tr>
        </tbody>
    </table>
</form>
<?php
if ($lib_materials != null) {
    ?>
    <h2>Resultados de la Busqueda</h2>
    <br />
    <?php
    if (count($lib_materials) == 0) {
        ?>
        <br />
        No se encontraron materiales para esta búsqueda.

        <?php
    } else {
        ?>

        <div class="pagingBar">
            <?php
            if ($page != 1) {
                ?>
                <a class="pageBack" href="<?php echo url_for('libMaterial/buscar?filtro=' . $filtro . '&parametro=' . $parametro . '&tipos=' . $sIdsTipos . '&page=' . ($page - 1) . '&limit=' . $limit) ?>">Anterior</a>
                <?php
            }
            for ($i = 1; $i <= $lastPage; $i++) {
                if ($page != $i) {
                    ?>
                    <a class="pageNum" href="<?php echo url_for('libMaterial/buscar?filtro=' . $filtro . '&parametro=' . $parametro . '&tipos=' . $sIdsTipos . '&page=' . ($i) . '&limit=' . $limit) ?>"><?php echo $i ?></a>
                    <?php
                } else {
                    ?>
                    <div class="pageActual"><?php echo $i ?></div>
                    <?php
                }
            }
            if ($page < $lastPage) {
                ?>
                <a class="pageNext" href="<?php echo url_for('libMaterial/buscar?filtro=' . $filtro . '&parametro=' . $parametro . '&tipos=' . $sIdsTipos . '&page=' . ($page + 1) . '&limit=' . $limit) ?>">Siguiente</a>
                <?php
            }
            ?>
            <div style="float:right; margin-left: 5px; color: #888;"> Mostrando <?php echo $indicePrimero ?> a <?php echo $indiceUltimo ?> elementos de <?php echo $total ?> encontrados</div>
        </div>
        <hr>
        <br />
        <div class="page">
            <?php
            foreach ($lib_materials as $material):
                ?>
                <div class="itemMaterial">
                    <div>
                        <img src="/images/iconos/listarSmall.png" onClick='javascript:newwindow=window.open("<?php echo url_for('libMaterial/ver?codigo_lib_material=' . $material->getCodigoLibMaterial() . '&search=1') ?>","VerMaterial","scrollbars=1,width=600,height=500")' /> <b>Código:</b> <?php echo $material->getCodigoLibMaterial() ?></div>
                    <div style="margin-left: 5px;"><b>Título:</b> <?php echo $material->getTitulo() ?></div>
                    <?php if ($material->getSubTitulo() != null && $material->getSubTitulo() != "") { ?>
                        <div style="margin-left: 10px;"><small><b>Sub titulo:</b> <?php echo $material->getSubTitulo() ?></small></div>
                    <?php } ?>
                    <?php
                    $autores = explode("\n", $material->getAutores());
                    if (count($autores) <= 1) {
                        ?>
                        <div style="margin-left: 5px;"><b>Autor:</b> <?php echo $autores[0] ?></div>
                        <?php
                    } else {
                        ?>
                        <div style="margin-left: 5px;"><b>Autores:</b></div>
                        <?php
                        foreach ($autores as $autor):
                            ?>
                            <div style="margin-left: 10px;"><?php echo $autor ?></div>
                            <?php
                        endforeach;
                    }
                    ?>
                    <div style="margin-left: 5px;"><b>Editorial:</b> <?php echo $material->getEditorial() ?></div>
                    <div style="margin-left: 5px;"><b>Categoría:</b> <?php echo $material->getLibCategoria() ?></div>
                    <div style="margin-left: 5px;"><b>Tipo de Material:</b>
                        <?php
                        switch ($material->getIdLibTipoMaterial()) {
                            case 1:
                                ?>
                                <img src="/images/iconos/book.png" />
                                <?php
                                break;
                            case 2:
                                ?>
                                <img src="/images/iconos/newspapper.png" />
                                <?php
                                break;
                            case 3:
                                ?>
                                <img src="/images/iconos/magazine.png" />
                                <?php
                                break;
                            case 4:
                                ?>
                                <img src="/images/iconos/map.png" />
                                <?php
                                break;
                            case 5:
                                ?>
                                <img src="/images/iconos/vhs.png" />
                                <?php
                                break;
                            case 6:
                                ?>
                                <img src="/images/iconos/cassette.png" />
                                <?php
                                break;
                            case 7:
                                ?>
                                <img src="/images/iconos/cd.png" />
                                <?php
                                break;
                            case 8:
                                ?>
                                <img src="/images/iconos/dvd.png" />
                                <?php
                                break;
                            case 9:
                                ?>
                                <img src="/images/iconos/slide.png" />
                                <?php
                                break;
                            case 10:
                                ?>
                                <img src="/images/iconos/software.png" />
                                <?php
                                break;
                            default:
                                ?>
                                <img src="/images/iconos/multimedia.png" />
                            <?php
                        }
                        ?>
                        <?php echo $material->getLibTipoMaterial() ?>
                    </div>
                    <div style="margin-left: 5px;">
                        <b>Número de Copias:</b> <?php echo count($material->getLibItem()) ?>
                    </div>
                    <div id="temas_<?php echo $material->getCodigoLibMaterial() ?>" class="temas" style="margin-left: 5px;">
                        <a id="verTemas_<?php echo $material->getCodigoLibMaterial() ?>" class="tip" title="Ver +/- Temas" href="javascript:verMasTemas('<?php echo $material->getCodigoLibMaterial() ?>')"><img src="/images/iconos/seePlus.png" /></a>
                        <br />
                        <?php
                        $temas = explode("\n", $material->getTemas());
                        if (count($temas) == 1) {
                            ?>
                            <div style="display:none"><b>Tema:</b> <?php echo $temas[0] ?></div>
                        <?php } else {
                            ?>
                            <div style="display:none">
                                <div><b>Temas:</b></div><br />
                                <?php
                                foreach ($temas as $tema) {
                                    ?>
                                    <div style="margin-left: 5px;">
                                        <?php
                                        echo $tema . "<br/>";
                                        ?>
                                    </div>
                                    <?php
                                };
                                ?>
                            </div>

                        <?php }
                        ?>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>

        <?php if ($materialsShowed > 5) { ?>
            <br />
            <div class="pagingBar">
                <?php
                if ($page != 1) {
                    ?>
                    <a class="pageBack" href="<?php echo url_for('libMaterial/buscar?filtro=' . $filtro . '&parametro=' . $parametro . '&tipos=' . $sIdsTipos . '&page=' . ($page - 1) . '&limit=' . $limit) ?>">Anterior</a>
                    <?php
                }
                for ($i = 1; $i <= $lastPage; $i++) {
                    if ($page != $i) {
                        ?>
                        <a class="pageNum" href="<?php echo url_for('libMaterial/buscar?filtro=' . $filtro . '&parametro=' . $parametro . '&tipos=' . $sIdsTipos . '&page=' . ($i) . '&limit=' . $limit) ?>"><?php echo $i ?></a>
                        <?php
                    } else {
                        ?>
                        <div class="pageActual"><?php echo $i ?></div>
                        <?php
                    }
                }
                if ($page < $lastPage) {
                    ?>
                    <a class="pageNext" href="<?php echo url_for('libMaterial/buscar?filtro=' . $filtro . '&parametro=' . $parametro . '&tipos=' . $sIdsTipos . '&page=' . ($page + 1) . '&limit=' . $limit) ?>">Siguiente</a>
                    <?php
                }
                ?>
                <div style="float:right; margin-left: 5px; color: #888;"> Mostrando <?php echo $indicePrimero ?> a <?php echo $indiceUltimo ?> elementos de <?php echo $total ?> encontrados</div>
            </div>
            <hr>
            <?php
        }
    }
}
?>

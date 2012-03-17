<?php
slot('title', 'Listar Categorías Bibliográficas')
?>
<script>
    
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
<h1>Listar Categorías Bibliográficas</h1>
<a id="botonAdmin" href="javascript:administrarShow()" class="button tool">
<!--    <img src="/images/iconos/toolSmall.png"></img>-->
    Activar Administración</a>
<br />
<br />
<table  class="verHorizontal">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Dias de Prestamo<div class="tip" title="Si es un valor de cero, significa que es un documento de <b>consulta en sala</b>."></div></th>
<th>Cantidad de Sanción</th>
<th>Tipo de Sanción</th>
<th class="administracion">
<div class="tip" title="Para poder eliminar una categoría <b>no debe existir</b> material asignada a ésta."></div>
</th>
</tr>
</thead>
<tbody>
    <?php foreach ($lib_categorias as $lib_categoria): ?>
        <tr>
            <td><?php echo $lib_categoria->getCodigoLibCategoria() ?></a></td>
            <td><?php echo $lib_categoria->getNombre() ?></td>
            <td><?php echo $lib_categoria->getDescripcion() ?></td>
            <td><?php echo $lib_categoria->getDiasPrestamo() ?></td>
            <td><?php echo $lib_categoria->getCantidadSancion() ?></td>
            <td><?php echo $lib_categoria->getLibTipoSancion() ?></td>
            <td class="administracion">
                <a class="tip" title="Editar categoría <i><?php echo $lib_categoria->getNombre() ?></i>" href="<?php echo url_for('libCategoria/edit?codigo_lib_categoria=' . $lib_categoria->getCodigoLibCategoria()) ?>"><img src="/images/iconos/editSmall.png"></img></a>
                    <?php
                    if (count($lib_categoria->getLibMaterial()) == 0) {
                        echo link_to('<img src="/images/iconos/removeSmall.png"></img>', url_for('libCategoria/delete?codigo_lib_categoria=' . $lib_categoria->getCodigoLibCategoria()), array('title' => 'Eliminar categoría <i>' . $lib_categoria->getNombre() . '</i>', 'class' => 'tip', 'confirm' => 'Esta seguro de querer eliminar este tipo de material?\n\n ' . $lib_categoria->getNombre() . '\n\nEste proceso es irreversible.', 'method' => 'delete'));
                    }
                    ?>
            </td>
        </tr>
<?php endforeach; ?>
</tbody>
</table>
<br />
<div class="administracion">
    <a class="button new" href="<?php echo url_for('libCategoria/new') ?>">Crear Nueva</a>
</div>

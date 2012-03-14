
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

<h1>Listar Tipo de Material Bibliográfico</h1>
<a id="botonAdmin" href="javascript:administrarShow()" class="button tool">
<!--    <img src="/images/iconos/toolSmall.png"></img>-->
    Activar Administración</a>
<br />
<br />
<table  class="verHorizontal">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Dias de Prestamo</th>
            <th>Cantidad sancion</th>
            <th>Id lib tipo sancion</th>
            <th class="administracion"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lib_tipo_materials as $lib_tipo_material): ?>
            <tr>
                <td><?php echo $lib_tipo_material->getNombre() ?></td>
                <td><?php echo $lib_tipo_material->getDescripcion() ?></td>
                <td><?php echo $lib_tipo_material->getDiasPrestamo() ?></td>
                <td><?php echo $lib_tipo_material->getCantidadSancion() ?></td>
                <td><?php echo $lib_tipo_material->getIdLibTipoSancion() ?></td>
                <td class="administracion">
                    <a class="administracion tip" title="Editar tipo <i><?php echo $lib_tipo_material->getNombre() ?></i>" href="<?php echo url_for('libTipoMaterial/edit?id_lib_tipo_material=' . $lib_tipo_material->getIdLibTipoMaterial()) ?>">
                        <img src="/images/iconos/editSmall.png"></img>
                    </a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br />
<div class="administracion">
    <a class="button new" href="<?php echo url_for('libTipoMaterial/new') ?>">Crear Nuevo</a>
</div>

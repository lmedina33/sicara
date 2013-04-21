<?php use_stylesheets_for_form($formUser) ?>
<?php use_javascripts_for_form($formUser) ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('input').attr('readonly','readonly');
        $('textarea').attr('readonly','readonly');
        $('select').attr('disabled','disabled');
        $('#enviar').hide();
    });
    
    function showHistorico(){
        $('#historico').show('normal');
        $('#botton_historico').attr('href', 'javascript: hideHistorico()');
        $('#botton_historico span').html('Ocultar Histórico');
    }
    
    function hideHistorico(){
        $('#historico').hide('normal');
        $('#botton_historico').attr('href', 'javascript: showHistorico()');
        $('#botton_historico span').html('Ver Histórico');
    }
</script>
<style type="text/css">
    #historico{
        display: none;
    }
    #historico table th{
        border-bottom: 1px dashed #ccc;
        border-right: 1px dashed #ccc;
        padding-left: 5px;
        padding-right: 5px;
    }

    #historico table td{
        border-bottom: 1px dashed #ccc;
        border-right: 1px dashed #ccc;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<h1>Ver Estudiante</h1>
<a href="<?php echo url_for('estudiante/index') ?>" class="button back">Volver</a>
<a href="<?php echo url_for('estudiante/edit?cod=') . $codigo ?>" class="button edit">Editar Estudiante</a>

<h2>Datos de Estudiante</h2>
<table>
    <tbody>
        <tr>
            <th><label>Pensum</label></th>
            <td>
                <input type="text" value="<?php echo $estudiante->getPensum() ?>" size="50"/>
            </td>
        </tr>
        <tr>
            <th><label>Código</label></th>
            <td>
                <input type="text" value="<?php echo $codigo ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label>Fecha de Ingreso</label>
    <div class="tip" title="Fecha de ingreso a este pensum."></div></th>
<td>
    <input type="text" value="<?php echo $estudiante->getFechaIngreso() ?>"/>
</td>
</tr>
<tr>
    <th>
        <label>Estado</label>
    </th>
    <td>
        <input type="text" value="<?php echo $estudiante->getEstadoEstudiante() ?>"/>
    </td>
</tr>
</tbody>
</table>

<h2>Datos de Matricula</h2>
<table>
    <tbody>
        <tr>
            <th><label>Pensum</label></th>
            <td>
                <input type="text" value="<?php echo $estudiante->getPensum() ?>" size="50"/>
            </td>
        </tr>
        <tr>
            <th><label>Código</label></th>
            <td>
                <input type="text" value="<?php echo $codigo ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label>Fecha de Ingreso</label>
    <div class="tip" title="Fecha de ingreso a este pensum."></div></th>
<td>
    <input type="text" value="<?php echo $estudiante->getFechaIngreso() ?>"/>
</td>
</tr>
<tr>
    <th>
        <label>Estado</label>
    </th>
    <td>
        <input type="text" value="<?php echo $estudiante->getEstadoEstudiante() ?>"/>
    </td>
</tr>
</tbody>
</table>
<br />
<a id="botton_historico" href="javascript: showHistorico()" class="button">Ver Histórico</a>
<br />
<div id="historico">
    <h2>Histórico de Matriculas</h2>
    <table>
        <tbody>
            <tr>
                <th><label>Fecha</label></th>
                <th><label>Periodo</label></th>
                <th><label>Jornada</label></th>
                <th><label>Tipo de Pago</label></th>
            </tr>
            <?php foreach ($matriculas as $matricula) { ?>
                <tr>
                    <td>
                        <?php echo $matricula->getFecha() ?>
                    </td>
                    <td>
                        <?php echo $matricula->getPeriodoAcademico() ?>
                    </td>
                    <td>
                        <?php echo $matricula->getJornada() ?>
                    </td>
                    <td>
                        <?php echo $matricula->getTipoPago() ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<h2>Datos de Usuario</h2>
<table>
    <tbody>
        <?php echo $formUser->renderGlobalErrors() ?>
        <?php if ($formUser->getObject()->getFotoPath() != "" && $formUser->getObject()->getFotoPath() != null) { ?>
            <tr>
                <th>Foto</th>
                <td>
                    <img src="<?php echo url_for('inscrito/renderFoto?id=' . $formUser->getObject()->getIdUsuario()) ?>" />
                </td>
            </tr>
        <?php } ?>
        <tr>
            <th><?php echo $formUser['primer_nombre']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['primer_nombre'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['segundo_nombre']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['segundo_nombre'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['primer_apellido']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['primer_apellido'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['segundo_apellido']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['segundo_apellido'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['documento']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['documento'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['id_tipo_documento']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['id_tipo_documento'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['lugar_expedicion']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['lugar_expedicion'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['fecha_nacimiento']->renderLabel() ?>
            </th>
            <td>
                <input type="text" value="<?php echo $formUser->getObject()->getFechaNacimiento() ?>" />
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['genero']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['genero'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['id_tipo_sangre']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['id_tipo_sangre'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono1']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['telefono1'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono2']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['telefono2'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['direccion']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['direccion'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['correo']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['correo'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['acudiente1']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['acudiente1'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono_acudiente1']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['telefono_acudiente1'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['acudiente2']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['acudiente2'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono_acudiente2']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['telefono_acudiente2'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['especificaciones_medicas']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['especificaciones_medicas'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['observaciones']->renderLabel() ?>
            </th>
            <td>
                <?php echo $formUser['observaciones'] ?>
            </td>
        </tr>
    </tbody>
</table>
<br />
<br />
<br />


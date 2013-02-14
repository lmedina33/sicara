<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('input').attr('readonly','readonly');
        $('textarea').attr('readonly','readonly');
        $('select').attr('disabled','disabled');
        $('#enviar').hide();
    });
</script>
<h1>Ver Inscrito</h1>
<a href="<?php echo url_for('inscrito/index') ?>" class="button back">Volver</a>
<a href="<?php echo url_for('inscrito/edit?id=') . $form->getObject()->getNumeroFormulario() ?>" class="button edit">Editar Inscrito</a>

<h2>Datos de Usuario</h2>
<table>
    <tbody>
        <?php echo $formUser->renderGlobalErrors() ?>
        <?php if ($formUser->getObject()->getFotoPath() != "" && $formUser->getObject()->getFotoPath() != null) { ?>
            <tr>
                <th>Foto</th>
                <td>
                    <img src="<?php echo url_for('inscrito/renderFoto?id='.$formUser->getObject()->getIdUsuario()) ?>" />
                </td>
            </tr>
        <?php } ?>
        <tr>
            <th><?php echo $formUser['primer_nombre']->renderLabel() ?>
                <?php echo $formUser['primer_nombre']->renderError() ?></th>
            <td>
                <?php echo $formUser['primer_nombre'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['segundo_nombre']->renderLabel() ?>
                <?php echo $formUser['segundo_nombre']->renderError() ?></th>
            <td>
                <?php echo $formUser['segundo_nombre'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['primer_apellido']->renderLabel() ?>
                <?php echo $formUser['primer_apellido']->renderError() ?></th>
            <td>
                <?php echo $formUser['primer_apellido'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['segundo_apellido']->renderLabel() ?>
                <?php echo $formUser['segundo_apellido']->renderError() ?></th>
            <td>
                <?php echo $formUser['segundo_apellido'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['documento']->renderLabel() ?>
                <?php echo $formUser['documento']->renderError() ?></th>
            <td>
                <?php echo $formUser['documento'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['id_tipo_documento']->renderLabel() ?>
                <?php echo $formUser['id_tipo_documento']->renderError() ?></th>
            <td>
                <?php echo $formUser['id_tipo_documento'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['lugar_expedicion']->renderLabel() ?>
                <?php echo $formUser['lugar_expedicion']->renderError() ?></th>
            <td>
                <?php echo $formUser['lugar_expedicion'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['fecha_nacimiento']->renderLabel() ?>
                <?php echo $formUser['fecha_nacimiento']->renderError() ?></th>
            <td>
                <input type="text" value="<?php echo $formUser->getObject()->getFechaNacimiento() ?>"/>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono1']->renderLabel() ?>
                <?php echo $formUser['telefono1']->renderError() ?></th>
            <td>
                <?php echo $formUser['telefono1'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono2']->renderLabel() ?>
                <?php echo $formUser['telefono2']->renderError() ?></th>
            <td>
                <?php echo $formUser['telefono2'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['direccion']->renderLabel() ?>
                <?php echo $formUser['direccion']->renderError() ?></th>
            <td>
                <?php echo $formUser['direccion'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['correo']->renderLabel() ?>
                <?php echo $formUser['correo']->renderError() ?></th>
            <td>
                <?php echo $formUser['correo'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['acudiente1']->renderLabel() ?>
                <?php echo $formUser['acudiente1']->renderError() ?></th>
            <td>
                <?php echo $formUser['acudiente1'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono_acudiente1']->renderLabel() ?>
                <?php echo $formUser['telefono_acudiente1']->renderError() ?></th>
            <td>
                <?php echo $formUser['telefono_acudiente1'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['acudiente2']->renderLabel() ?>
                <?php echo $formUser['acudiente2']->renderError() ?></th>
            <td>
                <?php echo $formUser['acudiente2'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['telefono_acudiente2']->renderLabel() ?>
                <?php echo $formUser['telefono_acudiente2']->renderError() ?></th>
            <td>
                <?php echo $formUser['telefono_acudiente2'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['especificaciones_medicas']->renderLabel() ?>
                <?php echo $formUser['especificaciones_medicas']->renderError() ?></th>
            <td>
                <?php echo $formUser['especificaciones_medicas'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $formUser['observaciones']->renderLabel() ?>
                <?php echo $formUser['observaciones']->renderError() ?></th>
            <td>
                <?php echo $formUser['observaciones'] ?>
            </td>
        </tr>
    </tbody>
</table>
<h2>Datos de Inscripción</h2>
<table>
    <tfoot>
        <tr id="enviar">
            <td></td>
            <td>
                <?php echo $form->renderHiddenFields(false) ?>
                <input type="submit" value="Guardar" />
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form->renderGlobalErrors() ?>
        <tr>
            <th><?php echo $form['numero_formulario']->renderLabel() ?></th>
            <td>
                <?php echo $form['numero_formulario']->renderError() ?>
                <?php echo $form['numero_formulario'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['id_jornada']->renderLabel() ?></th>
            <td>
                <?php echo $form['id_jornada']->renderError() ?>
                <?php echo $form['id_jornada'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['id_tipo_pago']->renderLabel() ?></th>
            <td>
                <?php echo $form['id_tipo_pago']->renderError() ?>
                <?php echo $form['id_tipo_pago'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['id_periodo']->renderLabel() ?></th>
            <td>
                <?php echo $form['id_periodo']->renderError() ?>
                <?php echo $form['id_periodo'] ?>
            </td>
        </tr>
    </tbody>
</table>
<br />
<br />
<br />


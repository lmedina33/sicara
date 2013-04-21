<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form').validationEngine();
    });
</script>
<h1>Editar Estudiante</h1>
<a href="<?php echo url_for('estudiante/ver?cod=') . $estudiante->getCodigoEstudiante() ?>" class="button back">Volver</a>

<form id="form" action="<?php echo url_for('estudiante/update?cod=' . $estudiante->getCodigoEstudiante()) ?>" method="post" <?php ($form->isMultipart() || $formUser->isMultipart()) and print 'enctype="multipart/form-data" ' ?>>
<h2>Datos de Estudiante</h2>
<table>
    <tbody>
        <tr>
            <th><label>Pensum</label></th>
            <td>
                <input type="text" value="<?php echo $estudiante->getPensum() ?>" size="50" readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <th><label>Código</label></th>
            <td>
                <input type="text" value="<?php echo $estudiante->getCodigoEstudiante() ?>" readonly="readonly" />
            </td>
        </tr>
        <tr>
            <th>
                <label>Fecha de Ingreso</label>
                <div class="tip" title="Fecha de ingreso a este pensum."></div></th>
            <td>
                <input type="text" value="<?php echo $estudiante->getFechaIngreso() ?>" readonly="readonly"/>
            </td>
        </tr>
    </tbody>
</table>
<h2>Datos de Usuario</h2>
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
                <th><?php echo $form['foto_path']->renderLabel() ?>
                    <?php echo $form['foto_path']->renderError() ?></th>
                <td>
                    <?php if ($form->getObject()->getFotoPath() != "" && $form->getObject()->getFotoPath() != null) { ?>
                        <img src="<?php echo url_for('inscrito/renderFoto?id='.$form->getObject()->getIdUsuario()) ?>" /><br />
                    <?php } ?>
                    <?php echo $form['foto_path'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['primer_nombre']->renderLabel() ?>
                    <?php echo $form['primer_nombre']->renderError() ?></th>
                <td>
                    <?php echo $form['primer_nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['segundo_nombre']->renderLabel() ?>
                    <?php echo $form['segundo_nombre']->renderError() ?></th>
                <td>
                    <?php echo $form['segundo_nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['primer_apellido']->renderLabel() ?>
                    <?php echo $form['primer_apellido']->renderError() ?></th>
                <td>
                    <?php echo $form['primer_apellido'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['segundo_apellido']->renderLabel() ?>
                    <?php echo $form['segundo_apellido']->renderError() ?></th>
                <td>
                    <?php echo $form['segundo_apellido'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['documento']->renderLabel() ?>
                    <?php echo $form['documento']->renderError() ?>
                    <div class="tip" title="Este dato se puede cambiar siempre que no exista un número de documento y tipo de documento iguales."></div>
                </th>
                <td>
                    <?php echo $form['documento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_tipo_documento']->renderLabel() ?>
                    <?php echo $form['id_tipo_documento']->renderError() ?>
                <div class="tip" title="Este dato se puede cambiar siempre que no exista un número de documento y tipo de documento iguales."></div></th>
                <td>
                    <?php echo $form['id_tipo_documento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['lugar_expedicion']->renderLabel() ?>
                    <?php echo $form['lugar_expedicion']->renderError() ?>
                    <div class="tip" title="Es el lugar que aparece en el documento de identidad."></div></th>
                <td>
                    <?php echo $form['lugar_expedicion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_nacimiento']->renderLabel() ?>
                    <?php echo $form['fecha_nacimiento']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['fecha_nacimiento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['genero']->renderLabel() ?>
                    <?php echo $form['genero']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['genero'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_tipo_sangre']->renderLabel() ?>
                    <?php echo $form['id_tipo_sangre']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['id_tipo_sangre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono1']->renderLabel() ?>
                    <?php echo $form['telefono1']->renderError() ?></th>
                <td>
                    <?php echo $form['telefono1'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono2']->renderLabel() ?>
                    <?php echo $form['telefono2']->renderError() ?></th>
                <td>
                    <?php echo $form['telefono2'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['direccion']->renderLabel() ?>
                    <?php echo $form['direccion']->renderError() ?></th>
                <td>
                    <?php echo $form['direccion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['correo']->renderLabel() ?>
                    <?php echo $form['correo']->renderError() ?></th>
                <td>
                    <?php echo $form['correo'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['acudiente1']->renderLabel() ?>
                    <?php echo $form['acudiente1']->renderError() ?>
                <div class="tip" title="Debe ser una persona a quien poder recurrir en caso de emergencia."></div></th>
                <td>
                    <?php echo $form['acudiente1'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono_acudiente1']->renderLabel() ?>
                    <?php echo $form['telefono_acudiente1']->renderError() ?></th>
                <td>
                    <?php echo $form['telefono_acudiente1'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['acudiente2']->renderLabel() ?>
                    <?php echo $form['acudiente2']->renderError() ?></th>
                <td>
                    <?php echo $form['acudiente2'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono_acudiente2']->renderLabel() ?>
                    <?php echo $form['telefono_acudiente2']->renderError() ?></th>
                <td>
                    <?php echo $form['telefono_acudiente2'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['especificaciones_medicas']->renderLabel() ?>
                    <?php echo $form['especificaciones_medicas']->renderError() ?>
                    <div class="tip" title="Incluya tipo de sangre y demás especificaciones médicas que sean relevantes para la integridad del inscrito."></div></th>
                <td>
                    <?php echo $form['especificaciones_medicas'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['observaciones']->renderLabel() ?>
                    <?php echo $form['observaciones']->renderError() ?></th>
                <td>
                    <?php echo $form['observaciones'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<br />
<br />
<br />


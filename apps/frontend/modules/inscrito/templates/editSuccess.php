<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form').validationEngine();
    });
</script>
<h1>Editar Inscrito</h1>
<a href="<?php echo url_for('inscrito/ver?id=') . $form->getObject()->getNumeroFormulario() ?>" class="button back">Volver</a>

<form id="form" action="<?php echo url_for('inscrito/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?numero_formulario=' . $form->getObject()->getNumeroFormulario() : '')) ?>" method="post" <?php ($form->isMultipart() || $formUser->isMultipart()) and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <h2>Datos de Usuario</h2>
    <table>
        <tbody>
            <?php echo $formUser->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $formUser['foto_path']->renderLabel() ?>
                    <?php echo $formUser['foto_path']->renderError() ?></th>
                <td>
                    <?php if ($formUser->getObject()->getFotoPath() != "" && $formUser->getObject()->getFotoPath() != null) { ?>
                        <img src="<?php echo url_for('inscrito/renderFoto?id='.$formUser->getObject()->getIdUsuario()) ?>" /><br />
                    <?php } ?>
                    <?php echo $formUser['foto_path'] ?>
                </td>
            </tr>
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
                    <?php echo $formUser['documento']->renderError() ?>
                    <div class="tip" title="Este dato se puede cambiar siempre que no exista un número de documento y tipo de documento iguales."></div>
                </th>
                <td>
                    <?php echo $formUser['documento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $formUser['id_tipo_documento']->renderLabel() ?>
                    <?php echo $formUser['id_tipo_documento']->renderError() ?>
                <div class="tip" title="Este dato se puede cambiar siempre que no exista un número de documento y tipo de documento iguales."></div></th>
                <td>
                    <?php echo $formUser['id_tipo_documento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $formUser['lugar_expedicion']->renderLabel() ?>
                    <?php echo $formUser['lugar_expedicion']->renderError() ?>
                    <div class="tip" title="Es el lugar que aparece en el documento de identidad."></div></th>
                <td>
                    <?php echo $formUser['lugar_expedicion'] ?>
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
                    <?php echo $formUser['acudiente1']->renderError() ?>
                <div class="tip" title="Debe ser una persona a quien poder recurrir en caso de emergencia."></div></th>
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
                    <?php echo $formUser['especificaciones_medicas']->renderError() ?>
                    <div class="tip" title="Incluya tipo de sangre y demás especificaciones médicas que sean relevantes para la integridad del inscrito."></div></th>
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
                    <?php echo $formUser->renderHiddenFields(false) ?>
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['numero_formulario']->renderLabel() ?>
                    <?php echo $form['numero_formulario']->renderError() ?>
                <div class="tip" title="Este dato no se puede modificar."></div></th>
                <td>
                    <?php echo $form['numero_formulario'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_jornada']->renderLabel() ?>
                <?php echo $form['id_jornada']->renderError() ?></th>
                <td>
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
                <th><?php echo $form['id_periodo']->renderLabel() ?>
                <?php echo $form['id_periodo']->renderError() ?></th>
                <td>
                    <?php echo $form['id_periodo'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<br />
<br />
<br />


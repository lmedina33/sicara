<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    
    $(function() {
        jQuery("#form").validationEngine();
    });
</script>

<!--<form id="form" action="<?php echo url_for('curFormulario/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_cur_formulario=' . $form->getObject()->getIdCurFormulario() . '&id_cur_inscrito=' . $form->getObject()->getIdCurInscrito() . '&id_cur_curso=' . $form->getObject()->getIdCurCurso() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>-->
<form id="form" action="<?php echo url_for('curFormulario/create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

    <h2>Datos del Curso</h2>
    <div class="curDatos">
        <label>Empresa:</label> <?php echo $curso->getCurEmpresa() ?>
        <br />
        <label>Curso:</label> <?php echo $curso->getNombre() ?>
        <?php if ($curso->getDuracion() != null && $curso->getDuracion() != "") { ?>
            <br />
            <label>Duración:</label> <?php echo $curso->getDuracion() ?>
        <?php } ?>
        <?php if ($curso->getFechaInicio() != null && $curso->getFechaInicio() != "") { ?>
            <br />
            <label>Fecha de Inicio:</label> <?php echo $curso->getFechaInicio() ?>
        <?php } ?>
        <?php if ($curso->getFechaFin() != null && $curso->getFechaFin() != "") { ?>
            <br />
            <label>Fecha de Finalización:</label> <?php echo $curso->getFechaFin() ?>
        <?php } ?>
        <?php if ($curso->getHorario() != null && $curso->getHorario() != "") { ?>
            <br />
            <label>Horario:</label> <?php echo $curso->getHorario() ?>
        <?php } ?>
        <br />
    </div>
    <h2>Datos Personales</h2>
    <div class="curDatos">
        <label>Nombre:</label> <?php echo $inscrito->getPrimerNombre()." ".$inscrito->getSegundoNombre()." ".$inscrito->getPrimerApellido()." ".$inscrito->getSegundoApellido() ?>
        <br />
        <label>Documento de Identidad:</label> <?php echo $inscrito->getDocumento()." ".$inscrito->getTipoDocumento() ?>
        <br />
        <label>Correo Electrónico:</label> <input type="text" value="<?php echo $inscrito->getCorreo() ?>" id="correo" name="correo" class="validate[required,custom[email]]"/>
        <input type="hidden" value="<?php echo $inscrito->getIdCurInscrito() ?>" id="idUsu" name="idUsu"/>
    </div>
    <h2>Datos Laborales</h2>
    <table>
        <tbody>
            <tr>
                <th><?php echo $form['direccion']->renderLabel() ?>
                    <?php echo $form['direccion']->renderError() ?></th>
                <td>
                    <?php echo $form['direccion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['dependencia']->renderLabel() ?>
                    <?php echo $form['dependencia']->renderError() ?></th>
                <td>
                    <?php echo $form['dependencia'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['cargo']->renderLabel() ?>
                    <?php echo $form['cargo']->renderError() ?></th>
                <td>
                    <?php echo $form['cargo'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono']->renderLabel() ?>
                    <?php echo $form['telefono']->renderError() ?></th>
                <td>
                    <?php echo $form['telefono'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['horario']->renderLabel() ?>
                    <?php echo $form['horario']->renderError() ?></th>
                <td>
                    <?php echo $form['horario'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <h2>Datos de Formación</h2>
    <table class="table-fill">
        <tbody>
            <tr>
                <th style="text-align:center">Licencia Básica</th>
                <th style="text-align:center">No.</th>
                <th style="text-align:center">Habilitación</th>
                <th style="text-align:center; font-size: 11px">Fecha de<br /> Expedición</th>
                <th style="text-align:center; font-size: 11px">Fecha de<br /> Repaso</th>
            </tr>
            <tr>
                <td><?php echo $form['licencia_basica1']->renderError() ?>
                    <?php echo $form['licencia_basica1'] ?>
                </td>
                <td style=""><?php echo $form['numero_licencia1']->renderError() ?>
                    <?php echo $form['numero_licencia1'] ?>
                </td>
                <td><?php echo $form['habilitacion1']->renderError() ?>
                    <?php echo $form['habilitacion1'] ?>
                </td>
                <td><?php echo $form['fecha_expedicion1']->renderError() ?>
                    <?php echo $form['fecha_expedicion1'] ?>
                </td>
                <td><?php echo $form['fecha_repaso1']->renderError() ?>
                    <?php echo $form['fecha_repaso1'] ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['licencia_basica2']->renderError() ?>
                    <?php echo $form['licencia_basica2'] ?>
                </td>
                <td style=""><?php echo $form['numero_licencia2']->renderError() ?>
                    <?php echo $form['numero_licencia2'] ?>
                </td>
                <td><?php echo $form['habilitacion2']->renderError() ?>
                    <?php echo $form['habilitacion2'] ?>
                </td>
                <td><?php echo $form['fecha_expedicion2']->renderError() ?>
                    <?php echo $form['fecha_expedicion2'] ?>
                </td>
                <td><?php echo $form['fecha_repaso2']->renderError() ?>
                    <?php echo $form['fecha_repaso2'] ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['licencia_basica3']->renderError() ?>
                    <?php echo $form['licencia_basica3'] ?>
                </td>
                <td style=""><?php echo $form['numero_licencia3']->renderError() ?>
                    <?php echo $form['numero_licencia3'] ?>
                </td>
                <td><?php echo $form['habilitacion3']->renderError() ?>
                    <?php echo $form['habilitacion3'] ?>
                </td>
                <td><?php echo $form['fecha_expedicion3']->renderError() ?>
                    <?php echo $form['fecha_expedicion3'] ?>
                </td>
                <td><?php echo $form['fecha_repaso3']->renderError() ?>
                    <?php echo $form['fecha_repaso3'] ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['licencia_basica4']->renderError() ?>
                    <?php echo $form['licencia_basica4'] ?>
                </td>
                <td style=""><?php echo $form['numero_licencia4']->renderError() ?>
                    <?php echo $form['numero_licencia4'] ?>
                </td>
                <td><?php echo $form['habilitacion4']->renderError() ?>
                    <?php echo $form['habilitacion4'] ?>
                </td>
                <td><?php echo $form['fecha_expedicion4']->renderError() ?>
                    <?php echo $form['fecha_expedicion4'] ?>
                </td>
                <td><?php echo $form['fecha_repaso4']->renderError() ?>
                    <?php echo $form['fecha_repaso4'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <br />
    <table>
        <tfoot>
            <tr>
                <td>
                </td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <th>
                    <?php echo $form['captcha']->renderLabel() ?>
                    <?php echo $form['captcha']->renderError() ?>
        <div class="tip" title="Ingrese los números que aparecen en la imagen, para que podamos validar que este formulario ha sido diligenciado por una persona real.<br/>Si no entiende los números, haga click sobre la imagen para actualizarlos."></div>
        </th>
        <td>
            <?php echo $form['captcha'] ?>
        </td>
        </tr>
        </tbody>
    </table>
</form>
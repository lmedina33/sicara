<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    
    $(function() {
        jQuery("#form").validationEngine();
    });
</script>

<h1>Registrarse a Curso Empresarial</h1>
El curso al que desa inscribirse es el siguiente:
<br />
<br />
<div class="curNombre">
    <img src="/images/iconos/avion.png" /><?php echo $curso->getNombre() ?>:
</div>
<div class="curDatos">
    <br />
    <label>Empresa:</label> <?php echo $curso->getCurEmpresa() ?>
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
<br />
<hr />
<br />
<a class="inscribir" href="<?php echo url_for('curCurso/showCursos') ?>"><img src="/images/iconos/back.png" />Volver al listado de cursos</a>
<br />
<br />
Si está seguro que este es el curso al cual desea inscribirse, por favor ingrese los datos a continuación y siga las instrucciones, de lo contrario, regrese y asegurese de seleccionar el curso indicado.
<br />
<br />
<form id="form" action="<?php echo url_for('curFormulario/new') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                </td>
                <td>
                    <input type="submit" value="Continuar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['documento']->renderLabel() ?></th>
                <td>
                    <?php echo $form['documento']->renderError() ?>
                    <?php echo $form['documento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_tipo_documento']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_tipo_documento']->renderError() ?>
                    <?php echo $form['id_tipo_documento'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<br />
<br />
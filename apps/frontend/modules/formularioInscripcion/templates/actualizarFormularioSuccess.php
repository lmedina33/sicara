<script>
    
    $(function() {
        jQuery("#form").validationEngine();
    });
    
</script>

<form id="form" action="<?php echo url_for('formularioInscripcion/editFormulario') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <h1>Cargar Formulario de Inscripción</h1>
    Ingrese sus datos a continuación para poder cargar y modificar su formulario de inscripción.
    <br />
    <br />
    Si no tiene el código del formulario, debe volver a registrar el formulario en <a href="<?php echo url_for('formularioInscripcion/new') ?>">Formulario de Inscripción</a>
    <br />
    <br />
    <table>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['documento']->renderLabel() ?></th>
                <td>
                    <?php echo $form['documento']->renderError() ?>
                    <?php echo $form['documento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['codigo']->renderLabel() ?>
                    <div class="tip" title="Este código fué proporcionado por el sistema cuando <b>creó por primera vez el formulario</b>, recuerde que son <b>10 dígitos</b> entre <b>números</b> y <b>letras mayúsculas</b>."></div>
                </th>
                <td>
                    <?php echo $form['codigo']->renderError() ?>
                    <?php echo $form['codigo'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                </td>
                <td>
                    <input type="submit" value="Cargar" id="enviar"/>
                </td>
            </tr>
        </tbody>
    </table>
</from>

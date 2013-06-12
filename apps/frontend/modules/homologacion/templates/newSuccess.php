<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php
slot('title', 'Crear Homologación')
?>
<script>
    $(document).ready(function(){
        tinyMCE.init({
            theme: "simple",
            mode: "textareas",
            width: "400",
            height: "100"
        });
    
        jQuery("#form").validationEngine();
        
        <?php if($isInterna){ ?>
            $('#tr_institucion_or').hide();
            $('#tr_programa_or').hide();
        <?php }else{ ?>
            $('#tr_pensum_dest').hide();
        <?php } ?>
        
        $('#tr_pensum_or').hide();
            
        $('#homologacion_is_interna').change(function(){
            if($('#homologacion_is_interna').val()=="1"){
                $('#tr_pensum_or').show();
            }else{
                $('#tr_pensum_or').hide();
            }
        });
    });
</script>       
<h1>Crear Homologación</h1>

<?php if($isInterna){ ?>
<h1>Datos de Estudiante</h1>
<b>Nombre: </b><?php echo $estudiante->getUsuario() ?><br />
<b>Documento: </b><?php echo $estudiante->getUsuario()->getDocumento() ?> <?php echo $estudiante->getUsuario()->getTipoDocumento() ?><br />
<b>Código: </b><?php echo $estudiante->getCodigoEstudiante() ?><br />
<b>Programa Origen: </b><?php echo $estudiante->getPensum() ?><br />
<?php }else{ ?>
<h1>Datos de Inscrito</h1>
<b>Nombre: </b><?php echo $inscrito->getUsuario() ?><br />
<b>Documento: </b><?php echo $inscrito->getUsuario()->getDocumento() ?> <?php echo $inscrito->getUsuario()->getTipoDocumento() ?><br />
<b>Código de Formulario: </b><?php echo $inscrito->getNumeroFormulario() ?><br />
<b>Programa de Inscripción: </b><?php echo $inscrito->getPeriodoAcademico()->getPensum() ?><br />
<?php } ?>
<h2>Datos de Homologación</h2>
<form id="form" action="<?php echo url_for('homologacion/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_homologacion=' . $form->getObject()->getIdHomologacion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <input type="submit" value="Registrar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['observaciones']->renderLabel() ?></th>
                <td>
                    <?php echo $form['observaciones']->renderError() ?>
                    <?php echo $form['observaciones'] ?>
                </td>
            </tr>
            <tr id="tr_pensum_dest">
                <th><?php echo $form['codigo_pensum_destino']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_pensum_destino']->renderError() ?>
                    <?php echo $form['codigo_pensum_destino'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>

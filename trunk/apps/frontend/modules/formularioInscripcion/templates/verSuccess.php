<script type="text/javascript">
    $(document).ready(function(){
        $('input').attr('readonly','readonly');
        $('select').attr('disabled','disabled');
        $('#enviar').hide();
    });
</script>
<h1>Ver Formulario de Inscripción <?php echo $numero ?></h1>
<a href="<?php echo url_for('formularioInscripcion/index') ?>" class="button back">Volver</a>
<?php if($cerrado=="0"){ ?>
<a href="<?php echo url_for('formularioInscripcion/edit?id_formulario_inscripcion=').$form->getObject()->getIdFormularioInscripcion() ?>" class="button edit">Editar Formulario</a>
<?php } ?>
<?php include_partial('form', array('form' => $form, 'isUpdate' => false)) ?>


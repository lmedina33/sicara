<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    
    $(function() {
        jQuery("#form").validationEngine();
    });
    
    
    
    function changePensum(){
        $('#enviar').attr('disabled', 'disabled');
        $.post('<?php echo url_for('formularioInscripcion/getPensum') ?>',
        { id:$('#formulario_inscripcion_id_periodo').val() },
        function(data){
            $('#formulario_inscripcion_codigo_pensum').val(data);
            $('#enviar').removeAttr('disabled');
        },'json'
    );
    }
    
    function deleteFoto(){
        
        if(confirm('Esta seguro de querer eliminar esta foto?\n\nEste proceso es irreversible.')){
            $.post('<?php echo url_for('formularioInscripcion/removeFoto') ?>',
            { "id": <?php echo ($form->getObject()->getIdFormularioInscripcion()=="" ? "0":$form->getObject()->getIdFormularioInscripcion()) ?>},
            function(data){
                if(data){
                    $('#deleteFoto').hide();
                    $('#foto').hide();
                    alert('La foto ha sido eliminada con éxito.');
                }else{
                    alert('La foto no pudo ser eliminada.');
                }
            },
            'json');
        }
        
        return false;
    }
    
</script>

<form id="form" action="<?php echo url_for('formularioInscripcion/' . ($form->getObject()->isNew() ? 'create' : ($isUpdate ? 'updateFormulario' : 'update')) . (!$form->getObject()->isNew() ? '?id_formulario_inscripcion=' . $form->getObject()->getIdFormularioInscripcion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <h2>Datos Personales</h2>
    <table>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['primer_nombre']->renderLabel() ?></th>
                <td>
                    <?php echo $form['primer_nombre']->renderError() ?>
                    <?php echo $form['primer_nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['segundo_nombre']->renderLabel() ?></th>
                <td>
                    <?php echo $form['segundo_nombre']->renderError() ?>
                    <?php echo $form['segundo_nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['primer_apellido']->renderLabel() ?></th>
                <td>
                    <?php echo $form['primer_apellido']->renderError() ?>
                    <?php echo $form['primer_apellido'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['segundo_apellido']->renderLabel() ?></th>
                <td>
                    <?php echo $form['segundo_apellido']->renderError() ?>
                    <?php echo $form['segundo_apellido'] ?>
                </td>
            </tr>
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
            <tr>
                <th><?php echo $form['lugar_expedicion']->renderLabel() ?>
                    <div class="tip" title="Lugar de expedición que registra su documento de identidad."></div>
                </th>
                <td>
                    <?php echo $form['lugar_expedicion']->renderError() ?>
                    <?php echo $form['lugar_expedicion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['lugar_nacimiento']->renderLabel() ?></th>
                <td>
                    <?php echo $form['lugar_nacimiento']->renderError() ?>
                    <?php echo $form['lugar_nacimiento'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_nacimiento']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fecha_nacimiento']->renderError() ?>
                    <?php echo $form['fecha_nacimiento'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo $form['libreta_militar']->renderLabel() ?>
                    <div class="tip" title="Solo para hombres.<br/>Si no ha definido su situación militar, deje este campo vacío."></div>
                </th>
                <td>
                    <?php echo $form['libreta_militar']->renderError() ?>
                    <?php echo $form['libreta_militar'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo $form['foto_path']->renderLabel() ?>
            <div class="tip" title="Si desea puede anexar una fotografía del aspirante tipo carné, fondo azul, de 1.5cm X 2cm que no ocupe más 500 KB.<br />Puede cambiar o borrar la foto las veces que sea necesario mientras el formulario no esté formalizado."></div>
                </th>
                <td>
                    <?php if($form->getObject()->getFotoPath()!= null && $form->getObject()->getFotoPath()!= ""){ ?>
                    <a id="deleteFoto" onClick="javascript: return deleteFoto()" href=""><img src="/images/iconos/removeSmall.png" /></a>
                    <img id="foto" src="<?php echo url_for('formularioInscripcion/renderFoto?id='.$form->getObject()->getIdFormularioInscripcion()) ?>" />
                    <br />
                    <?php } ?>
                    <?php echo $form['foto_path']->renderError() ?>
                    <?php echo $form['foto_path'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['es_trabajador']->renderLabel() ?></th>
                <td>
                    <?php echo $form['es_trabajador']->renderError() ?>
                    <?php echo $form['es_trabajador'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono1']->renderLabel() ?></th>
                <td>
                    <?php echo $form['telefono1']->renderError() ?>
                    <?php echo $form['telefono1'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['telefono2']->renderLabel() ?></th>
                <td>
                    <?php echo $form['telefono2']->renderError() ?>
                    <?php echo $form['telefono2'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['direccion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['direccion']->renderError() ?>
                    <?php echo $form['direccion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['correo']->renderLabel() ?></th>
                <td>
                    <?php echo $form['correo']->renderError() ?>
                    <?php echo $form['correo'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <h2>Formación Académica</h2>
    <table class="table-fill">
        <tbody>
            <tr>
                <td colspan="5" class="h1"><b>Educación Primaria</b>
                </td>
            </tr>
            <tr>
                <th class="none"></th>
                <th style="text-align: center; font-size: 11px">Año<br />Finalización</th>
                <th style="text-align: center;">Institución
                    <div class="tip" title="Nombre de la institución donde terminó sus estudios de educación básica (5° de primaria)."></div>
                </th>
                <th style="text-align: center">Municipio / Ciudad</th>
                <th class="none"></th>
            </tr>
            <tr>
                <td class="none"></td>
                <td style="text-align: center">
                    <?php echo $form['edu_basica_ano']->renderError() ?>
                    <?php echo $form['edu_basica_ano'] ?>
                </td>
                <td>
                    <?php echo $form['edu_basica_institucion']->renderError() ?>
                    <?php echo $form['edu_basica_institucion'] ?>
                </td>
                <td>
                    <?php echo $form['edu_basica_lugar']->renderError() ?>
                    <?php echo $form['edu_basica_lugar'] ?>
                </td>
                <td class="none"></td>
            </tr>
            <tr>
                <td colspan="5" class="h1"><br /><b>Educación Secundaria</b></td>
            </tr>
            <tr>
                <th style="text-align: center; font-size: 11px">En<br />Curso?</th>
                <th style="text-align: center; font-size: 11px">Año<br />Finalización</th>
                <th style="text-align: center">Institución
                    <div class="tip" title="Nombre de la institución donde terminó o cursa sus estudios de educación media (hasta grado 11).<br />Algunos de nuestros programas no exigen ser bachiller, por favor consulte con admisiones para saber si es necesario o no ser bachiller para el programa al que le interesa inscribirse."></div>
                </th>
                <th style="text-align: center">Municipio / Ciudad</th>
                <th style="text-align: center">Título Obtenido</th>
            </tr>
            <tr>
                <td>
                    <?php echo $form['edu_media_en_curso']->renderError() ?>
                    <?php echo $form['edu_media_en_curso'] ?>
                </td>
                <td style="text-align: center">
                    <?php echo $form['edu_media_ano']->renderError() ?>
                    <?php echo $form['edu_media_ano'] ?>
                </td>
                <td>
                    <?php echo $form['edu_media_institucion']->renderError() ?>
                    <?php echo $form['edu_media_institucion'] ?>
                </td>
                <td>
                    <?php echo $form['edu_media_lugar']->renderError() ?>
                    <?php echo $form['edu_media_lugar'] ?>
                </td>
                <td>
                    <?php echo $form['edu_media_titulo']->renderError() ?>
                    <?php echo $form['edu_media_titulo'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="h1"><b><br />Educación Superior</b></td>
            </tr>
            <tr>
                <th style="text-align: center; font-size: 11px">En<br />Curso?</th>
                <th style="text-align: center; font-size: 11px">Año<br />Finalización</th>
                <th style="text-align: center">Institución
                    <div class="tip" title="Nombre de la institución donde terminó o cursa actualmente sus estudios de educación superior (técnico, técnologo, profesional, maestría, ...)."></div>
                </th>
                <th style="text-align: center">Municipio / Ciudad</th>
                <th style="text-align: center">Título Obtenido</th>
            </tr>
            <tr>
                <td>
                    <?php echo $form['edu_superior1_en_curso']->renderError() ?>
                    <?php echo $form['edu_superior1_en_curso'] ?>
                </td>
                <td style="text-align: center">
                    <?php echo $form['edu_superior1_ano']->renderError() ?>
                    <?php echo $form['edu_superior1_ano'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior1_institucion']->renderError() ?>
                    <?php echo $form['edu_superior1_institucion'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior1_lugar']->renderError() ?>
                    <?php echo $form['edu_superior1_lugar'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior1_titulo']->renderError() ?>
                    <?php echo $form['edu_superior1_titulo'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form['edu_superior2_en_curso']->renderError() ?>
                    <?php echo $form['edu_superior2_en_curso'] ?>
                </td>
                <td style="text-align: center">
                    <?php echo $form['edu_superior2_ano']->renderError() ?>
                    <?php echo $form['edu_superior2_ano'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior2_institucion']->renderError() ?>
                    <?php echo $form['edu_superior2_institucion'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior2_lugar']->renderError() ?>
                    <?php echo $form['edu_superior2_lugar'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior2_titulo']->renderError() ?>
                    <?php echo $form['edu_superior2_titulo'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form['edu_superior3_en_curso']->renderError() ?>
                    <?php echo $form['edu_superior3_en_curso'] ?>
                </td>
                <td style="text-align: center">
                    <?php echo $form['edu_superior3_ano']->renderError() ?>
                    <?php echo $form['edu_superior3_ano'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior3_institucion']->renderError() ?>
                    <?php echo $form['edu_superior3_institucion'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior3_lugar']->renderError() ?>
                    <?php echo $form['edu_superior3_lugar'] ?>
                </td>
                <td>
                    <?php echo $form['edu_superior3_titulo']->renderError() ?>
                    <?php echo $form['edu_superior3_titulo'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <h2>Datos de Inscripción</h2>
    <table>
        <tbody>
            <tr>
                <th><?php echo $form['id_periodo']->renderLabel() ?>
                    <div class="tip" title="Si no encuentra el programa al cual desea inscribirse, póngase en contacto admisiones para conocer si ese programa está o no disponible."></div>
                </th>
                <td>
                    <?php echo $form['id_periodo']->renderError() ?>
                    <?php echo $form['id_periodo'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_jornada']->renderLabel() ?>
                    <div class="tip" title="Si no encuentra la jornada a la cual desea inscribirse, póngase en contacto admisiones para conocer si esa jornada está o no disponible."></div>
                </th>
                <td>
                    <?php echo $form['id_jornada']->renderError() ?>
                    <?php echo $form['id_jornada'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['conocio']->renderLabel() ?></th>
                <td>
                    <?php echo $form['conocio']->renderError() ?>
                    <?php echo $form['conocio'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_tipo_pago']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_tipo_pago']->renderError() ?>
                    <?php echo $form['id_tipo_pago'] ?>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <?php if($isUpdate){ ?>
            <tr>
                <th><?php echo $form['captcha']->renderLabel() ?>
                    <div class="tip" title="Ingrese los números que aparecen en la imagen, para que podamos validar que este formulario ha sido diligenciado por una persona real.<br/>Si no entiende los números, haga click sobre la imagen para actualizarlos."></div>
                </th>
                <td>
                    <?php echo $form['captcha']->renderError() ?>
                    <?php echo $form['captcha'] ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                </td>
                <td>
                    <input type="submit" value="Guardar" id="enviar"/>
                </td>
            </tr>
        </tfoot>
    </table> 
</form>

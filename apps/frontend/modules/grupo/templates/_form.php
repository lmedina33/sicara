<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    $(function() {
        jQuery("#form").validationEngine();
        
        $('#pensum').change(function(){
            codigoPensum=$('#pensum').val();
            cambiarPeriodo(codigoPensum,null);
            cambiarAsignatura(codigoPensum,null);
            
        });
        
        $('#grupo_inicio_calificacion').datetimepicker({
            buttonImage: "/images/iconos/calendar.png",
            buttonImageOnly: true,
            showOn: "button",
            onSelect: grupo_inicio_calificacion_jquery_control_onSelect,
            dateFormat: 'yy-mm-dd',
            timeFormat: 'hh:mm',
            currentText: 'Ahora',
            changeMonth: true,
            changeYear: true,
            closeText: 'Listo',
            timeText: '',
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio', 'Julio', 'Agosto', 'Septiembre','Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr','May', 'Jun', 'Jul', 'Ago','Sep', 'Oct', 'Nov', 'Dic']
        }); 
        
        $('#grupo_fin_calificacion').datetimepicker({
            buttonImage: "/images/iconos/calendar.png",
            buttonImageOnly: true,
            showOn: "button",
            dateFormat: 'yy-mm-dd',
            timeFormat: 'hh:mm',
            currentText: 'Ahora',
            changeMonth: true,
            changeYear: true,
            closeText: 'Listo',
            timeText: '',
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio', 'Julio', 'Agosto', 'Septiembre','Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr','May', 'Jun', 'Jul', 'Ago','Sep', 'Oct', 'Nov', 'Dic']
        }); 
        
        <?php if(!$form->getObject()->isNew()){
            echo "cambiarPeriodo('".$form->getObject()->getPeriodoAcademico()->getCodigoPensum()."',".$form->getObject()->getIdPeriodo().");\n";
            echo "cambiarAsignatura('".$form->getObject()->getPeriodoAcademico()->getCodigoPensum()."','".$form->getObject()->getCodigoAsignatura()."');";
        } ?>
    });
    
    function cambiarPeriodo(codigoPensum,idPeriodo){
        $.post('<?php echo url_for('grupo/getPeriodos') ?>',
            {
                idPensum:codigoPensum
            }, function(data){
                 html='<option value="">Seleccione...</option|>';
                for(i=0;i<data.length;i++){
                    if(idPeriodo==data[i]['id']){
                        html+='<option value="'+data[i]['id']+'" selected="selected">'+data[i]['periodo']+'</option>';
                    }else{
                        html+='<option value="'+data[i]['id']+'">'+data[i]['periodo']+'</option>';
                    }
                }
                $('#grupo_id_periodo').html(html);
            }, 'json');
       
    }
    
    function cambiarAsignatura(codigoPensum,idAsignatura){
        $.post('<?php echo url_for('grupo/getAsignaturas') ?>',
            {
                idPensum:codigoPensum
            }, function(data){
                 html='<option value="">Seleccione...</option|>';
//                 alert(idAsignatura);
                for(i=0;i<data.length;i++){
                    if(idAsignatura==data[i]['id']){
                        html+='<option value="'+data[i]['id']+'" selected="selected">'+data[i]['nombre']+'</option>';
                    }else{
                        html+='<option value="'+data[i]['id']+'">'+data[i]['nombre']+'</option>';
                    }
                }
                $('#grupo_codigo_asignatura').html(html);
            }, 'json');
       
    }
    
    function grupo_fecha_inicio_jquery_control_onSelect(date){
        $("#grupo_fecha_fin_jquery_control").datepicker( "option", "minDate",date );
        $("#grupo_fecha_fin_jquery_control").datepicker('enable');
        
        $("#grupo_inicio_calificacion").datepicker( "option", "minDate",date );
        $("#grupo_inicio_calificacion").datepicker('enable');
    }
    
    function grupo_inicio_calificacion_jquery_control_onSelect(date){
        $("#grupo_fin_calificacion").datepicker( "option", "minDate",date );
        $("#grupo_fin_calificacion").datepicker('enable');
    }
</script>

<form id="form" action="<?php echo url_for('grupo/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_grupo=' . $form->getObject()->getIdGrupo() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
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
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['nombre']->renderLabel() ?></th>
                <td>
                    <?php echo $form['nombre']->renderError() ?>
                    <?php echo $form['nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><label for="pensum">Pensum</label></th>
                <td>
                    <select id="pensum" class="validate[required]">
                        <option value="">Seleccione..</option>
                        <?php foreach($pensums as $pensum){ ?>
                        <option value="<?php echo $pensum->getCodigoPensum() ?>" <?php echo ($form->getObject()->getPeriodoAcademico()->getCodigoPensum()==$pensum->getCodigoPensum())? "selected='selected'":"" ?>><?php echo $pensum ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="grupo_id_periodo">Periodo</label></th>
                <td>
                    <select id="grupo_id_periodo" name="grupo[id_periodo]" class="validate[required]">
                        <option>Seleccione...</option>
                    </select>
                </td>
            </tr>
<!--            <tr>
                <th><?php echo $form['id_periodo']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_periodo']->renderError() ?>
                    <?php echo $form['id_periodo'] ?>
                </td>
            </tr>-->
            <tr>
                <th><label for="grupo_codigo_asignatura">Asignatura</label></th>
                <td>
                    <select id="grupo_codigo_asignatura" name="grupo[codigo_asignatura]" class="validate[required]">
                        <option>Seleccione...</option>
                    </select>
                </td>
            </tr>
<!--            <tr>
                <th><?php echo $form['codigo_asignatura']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_asignatura']->renderError() ?>
                    <?php echo $form['codigo_asignatura'] ?>
                </td>
            </tr>-->
            <tr>
                <th><?php echo $form['fecha_inicio']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fecha_inicio']->renderError() ?>
                    <?php echo $form['fecha_inicio'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_fin']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fecha_fin']->renderError() ?>
                    <?php echo $form['fecha_fin'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['inicio_calificacion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['inicio_calificacion']->renderError() ?>
                    <?php echo $form['inicio_calificacion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fin_calificacion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fin_calificacion']->renderError() ?>
                    <?php echo $form['fin_calificacion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['codigo_profesor']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_profesor']->renderError() ?>
                    <?php echo $form['codigo_profesor'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['certificacion_primaria']->renderLabel() ?></th>
                <td>
                    <?php echo $form['certificacion_primaria']->renderError() ?>
                    <?php echo $form['certificacion_primaria'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['certificacion_secundaria']->renderLabel() ?></th>
                <td>
                    <?php echo $form['certificacion_secundaria']->renderError() ?>
                    <?php echo $form['certificacion_secundaria'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['observaciones']->renderLabel() ?></th>
                <td>
                    <?php echo $form['observaciones']->renderError() ?>
                    <?php echo $form['observaciones'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>

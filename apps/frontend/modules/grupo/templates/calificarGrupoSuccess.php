<?php
slot('title', 'Calificar Grupo')
?>

<script>
    $(function() {
        jQuery("#form").validationEngine();
        colorearDatos();
    });
    
    function colorearDatos(){
        $('.parcial1').each(function(){
            if($(this).val() < <?php echo $grupo->getPeriodoAcademico()->getPensum()->getNotaAprobatoria() ?>){
                $(this).css('color', 'red')
            }else{
                $(this).css('color', 'darkgreen')
            }
        });
        
        $('.parcial2').each(function(){
            if($(this).val() < <?php echo $grupo->getPeriodoAcademico()->getPensum()->getNotaAprobatoria() ?>){
                $(this).css('color', 'red')
            }else{
                $(this).css('color', 'darkgreen')
            }
        });
        
        $('.parcial3').each(function(){
            if($(this).val() < <?php echo $grupo->getPeriodoAcademico()->getPensum()->getNotaAprobatoria() ?>){
                $(this).css('color', 'red')
            }else{
                $(this).css('color', 'darkgreen')
            }
        });
        
        $('.nota').each(function(){
            if(parseFloat($(this).html()) < <?php echo $grupo->getPeriodoAcademico()->getPensum()->getNotaAprobatoria() ?>){
                $(this).css('color', 'red')
            }else{
                $(this).css('color', 'darkgreen')
            }
        });
        
        $('.nivelacion').each(function(){
            if($(this).val() < <?php echo $grupo->getPeriodoAcademico()->getPensum()->getNotaAprobatoria() ?>){
                $(this).css('color', 'red')
            }else{
                $(this).css('color', 'darkgreen')
            }
        });
    }
    
    function guardar(){
        if(jQuery("#form").validationEngine('validate')){
            $('#notas tbody tr').each(function(){
                idGrupo=<?php echo $grupo->getIdGrupo() ?>;
                codigo=$(this).attr('id');
                parcial1=$('#'+codigo+' .parcial1').val();
                parcial2=$('#'+codigo+' .parcial2').val();
                parcial3=$('#'+codigo+' .parcial3').val();
                asistencia=$('#'+codigo+' .asistencia').val();
                nivelacion=$('#'+codigo+' .nivelacion').val();
                nota='';
                par1='';
                par2='';
                par3='';
                if(parcial1!='' || parcial2!='' || parcial3!=''){
                    par1=0;
                    par2=0;
                    par3=0;
                    
                    if(parcial1!=''){
                        par1=parseFloat(parcial1);
                    }
                    
                    if(parcial2!=''){
                        par2=parseFloat(parcial2);
                    }
                    
                    if(parcial3!=''){
                        par3=parseFloat(parcial3);
                    }
                    
                    nota=Math.round((par1*0.3)+(par2*0.3)+(par3*0.4));
                    $('#final_'+codigo).html(nota);
                    
                }
                
//                $(this).css('color', '#ccc');
                
                $.post('<?php echo url_for('grupo/guardarNota') ?>', 
                {
                    idGrupo: idGrupo,
                    parcial1: par1,
                    parcial2: par2,
                    parcial3: par3,
                    nota: nota,
                    asistencia: asistencia,
                    nivelacion: nivelacion,
                    codEstudiante: codigo,
                    codAsignatura: '<?php echo $grupo->getCodigoAsignatura() ?>',
                    idPeriodo: <?php echo $grupo->getIdPeriodo() ?>
                }, function(data){
//                    alert('asdf');
//                    if(data=='ok'){
//                        $('#'+codigo).css('color', 'black');
//                    }else{
//                        $('#'+codigo).css('color', 'red');
//                    }
                }, 'text');
            });
            colorearDatos();
        }
    }
</script>

<h1>Calificar Grupo</h1>
<a href="<?php echo url_for('grupo/verGrupo?id='.$grupo->getIdGrupo()) ?>" class="button back">Volver</a>
<br />
<br />
<b>Nombre: </b><?php echo $grupo->getNombre() ?><br />
<b>Programa: </b><?php echo $grupo->getPeriodoAcademico()->getPensum() ?><br />
<b>Periodo: </b><?php echo $grupo->getPeriodoAcademico()->getPeriodo() ?><br />
<b>Asignatura: </b><?php echo $grupo->getAsignatura() ?><br />
<b>Profesor: </b><?php echo $grupo->getProfesor() ?><br />
<br />
<b>Iniciación: </b><?php echo $grupo->getFechaInicio() ?><br />
<b>Finalización: </b><?php echo $grupo->getFechaFin() ?><br />
<br />
<b>Inicio de Calificación: </b><?php echo $grupo->getInicioCalificacion() ?><br />
<b>Fin de Calificación: </b><?php echo $grupo->getFinCalificacion() ?><br />
<h2>Estudiantes Inscritos</h2>
<form id="form">
    <table id="notas" class="verHorizontal">
        <thead>
            <tr>
                <th style="width: 10%">Codigo</th>
                <th>Nombres</th>
                <th style="width: 7%"><small>Primer Parcial (30%)</small></th>
                <th style="width: 7%"><small>Segundo Parcial (30%)</small></th>
                <th style="width: 7%"><small>Parcial Final (40%)</small></th>
                <th style="width: 7%"><small>Nota Definitva</small></th>
                <th style="width: 7%"><small>Asistencia</small></th>
                <th style="width: 7%"><small>Nivelación</small></th>
                <th style="width: 5%"><small></small></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudiantesHas as $estudianteHas) { ?>
                <tr id="<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>">
                    <td><?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?></td>
                    <td>
                        <?php echo $estudianteHas->getEstudiante()->getUsuario()->getPrimerApellido() ?> 
                        <?php echo $estudianteHas->getEstudiante()->getUsuario()->getSegundoApellido() ?> 
                        <?php echo $estudianteHas->getEstudiante()->getUsuario()->getPrimerNombre() ?> 
                        <?php echo $estudianteHas->getEstudiante()->getUsuario()->getSegundoNombre() ?> 
                    </td>
                    <?php
                    $registro = $notas[$estudianteHas->getEstudiante()->getCodigoEstudiante()];

                    $nota = null;
                    if ($registro != null) {
                        $nota = $registro['nota'];
                    }

                    $parcial1 = null;
                    if ($registro['parcial1'] != null) {
                        $parcial1 = $registro['parcial1'];
                    }

                    $parcial2 = null;
                    if ($registro['parcial2'] != null) {
                        $parcial2 = $registro['parcial2'];
                    }

                    $parcial3 = null;
                    if ($registro['parcial3'] != null) {
                        $parcial3 = $registro['parcial3'];
                    }
                    ?>
                    <td><input id="parcial1_<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>" type="text" size="4" class="validate[custom[number],min[0],max[100]] parcial1" value="<?php echo $parcial1 == null ? '' : $parcial1->getCalificacion() ?>" <?php if($nota!=null) echo $nota->getIsHomologacion()==1 ? 'disabled="disabled"':"" ?>/></td>
                    <td><input id="parcial2_<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>" type="text" size="4" class="validate[custom[number],min[0],max[100]] parcial2" value="<?php echo $parcial2 == null ? '' : $parcial2->getCalificacion() ?>" <?php if($nota!=null) echo $nota->getIsHomologacion()==1 ? 'disabled="disabled"':"" ?>/></td>
                    <td><input id="parcial3_<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>" type="text" size="4" class="validate[custom[number],min[0],max[100]] parcial3" value="<?php echo $parcial3 == null ? '' : $parcial3->getCalificacion() ?>" <?php if($nota!=null) echo $nota->getIsHomologacion()==1 ? 'disabled="disabled"':"" ?>/></td>
                    <td id="final_<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>" class="nota"><?php echo $nota == null ? '' : $nota->getNotaAsignaturaCursada() ?></td>
                    <td><input id="asistencia_<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>" type="text" size="4" class="validate[custom[number],min[0],max[100]] asistencia" value="<?php echo $nota == null ? '' : $nota->getAsistencia() ?>" <?php if($nota!=null) echo $nota->getIsHomologacion()==1 ? 'disabled="disabled"':"" ?>/></td>
                    <td><input id="nivelacion_<?php echo $estudianteHas->getEstudiante()->getCodigoEstudiante() ?>" type="text" size="4" class="validate[custom[number],min[0],max[<?php $grupo->getAsignatura()->getIntensidadHoraria() ?>]] nivelacion" value="<?php if($nota!=null) echo $nota == null ? '' : $nota->getNotaNivelacionAsignaturaCursada() ?>" <?php if($nota!=null) echo $nota->getIsHomologacion()==1 ? 'disabled="disabled"':"" ?>/></td>
                    <td><small><?php if($nota!=null) echo $nota->getIsHomologacion()==1 ? "Homolog":"" ?></small></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</form>
<br />
<a href="javascript:guardar()" class="button">Guardar</a>
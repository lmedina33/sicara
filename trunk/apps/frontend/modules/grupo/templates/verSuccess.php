<?php
slot('title', 'Ver Grupo')
?>

<script type="text/javascript">
    $(document).ready(function(){
        
    });
    var disabled=false;
    
    
    function addEstudiante(codigo,estudiante){
        
        if(!disabled){
            disabled=true;

            $.post('<?php echo url_for('grupo/addEstudiante') ?>',
            {
                grupo: <?php echo $grupo->getIdGrupo() ?>,
                estudiante: codigo
            }, function(data){
                if(data=="added"){
                        $('#registrados tbody').append("<tr class=\"registrados\" id=\"reg_"+codigo+"\">\n\
        <td>"+estudiante+" <a href=\"javascript:deleteEstudiante('"+codigo+"','"+estudiante+"')\"><img src=\"/images/iconos/arrowRightBlue.png\" /></a>\n\
        </td></tr>");

                        $("#dis_"+codigo).remove();

                        if($(".disponibles").length == 0){
                            $('#disponibles tbody').append("<tr id=\"dis_vacio\">\n\
            <td>No hay estudiantes disponibles</td>\n\
            </tr>");
                        }

                        if($(".registrados").length != 0){
                            $("#reg_vacio").remove();
                        }
                    }else{
                        alert('No se pudo agregar el estudiante.');
                    }
                    
                    disabled=false;
                }, 'text');
            }
        }
    
        function deleteEstudiante(codigo,estudiante){
            if(!disabled){
                disabled=true;
                $.post('<?php echo url_for('grupo/deleteEstudiante') ?>',
                {
                    grupo: <?php echo $grupo->getIdGrupo() ?>,
                    estudiante: codigo
                }, function(data){
                        if(data=='removed'){
                        $('#disponibles tbody').append("<tr class=\"disponibles\" id=\"dis_"+codigo+"\">\n\
        <td><a href=\"javascript:addEstudiante('"+codigo+"','"+estudiante+"')\"> <img src=\"/images/iconos/arrowLeftGreen.png\" /></a>"+estudiante+"\n\
        </td></tr>");

                        $("#reg_"+codigo).remove();

                        if($(".registrados").length == 0){
                            $('#registrados tbody').append("<tr id=\"reg_vacio\">\n\
            <td>No hay estudiantes registrados</td>\n\
            </tr>");
                        }

                        if($(".disponibles").length != 0){
                            $("#dis_vacio").remove();
                        }
                    }else{
                        alert('No se pudo remover el estudiante.');
                    }
                    disabled=false;
                }, 'text');
            }
        }
</script>

<h1>Ver Grupo</h1>
<h2>Datos Generales</h2>
<form>
    <table>
        <tbody>
            <tr>
                <th><label for="periodo">Periodo</label></th>
                <td>
                    <input id="periodo" type="text" size="40" value="<?php echo $grupo->getPeriodoAcademico() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="asignatura">Asignatura</label></th>
                <td>
                    <input id="asignatura" type="text" size="40" value="<?php echo $grupo->getAsignatura() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="nombre">Nombre</label></th>
                <td>
                    <input id="nombre" type="text" size="40" value="<?php echo $grupo->getNombre() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="observaciones">Observaciones</label></th>
                <td>
                    <textarea id="observaciones" type="text" size="40" readonly="readonly"><?php echo $grupo->getObservaciones() ?></textarea>
                </td>
            </tr>
            <tr>
                <th> </th>
                <td></td>
            </tr>
            <tr>
                <th><label for="fecha_inicio">Fecha de Inicio</label></th>
                <td>
                    <input id="fecha_inicio" type="text" value="<?php echo $grupo->getFechaInicio() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="fecha_fin">Fecha de Finalización</label></th>
                <td>
                    <input id="fecha_fin" type="text" value="<?php echo $grupo->getFechaFin() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th> </th>
                <td></td>
            </tr>
            <tr>
                <th><label for="inicio_calificacion">Inicio de Calificación</label></th>
                <td>
                    <input id="inicio_calificacion" type="text" value="<?php echo $grupo->getInicioCalificacion() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="fin_calificacion">Fin de Calificación</label></th>
                <td>
                    <input id="fin_calificacion" type="text" value="<?php echo $grupo->getFinCalificacion() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th> </th>
                <td></td>
            </tr>
            <tr>
                <th><label for="creacion">Fecha de Creación</label></th>
                <td>
                    <input id="creacion" type="text" value="<?php echo $grupo->getCreatedAt() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="actualizacion">Última actualización</label></th>
                <td>
                    <input id="actualizacion" type="text" value="<?php echo $grupo->getUpdatedAt() ?>" readonly="readonly">
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <h2>Datos del Profesor</h2>
    <table>
        <tbody>
            <tr>
                <th><label for="profesor">Profesor</label></th>
                <td>
                    <input id="profesor" type="text" size="40" value="<?php echo $grupo->getProfesor() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="certificado1">Certificación Primaria</label></th>
                <td>
                    <input id="certificado1" type="text" size="40" value="<?php echo $grupo->getCertificacionPrimaria() ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th><label for="certificado2">Certificación Secundaria</label></th>
                <td>
                    <input id="certificado2" type="text" size="40" value="<?php echo $grupo->getCertificacionSecundaria() ?>" readonly="readonly">
                </td>
            </tr>
        </tbody>
    </table>
</form>
<br />
<div style="width: 40%; float:left">
    <h2>Estudiantes Registrados</h2>
    <?php if ($estudiantes->count() != 0) { ?>
        <table id="registrados">
            <tbody>
                <?php foreach ($estudiantes as $has) { ?>
                    <tr class="registrados" id="reg_<?php echo $has->getCodigoEstudiante() ?>">
                        <td><?php echo $has->getEstudiante() ?> <a href="javascript:deleteEstudiante('<?php echo $has->getCodigoEstudiante() ?>','<?php echo $has->getEstudiante() ?>')"><img src="/images/iconos/arrowRightBlue.png" /></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <table id="registrados">
            <tbody>
                <tr id="reg_vacio">
                    <td>No hay estudiantes registrados</td>
                </tr>
            </tbody>
        </table>
    <?php } ?>
</div>
<div style="padding-left: 50px; float:left; border-left: 1px dashed #ccc">
    <h2>Estudiantes Disponibles</h2>
    <?php if ($disponibles->count() != 0) { ?>
        <table id="disponibles">
            <tbody>
                <?php foreach ($disponibles as $matricula) { ?>
                    <tr class="disponibles" id="dis_<?php echo $matricula->getCodigoEstudiante() ?>">
                        <td><a href="javascript:addEstudiante('<?php echo $matricula->getCodigoEstudiante() ?>','<?php echo $matricula->getEstudiante() ?>')"><img src="/images/iconos/arrowLeftGreen.png" /></a> <?php echo $matricula->getEstudiante() ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <table id="disponibles">
            <tbody>
                <tr id="dis_vacio">
                    <td>No hay estudiantes disponibles</td>
                </tr>
            </tbody>
        </table>
    <?php } ?>
</div>
<div style="clear: both"></div>
<br />
<br />
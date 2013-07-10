<?php
slot('title', 'Ver Grupo')
?>

<h1>Ver Grupo</h1>
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
<h2>Formatos</h2>
<a href="<?php echo url_for('grupo/generarFormatoRC003?id='.$grupo->getIdGrupo()) ?>" class="button" target="_blank">Asistencia</a>
<a href="<?php echo url_for('grupo/generarFormatoRC005?id='.$grupo->getIdGrupo()) ?>" class="button" target="_blank">Calificaciones</a>
<a href="<?php echo url_for('grupo/generarFormatoRC005Dil?id='.$grupo->getIdGrupo()) ?>" class="button" target="_blank">Calificaciones Diligenciado</a>
<a href="<?php echo url_for('grupo/generarFormatoRC011?id='.$grupo->getIdGrupo()) ?>" class="button" target="_blank">Parciales</a>
<a href="<?php echo url_for('grupo/generarFormatoRC011Dil?id='.$grupo->getIdGrupo()) ?>" class="button" target="_blank">Parciales Diligenciado</a>
<br />
<h2>Estudiantes Inscritos</h2>
    <?php if($isActivo){ ?>
    <a href="<?php echo url_for('grupo/calificarGrupo?id='.$grupo->getIdGrupo()) ?>" class="button">Calificar</a>
    <?php } ?>
    <br />
    <br />
    <table id="notas" class="verHorizontal">
        <thead>
            <tr>
                <th style="width: 10%">Codigo</th>
                <th>Nombres</th>
                <th>Parcial 1</th>
                <th>Parcial 2</th>
                <th>Parcial 3</th>
                <th>Definitiva</th>
                <th>Asistencia</th>
                <th>Nivelación</th>
                <th></th>
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
                    if(isset($notas[$estudianteHas->getEstudiante()->getCodigoEstudiante()])){ 
                        $data=$notas[$estudianteHas->getEstudiante()->getCodigoEstudiante()];
                        ?>
                    <td>
                        <?php echo $data['parcial1'] ?>
                    </td>
                    <td>
                        <?php echo $data['parcial2'] ?>
                    </td>
                    <td>
                        <?php echo $data['parcial3'] ?>
                    </td>
                    <td>
                        <?php echo $data['definitiva'] ?>
                    </td>
                    <td>
                        <?php echo $data['asistencia'] ?>
                    </td>
                    <td>
                        <?php echo $data['nivelacion'] ?>
                    </td>
                    <td>
                        <?php echo $data['is_homologacion']==1 ? 'Homolog':'' ?>
                    </td>
                    <?php }else{ ?>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<br />
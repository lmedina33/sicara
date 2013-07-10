<style type="text/css">
    .small{
        width: 5%;
        text-align: center;
        font-size: 9px;
    }
    .medium{
        width: 5%;
        text-align: center;
        font-size: 10px;
    }
</style>
<h1>Calificaciones</h1>
<?php foreach ($data as $dPensum) { ?>
    <h2><?php
    $pensum = $dPensum['pensum'];
    echo $pensum
    ?></h2>
    <?php
    $dSemestres = $dPensum['semestres'];
    foreach ($dSemestres as $dSemestre) {
        ?>
        <h3 >Semestre <?php
        $semestre = $dSemestre['semestre'];
        echo $semestre->getNumero();
        ?></h3>
        <table class="verHorizontal" style="width: 90%">
            <thead>
            <th>Asignatura</th>
            <th class="small">Parcial 1</th>
            <th class="small">Parcial 2</th>
            <th class="small">Parcial 3</th>
            <th class="small">Definitiva</th>
            <th class="small">Asistencia</th>
            <th class="small">Nivelacion</th>
            <th class="small">Periodo</th>
            <th class="small">Aprobado</th>
            <th class="small">Homologado</th>
        </thead>
        <tbody>
            <?php
            $dAsignaturas = $dSemestre['asignaturas'];
            foreach ($dAsignaturas as $dAsignatura) {
                $asignatura = $dAsignatura['asignatura'];
                $dNotas = $dAsignatura['notas'];

                if ($dNotas->count() > 0) {
                    $n=0;
                    foreach ($dNotas as $dNota) {
                        
                        ?>
                        <tr <?php echo $n>0 ? 'class="old"' : '' ?>>
                            <td><?php echo $asignatura ?></td>
                            <td><?php echo $dNota['parcial1'] ?></td>
                            <td><?php echo $dNota['parcial2'] ?></td>
                            <td><?php echo $dNota['parcial3'] ?></td>
                            <td><?php echo $dNota['nota'] ?></td>
                            <td><?php echo $dNota['asistencia'] ?></td>
                            <td><?php echo $dNota['nivelacion'] ?></td>
                            <td class="medium"><?php echo $dNota['periodo'] ?></td>
                            <td class="small"><?php echo $dNota['aprobada']==1 ? "Aprobada":"Reprobada" ?></td>
                            <td class="small"><?php echo $dNota['homologacion'] == 1 ? "Homologada":"" ?></td>
                        </tr>
                    <?php $n++; } ?>
                <?php } else { ?>
                    <tr>
                        <td><?php echo $asignatura ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </body>
        </table>
    <?php } ?>
<?php } ?>
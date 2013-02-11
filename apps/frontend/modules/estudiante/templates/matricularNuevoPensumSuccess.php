<h1>Agregar Estudiante a Nuevo Pensum</h1>
<a href="<?php echo url_for('estudiante/index') ?>" class="button back">Volver</a>
<br />
<br />
<b>Estudiante: </b><?php echo $estudiante->getUsuario() ?><br />
<b>Código: </b><?php echo $estudiante->getCodigoEstudiante() ?><br />
<?php if($periodos->count()>0){ ?>
<br />Ingrese los datos de matrícula del estudiante:
<br /><br />
<form action="<?php echo url_for('estudiante/matricular') ?>" method="post">
    <input name="usuario" type="hidden" value="<?php echo $estudiante->getIdUsuario() ?>" />
    <b>Periodo: </b>
    <select name="periodo">
        <?php
        foreach ($periodos as $periodo) {
            ?>
            <option value="<?php echo $periodo->getIdPeriodoAcademico() ?>"><?php echo $periodo ?></option>
        <?php } ?>
    </select>
    <br />
    <b>Jornada: </b>
    <select name="jornada">
        <?php
        foreach ($jornadas as $jornada) {
            ?>
            <option value="<?php echo $jornada->getIdJornada() ?>"><?php echo $jornada ?></option>
        <?php } ?>
    </select>
    <br />
    <b>Tipo de Pago: </b>
    <select name="pago">
        <?php
        foreach ($tipoPagos as $tipo) {
            ?>
            <option value="<?php echo $tipo->getIdTipoPago() ?>"><?php echo $tipo ?></option>
        <?php } ?>
    </select>
    <br />
    <br />
    <input type="submit" value="Matricular" />
</form>
<?php }else{ ?>
<br />
No existen periodos disponibles para este estudiante.
<?php } ?>
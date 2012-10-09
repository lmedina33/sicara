<?php
slot('title', 'Cursos Empresariales Disponibles')
?>
<h1>Cursos Empresariales Disponibles</h1>
<p>Seleccione el curso en el cual está interesado en inscribirse.</p>
<p>Si no encuentra en el listado la empresa o el curso al cual quiere inscribirse, por favor póngase en contacto con nosotros vía telefónica.</p>

<?php
$empresa = "";
foreach ($cur_cursos as $curso) {
    if ($curso->getCurEmpresa()->getNombre() != $empresa) {
        $empresa = $curso->getCurEmpresa()->getNombre();
        ?>
        <hr />
        <h2><?php echo $empresa ?></h2>
    <?php } ?>
    <div class="curNombre">
        <img src="/images/iconos/avion.png" /><?php echo $curso->getNombre() ?>:
    </div>
    <div class="curDatos">
        <?php if ($curso->getDuracion() != null && $curso->getDuracion() != "") { ?>
            <br />
            <label>Duración:</label> <?php echo $curso->getDuracion() ?>
        <?php } ?>
        <?php if ($curso->getFechaInicio() != null && $curso->getFechaInicio() != "") { ?>
            <br />
            <label>Fecha de Inicio:</label> <?php echo $curso->getFechaInicio() ?>
        <?php } ?>
        <?php if ($curso->getFechaFin() != null && $curso->getFechaFin() != "") { ?>
            <br />
            <label>Fecha de Finalización:</label> <?php echo $curso->getFechaFin() ?>
        <?php } ?>
        <?php if ($curso->getHorario() != null && $curso->getHorario() != "") { ?>
            <br />
            <label>Horario:</label> <?php echo $curso->getHorario() ?>
        <?php } ?>
        <br />
        <a class="inscribir" href="<?php echo url_for('curFormulario/registrar?curso=' . $curso->getIdCurCurso()) ?>"><img src="/images/iconos/inscribirBig.png" />Inscribir</a>
    </div>
    <br />

<?php } ?>
<br />
<br />
<br />
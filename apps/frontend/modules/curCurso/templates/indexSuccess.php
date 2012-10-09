<?php
slot('title', 'Cursos Empresariales')
?>

<h1>Cursos Empresariales</h1>

<script>
        
    function showCursos(id){
        $('#cursos_'+id).show('normal');
        
        $('#verCursos_'+id).attr('href',"javascript: hideCursos("+id+")");
        $('#verCursos_'+id).html('<img src="/images/iconos/seeMinus.png" />Ocultar Cursos');
    }
        
    function hideCursos(id){
        $('#cursos_'+id).hide('normal');
        
        $('#verCursos_'+id).attr('href',"javascript: showCursos("+id+")");
        $('#verCursos_'+id).html('<img src="/images/iconos/seePlus.png" />Ver Cursos');
    }
</script>
<a href="<?php echo url_for('curEmpresa/new') ?>" class="button new">Crear Nueva Empresa</a>
<a href="<?php echo url_for('curCurso/new') ?>" class="button new">Crear Nuevo Curso</a>

<?php
$n = 0;
foreach ($empresas as $empresa) {
    ?>
    <h2><?php echo $empresa->getNombre() ?></h2>
    <?php if(count($cursos[$n]) == 0){ ?>
    Esta empresa no tiene cursos disponibles.
    <?php }else{ ?>
    <a id="verCursos_<?php echo $empresa->getIdCurEmpresa() ?>" href="javascript: showCursos('<?php echo $empresa->getIdCurEmpresa() ?>')"><img src="/images/iconos/seePlus.png" />Ver Cursos</a> <small> ( <?php echo (count($cursos[$n]) == 1 ? count($cursos[$n])." disponible": count($cursos[$n])." disponibles") ?> )</small>
    <?php } ?>
    <br />
    <br />
    <div id="cursos_<?php echo $empresa->getIdCurEmpresa() ?>" style="display:none; floar:left">
    <?php foreach($cursos[$n] as $curso){ ?>
    <div class="curNombre">
        <?php echo $curso->getNombre() ?>:
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
            <label>Inscritos:</label> <?php echo $curso->getCurFormulario()->count() ?> <a href="<?php echo url_for('curCurso/verInscritos?id='.$curso->getIdCurCurso()) ?>"><img src="/images/iconos/listarSmall.png" /></a>
        <br />
        <br />
    </div>
    <?php } 
    $n++;
    ?>
    </div>
    <hr />
<?php } ?>



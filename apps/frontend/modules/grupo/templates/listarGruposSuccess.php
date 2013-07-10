<?php
slot('title', 'Listar Grupos')
?>
<script type="text/javascript">
    $(document).ready(function(){
        
    });
    
    function showPasados(){
        $('#pasados').show('normal');
        $('#bPasados').attr('href','javascript:hidePasados()');
        $('#bPasados span').html('Ocultar Pasados');
    }
    
    function hidePasados(){
        $('#pasados').hide('normal');
        $('#bPasados').attr('href','javascript:showPasados()');
        $('#bPasados span').html('Ver Pasados');
    }
    
    function showFuturos(){
        $('#futuros').show('normal');
        $('#bFuturos').attr('href','javascript:hideFuturos()');
        $('#bFuturos span').html('Ocultar Futuros');
    }
    
    function hideFuturos(){
        $('#futuros').hide('normal');
        $('#bFuturos').attr('href','javascript:showFuturos()');
        $('#bFuturos span').html('Ver Futuros');
    }
</script>
<h1>Listar Grupos</h1>
<?php if($gruposAnteriores->count()!=0){ ?>
<a id="bPasados" href="javascript:showPasados()" class="button detail">Ver Pasados</a>
<?php } ?>
<?php if($gruposFuturos->count()!=0){ ?>
<a id="bFuturos" href="javascript:showFuturos()" class="button detail">Ver Futuros</a>
<?php } ?>
<?php if($gruposAnteriores->count() == 0 && $gruposVigentes->count() == 0 && $gruposFuturos->count() ==0){ ?>
Usted no tiene ningún grupo asignado.
<?php }else{ ?>
    <?php if($gruposAnteriores->count()!=0){ ?>
        <div id="pasados" style="display: none">
            <h2>Grupos Pasados</h2>
            <table class="verHorizontal" style="color: #555; width: 90%">
                <thead>
                    <th>Periodo</th>
                    <th>Asignatura</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Inicio Calificación</th>
                    <th>Fin Calificación</th>
                    <th></th>
                </thead>
                <tbody>
                <?php foreach($gruposAnteriores as $grupo){ ?>
                    <tr>
                        <td><?php echo $grupo->getPeriodoAcademico() ?></td>
                        <td><?php echo $grupo->getAsignatura() ?></td>
                        <td><?php echo $grupo->getNombre() ?></td>
                        <td><?php echo $grupo->getFechaInicio() ?></td>
                        <td><?php echo $grupo->getFechaFin() ?></td>
                        <td><?php echo $grupo->getInicioCalificacion() ?></td>
                        <td style="color: red"><?php echo $grupo->getFinCalificacion() ?></td>
                        <td><a href="<?php echo url_for('grupo/verGrupo?id='.$grupo->getIdGrupo()) ?>"><img src="/images/iconos/ver.png" /></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php if($gruposVigentes->count()!=0){ ?>
        <div id="vigentes">
            <h2>Grupos Vigentes</h2>
            <table class="verHorizontal" style="width: 90%">
                <thead>
                    <th>Periodo</th>
                    <th>Asignatura</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Inicio Calificación</th>
                    <th>Fin Calificación</th>
                    <th></th>
                </thead>
                <tbody>
                <?php foreach($gruposVigentes as $grupo){ ?>
                    <tr>
                        <td><?php echo $grupo->getPeriodoAcademico() ?></td>
                        <td><?php echo $grupo->getAsignatura() ?></td>
                        <td><?php echo $grupo->getNombre() ?></td>
                        <td><?php echo $grupo->getFechaInicio() ?></td>
                        <td><?php echo $grupo->getFechaFin() ?></td>
                        <td><?php echo $grupo->getInicioCalificacion() ?></td>
                        <td style="color: orange"><?php echo $grupo->getFinCalificacion() ?></td>
                        <td><a href="<?php echo url_for('grupo/verGrupo?id='.$grupo->getIdGrupo()) ?>"><img src="/images/iconos/ver.png" /></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php if($gruposFuturos->count()!=0){ ?>
        <div id="futuros" style="display: none">
            <h2>Grupos Futuros</h2>
            <table class="verHorizontal" style="width: 90%">
                <thead>
                    <th>Periodo</th>
                    <th>Asignatura</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Inicio Calificación</th>
                    <th>Fin Calificación</th>
                    <th></th>
                </thead>
                <tbody> 
                <?php foreach($gruposFuturos as $grupo){ ?>
                    <tr>
                        <td><?php echo $grupo->getPeriodoAcademico() ?></td>
                        <td><?php echo $grupo->getAsignatura() ?></td>
                        <td><?php echo $grupo->getNombre() ?></td>
                        <td><?php echo $grupo->getFechaInicio() ?></td>
                        <td><?php echo $grupo->getFechaFin() ?></td>
                        <td><?php echo $grupo->getInicioCalificacion() ?></td>
                        <td style="color: orange"><?php echo $grupo->getFinCalificacion() ?></td>
                        <td><a href="<?php echo url_for('grupo/verGrupo?id='.$grupo->getIdGrupo()) ?>"><img src="/images/iconos/ver.png" /></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
<?php } ?>

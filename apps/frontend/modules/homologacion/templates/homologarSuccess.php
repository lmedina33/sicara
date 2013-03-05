<?php
slot('title', 'Homologar Asignaturas')
?>
<script>
    $(function() {
        $("#form").validationEngine();
    });
    
    function loadNota(id){
        $.post('<?php echo url_for('homologacion/getNota') ?>',
        { 
            codigo: $('#nombre_'+id).val(),
            id_usu: <?php echo $homologacion->getIdUsuario() ?>
        } , function(nota){
            $('#nota_'+id).val(nota);
        });
        //        alert($('#nombre_'+id).val());
    }
    
    function ignorar(id){
        $('#data_'+id).css('color','#aaaaaa');
        
        $('#data_'+id+' input').val('');
        $('#data_'+id+' select').val('');
        
        $('#data_'+id+' input').attr('readonly','readonly');
        $('#data_'+id+' select').attr('disabled','disabled');
        
        $('#nombre_'+id).attr('name','');
        $('#nota_'+id).attr('name','');
        $('#nota_aprob_'+id).attr('name','');
        $('#observaciones_'+id).attr('name','');
        
        $('#nombre_'+id).removeClass('validate[required]');
        $('#nota_'+id).removeClass('validate[required,custom[number]]');
        $('#nota_aprob_'+id).removeClass('validate[required,custom[number]]');
        
        $('#btn_ignorar_'+id).attr('href',"javascript: incluir('"+id+"')");
        $('#btn_ignorar_'+id).html('<img src="/images/iconos/addSmall.png" />');
    }
    
    function incluir(id){
        $('#data_'+id).css('color','#000000');
        
        $('#data_'+id+' input').removeAttr('readonly');
        $('#data_'+id+' select').removeAttr('disabled');
        
        $('#nombre_'+id).attr('name','nombre_'+id);
        $('#nota_'+id).attr('name','nota_'+id);
        $('#nota_aprob_'+id).attr('name','nota_aprob_'+id);
        $('#observaciones_'+id).attr('name','observaciones_'+id);
        
        $('#nombre_'+id).addClass('validate[required]');
        $('#nota_'+id).addClass('validate[required,custom[number]]');
        $('#nota_aprob_'+id).addClass('validate[required,custom[number]]');
        
        $('#btn_ignorar_'+id).attr('href',"javascript: ignorar('"+id+"')");
        $('#btn_ignorar_'+id).html('<img src="/images/iconos/removeSmall.png" />');
    }
</script>

<style>
    .tabla_homolog{
        width: 80%;
    }

    .tabla_homolog th{
        border-bottom: solid 1px #ccc;
        padding: 5px;
        text-align: center;
    }

    .tabla_homolog td{
        padding: 5px;
        background-color: #EEF;
    }

</style>

<h1>Homologar Asignaturas</h1>
<a href="<?php echo url_for('homologacion/index') ?>" class="button back">Volver</a>
<h2>Datos del Homologante</h2>
<b>Nombre:</b> <?php echo $homologacion->getUsuario() ?><br />
<b>Documento:</b> <?php echo $homologacion->getUsuario()->getDocumento() ?> <?php echo $homologacion->getUsuario()->getTipoDocumento() ?><br />
<h2>Datos de Homologación</h2>
<?php if ($homologacion->getIsInterna() == 1) { ?>
    <b>Institución Origen*:</b> Escuela Aeronáutica de Colombia<br />
    <b>Programa Origen*:</b> <?php echo $homologacion->getPensumOrigen() ?><br />
    <small>* Homologación Interna</small><br />
<?php } else { ?>
    <b>Institución Origen:</b> <?php echo $homologacion->getInstitucionOrigen() ?><br />
    <b>Programa Origen:</b> <?php echo $homologacion->getProgramaOrigen() ?><br />
<?php } ?>
<br />
<b>Programa a Homologar:</b> <?php echo $homologacion->getPensumDestino() ?><br />
<b>Nota Aprobatoria:</b> <?php echo $homologacion->getNotaAprobatoria() ?><br />
<br />
<b>Observaciones:</b><br />
<div style="border: dashed 1px #ccc">
    <?php echo html_entity_decode($homologacion->getObservaciones()) ?><br />
</div>

<form id="form" action="<?php echo url_for('homologacion/guardarHomo') ?>">
    <input type="hidden" name="id_homologacion" value="<?php echo $homologacion->getIdHomologacion() ?>" />
    <?php
    $n = 0;
    if ($asignaturasCursadas->count() > 0) {
        ?>
        <h2>Asignaturas Cursadas</h2>
        <?php foreach ($semestres as $semestre) { ?>
            <?php $asignaturas = $asignaturasCursadas[$semestre->getNumero()]; ?>
            <?php if ($asignaturas->count() > 0) { ?>
                <table class="tabla_homolog">
                    <tr>
                        <th colspan="4" style="text-align: left">Semestre <?php echo $semestre->getNumero() ?></th>
                    </tr>
                    <tr>
                        <th>Asignatura</th>
                        <th>Nota Obtenida</th>
                        <th>Nota Aprobatoria</th>
                    </tr>
                    <?php
                    foreach ($asignaturas as $asignatura) {
                        $n++;
                        ?>
                        <tr>
                            <td style="width: 50%"><?php echo $asignatura->getCodigoAsignatura() . " :: " . $asignatura->getAsignatura()->getNombre() ?></td>
                            <td><?php echo $asignatura->getNotaAsignaturaCursada() ?></td>
                            <td><?php echo $asignatura->getNotaAprobatoria() ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        <?php } ?>
        <?php if ($n == 0) echo "Ninguna disponible."; ?>
    <?php } ?>

    <?php
    $n = 0;
    if ($asignaturasHomologadas->count() > 0) {
        ?>
        <h2>Asignaturas Homologadas</h2>
        <?php foreach ($semestres as $semestre) { ?>
            <?php $asignaturas = $asignaturasHomologadas[$semestre->getNumero()]; ?>
            <?php if ($asignaturas->count() > 0) { ?>
                <table class="tabla_homolog">
                    <tr>
                        <th colspan="4" style="text-align: left">Semestre <?php echo $semestre->getNumero() ?></th>
                    </tr>
                    <tr>
                        <th>Asignatura</th>
                        <th>Nota Obtenida</th>
                        <th>Nota Aprobatoria</th>
                    </tr>
                    <?php
                    foreach ($asignaturas as $asignatura) {
                        $n++;
                        ?>
                        <tr>
                            <td style="width: 50%"><?php echo $asignatura->getCodigoAsignatura() . " :: " . $asignatura->getAsignatura()->getNombre() ?></td>
                            <td><?php echo $asignatura->getNotaAsignaturaCursada() ?></td>
                            <td><?php echo $asignatura->getNotaAprobatoria() ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        <?php } ?>
        <?php if ($n == 0) echo "Ninguna disponible."; ?>
    <?php } ?>

    <?php if ($homologacion->getIsOficializado() != 1) { ?>
        <?php
        $n = 0;
        if ($asignaturasHomologables->count() > 0) {
            ?>
            <h2>Asignaturas a Homologar</h2>
            <?php foreach ($semestres as $semestre) { ?>
                <?php $asignaturas = $asignaturasHomologables[$semestre->getNumero()]; ?>
                <?php if ($asignaturas->count() > 0) { ?>
                    <table class="tabla_homolog">
                        <tr>
                            <th colspan="5" style="text-align: left">Semestre <?php echo $semestre->getNumero() ?></th>
                        </tr>
                        <tr>
                            <th>Asignatura</th>
                            <th>Asignatura de Origen</th>
                            <th>Nota Obtenida</th>
                            <th>Nota Aprobatoria</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                        <?php
                        foreach ($asignaturas as $asignatura) {
                            $n++;
                            ?>
                            <tr id="data_<?php echo $asignatura['codigoOr'] ?>">
                                <td style="width: 30%"><?php echo $asignatura['codigoOr'] . " :: " . $asignatura['nombreOr'] ?></td>
                                <?php if ($homologacion->getIsInterna() == 1) { ?>
                                    <td><select id="nombre_<?php echo $asignatura['codigoOr'] ?>" class="validate[required]" name="nombre_<?php echo $asignatura['codigoOr'] ?>" onChange="javascript: loadNota('<?php echo $asignatura['codigoOr'] ?>')">
                                            <option value="">Seleccione...</option>
                                            <?php foreach ($options as $option) { ?>
                                                <?php if ($asignatura['homologada'] == 1) { ?>
                                                    <?php if ($asignatura['nombre'] == $option['codigo']) { ?>
                                                        <option value="<?php echo $option['codigo'] ?>" selected><?php echo $option['nombre'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $option['codigo'] ?>"><?php echo $option['nombre'] ?></option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option value="<?php echo $option['codigo'] ?>"><?php echo $option['nombre'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </selector></td>
                                <?php } else { ?>
                                    <td><input id="nombre_<?php echo $asignatura['codigoOr'] ?>" type="text" size="20" class="validate[required]" name="nombre_<?php echo $asignatura['codigoOr'] ?>" value="<?php echo $asignatura['nombre'] ?>"></td>
                                <?php } ?>
                                <?php if ($asignatura['homologada'] == 1) { ?>
                                    <td><input id="nota_<?php echo $asignatura['codigoOr'] ?>" type="text" size="8" class="validate[required,custom[number]]" name="nota_<?php echo $asignatura['codigoOr'] ?>" value="<?php echo $asignatura['calificacion'] ?>"></td>
                                    <td><input id="nota_aprob_<?php echo $asignatura['codigoOr'] ?>" type="text" size="8" class="validate[required,custom[number]]" name="nota_aprob_<?php echo $asignatura['codigoOr'] ?>" value="<?php echo $asignatura['notaAprob'] ?>"></td>
                                    <td><input id="observaciones_<?php echo $asignatura['codigoOr'] ?>" type="text" size="20" name="observaciones_<?php echo $asignatura['codigoOr'] ?>" value="<?php echo $asignatura['observaciones'] ?>"></td>

                                <?php } else { ?>
                                    <td><input id="nota_<?php echo $asignatura['codigoOr'] ?>" type="text" size="8" class="validate[required,custom[number]]" name="nota_<?php echo $asignatura['codigoOr'] ?>"></td>
                                    <td><input id="nota_aprob_<?php echo $asignatura['codigoOr'] ?>" type="text" size="8" class="validate[required,custom[number]]" name="nota_aprob_<?php echo $asignatura['codigoOr'] ?>" value="<?php echo $homologacion->getNotaAprobatoria() ?>"></td>
                                    <td><input id="observaciones_<?php echo $asignatura['codigoOr'] ?>" type="text" size="20" name="observaciones_<?php echo $asignatura['codigoOr'] ?>"></td>

                                <?php } ?>
                                <td><a id="btn_ignorar_<?php echo $asignatura['codigoOr'] ?>" href="javascript: ignorar('<?php echo $asignatura['codigoOr'] ?>')" style="text-decoration: none"><img src="/images/iconos/removeSmall.png" /></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br />
                    <br />
                    <br />
                <?php } ?>
                <?php if ($n == 0) echo "Ninguna disponible."; ?>
            <?php } ?>
        <?php } ?>
                    <input type="submit" value="Guardar" />
    <?php } ?>
    
</form>            
<br />
<br />
<br />

<?php
slot('title', 'Homologar Asignaturas')
?>
<script>
    $(function() {
        $("#form").validationEngine();
        
        $("#ins_origen_110201")
        .autocomplete('/frontend_dev.php/refElemento/findUsuarios', $.extend({}, {
            dataType: 'json',
            parse: function(data) {
                var parsed = [];
                for (key in data) {
                    parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
                }
                return parsed;
            }
        }, { }))
        .result(function(event, data) { jQuery("#ins_origen_110201").val(data[0]); }); 
        
<?php
foreach ($asignaturasHomolog as $asigna) {
    ?>
                $("#form_<?php echo $asigna["codigo"] ?> form").validationEngine();
                calcularTotales('<?php echo $asigna["codigo"] ?>');
    <?php
}
?>
        $('.pensum_interno').each(function(){
            $(this).change(function(){
                nombre=$(this).attr('name');
                aux=$(this).val().split(" # ");
                $('#prog_origen_'+nombre).val(aux[1]);
                $.post('<?php echo url_for('homologacion/getAsignatura') ?>', 
                {
                    pensum: aux[0]
                }, function(data){
                    if(data.length!=0){
                        html="<option>Seleccione...</option>";
                        for(i=0;i<data.length;i++){
                            html+="<option value='"+data[i]['codigo']+"' name='"+data[i]['value']+"'>"+data[i]['label']+"</option>";
                        }
                        $("#asignatura_interna_"+nombre).html(html);
                        $('#asignatura_interna_'+nombre).show('normal');
                        $('#prog_origen_'+nombre).hide('normal');
                    }else{
                        $("#asignatura_interna_"+nombre).html('<option>Seleccione...</option>');
                    }
                }, 'json')
            });
        });
        
        $('.asignatura_interna').change(function(){
            nombre=$(this).attr('name');
            codigo=$(this).val();
            $('#origen_'+$(this).attr('name')).val($('#asignatura_interna_'+nombre+' option:selected[selected]').attr('name'));
            $('#origen_'+$(this).attr('name')).hide('normal');
            $.post('<?php echo url_for('homologacion/getNota') ?>', 
            {
                codigo: codigo,
                id_usu: <?php echo $homologacion->getIdUsuario() ?>
            }, function(data){
                if(data != ""){
                    aux=data.split("-");
                    $('#nota_'+nombre).val(aux[0]);
                    $('#nota_aprob_'+nombre).val(aux[1]);
                }else{
                    $('#nota_'+nombre).val('');
                    $('#nota_aprob_'+nombre).val('');
                }
            }, 'text');
        });
        
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
    
    function showForm(codigo){
        $('#form_'+codigo).show('normal');
    }
    
    function hideForm(codigo){
        $('#form_'+codigo).hide('normal');
        $("#form_"+codigo+" form").validationEngine('hide');
    }
    
    function validarNota(codigo){
        $('#form_'+codigo+' .nota').attr('class','nota validate[required,custom[number],min['+$('#form_'+codigo+' .nota_aprob').val()+']]');
    }
    
    function agregar(codigo){
        if($("#form_"+codigo+" form").validationEngine('validate')){
            insOrigen=$('#ins_origen_'+codigo).val();
            progOrigen=$('#prog_origen_'+codigo).val();
            asOrigen=$('#origen_'+codigo).val();
            nota_aprob=$('#nota_aprob_'+codigo).val();
            nota=$('#nota_'+codigo).val();
            obs=$('#observaciones_'+codigo).val();
            porcentaje=$('#porcentaje_'+codigo).val();
            
            $.post('<?php echo url_for('homologacion/guardarAsignatura') ?>',
            {
                id_hom: <?php echo $homologacion->getIdHomologacion() ?>,
                codigo_as : codigo,
                ins_origen: insOrigen,
                prog_origen: progOrigen,
                as_origen: asOrigen,
                nota: nota,
                nota_aprob: nota_aprob,
                obs: obs,
                porcentaje: porcentaje
            },
            function(data){
                if(data.lenght != 0){
                    html='<tr id="origen_'+data['id']+'">\n\
            <td>'+insOrigen+'</td>\n\
            <td>'+progOrigen+'</td>\n\
            <td>'+asOrigen+'</td>\n\
            <td class="nota_aprob_or">'+nota_aprob+'</td>\n\
            <td class="nota_or">'+nota+'</td>\n\
            <td class="porcentaje_or">'+porcentaje+' %</td>\n\
            <td>'+obs+'</td>\n\
            <td><a href="javascript: borrar('+data['id']+',\''+codigo+'\')"><img src="/images/iconos/removeSmall.png" /></a></td>\n\
        </tr>';
                                $('#origenes_'+codigo+' tbody').append(html);
                                calcularTotales(codigo);
                            }else{
                                alert("No se pudo agregar estos datos.");
                            }
                            limpiar(codigo);    
                        },
                        'json');
                        hideForm(codigo);
                    }
                }
                
                function limpiar(codigo){
                    $('#form_'+codigo+' .nombre').val('');
                    $('#form_'+codigo+' .nota').val('');
                    $('#form_'+codigo+' .obs').val('');
                    $('#form_'+codigo+' .porcentaje').val('');
                }
    
                function borrar(id,codigo){
                    if(confirm('Esta seguro de querer borrar estos datos?')){
                        $.post(
                        '<?php echo url_for('homologacion/borrarAsignatura') ?> ',
                        {
                            id: id
                        },function(data){
                            if(data=='borrado'){
                                alert('Asignatura eliminada.');
                                $('#origen_'+id).remove();
                                calcularTotales(codigo);
                            }else{
                                alert('No se pudo borrar la asignatura.');
                            }
                        },'text'
                    );
                    }
                }
    
                function calcularTotales(codigo){
                    total=0;
                    $('#origenes_'+codigo+' .nota_or').each(function(){
                        total+=parseFloat($(this).html())*parseFloat($(this).parent('tr').children('.porcentaje_or').html())/100;
                    });
                    total=Math.round(total*100)/100;
                    
        
                    porcentaje=0;
                    $('#origenes_'+codigo+' .porcentaje_or').each(function(){
                        porcentaje+=parseFloat($(this).html());
                    });
                    $('#origenes_'+codigo+' .porcentaje_or_tot').html(porcentaje+" %");
                    $('#origenes_'+codigo+' .porcentaje_or_tot_par').html(porcentaje+" %");
        
                    porcentaje=Math.round(porcentaje*100)/100;
                    if(porcentaje!=100){
                        $('#origenes_'+codigo+' .porcentaje_or_tot').css('color', 'red');
                    }else{
                        $('#origenes_'+codigo+' .porcentaje_or_tot').css('color', 'darkgreen');
                    }
        
                    aprobatoria=0;
                    $('#origenes_'+codigo+' .nota_aprob_or').each(function(){
                        aprobatoria+=parseFloat($(this).html())*parseFloat($(this).parent('tr').children('.porcentaje_or').html())/100;
                    });
                    aprobatoria=Math.round(aprobatoria*100)/100;
                    
                    aprobatoriaDest=<?php echo $homologacion->getPensumDestino()->getNotaAprobatoria() ?>;
                    
                    $('#origenes_'+codigo+' .nota_aprob_or_tot').html(aprobatoriaDest);
                    $('#origenes_'+codigo+' .nota_aprob_or_tot_par').html(aprobatoria);
                    
                    notaFinal=0;
                    if(aprobatoria!=0)
                        notaFinal=(aprobatoriaDest*total)/aprobatoria;
                    
                    $('#origenes_'+codigo+' .nota_or_tot').html(notaFinal);
                    $('#origenes_'+codigo+' .nota_or_tot_par').html(total);
                    
                    if(porcentaje>=100){
                        hideForm(codigo);
                        $('#addAsignaturaHom_'+codigo).hide();
                    }else{
                        $('#addAsignaturaHom_'+codigo).show();
                    }
                }
                
                function showOrigenes(codigo){
                    $('.especificacion.'+codigo).show('normal');
                    $('#boton_showOr_'+codigo).attr('href','javascript: hideOrigenes("'+codigo+'")');
                    $('#boton_showOr_'+codigo+' img').attr('src','/images/iconos/seeMinus.png');
                }
                
                function hideOrigenes(codigo){
                    $('.especificacion.'+codigo).hide('normal');
                    $('#boton_showOr_'+codigo).attr('href','javascript: showOrigenes("'+codigo+'")');
                    $('#boton_showOr_'+codigo+' img').attr('src','/images/iconos/seePlus.png');
                }
                
                function hacerInterna(codigo){
                    $('#ins_origen_'+codigo).val('Escuela Aeronáutica de Colombia');
                    $('#pensum_interno_'+codigo).show('normal');
                    $('#prog_origen_'+codigo).hide('normal');
                    $('#origen_'+codigo).hide('normal');
                    
                    $('#hacer_interna_'+codigo).html('Externa');
                    $('#hacer_interna_'+codigo).attr('href','javascript:hacerExterna("'+codigo+'")');
                }
                
                function hacerExterna(codigo){
                    $('#hacer_interna_'+codigo).html('Interna');
                    $('#hacer_interna_'+codigo).attr('href','javascript:hacerInterna("'+codigo+'")');
                    
                    $('#ins_origen_'+codigo).val('');
                    $('#pensum_interno_'+codigo).hide('normal');
                    $('#prog_origen_'+codigo).show('normal');
                    
                    $('#origen_'+codigo).show('normal');
                }
</script>

<style>

    .asignatura{
        margin-left: 10px;
        margin-bottom: 20px;
    }

    .tabla_homolog{
        width: 80%;
        margin-left: 20px;
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

    .formAddAsignatura{
        border: 1px dashed #ccc;
        margin-top: 10px; 
        margin-bottom: 10px;
        margin-left: 15px;
        display: none; 
        padding: 10px;
        padding-top: 0px;
        width: 360px;
    }

    .formAddAsignatura .close{
        position: relative;
        top: -10px;
        left: 360px;
    }

    .especificacion{
        font-size: 13px;
        font-style: italic;
        display: none;
    }

    .especificacion .nombre_esp{
        border-left: solid 20px #fff;
    }
</style>

<h1>Homologar Asignaturas</h1>
<a href="<?php echo url_for('homologacion/index') ?>" class="button back">Volver</a>
<h2>Datos del Homologante</h2>
<b>Nombre:</b> <?php echo $homologacion->getUsuario() ?><br />
<b>Documento:</b> <?php echo $homologacion->getUsuario()->getDocumento() ?> <?php echo $homologacion->getUsuario()->getTipoDocumento() ?><br />
<h2>Datos de Homologación</h2>

<br />
<b>Programa a Homologar:</b> <?php echo $homologacion->getPensumDestino() ?><br />
<br />
<b>Observaciones:</b><br />
<div style="border: dashed 1px #ccc">
    <?php echo html_entity_decode($homologacion->getObservaciones()) ?><br />
</div>

<!--<form id="form" action="<?php echo url_for('homologacion/guardarHomo') ?>">-->
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
                    <th></th>
                </tr>
                <?php
                foreach ($asignaturas as $asignatura) {
                    $n++;
                    ?>
                    <tr>
                        <td style="width: 50%"><?php echo $asignatura->getCodigoAsignatura() . " :: " . $asignatura->getAsignatura()->getNombre() ?></td>
                        <td><?php echo $asignatura->getNotaAsignaturaCursada() ?></td>
                        <td><?php echo $asignatura->getNotaAprobatoria() ?></td>
                        <td>
                            <?php if ($especificacionesHomologacion[$asignatura->getCodigoAsignatura()]->count() != 0) { ?>
                                <a id="boton_showOr_<?php echo $asignatura->getCodigoAsignatura() ?>" href="javascript: showOrigenes('<?php echo $asignatura->getCodigoAsignatura() ?>')"><img src="/images/iconos/seePlus.png" /></a>Origenes
                            <?php } ?>
                        </td>
                    </tr>
                    <?php foreach ($especificacionesHomologacion[$asignatura->getCodigoAsignatura()] as $especificacion) { ?>
                        <tr class="especificacion <?php echo $asignatura->getCodigoAsignatura() ?>">
                            <td class="nombre_esp" style="width: 50%"><?php echo $especificacion->getNombre() ?></td>
                            <td><?php echo $especificacion->getCalificacion() ?></td>
                            <td><?php echo $especificacion->getNotaAprobatoria() ?></td>
                            <td><?php echo $especificacion->getPorcentaje() ?> %</td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        <?php } ?>
    <?php } ?>
    <?php if ($n == 0) echo "Ninguna disponible."; ?>
<?php } ?>

<br />
<?php //if ($homologacion->getIsOficializado() != 1) { ?>
    <h2>Asignaturas Pendientes por Homologar</h2>
    <?php
    $numSem = 0;
    foreach ($asignaturasHomolog as $asigna) {
        ?>
        <?php
        if (intval($asigna['semestre']) != $numSem) {
            $numSem = intval($asigna['semestre'])
            ?>
            <hr />
            <h4>Semestre <?php echo $asigna['semestre'] ?></h4>
        <?php } ?>
        <div class="asignatura">
            Asignatura: <?php echo $asigna['codigo'] . " :: " . $asigna['nombre'] ?> &nbsp;&nbsp;&nbsp;<a id="addAsignaturaHom_<?php echo $asigna['codigo'] ?>" href="javascript: showForm('<?php echo $asigna['codigo'] ?>')"><img src="/images/iconos/addSmall.png" /></a><br />

            <div id="form_<?php echo $asigna['codigo'] ?>" class="formAddAsignatura">
                <a href="javascript:hideForm('<?php echo $asigna['codigo'] ?>')" class="close"><img src="/images/iconos/closeSmall.png" /></a>
                <br />
                <form>
                    Institución Origen: <input type="text" id="ins_origen_<?php echo $asigna['codigo'] ?>" class="ins_origen validate[required]" /> <a href="javascript: hacerInterna('<?php echo $asigna['codigo'] ?>')" id="hacer_interna_<?php echo $asigna['codigo'] ?>">Interna</a><br />
                    Programa Origen: <input type="text" id="prog_origen_<?php echo $asigna['codigo'] ?>" class="prog_origen validate[required]" />
                    <?php if($pensums->count() != 0){ ?>
                    <select id="pensum_interno_<?php echo $asigna['codigo'] ?>" name="<?php echo $asigna['codigo'] ?>" class="pensum_interno validate[required]" style="display:none">
                        <option>Seleccione...</option>
                        <?php foreach($pensums as $pensum){ ?>
                        <option value="<?php echo $pensum->getCodigoPensum()." # ".$pensum->getNombre() ?>"><?php echo $pensum ?></option>
                        <?php } ?>
                    </select>
                    <?php } ?><br />
                    Asignatura Origen: <input type="text" id="origen_<?php echo $asigna['codigo'] ?>" class="origen validate[required]" />
                    <?php if($pensums->count() != 0){ ?>
                    <select id="asignatura_interna_<?php echo $asigna['codigo'] ?>" name="<?php echo $asigna['codigo'] ?>" class="asignatura_interna validate[required]" style="display:none">
                        <option>
                    </select>
                    <?php } ?><br />
                    Nota Aprobatoria: <input type="text" id="nota_aprob_<?php echo $asigna['codigo'] ?>" class="nota_aprob validate[required,custom[number]]" value="" onKeyUp="javascript: validarNota('<?php echo $asigna['codigo'] ?>')"/><br />
                    Nota: <input type="text" id="nota_<?php echo $asigna['codigo'] ?>" class="nota validate[required,custom[number],min[0]]" /><br />
                    Observaciones: <input type="text" class="obs" id="observaciones_<?php echo $asigna['codigo'] ?>" /><br />
                    Porcentaje: <input type="text" id="porcentaje_<?php echo $asigna['codigo'] ?>" class="porcentaje validate[required,custom[number,min[0],max[100]]]" /><br />
                    <br />
                    <a href="javascript:agregar('<?php echo $asigna['codigo'] ?>')" class="button"><img src="/images/iconos/saveSmall.png" /> Guardar</a>
                </form>
            </div>
            <table id="origenes_<?php echo $asigna['codigo'] ?>" class="tabla_homolog">
                <thead>
                    <tr>
                        <th style="width: 20%">Institución Origen</th>
                        <th style="width: 20%">Programa Origen</th>
                        <th style="width: 20%">Asignatura Origen</th>
                        <th style="width: 5%">Nota Aprobatoria</th>
                        <th style="width: 5%">Nota Obtenida</th>
                        <th style="width: 5%">Porcentaje</th>
                        <th style="width: 20%">Observaciones</th>
                        <th style="width: 5%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($origenesHomologacion[$asigna['codigo']] as $origen) { ?>
                        <tr id="origen_<?php echo $origen['id'] ?>">
                            <td>
                                <?php echo $origen['ins_origen'] ?>
                            </td>
                            <td>
                                <?php echo $origen['prog_origen'] ?>
                            </td>
                            <td>
                                <?php echo $origen['origen'] ?>
                            </td>
                            <td class="nota_aprob_or">
                                <?php echo $origen['aprobatoria'] ?>
                            </td>
                            <td class="nota_or">
                                <?php echo $origen['calificacion'] ?>
                            </td>
                            <td class="porcentaje_or">
                                <?php echo $origen['porcentaje'] ?> %
                            </td>
                            <td>
                                <?php echo $origen['observaciones'] ?>
                            </td>
                            <td>
                                <a href="javascript: borrar(<?php echo $origen['id'] ?>,'<?php echo $asigna['codigo'] ?>')"><img src="/images/iconos/removeSmall.png" /></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align:right; background-color: #fff" colspan="3">
                            <b>Totales Parciales:</b>
                        </td>
                        <td class="nota_aprob_or_tot_par">
                        </td>
                        <td class="nota_or_tot_par">
                        </td>
                        <td class="porcentaje_or_tot_par">
                        </td>
                        <td style="background-color: #fff">
                        </td>
                        <td style="background-color: #fff">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right; background-color: #fff" colspan="3">
                            <b>Totales Definitivos:</b>
                        </td>
                        <td class="nota_aprob_or_tot">
                        </td>
                        <td class="nota_or_tot">
                        </td>
                        <td class="porcentaje_or_tot">
                        </td>
                        <td style="background-color: #fff">
                        </td>
                        <td style="background-color: #fff">
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php } ?>
<?php //} ?>
<br />
<br />
<br />

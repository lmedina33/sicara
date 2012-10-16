<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php
slot('title', 'Ver Hoja de Vida')
?>
<script>
    var fechas;
    $(document).ready(function(){
        
        fechasProx=new Array();
        fechasPas=new Array();
        fechasEje=new Array();
        
<?php
$i = 0;
foreach ($mantenimientosProx as $mantenimiento) {
    ?>
                fechasProx[<?php echo $i ?>]= "<?php echo date("Y", strtotime($mantenimiento->getFechaProgramada())) ?>"+"-"+"<?php echo intval(date("m", strtotime($mantenimiento->getFechaProgramada()))) - 1 ?>"+"-"+"<?php echo intval(date("d", strtotime($mantenimiento->getFechaProgramada()))) ?>";
    <?php
    $i++;
}
?>
            
<?php
$i = 0;
foreach ($mantenimientosPas as $mantenimiento) {
    ?>
                fechasPas[<?php echo $i ?>]= "<?php echo date("Y", strtotime($mantenimiento->getFechaProgramada())) ?>"+"-"+"<?php echo intval(date("m", strtotime($mantenimiento->getFechaProgramada()))) - 1 ?>"+"-"+"<?php echo intval(date("d", strtotime($mantenimiento->getFechaProgramada()))) ?>";
    <?php
    $i++;
}
?>
            
<?php
$i = 0;
foreach ($mantenimientosEje as $mantenimiento) {
    ?>
                fechasEje[<?php echo $i ?>]= "<?php echo date("Y", strtotime($mantenimiento->getFechaProgramada())) ?>"+"-"+"<?php echo intval(date("m", strtotime($mantenimiento->getFechaProgramada()))) - 1 ?>"+"-"+"<?php echo intval(date("d", strtotime($mantenimiento->getFechaProgramada()))) ?>";
    <?php
    $i++;
}
?>
        
        jQuery("#form").validationEngine();
        
        $('#form_add').hide();
        
        $('#detail_lugar').hide();
        
        tinyMCE.init({
            theme: "simple",
            mode: "textareas",
            width: "400",
            height: "100"
        });
        
        $( "#calMantenimiento" ).datepicker(
        {
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            buttonText: ['Ver Calendario...'],
            yearRange: 'c-1:c+2',
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            beforeShowDay: function(date) {
                data=new Array();
                data[0]=true;
                if(fechasProx.indexOf(date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate())!=-1){
                    data[1]="manttoProx";
                    data[2]="Mantenimiento próximo";
                }else if(fechasPas.indexOf(date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate())!=-1){
                    data[1]="manttoPas";
                    data[2]="Mantenimiento pasado";
                }else if(fechasEje.indexOf(date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate())!=-1){
                    data[1]="manttoEje";
                    data[2]="Mantenimiento ejecutado";
                }else{
                    data[1]="";
                    data[2]="";
                }
                
                return data;
            },
            onSelect: function(date){
                showMantenimiento(date);
            }
        });
        
    date=new Date();
    fecha="";
    fecha+=date.getFullYear()+"-";
    mes=date.getMonth()+1;
    if(mes<10)
        fecha+="0"+mes+"-";
    else
        fecha+=mes+"-";
    if(date.getDate()<10)
        fecha+="0"+date.getDate();
    else
        fecha+=date.getDate();
    showMantenimiento(fecha);
});
    
function showAdd(){
    $('#form_add').show('normal');
        
    $('#button_add').removeClass('add');
    $('#button_add').addClass('delete');
        
    $('#button_add').attr('onClick','javascript:hideAdd()');
    $('#button_add').attr('href','#button_add');
        
    $('#button_add span').html('Cancelar Adición de Registro');
}
    
function hideAdd(){
    $('#form_add').hide('normal');
        
    $('#button_add').removeClass('deleteadd');
    $('#button_add').addClass('add');
        
    $('#button_add').attr('onClick','javascript:showAdd()');
    $('#button_add').attr('href','#form_add');
        
    $('#button_add span').html('Agregar Registro');
}
    
function showDetailLugar(){
    $('#detail_lugar').show('normal');
        
    $('#button_detail_lugar img').attr('src','/images/iconos/seeMinus.png');
    $('#button_detail_lugar').attr('onClick','hideDetailLugar()');
}
    
function hideDetailLugar(){
    $('#detail_lugar').hide('normal');
        
    $('#button_detail_lugar img').attr('src','/images/iconos/seePlus.png');
    $('#button_detail_lugar').attr('onClick','showDetailLugar()');
}
    
function showMantenimiento(date){
    $("#descripcion").hide();
    $("#mantenimientos").html("<div class='cargando'>Cargando...</div>");
    $.post("<?php echo url_for("refHojaVida/getMantenimiento") ?>",
    {
        "id" : <?php echo $elemento->getIdRefElemento() ?>,
        "fecha" : date
    }, 
    function(data){            
        if(data == false){            
            html="<div class='fecha_mantto'>Fecha: "+date+"</div>";
                
            aux=date.split("-");
            f=new Date();
            now=new Date(f.getFullYear(),f.getMonth(),f.getDate());
            target=new Date(aux[0],parseInt(aux[1])-1,aux[2]);
            
            if(now <= target){
                html+="Sin mantenimiento programado.<br/>";
                html+="Registre un mantenimiento para este día:<br /><br />";
                html+="<div class='titulo_mantto'><b>Nombre:</b> <input id='nombre_mantto' type='text' name='nombre' /></div>";
                html+="<div class='titulo_mantto'><b>Descripción:</b><br /><textarea id='descripcion_mantto' name='descripcion' /></div>";
                html+="<input id='producto_mantto' type='hidden' value='<?php echo $elemento->getIdRefElemento(); ?>' />";
                html+="<input id='usuario_mantto' type='hidden' value='<?php echo sfContext::getInstance()->getUser()->getGuardUser()->getId(); ?>' />";
                html+="<br /><input value='Registrar' type='submit' onClick='registrarMantenimiento(\""+date+"\")' /></div>";
            }else{
                html+="No se realizó mantenimiento.<br/>";
            }
            $("#mantenimientos").html(html);
        }else{
            html="<div class='fecha_mantto'>Fecha: "+date+"</div>";
            html+="<div class='titulo_mantto'><b>Nombre:</b> "+data["nombre"]+"</div>";
            html+="<b class='tit_descripcion_mantto'>Descripción:</b><div class='descripcion_mantto'>"+data["descripcion"]+"</div>";
            html+="<div class='asignador_mantto'><b>Asignador:</b> "+data["asignador"]+"</div>";
            if(data["ejecutado"]==0){
                html+="<br /><hr /><br />Si el mantenimiento se realizó, registrelo a continuación:<br /><br />";
                $("#descripcion").show('normal');
                $("#registrar_ejecucion").attr('onClick','javascript:registrarEjecucion("'+date+'");');
            }else{
                html+="<div class='asignador_mantto'><b>Ejecutor:</b> "+data["ejecutor"]+"</div>";
                html+="<div class='asignador_mantto'><b>Fecha de Ejecución:</b> "+data["fecha"]+"</div>";
            }
            html+="</div>";
            $("#mantenimientos").html(html);
        }
    }
    , "json"  );
                
}
    
function registrarMantenimiento(date){
    $.post("<?php echo url_for("refHojaVida/addMantenimiento") ?>",
    {
        "nombre" : $("#nombre_mantto").val(),
        "descripcion" : $("#descripcion_mantto").val(),
        "producto" : $("#producto_mantto").val(),
        "usuario" : $("#usuario_mantto").val(),
        "fecha" : date
    }, 
    function(data){
        top.location="<?php echo url_for("refHojaVida/verByElemento?idEle=" . $elemento->getIdRefElemento()) ?>";
    }
    , "json"  );
}
    
function registrarEjecucion(date){
    $.post("<?php echo url_for("refHojaVida/addEjecucion") ?>",
    {
        "actividades" : tinyMCE.get('descripcion_mantto').getContent(),
        "usuario" : <?php echo sfContext::getInstance()->getUser()->getGuardUser()->getId(); ?>,
        "producto" : <?php echo $elemento->getIdRefElemento(); ?>,
        "fecha" : date
    }, 
    function(data){
        top.location="<?php echo url_for("refHojaVida/verByElemento?idEle=" . $elemento->getIdRefElemento()) ?>";
    }
    , "json"  );
}
    
</script>

<h1>Hoja de Vida para <?php echo $elemento->getNombre() ?></h1>
<a href="<?php echo url_for('refElemento/index') ?>" class="button back">Volver</a>
<h2>Datos Generales</h2>
<table class="ver" style="float:left">
    <tbody>
        <tr>
            <th><label>Serial:</label></th>
            <td><?php echo $elemento->getSerial() ?></td>
        </tr>
        <tr>
            <th><label>Serial Interno:</label></th>
            <td><?php echo $elemento->getSerialInterno() ?></td>
        </tr>
        <tr>
            <th><label>Marca:</label></th>
            <td>
                <?php echo $elemento->getMarca() ?>
            </td>
        </tr>
        <tr>
            <th><label>Modelo:</label></th>
            <td>
                <?php echo $elemento->getModelo() ?>
            </td>
        </tr>
        <tr>
            <th><label>Descripción:</label></th>
            <td><?php echo str_replace("\n", "<br />", $elemento->getDescripcion()) ?></td>
        </tr>
        <tr>
            <th><label>Ubicación:</label></th>
            <td>
                <?php echo str_replace("\n", "<br />", $elemento->getUbicacion()) ?>
            </td>
        </tr>
        <tr>
            <th><label>Tipo de Elemento:</label></th>
            <td>
                <?php echo $elemento->getRefTipoElemento() ?>
            </td>
        </tr>
        <tr>
            <th><label>Lugar:</label></th>
            <td>
                <?php echo $elemento->getRefLugar()->getPath() ?>

                <?php if ($elemento->getRefLugar()->getDescripcion() != "" || $elemento->getRefLugar()->getUbicacion() != "") { ?>
                    <a href="#" id="button_detail_lugar" onClick="showDetailLugar()"><img src="/images/iconos/seePlus.png" /></a>
                <?php } ?>
                <div id="detail_lugar">
                    <small>
                        <?php if ($elemento->getRefLugar()->getDescripcion() != "") { ?>
                            <b>Descripción:</b> <?php echo $elemento->getRefLugar()->getDescripcion() ?><br />
                        <?php } ?>
                        <?php if ($elemento->getRefLugar()->getUbicacion() != "") { ?>
                            <b>Ubicación:</b> <?php echo $elemento->getRefLugar()->getUbicacion() ?>
                        <?php } ?>
                    </small>
                </div>
            </td>
        </tr>
        <tr>
            <th><label>Estado:</label></th>
            <td>
                <?php echo $elemento->getRefEstadoElemento() ?>
            </td>
        </tr>
        <tr>
            <th><label>Prestable:</label></th>
            <td>
                <?php echo ($elemento->getIsPrestable() == "1") ? "Si" : "No" ?>
            </td>
        </tr>
        <?php if ($elemento->getIsPrestable() == "1" && $elemento->getIdRefTipoSancion() != null) { ?>
            <tr>
                <th><label>Tipo de Sanción:</label></th>
                <td>
                    <?php echo $elemento->getRefTipoSancion() ?>
                </td>
            </tr>
            <tr>
                <th><label>Cantidad de Sanción:</label></th>
                <td><?php echo $elemento->getCantidadSancion() ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th><label>Responsable:</label></th>
            <td>
                <?php echo $elemento->getUsuarioResponsable() ?>
            </td>
        </tr>
    </tbody>
</table>
<?php if ($id_foto != "") { ?>
    <div style="float:left; margin-left: 20px; border: 1px dashed #ccc; padding: 5px;">
        <a href="#" onClick="window.open('<?php echo url_for('refElemento/showFoto?id=' . $id_foto) ?>','Foto de recurso','toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1,width=700,height=600')"><img src="<?php echo url_for('refElemento/renderFoto?id=' . $id_foto) ?>" width="256px" height="192px"/>
    </div>
    <div class="administracion" style="position: relative; top:-8px"><a onClick="javascript: return deleteFoto()" href="<?php echo url_for('refElemento/removeFoto?idEle=' . $elemento->getIdRefElemento() . '&id=') . $id_foto ?>"><img src="/images/iconos/removeSmall.png" /></a></div>
<?php } else { ?>
    <div style="float:left; margin-left: 20px; border: 1px dashed #ccc; padding: 5px; width:256px; height:192px; color: #ccc;" >
        <small>No hay foto disponible</small>
    </div>
<?php } ?>
<div style="clear:both"></div>
<br />
<a id="button_add" class="button add" href="#form_add" onClick="javascript: showAdd()">Agregar Registro</a>
<a class="button" href="<?php echo url_for("refHojaVida/generarHojaVida?idElem=" . $elemento->getIdRefElemento()) ?>" target="_blank"><img src="/images/iconos/pdfSmall.png" /> Generar PDF</a>
<h2>Mantenimientos Programados</h2>
<div class="mantenimientos" >
    <div id="mantenimientos">
    Mantenimientos no disponibles
    </div>
    <div id="descripcion" style="display:none">
        <b class='tit_descripcion_mantto'>Actividades Realizadas:</b>
        <textarea id="descripcion_mantto" ></textarea>
        <br />
        <input id="registrar_ejecucion" value='Registrar' type='submit' />
        <input type="hidden" id="fecha_mantto" />
    </div>
</div>
<div id="calMantenimiento"></div>
<div style="clear:both"></div>
<div id="form_add">
    <h2>Registro Nuevo</h2>
    <form id="form" action="<?php echo url_for('refHojaVida/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_ref_hoja_vida=' . $form->getObject()->getIdRefHojaVida() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
        <table width="100%">
            <tfoot>
                <tr>
                    <td>
                        <?php echo $form->renderHiddenFields(false) ?>
                    </td>
                    <td>
                        <input type="submit" value="Guardar" onClick="return confirm('Esta seguro de querer guardar este registro?, no podrá modificarlo.')" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php echo $form->renderGlobalErrors() ?>
                <tr>
                    <th>
                        <?php echo $form['descripcion']->renderLabel() ?><?php echo $form['descripcion']->renderError() ?>
            <div class="tip" title="Esta debe ser una descripción relacionada con algún cambio en el elemento y no puede ser modificado una vez registrado.<br />En caso de requerir especificar un cambio, debe agregar un nuevo registro."></div>
            </th>
            <td>
                <?php echo $form['descripcion'] ?>
            </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<br />


<div id="lista_registros">
    <h2>Registros Disponibles</h2>
    <?php if (count($registros) == 0) { ?>
        <div>Este elemento no tiene ningún registro aún.</div>
        <br />
        <br />
    <?php } else { ?>
        <div class="pagingBar">
            <?php
            if ($page != 1) {
                ?>
                <a class="pageBack" href="<?php echo url_for('refHojaVida/verByElemento?idEle=' . $elemento->getIdRefElemento() . '&page=' . ($page - 1)) ?>">Anterior</a>
                <?php
            }
            for ($i = 1; $i <= $lastPage; $i++) {
                if ($page != $i) {
                    ?>
                    <a class="pageNum" href="<?php echo url_for('refHojaVida/verByElemento?idEle=' . $elemento->getIdRefElemento() . '&page=' . ($i)) ?>"><?php echo $i ?></a>
                    <?php
                } else {
                    ?>
                    <div class="pageActual"><?php echo $i ?></div>
                    <?php
                }
            }
            if ($page < $lastPage) {
                ?>
                <a class="pageNext" href="<?php echo url_for('refHojaVida/verByElemento?idEle=' . $elemento->getIdRefElemento() . '&page=' . ($page + 1)) ?>">Siguiente</a>
                <?php
            }
            ?>
            <div style="float:right; margin-left: 5px; color: #888;"> Mostrando <?php echo $indicePrimero ?> a <?php echo $indiceUltimo ?> elementos de <?php echo $total ?> encontrados</div>
        </div>
        <hr style="position: relative; top:7px;">
        <br />
        <div class="page">
            <?php foreach ($registros as $registro) { ?>
                <div class="registro_ref_hoja_vida">
                    <div class="creador">Registrado por <?php echo $registro->getUsuarioCreador() ?></div>
                    <div class="fecha">Fecha y hora de registro: <?php echo $registro->getCreatedAt() ?></div>
                    <div class="descripcion">
                        <?php echo html_entity_decode($registro->getDescripcion()) ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($materialsShowed > ($limit / 2)) { ?>
            <br />
            <div class="pagingBar">
                <?php
                if ($page != 1) {
                    ?>
                    <a class="pageBack" href="<?php echo url_for('refHojaVida/verByElemento?idEle=' . $elemento->getIdRefElemento() . '&page=' . ($page - 1)) ?>">Anterior</a>
                    <?php
                }
                for ($i = 1; $i <= $lastPage; $i++) {
                    if ($page != $i) {
                        ?>
                        <a class="pageNum" href="<?php echo url_for('refHojaVida/verByElemento?idEle=' . $elemento->getIdRefElemento() . '&page=' . ($i)) ?>"><?php echo $i ?></a>
                        <?php
                    } else {
                        ?>
                        <div class="pageActual"><?php echo $i ?></div>
                        <?php
                    }
                }
                if ($page < $lastPage) {
                    ?>
                    <a class="pageNext" href="<?php echo url_for('refHojaVida/verByElemento?idEle=' . $elemento->getIdRefElemento() . '&page=' . ($page + 1)) ?>">Siguiente</a>
                    <?php
                }
                ?>
                <div style="float:right; margin-left: 5px; color: #888;"> Mostrando <?php echo $indicePrimero ?> a <?php echo $indiceUltimo ?> elementos de <?php echo $total ?> encontrados</div>
            </div>
            <hr>
            <?php
        }
    }
    ?>
</div>

<?php
slot('title', 'Informes de Estudiantes')
?>

<script>
    $(document).ready(function(){
        $('#programa').change(function(){
            $.post('<?php echo url_for('estudiante/getPeriodos') ?>',
            {
                id:$('#programa').val()
            }, function(data){
                $('#periodo').attr('disabled','disabled');
                $('#periodo').html('');
                
                html='<option value="">Todos</option>';
                
                for(i=0; i<data.length;i++){
                    fila=data[i];
                    html+='<option value="'+fila['id']+'">'+fila['nombre']+'</option>';
                }
                
                $('#periodo').html(html);
                $('#periodo').removeAttr('disabled');
            },'json')
        });
        
        $('#periodo').change(function(){
            $.post('<?php echo url_for('estudiante/getGrupos') ?>',
            {
                id:$('#periodo').val()
            }, function(data){
                $('#grupo').attr('disabled','disabled');
                $('#grupo').html('');
                
                html='<option value="">Todos</option>';
                
                for(i=0; i<data.length;i++){
                    fila=data[i];
                    html+='<option value="'+fila['id']+'">'+fila['nombre']+'</option>';
                }
                
                $('#grupo').html(html);
                $('#grupo').removeAttr('disabled');
            },'json')
        });
    });
</script>

<h1>Informes de Estudiantes</h1>
<form action="<?php echo url_for('estudiante/generarInforme') ?>" target="_blank">
<br />
Seleccione los filtros a usar:
<br />
<br />
Estado de Estudiante:
<select name="estado">
    <option value="">Todos</option>
    <?php foreach($estados as $estado){ ?>
    <option value="<?php echo $estado->getIdEstadoEstudiante() ?>"><?php echo $estado->getNombre() ?></option>
    <?php } ?>
</select>
<br />
<br />
Programa:
<select name="programa" id="programa">
    <option value="">Todos</option>
    <?php foreach($programas as $programa){ ?>
    <option value="<?php echo $programa->getCodigoPensum() ?>"><?php echo $programa ?></option>
    <?php } ?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Periodo:
<select name="periodo" id="periodo">
    <option value="">Todos</option>
    <?php foreach($periodos as $periodo){ ?>
    <option value="<?php echo $periodo->getIdPeriodoAcademico() ?>"><?php echo $periodo ?></option>
    <?php } ?>
</select>
<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Grupo:
<select name="grupo" id="grupo">
    <option value="">Todos</option>
    <?php foreach($grupos as $grupo){ ?>
    <option value="<?php echo $grupo->getIdGrupo() ?>"><?php echo $grupo ?></option>
    <?php } ?>
</select>

<br />
<br />

<hr />

<br />

Seleccione los campos que desea presentar:
<br />
<br />
<input type="checkbox" name="codigo" checked="checked" />Código
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="estadoEs" />Estado
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="nombre" checked="checked" />Nombre
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="documento" checked="checked" />Documento
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="tipoDocumento" />Tipo de Documento
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="expedicion" />Lugar de Expedición
<br />
<br />
<input type="checkbox" name="nacimiento" />Fecha de Nacimiento
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="genero" />Género
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="tipo_sangre" />Tipo de Sangre
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br />
<br />
<input type="checkbox" name="telefono1" />Teléfono 1
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="telefono2" />Teléfono 2
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="direccion" />Dirección
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="correo" />E-Mail
<br />
<br />
<input type="checkbox" name="acudiente1" />Primer Acudiente
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="telefono_acudiente1" />Teléfono del Primer Acudiente
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="acudiente2" />Segundo Acudiente
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="telefono_acudiente2" />Teléfono del Segundo Acudiente
<br />
<br />
<input type="checkbox" name="medicas" />Especificaciones Médicas
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="observaciones" />Observaciones
<br />
<br />
<input type="submit" value="Generar">
</form>

<br />
<br />
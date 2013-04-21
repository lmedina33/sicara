
<?php
slot('title', 'Ver Calendario de Cursos')
?>
<script>
    var fechas;
    $(document).ready(function(){
        
        fechasCursos=new Array();
              
<?php
$i = 0;
foreach ($cursos as $curso) {
    ?>
                fechasCursos[<?php echo $i ?>]= "<?php echo date("Y", strtotime($curso->getFechaInicio())) ?>"+"-"+"<?php echo intval(date("m", strtotime($curso->getFechaInicio()))) - 1 ?>"+"-"+"<?php echo intval(date("d", strtotime($curso->getFechaInicio()))) ?>";
    <?php
    $i++;
}
?>
        
        
        $( "#calMantenimiento" ).datepicker(
        {
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            buttonText: ['Ver Calendario...'],
            yearRange: '-1:+2',
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            beforeShowDay: function(date) {
                data=new Array();
                data[0]=true;
                if(fechasCursos.indexOf(date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate())!=-1){
                    data[1]="dateCurso";
                    data[2]="Inicio de Curso";
                }else{
                    data[1]="";
                    data[2]="";
                }
                
                return data;
            },
            onSelect: function(date){
                showCursos(date);
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
    
    showCursos('');
});

function showCursos(date){
    $("#descripcion").hide();
    $("#cursos").html("<div class='cargando'>Cargando...</div>");
    $.post("<?php echo url_for("curCurso/getCursos") ?>",
    {
        "fecha" : date
    }, 
    function(data){
        
        html="";
        
        $('#cursos').html(html);
        
        for(i=0;i<data.length;i++){
            if(i<3){
                html+='<div class="curso">\n\
                <div class="nombre">'+data[i]["nombre"]+'</div>\n\
                <div class="empresa"><label>Programado para:</label> '+data[i]["empresa"]+'</div>\n\
                <div class="fecha"><label>Fecha de inicio:</label> '+data[i]["fecha"]+'</div>\n\
                <div class="duracion"><label>Duración del curso:</label> '+data[i]["duracion"]+'</div>\n\
                <a href="http://www.escuelaaeronautica.edu.co/wordpress/?page_id=496&curso_id='+data[i]["id"]+'" class="inscribirse" target="_blank">Inscribirse</a>\n\
                </div>';
            }
        }
        
        if(date==""){
            $('#titulo_cursos').html('Cursos Próximos');
            if(data.length==0){
                html="No hay cursos próximo";
            }
        }else{
            $('#titulo_cursos').html('Cursos para el Día '+date);
            if(data.length==0){
                html="No hay cursos disponibles para esta fecha";
            }
        }
        
        $('#cursos').html(html);
    }
    , "json"  );
                
}

</script>

<style type="text/css">
    #titulo_cursos{
        margin: 5px;
        color: #0A246A;
        font-weight: bolder;
    }
    
    #cursos{
/*        border: 1px dashed #ccc;*/
        padding: 5px;
        color: #555;
        font-size: 12px;
    }
    
    .curso{
        border: 1px dashed #ccc;
        padding: 5px;
        margin: 5px;
        color: #555;
        font-size: 13px;
        width: 185px;
        float: left;
    }
    
    .curso .nombre{
        font-weight: bolder;
        font-size: 14px;
        color: #0A246A;
    }
    
    .curso .empresa{
        margin-left: 5px;
    }
    
    .curso .empresa label{
        font-weight: bolder;
    }
    
    .curso .fecha{
        margin-left: 5px;
    }
        
    .curso .fecha label{
        font-weight: bolder;
    }
    
    .curso .duracion{
        margin-left: 5px;
    }
        
    .curso .duracion label{
        font-weight: bolder;
    }
    
    .inscribirse{
         margin-left: 10px;
    }
</style>

<div id="calMantenimiento" style="float:left"></div>
<div style="width: 640px; margin-left: 10px; float:left">
<!--    <div id="titulo_cursos">Cursos Próximos</div>-->
    <div style="font-size: 12px; text-align:right">
        <a href="javascript: showCursos('')" style="text-decoration: none">Ver próximos</a> | 
        <a href="http://www.escuelaaeronautica.edu.co/wordpress/?page_id=496" target="_blank" style="text-decoration: none">Ver todos</a>
    </div>
    <div id="cursos">
        No hay cursos próximos
    </div>
</div>
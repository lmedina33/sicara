<?php
slot('title', 'Listar Estudiantes')
?>
<?php use_helper("DataTable") ?>
<script type="text/javascript">
    
    var oTable;
    $(document).ready(function(){
        
        oTable=$('.dataTable').dataTable({
            "sDom": 'lfT<"toolbar">trip<"foot">',
            "oLanguage": <?php echo getLenguageEs(); ?>,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo url_for('estudiante/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "IdUsuario" , "sWidth":"250px", "bVisible": false },
                { "mDataProp": "Codigo" , "sWidth":"25px" },
                { "mDataProp": "Nombre" , "sWidth":"250px" , "sClass": "nombre" },
                { "mDataProp": "TipoDoc" , "sClass": "small" , "sClass": "tipoDoc" },
                { "mDataProp": "Documento" , "sClass": "documento" },
                { "mDataProp": "Telefono" , "sClass": "telefono" },
                { "mDataProp": "Correo" , "sClass": "correo" },
                { "mDataProp": "Pensum" , "sWidth":"250px" }
            ],
            "fnDrawCallback": function ( oSettings ) {
                var row;
                var n = 1;
                var sLastGroup = "";
                
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        codigo=datos.Codigo;
            
                        $('#detallar').attr('href', '<?php echo url_for('estudiante/ver?cod=') ?>'+codigo);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
            
                        $('#matricular').attr('href', '<?php echo url_for('estudiante/matricularNuevoPensum?cod=') ?>'+codigo);
                        $('#matricular img').attr('src', '/images/iconos/matricular.png');
                    } );
                    
                    if ( oSettings.aiDisplay.length == 0 )
                    {
                        return;
                    }
                    datos = oTable.fnGetData( this );
                    var sGroup = datos.IdUsuario;
                    if ( sGroup != sLastGroup ) {
                        n=1;
                        row=$(this);
                        sLastGroup = sGroup;
                    }else{
                        n++;
                        $(this).children('.nombre').remove();
                        $(this).children('.tipoDoc').remove();
                        $(this).children('.documento').remove();
                        $(this).children('.telefono').remove();
                        $(this).children('.correo').remove();
                        
                        row.children('.nombre').attr('rowspan',n);
                        row.children('.tipoDoc').attr('rowspan',n);
                        row.children('.documento').attr('rowspan',n);
                        row.children('.telefono').attr('rowspan',n);
                        row.children('.correo').attr('rowspan',n);
                    }
                } );
            },
            "oColVis": {
                "buttonText": "Ver Columnas"
            },
            "oTableTools": {
                "sSwfPath": "/js/DataTables-1.9.0/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf",
                "aButtons":[
                    {
                        "sExtends": "copy",
                        "sButtonText": "",
                        "sToolTip": "Copiar"
                    },
                    {
                        "sExtends": "xls",
                        "sButtonText": "",
                        "sToolTip": "Exportar a Excel"
                    },
                    {
                        "sExtends": "pdf",
                        "sButtonText": "",
                        "sToolTip": "Exportar a PDF"
                    }
                ]
            }
        });
        
        $("div.toolbar").html('<a href="#" id="detallar" title="Ver Estudiante"><img src="/images/iconos/listarSmallGray.png"/></a>\n\
            <a href="#" id="matricular" title="Matricular a Nuevo Curso"><img src="/images/iconos/matricularGray.png"/></a>');
    });
    
    function confirmFormalizar(){
        return confirm('Si da este formulario por formalizado, no se podrá volver a modificar.\n\nEstá seguro de querer formalizar este formulario?');
    }
    
    function confirmInscribir(){
        return confirm('Realmente desea inscribir al aspirante de este formulario?\n\nSi acepta, deberá terminar de diligenciar los datos de inscripción.');
    }
</script>
<h1>Listar Estudiantes</h1>

<table class="dataTable">
    <thead>
        <tr>
            <th>Id Usuario</th>
            <th class="small">Código</th>
            <th>Nombre</th>
            <th>Tipo de Documento</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Programa</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

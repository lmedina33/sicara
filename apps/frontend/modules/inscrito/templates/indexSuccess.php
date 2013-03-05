<?php
slot('title', 'Listar Inscritos')
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
            "sAjaxSource": "<?php echo url_for('inscrito/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "Numero" , "sWidth":"25px" },
                { "mDataProp": "Nombre" , "sWidth":"250px" },
                { "mDataProp": "TipoDoc" , "sClass": "small" },
                { "mDataProp": "Documento" },
                { "mDataProp": "Telefono" },
                { "mDataProp": "Correo" },
                { "mDataProp": "Pensum" , "sWidth":"250px" },
                { "mDataProp": "Periodo" },
                { "mDataProp": "Jornada" },
                { "mDataProp": "Matriculado" , "sClass": "small" , "sWidth":"25px" , "fnRender": function ( o, val ) {
                        if(val == "1"){
                            return "<img src='/images/iconos/check.png' />";
                        }else{
                            return "";
                        }
                    } },
                { "mDataProp": "IdForm", 'bVisible': false }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        numForm=datos.Numero;
                        idForm=datos.IdForm;
            
                        $('#detallar').attr('href', '<?php echo url_for('inscrito/ver?id=') ?>'+numForm);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
            
                        $('#formulario').attr('href', '<?php echo url_for('formularioInscripcion/generarFormulario?id=') ?>'+idForm);
                        $('#formulario img').attr('src', '/images/iconos/refHV.png');
                        
                        if(datos.Matriculado == ""){
                            $('#matricular').attr('href', '<?php echo url_for('inscrito/matricular?cod=') ?>'+numForm);
                            $('#matricular img').attr('src', '/images/iconos/matricular.png');
                            
                            $('#homologar').attr('href', '<?php echo url_for('homologacion/new') ?>?id='+numForm+'&tipo=ext');
                            $('#homologar img').attr('src', '/images/iconos/homologarSmall.png');
                        }else{
                            $('#matricular').attr('href', '');
                            $('#matricular img').attr('src', '/images/iconos/matricularGray.png');
                            
                            $('#homologar').attr('href', '');
                            $('#homologar img').attr('src', '/images/iconos/homologarGray.png');
                        }
                    } );
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
        
        $("div.toolbar").html('<a href="#" id="detallar" title="Ver Inscrito"><img src="/images/iconos/listarSmallGray.png"/></a>\n\
            <a href="#" id="formulario" title="Ver Formulario" target="_blank"><img src="/images/iconos/refHVGray.png"/></a>\n\
            <a href="#" id="matricular" title="Matricular"><img src="/images/iconos/matricularGray.png"/></a>\n\
            <a href="#" id="homologar" title="Homologar a Nuevo Curso"><img src="/images/iconos/homologarGray.png"/></a>');
    });
    
    function confirmFormalizar(){
        return confirm('Si da este formulario por formalizado, no se podrá volver a modificar.\n\nEstá seguro de querer formalizar este formulario?');
    }
    
    function confirmInscribir(){
        return confirm('Realmente desea inscribir al aspirante de este formulario?\n\nSi acepta, deberá terminar de diligenciar los datos de inscripción.');
    }
</script>
<h1>Listar Inscritos</h1>

<table class="dataTable">
    <thead>
        <tr>
            <th class="small">Número Formulario</th>
            <th>Nombre</th>
            <th>Tipo de Documento</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Programa</th>
            <th>Periodo</th>
            <th>Jornada</th>
            <th>Matriculado</th>
            <th>Id Form</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

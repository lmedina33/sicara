<?php
slot('title', 'Listar Formularios de Inscripción')
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
            "sAjaxSource": "<?php echo url_for('formularioInscripcion/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "Id", 'bVisible': false },
                { "mDataProp": "Numero" , "sWidth":"25px" },
                { "mDataProp": "Nombre" , "sWidth":"250px" },
                { "mDataProp": "TipoDoc" , "sClass": "small" },
                { "mDataProp": "Documento" },
                { "mDataProp": "Telefono" },
                { "mDataProp": "Correo" },
                { "mDataProp": "Pensum" , "sWidth":"250px" },
                { "mDataProp": "Periodo" },
                { "mDataProp": "Jornada" },
                { "mDataProp": "Formalizado" , "sClass": "small" , "sWidth":"25px" , "fnRender": function ( o, val ) {
                        if(val == "1"){
                            return "<img src='/images/iconos/check.png' />";
                        }else{
                            return "";
                        }
                    } },
                { "mDataProp": "Inscrito" , "sClass": "small" , "sWidth":"25px" , "fnRender": function ( o, val ) {
                        if(val == "1"){
                            return "<img src='/images/iconos/check.png' />";
                        }else{
                            return "";
                        }
                    } }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        idFormulario=datos.Id;
                        formalizado = datos.Formalizado;
                        inscrito = datos.Inscrito;
            
                        $('#detallar').attr('href', '<?php echo url_for('formularioInscripcion/ver?id=') ?>'+idFormulario);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
            
                        $('#formulario').attr('href', '<?php echo url_for('formularioInscripcion/generarFormulario?id=') ?>'+idFormulario);
                        $('#formulario img').attr('src', '/images/iconos/refHV.png');
                        
                        if(formalizado == ""){
                            $('#formalizar').attr('href', '<?php echo url_for('formularioInscripcion/formalizar?id=') ?>'+idFormulario);
                            $('#formalizar img').attr('src', '/images/iconos/docCheckSmall.png');
                            $('#formalizar img').attr('onClick', 'return confirmFormalizar()');
                            
                            $('#inscribir').attr('href', '#');
                            $('#inscribir img').attr('src', '/images/iconos/inscribirGray.png');
                            $('#inscribir img').attr('onClick', 'return');
                        }else{
                            $('#formalizar').attr('href', '#');
                            $('#formalizar img').attr('src', '/images/iconos/docCheckSmallGray.png');
                            $('#formalizar img').attr('onClick', 'return');
                            
                            if(inscrito == ""){
                                $('#inscribir').attr('href', '<?php echo url_for('formularioInscripcion/inscribir?id=') ?>'+idFormulario);
                                $('#inscribir img').attr('src', '/images/iconos/inscribir.png');
                                $('#inscribir img').attr('onClick', 'return confirmInscribir()');
                            }else{
                                $('#inscribir').attr('href', '#');
                                $('#inscribir img').attr('src', '/images/iconos/inscribirGray.png');
                                $('#inscribir img').attr('onClick', 'return');
                            }
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
        
        $("div.toolbar").html('<a href="#" id="detallar" title="Ver Formulario"><img src="/images/iconos/listarSmallGray.png"/></a>\n\
            <a href="#" id="formalizar" title="Formalizar"><img src="/images/iconos/docCheckSmallGray.png"/></a>\n\
            <a href="#" id="inscribir" title="Inscribir"><img src="/images/iconos/inscribirGray.png"/></a>\n\
            <a href="#" id="formulario" title="Ver Formulario" target="_blank"><img src="/images/iconos/refHVGray.png"/></a>');
    });
    
    function confirmFormalizar(){
        return confirm('Si da este formulario por formalizado, no se podrá volver a modificar.\n\nEstá seguro de querer formalizar este formulario?');
    }
    
    function confirmInscribir(){
        return confirm('Realmente desea inscribir al aspirante de este formulario?\n\nSi acepta, deberá terminar de diligenciar los datos de inscripción.');
    }
</script>
<h1>Listar Formularios de Inscripción</h1>

<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th class="small">Número Formulario</th>
            <th>Nombre</th>
            <th>Tipo de Documento</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Programa</th>
            <th>Periodo</th>
            <th>Jornada</th>
            <th>Formal</th>
            <th>Inscrito</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

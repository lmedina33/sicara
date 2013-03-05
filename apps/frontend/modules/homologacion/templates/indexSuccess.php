<?php
slot('title', 'Listar Homologaciones')
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
            "sAjaxSource": "<?php echo url_for('homologacion/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "Id", 'bVisible': false },
                { "mDataProp": "IstitucionOr" },
                { "mDataProp": "ProgramaOr" },
                { "mDataProp": "ProgramaDes" },
                { "mDataProp": "Homologante" , "sWidth":"200px" },
                { "mDataProp": "Oficial" , "sClass": "small" , "sWidth":"25px" , "fnRender": function ( o, val ) {
                        if(val == "1"){
                            return "<img src='/images/iconos/check.png' />";
                        }else{
                            return "";
                        }
                    } },
                { "mDataProp": "Interna" , "sClass": "small" , "sWidth":"25px" , "fnRender": function ( o, val ) {
                        if(val == "1"){
                            return "<img src='/images/iconos/check.png' />";
                        }else{
                            return "";
                        }
                    } },
                { "mDataProp": "Oficializable", "sClass": "small", 'bVisible': true, "fnRender": function ( o, val ) {
                        if(val == "1"){
                            return "<img src='/images/iconos/check.png' />";
                        }else{
                            return "";
                        }
                    } },
                { "mDataProp": "Fecha", "sWidth":"50px" }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        idHomologacion=datos.Id;
                        oficial = datos.Oficial;
                        oficializable = datos.Oficializable;
                        inscrito = datos.Inscrito;
            
                        $('#detallar').attr('href', '<?php echo url_for('homologacion/homologar?id=') ?>'+idHomologacion);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
                        
                        if(oficial == ""){
                            if(oficializable != ""){
                                $('#oficializar').attr('href', '<?php echo url_for('homologacion/oficializar?id=') ?>'+idHomologacion);
                                $('#oficializar img').attr('src', '/images/iconos/docCheckSmall.png');
                                $('#oficializar img').attr('onClick', 'return confirmOficializar()');
                            }else{
                                $('#oficializar').attr('href', '#');
                                $('#oficializar img').attr('src', '/images/iconos/docCheckSmallGray.png');
                                $('#oficializar img').attr('onClick', 'return');
                            }
                        }else{
                            $('#oficializar').attr('href', '#');
                            $('#oficializar img').attr('src', '/images/iconos/docCheckSmallGray.png');
                            $('#oficializar img').attr('onClick', 'return');
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
        
        $("div.toolbar").html('<a href="#" id="detallar" title="Ver Homologación"><img src="/images/iconos/listarSmallGray.png"/></a>\n\
            <a href="#" id="oficializar" title="Oficializar"><img src="/images/iconos/docCheckSmallGray.png"/></a>');
    });
    
    function confirmOficializar(){
        return confirm('Si oficializa esta homologación, no se podrá volver a modificar\n y se registrarán las asignaturas homologadas en el curriculum\n del estudiante.\n\nEstá seguro de querer formalizar este formulario?');
    }
    
</script>

<h1>Lista de Homologaciones</h1>

<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Institución de Origen</th>
            <th>Programa de Origen</th>
            <th>Programa Destino</th>
            <th>Homologante</th>
            <th>Oficial</th>
            <th>Interna</th>
            <th>Matriculado</th>
            <th>Fecha de Registro</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

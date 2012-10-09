<?php
slot('title', 'Listar Material Bibliográfico')
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
            "sAjaxSource": "<?php echo url_for('libMaterial/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "Id", 'bVisible': false },
                { "mDataProp": "Codigo" },
                { "mDataProp": "Titulo" },
                { "mDataProp": "SubTitulo" },
                { "mDataProp": "Autor" },
                { "mDataProp": "Categoria" },
                { "mDataProp": "Tipo" },
                { "mDataProp": "NItems", "bSortable":false }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        idMaterial=datos.Id;
            
                        $('#detallar').attr('href', '<?php echo url_for('libMaterial/ver?id_lib_material=') ?>'+idMaterial);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
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
        
        $("div.toolbar").html('<a href="#" id="detallar" title="Ver Material"><img src="/images/iconos/listarSmallGray.png"/></a>');
    });
</script>
<h1>Listar Material Bibliográfico</h1>

<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Código</th>
            <th>Título</th>
            <th>Subtítulo</th>
            <th>Autores</th>
            <th>Categoria</th>
            <th>Tipo de Material</th>
            <th># Copias</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

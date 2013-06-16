<?php
slot('title', 'Listar Grupos')
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
            "sAjaxSource": "<?php echo url_for('grupo/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "Id", 'bVisible': false },
                { "mDataProp": "Periodo" , "sClass": "small" },
                { "mDataProp": "Asignatura" , "sClass": "small" },
                { "mDataProp": "Nombre" , "sWidth":"250px" },
                { "mDataProp": "Profesor" , "sWidth":"250px" },
                { "mDataProp": "FechaIni" , "sClass": "small" , "sWidth":"50px" },
                { "mDataProp": "FechaFin" , "sClass": "small" , "sWidth":"50px" },
                { "mDataProp": "IniCal" , "sClass": "small" , "sWidth":"50px" },
                { "mDataProp": "FinCal" , "sClass": "small" , "sWidth":"50px" }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        idGrupo=datos.Id;
            
                        $('#detallar').attr('href', '<?php echo url_for('grupo/ver?id=') ?>'+idGrupo);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
            
                        $('#editar').attr('href', '<?php echo url_for('grupo/edit?id_grupo=') ?>'+idGrupo);
                        $('#editar img').attr('src', '/images/iconos/editSmall.png');
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
        
$("div.toolbar").html('<a href="<?php echo url_for('grupo/new') ?>" id="nuevo" title="Nuevo Grupo"><img src="/images/iconos/newSmall.png"/></a>\n\
        <a href="#" id="editar" title="Editar Grupo"><img src="/images/iconos/editSmallGray.png"/></a>\n\
        <a href="#" id="detallar" title="Ver Grupo"><img src="/images/iconos/listarSmallGray.png"/></a>');
    });
    
</script>
<h1>Listar Grupos</h1>

<table class="dataTable">
  <thead>
    <tr>
      <th>Id</th>
      <th>Periodo</th>
      <th>Asignatura</th>
      <th>Nombre</th>
      <th>Profesor</th>
      <th>Fecha Inicio</th>
      <th>Fecha Fin</th>
      <th>Inicio Calificación</th>
      <th>Fin Calificación</th>
    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>


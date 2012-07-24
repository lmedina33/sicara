<?php
slot('title', 'Listar Material Bibliográfico')
?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper("DataTable") ?>
<script type="text/javascript">
    
    var oTable;
    $(document).ready(function(){
        
        oTable=$('.dataTable').dataTable({
            "sDom": 'lfT<"toolbar">trip<"foot">',
            "oLanguage": <?php echo getLenguageEs(); ?>,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo url_for('refElemento/getDataPaging?fTip='.$filtroTipo.'&fEst='.$filtroEstado.'&fUsu='.$filtroUsuario) ?>",
            "aoColumns": [
                { "mDataProp": "Id", 'bVisible': false },
                { "mDataProp": "Tipo" },
                { "mDataProp": "Serial" },
                { "mDataProp": "SerialInterno" },
                { "mDataProp": "Nombre" },
                { "mDataProp": "Marca" },
                { "mDataProp": "Modelo" },
                { "mDataProp": "Lugar" },
                { "mDataProp": "Usuario", "bSearch": false },
                { "mDataProp": "Estado" },
                { "mDataProp": "IdFoto", "bVisible": false }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        idElemento=datos.Id;
            
                        $('#detallar').attr('href', '<?php echo url_for('refElemento/ver?id_ref_elemento=') ?>'+idElemento);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
            
                        $('#hv').attr('href', '<?php echo url_for('refHojaVida/verByElemento?idEle=') ?>'+idElemento);
                        $('#hv img').attr('src', '/images/iconos/refHV.png');
                        
                        url='<?php  echo url_for('refElemento/showFoto?id=') ?>'+datos.IdFoto;
                        opc='toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1,width=700,height=600';
                        
                        if(datos.IdFoto != ""){
                            
                            $('#foto').attr('onClick', 'javascript: window.open(\''+url+'\',\'Foto de Recurso\',\''+opc+'\')');
                            $('#foto img').attr('src', '/images/iconos/foto.png');
                        }else{
                            $('#foto').attr('onClick', 'javascript: window.open(\''+url+'\',\'Foto de Recurso\',\''+opc+'\')');
                            $('#foto img').attr('src', '/images/iconos/fotoGrey.png');
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
        
        $("div.toolbar").html('<a href="#" id="detallar" title="Ver Material"><img src="/images/iconos/listarSmallGray.png"/></a>\n\
        <a id="foto" href="#" title="Ver Fotografía"><img src="/images/iconos/fotoGrey.png" /></a>\n\
        <a id="hv" href="#" title="Ver Hoja de Vida"><img src="/images/iconos/refHVGray.png" /></a>');
    });
</script>
<h1>Listar Recursos Físicos</h1>
<br />
<form id="form" action="<?php echo url_for('refElemento/index') ?>" method="post">
&nbsp;&nbsp;&nbsp;
<?php echo $form->renderHiddenFields(false) ?>
<?php echo $form['id_ref_tipo_elemento']->renderError() ?>
<?php echo $form['id_ref_tipo_elemento']->renderLabel() ?>
<?php echo $form['id_ref_tipo_elemento'] ?>&nbsp;&nbsp;&nbsp;
<?php echo $form['id_ref_estado_elemento']->renderError() ?>
<?php echo $form['id_ref_estado_elemento']->renderLabel() ?>
<?php echo $form['id_ref_estado_elemento'] ?>&nbsp;&nbsp;&nbsp;
<?php echo $form['id_usuario_responsable']->renderError() ?>
<?php echo $form['id_usuario_responsable']->renderLabel() ?>
<?php echo $form['id_usuario_responsable'] ?>&nbsp;&nbsp;&nbsp;
<input type="submit" value="Filtrar" />
</form>
<br />
<br />
<table class="dataTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Tipo</th>
            <th>Serial</th>
            <th>Serial Interno</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Lugar</th>
            <th>Responsable</th>
            <th>Estado</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


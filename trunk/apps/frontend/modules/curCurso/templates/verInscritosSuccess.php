<?php
slot('title', 'Listar Inscritos a Curso Empresarial')
?>
<?php use_helper("DataTable") ?>
<script type="text/javascript">
    
    var oTable;
    $(document).ready(function(){
        
        oTable=$('.dataTable').dataTable({
            "sDom": 'lfT<"toolbar">trip<"foot">',
            "oLanguage": <?php echo getLenguageEs(); ?>,
//            "bProcessing": true,
//            "bServerSide": true,
//            "sAjaxSource": "<?php echo url_for('inscrito/getDataPaging') ?>",
            "aoColumns": [
                { "mDataProp": "Nombre" , "sWidth":"250px" },
                { "mDataProp": "TipoDoc" },
                { "mDataProp": "Documento" },
                { "mDataProp": "Telefono" },
                { "mDataProp": "Correo" },
                { "mDataProp": "IdForm", 'bVisible': false },
                { "mDataProp": "IdInscrito", 'bVisible': false }
            ],
            "fnDrawCallback": function ( oSettings ) {
                $('.dataTable tbody tr').each( function () {
                    $(this).click( function () {
                        $(oTable.fnSettings().aoData).each(function (){
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(this).addClass('row_selected');
                        
                        datos = oTable.fnGetData( this );
                        
                        idForm=datos.IdForm;
                        idInscrito=datos.IdInscrito;
            
                        $('#detallar').attr('href', '<?php echo url_for('curFormulario/verInscrito?id=') ?>'+idForm);
                        $('#detallar img').attr('src', '/images/iconos/listarSmall.png');
            
                        $('#formulario').attr('href', '<?php echo url_for('curFormulario/generarFormulario?id=') ?>'+idForm);
                        $('#formulario img').attr('src', '/images/iconos/refHV.png');
            
                        $('#borrar').attr('href', '<?php echo url_for('curCurso/borrarInscrito?idCur='.$curso->getIdCurCurso().'&id=') ?>'+idForm);
                        $('#borrar').attr('onClick', 'javascript: return confirm("Esta seguro de querer eliminar este inscrito de este curso?")');
                        $('#borrar img').attr('src', '/images/iconos/removeSmall.png');
                    } )
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
            <a href="#" id="borrar" title="Borrar Inscrito"><img src="/images/iconos/removeSmallGray.png"/></a>');
    });
</script>
<h1>Listar Inscritos a Curso Empresarial</h1>
<h2><?php echo $curso->getCurEmpresa()->getNombre() ?> - <?php echo $curso->getNombre() ?></h2>

<table class="dataTable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Tipo de Documento</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Id Form</th>
            <th>Id Inscrito</th>
        </tr>
    </thead>
    <tbody
        <?php foreach($formularios as $formulario){ ?>
        <tr>
            <td><?php echo $formulario->getCurInscrito()->getPrimerApellido().' '.$formulario->getCurInscrito()->getSegundoApellido().' '.$formulario->getCurInscrito()->getPrimerNombre().' '.$formulario->getCurInscrito()->getSegundoNombre() ?></td>
            <td><?php echo $formulario->getCurInscrito()->getTipoDocumento() ?></td>
            <td><?php echo $formulario->getCurInscrito()->getDocumento() ?></td>
            <td><?php echo $formulario->getCurInscrito()->getTelefono1() ?></td>
            <td><?php echo $formulario->getCurInscrito()->getCorreo() ?></td>
            <td><?php echo $formulario->getIdCurFormulario() ?></td>
            <td><?php echo $formulario->getIdCurInscrito() ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
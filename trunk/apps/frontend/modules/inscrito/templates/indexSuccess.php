<?php use_helper("DataTable") ?>
<script>
    $(document).ready(function() {

        $("#dataTable tbody tr").click( function( e ) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
            }
            else {
                $('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
        
        oTable = $('#dataTable').dataTable({
            "sDom": 'lf<"toolbar">tip<"foot">',
            "oLanguage": <?php echo getLenguageEs(); ?>
        });
        
        $("div.toolbar").html('&nbsp;&nbsp;&nbsp;<img src="/images/edit.png" />&nbsp;&nbsp;&nbsp;<img src="/images/view.png" />');
    } );
    
    
</script>

<h1>Lista de Inscritos</h1>

<table id="dataTable">
    <thead>
        <tr>
            <th>Id inscrito</th>
            <th>Numero formulario</th>
            <th>Id jornada</th>
            <th>Id tipo pago</th>
            <th>Id periodo</th>
            <th>Id usuario</th>
            <th>Matriculado</th>
            <th>Fecha inscripcion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inscritos as $inscrito): ?>
            <tr>
                <td><a href="<?php echo url_for('inscrito/edit?numero_formulario=' . $inscrito->getNumeroFormulario()) ?>"><?php echo $inscrito->getNumeroFormulario() ?></a></td>
                <td><?php echo $inscrito->getNumeroFormulario() ?></td>
                <td><?php echo $inscrito->getIdJornada() ?></td>
                <td><?php echo $inscrito->getIdTipoPago() ?></td>
                <td><?php echo $inscrito->getIdPeriodo() ?></td>
                <td><?php echo $inscrito->getIdUsuario() ?></td>
                <td><?php echo $inscrito->getIsMatriculado() ?></td>
                <td><?php echo $inscrito->getFechaInscripcion() ?></td>
            </tr>
        <?php endforeach; ?>        
    </tbody>
</table>

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
                <td><a href="<?php echo url_for('inscrito/edit?id_inscrito=' . $inscrito->getIdInscrito()) ?>"><?php echo $inscrito->getIdInscrito() ?></a></td>
                <td><?php echo $inscrito->getNumeroFormulario() ?></td>
                <td><?php echo $inscrito->getIdJornada() ?></td>
                <td><?php echo $inscrito->getIdTipoPago() ?></td>
                <td><?php echo $inscrito->getIdPeriodo() ?></td>
                <td><?php echo $inscrito->getIdUsuario() ?></td>
                <td><?php echo $inscrito->getMatriculado() ?></td>
                <td><?php echo $inscrito->getFechaInscripcion() ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><a href="<?php ?>">33</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">2</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Simbacocha</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Simba</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
        <tr>
            <td><a href="<?php ?>">12</a></td>
            <td>123</td>
            <td>mañana</td>
            <td>contado</td>
            <td>2012-5</td>
            <td>Peter Pitaquiva</td>
            <td>Nop</td>
            <td>123010</td>
        </tr>
    </tbody>
</table>

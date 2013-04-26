<h1>Restaurar Contraseña</h1>
Para poder restaurar su contraseña es necesario que ingrese los datos a continuación:
<br />
<br />
<form action="<?php echo url_for('home/enviarPass') ?>" method="post">
<label style="float:left;"><b>Tipo de documento:</b></label> &nbsp;&nbsp;
<select name="tipo">
    <?php
    foreach ($tipos as $tipo) {
        ?>
    <option value="<?php echo $tipo->getIdTipoDocumento() ?>"><?php echo $tipo->getNombre() ?></option>
        <?php
    }
    ?>
</select>
<br />
<label style="float:left;"><b>Número de documento:</b></label>&nbsp;&nbsp; <div class="tip" title="Como figura en su documento de identidad.<br />Si en su documento incluye puntos, incluya esos mismos puntos." style="float:left;"></div> <input type="text" name="documento" />
<br />
<br />
Se enviará su nueva contraseña al correo electrónico que tiene registrado en el sistema.

<br /><br />
Si tiene problemas, consulte con el departamento de registro y control.
<br /><br />
<input type="submit" value="Enviar" />
</form>
<?php
?>
<div style="float: left; margin-right: 10px;"><img src="/images/azafata.jpg" /></div>
<div>
    
    <b>Gracias!!! Hemos recibido sus datos exitosamente!!!</b>
    <br />
    <br />
    El código para poder actualizar los datos de este formulario es:
    <br />
    <br />
    <b><?php echo $codigo; ?></b>
    <br />
    <br />
    Por favor <b>guarde este código en un lugar seguro mientras termina su proceso de inscripción</b>, pues en cualquier momento podría necesitar modificar los datos de su formulario.
    <br />
    <br />
    Si pierde este número y necesita cambiar los datos de su formulario, <b>deberá volver a diligenciar todo el formulario inscripción</b>.
    <br />
    <br />
    Para modificar los datos de este formulario puede hacerlo aquí: <a href="<?php echo url_for('formularioInscripcion/actualizarFormulario') ?>">Modificar Formulario</a>
    <br />
    <br />
    Su formulario se encuentra disponible en: <a href="<?php echo url_for('formularioInscripcion/generarFormulario?id='.$id) ?>" target="_blank">Formulario Digital</a>
    , para poder visualizarlo adecuadamente debe tener correctamente instalado un visro de archivos <b>PDF</b>, si no lo tiene, puede descargarlo en el siguiente vínculo:
    <br />
    <br />
    <a href="http://www.adobe.com/go/gntray_dl_get_reader"><img src="/images/get_adobe_reader.gif"/></a>
</div>

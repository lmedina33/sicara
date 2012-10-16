<?php slot('title', "SiCaRa: Home") ?>

<script>
    $(function() {
        if($( "#notificaciones" ).html()!="")
        // run the effect
        //        $( "#notificaciones" ).show( "shake", null ,500, null );
        //        $( "#notificaciones" ).show( "pulsate", null ,500, null );
        //        $( "#notificaciones" ).show( "blind", null ,500, null );
        $( "#notificaciones" ).show( "slide", null ,2000, callback );
        
    });
    
    function callback(){
        setTimeout(function() {
//            $( "#notificaciones" ).show( "pulsate", null ,300, null );
            $( "#notificaciones" ).show( "highlight", null ,1000, null );
        }, 100 );
    }
</script>

<h1>Bienvenido!!!</h1>

SiCaRa es un sistema de apoyo a la gestión de los diferentes procesos de la
Escuela Aeronáutica de Colombia, donde de acuerdo a su perfil,
tendrá acceso a diferentes módulos.

<div class="data_user">
    <img src="/images/usuario.png" />
    <br />
    <br /><?php echo $usuario; ?>
    <br /><?php echo $usuario->getCorreo(); ?>
</div>

<div class="notificaciones" id="notificaciones" style="display:none">
    <ul>
        <?php foreach($notificaciones as $notificacion){ ?>
        <li>
            <b><?php echo $notificacion->getTitulo() ?></b><br />
            <?php echo html_entity_decode($notificacion->getContenido()) ?>
        </li>
        <?php } ?>
    </ul>
</div>



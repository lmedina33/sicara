<?php
slot('title', 'Listar Lugares')
?>
<script>
    jQuery(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '<?php echo url_for('refLugar/getArbol') ?>',
            data: 0,
            success: function(arbol){
                $("#tree").html(arbol);
                $("#tree").treeview({
                    collapsed: false,
                    unique: true
                });
            },
            dataType: 'text'
        });
    });
    
    function administrarShow(){
        $('.administracion').show('normal');
        //        $('.administracion').css('display', 'inline');
        $('#botonAdmin').attr('href', 'javascript:administrarHide()');
        $('#botonAdmin span').html('Desactivar Administración');
    }
    
    function administrarHide(){
        $('.administracion').hide('normal');
        //        $('.administracion').css('display', 'none');
        $('#botonAdmin').attr('href', 'javascript:administrarShow()');
        $('#botonAdmin span').html('Activar Administración');
    }
    
</script>

<h1>Lugares</h1>
<a id="botonAdmin" href="javascript:administrarShow()" class="button tool">Activar Edición</a>
<br />
<div class="administracion">
    <br />
    <a href="<?php echo url_for('refLugar/new') ?>" class="button add">Agregar Lugar</a>
</div>
<br />
<div>
    <ul id="tree">
    </ul>
</div>

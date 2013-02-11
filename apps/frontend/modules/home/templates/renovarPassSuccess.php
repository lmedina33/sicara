<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script type="text/javascript" src="/js/md5.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#form').validationEngine();
    });
    
    function validar(){
        if($('#renovar_pass_new_pass').val() != ''){
            $('#renovar_pass_old_pass').addClass('validate[required,minSize[6]]');
            $('#renovar_pass_new_pass').addClass('validate[required,minSize[6]]');
            $('#renovar_pass_renew_pass').addClass('validate[required,minSize[6],equals[renovar_pass_new_pass]]');
            if(jQuery("#form").validationEngine('validate')){
                $('#renovar_pass_new_pass').val(hex_md5($('#renovar_pass_new_pass').val()));
                $('#renovar_pass_renew_pass').val(hex_md5($('#renovar_pass_renew_pass').val()));
                $('#renovar_pass_old_pass').val(hex_md5($('#renovar_pass_old_pass').val()));
            }
        }else{
            $('#renovar_pass_old_pass').removeClass('validate[required,minSize[6]]');
            $('#renovar_pass_new_pass').removeClass('validate[required,minSize[6]]');
            $('#renovar_pass_renew_pass').removeClass('validate[required,minSize[6],equals[renovar_pass_new_pass]]');
        }
        $('#form').validationEngine();
    }
</script>
<h1>Actualizar Datos de Usuario</h1>
A continuación puede actualizar sus datos de acceso al sistema.
<br />
Si desea actualizar sus datos personales, consulte con el departamento de registro y control.
<br />
<br />
<b>Su nombre es: </b><?php echo $usuario ?>
<br />
<b>Su documento de identidad es: </b><?php echo $usuario->getDocumento() ?> - <?php echo $usuario->getTipoDocumento() ?>
<br />
<br />
<form id="form" action="<?php echo url_for('home/renovar') ?>" method="post" >
    <table>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <br />
                    <input type="submit" value="Actualizar" onclick="javascript:validar()" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['correo']->renderLabel() ?><br /><br /></th>
                <td>
                    <?php echo $form['correo']->renderError() ?>
                    <?php echo $form['correo'] ?>
                    <br /><br />
                </td>
            </tr>
            <tr>
                <th><?php echo $form['new_pass']->renderLabel() ?></th>
                <td>
                    <?php echo $form['new_pass']->renderError() ?>
                    <?php echo $form['new_pass'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['renew_pass']->renderLabel() ?></th>
                <td>
                    <?php echo $form['renew_pass']->renderError() ?>
                    <?php echo $form['renew_pass'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <br />
                    <?php echo $form['old_pass']->renderLabel() ?>
                    <div class="tip" title="Para renovar la contraseña es necesario ingresar la contraseña anterior."></div>
                </th>
                <td>
                    <br />
                    <?php echo $form['old_pass']->renderError() ?>
                    <?php echo $form['old_pass'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>

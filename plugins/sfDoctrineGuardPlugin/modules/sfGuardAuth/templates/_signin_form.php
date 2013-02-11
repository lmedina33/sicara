<?php use_helper('I18N') ?>
<script type="text/javascript" src="/js/md5.js"></script>
<script>
    var b=true;
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
    });
    
    function encriptar(){
        if(b){
            if(jQuery("#form").validationEngine('validate')){
                pass=hex_md5($('#signin_password').val());
                $('#signin_password').val(pass);
            }
            b=false;
        }
    }
</script>
<form id="form" action="<?php echo url_for('@sf_guard_signin') ?>" method="post" onsubmit="javascript:encriptar()">
    <table>
        <tbody>
            <?php //echo $form ?>
            <?php echo $form->renderHiddenFields(false) ?>
            <tr>
                <th><?php echo $form['username']->renderLabel() ?></th>
                <td><?php echo $form['username'] ?></td>
            </tr>
            <tr>
                <th><?php echo $form['password']->renderLabel() ?></th>
                <td><?php echo $form['password'] ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="<?php echo __('Signin', null, 'sf_guard') ?>" onclick="javascript:encriptar()" />
                    <br />
                    <small><a href="<?php echo url_for('home/restaurarPass') ?>">Restaurar contraseña</a></small>
                    <?php $routes = $sf_context->getRouting()->getRoutes() ?>
                    <?php if (isset($routes['sf_guard_forgot_password'])): ?>
                        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
                    <?php endif; ?>

                    <?php if (isset($routes['sf_guard_register'])): ?>
                        &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
                    <?php endif; ?>
                </td>
            </tr>
        </tfoot>
    </table>
</form>

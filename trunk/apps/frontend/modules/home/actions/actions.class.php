<?php

/**
 * home actions.
 *
 * @package    sicara2
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
//    $this->forward('default', 'module');
        $this->usuario = new Usuario();
        if ($this->getUser()->isAuthenticated())
            $this->usuario = Doctrine_Core::getTable("Usuario")->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();

        $permisos = sfContext::getInstance()->getUser()->listCredentials();

        $sPermisos = "";
        foreach ($permisos as $permiso) {
            $sPermisos = $sPermisos . "'" . $permiso . "',";
        }
        $sPermisos = $sPermisos . "''";

        $this->notificaciones = Doctrine_Core::getTable('Notificacion')
                ->createQuery('n')
                ->where('id_usuario = ? OR permiso IN (' . $sPermisos . ')', $this->usuario->getIdUsuario())
                ->andWhere('fecha_notificacion BETWEEN ? AND ? OR fecha_notificacion IS NULL', array(date('Y-m-d'), date('Y-m-d', strtotime('+2 week'))))
                ->execute();
    }

    public function executeRenovarPass() {
        $this->usuario = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();

        $this->form = new RenovarPassForm();
        $this->form->setDefault('correo', $this->usuario->getCorreo());
    }

    public function executeRenovar(sfWebRequest $request) {
        $usuario = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user', sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();


        $data = $request->getParameter('renovar_pass');

        if ($data['new_pass'] != "") {
            if (sfContext::getInstance()->getUser()->getGuardUser()->checkPassword($data['old_pass'])) {
                $newPass = $data['new_pass'];
                $renewPass = $data['renew_pass'];

                if ($newPass == $renewPass) {
                    sfContext::getInstance()->getUser()->getGuardUser()->setPassword($newPass);
//                    echo $newPass;
//                    joder();
                    sfContext::getInstance()->getUser()->getGuardUser()->save();
                } else {
                    $this->getUser()->setAttribute('error', 'Las contraseñas nuevas no coinciden.');
                    $this->redirect('home/renovarPass');
                }
            } else {
                $this->getUser()->setAttribute('error', 'La contraseña actual no es correcta.');
                $this->redirect('home/renovarPass');
            }
        }

        $usuario->setCorreo($data['correo']);
        $usuario->save();

        $this->getUser()->setAttribute('notice', 'Los datos han sido actualizados exitosamente.');

        $this->redirect('home/renovarPass');
    }

    public function executeRestaurarPass(sfWebRequest $request) {
        $this->tipos = Doctrine_Core::getTable('TipoDocumento')->findAll();
    }

    public function executeEnviarPass(sfWebRequest $request) {
        $tipo = $request->getParameter('tipo');
        $documento = $request->getParameter('documento');

        $usuario = Doctrine_Core::getTable('Usuario')
                ->createQuery('u')
                ->where('id_tipo_documento = ?', $tipo)
                ->andWhere('documento = ?', $documento)
                ->execute()
                ->getFirst();

        $user = Doctrine_Core::getTable('sfGuardUser')->find($usuario->getIdSfGuardUser());

        if ($user != null) {
            $chars = array();
            $chars[] = "a";
            $chars[] = "b";
            $chars[] = "c";
            $chars[] = "d";
            $chars[] = "e";
            $chars[] = "f";
            $chars[] = "g";
            $chars[] = "h";
            $chars[] = "i";
            $chars[] = "j";
            $chars[] = "k";
            $chars[] = "l";
            $chars[] = "m";
            $chars[] = "n";
            $chars[] = "o";
            $chars[] = "p";
            $chars[] = "q";
            $chars[] = "r";
            $chars[] = "s";
            $chars[] = "t";
            $chars[] = "u";
            $chars[] = "v";
            $chars[] = "w";
            $chars[] = "x";
            $chars[] = "y";
            $chars[] = "z";
            $chars[] = "A";
            $chars[] = "B";
            $chars[] = "C";
            $chars[] = "D";
            $chars[] = "E";
            $chars[] = "F";
            $chars[] = "G";
            $chars[] = "H";
            $chars[] = "I";
            $chars[] = "J";
            $chars[] = "K";
            $chars[] = "L";
            $chars[] = "M";
            $chars[] = "N";
            $chars[] = "O";
            $chars[] = "P";
            $chars[] = "Q";
            $chars[] = "R";
            $chars[] = "S";
            $chars[] = "T";
            $chars[] = "U";
            $chars[] = "V";
            $chars[] = "W";
            $chars[] = "X";
            $chars[] = "Y";
            $chars[] = "Z";
            $chars[] = "0";
            $chars[] = "1";
            $chars[] = "2";
            $chars[] = "3";
            $chars[] = "4";
            $chars[] = "5";
            $chars[] = "6";
            $chars[] = "7";
            $chars[] = "8";
            $chars[] = "9";
            $chars[] = "+";
            $chars[] = "=";
            $chars[] = "#";
            $chars[] = "$";
            $chars[] = "%";

            $password = "";
            for ($i = 0; $i < 8; $i++) {
                $password.=$chars[intval(rand(0, 66))];
            }
            
            $user->setPassword(md5($password));
            $user->save();
            
            $username=$user->getUsername();
            
            $message = $this->getMailer()->compose(
                            array('noreply@escuelaaeronautica.edu.co' => 'SiCaRa'), $usuario->getCorreo(), 'Renovacion Contrasena SiCaRa', <<<EOF
Se ha solicitado una renovaci&oacute;n de contrase&ntilde;a desde la plataforma SiCaRa.
<br />
<br />
Sus nuevos datos de acceso son:
<br />
<br />
<b>Usuario:</b> $username<br />
<b>Contrase&ntilde;a:</b> $password<br />
<br />
<br />
Para ingresar a la plataforma vaya a <a href='http://sicara.escuelaaeronautica.edu.co'>http://sicara.escuelaaeronautica.edu.co</a>.
<br />
<br />
Una vez ingrese a la plataforma, <b>cambie inmediatamente su contrase&ntilde;a!!!</b>.
<br />
<br />Cordialmente.
<br />SiCaRa - Escuela Aeron&aacute;utica de Colombia.
EOF
                    )->setContentType('text/html');

            $this->getMailer()->send($message);
        }
        
        $this->getUser()->setAttribute('notice', "Se ha enviado un correo al e-mail registrado en el sistema con sus datos de acceso.");
        
        $this->redirect('home/index');
    }

}

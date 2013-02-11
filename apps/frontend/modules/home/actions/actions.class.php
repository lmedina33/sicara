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
        $this->tipos= Doctrine_Core::getTable('TipoDocumento')->findAll();
    }

}

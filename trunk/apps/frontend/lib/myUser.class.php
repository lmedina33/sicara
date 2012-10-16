<?php

//class myUser extends sfBasicSecurityUser
class myUser extends sfGuardSecurityUser
{
    public function listCredentials(){
        $permisos = Doctrine_Core::getTable("sfGuardPermission")->findAll();
        
        $permisosUsuario = array ();
        
        foreach($permisos as $permiso){
            if($this->hasCredential($permiso->getName())){
                $permisosUsuario[] = $permiso->getName();
            }
        }
        
        return $permisosUsuario;
    }
}

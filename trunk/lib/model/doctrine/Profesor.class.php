<?php

/**
 * Profesor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Profesor extends BaseProfesor {

    function __toString() {
        return $this->getCodigoProfesor().' - '.$this->getUsuario()->getPrimerApellido().' '.$this->getUsuario()->getSegundoApellido().' '.$this->getUsuario()->getPrimerNombre().' '.$this->getUsuario()->getSegundoNombre();
    }

}
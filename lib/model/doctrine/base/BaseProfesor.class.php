<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Profesor', 'doctrine');

/**
 * BaseProfesor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $codigo_profesor
 * @property date $fecha_ingreso
 * @property date $fecha_retiro
 * @property integer $id_usuario
 * @property Usuario $Usuario
 * @property Doctrine_Collection $Grupo
 * @property Doctrine_Collection $CertificacionDocente
 * 
 * @method string              getCodigoProfesor()       Returns the current record's "codigo_profesor" value
 * @method date                getFechaIngreso()         Returns the current record's "fecha_ingreso" value
 * @method date                getFechaRetiro()          Returns the current record's "fecha_retiro" value
 * @method integer             getIdUsuario()            Returns the current record's "id_usuario" value
 * @method Usuario             getUsuario()              Returns the current record's "Usuario" value
 * @method Doctrine_Collection getGrupo()                Returns the current record's "Grupo" collection
 * @method Doctrine_Collection getCertificacionDocente() Returns the current record's "CertificacionDocente" collection
 * @method Profesor            setCodigoProfesor()       Sets the current record's "codigo_profesor" value
 * @method Profesor            setFechaIngreso()         Sets the current record's "fecha_ingreso" value
 * @method Profesor            setFechaRetiro()          Sets the current record's "fecha_retiro" value
 * @method Profesor            setIdUsuario()            Sets the current record's "id_usuario" value
 * @method Profesor            setUsuario()              Sets the current record's "Usuario" value
 * @method Profesor            setGrupo()                Sets the current record's "Grupo" collection
 * @method Profesor            setCertificacionDocente() Sets the current record's "CertificacionDocente" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfesor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profesor');
        $this->hasColumn('codigo_profesor', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('fecha_ingreso', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_retiro', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_usuario', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Usuario', array(
             'local' => 'id_usuario',
             'foreign' => 'id_usuario'));

        $this->hasMany('Grupo', array(
             'local' => 'codigo_profesor',
             'foreign' => 'codigo_profesor'));

        $this->hasMany('CertificacionDocente', array(
             'local' => 'codigo_profesor',
             'foreign' => 'codigo_profesor'));
    }
}
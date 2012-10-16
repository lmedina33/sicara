<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Notificacion', 'doctrine');

/**
 * BaseNotificacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_notificacion
 * @property string $titulo
 * @property string $contenido
 * @property string $permiso
 * @property integer $id_usuario
 * @property date $fecha_notificacion
 * @property Usuario $Usuario
 * 
 * @method integer      getIdNotificacion()     Returns the current record's "id_notificacion" value
 * @method string       getTitulo()             Returns the current record's "titulo" value
 * @method string       getContenido()          Returns the current record's "contenido" value
 * @method string       getPermiso()            Returns the current record's "permiso" value
 * @method integer      getIdUsuario()          Returns the current record's "id_usuario" value
 * @method date         getFechaNotificacion()  Returns the current record's "fecha_notificacion" value
 * @method Usuario      getUsuario()            Returns the current record's "Usuario" value
 * @method Notificacion setIdNotificacion()     Sets the current record's "id_notificacion" value
 * @method Notificacion setTitulo()             Sets the current record's "titulo" value
 * @method Notificacion setContenido()          Sets the current record's "contenido" value
 * @method Notificacion setPermiso()            Sets the current record's "permiso" value
 * @method Notificacion setIdUsuario()          Sets the current record's "id_usuario" value
 * @method Notificacion setFechaNotificacion()  Sets the current record's "fecha_notificacion" value
 * @method Notificacion setUsuario()            Sets the current record's "Usuario" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNotificacion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('notificacion');
        $this->hasColumn('id_notificacion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('titulo', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('contenido', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('permiso', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('id_usuario', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'autoincrement' => false,
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('fecha_notificacion', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Usuario', array(
             'local' => 'id_usuario',
             'foreign' => 'id_usuario'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
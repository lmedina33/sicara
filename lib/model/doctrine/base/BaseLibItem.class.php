<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('LibItem', 'doctrine');

/**
 * BaseLibItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $serial_lib_item
 * @property string $descripcion
 * @property string $ubicacion
 * @property date $fecha_actualizacion
 * @property integer $is_prestado
 * @property integer $id_lib_estado
 * @property integer $id_lib_material
 * @property LibEstado $LibEstado
 * @property LibMaterial $LibMaterial
 * @property Doctrine_Collection $LibPrestamo
 * @property Doctrine_Collection $LibSancion
 * 
 * @method string              getSerialLibItem()       Returns the current record's "serial_lib_item" value
 * @method string              getDescripcion()         Returns the current record's "descripcion" value
 * @method string              getUbicacion()           Returns the current record's "ubicacion" value
 * @method date                getFechaActualizacion()  Returns the current record's "fecha_actualizacion" value
 * @method integer             getIsPrestado()          Returns the current record's "is_prestado" value
 * @method integer             getIdLibEstado()         Returns the current record's "id_lib_estado" value
 * @method integer             getIdLibMaterial()       Returns the current record's "id_lib_material" value
 * @method LibEstado           getLibEstado()           Returns the current record's "LibEstado" value
 * @method LibMaterial         getLibMaterial()         Returns the current record's "LibMaterial" value
 * @method Doctrine_Collection getLibPrestamo()         Returns the current record's "LibPrestamo" collection
 * @method Doctrine_Collection getLibSancion()          Returns the current record's "LibSancion" collection
 * @method LibItem             setSerialLibItem()       Sets the current record's "serial_lib_item" value
 * @method LibItem             setDescripcion()         Sets the current record's "descripcion" value
 * @method LibItem             setUbicacion()           Sets the current record's "ubicacion" value
 * @method LibItem             setFechaActualizacion()  Sets the current record's "fecha_actualizacion" value
 * @method LibItem             setIsPrestado()          Sets the current record's "is_prestado" value
 * @method LibItem             setIdLibEstado()         Sets the current record's "id_lib_estado" value
 * @method LibItem             setIdLibMaterial()       Sets the current record's "id_lib_material" value
 * @method LibItem             setLibEstado()           Sets the current record's "LibEstado" value
 * @method LibItem             setLibMaterial()         Sets the current record's "LibMaterial" value
 * @method LibItem             setLibPrestamo()         Sets the current record's "LibPrestamo" collection
 * @method LibItem             setLibSancion()          Sets the current record's "LibSancion" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLibItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lib_item');
        $this->hasColumn('serial_lib_item', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('descripcion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('ubicacion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('fecha_actualizacion', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('is_prestado', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_lib_estado', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_lib_material', 'integer', 4, array(
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
        $this->hasOne('LibEstado', array(
             'local' => 'id_lib_estado',
             'foreign' => 'id_lib_estado'));

        $this->hasOne('LibMaterial', array(
             'local' => 'id_lib_material',
             'foreign' => 'id_lib_material'));

        $this->hasMany('LibPrestamo', array(
             'local' => 'serial_lib_item',
             'foreign' => 'serial_lib_item'));

        $this->hasMany('LibSancion', array(
             'local' => 'serial_lib_item',
             'foreign' => 'serial_lib_item'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
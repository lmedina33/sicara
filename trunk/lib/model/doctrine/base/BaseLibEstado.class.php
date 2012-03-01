<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('LibEstado', 'doctrine');

/**
 * BaseLibEstado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_lib_estado
 * @property string $nombre
 * @property string $descripcion
 * @property Doctrine_Collection $LibItem
 * 
 * @method integer             getIdLibEstado()   Returns the current record's "id_lib_estado" value
 * @method string              getNombre()        Returns the current record's "nombre" value
 * @method string              getDescripcion()   Returns the current record's "descripcion" value
 * @method Doctrine_Collection getLibItem()       Returns the current record's "LibItem" collection
 * @method LibEstado           setIdLibEstado()   Sets the current record's "id_lib_estado" value
 * @method LibEstado           setNombre()        Sets the current record's "nombre" value
 * @method LibEstado           setDescripcion()   Sets the current record's "descripcion" value
 * @method LibEstado           setLibItem()       Sets the current record's "LibItem" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLibEstado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lib_estado');
        $this->hasColumn('id_lib_estado', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('LibItem', array(
             'local' => 'id_lib_estado',
             'foreign' => 'id_lib_estado'));
    }
}
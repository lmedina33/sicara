<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RefTipoSancion', 'doctrine');

/**
 * BaseRefTipoSancion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_ref_tipo_sancion
 * @property string $nombre
 * @property string $descripcion
 * @property Doctrine_Collection $RefSancion
 * 
 * @method integer             getIdRefTipoSancion()    Returns the current record's "id_ref_tipo_sancion" value
 * @method string              getNombre()              Returns the current record's "nombre" value
 * @method string              getDescripcion()         Returns the current record's "descripcion" value
 * @method Doctrine_Collection getRefSancion()          Returns the current record's "RefSancion" collection
 * @method RefTipoSancion      setIdRefTipoSancion()    Sets the current record's "id_ref_tipo_sancion" value
 * @method RefTipoSancion      setNombre()              Sets the current record's "nombre" value
 * @method RefTipoSancion      setDescripcion()         Sets the current record's "descripcion" value
 * @method RefTipoSancion      setRefSancion()          Sets the current record's "RefSancion" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRefTipoSancion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ref_tipo_sancion');
        $this->hasColumn('id_ref_tipo_sancion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
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
        $this->hasMany('RefSancion', array(
             'local' => 'id_ref_tipo_sancion',
             'foreign' => 'id_ref_tipo_sancion'));
    }
}
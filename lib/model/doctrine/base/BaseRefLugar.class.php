<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RefLugar', 'doctrine');

/**
 * BaseRefLugar
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_ref_lugar
 * @property string $nombre
 * @property string $descripcion
 * @property integer $capacidad_personas
 * @property string $ubicacion
 * @property integer $id_ref_lugar_contenedor
 * @property integer $id_ref_tipo_lugar
 * @property RefTipoLugar $RefTipoLugar
 * @property Doctrine_Collection $RefElemento
 * 
 * @method integer             getIdRefLugar()              Returns the current record's "id_ref_lugar" value
 * @method string              getNombre()                  Returns the current record's "nombre" value
 * @method string              getDescripcion()             Returns the current record's "descripcion" value
 * @method integer             getCapacidadPersonas()       Returns the current record's "capacidad_personas" value
 * @method string              getUbicacion()               Returns the current record's "ubicacion" value
 * @method integer             getIdRefLugarContenedor()    Returns the current record's "id_ref_lugar_contenedor" value
 * @method integer             getIdRefTipoLugar()          Returns the current record's "id_ref_tipo_lugar" value
 * @method RefTipoLugar        getRefTipoLugar()            Returns the current record's "RefTipoLugar" value
 * @method Doctrine_Collection getRefElemento()             Returns the current record's "RefElemento" collection
 * @method RefLugar            setIdRefLugar()              Sets the current record's "id_ref_lugar" value
 * @method RefLugar            setNombre()                  Sets the current record's "nombre" value
 * @method RefLugar            setDescripcion()             Sets the current record's "descripcion" value
 * @method RefLugar            setCapacidadPersonas()       Sets the current record's "capacidad_personas" value
 * @method RefLugar            setUbicacion()               Sets the current record's "ubicacion" value
 * @method RefLugar            setIdRefLugarContenedor()    Sets the current record's "id_ref_lugar_contenedor" value
 * @method RefLugar            setIdRefTipoLugar()          Sets the current record's "id_ref_tipo_lugar" value
 * @method RefLugar            setRefTipoLugar()            Sets the current record's "RefTipoLugar" value
 * @method RefLugar            setRefElemento()             Sets the current record's "RefElemento" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRefLugar extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ref_lugar');
        $this->hasColumn('id_ref_lugar', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
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
        $this->hasColumn('capacidad_personas', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasColumn('id_ref_lugar_contenedor', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_ref_tipo_lugar', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('RefTipoLugar', array(
             'local' => 'id_ref_tipo_lugar',
             'foreign' => 'id_ref_tipo_lugar'));

        $this->hasMany('RefElemento', array(
             'local' => 'id_ref_lugar',
             'foreign' => 'id_ref_lugar'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
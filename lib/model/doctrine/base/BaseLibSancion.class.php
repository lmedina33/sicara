<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('LibSancion', 'doctrine');

/**
 * BaseLibSancion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_lib_sancion
 * @property float $cantidad
 * @property string $codigo_lib_material
 * @property timestamp $fecha_imposicion
 * @property timestamp $fecha_inicio
 * @property timestamp $fecha_fin
 * @property string $observaciones
 * @property integer $id_sancionado
 * @property integer $id_ejecutor
 * @property integer $id_tipo_sancion
 * @property Usuario $Usuario
 * @property Usuario $Usuario_2
 * @property LibTipoSancion $LibTipoSancion
 * 
 * @method integer        getIdLibSancion()        Returns the current record's "id_lib_sancion" value
 * @method float          getCantidad()            Returns the current record's "cantidad" value
 * @method string         getCodigoLibMaterial()   Returns the current record's "codigo_lib_material" value
 * @method timestamp      getFechaImposicion()     Returns the current record's "fecha_imposicion" value
 * @method timestamp      getFechaInicio()         Returns the current record's "fecha_inicio" value
 * @method timestamp      getFechaFin()            Returns the current record's "fecha_fin" value
 * @method string         getObservaciones()       Returns the current record's "observaciones" value
 * @method integer        getIdSancionado()        Returns the current record's "id_sancionado" value
 * @method integer        getIdEjecutor()          Returns the current record's "id_ejecutor" value
 * @method integer        getIdTipoSancion()       Returns the current record's "id_tipo_sancion" value
 * @method Usuario        getUsuario()             Returns the current record's "Usuario" value
 * @method Usuario        getUsuario2()            Returns the current record's "Usuario_2" value
 * @method LibTipoSancion getLibTipoSancion()      Returns the current record's "LibTipoSancion" value
 * @method LibSancion     setIdLibSancion()        Sets the current record's "id_lib_sancion" value
 * @method LibSancion     setCantidad()            Sets the current record's "cantidad" value
 * @method LibSancion     setCodigoLibMaterial()   Sets the current record's "codigo_lib_material" value
 * @method LibSancion     setFechaImposicion()     Sets the current record's "fecha_imposicion" value
 * @method LibSancion     setFechaInicio()         Sets the current record's "fecha_inicio" value
 * @method LibSancion     setFechaFin()            Sets the current record's "fecha_fin" value
 * @method LibSancion     setObservaciones()       Sets the current record's "observaciones" value
 * @method LibSancion     setIdSancionado()        Sets the current record's "id_sancionado" value
 * @method LibSancion     setIdEjecutor()          Sets the current record's "id_ejecutor" value
 * @method LibSancion     setIdTipoSancion()       Sets the current record's "id_tipo_sancion" value
 * @method LibSancion     setUsuario()             Sets the current record's "Usuario" value
 * @method LibSancion     setUsuario2()            Sets the current record's "Usuario_2" value
 * @method LibSancion     setLibTipoSancion()      Sets the current record's "LibTipoSancion" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLibSancion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lib_sancion');
        $this->hasColumn('id_lib_sancion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('cantidad', 'float', 18, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 18,
             ));
        $this->hasColumn('codigo_lib_material', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_imposicion', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_inicio', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_fin', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('observaciones', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('id_sancionado', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_ejecutor', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_tipo_sancion', 'integer', 4, array(
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
             'local' => 'id_ejecutor',
             'foreign' => 'id_usuario'));

        $this->hasOne('Usuario as Usuario_2', array(
             'local' => 'id_sancionado',
             'foreign' => 'id_usuario'));

        $this->hasOne('LibTipoSancion', array(
             'local' => 'id_tipo_sancion',
             'foreign' => 'id_lib_tipo_sancion'));
    }
}
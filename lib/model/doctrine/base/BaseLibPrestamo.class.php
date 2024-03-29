<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('LibPrestamo', 'doctrine');

/**
 * BaseLibPrestamo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_prestamo
 * @property integer $id_prestamista
 * @property integer $id_solicitante
 * @property timestamp $fecha_solicitud
 * @property timestamp $fecha_entrega
 * @property timestamp $fecha_retorno
 * @property timestamp $fecha_devolucion
 * @property string $observaciones
 * @property string $serial_lib_item
 * @property LibItem $LibItem
 * @property Usuario $Usuario
 * @property Usuario $Usuario_3
 * 
 * @method integer     getIdPrestamo()       Returns the current record's "id_prestamo" value
 * @method integer     getIdPrestamista()    Returns the current record's "id_prestamista" value
 * @method integer     getIdSolicitante()    Returns the current record's "id_solicitante" value
 * @method timestamp   getFechaSolicitud()   Returns the current record's "fecha_solicitud" value
 * @method timestamp   getFechaEntrega()     Returns the current record's "fecha_entrega" value
 * @method timestamp   getFechaRetorno()     Returns the current record's "fecha_retorno" value
 * @method timestamp   getFechaDevolucion()  Returns the current record's "fecha_devolucion" value
 * @method string      getObservaciones()    Returns the current record's "observaciones" value
 * @method string      getSerialLibItem()    Returns the current record's "serial_lib_item" value
 * @method LibItem     getLibItem()          Returns the current record's "LibItem" value
 * @method Usuario     getUsuario()          Returns the current record's "Usuario" value
 * @method Usuario     getUsuario3()         Returns the current record's "Usuario_3" value
 * @method LibPrestamo setIdPrestamo()       Sets the current record's "id_prestamo" value
 * @method LibPrestamo setIdPrestamista()    Sets the current record's "id_prestamista" value
 * @method LibPrestamo setIdSolicitante()    Sets the current record's "id_solicitante" value
 * @method LibPrestamo setFechaSolicitud()   Sets the current record's "fecha_solicitud" value
 * @method LibPrestamo setFechaEntrega()     Sets the current record's "fecha_entrega" value
 * @method LibPrestamo setFechaRetorno()     Sets the current record's "fecha_retorno" value
 * @method LibPrestamo setFechaDevolucion()  Sets the current record's "fecha_devolucion" value
 * @method LibPrestamo setObservaciones()    Sets the current record's "observaciones" value
 * @method LibPrestamo setSerialLibItem()    Sets the current record's "serial_lib_item" value
 * @method LibPrestamo setLibItem()          Sets the current record's "LibItem" value
 * @method LibPrestamo setUsuario()          Sets the current record's "Usuario" value
 * @method LibPrestamo setUsuario3()         Sets the current record's "Usuario_3" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLibPrestamo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lib_prestamo');
        $this->hasColumn('id_prestamo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_prestamista', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_solicitante', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fecha_solicitud', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_entrega', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_retorno', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_devolucion', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
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
        $this->hasColumn('serial_lib_item', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('LibItem', array(
             'local' => 'serial_lib_item',
             'foreign' => 'serial_lib_item'));

        $this->hasOne('Usuario', array(
             'local' => 'id_prestamista',
             'foreign' => 'id_usuario'));

        $this->hasOne('Usuario as Usuario_3', array(
             'local' => 'id_solicitante',
             'foreign' => 'id_usuario'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
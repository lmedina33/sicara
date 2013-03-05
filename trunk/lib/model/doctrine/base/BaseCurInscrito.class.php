<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CurInscrito', 'doctrine');

/**
 * BaseCurInscrito
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_cur_inscrito
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $documento
 * @property integer $id_tipo_documento
 * @property string $lugar_expedicion
 * @property string $telefono1
 * @property string $telefono2
 * @property string $correo
 * @property TipoDocumento $TipoDocumento
 * @property Doctrine_Collection $CurFormulario
 * 
 * @method integer             getIdCurInscrito()     Returns the current record's "id_cur_inscrito" value
 * @method string              getPrimerNombre()      Returns the current record's "primer_nombre" value
 * @method string              getSegundoNombre()     Returns the current record's "segundo_nombre" value
 * @method string              getPrimerApellido()    Returns the current record's "primer_apellido" value
 * @method string              getSegundoApellido()   Returns the current record's "segundo_apellido" value
 * @method string              getDocumento()         Returns the current record's "documento" value
 * @method integer             getIdTipoDocumento()   Returns the current record's "id_tipo_documento" value
 * @method string              getLugarExpedicion()   Returns the current record's "lugar_expedicion" value
 * @method string              getTelefono1()         Returns the current record's "telefono1" value
 * @method string              getTelefono2()         Returns the current record's "telefono2" value
 * @method string              getCorreo()            Returns the current record's "correo" value
 * @method TipoDocumento       getTipoDocumento()     Returns the current record's "TipoDocumento" value
 * @method Doctrine_Collection getCurFormulario()     Returns the current record's "CurFormulario" collection
 * @method CurInscrito         setIdCurInscrito()     Sets the current record's "id_cur_inscrito" value
 * @method CurInscrito         setPrimerNombre()      Sets the current record's "primer_nombre" value
 * @method CurInscrito         setSegundoNombre()     Sets the current record's "segundo_nombre" value
 * @method CurInscrito         setPrimerApellido()    Sets the current record's "primer_apellido" value
 * @method CurInscrito         setSegundoApellido()   Sets the current record's "segundo_apellido" value
 * @method CurInscrito         setDocumento()         Sets the current record's "documento" value
 * @method CurInscrito         setIdTipoDocumento()   Sets the current record's "id_tipo_documento" value
 * @method CurInscrito         setLugarExpedicion()   Sets the current record's "lugar_expedicion" value
 * @method CurInscrito         setTelefono1()         Sets the current record's "telefono1" value
 * @method CurInscrito         setTelefono2()         Sets the current record's "telefono2" value
 * @method CurInscrito         setCorreo()            Sets the current record's "correo" value
 * @method CurInscrito         setTipoDocumento()     Sets the current record's "TipoDocumento" value
 * @method CurInscrito         setCurFormulario()     Sets the current record's "CurFormulario" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurInscrito extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cur_inscrito');
        $this->hasColumn('id_cur_inscrito', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('primer_nombre', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('segundo_nombre', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('primer_apellido', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('segundo_apellido', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('documento', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('id_tipo_documento', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('lugar_expedicion', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
        $this->hasColumn('telefono1', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('telefono2', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('correo', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TipoDocumento', array(
             'local' => 'id_tipo_documento',
             'foreign' => 'id_tipo_documento'));

        $this->hasMany('CurFormulario', array(
             'local' => 'id_cur_inscrito',
             'foreign' => 'id_cur_inscrito'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
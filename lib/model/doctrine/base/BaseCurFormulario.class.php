<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CurFormulario', 'doctrine');

/**
 * BaseCurFormulario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_cur_formulario
 * @property string $direccion
 * @property string $dependencia
 * @property string $cargo
 * @property string $telefono
 * @property string $horario
 * @property string $licencia_basica1
 * @property string $numero_licencia1
 * @property string $habilitacion1
 * @property date $fecha_expedicion1
 * @property date $fecha_repaso1
 * @property string $licencia_basica2
 * @property string $numero_licencia2
 * @property string $habilitacion2
 * @property date $fecha_expedicion2
 * @property date $fecha_repaso2
 * @property string $licencia_basica3
 * @property string $numero_licencia3
 * @property string $habilitacion3
 * @property date $fecha_expedicion3
 * @property date $fecha_repaso3
 * @property string $licencia_basica4
 * @property string $numero_licencia4
 * @property string $habilitacion4
 * @property date $fecha_expedicion4
 * @property date $fecha_repaso4
 * @property integer $id_cur_inscrito
 * @property integer $id_cur_curso
 * @property CurInscrito $CurInscrito
 * @property CurCurso $CurCurso
 * 
 * @method integer       getIdCurFormulario()   Returns the current record's "id_cur_formulario" value
 * @method string        getDireccion()         Returns the current record's "direccion" value
 * @method string        getDependencia()       Returns the current record's "dependencia" value
 * @method string        getCargo()             Returns the current record's "cargo" value
 * @method string        getTelefono()          Returns the current record's "telefono" value
 * @method string        getHorario()           Returns the current record's "horario" value
 * @method string        getLicenciaBasica1()   Returns the current record's "licencia_basica1" value
 * @method string        getNumeroLicencia1()   Returns the current record's "numero_licencia1" value
 * @method string        getHabilitacion1()     Returns the current record's "habilitacion1" value
 * @method date          getFechaExpedicion1()  Returns the current record's "fecha_expedicion1" value
 * @method date          getFechaRepaso1()      Returns the current record's "fecha_repaso1" value
 * @method string        getLicenciaBasica2()   Returns the current record's "licencia_basica2" value
 * @method string        getNumeroLicencia2()   Returns the current record's "numero_licencia2" value
 * @method string        getHabilitacion2()     Returns the current record's "habilitacion2" value
 * @method date          getFechaExpedicion2()  Returns the current record's "fecha_expedicion2" value
 * @method date          getFechaRepaso2()      Returns the current record's "fecha_repaso2" value
 * @method string        getLicenciaBasica3()   Returns the current record's "licencia_basica3" value
 * @method string        getNumeroLicencia3()   Returns the current record's "numero_licencia3" value
 * @method string        getHabilitacion3()     Returns the current record's "habilitacion3" value
 * @method date          getFechaExpedicion3()  Returns the current record's "fecha_expedicion3" value
 * @method date          getFechaRepaso3()      Returns the current record's "fecha_repaso3" value
 * @method string        getLicenciaBasica4()   Returns the current record's "licencia_basica4" value
 * @method string        getNumeroLicencia4()   Returns the current record's "numero_licencia4" value
 * @method string        getHabilitacion4()     Returns the current record's "habilitacion4" value
 * @method date          getFechaExpedicion4()  Returns the current record's "fecha_expedicion4" value
 * @method date          getFechaRepaso4()      Returns the current record's "fecha_repaso4" value
 * @method integer       getIdCurInscrito()     Returns the current record's "id_cur_inscrito" value
 * @method integer       getIdCurCurso()        Returns the current record's "id_cur_curso" value
 * @method CurInscrito   getCurInscrito()       Returns the current record's "CurInscrito" value
 * @method CurCurso      getCurCurso()          Returns the current record's "CurCurso" value
 * @method CurFormulario setIdCurFormulario()   Sets the current record's "id_cur_formulario" value
 * @method CurFormulario setDireccion()         Sets the current record's "direccion" value
 * @method CurFormulario setDependencia()       Sets the current record's "dependencia" value
 * @method CurFormulario setCargo()             Sets the current record's "cargo" value
 * @method CurFormulario setTelefono()          Sets the current record's "telefono" value
 * @method CurFormulario setHorario()           Sets the current record's "horario" value
 * @method CurFormulario setLicenciaBasica1()   Sets the current record's "licencia_basica1" value
 * @method CurFormulario setNumeroLicencia1()   Sets the current record's "numero_licencia1" value
 * @method CurFormulario setHabilitacion1()     Sets the current record's "habilitacion1" value
 * @method CurFormulario setFechaExpedicion1()  Sets the current record's "fecha_expedicion1" value
 * @method CurFormulario setFechaRepaso1()      Sets the current record's "fecha_repaso1" value
 * @method CurFormulario setLicenciaBasica2()   Sets the current record's "licencia_basica2" value
 * @method CurFormulario setNumeroLicencia2()   Sets the current record's "numero_licencia2" value
 * @method CurFormulario setHabilitacion2()     Sets the current record's "habilitacion2" value
 * @method CurFormulario setFechaExpedicion2()  Sets the current record's "fecha_expedicion2" value
 * @method CurFormulario setFechaRepaso2()      Sets the current record's "fecha_repaso2" value
 * @method CurFormulario setLicenciaBasica3()   Sets the current record's "licencia_basica3" value
 * @method CurFormulario setNumeroLicencia3()   Sets the current record's "numero_licencia3" value
 * @method CurFormulario setHabilitacion3()     Sets the current record's "habilitacion3" value
 * @method CurFormulario setFechaExpedicion3()  Sets the current record's "fecha_expedicion3" value
 * @method CurFormulario setFechaRepaso3()      Sets the current record's "fecha_repaso3" value
 * @method CurFormulario setLicenciaBasica4()   Sets the current record's "licencia_basica4" value
 * @method CurFormulario setNumeroLicencia4()   Sets the current record's "numero_licencia4" value
 * @method CurFormulario setHabilitacion4()     Sets the current record's "habilitacion4" value
 * @method CurFormulario setFechaExpedicion4()  Sets the current record's "fecha_expedicion4" value
 * @method CurFormulario setFechaRepaso4()      Sets the current record's "fecha_repaso4" value
 * @method CurFormulario setIdCurInscrito()     Sets the current record's "id_cur_inscrito" value
 * @method CurFormulario setIdCurCurso()        Sets the current record's "id_cur_curso" value
 * @method CurFormulario setCurInscrito()       Sets the current record's "CurInscrito" value
 * @method CurFormulario setCurCurso()          Sets the current record's "CurCurso" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurFormulario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cur_formulario');
        $this->hasColumn('id_cur_formulario', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('direccion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('dependencia', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('cargo', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('telefono', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('horario', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('licencia_basica1', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('numero_licencia1', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('habilitacion1', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('fecha_expedicion1', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_repaso1', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('licencia_basica2', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('numero_licencia2', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('habilitacion2', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('fecha_expedicion2', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_repaso2', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('licencia_basica3', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('numero_licencia3', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('habilitacion3', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('fecha_expedicion3', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_repaso3', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('licencia_basica4', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('numero_licencia4', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('habilitacion4', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('fecha_expedicion4', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_repaso4', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_cur_inscrito', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_cur_curso', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CurInscrito', array(
             'local' => 'id_cur_inscrito',
             'foreign' => 'id_cur_inscrito'));

        $this->hasOne('CurCurso', array(
             'local' => 'id_cur_curso',
             'foreign' => 'id_cur_curso'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
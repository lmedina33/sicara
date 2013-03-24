<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CertificacionDocente', 'doctrine');

/**
 * BaseCertificacionDocente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_certificacion_docente
 * @property string $titulo
 * @property string $numero
 * @property integer $id_tipo_certificacion
 * @property string $codigo_profesor
 * @property Profesor $Profesor
 * @property TipoCertificacion $TipoCertificacion
 * @property Doctrine_Collection $Grupo
 * @property Doctrine_Collection $Grupo_2
 * 
 * @method integer              getIdCertificacionDocente()   Returns the current record's "id_certificacion_docente" value
 * @method string               getTitulo()                   Returns the current record's "titulo" value
 * @method string               getNumero()                   Returns the current record's "numero" value
 * @method integer              getIdTipoCertificacion()      Returns the current record's "id_tipo_certificacion" value
 * @method string               getCodigoProfesor()           Returns the current record's "codigo_profesor" value
 * @method Profesor             getProfesor()                 Returns the current record's "Profesor" value
 * @method TipoCertificacion    getTipoCertificacion()        Returns the current record's "TipoCertificacion" value
 * @method Doctrine_Collection  getGrupo()                    Returns the current record's "Grupo" collection
 * @method Doctrine_Collection  getGrupo2()                   Returns the current record's "Grupo_2" collection
 * @method CertificacionDocente setIdCertificacionDocente()   Sets the current record's "id_certificacion_docente" value
 * @method CertificacionDocente setTitulo()                   Sets the current record's "titulo" value
 * @method CertificacionDocente setNumero()                   Sets the current record's "numero" value
 * @method CertificacionDocente setIdTipoCertificacion()      Sets the current record's "id_tipo_certificacion" value
 * @method CertificacionDocente setCodigoProfesor()           Sets the current record's "codigo_profesor" value
 * @method CertificacionDocente setProfesor()                 Sets the current record's "Profesor" value
 * @method CertificacionDocente setTipoCertificacion()        Sets the current record's "TipoCertificacion" value
 * @method CertificacionDocente setGrupo()                    Sets the current record's "Grupo" collection
 * @method CertificacionDocente setGrupo2()                   Sets the current record's "Grupo_2" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCertificacionDocente extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('certificacion_docente');
        $this->hasColumn('id_certificacion_docente', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('titulo', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('numero', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('id_tipo_certificacion', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('codigo_profesor', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Profesor', array(
             'local' => 'codigo_profesor',
             'foreign' => 'codigo_profesor'));

        $this->hasOne('TipoCertificacion', array(
             'local' => 'id_tipo_certificacion',
             'foreign' => 'id_tipo_certificacion'));

        $this->hasMany('Grupo', array(
             'local' => 'id_certificacion_docente',
             'foreign' => 'certificacion_primaria'));

        $this->hasMany('Grupo as Grupo_2', array(
             'local' => 'id_certificacion_docente',
             'foreign' => 'certificacion_secundaria'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
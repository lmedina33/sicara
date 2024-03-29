<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Grupo', 'doctrine');

/**
 * BaseGrupo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_grupo
 * @property string $nombre
 * @property integer $id_periodo
 * @property integer $certificacion_primaria
 * @property integer $certificacion_secundaria
 * @property date $fecha_inicio
 * @property date $fecha_fin
 * @property string $observaciones
 * @property string $codigo_asignatura
 * @property string $codigo_profesor
 * @property timestamp $inicio_calificacion
 * @property timestamp $fin_calificacion
 * @property Asignatura $Asignatura
 * @property Profesor $Profesor
 * @property PeriodoAcademico $PeriodoAcademico
 * @property Doctrine_Collection $GrupoHasEstudiante
 * @property CertificacionDocente $CertificacionDocente
 * 
 * @method integer              getIdGrupo()                  Returns the current record's "id_grupo" value
 * @method string               getNombre()                   Returns the current record's "nombre" value
 * @method integer              getIdPeriodo()                Returns the current record's "id_periodo" value
 * @method integer              getCertificacionPrimaria()    Returns the current record's "certificacion_primaria" value
 * @method integer              getCertificacionSecundaria()  Returns the current record's "certificacion_secundaria" value
 * @method date                 getFechaInicio()              Returns the current record's "fecha_inicio" value
 * @method date                 getFechaFin()                 Returns the current record's "fecha_fin" value
 * @method string               getObservaciones()            Returns the current record's "observaciones" value
 * @method string               getCodigoAsignatura()         Returns the current record's "codigo_asignatura" value
 * @method string               getCodigoProfesor()           Returns the current record's "codigo_profesor" value
 * @method timestamp            getInicioCalificacion()       Returns the current record's "inicio_calificacion" value
 * @method timestamp            getFinCalificacion()          Returns the current record's "fin_calificacion" value
 * @method Asignatura           getAsignatura()               Returns the current record's "Asignatura" value
 * @method Profesor             getProfesor()                 Returns the current record's "Profesor" value
 * @method PeriodoAcademico     getPeriodoAcademico()         Returns the current record's "PeriodoAcademico" value
 * @method Doctrine_Collection  getGrupoHasEstudiante()       Returns the current record's "GrupoHasEstudiante" collection
 * @method CertificacionDocente getCertificacionDocente()     Returns the current record's "CertificacionDocente" value
 * @method Grupo                setIdGrupo()                  Sets the current record's "id_grupo" value
 * @method Grupo                setNombre()                   Sets the current record's "nombre" value
 * @method Grupo                setIdPeriodo()                Sets the current record's "id_periodo" value
 * @method Grupo                setCertificacionPrimaria()    Sets the current record's "certificacion_primaria" value
 * @method Grupo                setCertificacionSecundaria()  Sets the current record's "certificacion_secundaria" value
 * @method Grupo                setFechaInicio()              Sets the current record's "fecha_inicio" value
 * @method Grupo                setFechaFin()                 Sets the current record's "fecha_fin" value
 * @method Grupo                setObservaciones()            Sets the current record's "observaciones" value
 * @method Grupo                setCodigoAsignatura()         Sets the current record's "codigo_asignatura" value
 * @method Grupo                setCodigoProfesor()           Sets the current record's "codigo_profesor" value
 * @method Grupo                setInicioCalificacion()       Sets the current record's "inicio_calificacion" value
 * @method Grupo                setFinCalificacion()          Sets the current record's "fin_calificacion" value
 * @method Grupo                setAsignatura()               Sets the current record's "Asignatura" value
 * @method Grupo                setProfesor()                 Sets the current record's "Profesor" value
 * @method Grupo                setPeriodoAcademico()         Sets the current record's "PeriodoAcademico" value
 * @method Grupo                setGrupoHasEstudiante()       Sets the current record's "GrupoHasEstudiante" collection
 * @method Grupo                setCertificacionDocente()     Sets the current record's "CertificacionDocente" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGrupo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('grupo');
        $this->hasColumn('id_grupo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 250, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 250,
             ));
        $this->hasColumn('id_periodo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('certificacion_primaria', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('certificacion_secundaria', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fecha_inicio', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fecha_fin', 'date', 25, array(
             'type' => 'date',
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
        $this->hasColumn('codigo_asignatura', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('codigo_profesor', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('inicio_calificacion', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fin_calificacion', 'timestamp', 25, array(
             'type' => 'timestamp',
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
        $this->hasOne('Asignatura', array(
             'local' => 'codigo_asignatura',
             'foreign' => 'codigo_asignatura'));

        $this->hasOne('Profesor', array(
             'local' => 'codigo_profesor',
             'foreign' => 'codigo_profesor'));

        $this->hasOne('PeriodoAcademico', array(
             'local' => 'id_periodo',
             'foreign' => 'id_periodo_academico'));

        $this->hasMany('GrupoHasEstudiante', array(
             'local' => 'id_grupo',
             'foreign' => 'id_grupo'));

        $this->hasOne('CertificacionDocente', array(
             'local' => 'certificacion_primaria',
             'foreign' => 'id_certificacion_docente'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
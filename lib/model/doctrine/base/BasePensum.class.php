<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pensum', 'doctrine');

/**
 * BasePensum
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $codigo_pensum
 * @property string $nombre
 * @property float $nota_aprobatoria
 * @property integer $is_inscribible
 * @property Doctrine_Collection $Estudiante
 * @property Doctrine_Collection $PeriodoAcademico
 * @property Doctrine_Collection $Semestre
 * @property Doctrine_Collection $FormularioInscripcion
 * @property Doctrine_Collection $Homologacion
 * 
 * @method string              getCodigoPensum()          Returns the current record's "codigo_pensum" value
 * @method string              getNombre()                Returns the current record's "nombre" value
 * @method float               getNotaAprobatoria()       Returns the current record's "nota_aprobatoria" value
 * @method integer             getIsInscribible()         Returns the current record's "is_inscribible" value
 * @method Doctrine_Collection getEstudiante()            Returns the current record's "Estudiante" collection
 * @method Doctrine_Collection getPeriodoAcademico()      Returns the current record's "PeriodoAcademico" collection
 * @method Doctrine_Collection getSemestre()              Returns the current record's "Semestre" collection
 * @method Doctrine_Collection getFormularioInscripcion() Returns the current record's "FormularioInscripcion" collection
 * @method Doctrine_Collection getHomologacion()          Returns the current record's "Homologacion" collection
 * @method Pensum              setCodigoPensum()          Sets the current record's "codigo_pensum" value
 * @method Pensum              setNombre()                Sets the current record's "nombre" value
 * @method Pensum              setNotaAprobatoria()       Sets the current record's "nota_aprobatoria" value
 * @method Pensum              setIsInscribible()         Sets the current record's "is_inscribible" value
 * @method Pensum              setEstudiante()            Sets the current record's "Estudiante" collection
 * @method Pensum              setPeriodoAcademico()      Sets the current record's "PeriodoAcademico" collection
 * @method Pensum              setSemestre()              Sets the current record's "Semestre" collection
 * @method Pensum              setFormularioInscripcion() Sets the current record's "FormularioInscripcion" collection
 * @method Pensum              setHomologacion()          Sets the current record's "Homologacion" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePensum extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pensum');
        $this->hasColumn('codigo_pensum', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 10,
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
        $this->hasColumn('nota_aprobatoria', 'float', 18, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 18,
             ));
        $this->hasColumn('is_inscribible', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Estudiante', array(
             'local' => 'codigo_pensum',
             'foreign' => 'codigo_pensum'));

        $this->hasMany('PeriodoAcademico', array(
             'local' => 'codigo_pensum',
             'foreign' => 'codigo_pensum'));

        $this->hasMany('Semestre', array(
             'local' => 'codigo_pensum',
             'foreign' => 'codigo_pensum'));

        $this->hasMany('FormularioInscripcion', array(
             'local' => 'codigo_pensum',
             'foreign' => 'codigo_pensum'));

        $this->hasMany('Homologacion', array(
             'local' => 'codigo_pensum',
             'foreign' => 'codigo_pensum_origen'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}
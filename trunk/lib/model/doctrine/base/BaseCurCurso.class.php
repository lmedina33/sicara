<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CurCurso', 'doctrine');

/**
 * BaseCurCurso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_cur_curso
 * @property string $nombre
 * @property string $duracion
 * @property string $horario
 * @property date $inicio_calificacion
 * @property date $fin_calificacion
 * @property integer $is_inscribible
 * @property integer $id_cur_empresa
 * @property string $codigo_profesor
 * @property CurEmpresa $CurEmpresa
 * @property Profesor $Profesor
 * 
 * @method integer    getIdCurCurso()          Returns the current record's "id_cur_curso" value
 * @method string     getNombre()              Returns the current record's "nombre" value
 * @method string     getDuracion()            Returns the current record's "duracion" value
 * @method string     getHorario()             Returns the current record's "horario" value
 * @method date       getInicioCalificacion()  Returns the current record's "inicio_calificacion" value
 * @method date       getFinCalificacion()     Returns the current record's "fin_calificacion" value
 * @method integer    getIsInscribible()       Returns the current record's "is_inscribible" value
 * @method integer    getIdCurEmpresa()        Returns the current record's "id_cur_empresa" value
 * @method string     getCodigoProfesor()      Returns the current record's "codigo_profesor" value
 * @method CurEmpresa getCurEmpresa()          Returns the current record's "CurEmpresa" value
 * @method Profesor   getProfesor()            Returns the current record's "Profesor" value
 * @method CurCurso   setIdCurCurso()          Sets the current record's "id_cur_curso" value
 * @method CurCurso   setNombre()              Sets the current record's "nombre" value
 * @method CurCurso   setDuracion()            Sets the current record's "duracion" value
 * @method CurCurso   setHorario()             Sets the current record's "horario" value
 * @method CurCurso   setInicioCalificacion()  Sets the current record's "inicio_calificacion" value
 * @method CurCurso   setFinCalificacion()     Sets the current record's "fin_calificacion" value
 * @method CurCurso   setIsInscribible()       Sets the current record's "is_inscribible" value
 * @method CurCurso   setIdCurEmpresa()        Sets the current record's "id_cur_empresa" value
 * @method CurCurso   setCodigoProfesor()      Sets the current record's "codigo_profesor" value
 * @method CurCurso   setCurEmpresa()          Sets the current record's "CurEmpresa" value
 * @method CurCurso   setProfesor()            Sets the current record's "Profesor" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurCurso extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cur_curso');
        $this->hasColumn('id_cur_curso', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('duracion', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
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
        $this->hasColumn('inicio_calificacion', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('fin_calificacion', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
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
        $this->hasColumn('id_cur_empresa', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'autoincrement' => false,
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('codigo_profesor', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CurEmpresa', array(
             'local' => 'id_cur_empresa',
             'foreign' => 'id_cur_empresa'));

        $this->hasOne('Profesor', array(
             'local' => 'codigo_profesor',
             'foreign' => 'codigo_profesor'));
    }
}
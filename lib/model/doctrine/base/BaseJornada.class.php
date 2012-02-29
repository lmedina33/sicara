<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Jornada', 'doctrine');

/**
 * BaseJornada
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_jornada
 * @property string $nombre
 * @property Doctrine_Collection $Inscrito
 * @property Doctrine_Collection $Matricula
 * 
 * @method integer             getIdJornada()  Returns the current record's "id_jornada" value
 * @method string              getNombre()     Returns the current record's "nombre" value
 * @method Doctrine_Collection getInscrito()   Returns the current record's "Inscrito" collection
 * @method Doctrine_Collection getMatricula()  Returns the current record's "Matricula" collection
 * @method Jornada             setIdJornada()  Sets the current record's "id_jornada" value
 * @method Jornada             setNombre()     Sets the current record's "nombre" value
 * @method Jornada             setInscrito()   Sets the current record's "Inscrito" collection
 * @method Jornada             setMatricula()  Sets the current record's "Matricula" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJornada extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jornada');
        $this->hasColumn('id_jornada', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Inscrito', array(
             'local' => 'id_jornada',
             'foreign' => 'id_jornada'));

        $this->hasMany('Matricula', array(
             'local' => 'id_jornada',
             'foreign' => 'id_jornada'));
    }
}
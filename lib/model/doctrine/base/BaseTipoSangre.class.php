<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TipoSangre', 'doctrine');

/**
 * BaseTipoSangre
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_tipo_sangre
 * @property string $nombre
 * @property Doctrine_Collection $Usuario
 * @property Doctrine_Collection $FormularioInscripcion
 * 
 * @method integer             getIdTipoSangre()          Returns the current record's "id_tipo_sangre" value
 * @method string              getNombre()                Returns the current record's "nombre" value
 * @method Doctrine_Collection getUsuario()               Returns the current record's "Usuario" collection
 * @method Doctrine_Collection getFormularioInscripcion() Returns the current record's "FormularioInscripcion" collection
 * @method TipoSangre          setIdTipoSangre()          Sets the current record's "id_tipo_sangre" value
 * @method TipoSangre          setNombre()                Sets the current record's "nombre" value
 * @method TipoSangre          setUsuario()               Sets the current record's "Usuario" collection
 * @method TipoSangre          setFormularioInscripcion() Sets the current record's "FormularioInscripcion" collection
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoSangre extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_sangre');
        $this->hasColumn('id_tipo_sangre', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 5, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 5,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Usuario', array(
             'local' => 'id_tipo_sangre',
             'foreign' => 'id_tipo_sangre'));

        $this->hasMany('FormularioInscripcion', array(
             'local' => 'id_tipo_sangre',
             'foreign' => 'id_tipo_sangre'));
    }
}
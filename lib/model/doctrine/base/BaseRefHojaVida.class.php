<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RefHojaVida', 'doctrine');

/**
 * BaseRefHojaVida
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_ref_hoja_vida
 * @property string $descripcion
 * @property integer $id_ref_elemento
 * @property integer $id_usuario_creador
 * @property RefElemento $RefElemento
 * @property Usuario $UsuarioCreador
 * 
 * @method integer     getIdRefHojaVida()      Returns the current record's "id_ref_hoja_vida" value
 * @method string      getDescripcion()        Returns the current record's "descripcion" value
 * @method integer     getIdRefElemento()      Returns the current record's "id_ref_elemento" value
 * @method integer     getIdUsuarioCreador()   Returns the current record's "id_usuario_creador" value
 * @method RefElemento getRefElemento()        Returns the current record's "RefElemento" value
 * @method Usuario     getUsuarioCreador()     Returns the current record's "UsuarioCreador" value
 * @method RefHojaVida setIdRefHojaVida()      Sets the current record's "id_ref_hoja_vida" value
 * @method RefHojaVida setDescripcion()        Sets the current record's "descripcion" value
 * @method RefHojaVida setIdRefElemento()      Sets the current record's "id_ref_elemento" value
 * @method RefHojaVida setIdUsuarioCreador()   Sets the current record's "id_usuario_creador" value
 * @method RefHojaVida setRefElemento()        Sets the current record's "RefElemento" value
 * @method RefHojaVida setUsuarioCreador()     Sets the current record's "UsuarioCreador" value
 * 
 * @package    sicara2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRefHojaVida extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ref_hoja_vida');
        $this->hasColumn('id_ref_hoja_vida', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('descripcion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('id_ref_elemento', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_usuario_creador', 'integer', 4, array(
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
        $this->hasOne('RefElemento', array(
             'local' => 'id_ref_elemento',
             'foreign' => 'id_ref_elemento'));

        $this->hasOne('Usuario as UsuarioCreador', array(
             'local' => 'id_usuario_creador',
             'foreign' => 'id_usuario'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}